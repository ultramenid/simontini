@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="mx-auto max-w-6xl px-6 py-8">
        <div class="mb-7 flex items-end justify-between gap-5">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Moderasi komentar</h1>
                <p class="mt-1 text-sm text-gray-500">Komentar disimpan di database PostgreSQL Simontini.</p>
            </div>
            <span class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-600">{{ $comments->count() }} komentar</span>
        </div>

        @if (session('message'))
            <div class="mb-6 border-l-4 border-green-600 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('message') }}</div>
        @endif

        <div class="space-y-4">
            @forelse ($comments as $comment)
                <article class="border border-gray-300 bg-white p-5 dark:border-gray-700 dark:bg-newgray-800">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <strong class="text-sm text-gray-900 dark:text-white">{{ $comment['user_name'] }}</strong>
                                <span class="text-xs text-gray-500">Story #{{ $comment['story_id'] }}</span>
                                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wide {{ $comment['status'] === 'approved' ? 'bg-green-100 text-green-800' : ($comment['status'] === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">{{ $comment['status'] }}</span>
                            </div>
                            <p class="mt-3 whitespace-pre-line break-words text-sm leading-6 text-gray-700 dark:text-gray-300">{{ $comment['comment'] }}</p>
                            <p class="mt-3 text-xs text-gray-400">{{ $comment['user_email'] }} · {{ $comment['created_at'] }}</p>
                        </div>

                        <div class="flex shrink-0 flex-wrap content-start gap-2">
                            @if ($comment['status'] !== 'approved')
                                <form method="POST" action="{{ route('cms.comments.status', ['id' => $comment['id'], 'status' => 'approved']) }}">@csrf @method('PATCH')<button class="bg-green-700 px-3 py-2 text-xs font-bold text-white hover:bg-green-800">Setujui</button></form>
                            @endif
                            @if ($comment['status'] !== 'rejected')
                                <form method="POST" action="{{ route('cms.comments.status', ['id' => $comment['id'], 'status' => 'rejected']) }}">@csrf @method('PATCH')<button class="bg-amber-600 px-3 py-2 text-xs font-bold text-white hover:bg-amber-700">Tolak</button></form>
                            @endif
                            <form method="POST" action="{{ route('cms.comments.destroy', ['id' => $comment['id']]) }}" onsubmit="return confirm('Hapus komentar ini?')">@csrf @method('DELETE')<button class="bg-red-700 px-3 py-2 text-xs font-bold text-white hover:bg-red-800">Hapus</button></form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="border border-dashed border-gray-300 bg-white p-12 text-center text-sm text-gray-500">Belum ada komentar.</div>
            @endforelse
        </div>
    </main>
@endsection
