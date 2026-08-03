@extends('layouts.dashboard')

@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    <main class="max-w-6xl mx-auto px-6 py-8">
        <livewire:deforestory-index />
    </main>
@endsection
