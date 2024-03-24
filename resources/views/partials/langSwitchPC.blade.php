<div class="max-w-7xl mx-auto flex justify-end">
    <div class="sm:block hidden ">
        <div class="flex space-x-2 text-gray-300 text-sm">
            <a href="{{ route(Route::currentRouteName(), 'en') }}"  class="cursor-pointer @if(App::getLocale() == 'en') text-simontini font-bold @endif">EN</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ route(Route::currentRouteName(), 'id') }}"  class="cursor-pointer @if(App::getLocale() == 'id') text-simontini font-bold @endif ">ID</a>
        </div>
    </div>
</div>
