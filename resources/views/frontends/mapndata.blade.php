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
                    <x-checkbox idAttr="adminkabkota" >
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
                    <x-checkbox idAttr="burnarea" >
                        Burn Area
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
                    <x-checkbox idAttr="hutanalam" >
                        Hutan Alam
                    </x-checkbox>


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

                    <x-checkbox idAttr="hgu" >
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

                    <x-checkbox idAttr="kawasanhutan" >
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
                    <x-checkbox idAttr="kantonghabitat" >
                        Kantong Habitat Gajah
                    </x-checkbox>

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
                    [coming soon]

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
