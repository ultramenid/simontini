<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    private const LOCALES = ['id', 'en'];

    private const PAGES = ['', 'insight', 'download', 'mapndata', 'deforestory'];

    private const REPORTS = [
        ['id' => '/id/status-deforestasi-indonesia-2024', 'en' => '/en/status-of-deforestation-in-indonesia-2024', 'ja' => '/jp/status-of-deforestation-in-indonesia-2024'],
        ['id' => '/id/status-deforestasi-di-indonesia-2025', 'en' => '/en/status-of-deforestation-in-indonesia-2025'],
    ];

    public function __invoke()
    {
        $sitemap = Sitemap::create();

        foreach (self::PAGES as $page) {
            $this->addGroup($sitemap, collect(self::LOCALES)
                ->mapWithKeys(fn ($locale) => [$locale => url(rtrim("$locale/$page", '/'))])
                ->all());
        }

        foreach (self::REPORTS as $paths) {
            $this->addGroup($sitemap, array_map(fn ($path) => url($path), $paths));
        }

        // Locked stories need a password, so only open published stories are listed.
        DB::table('deforestory')
            ->where('status', 'publish')
            ->where(fn ($query) => $query->where('is_locked', false)->orWhereNull('is_locked'))
            ->orderByDesc('date')
            ->get(['id', 'slug', 'updated_at'])
            ->each(fn ($story) => $this->addGroup(
                $sitemap,
                collect(self::LOCALES)->mapWithKeys(fn ($locale) => [
                    $locale => route('deforestation.show', ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug]),
                ])->all(),
                $story->updated_at ? Carbon::parse($story->updated_at) : null,
            ));

        return response($sitemap->render(), 200)->header('Content-Type', 'text/xml');
    }

    /** One <url> per language version, each listing all versions as hreflang alternates. */
    private function addGroup(Sitemap $sitemap, array $versions, ?Carbon $lastModified = null): void
    {
        foreach ($versions as $url) {
            $tag = Url::create($url);

            foreach ($versions as $language => $alternate) {
                $tag->addAlternate($alternate, $language);
            }

            if ($lastModified) {
                $tag->setLastModificationDate($lastModified);
            }

            $sitemap->add($tag);
        }
    }
}
