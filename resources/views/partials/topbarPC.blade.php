<section class="py-4 px-4 sm:block hidden sticky top-0 z-40 bg-white">
    {{-- <div class="max-w-7xl mx-auto flex justify-end">
        <div class="sm:block hidden -mt-3">
            <div class="flex space-x-2 text-gray-300 text-sm">
                <a href="{{ route(Route::currentRouteName(), 'en') }}"  class="cursor-pointer @if(App::getLocale() == 'en') text-simontini font-bold @endif">EN</a>
                <div class="border-l border-gray-300"></div>
                <a href="{{ route(Route::currentRouteName(), 'id') }}"  class="cursor-pointer @if(App::getLocale() == 'id') text-simontini font-bold @endif ">ID</a>
            </div>
        </div>
    </div> --}}
    <div class=" max-w-7xl  mx-auto flex w-full justify-between mt-3">
        <a href="{{ route('index', app()->getLocale()) }}" class="text-simontini">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="h-12">
        </a>
        <div class="space-x-6 flex justify-end items-center text-simontini">

            <div class="py-2 hover:border-b hover:border-simontini">
                <a href="#" class="font-normal ">ABOUT</a>
            </div>
            <div class="py-2 hover:border-b hover:border-simontini">
                <a href="#" class="font-normal ">INSIGHT</a>
            </div>

            <div class="py-2 hover:border-b hover:border-simontini @if($nav == 'map') border-b border-simontini @endif">
                <a href="{{ route('mapndata', app()->getlocale() )}}" class="font-normal ">MAP & DATA</a>
            </div>

            <div class="py-2 hover:border-b hover:border-simontini @if($nav == 'downloads') border-b border-simontini @endif">
                <a href="{{ route('downloads', app()->getLocale()) }}" class="font-normal ">DOWNLOAD</a>
            </div>
        </div>
    </div>
</section>
