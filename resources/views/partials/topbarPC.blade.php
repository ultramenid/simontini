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
            {{-- <div class="flex-col flex" x-data="{pages:false}">
                <a @click="pages = ! pages" @click.away="pages=false" class=" text-landy cursor-pointer inline-flex   items-center @if($nav == 'stadi') border-b border-simontini @endif ">STADI
                    <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': pages, 'rotate-0': !pages}" class="w-4 ml-1 -mb-1 transition-transform duration-200 transform rotate-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                <div class="absolute mt-8 z-20 bg-white px-2 py-2 flex flex-col  w-32 border-landy border-b text-landy" x-show="pages" style="display: none;">
                    <a href="{{ route('stadi2025', app()->getLocale()) }}" class="text-sm mr-6 hover:bg-gray-200 p-1">2025</a>
                    <a href="" class="text-sm mr-6 hover:bg-gray-200 p-1">2024</a>
                    <a href="" class="text-sm mr-6 hover:bg-gray-200 p-1">2023</a>
                </div>
            </div> --}}
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
