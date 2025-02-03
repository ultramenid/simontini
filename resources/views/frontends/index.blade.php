@extends('layouts.indexLayout')

@section('meta')
    @include('partials.indexMeta')
@endsection

@section('content')
    {{-- topbar --}}
    @include('partials.topbarPC')
    @include('partials.topbarMobile')
    {{-- hero --}}
    <div class="h-[70vh] w-full bg-simontini sm:flex hidden items-center z-20" >
        <div class="flex sm:flex-row flex-col items-center">

            <img src="{{ asset('assets/simontini-wave-icon.png') }}" alt="Simontini" class="sm:h-[55vh] h-44 sm:-ml-56 -ml-32">
            <div class="sm:w-4/12 w-full flex flex-col gap-6 px-4 mt-24">
                <a class="text-white sm:text-4xl text-2xl font-bold ">{{__('SISTEM INFORMASI TUTUPAN DAN IZIN DI INDONESIA')}}</a>
                {{-- <p class="text-white">Menyajikan data, informasi, dan analisis tutupan lahan dan izin di Indonesia.</p> --}}
            </div>
        </div>
    </div>

    {{-- section 1 --}}
    <section class="max-w-4xl mx-auto mt-12 px-4">
        <div class="flex justify-center flex-col gap-6  items-center">
            <h2 class="text-4xl text-center font-bold text-simontini">SIMONTINI</h2>
            <p class="sm:w-8/12 w-full text-center text-xl">{{__('Menyajikan data, informasi, dan analisis tutupan lahan dan izin di Indonesia.')}}</p>
        </div>

    </section>

    <div class="max-w-5xl mx-auto px-4  flex gap-6 py-12 scrollbar-hide overflow-x-scroll snap-x snap-mandatory">
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/about.png') }}" alt="simontini" class="h-16 mb-2">
            <a class="text-simontini font-bold">ABOUT</a>
            <p class="text-sm mt-4">{{__('Seluk-beluk Sistem Informasi Tutupan dan Izin.')}}  </p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/insight.png') }}" alt="simontini" class="h-16 mb-2">
            <a href="{{ route('insight', app()->getLocale()) }}" class="text-simontini font-bold">INSIGHT</a>
            <p class="text-sm mt-4">{{__('Analisis hal-hal spesifik perihal tutupan dan izin.')}}</p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/map&data.png') }}" alt="simontini" class="h-16 mb-2">
            <a href="{{ route('mapndata', app()->getLocale()) }}" class="text-simontini font-bold">MAP & DATA</a>
            <p class="text-sm mt-4">{{__('Memuat peta & data tutupan lahan dan izin.')}}</p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/donlot.png') }}" alt="simontini" class="h-16 mb-2">
            <a href="{{ route('downloads', app()->getLocale()) }}" class="text-simontini font-bold">DOWNLOAD</a>
            <p class="text-sm mt-4">{{__('Peta & data tutupan lahan atau izin yang dapat diakses.')}}</p>
        </div>



    </div>

    {{-- insight --}}
    <div class="bg-insight sm:py-20 py-10 ">
        <div class="px-4 max-w-6xl mx-auto grid sm:grid-cols-5 grid-cols-1 sm:gap-10 gap-0">
            {{-- <div class="absolute  bottom-0 left-0   text-white w-3/12">
                <img src="assets/elemen-light.png" alt="auriga nusantara" class="z-10">
            </div> --}}
            <div class="sm:col-span-3 col-span-1">
                <img src="https://i.ytimg.com/vi/avXNUj9EgEI/hq720.jpg" alt="" class="w-full sm:h-96 h-full object-cover z-20">
            </div>
            <div class="px-4 sm:col-span-2 col-span-1">

                <h1 class=" sm:text-3xl text-xl font-bold text-simontini">
                    <p href="https://youtu.be/avXNUj9EgEI?si=gRV0rh-LQN1MF3-D" class="text-sm text-rilisdata font-light">{{__('RILIS DATA')}}</p>
                    <a href="https://youtu.be/avXNUj9EgEI?si=gRV0rh-LQN1MF3-D" >{{__('Deforestasi Indonesia')}} 2024</a>
                </h1>
                <div class=" mt-5 text-simontini">

                    <a  class="font-bold">{{__('Januari')}} 2025</a><span> | </span><a>{{__('Deforestasi Indonesia pada 2024 teridentifikasi seluas 261.575 hektare, meningkat 4.191 hetare dari deforestasi tahun sebelumnya yang tercatat seluas 257.384 hektare. ')}}</a>
                    <p class="mt-2">{{__('Diperlukan terobosan hukum untuk melindungi hutan alam tersisa. Saatnya Presiden Prabowo Subianto menerbitkan peraturan presiden yang memberikan perlindungan hukum terhadap seluruh hutan alam Indonesia, di mana pun berada.')}}</p>
                </div>

            </div>
        </div>
        <div class="px-4 max-w-6xl mx-auto grid sm:grid-cols-5 grid-cols-1 sm:gap-10 gap-0 mt-12">
            {{-- <div class="absolute  bottom-0 left-0   text-white w-3/12">
                <img src="assets/elemen-light.png" alt="auriga nusantara" class="z-10">
            </div> --}}
            <div class="sm:col-span-3 col-span-1">
                <img src="https://i.ytimg.com/vi/bz_nxXMTgeU/maxresdefault.jpg" alt="" class="w-full sm:h-96 h-full object-cover z-20">
            </div>
            <div class="px-4 sm:col-span-2 col-span-1">

                <h1 class=" sm:text-3xl text-xl font-bold text-simontini">
                    <p href="https://www.youtube.com/live/bz_nxXMTgeU?si=CfwYK2h0pZZ3bguJ" class="text-sm text-rilisdata font-light">{{__('RILIS DATA')}}</p>
                    <a href="https://www.youtube.com/live/bz_nxXMTgeU?si=CfwYK2h0pZZ3bguJ" >{{__('Deforestasi Indonesia')}} 2023</a>
                </h1>
                <div class=" mt-5 text-simontini">
                    <a  class="font-bold">{{__('Maret')}} 2024</a><span> | </span><a> {{__('Deforestasi di konsesi kebun kayu Mayawana Persada, Kalimantan Barat, mematikan asa tiadanya deforestasi di Indonesia pada 2023.')}}
                    </a>
                </div>
                <div class=" mt-2 text-simontini">
                    <a>{{__('Lantas, sepanjang 2023:')}}</a>
                    <ul class="list-disc  px-4">
                        <li>{{__('Berapa luas deforestasi di Indonesia?')}}</li>
                        <li>{{__('Di mana saja?')}}</li>
                        <li>{{__('Berapa luas di kawasan hutan dan APL')}}</li>
                        <li>{{__('Adakah di kawasan konservasi?')}}</li>
                        <li>{{__('Konsesi dan perusahaan apa saja?')}}</li>
                        <li>{{__('Siapa deforester terbesar?')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- methodology --}}
    {{-- <div class="max-w-5xl mx-auto px-4 mt-12">
        <div class="flex justify-center flex-col gap-6  items-center">
            <h2 class="text-4xl text-center font-bold text-simontini">METHODOLOGY</h2>
            <p class="sm:w-8/12 w-full text-center ">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia. Itatur, quate possum nihille nimaio que minitas aut hictemp orecto.</p>
        </div>

        <div class="flex gap-6 py-12">
            <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg  py-12 px-4">
                <a class="text-simontini font-bold">METHODOLOGY 1</a>
                <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
            </div>
            <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg  py-12 px-4">
                <a class="text-simontini font-bold">METHODOLOGY 2</a>
                <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
            </div>
            <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg  py-12 px-4">
                <a class="text-simontini font-bold">METHODOLOGY 3</a>
                <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
            </div>
            <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg  py-12 px-4">
                <a class="text-simontini font-bold">METHODOLOGY 4</a>
                <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
            </div>
        </div>
    </div> --}}

    {{-- footer  --}}
    <div class="bg-simontini">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <div class="border-b border-white sm:flex hidden justify-center gap-12 py-4">
                <a class="text-white font-light">ABOUT</a>
                <a class="text-white font-light">INSIGHT</a>
                <a class="text-white font-light">MAP & DATA</a>
                <a class="text-white font-light">DOWNLOAD</a>
            </div>
            <div class=" flex justify-center gap-2 py-4 text-sm">
                <a class="text-white font-light">@ 2024</a>
                <a class="text-white font-light">|</a>
                <a class="text-white font-light">Simontini</a>
                <a class="text-white font-light">|</a>
                <a class="text-white font-light">Auriga Nusantara</a>

            </div>
        </div>
    </div>
@endsection
