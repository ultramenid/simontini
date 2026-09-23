{{--
    Shared SEO / social metadata for public pages.
    Optional variables: $metaImage, $ogType, $alternates (['id' => url, 'en' => url, ...]),
    $structuredData (one JSON-LD array or a list of them), $noindex.
--}}
@php
    $segments = request()->segments();
    $metaImage ??= asset('assets/meta-image-2025.jpg');
    $ogType ??= 'website';
    $canonical = url()->current();

    // /{id|en}/... pages exist in both languages under the same path.
    if (! isset($alternates) && in_array($segments[0] ?? null, ['id', 'en'], true)) {
        $path = implode('/', array_slice($segments, 1));
        $alternates = ['id' => url(rtrim('id/'.$path, '/')), 'en' => url(rtrim('en/'.$path, '/'))];
    }

    $structuredData = isset($structuredData)
        ? (array_is_list($structuredData) ? $structuredData : [$structuredData])
        : [];
@endphp
<meta name="description" content="{{ $description }}">
@if ($noindex ?? false)
    <meta name="robots" content="noindex, follow">
@else
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ $canonical }}">
    @foreach ($alternates ?? [] as $hreflang => $href)
        <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $href }}">
    @endforeach
    @isset($alternates['id'])
        <link rel="alternate" hreflang="x-default" href="{{ $alternates['id'] }}">
    @endisset
@endif

<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="SIMONTINI">
<meta property="og:locale" content="{{ ['en' => 'en_US', 'jp' => 'ja_JP'][$segments[0] ?? ''] ?? 'id_ID' }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $metaImage }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@AURIGA_ID">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $metaImage }}">

@foreach ($structuredData as $schema)
    <script type="application/ld+json">@json(['@context' => 'https://schema.org'] + $schema)</script>
@endforeach
