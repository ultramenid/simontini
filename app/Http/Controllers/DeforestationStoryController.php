<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
            return redirect()->route(
                $isPreview ? 'deforestation.preview.show' : 'deforestation.show',
                ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug],
            );
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

        return $story;
    }
}
