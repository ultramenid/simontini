<?php

namespace App\Http\Controllers;

use App\Support\DeforestationStoryMedia;
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

    public function unlockPreview(Request $request, string $locale, int $id, string $slug): RedirectResponse
    {
        $story = DB::table('deforestory')->where('id', $id)->first();
        abort_if($story === null || ! hash_equals((string) $story->slug, $slug), 404);
        $passwordHash = $this->globalPreviewPasswordHash();

        $detailUrl = $this->temporaryPreviewRoute('deforestation.preview.show', [
            'locale' => $locale,
            'id' => $story->id,
            'slug' => $story->slug,
        ]);

        if (! $story->is_locked || $this->hasPreviewAccess($request, $passwordHash)) {
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
        $query = DB::table('deforestory')
            ->orderByDesc('date')
            ->orderByDesc('id');

        if (! $isPreview) {
            $query->where('status', 'publish');
        }

        $stories = $query->get();
        $this->localizeStories($stories, $locale);
        $storyGroups = $stories->groupBy(
            fn ($story) => Carbon::parse($story->date)->locale($locale)->translatedFormat('F Y'),
        );

        return view('frontends.deforestation-story-index', [
            'title' => $locale === 'en' ? 'Deforestation Story - Simontini' : 'Cerita Deforestasi - Simontini',
            'description' => $locale === 'en'
                ? 'Stories and analysis about deforestation in Indonesia.'
                : 'Cerita dan analisis mengenai deforestasi di Indonesia.',
            'nav' => 'deforestation-story',
            'locale' => $locale,
            'stories' => $stories,
            'storyGroups' => $storyGroups,
            'isPreview' => $isPreview,
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

        if ($isPreview && $story->is_locked && ! $this->hasPreviewAccess(request(), $this->globalPreviewPasswordHash())) {
            $story = $this->localizeStory($story, $locale);

            return view('frontends.deforestation-story-unlock', [
                'title' => ($locale === 'en' ? 'Protected Story' : 'Story Terkunci').' - Simontini',
                'description' => $locale === 'en'
                    ? 'Enter the password to open this protected preview.'
                    : 'Masukkan password untuk membuka preview yang dilindungi.',
                'nav' => 'deforestation-story',
                'locale' => $locale,
                'story' => $story,
                'unlockUrl' => $this->temporaryPreviewRoute('deforestation.preview.unlock', [
                    'locale' => $locale,
                    'id' => $story->id,
                    'slug' => $story->slug,
                ]),
                'previewIndexUrl' => $this->temporaryPreviewRoute('deforestation.preview.index', [
                    'locale' => $locale,
                ]),
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
        $story->localized_description = $locale === 'en' ? $story->desrkirpsi_en : $story->desrkirpsi_id;
        $story->localized_content = $locale === 'en' ? $story->content_en : $story->content_id;
        $story->localized_image = $locale === 'en' && $story->image_en ? $story->image_en : $story->image_id;
        $story->localized_media_is_video = DeforestationStoryMedia::isVideo($story->localized_image);
        $story->localized_image_description = $locale === 'en'
            ? $story->image_description_en
            : $story->image_description_id;

        return $story;
    }

    private function hasPreviewAccess(Request $request, ?string $passwordHash): bool
    {
        if ($request->session()->has('id')) {
            return true;
        }

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
