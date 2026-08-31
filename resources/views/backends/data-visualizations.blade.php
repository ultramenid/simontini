@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="mx-auto max-w-6xl px-6 py-8">
        <livewire:data-visualization-index />
    </main>
@endsection
