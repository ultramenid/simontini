@extends('layouts.dashboard')

@section('content')
    @unless ($modal ?? false)
        @include('partials.backendHeader')
        @include('partials.backendNav')
    @endunless

    <main class="mx-auto max-w-6xl {{ ($modal ?? false) ? 'px-4 py-5' : 'px-6 py-8' }}">
        <livewire:reference-index :picker="$picker" :multiple="$multiple" :selection-limit="$selectionLimit" :picker-purpose="$pickerPurpose" :editor-key="$editorKey" />
    </main>
@endsection
