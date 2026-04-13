@extends('layouts.indexLayout')

@section('meta')
    @include('partials.indexMeta')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <div class="h-[40vh] w-full bg-simontini flex  items-center z-20" >
        <div class="flex flex-col w-full justify-center items-center mt-24">
            <a class="sm:text-6xl text-3xl text-white font-bold tracking-wide">Deforestasi 2025</a>
            <div class="max-w-3xl mx-auto px-12 mt-4">
                <p class="mb-12 text-white text-center sm:text-base text-xs">{{__('Data dalam Simontini bersifat terbuka dan dapat diakses oleh publik sesuai lisensi Creative Commons CC-CY-SA, dengan mematuhi aturan penggunaannya. Pengutipan terhadap data dalam Simontini harap mengikuti format yang berlaku.')}}</p>
            </div>
        </div>
    </div>

@endsection
