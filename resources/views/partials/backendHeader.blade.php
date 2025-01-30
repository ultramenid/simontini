<header class="max-w-6xl px-6 mx-auto pt-4 flex items-center justify-between py-6">
    <div class="flex items-center ">
       <div class="px-2">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="" class="w-40">
       </div>
    </div>

    {{-- // responsive pc--}}
    <div class=" flex">
        @include('partials.toogleProfile')
    </div>
 </header>
