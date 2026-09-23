@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="mx-auto max-w-6xl px-6 py-8">
        <div class="mb-7 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-500">Ringkasan konten dan aktivitas Simontini.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('cms.deforestory.add') }}" class="bg-simontini px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90">+ Deforestory</a>
                <a href="{{ route('cms.data-visualizations.add') }}" class="border border-gray-300 bg-white px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-gray-700 hover:border-simontini hover:text-simontini">+ Data &amp; Grafik</a>
            </div>
        </div>

        @php
            $cards = [
                ['Deforestory', $stats['stories'], $stats['published'].' terbit · '.$stats['drafts'].' draft', route('cms.deforestory')],
                ['Preview terkunci', $stats['locked'], 'Deforestory dengan kunci preview', route('cms.deforestory')],
                ['Komentar', $stats['comments'], $stats['hiddenComments'].' disembunyikan', route('cms.comments')],
                ['Subscriber aktif', $stats['subscribers'], 'Penerima notifikasi email', route('cms.subscribers')],
                ['Data & Grafik', $stats['visualizations'], 'Visualisasi aktif', route('cms.data-visualizations')],
                ['Reference', $stats['references'], 'Gambar tersimpan', route('cms.reference')],
            ];
        @endphp

        <section class="mb-8 grid grid-cols-2 gap-px border border-gray-300 bg-gray-300 lg:grid-cols-3" aria-label="Statistik">
            @foreach ($cards as [$label, $value, $note, $href])
                <a href="{{ $href }}" class="group bg-white p-5 hover:bg-gray-50">
                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-500">{{ $label }}</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 group-hover:text-simontini">{{ number_format($value) }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ $note }}</p>
                </a>
            @endforeach
        </section>

        <div class="grid gap-6 lg:grid-cols-2">
            <section class="border border-gray-300 bg-white" aria-labelledby="recent-stories">
                <div class="flex items-center justify-between border-b border-gray-300 px-5 py-4">
                    <h2 id="recent-stories" class="text-sm font-bold text-gray-900">Deforestory terbaru diubah</h2>
                    <a href="{{ route('cms.deforestory') }}" class="text-xs font-semibold text-simontini hover:underline">Lihat semua</a>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse ($recentStories as $story)
                        <li>
                            <a href="{{ route('cms.deforestory.edit', $story->id) }}" class="flex items-center justify-between gap-4 px-5 py-3 hover:bg-gray-50">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gray-800">{{ $story->title_id }}</p>
                                    <p class="mt-0.5 text-xs text-gray-500">{{ \Illuminate\Support\Carbon::parse($story->updated_at)->diffForHumans() }}</p>
                                </div>
                                <div class="flex shrink-0 gap-1.5">
                                    @if ($story->is_locked)
                                        <span class="bg-amber-50 px-2 py-1 text-[10px] font-bold uppercase text-amber-700">Terkunci</span>
                                    @endif
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase {{ $story->status === 'publish' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $story->status === 'publish' ? 'Terbit' : 'Draft' }}
                                    </span>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-center text-sm text-gray-500">Belum ada Deforestory.</li>
                    @endforelse
                </ul>
            </section>

            <section class="border border-gray-300 bg-white" aria-labelledby="recent-comments">
                <div class="flex items-center justify-between border-b border-gray-300 px-5 py-4">
                    <h2 id="recent-comments" class="text-sm font-bold text-gray-900">Komentar terbaru</h2>
                    <a href="{{ route('cms.comments') }}" class="text-xs font-semibold text-simontini hover:underline">Kelola</a>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse ($recentComments as $comment)
                        <li class="px-5 py-3">
                            <div class="flex items-center justify-between gap-3 text-xs">
                                <span class="font-semibold text-gray-800">{{ $comment->user_name }}</span>
                                <span class="text-gray-400">{{ \Illuminate\Support\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 line-clamp-2 text-sm text-gray-600 {{ $comment->status === 'hidden' ? 'italic opacity-60' : '' }}">{{ $comment->comment }}</p>
                            <p class="mt-1 truncate text-[11px] text-gray-400">di {{ $comment->story_title }}</p>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-center text-sm text-gray-500">Belum ada komentar.</li>
                    @endforelse
                </ul>
            </section>
        </div>
    </main>
@endsection
