@php
    $languageRouteParameters = request()->route()?->parameters() ?? [];
    $languageParameter = array_key_exists('locale', $languageRouteParameters) ? 'locale' : 'lang';
    $languageRouteName = Route::currentRouteName();
    $languageUrl = function (string $language) use ($languageRouteName, $languageRouteParameters, $languageParameter): string {
        $parameters = [...$languageRouteParameters, $languageParameter => $language];

        if (str_starts_with((string) $languageRouteName, 'deforestation.preview.')) {
            $expiresAt = request()->integer('expires')
                ? \Carbon\Carbon::createFromTimestamp(request()->integer('expires'))
                : now()->addDays(7);

            return URL::temporarySignedRoute($languageRouteName, $expiresAt, $parameters);
        }

        return route($languageRouteName, $parameters);
    };
@endphp

<div class="max-w-7xl mx-auto flex justify-end">
    <div class="sm:block hidden ">
        <div class="flex space-x-2 text-gray-300 text-sm">
            <a href="{{ $languageUrl('en') }}"  class="cursor-pointer @if(App::getLocale() == 'en') text-simontini font-bold @endif">EN</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ $languageUrl('id') }}"  class="cursor-pointer @if(App::getLocale() == 'id') text-simontini font-bold @endif ">ID</a>
        </div>
    </div>
</div>
