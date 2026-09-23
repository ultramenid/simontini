<?php

namespace App\Http\Controllers;

use App\Support\DeforestationStoryMedia;
use App\Support\DeforestationStoryStopper;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class DeforestationStoryController extends Controller
{
    public function index(string $locale): View
    {
        return $this->renderIndex($locale, false);
    }

    public function previewIndex(string $locale): View
    {
        return $this->renderIndex($locale, true);
    }

    public function show(string $locale, int $id, string $slug): View|RedirectResponse
    {
        return $this->renderDetail($locale, $id, $slug, false);
    }

    public function previewShow(string $locale, int $id, string $slug): View|RedirectResponse
    {
        return $this->renderDetail($locale, $id, $slug, true);
    }

    public function unlock(Request $request, string $locale, int $id, string $slug): RedirectResponse
    {
        return $this->completeUnlock($request, $locale, $id, $slug, false);
    }

    public function unlockPreview(Request $request, string $locale, int $id, string $slug): RedirectResponse
    {
        return $this->completeUnlock($request, $locale, $id, $slug, true);
    }

    private function completeUnlock(Request $request, string $locale, int $id, string $slug, bool $isPreview): RedirectResponse
    {
        $story = DB::table('deforestory')->where('id', $id)->first();
        abort_if($story === null || ! hash_equals((string) $story->slug, $slug), 404);
        $passwordHash = $this->globalPreviewPasswordHash();
        $detailUrl = $this->storyDetailUrl($locale, $story, $isPreview);

        if (! $this->storyIsLocked($story) || $this->hasPreviewAccess($request, $passwordHash)) {
            return redirect()->to($detailUrl);
        }

        $validated = $request->validate([
            'password' => ['required', 'string', 'max:100'],
        ]);
        $rateLimitKey = 'deforestory-preview-password:'.$request->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            throw ValidationException::withMessages([
                'password' => $locale === 'en'
                    ? "Too many attempts. Try again in {$seconds} seconds."
                    : "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        if (! filled($passwordHash) || ! Hash::check($validated['password'], $passwordHash)) {
            RateLimiter::hit($rateLimitKey, 60);

            throw ValidationException::withMessages([
                'password' => ! filled($passwordHash)
                    ? ($locale === 'en'
                        ? 'The preview password has not been configured.'
                        : 'Password global preview belum dikonfigurasi.')
                    : ($locale === 'en' ? 'The password is incorrect.' : 'Password yang dimasukkan salah.'),
            ]);
        }

        RateLimiter::clear($rateLimitKey);
        $request->session()->put(
            $this->previewSessionKey(),
            hash('sha256', $passwordHash),
        );

        return redirect()->to($detailUrl);
    }

    private function renderIndex(string $locale, bool $isPreview): View
    {
        $display = DB::table('deforestory_display_settings')->where('id', 1)->first();
        $categoryClickable = (bool) ($display->category_clickable ?? true);
        $regionClickable = (bool) ($display->region_clickable ?? true);
        $query = DB::table('deforestory')
            ->orderByDesc('date')
            ->orderByDesc('id');

        if (! $isPreview) {
            $query->where('status', 'publish');
        }

        $filters = request()->validate([
            'category' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
        ]);
        foreach (['category', 'region'] as $field) {
            if (! ($field === 'category' ? $categoryClickable : $regionClickable)) {
                unset($filters[$field]);
                continue;
            }
            if (filled($filters[$field] ?? null)) {
                $column = $field.($locale === 'en' ? '_en' : '_id');
                $query->whereRaw("COALESCE({$column}, {$field}) = ?", [$filters[$field]]);
            }
        }
        $indexParameters = ['locale' => $locale];
        $resetUrl = $isPreview
            ? URL::temporarySignedRoute('deforestation.preview.index',
                Carbon::createFromTimestamp(request()->integer('expires')), $indexParameters)
            : route('deforestation.index', $indexParameters);

        // Hanya kolom yang dipakai kartu; konten/footer (longtext) tidak perlu di daftar.
        $stories = $query->paginate(12, [
            'id', 'slug', 'date', 'status', 'is_locked', 'meta_font_size', 'image_id', 'image_en',
            'title_id', 'title_en', 'index_title_id', 'index_title_en', 'desrkirpsi_id', 'desrkirpsi_en',
            'category', 'category_id', 'category_en', 'region', 'region_id', 'region_en',
        ]);
        $this->localizeStories($stories->getCollection(), $locale);

        // Preview memakai URL bertanda tangan, jadi tiap halaman butuh signature sendiri.
        $pageUrl = function (int $page) use ($isPreview, $indexParameters, $filters) {
            $parameters = $indexParameters + array_filter($filters) + ($page > 1 ? ['page' => $page] : []);

            return ($isPreview
                ? URL::temporarySignedRoute('deforestation.preview.index',
                    Carbon::createFromTimestamp(request()->integer('expires')), $parameters)
                : route('deforestation.index', $parameters)).'#publikasi';
        };

        $storyGroups = $stories->getCollection()->groupBy(
            fn ($story) => Carbon::parse($story->date)->locale($locale)->translatedFormat('F Y'),
        );

        return view('frontends.deforestation-story-index', [
            'title' => $locale === 'en' ? 'Deforestation Story - Simontini' : 'Cerita Deforestasi - Simontini',
            'description' => $locale === 'en'
                ? 'Short stories on deforestation cases in Indonesia by Auriga Nusantara and partners, combining secondary data analysis with ground truthing.'
                : 'Cerita ringkas kasus-kasus deforestasi Indonesia oleh Auriga Nusantara dan mitra, memadukan analisis data sekunder dengan pengamatan lapangan.',
            'nav' => 'deforestation-story',
            'locale' => $locale,
            'stories' => $stories,
            'storyGroups' => $storyGroups,
            'filters' => $filters,
            'categoryClickable' => $categoryClickable,
            'regionClickable' => $regionClickable,
            'resetUrl' => $resetUrl,
            'isPreview' => $isPreview,
            'previousPageUrl' => $stories->onFirstPage() ? null : $pageUrl($stories->currentPage() - 1),
            'nextPageUrl' => $stories->hasMorePages() ? $pageUrl($stories->currentPage() + 1) : null,
        ]);
    }

    private function renderDetail(string $locale, int $id, string $slug, bool $isPreview): View|RedirectResponse
    {
        $query = DB::table('deforestory')->where('id', $id);

        if (! $isPreview) {
            $query->where('status', 'publish');
        }

        $story = $query->first();
        abort_if($story === null, 404);

        if (! hash_equals((string) $story->slug, $slug)) {
            $routeParameters = ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug];

            if ($isPreview) {
                $expiresAt = request()->integer('expires')
                    ? Carbon::createFromTimestamp(request()->integer('expires'))
                    : now()->addDays(7);

                return redirect()->to(URL::temporarySignedRoute(
                    'deforestation.preview.show',
                    $expiresAt,
                    $routeParameters,
                ));
            }

            return redirect()->route('deforestation.show', $routeParameters);
        }

        if ($this->storyIsLocked($story) && ! $this->hasPreviewAccess(request(), $this->globalPreviewPasswordHash())) {
            $story = $this->localizeStory($story, $locale);

            return view('frontends.deforestation-story-unlock', [
                'title' => ($locale === 'en' ? 'Protected Story' : 'Story Terkunci').' - Simontini',
                'description' => $locale === 'en'
                    ? 'Enter the password to open this protected preview.'
                    : 'Masukkan password untuk membuka preview yang dilindungi.',
                'nav' => 'deforestation-story',
                'locale' => $locale,
                'story' => $story,
                'isPreview' => $isPreview,
                'unlockUrl' => $isPreview
                    ? $this->temporaryPreviewRoute('deforestation.preview.unlock', [
                        'locale' => $locale,
                        'id' => $story->id,
                        'slug' => $story->slug,
                    ])
                    : route('deforestation.unlock', [
                        'locale' => $locale,
                        'id' => $story->id,
                        'slug' => $story->slug,
                    ]),
                'previewIndexUrl' => $isPreview
                    ? $this->temporaryPreviewRoute('deforestation.preview.index', [
                        'locale' => $locale,
                    ])
                    : route('deforestation.index', ['locale' => $locale]),
            ]);
        }

        $story = $this->localizeStory($story, $locale);

        return view('frontends.deforestation-story-show', [
            'title' => $story->localized_title.' - Simontini',
            'description' => $story->localized_description,
            'nav' => 'deforestation-story',
            'locale' => $locale,
            'story' => $story,
            'isPreview' => $isPreview,
        ]);
    }

    private function localizeStories(Collection $stories, string $locale): void
    {
        $stories->transform(fn ($story) => $this->localizeStory($story, $locale));
    }

    private function localizeStory(object $story, string $locale): object
    {
        $story->localized_title = $locale === 'en' ? $story->title_en : $story->title_id;
        $indexTitle = $locale === 'en' ? ($story->index_title_en ?? '') : ($story->index_title_id ?? '');
        $story->localized_index_title = filled($indexTitle) ? $indexTitle : $story->localized_title;
        $story->localized_category = $locale === 'en'
            ? ($story->category_en ?? $story->category ?? null)
            : ($story->category_id ?? $story->category ?? null);
        $story->localized_region = $locale === 'en'
            ? ($story->region_en ?? $story->region ?? null)
            : ($story->region_id ?? $story->region ?? null);
        $story->localized_meta = collect([
            $story->localized_category,
            $story->localized_region,
        ])->filter(fn ($value) => filled($value))->join(' | ');
        $story->localized_meta_font_size = min(max((int) ($story->meta_font_size ?? 14), 10), 28);
        $story->localized_description = $locale === 'en' ? $story->desrkirpsi_en : $story->desrkirpsi_id;
        $story->localized_footer = $locale === 'en' ? ($story->footer_en ?? '') : ($story->footer_id ?? '');
        // Daftar tidak memilih kolom konten, jadi nilainya bisa tidak ada.
        $story->localized_content = DeforestationStoryStopper::normalizeHtml(
            $locale === 'en' ? ($story->content_en ?? null) : ($story->content_id ?? null),
        );
        $story->localized_image = $locale === 'en' && $story->image_en ? $story->image_en : $story->image_id;
        $story->localized_media_is_video = DeforestationStoryMedia::isVideo($story->localized_image);
        $story->localized_image_description = $locale === 'en'
            ? ($story->image_description_en ?? null)
            : ($story->image_description_id ?? null);

        return $story;
    }

    private function storyIsLocked(object $story): bool
    {
        $value = $story->is_locked ?? false;

        if (is_bool($value)) {
            return $value;
        }

        if (is_int($value) || is_float($value)) {
            return (int) $value === 1;
        }

        return in_array(strtolower(trim((string) $value)), ['1', 'true', 'yes', 'on'], true);
    }

    private function storyDetailUrl(string $locale, object $story, bool $isPreview): string
    {
        $parameters = [
            'locale' => $locale,
            'id' => $story->id,
            'slug' => $story->slug,
        ];

        return $isPreview
            ? $this->temporaryPreviewRoute('deforestation.preview.show', $parameters)
            : route('deforestation.show', $parameters);
    }

    private function hasPreviewAccess(Request $request, ?string $passwordHash): bool
    {
        if (! filled($passwordHash)) {
            return false;
        }

        $unlockedPassword = $request->session()->get($this->previewSessionKey());

        return is_string($unlockedPassword)
            && hash_equals(hash('sha256', $passwordHash), $unlockedPassword);
    }

    private function previewSessionKey(): string
    {
        return 'deforestory_preview_unlocked';
    }

    private function globalPreviewPasswordHash(): ?string
    {
        return DB::table('deforestory_preview_settings')->where('id', 1)->value('password_hash');
    }

    private function temporaryPreviewRoute(string $routeName, array $parameters): string
    {
        $expiresAt = request()->integer('expires')
            ? Carbon::createFromTimestamp(request()->integer('expires'))
            : now()->addDays(7);

        return URL::temporarySignedRoute($routeName, $expiresAt, $parameters);
    }
}
