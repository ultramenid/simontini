<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsightContoller extends Controller
{

    private const STADI_2024 = [
        'id' => '/id/status-deforestasi-indonesia-2024',
        'en' => '/en/status-of-deforestation-in-indonesia-2024',
        'ja' => '/jp/status-of-deforestation-in-indonesia-2024',
    ];

    private const STADI_2025 = [
        'id' => '/id/status-deforestasi-di-indonesia-2025',
        'en' => '/en/status-of-deforestation-in-indonesia-2025',
    ];

    public function index(){
        $title = app()->getLocale() === 'en'
            ? 'Insight: Indonesia Deforestation Analysis - Simontini'
            : 'Insight: Analisis Deforestasi Indonesia - Simontini';
        $nav = 'insight';
        $description = app()->getLocale() === 'en'
            ? 'Simontini’s Insight is a series of articles that provide in-depth analysis of the latest issues related to deforestation and land use change in Indonesia.'
            : 'Insight Simontini adalah rangkaian artikel analisis mendalam tentang isu terbaru deforestasi dan perubahan tutupan lahan di Indonesia.';
        return view('frontends.insight', compact('title', 'description', 'nav'));
    }

    public function stadi2024(){
        return view('frontends.stadi2024', $this->report(self::STADI_2024, 'id',
            'Status Deforestasi Indonesia 2024 - Simontini',
            'Tahun lalu Auriga merilis data deforestasi 2023 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.',
            '2025-01', asset('assets/stadi2024/meta-insight-2024.jpg')));
    }

    public function stadi2024EN(){
        return view('frontends.stadi2024EN', $this->report(self::STADI_2024, 'en',
            'Status of Deforestation in Indonesia 2024 - Simontini',
            'Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.',
            '2025-01', asset('assets/stadi2024/meta-insight-2024.jpg')));
    }

    public function stadi2024JP(){
        return view('frontends.stadi2024JP', $this->report(self::STADI_2024, 'ja',
            'インドネシアにおける2024年の森林破壊の現状 - Simontini',
            'Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.',
            '2025-01', asset('assets/stadi2024/meta-insight-2024.jpg')));
    }

    public function stadi2025(){
        return view('frontends.stadi2025', $this->report(self::STADI_2025, 'id',
            'Status Deforestasi di Indonesia 2025 - Simontini',
            'Deforestasi melonjak, saatnya pemerintah menerbitkan regulasi yang melindungi seluruh hutan alam tersisa.'));
    }

    public function stadi2025EN(){
        return view('frontends.stadi2025EN', $this->report(self::STADI_2025, 'en',
            'Status of Deforestation in Indonesia 2025 - Simontini',
            'Deforestation surges - the time is right for Indonesia to protect all of its remaining natural forest.'));
    }

    /** Meta for an annual STADI report: language alternates plus Article structured data. */
    private function report(array $paths, string $language, string $title, string $description, ?string $published = null, ?string $image = null): array
    {
        $image ??= asset('assets/meta-image-2025.jpg');
        $alternates = array_map(fn ($path) => url($path), $paths);

        return [
            'title' => $title,
            'description' => $description,
            'alternates' => $alternates,
            'ogType' => 'article',
            'metaImage' => $image,
            'structuredData' => array_filter([
                '@type' => 'Article',
                'headline' => str($title)->beforeLast(' - Simontini')->toString(),
                'description' => $description,
                'inLanguage' => $language,
                'url' => $alternates[$language],
                'image' => [$image],
                'datePublished' => $published,
                'author' => config('seo.organization'),
                'publisher' => config('seo.organization'),
            ]),
        ];
    }

     public function stadi2025JP(){
        $title = 'Status of deforestation in Indonesia 2025 ';
        $description = 'Auriga released deforestation data for 2024 in March last year. Commencing this year, it will release annual deforestation data each January.';
        return view('frontends.stadi2025JP', compact('title', 'description'));
    }

    public function penjelasan(){
        $nav = 'stadi';
        $title = 'Penjelasan Data Deforestasi Indonesia';
        $description = 'Simontini’s Insight is a series of articles that provide in-depth analysis of the latest issues related to deforestation and land use change in Indonesia.';
        return view('frontends.penjelasan-data', compact('title', 'description', 'nav'));
    }

    public function dummy2025(){
        $title = 'Status deforestasi Indonesia 2025 ';
        $description = 'Tahun lalu Auriga merilis data deforestasi 2024 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.';
        return view('dummy.2025', compact('title', 'description'));
    }
}
