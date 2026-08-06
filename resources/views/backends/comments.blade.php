@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="mx-auto max-w-6xl px-6 py-8">
        <div class="mb-7 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar komentar</h1>
                <p class="mt-1 text-sm text-gray-500">Lihat semua komentar atau pilih satu Deforestory.</p>
            </div>
            <span class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-600">
                {{ $comments->count() }} dari {{ $totalComments }} komentar
            </span>
        </div>

        @if (session('message'))
            <div class="mb-6 border-l-4 border-green-600 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('message') }}</div>
        @endif

        <section class="mb-7" aria-labelledby="comment-users-title">
            <div class="mb-3 flex items-center justify-between gap-4">
                <div>
                    <h2 id="comment-users-title" class="text-lg font-bold text-gray-900">Email pengguna komentar</h2>
                    <p class="mt-1 text-xs text-gray-500">Semua pengguna yang pernah login melalui Google untuk berkomentar.</p>
                </div>
                <span class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-600">{{ $commentUsers->count() }} email</span>
            </div>

            <div class="overflow-x-auto border border-gray-300 bg-white">
                <div class="min-w-[720px]">
                    <div class="grid grid-cols-[1fr_1.4fr_.6fr_.6fr_1fr] gap-4 border-b border-gray-300 bg-gray-50 px-5 py-3 text-[11px] font-bold uppercase tracking-wide text-gray-500">
                        <span>Nama</span>
                        <span>Email</span>
                        <span>Login</span>
                        <span>Komentar</span>
                        <span>Login terakhir</span>
                    </div>
                    @forelse ($commentUsers as $user)
                        <div class="grid grid-cols-[1fr_1.4fr_.6fr_.6fr_1fr] items-center gap-4 border-b border-gray-200 px-5 py-3 text-sm text-gray-700 last:border-b-0">
                            <strong class="break-words text-gray-900">{{ $user->name }}</strong>
                            @if ($user->email)
                                <a href="mailto:{{ $user->email }}" class="break-all text-simontini hover:underline">{{ $user->email }}</a>
                            @else
                                <span class="text-gray-400">Tidak tersedia</span>
                            @endif
                            <span class="capitalize text-gray-500">{{ $user->provider }}</span>
                            <span class="text-gray-700">{{ $user->comments_count }}</span>
                            <time class="text-xs text-gray-500" datetime="{{ $user->last_login_at }}">{{ $user->last_login_at ?: '-' }}</time>
                        </div>
                    @empty
                        <div class="p-8 text-center text-sm text-gray-500">Belum ada pengguna komentar.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <form method="GET" action="{{ route('cms.comments') }}" class="mb-7 border border-gray-300 bg-white p-5">
            <label for="story_id" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Pilih Deforestory</label>
            <div class="flex flex-col gap-3 sm:flex-row">
                <select id="story_id" name="story_id" class="min-w-0 flex-1 border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 focus:border-simontini focus:outline-none">
                    <option value="">Semua Deforestory ({{ $totalComments }} komentar)</option>
                    @foreach ($stories as $story)
                        <option value="{{ $story->id }}" @selected($selectedStoryId === (int) $story->id)>
                            {{ $story->title_id }} ({{ $story->comments_count }} komentar)
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-simontini px-6 py-3 text-xs font-bold uppercase tracking-wide text-white hover:opacity-90">Tampilkan</button>
                @if ($selectedStoryId !== null)
                    <a href="{{ route('cms.comments') }}" class="border border-gray-300 bg-white px-6 py-3 text-center text-xs font-bold uppercase tracking-wide text-gray-700 hover:bg-gray-50">Reset</a>
                @endif
            </div>
        </form>

        <div class="space-y-4">
            @forelse ($comments as $comment)
                <article class="border border-gray-300 bg-white p-5">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <strong class="text-sm text-gray-900">{{ $comment['user_name'] }}</strong>
                                <a href="{{ route('cms.comments', ['story_id' => $comment['story_id']]) }}" class="text-xs font-semibold text-simontini hover:underline">
                                    {{ $comment['story_title_id'] }}
                                </a>
                                @if ($comment['parent_id'])
                                    <span class="bg-gray-100 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-gray-600">Balasan</span>
                                @endif
                                <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wide {{ $comment['status'] === 'approved' ? 'bg-green-100 text-green-800' : ($comment['status'] === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">{{ $comment['status'] }}</span>
                            </div>
                            <p class="mt-3 whitespace-pre-line break-words text-sm leading-6 text-gray-700">{{ $comment['comment'] }}</p>
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
