@extends('layouts.indexLayout')

@section('meta')
    @include('partials.indexMeta')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <div class="h-[40vh] w-full bg-simontini flex  items-center z-20" >
        <div class="flex flex-col w-full justify-center items-center mt-24">
            <a class="sm:text-6xl text-3xl text-white font-bold tracking-wide">Insight</a>
            <div class="max-w-3xl mx-auto px-12 mt-4">
                <p class="mb-12 text-white text-center sm:text-base text-xs">{{__('Data dalam Simontini bersifat terbuka dan dapat diakses oleh publik sesuai lisensi Creative Commons CC-CY-SA, dengan mematuhi aturan penggunaannya. Pengutipan terhadap data dalam Simontini harap mengikuti format yang berlaku.')}}</p>
            </div>
        </div>
    </div>
    <div class="max-w-3xl mx-auto  sm:px-12 px-4 h-screen  py-12">

        <div class="pb-4 border-b border-simontini">
            @if (App::getLocale() == 'en')
                <a href="{{ url('/en/status-of-deforestation-in-indonesia-2024')}}" class="text-simontini font-bold sm:text-4xl text-2xl">{{__('Status of Deforestation in Indonesia')}} 2024</a>
            @else
                <a href="{{ url('/id/status-deforestasi-indonesia-2024') }}" class="text-simontini font-bold sm:text-4xl text-2xl">{{__('Status Deforestasi Indonesia')}} 2024</a>
            @endif
            <p class="sm:text-sm text-xs mt-4">{{__('Tahun lalu Auriga merilis data deforestasi 2023 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.')}}</p>
        </div>
    </div>
@endsection
