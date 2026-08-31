<!DOCTYPE html>
<html lang="id" class="{{ $embed ? 'h-full overflow-hidden' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="{{ $embed ? 'noindex, follow' : 'index, follow' }}">
    <title>{{ $visualization->title }} | Simontini</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-900 {{ $embed ? 'h-full overflow-hidden' : '' }}">
    <main class="{{ $embed ? 'h-full w-full overflow-hidden p-0' : 'mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8' }}">
        <section class="bg-white {{ $embed ? 'h-full overflow-hidden' : '' }}">
            <div class="relative w-full {{ $embed ? 'h-full min-h-0 overflow-hidden' : 'aspect-video min-h-[360px]' }}">
                <canvas id="published-data-visualization" aria-label="{{ $visualization->title }}" role="img"></canvas>
            </div>
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
