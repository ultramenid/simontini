@extends('layouts.stadiLayout')

@section('meta')
    @include('partials.insightMeta')
@endsection

@section('content')


<!-- topbar -->
<div class="bg-white py-4 top-0 sticky z-30">

    <div class="max-w-7xl mx-auto relative z-10 px-6   flex  sm:gap-10 gap-6 items-center">
        <div class="flex space-x-2 text-gray-300 text-sm">
            <a href="{{ url('/en/status-of-deforestation-in-indonesia-2024')}}" class="cursor-pointer   ">EN</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ url('/id/status-deforestasi-indonesia-2024') }}" class="cursor-pointer  text-simontini font-bold ">ID</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ url('/jp/status-of-deforestation-in-indonesia-2024') }}" class="cursor-pointer   ">JP</a>
        </div>
        <a href="{{ route('index', 'id') }}" class="md:w-2/12 w-4/12"><img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="  sm:h-6 h-5 "></a>
        <div class=" w-8/12  flex sm:gap-6 gap-2 items-center overflow-auto no-scrollbar">
            <a class="text-simontini font-semibold md:text-base text-xs text-nowrap" href="#pendahuluan">Pendahuluan</a>
            <a class="text-simontini font-semibold md:text-base text-xs text-nowrap" href="#metodologi">Metodologi</a>
            <a class="text-simontini font-semibold md:text-base text-xs text-nowrap" href="#deforestasi2024">Deforestasi 2024</a>
            <a class="text-simontini font-semibold md:text-base text-xs text-nowrap" href="#diskusi">Diskusi</a>
            <a class="text-simontini font-semibold md:text-base text-xs text-nowrap" href="#rekomendasi">Rekomendasi</a>
        </div>
    </div>
</div>

<div id="loader" class=" px-6 fixed w-full min-h-screen z-50 overflow-hidden bg-white mx-auto inset-0 top-0 flex items-center justify-center">
    <img src="{{ asset('assets/logo-simontinus.png') }}" alt="simontini - stadi 2024" class="animate-pulse h-20">
</div>
<!-- Single Sticky Text -->
<div class="fixed z-10 md:bottom-56 bottom-2/3 md:left-[16%] left-5 md:w-[30%] w-[90%]" id="stickyText">
    <a class="md:text-5xl text-2xl text-white font-bold">Status Deforestasi Indonesia 2024</a>

</div>


<div id="parallax1" class="xl:hidden block md:h-screen h-[350px] overflow-hidden parallaxParent">
    <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-cover">
        <source src="https://simontini.id/assets/stadi2024/hero-1.MP4" type="video/mp4"> Your browser does not support the video tag.
    </video>
</div>


<div id="parallax2" class="xl:block hidden h-screen overflow-hidden parallaxParent">
    <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-center">
        <source src="https://simontini.id/assets/stadi2024/hero-1.MP4" type="video/mp4"> Your browser does not support the video tag.
    </video>
</div>



<div id="parallax1" class="md:hidden hidden h-screen overflow-hidden parallaxParent">
    <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-center">
        <source src="#" type="video/mp4"> Your browser does not support the video tag.
    </video>
</div>


<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div class="flex w-full justify-center">
        <p class=" md:text-xl text-base mt-2 italic text-center max-w-1xl">
            Tahun lalu Auriga merilis data deforestasi 2023 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.</p>
    </div>

    <div id="pendahuluan" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini block">PENDAHULUAN</h1>
        <p class="mt-6 leading-relaxed">Meski cenderung enggan–terlihat dari berbagai pernyataan penyelenggara negara, penolakan penggunaan terma, utak-atik definisi hutan, berbagai kebijakan yang masih membuka ruang–Pemerintah Indonesia pada dasarnya berupaya menekan deforestasi di
            Indonesia. Moratorium izin baru di hutan primer dan gambut dan FOLU Net Sink 2030 adalah contoh upaya tersebut.</p>
        <p class="mt-4 leading-relaxed">Namun demikian, data deforestasi tahunan Indonesia sejauh ini belum tersedia secara berkala, kecuali yang dipublikasi oleh Global Forest Watch kolaborasi Universitas Maryland dan World Resources Institute. Data deforestasi yang dirilis Pemerintah
            Indonesia melalui Kementerian Kehutanan, sebelumnya Kementerian Lingkungan Hidup dan Kehutanan, sejauh ini belum dapat disebut tahunan karena periodenya Juli-Juni sehingga, meski sepanjang 12 bulan, selalu mencakup bulan-bulan pada 2 tahun
            bersanding. Data deforestasi 12-bulan-an ini dipublikasi sejak 2012, setelah delapan publikasi sebelumnya per lintas-tahun (2012, 2009, 2006, 2003, 2000, 1996, dan 1990).</p>
        <p class="mt-4 leading-relaxed">Namun demikian, Pemerintah Indonesia hanya merilis data statistik deforestasi tersebut, tanpa disertai peta, sehingga menyulitkan untuk diverifikasi secara independen atau menyerap partisipasi publik. </p>
        <p class="mt-4 leading-relaxed">Perkembangan teknologi, terutama machine learning dan komputasi seperti Google Earth Engine, beserta tersedianya beragam citra satelit secara terbuka, seperti Landsat, Sentinel, dan Planet, mengakibatkan penyediaan data deforestasi tahunan, atau
            bahkan nyaris-kini (near real-time). Semangat transparansi dan partisipasi publik, guna menghentikan deforestasi, menjadi landasan Auriga Nusantara, yang juga menginisiasi dan mengkoordinir <a href="https://mapbiomas.id" target="_blank" class="underline text-simontini">MapBiomas Indonesia</a>,
            menghadirkan data deforestasi tahunan di setiap awal tahun.
        </p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/raden-1-2.jpg" class="glightbox1 mt-4" data-glightbox=" description: Tampak dari ketinggian bekas hutan alam yang ditebang di konsesi PT Anugerah Langkat Makmur. Foto: Februari 2024, ©Auriga Nusantara.">
        <img src="https://simontini.id/assets/stadi2024/raden-1-2.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
        <p class=" text-xs mt-2">Deforestasi untuk pembangunan kebun sawit PT Anugerah Langkat Makmur di Mandailing Natal, Sumatera Utara. Foto: Februari 2024, ©Auriga Nusantara.</p>
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="metodologi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini">METODOLOGI</h1>
        <p class="mt-6 leading-relaxed">Deforestasi yang dimaksud dalam kajian ini adalah hilangnya tutupan hutan alam, sehingga tidak menghitung kehilangan pada kebun kayu dan/atau hutan tanaman. Hutan alam merupakan asosiasi vegetasi yang didominasi tumbuhan berkayu yang tumbuh secara
            alami. Dengan demikian, hutan alam dalam terminologi ini mencakup baik hutan sekunder maupun hutan primer.</p>
        <p class="mt-4 leading-relaxed">Kebun kayu sendiri merupakan hamparan yang berisi tanaman berkayu yang dipanen secara periodik dalam rentang di bawah 10 tahun, sementara hutan tanaman adalah hamparan berisi tanaman berkayu namun tidak ditebang secara periodik di bawah 10 tahun.</p>
        <p class="mt-4 leading-relaxed">Kebun kayu di Indonesia dapat berupa hamparan kayu penghasil pulp atau kayu energi, yang oleh Kementerian Kehutanan disebut “hutan tanaman”, sehingga dimasukkan dalam kategori agrikultur atau pertanian. Hutan tanaman menurut kategori yang dibangun
            Auriga Nusantara semisal hamparan jati di Pulau Jawa, dan dikategorikan hutan.
        </p>
        <p class="mt-4 leading-relaxed">
            Deforestasi 2024 ini dihasilkan melalui tiga tahapan berikut: {{-- tahap-1 --}}
            <h1 class="leading-relaxed mt-4"> <b>1. Deteksi dugaan deforestasi.</b> Dugaan deforestasi diperoleh dengan dua pendekatan:</h1>
            <ul class="list-[lower-alpha] pl-12">
                <li class="leading-relaxed mt-4"><i>Deforestation alert</i> bulanan. Dugaan deforestasi bulanan ini dibangun dengan memanfaatkan alert deforestasi bulanan yang dikembangkan University of Maryland. <i>Alert</i> tersebut ditampalkan (<i>overlay</i>) dengan tutupan hutan
                    2023 MapBiomas Indonesia (yang akan dirilis dalam waktu dekat) sehingga terbuang alert di luar tutupan hutan (<i>false)</i>. Alert yang berada dalam tutupan hutan (<i>true</i>) kemudian diperluas (di-<i>buffer</i>) radius 1,5 kilometer
                    atau disebut <i>scope area</i> (area tercakup). <i>Scope area</i> setiap bulan sepanjang 2024 ini, setelah membuang area tertutup awan yang dideteksi sebagai deforestasi, diklasifikasi dengan metode <i>change detection</i> terhadap
                    tutupan hutan pada akhir Desember 2023. Hasil klasifikasi ini selanjutnya di-filter secara temporal dan spasial guna memastikan kejadian deforestasi dan menghapus area di bawah <i>minimum mapping unit</i> (0,25 hektare).
                </li>
                <li class="mt-4">
                    <p class="leading-relaxed">Dugaan deforestasi tahunan. Dugaan deforestasi tahunan diidentifikasi berdasarkan perubahan nilai indeks vegetasi (NDVI - Normalized Difference Vegetation Index) terhadap tutupan hutan alam. NDVI diperoleh melalui ekstraksi Red band
                        (kanal merah) dan NIR (Near-Infrared) pada citra satelit NICFI/Planet resolusi 4,7 meter. Berdasarkan pengukuran Tim Auriga Nusantara, nilai indeks vegetasi hutan alam berada pada nilai lebih dari 0,8 (pada rentang -1 sampai +1,
                        yang mana NDVI area bervegetasi > 0,5), dan pengurangan NDVI lebih dari 0,2 terdeteksi sebagai deforestasi.</p>
                    <p class="mt-4 leading-relaxed">Patokan (baseline, atau T0) hutan alam dibangun dari kesesuaian (agreement) tutupan hutan alam 2017 MapBiomas Indonesia Koleksi 3–akan dirilis dalam waktu dekat– dan data tutupan vegetasi (Global Forest Canopy Height) yang dikembangkan
                        oleh University of Maryland. Dengan demikian, tahun analisis (Tx) adalah 2018 dan tahun-tahun setelahnya, termasuk 2024. Pemilihan tahun awal ini disesuaikan dengan ketersediaan data citra satelit NICFI/Planet yang mencakup seluruh
                        wilayah Indonesia. Selisih NDVI diukur pada waktu/semester/kuartal yang sama pada tahun analisis dengan T0.</p>
                    <p class="mt-4 leading-relaxed">Selanjutnya, untuk menghindarkan noise akibat tutupan/bayangan awan, dilakukan penyaringan (filtering) dengan membandingkannya terhadap area hutan alam tersisa (remaining forest mask) yang diperoleh dengan pengurangan baseline hutan
                        alam dengan seluruh alert yang tersedia pada GLAD (Global Land Analysis and Discovery) dan RADD (Radar for Detecting Deforestation) sejak 2019. Sementara, spatial filter diterapkan untuk membuang area di bawah minimum mapping unit
                        yang luasnya sebesar 100 pixel connected atau 250 meter persegi (0,025 ha).</p>
                    <p class="mt-4 leading-relaxed">Seluruh pengolahan dan analisis data dilakukan dalam platform Google Earth Engine (GEE), termasuk pemanfaatan teknologi komputasi virtual (cloud-based computing) yang dimilikinya.</p>
                    <p class="mt-4 leading-relaxed">Data yang dihasilkan kedua pendekatan tersebut kemudian digabungkan (merge) sehingga diperoleh 968.845 area (poligon) deforestasi yang keseluruhannya seluas 299.650 hektare.</p>
                </li>

            </ul>

            {{-- tahap-2 --}}
            <h2 class="leading-relaxed mt-4"><b>2. Inspeksi visual.</b> Area dugaan deforestasi di atas selanjutnya diinspeksi secara visual. Poligon demi poligon dugaan deforestasi dicek pada citra satelit NICFI/Planet resolusi 3 meter sepanjang 2024. Menimbang banyaknya poligon deforestasi, Auriga Nusantara memutuskan hanya menginspeksi seluruh dugaan deforestasi pada skala luas > 1 hektare.</h2>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative mt-6">
    {{-- table-1 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">HASIL INSPEKSI/VERIFIKASI</h3>
    <div class="overflow-x-auto w-full">
        <table class="border h-[200px] w-full border-black text-sm text-white">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th rowspan="2" class="border border-black px-4 py-2">KELAS LUAS (ha)</th>
                    <th colspan="2" class="border border-black px-4 py-2">DUGAAN DEFORESTASI</th>
                    <th colspan="4" class="border border-black px-4 py-2">HASIL INSPEKSI / VERIFIKASI</th>
                </tr>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-black px-4 py-2">POLIGON</th>
                    <th class="border border-black px-4 py-2">LUAS (ha)</th>
                    <th class="border border-black px-4 py-2">POLIGON TRUE</th>
                    <th class="border border-black px-4 py-2">POLIGON FALSE</th>
                    <th class="border border-black px-4 py-2">LUAS TRUE (ha)</th>
                    <th class="border border-black px-4 py-2">LUAS FALSE (ha)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700">
                <tr>
                    <td class="border border-black px-4 py-2">
                        < 1</td>
                            <td class="border border-black px-4 py-2 text-right">351.718</td>
                            <td class="border border-black px-4 py-2 text-right">72.762</td>
                            <td class="border border-black px-4 py-2 text-right">351.718*</td>
                            <td class="border border-black px-4 py-2"></td>
                            <td class="border border-black px-4 py-2">72.762*</td>
                            <td class="border border-black px-4 py-2"></td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">1 - 5</td>
                    <td class="border border-black px-4 py-2 text-right">35.533</td>
                    <td class="border border-black px-4 py-2 text-right">73.345</td>
                    <td class="border border-black px-4 py-2 text-right">28.756</td>
                    <td class="border border-black px-4 py-2 text-right">6.777</td>
                    <td class="border border-black px-4 py-2 text-right">60.077</td>
                    <td class="border border-black px-4 py-2 text-right">13.268</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">5 - 10</td>
                    <td class="border border-black px-4 py-2 text-right">5.195</td>
                    <td class="border border-black px-4 py-2 text-right">35.471</td>
                    <td class="border border-black px-4 py-2 text-right">4.434</td>
                    <td class="border border-black px-4 py-2 text-right">761</td>
                    <td class="border border-black px-4 py-2 text-right">30.306</td>
                    <td class="border border-black px-4 py-2 text-right">5.166</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">10 - 50</td>
                    <td class="border border-black px-4 py-2 text-right">3.117</td>
                    <td class="border border-black px-4 py-2 text-right">57.626</td>
                    <td class="border border-black px-4 py-2 text-right">2.566</td>
                    <td class="border border-black px-4 py-2 text-right">551</td>
                    <td class="border border-black px-4 py-2 text-right">47.563</td>
                    <td class="border border-black px-4 py-2 text-right">10.063</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">> 50</td>
                    <td class="border border-black px-4 py-2 text-right">408</td>
                    <td class="border border-black px-4 py-2 text-right">58.746</td>
                    <td class="border border-black px-4 py-2 text-right">344</td>
                    <td class="border border-black px-4 py-2 text-right">64</td>
                    <td class="border border-black px-4 py-2 text-right">50.868</td>
                    <td class="border border-black px-4 py-2 text-right">7.879</td>
                </tr>
                <tr class="bg-gray-800 font-bold">
                    <td class="border border-black px-4 py-2">TOTAL</td>
                    <td class="border border-black px-4 py-2 text-right">395.971</td>
                    <td class="border border-black px-4 py-2 text-right">297.950</td>
                    <td class="border border-black px-4 py-2 text-right">387.818</td>
                    <td class="border border-black px-4 py-2 text-right">8.153</td>
                    <td class="border border-black px-4 py-2 text-right font-bold text-xl underline">261.575</td>
                    <td class="border border-black px-4 py-2 text-right">36.375</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-sm">*Tidak diinspeksi</p>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    {{-- tahap-3 --}}
    <h2 class="leading-relaxed mt-4"><b>3. Pemantauan lapangan.</b> Pemantauan ini dilakukan terhadap area-area tertentu sepanjang 2024. Pemilihan area pemantauan didasarkan pada keterwakilan kategori, yakni geografis, tipologi kawasan hutan, proyek pemerintah, dan konsesi berbasis lahan (tambang, kebun kayu, logging, dan sawit).</h2>
    <p class="mt-4 leading-relaxed">
        Sepanjang 2024, tim peneliti Auriga Nusantara mengunjungi area-area deforestasi di Aceh, Sumatera Utara, Riau, Jambi, Bengkulu, Sumatera Selatan, Kalimantan Barat, Kalimantan Tengah, Kalimantan Timur, Kalimantan Utara, Sulawesi Tengah, Gorontalo, Maluku
        Utara, Papua Barat Daya, dan Provinsi Papua. Secara keseluruhan, area deforestasi 2024 yang dikunjungi tim peneliti Auriga Nusantara merepresentasi area deforestasi seluas 22.350 hektare.
    </p>

</div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/raden-2.jpg" class="glightbox2 mt-4" data-glightbox=" description: Hasil pantauan lapangan tim Auriga Nusantara memverifikasi adanya penebangan hutan alam di konsesi PT Kayan Kaltara Coal. Foto ini diambil Desember 2024.">
        <img src="https://simontini.id/assets/stadi2024/raden-2.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
        <p class=" text-xs mt-2">Hasil pantauan lapangan tim Auriga Nusantara memverifikasi adanya penebangan hutan alam di konsesi PT Kayan Kaltara Coal. Foto ini diambil Desember 2024.</p>
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="deforestasi2024" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini">DEFORESTASI 2024</h1>
        <p class="mt-6 leading-relaxed">
            Deforestasi Indonesia pada 2024 teridentifikasi seluas 261.575 hektare, meningkat 4.191 hektare dari deforestasi tahun sebelumnya yang tercatat seluas <a href="https://simontini.id/presentation/Deforestasi_Indonesia-2023-paparan.pdf" target="_blank"
            class="underline text-simontini">257.384</a> hektare. Deforestasi terjadi di seluruh pulau besar di Indonesia. Peningkatan deforestasi terjadi di Kalimantan dan Sumatera, sementara deforestasi di Sulawesi, Papua, Kepulauan Maluku, Jawa, Bali,
            dan Nusa Tenggara menurun.
        </p>

    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/Stadi20242.jpg" class="glightbox3 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi20242.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-10 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-6">
    <p class="mt-4 leading-relaxed">
        Deforestasi terjadi di seluruh provinsi Indonesia, kecuali DKI Jakarta. Bila 10 provinsi teratas deforestasi pada 2023 secara berurut adalah (1) Kalimantan Barat, (2) Kalimantan Tengah, (3) Kalimantan Timur, (4) Sulawesi Tengah, (5) Kalimantan Selatan,
        (6) Kalimantan Utara, (7) Riau, (8) Papua Selatan, (9) Papua Tengah, dan (10) Papua Barat; pada 2024 urutan ini dihuni (1) Kalimantan Timur, (2) Kalimantan Barat, (3) Kalimantan Tengah, (4) Riau, (5) Sumatera Selatan, (6) Jambi, (7) Aceh, (8)
        Kalimantan Utara, (9) Bangka Belitung, dan (10) Sumatera Utara.
    </p>

    {{-- table-2 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS PROVINSI DEFORESTASI, 2024 (hektare)</h3>
    <div class="flex sm:flex-row flex-col gap-2 mb-6 text-white w-full">
        <!-- 2023 Table -->
        <div class="sm:w-6/12 w-full">
            <table class="w-full border border-black text-lg text-white">
                <tbody class="bg-gray-800">
                    <tr>
                        <td class="px-4 py-4 font-bold text-2xl">2023</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Barat</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">35.162</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Tengah</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">30.433</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Timur</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">28.633</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Sulawesi Tengah</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">16.679</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Selatan</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">16.067</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Utara</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">14.316</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Riau</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">13.268</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Papua Selatan</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">12.640</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Papua Tengah</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">11.336</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Papua Barat</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">10.990</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 sm:text-base text-sm font-bold">27 provinsi lainnya</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm font-bold text-right">67.858</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 2024 Table -->
        <div class="sm:w-6/12 w-full">
            <table class="w-full border border-black text-lg text-white">
                <tbody class="bg-gray-800">
                    <tr>
                        <td class="px-4 py-4 font-bold text-2xl">2024</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Timur</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">44.483</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Barat</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">39.598</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Tengah</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">33.389</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Riau</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">20.812</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Sumatera Selatan</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">20.184</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Jambi</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">14.839</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Aceh</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">8.962</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Kalimantan Utara</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">8.767</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Bangka Belitung</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">7.956</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm">Sumatera Utara</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm text-right">7.303</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 sm:text-base text-sm font-bold">27 provinsi lainnya</td>
                        <td class="border border-black px-4 py-2 sm:text-base text-sm font-bold text-right">55.282</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <p class="mt-4 leading-relaxed">
        Pada 2024, deforestasi terjadi di 428 kabupaten/kota, atau pada 83% kabupaten/kota di Indonesia yang seluruhnya berjumlah 514. Terdapat 68 kabupaten yang memiliki deforestasi lebih dari 1.000 hektare. Sebagaimana terlihat pada tabel berikut, sembilan
        dari sepuluh teratas kabupaten yang mengalami deforestasi berada di Kalimantan.
    </p>

    {{-- table-3 --}}
    <h3 class="mt-6 text-simontini font-bold mb-2">SEPULUH TERATAS KABUPATEN YANG MENGALAMI DEFORESTASI, 2024</h3>
    <div class="text-white  mb-4 w-full overflow-auto">
        <table class="border border-black text-white  w-full">
            <thead class="bg-black">
                <tr>
                    <th class="border border-black px-6 py-2 font-bold text-left">KABUPATEN</th>
                    <th class="border border-black px-6 py-2 font-bold text-left">PROVINSI</th>
                    <th class="border border-black px-6 py-2 font-bold text-right">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800">
                <tr>
                    <td class="border border-black px-6 py-2 ">Kutai Timur</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">16.578</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">Berau</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">9.378</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">Ketapang</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">9.115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Musi Banyuasin</td>
                    <td class="border border-black px-6 py-2">Sumatera Selatan</td>
                    <td class="border border-black px-6 py-2 text-right">8.517</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kutai Kartanegara</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">7.887</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kapuas Hulu</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">7.340</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kutai Barat</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">6.364</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kapuas</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">5.589</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Sanggau</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">5.336</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Katingan</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">4.809</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold text-sm">418 kabupaten lainnya</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">180.663</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p class="mt-12 leading-relaxed">
        Dilihat dari segi status penguasaan lahan, 57% deforestasi terjadi pada lahan yang dikuasai negara atau kawasan hutan.
    </p>

</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/Stadi20245.jpg" class="glightbox4 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi20245.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-10 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>

    {{-- table-4 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI DI KONSESI LOGGING (HPH/PBPH HHK-HA)</h3>
    <div class="w-full overflow-auto bg-gray-800 ">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">KONSESI</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">PROVINSI</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-4 py-2">PT Panambangan</td>
                    <td class="border border-black px-4 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-4 py-2 text-right">5.485</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Kiani Lestari</td>
                    <td class="border border-black px-4 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-4 py-2 text-right">3.304</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Daya Maju Lestari (d.h. PT Marimun Timber IDS)</td>
                    <td class="border border-black px-4 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-4 py-2 text-right">2.641</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Putra Duta Indah Wood</td>
                    <td class="border border-black px-4 py-2 ">Jambi</td>
                    <td class="border border-black px-4 py-2 text-right">2.053</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Diamond Raya Timber</td>
                    <td class="border border-black px-4 py-2">Riau</td>
                    <td class="border border-black px-4 py-2 text-right">1.264</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Inhutani I (Unit Labanan)</td>
                    <td class="border border-black px-4 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-4 py-2 text-right">1.166</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Dasa Intiga</td>
                    <td class="border border-black px-4 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-4 py-2 text-right">805</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Anugerah Pratama Inspirasi</td>
                    <td class="border border-black px-4 py-2">Bengkulu</td>
                    <td class="border border-black px-4 py-2 text-right">796</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Austral Byna</td>
                    <td class="border border-black px-4 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-4 py-2 text-right">740</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Wana Kencana Sejati</td>
                    <td class="border border-black px-4 py-2">Maluku Utara</td>
                    <td class="border border-black px-4 py-2 text-right">689</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">244 konsesi logging lainnya</td>
                    <td class="border border-black px-4 py-2"></td>
                    <td class="border border-black px-4 py-2 text-right">17.124</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-4 py-2 font-bold">Total</td>
                    <td class="border border-black px-4 py-2 font-bold"></td>
                    <td class="border border-black px-4 py-2 font-bold text-right">36.068</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-5 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI DI KONSESI KEBUN KAYU (HTI/PBPH HHK-HTI)</h3>
    <div class="w-full bg-gray-800 overflow-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">KONSESI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">PROVINSI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="px-6 py-2 border border-black">PT Mayawana Persada</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Barat</td>
                    <td class="px-6 py-2 border border-black text-right">6.145</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Finnantara Intiga</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Barat</td>
                    <td class="px-6 py-2 border border-black text-right">1.551</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Sendawar Adhi Karya</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Timur</td>
                    <td class="px-6 py-2 border border-black text-right">1.170</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Industrial Forest Plantation</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Tengah</td>
                    <td class="px-6 py-2 border border-black text-right">1.105</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Meranti Laksana</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Barat</td>
                    <td class="px-6 py-2 border border-black text-right">918</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Grace Putri Perdana</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Barat - Kalimantan Tengah</td>
                    <td class="px-6 py-2 border border-black text-right">875</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Permata Borneo Abadi</td>
                    <td class="px-6 py-2 border border-black">Kalimantan Timur</td>
                    <td class="px-6 py-2 border border-black text-right">786</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Paramitra Mulia Langgeng</td>
                    <td class="px-6 py-2 border border-black">Lampung - Sumatera Selatan</td>
                    <td class="px-6 py-2 border border-black text-right">661</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Andalan Karya Pertiwi</td>
                    <td class="px-6 py-2 border border-black">Bangka Belitung</td>
                    <td class="px-6 py-2 border border-black text-right">661</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Perawang Sukses Perkasa</td>
                    <td class="px-6 py-2 border border-black">Riau</td>
                    <td class="px-6 py-2 border border-black text-right">660</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">270 konsesi kebun kayu lainnya</td>
                    <td class="px-6 py-2 border border-black"></td>
                    <td class="px-6 py-2 border border-black text-right">26.800</td>
                </tr>
                <tr class="bg-black">
                    <td class="px-6 py-2 font-bold border border-black">Total</td>
                    <td class="px-6 py-2 font-bold border border-black"></td>
                    <td class="px-6 py-2 font-bold border border-black text-right">41.332</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-6 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI DI KONSESI TAMBANG, 2024</h3>
    <div class="w-full bg-gray-800 overflow-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">KONSESI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">KOMODITI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="px-6 py-2 border border-black">PT Berau Coal</td>
                    <td class="px-6 py-2 border border-black">Batubara</td>
                    <td class="px-6 py-2 border border-black text-right">2.039</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Cita Mineral Investindo Tbk</td>
                    <td class="px-6 py-2 border border-black">Bauksit</td>
                    <td class="px-6 py-2 border border-black text-right">1.442</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Timah Tbk</td>
                    <td class="px-6 py-2 border border-black">Timah</td>
                    <td class="px-6 py-2 border border-black text-right">1.070</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Sumber Sentosa Bersama</td>
                    <td class="px-6 py-2 border border-black">Pasir kuarsa</td>
                    <td class="px-6 py-2 border border-black text-right">808</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Vale Tbk</td>
                    <td class="px-6 py-2 border border-black">Nikel</td>
                    <td class="px-6 py-2 border border-black text-right">689</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Battoman Coal</td>
                    <td class="px-6 py-2 border border-black">Batubara</td>
                    <td class="px-6 py-2 border border-black text-right">651</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Weda Bay Nickel</td>
                    <td class="px-6 py-2 border border-black">Nikel</td>
                    <td class="px-6 py-2 border border-black text-right">650</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Kayan Kaltara Coal</td>
                    <td class="px-6 py-2 border border-black">Batubara</td>
                    <td class="px-6 py-2 border border-black text-right">595</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Ridatama Cahaya Abadi</td>
                    <td class="px-6 py-2 border border-black">Bauksit</td>
                    <td class="px-6 py-2 border border-black text-right">540</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Aneka Tambang Tbk</td>
                    <td class="px-6 py-2 border border-black">Multi-komoditas</td>
                    <td class="px-6 py-2 border border-black text-right">497</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">1580 izin usaha pertambangan lainnya</td>
                    <td class="px-6 py-2 border border-black">Mineral & batubara</td>
                    <td class="px-6 py-2 border border-black text-right">29.635</td>
                </tr>
                <tr class="bg-black">
                    <td class="px-6 py-2 font-bold border border-black">Total deforestasi tambang</td>
                    <td class="px-6 py-2 font-bold border border-black"></td>
                    <td class="px-6 py-2 font-bold border border-black text-right">38.615</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-7 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI DI KONSESI SAWIT, 2024</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">KONSESI</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINSI</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">2.019</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">1.534</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Banyan Tumbuh Lestari</td>
                    <td class="border border-black px-6 py-2">Gorontalo</td>
                    <td class="border border-black px-6 py-2 text-right">1.521</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Uniseraya</td>
                    <td class="border border-black px-6 py-2">Riau</td>
                    <td class="border border-black px-6 py-2 text-right">1.408</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">1.347</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sawit</td>
                    <td class="border border-black px-6 py-2">Papua Barat Daya</td>
                    <td class="border border-black px-6 py-2 text-right">1.115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sejahtera</td>
                    <td class="border border-black px-6 py-2">Papua Barat Daya</td>
                    <td class="border border-black px-6 py-2 text-right">1.057</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">932</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Berkah Sawit Abadi</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">819</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Tewah Bahana Lestari</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">783</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">1.082 konsesi sawit lainnya</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">24.948</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">Total</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 font-bold text-right">37.483</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <p class="mt-12 leading-relaxed">Sebagian besar hutan alam yang hilang pada 2024 merupakan habitat spesies langka dan dilindungi di Indonesia. Tabel berikut memperlihatkan luas habitat megafauna ikonik (flagship species) yang dilindungi oleh regulasi di Indonesia.</p>

</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/Stadi202411.jpg" class="glightbox5 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi202411.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">

    <div id="diskusi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-20 text-simontini">DISKUSI</h1> {{-- diskusi-1--}}
        <h2 class="font-bold mt-6">1. Deforestasi legal sebagai ancaman terbesar</h2>
        <div id="diskusi-1" class="pl-5 ">
            <p class="mt-4 leading-relaxed">Sistem dan detail hukum Indonesia pada dasarnya tidak melarang deforestasi karena sepanjang pemerintah menerbitkan izin maka pada dasarnya pemilik izin dapat melakukan deforestasi. Sejak diberlakukannya Omnibus Law, proyek pemerintah dapat
                leluasa membabat hutan-hutan alam yang ada.</p>
            <p class="mt-4 leading-relaxed">
                Benar, bahwa di dalam konsesi pun perusahaan tidak boleh semena-mena melakukan deforestasi karena harus mendapatkan persetujuan rencana kerja tahunan (RKT) untuk konsesi kehutanan, atau rencana kerja anggaran dan biaya (RKAB) untuk konsesi pertambangan.
                Pada konsesi sawit, izin konversi dilakukan melalui pelepasan kawasan hutan. Yang menjadi masalah, pemerintah tidak pernah merilis RKT perusahaan kehutanan, RKAB perusahaan pertambangan, maupun peta detail pelepasan kawasan hutan untuk
                perusahaan sawit. Oleh karena itu, pembabatan hutan alam dalam izin konversi (kebun kayu, sawit, dan pertambangan) sangat terbuka dilakukan secara legal oleh pemilik/pengelola konsesi tersebut.
            </p>
            <p class="mt-4 leading-relaxed">
                Hanya 3% deforestasi 2024 yang terjadi di kawasan konservasi, sementara 5% terjadi di hutan lindung, 49% di hutan produksi, dan 43% di luar kawasan hutan. Ditelisik lebih dalam, sebagian besar deforestasi di hutan lindung dan hutan produksi terjadi di
                daerah berizin, baik sebagai pemanfaatan atau pengusahaan hutan (baca: konsesi) maupun program pemerintah, seperti proyek strategis nasional (PSN). Artinya, 97% deforestasi yang terjadi pada 2024 adalah dapat berupa deforestasi legal.
            </p>
        </div>
    </div>
</div>
{{-- slide-1 --}}
<div x-data="{ currentSlide: 0, totalSlides: 4 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-biomassa-mhl.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestasi untuk pembangunan kebun kayu energi dalam konsesi PT Malinau Hijau Lestari di Kalimantan Utara. Deforestasi ini berpotensi legal karena kawasan tersebut telah dilepaskan Kementerian Lingkungan Hidup dan Kehutanan dari kawasan hutan sehingga menjadi Area Penggunaan Lain (APL). Foto: Mei 2024 ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/1-biomassa-mhl.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun kayu energi dalam konsesi PT Malinau Hijau Lestari di Kalimantan Utara. Deforestasi ini berpotensi legal karena kawasan tersebut telah dilepaskan Kementerian Lingkungan Hidup dan Kehutanan dari kawasan hutan sehingga menjadi Area Penggunaan Lain (APL). Foto: Mei 2024 ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-biomassa-gorontalo.jpg" class="glightbox6 mt-4 gbox" data-glightbox="description: Deforestasi untuk pembangunan kebun kayu energi/biomassa di PT Banyan Tumbuh Lestari dan PT Inti Global Laksana di Gorontalo. Deforestasi ini berpotensi legal karena sebelumnya hutan alam tersebut telah dilepaskan oleh Kementerian Lingkungan Hidup dan Kehutanan untuk pembangunan kebun sawit atas nama kedua perusahaan tersebut. Namun, dokumentasi lapangan menunjukkan yang dibangun bukan kebun sawit, tapi kebun kayu energi untuk memasok pabrik PT Biomasa Jaya Abadi yang ada di dalam salah salah satu konsesi tersebut. Foto: Mei 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/1-biomassa-gorontalo.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun kayu energi/biomassa di PT Banyan Tumbuh Lestari dan PT Inti Global Laksana di Gorontalo. Deforestasi ini berpotensi legal karena sebelumnya hutan alam tersebut telah dilepaskan oleh Kementerian Lingkungan Hidup dan Kehutanan untuk pembangunan kebun sawit atas nama kedua perusahaan tersebut. Namun, dokumentasi lapangan menunjukkan yang dibangun bukan kebun sawit, tapi kebun kayu energi untuk memasok pabrik PT Biomasa Jaya Abadi yang ada di dalam salah salah satu konsesi tersebut. Foto: Mei 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-imip.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestasi untuk penambangan dan pembangunan kawasan industri nikel Indonesia Morowali Industrial Park di Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/1-imip.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi untuk penambangan dan pembangunan kawasan industri nikel Indonesia Morowali Industrial Park di Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/merauke-food-estate.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestasi demi pembangunan food estate di Merauke, Papua Selatan. Foto: September 2024, ©Tempo">
                <img src="https://simontini.id/assets/stadi2024/merauke-food-estate.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi demi pembangunan food estate di Merauke, Papua Selatan. Foto: September 2024, ©Tempo</p>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">

    {{-- diskusi-2 --}}
    <h2 class="font-bold mt-12">2. Deforestasi terbesar kembali terjadi di Kalimantan</h2>
    <div id="diskusi-2" class="pl-5">
        <p class="mt-4 leading-relaxed">Kalimantan kembali menjadi pulau pemilik deforestasi tahunan terluas pada 2024. Pulau ini mengalami deforestasi tahunan terluas secara beruntun pada sebelas tahun terakhir. Bahkan, berbeda dengan pulau lainnya yang relatif stagnan, deforestasi
            Kalimantan justru meningkat drastis setiap tahun sejak 2021.</p>

    </div>
</div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    <iframe src='https://flo.uri.sh/visualisation/21400168/embed' title='Simontini - stadi 2024' class='flourish-embed-iframe w-full h-full' frameborder='0' scrolling='no' style="height: 500px" sandbox='allow-same-origin allow-forms allow-scripts allow-downloads allow-popups allow-popups-to-escape-sandbox allow-top-navigation-by-user-activation'></iframe>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>
        <div>
            <p class="mt-4 leading-relaxed">
                Penunjukan satu daerah di Kabupaten Penajam Paser Utara menjadi Ibukota Negara (IKN) tampaknya menjadi salah satu musabab meningkatnya deforestasi ini, terlihat dari adanya usulan Pemerintah Provinsi Kalimantan Timur mengubah rencana tata ruang provinsi
                tersebut yang, bila disetujui, berdampak pelepasan atau berubahnya fungsi 736.055 hektare kawasan hutan eksisting. Demikian juga Kalimantan Utara mengajukan proses serupa yang berpotensi berdampak pada 762.947 hektare kawasan hutan eksisting.
                Salah satu argumen yang disampaikan kedua provinsi tersebut adalah pengembangan ekonomi sejalan dengan keberadaan IKN.
            </p>
            <p class="mt-4 leading-relaxed">
                Ditilik secara komoditas, deforestasi akibat pengembangan kebun kayu (29.898 ha), tambang (23.583 ha), dan sawit (23.430 ha) menjadi musabab utama deforestasi di Kalimantan. Deforestasi oleh ketiga komoditas ini mencakup 59% deforestasi di seluruh Pulau
                Kalimantan. Sepuluh teratas area deforestasi oleh pengembangan ketiga komoditas tersebut di Pulau Kalimantan pada 2024 adalah sebagai berikut:
            </p>
        </div>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    {{-- table-8 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI OLEH IZIN KONVERSI DI KALIMANTAN, 2024</h3>
    <div class="w-full overflow-auto bg-gray-800 mb-4">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PERUSAHAAN</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">KONSESI</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINSI</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTASI (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Mayawana Persada</td>
                    <td class="border border-black px-6 py-2">Kebun kayu</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">6.145</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Berau Coal</td>
                    <td class="border border-black px-6 py-2">Tambang batubara</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">2.039</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                    <td class="border border-black px-6 py-2">Sawit</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">2.019</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Finnantara Intiga</td>
                    <td class="border border-black px-6 py-2">Kebun kayu</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">1.551</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                    <td class="border border-black px-6 py-2">Sawit</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">1.534</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Cita Mineral Investindo Tbk</td>
                    <td class="border border-black px-6 py-2">Tambang bauksit</td>
                    <td class="border border-black px-6 py-2">Kalimantan Barat</td>
                    <td class="border border-black px-6 py-2 text-right">1.442</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                    <td class="border border-black px-6 py-2">Sawit</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">1.347</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Sendawar Adhi Karya</td>
                    <td class="border border-black px-6 py-2">Kebun kayu</td>
                    <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                    <td class="border border-black px-6 py-2 text-right">1.170</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Industrial Forest Plantation</td>
                    <td class="border border-black px-6 py-2">Kebun kayu</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">1.105</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                    <td class="border border-black px-6 py-2">Sawit</td>
                    <td class="border border-black px-6 py-2">Kalimantan Tengah</td>
                    <td class="border border-black px-6 py-2 text-right">932</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
{{-- slide-2 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-meranti-laksana.jpg" class="glightbox7 mt-4 gbox" data-glightbox=" description: Deforestasi untuk pembangunan kebun kayu dalam konsesi PT Meranti Laksana di Kalimantan Barat. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/2-meranti-laksana.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun kayu dalam konsesi PT Meranti Laksana di Kalimantan Barat. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-berau-prima-nusantara.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description: Deforestasi di dalam konsesi tambang batubara PT Berau Prima Nusantara di Kalimantan Utara. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/2-berau-prima-nusantara.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi di dalam konsesi tambang batubara PT Berau Prima Nusantara di Kalimantan Utara. Foto: Desember 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-kurnisa-sejahtera.jpg" class="glightbox7 mt-4 gbox" data-glightbox=" description: Deforestasi di dalam konsesi tambang batubara PT Kurnia Sejahtera di Kalimantan Utara. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/2-kurnisa-sejahtera.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top rounded-lg hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi di dalam konsesi tambang batubara PT Kurnia Sejahtera di Kalimantan Utara. Foto: Desember 2024, ©Auriga Nusantara </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-kayan-kaltara-coal.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description: Deforestasi di dalam konsesi tambang batubara PT Kayan Kaltara Coal di Kalimantan Utara. Foto: Desember 2024 ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/2-kayan-kaltara-coal.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi di dalam konsesi tambang batubara PT Kayan Kaltara Coal di Kalimantan Utara. Foto: Desember 2024 ©Auriga Nusantara        </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-phoenix-mill.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description: Pabrik pulp raksasa PT Phoenix Resources International di Tarakan, Kalimantan Utara. Berdasarkan data pemenuhan bahan bakunya, pabrik ini telah berproduksi pada 2024 dengan pasokan dari konsesi-konsesi yang membabat hutan alam. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/2-phoenix-mill.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Pabrik pulp raksasa PT Phoenix Resources International di Tarakan, Kalimantan Utara. Berdasarkan data pemenuhan bahan bakunya, pabrik ini telah berproduksi pada 2024 dengan pasokan dari konsesi-konsesi yang membabat hutan alam. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>

        {{-- diskusi-3 --}}
        <h2 class="font-bold mt-12">3. Kebun kayu sebagai biang deforestasi</h2>
        <div id="diskusi-3" class="pl-5">
            <p class="mt-4 leading-relaxed">Pada 2023, pengembangan kebun kayu menjadi penyebab deforestasi terbesar di Indonesia. Pengembangan kebun kayu ini terutama terjadi di Pulau Kalimantan. Meski luas deforestasinya sedemikian besar, namun terjadi hanya di beberapa konsesi. </p>
            <p class="mt-4 leading-relaxed">Situasi ini berlanjut pada 2024, bahkan hampir seluruhnya di konsesi yang sama atau memiliki keterhubungan kepemilikan. Sebagai misal, deforestasi masif di konsesi kebun kayu PT Mayawana Persada di Kalimantan Barat meluas signifikan pada 2024.
                Demikian juga di konsesi PT Industrial Forest Plantation di Kalimantan Tengah. Meski koalisi masyarakat sipil telah mengungkap deforestasi di kedua konsesi ini pada tahun sebelumnya, yakni laporan Babat Kalimantan (2023) mengenai deforestasi
                di PT Industrial Forest Plantation dan Pembalak Anonim (Maret 2024) mengenai deforestasi di PT Mayawana Persada, namun deforestasi di kedua konsesi tetap terjadi pada 2024.</p>
            <p class="mt-4 leading-relaxed"> Namun, terdapat juga kebun kayu yang bermula pada 2024, sebagaimana terjadi pada 3 konsesi bersebelahan, PT Meranti Laksana, PT Meranti Lestari, dan PT Lahan Cakrawala, di Kabupaten Melawi, Kalimantan Barat yang bermula pada paruh kedua 2024.
                Periset Auriga Nusantara mendokumentasikan deforestasi pada November 2024, dan dalam waktu dekat akan dipublikasi pada laporan tersendiri.</p>
            <p class="mt-4 leading-relaxed">Deforestasi oleh pembangunan kebun kayu tampaknya akan berlanjut di Kalimantan pada tahun mendatang. Penyebabnya, diterbitkannya izin oleh pemerintah untuk pendirian pabrik pulp raksasa PT Phoenix Resources Internasional di Tarakan, Kalimantan
                Utara. Padahal, tidak ada kejelasan, setidaknya yang disampaikan secara terbuka ke publik, sumber bahan baku pabrik ini. Dan, yang paling mengkhawatirkan, terdapat indikasi keterhubungan kepemilikan/kepengurusan/pengelolaan PT Phoenix
                Resources International dengan PT Mayawana Persada, PT Industrial Forest Plantation, PT Meranti Laksana, PT Meranti Lestari, dan PT Lahan Cakrawala.</p>
            <p class="mt-4 leading-relaxed">Pembangunan kebun kayu sebagai biang deforestasi 2024 tidak hanya oleh industri pulp, tapi juga oleh kebun kayu energi atau biomassa, sebagaimana terjadi di PT Inti Global Laksana, PT Banyan Tumbuh Lestari, dan PT Biomasa Jaya Abadi, ketiganya
                bersebelahan di Gorontalo, PT Malinau Hijau Lestari di Kalimantan Utara, PT Jaya Bumi Paser di Kalimantan Timur, dan PT Babugus Wahana Lestari di Kalimantan Tengah. </p>
            <p class="mt-4 leading-relaxed">Deforestasi oleh pembangunan kebun kayu biomassa ini juga tampaknya akan tetap berlanjut pada tahun mendatang mengingat (1) tingginya permintaan pasar, terutama Jepang dan Korea Selatan, (2) kebijakan kelistrikan nasional yang membuka ruang
                penggunaan biomassa berbasis kayu sebagai bahan bakar listrik hingga kisaran 5-10% pada 2030, dan (3) meningkatnya secara drastis konsesi kebun kayu biomassa yang diterbitkan Kementerian Kehutanan. Peringatan akan tingginya deforestasi
                oleh pembangunan kebun kayu biomassa ini telah disuarakan koalisi masyarakat sipil melalui laporan <a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id" target="_blank" class="underline text-simontini">Unheeded Warnings: Forest Biomass Threats to Tropical Forests in Indonesia and Southeast Asia.</a>                </p>
        </div>
    </div>
</div>
{{-- slide-3 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-mayawana.jpg" class="glightbox21 mt-4 gbox" data-glightbox=" description: Pada awal 2024 koalisi masyarakat sipil Auriga Nusantara, Environmental Paper Network, Rainforest Action Network, Woods & Wayside International, dan Greenpeace International mengungkap deforestasi masif dalam konsesi kebun kayu PT Mayawana Persada di Kalimantan Barat. Tapi, setidaknya hingga Desember 2024, perusahaan ini terus membabat hutan alam tersisa di dalam konsesinya. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/3-mayawana.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Pada awal 2024 koalisi masyarakat sipil Auriga Nusantara, Environmental Paper Network, Rainforest Action Network, Woods & Wayside International, dan Greenpeace International mengungkap deforestasi masif dalam konsesi kebun kayu PT Mayawana Persada di
                Kalimantan Barat. Tapi, setidaknya hingga Desember 2024, perusahaan ini terus membabat hutan alam tersisa di dalam konsesinya. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-lahan-cakrawala.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Deforestasi demi pembangunan kebun kayu dalam konsesi PT Lahan Cakrawala di Kalimantan Barat. Foto: Desember 2024, ©Auriga Nusantara.">
                <img src="https://simontini.id/assets/stadi2024/3-lahan-cakrawala.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top rounded-lg hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi demi pembangunan kebun kayu dalam konsesi PT Lahan Cakrawala di Kalimantan Barat. Foto: Desember 2024, ©Auriga Nusantara.
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/mayawana-maret.jpg" class="glightbox21 mt-4 gbox" data-glightbox=" description: Ekskavator sedang menghabisi hutan alam di dalam konsesi kebun kayu PT Mayawana Persada di Kalimantan Barat. Foto: Maret 2024 ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/mayawana-maret.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Ekskavator sedang menghabisi hutan alam di dalam konsesi kebun kayu PT Mayawana Persada di Kalimantan Barat. Foto: Maret 2024 ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-jaya-bumi-paser.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Pembabatan hutan alam demi pembangunan kebun kayu energi di dalam konsesi PT Jaya Bumi Paser di Kalimantan Timur. Foto: Mei 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/3-jaya-bumi-paser.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Pembabatan hutan alam demi pembangunan kebun kayu energi di dalam konsesi PT Jaya Bumi Paser di Kalimantan Timur. Foto: Mei 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-babugus.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Pembangunan jaringan jalan persiapan pembabatan hutan alam demi pengembangan kebun kayu energi/biomassa dalam konsesi PT Babugus Wahana Lestari di Kalimantan Tengah. Foto: Agustus 2024 ©Auriga Nusantara/Earthsight">
                <img src="https://simontini.id/assets/stadi2024/3-babugus.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Pembangunan jaringan jalan persiapan pembabatan hutan alam demi pengembangan kebun kayu energi/biomassa dalam konsesi PT Babugus Wahana Lestari di Kalimantan Tengah. Foto: Agustus 2024 ©Auriga Nusantara/Earthsight</p>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>
        {{-- diskusi-4 --}}
        <h2 class="font-bold mt-12">4. Sawit yang tetap memangsa hutan alam Indonesia</h2>
        <div id="diskusi-4" class="pl-5">
            <p class="mt-4 leading-relaxed">
                <i>“.. ke depan kita harus tambah tanam kelapa sawit. Enggak usah takut .. membahayakan deforestation,”</i> <a href="https://youtu.be/faoo-qTC9Rg?si=MgZGUFJDCbtoQStH" target="_blank" class="underline text-simontini">demikian Presiden Prabowo</a>                pada pengarahan Musyawarah Pembangunan Nasional (Musrenbangnas) 30 Desember 2024. Entahlah karena sejalan dengan pemikiran ini, atau malah sebaliknya Prabowo sedang membangun pembenaran pada ekspansi sawit yang mengkonversi hutan alam.
                Yang jelas, pada 2024 deforestasi oleh pembangunan kebun sawit tetap tinggi di Indonesia, terutama di Sumatera dan Kalimantan. Deforestasi oleh pembangunan kebun sawit pada 2024 teridentifikasi seluas 37.483 hektare, atau mencakup 14% dari
                keseluruhan deforestasi.
            </p>
            <p class="mt-4 leading-relaxed">Deforestasi oleh sawit cenderung terjadi secara besar-besaran di hampir setiap titik deforestasi sawit pada 2024, mengindikasikan bahwa pembangunan sawit-sawit ini dilakukan oleh korporasi atau ditopang oleh pemodal besar. Bukan oleh pekebun
                sawit rakyat (kategori luas di bawah 25 hektare). Hal ini terlihat dengan deforestasi sawit seluas 2.019 hektare di konsesi PT Borneo International Anugerah (BIA) di Kalimantan Barat, atau deforestasi seluas 1.347 hektare di konsesi PT
                Alam Lestari Indah di Kalimantan Tengah. Tidak hanya di konsesi sawit, deforestasi oleh sawit terjadi juga di konsesi kebun kayu PT Diamond Raya Timber di Provinsi Riau.</p>
        </div>
    </div>
</div>

{{-- slide-4 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-subussalam.jpg" class="glightbox20 mt-4 gbox" data-glightbox=" description: Deforestasi untuk pembangunan kebun sawit. Tidak ditemukan izin sawit di lokasi yang berdekatan dengan kebun sawit PT Laot Bangko dan PT Indo Sawit Perkasa di Kabupaten Subussalam, Aceh ini. Foto: Februari 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/4-subussalam.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun sawit. Tidak ditemukan izin sawit di lokasi yang berdekatan dengan kebun sawit PT Laot Bangko dan PT Indo Sawit Perkasa di Kabupaten Subussalam, Aceh ini. Foto: Februari 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-anugerah-langkat-makmur.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Deforestasi untuk pembangunan kebun sawit di konsesi PT Anugerah Langkat Makmur di Kabupaten Mandailing Natal, Sumatera Utara. Foto: Februari 2024, ©Auriga Nusantara/Konsorsium Pembaruan Agraria">
                <img src="https://simontini.id/assets/stadi2024/4-anugerah-langkat-makmur.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4 ">
                Deforestasi untuk pembangunan kebun sawit di konsesi PT Anugerah Langkat Makmur di Kabupaten Mandailing Natal, Sumatera Utara. Foto: Februari 2024, ©Auriga Nusantara/Konsorsium Pembaruan Agraria
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-DRT.jpg" class="glightbox20 mt-4 gbox" data-glightbox=" description: Lokasi ini berada dalam konsesi logging PT Diamond Raya Timber di Riau. Namun, kesaksian masyarakat setempat maupun dokumentasi kunjungan lapangan menunjukkan bahwa deforestasi ini untuk pembangunan kebun sawit. Pembangunan kebun sawit di dalam konsesi logging juga ditemukan dalam konsesi PT Anugerah Pratama Inspirasi di Bengkulu yang dikunjungi pada Februari 2024. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/4-DRT.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Lokasi ini berada dalam konsesi logging PT Diamond Raya Timber di Riau. Namun, kesaksian masyarakat setempat maupun dokumentasi kunjungan lapangan menunjukkan bahwa deforestasi ini untuk pembangunan kebun sawit. Pembangunan kebun sawit di dalam konsesi logging juga ditemukan dalam konsesi PT Anugerah Pratama Inspirasi di Bengkulu yang dikunjungi pada Februari 2024. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/hph-bentara-arga-timber.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Deforestasi di dalam konsesi logging PT Bentara Arga Timber di Bengkulu. Keterangan masyarakat setempat, pun dokumentasi lapangan, mengindikasikan pembabatan hutan alam ini demi pembangunan dan perluasan kebun sawit. Foto: Februari 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/hph-bentara-arga-timber.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi di dalam konsesi logging PT Bentara Arga Timber di Bengkulu. Keterangan masyarakat setempat, pun dokumentasi lapangan, mengindikasikan pembabatan hutan alam ini demi pembangunan dan perluasan kebun sawit. Foto: Februari 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-pulau-lau-kalsel.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Pembangunan jaringan jalan persiapan pembabatan hutan alam demi pengembangan kebun kayu energi/biomassa dalam konsesi PT Babugus Wahana Lestari di Kalimantan Tengah. Foto: Agustus 2024 ©Auriga Nusantara/Earthsight">
                <img src="https://simontini.id/assets/stadi2024/4-pulau-lau-kalsel.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi untuk pembangunan kebun sawit dalam konsesi PT Bersama Sejahtera Sakti di Pulau Laut, Kalimantan Selatan. Foto: Mei 2024, ©Auriga Nusantara</p>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>
        {{-- diskusi-5 --}}
        <h2 class="font-bold mt-12">5. Nikel, emas, kebun kayu: tiga pengancam hutan Sulawesi</h2>
        <div id="diskusi-5" class="pl-5">
            <p class="mt-4 leading-relaxed">
                Deforestasi di Sulawesi mengalami penurunan signifikan pada 2024. Namun demikian, mengingat luas tutupan hutan di pulau ini yang sangat jauh di bawah Papua, Kalimantan, dan Sumatera, angka deforestasi tersebut tetap harus diperhatikan serius. Deforestasi
                di Sulawesi secara berurut terjadi di Sulawesi Tengah, Sulawesi Tenggara, Gorontalo, Sulawesi Barat, Sulawesi Selatan, dan Sulawesi Utara.
            </p>
            <p class="mt-4 leading-relaxed">
                Berbeda dengan Kalimantan yang relatif datar, Pulau Sulawesi dominan bergelombang perbukitan. Pulau yang seluruhnya masuk dalam wilayah Wallacea ini dikenal dengan tingkat endemismenya yang tinggi, baik flora maupun fauna, terutama burung. Karenanya,
                selain sangat potensial mengakibatkan longsor dan banjir bandang, deforestasi di pulau ini juga potensial memicu kepunahan spesies yang lebih tinggi.
            </p>
            <p class="mt-4 leading-relaxed">
                Ditilik berdasarkan komoditas, industri nikel menjadi penyebab deforestasi terbesar di Sulawesi. Tercatat deforestasi oleh industri ini seluas 4.262 hektare, yang terjadi di 210 konsesi di Sulawesi Tengah, Sulawesi Tenggara, dan Sulawesi Selatan.
            </p>
            <p class="mt-4 leading-relaxed">
                Catatan khusus perlu diberikan kepada Provinsi Gorontalo, sebuah provinsi kecil di bagian utara Sulawesi. Dengan hutan alam yang relatif kecil namun mengalami deforestasi seluas 2.180 hektare pada 2024. Sebanyak 71% deforestasi ini terjadi oleh pengembangan
                kebun kayu energi (biomassa) oleh konsesi bersebelahan PT Inti Global Laksana dan PT Banyan Tumbuh Lestari yang memasok pabrik <i>wood pellet</i> PT Biomasa Jaya Abadi yang terletak di dalamnya. Analisis Auriga Nusantara,
                yang akan dirilis dalam waktu dekat, menunjukkan adanya keterhubungan kepemilikan ketiga perusahaan ini.
            </p>
            <p class="mt-4 leading-relaxed">
                Pembentukan pulau ini yang sarat dengan kegiatan vulkanologi mengakibatnya mengandung komoditas pertambangan yang tinggi. Tidak hanya nikel, pulau ini juga mengandung cadangan emas yang relatif tinggi. Sayangnya, potensi ini justru mengancam tutupan hutan
                alamnya. Deforestasi oleh aktivitas pertambangan emas teridentifikasi setidaknya seluas 181 hektare pada 2024. Namun demikian, angka tersebut adalah yang terjadi di dalam wilayah izin usaha pertambangan, sementara aktivitas ini bahkan
                teridentifikasi merangsek ke berbagai kawasan konservasi, seperti Suaka Margasatwa Nantu di Gorontalo, Taman Nasional Bogani Nani Wartabone.
            </p>
        </div>
    </div>
</div>

{{-- slide-5 --}}
<div x-data="{ currentSlide: 0, totalSlides: 3 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-bintang-delapan.jpg" class="glightbox8 mt-4 gbox" data-glightbox=" description: Deforestasi dalam konsesi tambang nikel PT Bintang Delapan Mineral di Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/5-bintang-delapan.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi dalam konsesi tambang nikel PT Bintang Delapan Mineral di Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-hengjaya.jpg" class="glightbox8 mt-4 gbox" data-glightbox="description: Deforestasi di dalam konsesi tambang nikel PT Hengjaya Mineralindo di Morowali, Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/5-hengjaya.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi di dalam konsesi tambang nikel PT Hengjaya Mineralindo di Morowali, Sulawesi Tengah. Foto: Desember 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-surya-cahaya-mineral.jpg" class="glightbox8 mt-4 gbox" data-glightbox="description: Jalan menuju lokasi tambang eksisting di dalam konsesi tambang nikel PT Surya Cahaya Mineral di Konawe Utara, Sulawesi Tenggara. Tampak sekilas pada latar daerah terbuka akibat deforestasi untuk menambang nikel dalam konsesi perusahaan ini. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/5-surya-cahaya-mineral.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Jalan menuju lokasi tambang eksisting di dalam konsesi tambang nikel PT Surya Cahaya Mineral di Konawe Utara, Sulawesi Tenggara. Tampak sekilas pada latar daerah terbuka akibat deforestasi untuk menambang nikel dalam konsesi perusahaan ini. Foto: Desember 2024, ©Auriga Nusantara </p>
        </div>

    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">

        {{-- diskusi-6 --}}
        <h2 class="font-bold mt-12">6. Deforestasi nikel merangsek Tanah Papua</h2>
        <div id="diskusi-6" class="pl-5">
            <p class="mt-4 leading-relaxed">Publik mungkin masih mengira bahwa Raja Ampat adalah gugusan 610 pulau kecil yang tidak terjamah perusakan alam, terutama karena gugusan pulau dikelilingi laut tenang nan indah penuh terumbu karang. Iya, gugusan pulau yang dijadikan sebagai
                satu kabupaten di Papua Barat Daya ini memang dikenal sebagai daerah tujuan wisata oleh keindahan alamnya, terutama hamparan laut berisi terumbu karang. Tak kurang Presiden Jokowi pernah menghabiskan malam tahun baru di pulau ini. Bahkan,
                UNESCO menobatkan Raja Ampat sebagai kawasan geopark.</p>
            <p class="mt-4 leading-relaxed">
                Akan tetapi, area sekeramat itu secara nasional dan internasional tak tahan menghadapi gempuran tambang nikel. Setidaknya daratan 4 pulau kecil, yakni Pulau Gag, Pulau Waigeo, Pulau Manuram, dan Pulau Kawei, di Raja Ampat telah dijamah tambang nikel.
                Analisis citra satelit mengindikasikan hingga 2024 telah terjadi deforestasi akibat penambangan nikel seluas 174 hektare di keempat pulau ini.
            </p>
            <p class="mt-4 leading-relaxed">
                Tidak hanya itu, satu izin tambang nikel baru, meski belum beroperasi, telah diterbitkan di Pulau Batang Pele dan Manyaifun. Izin tambang nikel ini diterbitkan untuk PT Mulia Raymond Perkasa.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestasi nikel tampaknya akan meluas di Tanah Papua, karena telah terdapat 5 izin tambang di pulau paling timur Indonesia ini. Seluruh izin ini mencakup area seluas 38.529 hektare, dengan 58%, atau 22.452 hektare, berupa tutupan hutan alam.
            </p>
        </div>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    {{-- table-9 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">IZIN TAMBANG NIKEL DI TANAH PAPUA</h3>
    <div class="w-full bg-gray-800  overflow-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">KONSESI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">LOKASI</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">LUAS IZIN</th>
                    <th class="px-6 py-3 border border-black text-left text-white uppercase font-semibold">HUTAN ALAM DALAM KONSESI</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="px-6 py-2 border border-black">PT Anugerah Surya Pratama</td>
                    <td class="px-6 py-2 border border-black">Raja Ampat, Papua Barat Daya</td>
                    <td class="px-6 py-2 border border-black text-right">1.167</td>
                    <td class="px-6 py-2 border border-black text-right">209</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Kawei Sejahtera Mining</td>
                    <td class="px-6 py-2 border border-black">Raja Ampat, Papua Barat Daya</td>
                    <td class="px-6 py-2 border border-black text-right">5.691</td>
                    <td class="px-6 py-2 border border-black text-right">2.361</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Mulia Raymond Perkasa</td>
                    <td class="px-6 py-2 border border-black">Raja Ampat, Papua Barat</td>
                    <td class="px-6 py-2 border border-black text-right">2.194</td>
                    <td class="px-6 py-2 border border-black text-right">874</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Gag Nikel</td>
                    <td class="px-6 py-2 border border-black">Raja Ampat, Papua Barat</td>
                    <td class="px-6 py-2 border border-black text-right">13.078</td>
                    <td class="px-6 py-2 border border-black text-right">2.838</td>
                </tr>
                <tr>
                    <td class="px-6 py-2 border border-black">PT Iriana Mutiara Mining</td>
                    <td class="px-6 py-2 border border-black">Sarmi, Papua</td>
                    <td class="px-6 py-2 border border-black text-right">16.399</td>
                    <td class="px-6 py-2 border border-black text-right">16.170</td>
                </tr>
                <tr class="bg-black">
                    <td class="px-6 py-2 font-bold border border-black">TOTAL</td>
                    <td class="px-6 py-2 font-bold border border-black"></td>
                    <td class="px-6 py-2 font-bold border border-black text-right">38.529</td>
                    <td class="px-6 py-2 font-bold border border-black text-right">22.452</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- slide-6 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-gag-nikel.jpg" class="glightbox9 mt-4 gbox" data-glightbox=" description:  Deforestasi oleh tambang nikel PT Gag Nikel di pulau kecil Gag di Raja Ampat, Papua Barat Daya. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/6-gag-nikel.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi oleh tambang nikel PT Gag Nikel di pulau kecil Gag di Raja Ampat, Papua Barat Daya. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-pt-ksm.jpg" class="glightbox9 mt-4 gbox" data-glightbox="description: Deforestasi oleh penambangan nikel PT Kawei Sejahtera Mining di pulau kecil Kawei di Raja Ampat. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/6-pt-ksm.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi oleh penambangan nikel PT Kawei Sejahtera Mining di pulau kecil Kawei di Raja Ampat. Foto: Desember 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-pt-ksp.jpg" class="glightbox9 mt-4 gbox" data-glightbox=" description: Deforestasi oleh penambangan nikel PT Anugerah Surya Pratama di pulau kecil Manuram, Raja Ampat. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/6-pt-ksp.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi oleh penambangan nikel PT Anugerah Surya Pratama di pulau kecil Manuram, Raja Ampat. Foto: Desember 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-batang-pele.jpg" class="glightbox9 mt-4 gbox" data-glightbox="description: Di pulau kecil Batang Pele di Raja Ampat ini telah diterbitkan izin tambang nikel PT Mulya Raymond Perkasa. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/6-batang-pele.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Di pulau kecil Batang Pele di Raja Ampat ini telah diterbitkan izin tambang nikel PT Mulya Raymond Perkasa. Foto: Desember 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-imm-sarmi.jpeg" class="glightbox9 mt-4 gbox" data-glightbox="description: Danau dan hutan alam ini terancam hilang karena di lahan ini telah diterbitkan izin tambang nikel PT Iriana Mutiara Mining. Foto: Desember 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/6-imm-sarmi.jpeg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Danau dan hutan alam ini terancam hilang karena di lahan ini telah diterbitkan izin tambang nikel PT Iriana Mutiara Mining. Foto: Desember 2024, ©Auriga Nusantara</p>
        </div>

    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>


<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
        {{-- diskusi-7 --}}
        <h2 class="font-bold mt-12">7. Deforestasi juga massif di kawasan konservasi</h2>
        <div id="diskusi-7" class="pl-5">
            <p class="mt-4 leading-relaxed">
                Pada 31 Oktober 2024 koalisi masyarakat sipil Ekspedisi Indonesia Baru, HAKA Aceh, Forest Watch Indonesia, Greenpeace Indonesia, Pusaka Belantara Rakyat, dan Auriga Nusantara merilis film <b>17 Sweet Letters</b> pada perhelatan Conference
                on Parties ke-16 Konvensi Keragaman Hayati di Cali, Colombia. Film yang dalam versi Bahasa Indonesia berjudul <b>17 Surat Cinta</b> dan dirilis di dalam negeri pada 17 November 2024 ini berkisah bagaimana deforestasi bertahun-tahun berlangsung
                dalam kawasan konservasi Suaka Margasatwa Rawa Singkil, Aceh. Aktivis konservasi telah mengirim 17 surat pengaduan ke pemerintah, tapi deforestasi tetap berlanjut. Sepanjang 2024 teridentifikasi 159 hektare deforestasi di habitat gajah,
                orangutan, dan berbagai satwa ikonik ini.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestasi dalam kawasan konservasi teridentifikasi seluas 7.704 hektare sepanjang 2024, terjadi di 37 provinsi pada berbagai kategori kawasan konservasi, yakni taman nasional, suaka margasatwa, cagar alam, taman hutan raya, taman wisata alam, taman
                buru.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestasi dalam kawasan konservasi harus menjadi perhatian tersendiri karena telah dibentuk secara spesifik badan pengelolanya, yakni balai konservasi sumber daya alam atau unit pengelola teknis, dan secara tegas dilarang oleh setidaknya 4 undang-undang
                (UU), yakni UU Konservasi, UU Kehutanan, UU Lingkungan Hidup, dan UU Pemberantasan Illegal Logging.
            </p>
        </div>
    </div>

<div class="max-w-5xl mx-auto px-4 z-20 relative">
        {{-- table-10 --}}
        <h3 class="text-simontini mt-6 font-bold mb-2">SEPULUH TERATAS DEFORESTASI KAWASAN KONSERVASI PADA 2024</h3>
        <div class="w-full overflow-auto bg-gray-800">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-black">
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">KAWASAN KONSERVASI</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINSI</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">LUAS DEFORESTASI 2024 (HA)</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <td class="border border-black px-6 py-2">Taman Nasional Kerinci Seblat</td>
                        <td class="border border-black px-6 py-2">Bengkulu, Jambi, Sumatera Barat dan Sumatera Selatan</td>
                        <td class="border border-black px-6 py-2 text-right">1.283</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Taman Nasional Lorentz</td>
                        <td class="border border-black px-6 py-2">Papua Pegunungan, Papua Selatan dan Papua Tengah</td>
                        <td class="border border-black px-6 py-2 text-right">900</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Suaka Margasatwa Memberamo Foja</td>
                        <td class="border border-black px-6 py-2">Papua, Papua Pegunungan, Papua Tengah</td>
                        <td class="border border-black px-6 py-2 text-right">490</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Taman Hutan Raya Bukit Soeharto</td>
                        <td class="border border-black px-6 py-2">Kalimantan Timur</td>
                        <td class="border border-black px-6 py-2 text-right">363</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Suaka Margasatwa Pegunungan Jayawijaya</td>
                        <td class="border border-black px-6 py-2">Papua Pegunungan</td>
                        <td class="border border-black px-6 py-2 text-right">357</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Taman Nasional Gunung Leuser</td>
                        <td class="border border-black px-6 py-2">Aceh dan Sumatera Utara</td>
                        <td class="border border-black px-6 py-2 text-right">335</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Suaka Margasatwa Bukit Rimbun Bukit Baling</td>
                        <td class="border border-black px-6 py-2">Riau dan Sumatera Barat</td>
                        <td class="border border-black px-6 py-2 text-right">312</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Taman Nasional Tesso Nilo</td>
                        <td class="border border-black px-6 py-2">Riau</td>
                        <td class="border border-black px-6 py-2 text-right">251</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Suaka Margasatwa Dangku</td>
                        <td class="border border-black px-6 py-2">Sumatera Selatan</td>
                        <td class="border border-black px-6 py-2 text-right">236</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Suaka Margasatwa Giam Siak Kecil</td>
                        <td class="border border-black px-6 py-2">Riau</td>
                        <td class="border border-black px-6 py-2 text-right">221</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">188 kawasan konservasi lainnya</td>
                        <td class="border border-black px-6 py-2"></td>
                        <td class="border border-black px-6 py-2 text-right">2.933</td>
                    </tr>

                </tbody>
            </table>
        </div>
</div>
{{-- slide-7 --}}
<div x-data="{ currentSlide: 0, totalSlides: 2 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/7-rawa-singkil.jpg" class="glightbox10 mt-4 gbox" data-glightbox="description: Deforestasi untuk pembangunan kebun sawit di dalam Suaka Margasatwa Rawa Singkil di Aceh. Foto: Februari 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/7-rawa-singkil.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun sawit di dalam Suaka Margasatwa Rawa Singkil di Aceh. Foto: Februari 2024, ©Auriga Nusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/7-tesso-nilo.jpg" class="glightbox10 mt-4 gbox" data-glightbox=" description: Deforestasi untuk pembangunan kebun sawit di dalam Taman Nasional Tesso Nilo di Riau. Foto: Februari 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/7-tesso-nilo.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestasi untuk pembangunan kebun sawit di dalam Taman Nasional Tesso Nilo di Riau. Foto: Februari 2024, ©Auriga Nusantara</p>
        </div>


    </div>

    <!-- Navigation Buttons -->
    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : 0"
        x-show="currentSlide > 0"
        class="absolute left-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </button>
    <button @click="currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : totalSlides - 1"
            x-show="currentSlide < totalSlides - 1"
            class="absolute right-0 sm:top-1/2 top-1/4 sm:mt-0 mt-6 transform -translate-y-1/2 bg-black text-white p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 sm:h-6 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>

        <div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">




            <div id="rekomendasi" class="pt-[45px] -mt-[45px]">
                <h1 class="text-3xl font-bold mt-12 text-simontini">REKOMENDASI</h1>
                <p class="mt-6 leading-relaxed">
                    Saat ini, perlindungan hukum terhadap hutan alam di Indonesia hanya terdapat pada hutan-hutan alam yang berada di kawasan konservasi, karena perbuatan mengkonversi tutupan dan/atau bentang alam tidak diperbolehkan dilakukan di dalamnya. Dari total 22,4
                    juta hektare kawasan konservasi di Indonesia, 17,3 juta hektare berupa tutupan hutan alam.
                </p>
                <p class="mt-4 leading-relaxed">
                    Memang ada kebijakan moratorium izin baru di hutan primer (dan gambut). Tapi, harus digarisbawahi bahwa moratorium ini adalah bentuk kebijakan, bukan peraturan, sehingga perlindungannya tidak tetap atau permanen. Moratorium ini secara formal disebut Peta
                    Indikatif Penundaan Pemberian Izin Baru (PIPPIB) pada Hutan Alam Primer dan Lahan Gambut, yang ditunjuk melalui Surat Keputusan Menteri Lingkungan Hidup dan Kehutanan. Pada SK terakhir, November 2023, PIPPIB seluas 66,3 juta hektare.
                    Analisis spasial terhadap peta ini menunjukkan hutan alam di dalamnya seluas 53,5 juta hektare. Namun begitu, seluruh kawasan konservasi dimasukkan dalam PIPPIB.
                </p>
                <p class="mt-4 leading-relaxed">
                    Terhadap hutan alam di luar kedua hal di atas tidak ada perlindungan hukum atau kebijakan sama sekali. Karena itu, misalnya, Menteri Kehutanan Raja Juli Antoni dengan mudahnya menyebut akan menyediakan <a href="https://www.youtube.com/watch?v=xaRhYDmVTWc"
                    target="_blank" class="underline text-simontini">20 juta hektare kawasan hutan</a> untuk cadangan pangan, energi, dan air.
                </p>
                <p class="mt-4 leading-relaxed">
                    Sementara, sebagaimana Koleksi 3 MapBiomas Indonesia, hutan alam di Indonesia saat ini seluas 94,9 juta hektare, yang 52,9 juta hektare di antaranya berada di area PIPPIB. Artinya, 42 juta hektare hutan alam tersebut tidak memiliki perlindungan hukum
                    atau kebijakan. Bahkan, agregat 9 juta hektare di antaranya berada di dalam konsesi konversi, seperti sawit (2,3 juta ha), tambang (3,2 juta ha), kebun kayu (3,5 juta ha).
                </p>

            </div>
        </div>
        <div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
            <iframe src='https://flo.uri.sh/visualisation/21401008/embed' title='Simontini - stadi 2024' class='flourish-embed-iframe w-full h-full' frameborder='0' scrolling='no' style="height: 500px" sandbox='allow-same-origin allow-forms allow-scripts allow-downloads allow-popups allow-popups-to-escape-sandbox allow-top-navigation-by-user-activation'></iframe>
            <p class="text-sm mt-2">Deforestasi 2001-2022 diperoleh dengan mengoverlay University of Maryland's Lossyear dengan tutupan hutan 2000 Kementerian Kehutanan</p>
            <p class="text-sm sm:-mt-1 mt-2">Deforestasi 2023 dan 2024 menggunakan Auriga Nusantara's STADI (Status Deforestasi Indonesia) yang tersedia pada https://simontini.id </p>
        </div>
        <div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
            <div>
                <div>
                    <p class="mt-4 leading-relaxed">
                        Perlindungan hukum terhadap hutan alam ini idealnya dalam bentuk undang-undang. Namun, menghadirkan sebuah undang-undang bukan perkara mudah, dan kerap butuh bertahun-tahun. Peraturan di bawahnya, yakni peraturan pemerintah, pun tidak jarang memerlukan
                        waktu lama, terutama oleh kerumitan dan kompleksitas memperoleh persetujuan lintas kementerian, sebuah prasyarat yang diperlukan oleh satu peraturan pemerintah.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Karena itu, terobosan hukum yang bisa dilakukan dalam waktu cepat adalah dalam bentuk peraturan presiden, yang kekuatannya relatif setara dengan peraturan pemerintah. Oleh karena itu, saatnya <b>Presiden Prabowo Subianto menerbitkan peraturan presiden yang memberikan perlindungan hukum terhadap seluruh hutan alam tersisa di Indonesia.</b> <span class="bg-red-500 h-3 w-3 inline-flex"></span>
                    </p>

                </div>

                <div class="text-center border-black mt-24">
                    <div class="mb-4">

                        <a class=" font-semibold mb-1 ">Penulis: </a>
                        <p >Timer Manurung, Dedy Sukmara, Andhika Younastya</p>
                    </div>
                    <div class="mt-6">
                        <a class=" font-semibold ">Pengolah Data: </a>
                        <p class="mt-1">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika Laura, Dedy Sukmara, M. Alichamdan, M. Dendi Alfitrah, Sesilia Maharani Putri, Wahyu Ananta Nugraha, Yustinus Seno</p>
                    </div>

                    <div class="mt-6">
                        <a class="  font-semibold ">Verifikasi Lapangan: </a>
                        <p class="mt-1">
                            Bagus Subgiarto, Fajar Simanjuntak, Gilang Ekselsa, Hafid Azi Darma, Hilman Afif, Riszki Is Hardianto, Robby Eebor, Supintri Yohar, Yudi Nofiandi, Sulih Primara Putra
                        </p>
                    </div>

                </div>

                <div class="flex flex-col w-full text-center justify-center mb-24 mt-6">
                    <a class=" font-semibold mb-1">Saran pengutipan:</a>
                    <p>Auriga Nusantara. 2025. Status Deforestasi Indonesia 2024, diakses pada [DD/MM/YYYY] melalui tautan [LINK].</p>
                </div>


                </div>
            </div>

            @endsection @push('scripts')
            <script>

                function createLightbox(selectorID) {
                        const lightbox = GLightbox({
                            selector: selectorID,
                            touchNavigation: true,
                        });
                    }
                    for (let i = 1; i <= 21; i++) {
                        createLightbox(`.glightbox${i}`);
                    }

                $(window).on('load', function(){
                  $('#loader').hide();
                  $('#content').show();
                });
                $(function () {




                    var controller1 = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});



                    new ScrollMagic.Scene({triggerElement: "#parallax1"})
                        .setTween("#parallax1 video", {y: "80%", ease: Linear.easeNone})
                        // .addIndicators()
                        .addTo(controller1);

                    new ScrollMagic.Scene({triggerElement: "#parallax2"})
                        .setTween("#parallax2 video", {y: "80%", ease: Linear.easeNone})
                        // .addIndicators()
                        .addTo(controller1);

                        new ScrollMagic.Scene({triggerElement: "#parallax3"})
                        .setTween("#parallax3 video", {y: "80%", ease: Linear.easeNone})
                        // .addIndicators()
                        .addTo(controller1);



                    // Sticky pinned text (remains in place)
                    new ScrollMagic.Scene({
                        triggerElement: "#parallax1",
                        triggerHook: 0,
                        duration: "100%"
                    })
                    .setPin("#stickyText")
                    // .addIndicators({name: "Pinned Text"}) // Debug indicator
                    .addTo(controller1);

                    // Fade out sticky text at the end
                    new ScrollMagic.Scene({
                        triggerElement: "#parallax1",
                        triggerHook:  1, // Start fade out when 70% of the last section is reached
                        duration: "100%" // Smooth fade out
                    })
                    .setTween(TweenMax.to("#stickyText", 0.01, { display: "none" }))
                    // .addIndicators({name: "Fade Out"}) // Debug indicator
                    .addTo(controller1);
                });
            </script>
            @endpush
