@extends('layouts.indexLayout')

@section('content')
    {{-- topbar --}}
    @include('partials.topbarPC')
    @include('partials.topbarMobile')
    {{-- hero --}}
    <div class="h-[70vh] w-full bg-simontini flex items-center z-20" >
        <div class="flex sm:flex-row flex-col gap-6 sm:items-end items-center">
            <img src="{{ asset('assets/simontini-wave-icon.png') }}" alt="Simontini" class="sm:h-[55vh] h-44 sm:-ml-56 -ml-32">
            <div class="sm:w-2/12 w-full flex flex-col gap-6 px-4">
                <a class="text-white text-4xl font-bold ">LOREM IPSUM DOLOR SI AMIT</a>
                <p class="text-white">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia. Itatur, quate possum nihille nimaio que minitas aut hictemp orecto.</p>
            </div>
        </div>
    </div>

    {{-- section 1 --}}
    <section class="max-w-4xl mx-auto mt-12 px-4">
        <div class="flex justify-center flex-col gap-6  items-center">
            <h2 class="text-4xl text-center font-bold text-simontini">LOREM IPSUM DOLOR SI AMIT</h2>
            <p class="sm:w-8/12 w-full text-center ">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia. Itatur, quate possum nihille nimaio que minitas aut hictemp orecto.</p>
        </div>

    </section>

    <div class="max-w-5xl mx-auto px-4  flex gap-6 py-12 scrollbar-hide overflow-x-scroll snap-x snap-mandatory">
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/about.png') }}" alt="simontini" class="h-16 mb-2">
            <a class="text-simontini font-bold">ABOUT</a>
            <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/insight.png') }}" alt="simontini" class="h-16 mb-2">
            <a class="text-simontini font-bold">INSIGHT</a>
            <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/map&data.png') }}" alt="simontini" class="h-16 mb-2">
            <a class="text-simontini font-bold">MAP & DATA</a>
            <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
        </div>
        <div class="relative w-56 h-64 sm:flex-shrink flex-shrink-0 snap-center rounded-lg shadow-simontini py-12 px-4">
            <img src="{{ asset('assets/donlot.png') }}" alt="simontini" class="h-16 mb-2">
            <a class="text-simontini font-bold">DOWNLOAD</a>
            <p class="text-sm mt-4">Lorem ipsum dolor si amit faccum qui dolorrovit quis exet qui sincia</p>
        </div>



    </div>

    {{-- insight --}}
    <div class="bg-insight sm:py-20 py-10">
        <div class="px-4 max-w-6xl mx-auto grid sm:grid-cols-5 grid-cols-1 sm:gap-10 gap-6">
            {{-- <div class="absolute  bottom-0 left-0   text-white w-3/12">
                <img src="assets/elemen-light.png" alt="auriga nusantara" class="z-10">
            </div> --}}
            <div class="sm:col-span-3 col-span-1">
                <img src="https://i.ytimg.com/vi/8Bicu7p6ZgY/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLDFs70iYak77WM2yZI4B9dnyl3sBg" alt="" class="w-full sm:h-96 h-full object-cover z-20">
            </div>
            <div class="px-4 sm:col-span-2 col-span-1">
                <div class="flex space-x-4 mt-6  items-center text-simontini">
                    <h1 class="font-semibold md:text-xl text-md">INSIGHT</h1>
                </div>
                <h1 class=" mt-5 sm:text-3xl text-xl font-bold text-simontini">
                    <a href="https://www.youtube.com/watch?v=8Bicu7p6ZgY">Koleksi 2.0 MapBiomas Indonesia                    </a>
                </h1>
                <div class=" mt-5 text-simontini">
                    <a class="font-bold"><i>Oct 2023</i></a><span> | </span><a> Telah diuji akurasi oleh 10 universitas dari Aceh hingga Papua, Koleksi 2.0 ini menyajikan data dan peta 11 kelas tutupan lahan di Indonesia, seperti hutan alam, mangrove, tambak, kebun kayu, sawit, sawah, lubang tambang. Tahun demi tahun, pun transisi antar-kelas tutupan, sejak 2000 hingga 2022. </a>
                </div>
            </div>
        </div>
    </div>

    {{-- methodology --}}
    <div class="max-w-5xl mx-auto px-4 mt-12">
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
    </div>

    {{-- footer  --}}
    <div class="bg-simontini">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <div class="border-b border-white flex justify-center gap-12 py-4">
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
