@extends('layouts.mapLayout')

@section('content')
<div class="sm:flex hidden" x-data=" {legend:true}">
    <div class="absolute top-2 rounded left-5"  style="z-index: 10000;">
        <div class="bg-white max-h-[90vh] bg-opacity-70 px-4 rounded mt-1 w-96 py-2 pb-12 overflow-y-auto scrollbar-hide"  >
            <div  class=" flex justify-between   items-center cursor-pointer" >
                <label  class="w-full mt-2 font-bold text-xl text-simontini">Legend </label>
            </div>


            <div class="px-2" style="display: none !important" x-show="legend" x-transition  :class="{'block': legend, 'hidden': !legend}" >
                <div class="flex flex-col py-4  text-sm border-b border-simontini" id="kawasanhutan" style="color: black !important; display:none">
                    <a class="text-xl  ">Kawasan Hutan</a>
                    <div class="flex items-center space-x-2 mt-2">
                        <div class="h-2 w-2 bg-hpk"></div>
                        <a class="text-black">Hutan Produksi yang Dapat Dikonversi</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-kk"></div>
                        <a class="text-black">Kawasan Konservasi</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-hl"></div>
                        <a class="text-black">Hutan Lindung</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-hpt"></div>
                        <a class="text-black">Hutan Produksi Terbatas</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-hp"></div>
                        <a class="text-black">Hutan Produksi Tetap</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-apl"></div>
                        <a class="text-black">Areal Penggunaan Lain</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-tubuhair"></div>
                        <a class="text-black">Tubuh Air</a>
                    </div>
                </div>

            </div>


        </div>
        <div class=" bottom-0  flex justify-center ">
            <div class="rounded-lg px-6 absolute -mt-4 z-30  bg-simontini bg-opacity-90 text-center" @click="legend=!legend">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke-width="0.1" stroke="none"  :class="{'rotate-180': legend, 'rotate-0': !legend}" class=" w-9 h-9 text-white transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" /></svg>
            </div>
        </div>

    </div>
    <div id="map" class="w-9/12 h-screen ">
        {{-- <div class="absolute top-2 right-5 px-4 py-2 " style="z-index: 10000; background-color: #d8d8d8;">
            <h1 class="mb-4 text-xl">Legend Color </h1>
            <div class="flex flex-col ">
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-hpk"></div>
                    <a class="text-black">Hutan Produksi yang Dapat Dikonversi</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-kk"></div>
                    <a class="text-black">Kawasan Konservasi</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-hl"></div>
                    <a class="text-black">Hutan Lindung</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-hpt"></div>
                    <a class="text-black">Hutan Produksi Terbatas</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-hp"></div>
                    <a class="text-black">Hutan Produksi Tetap</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-apl"></div>
                    <a class="text-black">Areal Penggunaan Lain</a>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-tubuhair"></div>
                    <a class="text-black">Tubuh Air</a>
                </div>
            </div>
        </div> --}}

    </div>
    <div class="w-3/12 h-full px-6" >
        <div class="w-full flex justify-center">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="h-12 mt-12">

        </div>
        <div class=" overflow-x-auto scrollbar-hide  justify-between px-4 flex gap-4  mt-6 border-b border-gray-300 z-30">
            <a class="whitespace-nowrap text-xs font-medium uppercase py-1 border-b-2 border-simontini">peta</a>
            <a href="{{ route('index', app()->getLocale()) }}" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">beranda</a>
            <a href="#" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">about</a>
            <a href="#" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">insight</a>
            <a href="{{ route('downloads', app()->getLocale()) }}" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">download</a>
        </div>
        <div class="py-6 flex flex-col gap-2" x-data="{open:'open1', test:[]}" >
            <div :class="(open === 'open1') ? 'h-filter overflow-y-auto border-black border px-4 py-1' : 'border-black border px-4 py-1 select-none cursor-pointer'"  @click="open='open1'">
                <div class="flex w-full justify-between items-center py-1">
                    <a class="font font-semibold text-sm ">Administration Boundaries</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col" x-show="open === 'open1'" style="display: none !important">
                    <x-checkbox idAttr="adminkabkota" layerName="administrative_boundaries">
                        Batas Administrasi Kab/Kota
                    </x-checkbox>

                </div>
            </div>
            <div :class="(open === 'open2') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open2'">
                    <a class="font font-semibold text-sm">Forest Changes</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open2'" style="display: none !important">
                    <x-checkbox idAttr="deforestasi2023" layerName="simontini:def_test 4326 v Thresholded">
                        Deforestasi 2023
                    </x-checkbox>

                </div>
            </div>
            <div :class="(open === 'open3') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open3'">
                    <a class="font font-semibold text-sm">Land Cover</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open3'" style="display: none !important">
                    <x-checkbox idAttr="hutanalam" layerName="simontini:Hutan_Alam_adm">
                        Hutan Alam
                    </x-checkbox>


                </div>
            </div>
            <div :class="(open === 'open4') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open4'">
                    <a class="font font-semibold text-sm">Land Use</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open4'" style="display: none !important">

                    <x-checkbox idAttr="hgu" layerName="kpa:HGU_BPN_2019">
                        Hak Guna Usaha
                    </x-checkbox>


                </div>
            </div>
            <div :class="(open === 'open5') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open5'">
                    <a class="font font-semibold text-sm">Land Status</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open5'" style="display: none !important">

                    <x-checkbox idAttr="kawasanhutan" layerName="simontini:Forest_estate_adm">
                        Kawasan Hutan
                    </x-checkbox>


                </div>
            </div>
            <div :class="(open === 'open6') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open6'">
                    <a class="font font-semibold text-sm">Biodiversity</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open6'" style="display: none !important">
                    <x-checkbox idAttr="kantonghabitat" layerName="simontini:KantongGajah2018RTM">
                        Kantong Habitat Gajah
                    </x-checkbox>

                </div>
            </div>
            <div :class="(open === 'open7') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open7'">
                    <a class="font font-semibold text-sm">Concession</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open7'" style="display: none !important">
                    <x-checkbox idAttr="pbph" layerName="simontini:PBPH_AR_50K_DESEMBER_2023">
                        <div class="bg-search flex items-center space-x-1 -ml-1" x-data="{ tooltip: 'Perizinan Berusaha Pemanfaatan Hutan' }">
                            <a class="">PBPH</a>
                            <svg xmlns="http://www.w3.org/2000/svg" x-tooltip="tooltip" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 cursor-pointer active:outline-none focus:outline-none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                              </svg>

                        </div>
                    </x-checkbox>
                    <x-checkbox idAttr="iup" layerName="simontini:2024 Momi Minerba 6 February">
                        Izin Usaha Pertambangan
                    </x-checkbox>

                </div>
            </div>
            <div class="fixed bottom-5 px-2">
                <div class="border-b-2 border-black h-6"></div>
            </div>
        </div>

    </div>
</div>

<div class="sm:hidden ">
    @include('partials.topbarMobile')
    <div class="h-screen w-full flex items-center justify-center">
        <a class="text-center text-gray-500">under development for mobile version</a>
    </div>
</div>


@endsection
@push('scripts')
    <script src="{{ asset('js/map.js') }} "></script>
@endpush
