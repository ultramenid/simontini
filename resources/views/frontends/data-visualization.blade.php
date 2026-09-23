<!DOCTYPE html>
<html lang="id" class="{{ $embed ? 'h-full overflow-hidden' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="{{ $embed ? 'noindex, follow' : 'index, follow' }}">
    <title>{{ $visualization->title }} | Simontini</title>
    <meta name="description" content="{{ $description }}">
    @unless ($embed)
        <link rel="canonical" href="{{ route('data-visualizations.show', $visualization->id) }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="SIMONTINI">
        <meta property="og:title" content="{{ $visualization->title }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:url" content="{{ route('data-visualizations.show', $visualization->id) }}">
        <meta property="og:image" content="{{ asset('assets/meta-image-2025.jpg') }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@AURIGA_ID">
    @endunless
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-900 {{ $embed ? 'h-full overflow-hidden' : '' }}">
    <main class="{{ $embed ? 'h-full w-full overflow-hidden p-0' : 'mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8' }}">
        <section class="bg-white {{ $embed ? 'h-full overflow-hidden' : '' }}">
            @unless ($embed)
                <h1 class="sr-only">{{ $visualization->title }}</h1>
            @endunless
            <div class="relative w-full {{ $embed ? 'h-full min-h-0 overflow-hidden' : 'aspect-video min-h-[360px]' }}">
                <canvas id="published-data-visualization" aria-label="{{ $visualization->title }}" role="img"></canvas>
            </div>

            @if ($embed)
                <div class="sr-only">@include('partials.chart-data-table', ['title' => $visualization->title])</div>
            @else
                <details class="chart-data mt-6">
                    <summary>Lihat data tabel</summary>
                    @include('partials.chart-data-table', ['title' => $visualization->title])
                </details>
            @endif
        </section>
    </main>

    <script>
        window.addEventListener('load', () => {
            window.renderDataVisualizationChart?.(
                document.getElementById('published-data-visualization'),
                @js($visualization->chart_type ?? 'column'),
                @js($chartData)
            );
        });
    </script>
</body>
</html>
