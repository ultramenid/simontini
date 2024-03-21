@extends('layouts.mapLayout')

@section('content')
<div class="flex">
    <div id="map" class="w-9/12 h-screen "></div>
    <div class="w-3/12 h-full px-6" >
        <div class="w-full flex justify-center">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="h-12 mt-12">

        </div>
        <div class=" overflow-x-auto scrollbar-hide  justify-between px-4 flex gap-4  mt-6 border-b border-gray-300 z-30">
            <a class="whitespace-nowrap text-xs font-medium uppercase py-1 border-b-2 border-simontini">peta</a>
            <a href="{{ route('index', app()->getLocale()) }}" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">beranda</a>
            <a href="#" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">about</a>
            <a href="#" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">insight</a>
            <a href="#" class="whitespace-nowrap text-xs font-medium uppercase cursor-pointer py-1">download</a>
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
                    <x-checkbox idAttr="adminkabkota" layerName="simontini:Forest_estate_adm">
                        Batas Administrasi Kab/Kota
                    </x-checkbox>
                    <x-checkbox idAttr="bataslaut" layerName="simontini:Forest_estate_adm">
                        Batas Laut Negara
                    </x-checkbox>
                    {{-- <x-checkbox idAttr="batadaratnegara">
                        Batas Darat Negara
                    </x-checkbox>
                    <x-checkbox idAttr="batasprovinsi">
                        Batas Administrasi Provinsi
                    </x-checkbox>
                    <x-checkbox idAttr="bataskecamatan">
                        Batas Administrasi Kecamatan
                    </x-checkbox>
                    <x-checkbox idAttr="batasadmindesa">
                        Batas Administrasi Desa
                    </x-checkbox>
                    <x-checkbox idAttr="garispantai">
                        Garis Pantai
                    </x-checkbox> --}}
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
                    <label for="burnarea" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="burnarea" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Burn Area</span>
                    </label>
                    <label for="tatabatas" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="tatabatas" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Deforestation</span>
                    </label>
                    <label for="tatabatas" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="tatabatas" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Forest Degradation </span>
                    </label>



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

                    <label for="hutanalam" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="hutanalam" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-xs font-medium text-gray-300 peer-checked:text-black ">Hutan Alam</span>
                    </label>
                    <label for="mapbiomas" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="mapbiomas" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-xs font-medium text-gray-300 peer-checked:text-black ">Mapbiomas </span>
                    </label>
                    <label for="komoditas" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="komoditas" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-xs font-medium text-gray-300 peer-checked:text-black ">Komoditas </span>
                    </label>
                    <label for="infrastruktur" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="infrastruktur" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-xs font-medium text-gray-300 peer-checked:text-black ">Infrastruktur </span>
                    </label>
                    <label for="pemukiman" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="pemukiman" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-xs font-medium text-gray-300 peer-checked:text-black ">Pemukiman </span>
                    </label>


                </div>
            </div>
            <div :class="(open === 'open4') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open4'">
                    <a class="font font-semibold text-sm">Land Usetinus</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open4'" style="display: none !important">
                    <label for="hgu" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="hgu" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Hak Guna Usaha</span>
                    </label>
                    <label for="perizinan" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="perizinan" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Perizinan</span>
                    </label>
                    <label for="konsesi" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="konsesi" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Konsesi </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Hak atas tanah </span>
                    </label>



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
                    <label for="kawasanhutan" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="kawasanhutan" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Kawasan Hutan </span>
                    </label>
                    <label for="perancanganruang" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="perancanganruang" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Perancangan Ruang</span>
                    </label>
                    <label for="kawasanhutan" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="kawasanhutan" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Kawasan Hutan </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Moratorium Hutan dan Gambut </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Protected Areas </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Das </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">KLHS </span>
                    </label>

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

                    <label for="kantonghabitat" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="kantonghabitat" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Kantong Habitat Gajah</span>
                    </label>
                    <label for="konfliksatwa" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="konfliksatwa" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Sebaran Konflik Satwa </span>
                    </label>
                    <label for="haktanah" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="haktanah" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">HCV/HCS </span>
                    </label>


                </div>
            </div>
            <div :class="(open === 'open7') ? 'h-filter overflow-y-auto border-black border px-4 py-1'  : 'border-black border px-4 py-1 select-none cursor-pointer'" >
                <div class="flex w-full justify-between items-center py-1" @click="open='open7'">
                    <a class="font font-semibold text-sm">Potensi</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </div>
                <div class="w-full mt-2 flex flex-col gap-1" x-show="open === 'open7'" style="display: none !important">

                    <label for="potensiminerba" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensiminerba" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Pertambangan Minerba</span>
                    </label>
                    <label for="potensibanjir" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensibanjir" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Banjir </span>
                    </label>
                    <label for="potensierosi" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensierosi" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Erosi </span>
                    </label>
                    <label for="potensilongsor" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensilongsor" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Longsor </span>
                    </label>
                    <label for="potensitsunami" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensitsunami" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Tsunami </span>
                    </label>
                    <label for="potensigempa" class="inline-flex relative lg:flex-row flex-col  mb-2 cursor-pointer items-center">
                        <input type="checkbox" value="" id="potensigempa" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                        <span class="ml-1 text-sm font-medium text-gray-300 peer-checked:text-black ">Potensi Gempa </span>
                    </label>


                </div>
            </div>
            <div class="fixed bottom-5 px-2">
                <div class="border-b-2 border-black h-6"></div>
            </div>
        </div>

    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ asset('js/map.js') }} "></script>
@endpush
