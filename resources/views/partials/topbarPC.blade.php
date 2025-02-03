<section class="py-4 px-4 sm:block hidden sticky top-0 z-40 bg-white">
    @include('partials.langSwitchPC')
    <div class=" max-w-7xl  mx-auto flex w-full justify-between mt-3">
        <a href="{{ route('index', app()->getLocale()) }}" class="text-simontini">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="h-12">
        </a>
        <div class="space-x-6 flex justify-end items-center text-simontini">

            <div class="py-2 hover:border-b hover:border-simontini">
                <a href="#" class="font-normal ">ABOUT</a>
            </div>
            <div class="py-2 hover:border-b hover:border-simontini @if($nav == 'insight') border-b border-simontini @endif">
                <a href="{{ route('insight', app()->getLocale()) }}" class="font-normal ">INSIGHT</a>
            </div>

            <div class="py-2 hover:border-b hover:border-simontini @if($nav == 'map') border-b border-simontini @endif">
                <a href="{{ route('mapndata', app()->getlocale() )}}" class="font-normal ">MAP & DATA</a>
            </div>

            <div class="py-2 hover:border-b hover:border-simontini @if($nav == 'downloads') border-b border-simontini @endif">
                <a href="{{ route('downloads', app()->getLocale()) }}" class="font-normal ">DOWNLOADS</a>
            </div>
        </div>
    </div>
</section>
