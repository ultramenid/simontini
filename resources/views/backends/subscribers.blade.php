@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="mx-auto max-w-6xl px-6 py-8">
        <div class="mb-7 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar subscriber</h1>
                <p class="mt-1 text-sm text-gray-500">Lihat seluruh subscriber atau pilih satu Deforestory.</p>
            </div>
            <span class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-600">
                {{ $subscribers->count() }} dari {{ $totalSubscribers }} subscriber
            </span>
        </div>

        <form method="GET" action="{{ route('cms.subscribers') }}" class="mb-7 border border-gray-300 bg-white p-5">
            <label for="subscriber-scope" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Filter subscriber</label>
            <div class="flex flex-col gap-3 sm:flex-row">
                <select id="subscriber-scope" name="scope" class="min-w-0 flex-1 border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 focus:border-simontini focus:outline-none">
                    <option value="all" @selected($selectedScope === 'all')>Semua subscriber ({{ $totalSubscribers }})</option>
                    <option value="global" @selected($selectedScope === 'global')>Ikuti semua Deforestory ({{ $globalSubscribers }})</option>
                    @foreach ($stories as $story)
                        <option value="{{ $story->id }}" @selected($selectedScope === (int) $story->id)>
                            {{ $story->title_id }} ({{ $story->subscribers_count }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-simontini px-6 py-3 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90">Tampilkan</button>
                @if ($selectedScope !== 'all')
                    <a href="{{ route('cms.subscribers') }}" class="border border-gray-300 bg-white px-6 py-3 text-center text-xs font-bold uppercase tracking-wide text-gray-700 hover:bg-gray-50">Reset</a>
                @endif
            </div>
        </form>

        <div class="overflow-x-auto border border-gray-300 bg-white">
            <div class="min-w-[850px]">
                <div class="grid grid-cols-[1.1fr_1.4fr_1.5fr_.5fr_.6fr_.8fr] gap-4 border-b border-gray-300 bg-gray-50 px-5 py-4 text-[11px] font-bold uppercase tracking-wide text-gray-500">
                    <span>Nama</span>
                    <span>Email</span>
                    <span>Langganan</span>
                    <span>Bahasa</span>
                    <span>Status</span>
                    <span>Terdaftar</span>
                </div>

                @forelse ($subscribers as $subscriber)
                    <div class="grid grid-cols-[1.1fr_1.4fr_1.5fr_.5fr_.6fr_.8fr] items-center gap-4 border-b border-gray-200 px-5 py-4 text-sm text-gray-700 last:border-b-0">
                        <strong class="break-words text-gray-900">{{ $subscriber->name }}</strong>
                        <a href="mailto:{{ $subscriber->email }}" class="break-all text-simontini hover:underline">{{ $subscriber->email }}</a>
                        @if ($subscriber->deforestory_id)
                            <a href="{{ route('cms.subscribers', ['scope' => $subscriber->deforestory_id]) }}" class="line-clamp-2 font-semibold text-gray-700 hover:text-simontini">
                                {{ $subscriber->story_title_id }}
                            </a>
                        @else
                            <span class="font-semibold text-gray-700">Semua Deforestory</span>
                        @endif
                        <span class="uppercase text-gray-500">{{ $subscriber->locale }}</span>
                        <span class="w-fit px-2 py-1 text-[10px] font-bold uppercase tracking-wide {{ $subscriber->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                            {{ $subscriber->status }}
                        </span>
                        <time class="text-xs text-gray-500" datetime="{{ $subscriber->created_at }}">{{ $subscriber->created_at }}</time>
                    </div>
                @empty
                    <div class="p-12 text-center text-sm text-gray-500">Belum ada subscriber pada pilihan ini.</div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
