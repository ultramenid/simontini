{{-- Plain text (Markdown), so values are printed raw after being flattened to one line. --}}
@php($line = fn (?string $text) => trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $text), ENT_QUOTES | ENT_HTML5, 'UTF-8'))))
# Simontini

> Simontini (Sistem Informasi Tutupan dan Izin di Indonesia) is an open data platform by Auriga Nusantara on deforestation, land cover and concession licenses (HGU, IUP, PBPH, forest estate) across Indonesia. Content is available in Indonesian (/id) and English (/en).

## Reports

- [Status of Deforestation in Indonesia 2025]({!! url('/en/status-of-deforestation-in-indonesia-2025') !!}): annual deforestation report with national figures, methodology and policy recommendations
- [Status Deforestasi di Indonesia 2025]({!! url('/id/status-deforestasi-di-indonesia-2025') !!}): Indonesian edition
- [Status of Deforestation in Indonesia 2024]({!! url('/en/status-of-deforestation-in-indonesia-2024') !!}): annual deforestation report for 2024
- [Status Deforestasi Indonesia 2024]({!! url('/id/status-deforestasi-indonesia-2024') !!}): Indonesian edition

## Deforestory

Short case stories on deforestation in specific concessions and regions, combining secondary data analysis with ground truthing. Newest first; each links the Indonesian and English edition.

@foreach ($stories as $story)
- [{!! $line($story->title_id) !!}]({!! route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]) !!}) ([English]({!! route('deforestation.show', ['locale' => 'en', 'id' => $story->id, 'slug' => $story->slug]) !!}), {{ \Illuminate\Support\Carbon::parse($story->date)->toDateString() }}): {!! $line($story->desrkirpsi_en ?: $story->desrkirpsi_id) !!}
@endforeach

## Data

- [Map & Data]({!! url('/en/mapndata') !!}): interactive map of land cover, deforestation and license layers
- [Downloads]({!! url('/en/download') !!}): downloadable spatial data and report files
- [Insight]({!! url('/en/insight') !!}): index of analysis articles

## Optional

- [Sitemap]({!! url('/sitemap.xml') !!}): every public page, report and story with language alternates
- [Auriga Nusantara](https://auriga.or.id): the organization behind Simontini
