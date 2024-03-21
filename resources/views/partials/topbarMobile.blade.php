<!-- {{-- nav mobile --}} -->
<header class="bg-simontini sticky top-0 z-20">
    <div x-data="{ open: false }" class="px-4 py-3 bg-auriga-biru z-10 sm:hidden block">
        <div class="flex justify-between items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white " viewBox="0 0 20 20" fill="currentColor" @click="open = true">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>

              {{-- <div class="flex gap-2 z-50">
                <a href="{{ route(Route::currentRouteName(), 'en') }}"  class="cursor-pointer  @if(App::getLocale() == 'en') text-white font-bold @else text-gray-700 @endif ">EN</a>
                <div class="border-l border-white"></div>
                <a href="{{ route(Route::currentRouteName(), 'id') }}"  class="cursor-pointer @if(App::getLocale() == 'id') text-white font-bold @else text-gray-700 @endif ">ID</a>
            </div> --}}
        </div>


        <div class="fixed w-3/4 h-screen z-50 bg-simontini inset-0 overflow-y-auto " x-show="open"
        x-transition:enter="transition-all transform ease-out"
        x-transition:enter-start="-translate-x-1/2 opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition-all transform ease-in"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-1/2 opacity-0"
        @click.outside="open = false"
        x-cloak style="display: none !important">
            <button class="absolute px-6 py-4 focus:outline-none text-white" @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="white" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
            </button>

            <div class="mt-16 space-y-3">
                <div class=" px-6">
                    <a href="https://auriga.or.id/"   class="mb-4 px-4 inline-block  leading-5 text-white text-xl font-semibold ">home<a>
                    <p class="border-b border-gray-300"></p>
                </div>
                <div class=" px-6">
                    <a href="https://auriga.or.id/who_we_are"  class="mb-4 px-4 inline-block  leading-5 text-white text-xl font-semibold ">who we are<a>
                    <p class="border-b border-gray-300"></p>
                </div>
                <div class=" px-6" x-data="{open1: false}">
                    <div class="flex items-center py-1   px-4 mb-2" @click=" open1 =! open1">
                        <a class=" leading-5 text-white text-xl font-semibold ">our work </a>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open1, 'rotate-0': !open1}" class="inline w-6 h-6 text-white items-center mt-1 ml-1 transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="bg-white px-4 py-3 mb-4 flex flex-col space-y-2 rounded" x-show="open1" style="display: none !important;">
                            <a href="https://auriga.or.id/our_work/event" class=" mr-6 text-auriga-biru">event</a>
                            <a href="https://auriga.or.id/our_work/activities" class=" mr-6 text-auriga-biru">activities</a>
                    </div>
                    <p class="border-b border-gray-300"></p>
                </div>

                <div class=" px-6" x-data="{open1: false}">
                    <div class="flex items-center py-1   px-4 mb-2" @click=" open1 =! open1">
                        <a class=" leading-5 text-white text-xl font-semibold ">resources </a>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open1, 'rotate-0': !open1}" class="inline w-6 h-6 text-white items-center mt-1 ml-1 transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="bg-white px-4 py-3 mb-4 flex flex-col space-y-2 rounded" x-show="open1" style="display: none !important;">
                            <a href="https://auriga.or.id/resources/report" class=" mr-6 text-auriga-biru">reports</a>
                            <a href="https://auriga.or.id/resources/related" class=" mr-6 text-auriga-biru">related</a>
                            <a href="https://auriga.or.id/resources/press_release" class=" mr-6 text-auriga-biru">press release</a>
                    </div>
                    <p class="border-b border-gray-300"></p>
                </div>



            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 -py-2 sm:block hidden">
        <div class="flex justify-between px-3">
            <a></a>
        </div>
    </div>
</header>
