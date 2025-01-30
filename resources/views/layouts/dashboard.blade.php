<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
    {{-- <script src="https://cdn.tiny.cloud/1/u8796ra33q2xzev2yc0sk74jz87306h16mmdidnrskwfwusb/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body class="font-sans  bg-gray-100 dark:bg-newgray-900">
    <x-toaster-hub />
    @yield('content')


    @stack('scripts')
</body>
</html>
