@extends('layouts.indexLayout')

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <div class="h-[40vh] w-full bg-simontini sm:flex hidden items-center z-20" >
        <div class="flex flex-col w-full justify-center items-center mt-24">
            <a class="text-6xl text-white font-bold tracking-wide">Downloads</a>
            <div class="max-w-3xl mx-auto px-12 mt-4">
                <p class="mb-12 text-white text-center">Data dalam Simontini bersifat terbuka dan dapat diakses oleh publik sesuai lisensi Creative Commons CC-CY-SA, dengan mematuhi aturan penggunaannya. Pengutipan terhadap data dalam Simontini harap mengikuti format yang berlaku.</p>
            </div>
        </div>
    </div>
    <div class="max-w-3xl mx-auto  sm:px-12 px-4 h-screen  py-12">

        <div class="pb-4 border-b border-simontini">
            <a class="text-simontini font-bold text-4xl">Deforestasi Indonesia 2023</a>
            <div class="flex gap-4">
                [
                    <a target="_blank" href="https://aws.simontini.id/geoserver/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=simontini:def_test 4326 v Thresholded&outputFormat=SHAPE-ZIP" x-show="download" class=" flex items-center cursor-pointer text-atas">SHP</a>
                    <a target="_blank" href="{{ asset('presentation/simontinislide.pdf') }}" x-show="download" class=" flex items-center cursor-pointer text-atas">Presentation</a>
                ]
            </div>
            <p class="text-sm mt-4">SITASI: <br> Auriga Nusantara. 2024. <a class="underline" href="https://aws.simontini.id/geoserver/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=simontini:def_test 4326 v Thresholded&outputFormat=SHAPE-ZIP">Deforestasi Indonesia 2023</a>, diakses pada [DD/MM/YYYY] melalui tautan [LINK].</p>
        </div>
    </div>
@endsection
