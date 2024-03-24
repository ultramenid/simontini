@extends('layouts.indexLayout')

@section('meta')
    @include('partials.indexMeta')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <div class="h-[40vh] w-full bg-simontini flex  items-center z-20" >
        <div class="flex flex-col w-full justify-center items-center mt-24">
            <a class="sm:text-6xl text-3xl text-white font-bold tracking-wide">Downloads</a>
            <div class="max-w-3xl mx-auto px-12 mt-4">
                <p class="mb-12 text-white text-center sm:text-base text-xs">{{__('Data dalam Simontini bersifat terbuka dan dapat diakses oleh publik sesuai lisensi Creative Commons CC-CY-SA, dengan mematuhi aturan penggunaannya. Pengutipan terhadap data dalam Simontini harap mengikuti format yang berlaku.')}}</p>
            </div>
        </div>
    </div>
    <div class="max-w-3xl mx-auto  sm:px-12 px-4 h-screen  py-12">

        <div class="pb-4 border-b border-simontini">
            <a class="text-simontini font-bold sm:text-4xl text-2xl">{{__('Deforestasi Indonesia 2023')}}</a>
            <div class="flex gap-4">
                [
                    <a target="_blank" href="https://aws.simontini.id/geoserver/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=simontini:Auriga - Deforestasi 2023&outputFormat=SHAPE-ZIP" x-show="download" class=" flex items-center cursor-pointer text-atas">{{__('peta digital')}}</a>
                    |
                    @if (app()->getLocale() == 'id')
                        <a target="_blank" href="{{ asset('presentation/Deforestasi_Indonesia-2023-paparan.pdf') }}"  class=" flex items-center cursor-pointer text-atas">presentasi</a>
                    @else
                        <a target="_blank" href="{{ asset('presentation/Indonesia_deforestation_2023-presentation.pdf') }}"  class=" flex items-center cursor-pointer text-atas">presentation</a>
                    @endif
                ]
            </div>
            <p class="sm:text-sm text-xs mt-4">{{__('Sitasi:')}} <br> Auriga Nusantara. 2024. <a class="underline" href="https://aws.simontini.id/geoserver/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=simontini:Auriga - Deforestasi 2023&outputFormat=SHAPE-ZIP">Deforestasi Indonesia 2023</a>, {{__('diakses pada')}} [DD/MM/YYYY] {{__('melalui tautan')}} [LINK].</p>
        </div>
    </div>
@endsection
