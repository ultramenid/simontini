@extends('layouts.penjelasan-data')

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')
    {{-- HERO --}}
    <section
        class="relative h-[89vh] flex flex-col justify-center items-center px-[8vw] overflow-hidden bg-cover bg-[center_80%]"
        style="background-image: url('{{ asset('assets/images/asset-1.jpg') }}');">

        {{-- <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/10 pointer-events-none"></div> --}}

        <div class="relative z-10 text-center max-w-3xl mx-auto">
            <h1
                class="font-poppins font-black text-[clamp(2.4rem,6vw,5.5rem)] leading-[1.06] tracking-[-0.03em] text-[#f5f0e8] mb-7">
                DATA STADI 2025
            </h1>
            <p class="text-white text-[1.1rem] tracking-[.08em] uppercase opacity-70">AURIGA NUSANTARA &middot; MARET 2026
            </p>
        </div>

        <div class="absolute bottom-7 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-10">
            <span class="font-poppins text-[.55rem] tracking-[.15em] uppercase text-[rgba(245,240,232,.3)]">Gulir</span>
            <div class="w-5 h-8 rounded-full border border-[rgba(245,240,232,.25)] flex items-start justify-center pt-1.5">
                <div class="w-1 h-1.5 rounded-full bg-[#c04030] animate-bounce"></div>
            </div>
            <svg class="w-3 h-3 text-[rgba(245,240,232,.25)] animate-pulse" viewBox="0 0 12 12" fill="none">
                <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>

    </section>

    {{-- CONTENT --}}
    <div class="max-w-3xl mx-auto px-6 py-20">

        <h2
            class="text-[clamp(1.6rem,3.5vw,2.8rem)] font-black leading-tight tracking-tight text-[#1a1a1a] text-center mb-16">
            Bagaimana STADI-Simontini, GLAD-UMD, dan Simontana-Kemenhut mendefinisikan hutan alam?
        </h2>

        <div class="mb-[50px]">
            <h3 class="text-[1.25rem] font-bold text-center text-[#1a1a1a] mb-10">
                Definisi Hutan Alam/Dasar Penutupan Hutan Alam
            </h3>

            {{-- STADI-Simontini --}}
            <div class="mb-8 pb-8 border-b border-[#bc4a3c]">
                <h4 class="text-[1.05rem] font-bold text-center text-[#bc4a3c] mb-4">STADI-Simontini</h4>
                <p class="text-[.95rem] leading-relaxed text-[#bc4a3c] text-center mb-4">
                    STADI menggunakan pendekatan integratif dengan menggabungkan beberapa referensi data hutan alam
                    dari sumber global dan nasional, termasuk data dari Kementerian Kehutanan (2024).
                </p>
                <p class="text-[.9rem] leading-relaxed text-[#bc4a3c] text-center italic">
                    Parameter fisik (operasional): formasi hutan alam baik primer dan sekunder termasuk mangrove
                    dan rawa gambut dengan luas minimal 0.25 ha dengan tinggi pohon lebih dari 5 meter.
                </p>
            </div>

            {{-- Simontana-Kemenhut --}}
            <div class="mb-8 pb-8 border-b border-[#bc4a3c]">
                <h4 class="text-[1.05rem] font-bold text-center text-[#1a1a1a] mb-4">Simontana-Kemenhut</h4>
                <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-center mb-4">
                    Simontana mendefinisikan hutan alam dari reklasifikasi enam kelas penutupan lahan:
                    hutan lahan kering primer, hutan lahan kering sekunder, hutan rawa primer,
                    hutan rawa sekunder, hutan mangrove primer, dan hutan mangrove sekunder.
                </p>
                <p class="text-[.9rem] leading-relaxed text-[#1a1a1a] text-center italic">
                    Parameter fisik (operasional): tutupan hutan alam dengan tinggi pohon minimal 5 meter
                    saat dewasa dan tutupan tajuk minimal 30 persen.
                </p>
            </div>

            {{-- GLAD-UMD --}}
            <div class="mb-8">
                <h4 class="text-[1.05rem] font-bold text-center text-[#1a1a1a] mb-4">GLAD-UMD</h4>
                <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-center mb-4">
                    UMD menggunakan pendekatan global berbasis tutupan pohon yang disaring dengan
                    layer <em>primary humid tropical forest</em> untuk mengidentifikasi kawasan hutan
                    alam di wilayah tropis.
                </p>
                <p class="text-[.9rem] leading-relaxed text-[#1a1a1a] text-center italic">
                    Parameter fisik (operasional): tutupan pohon &ge;30% dan tinggi pohon &ge;5 meter.
                </p>
            </div>

        </div>
    </div>

    {{-- slide ke 2 --}}
    <div class="max-w-7xl mx-auto px-6 py-20">
        {{-- slide ke 2 --}}
        <h2
            class="text-[clamp(1.6rem,3.5vw,2.8rem)] font-black leading-tight tracking-tight text-[#1a1a1a] text-center mb-16">
            Memahami Definisi Hutan & Penutupan Hutan di Indonesia
        </h2>
        <div class="my-16 mb-[50px]">
            <div class="grid grid-cols-4 gap-4">
                <div class="border-r border-r-[#bc4a3c] p-4">
                    <h4 class="text-[1.20rem] font-bold text-left text-[#1a1a1a] mb-4">
                        Landasan hukum
                        (UU 41/1999 dan UU
                        11/2020)
                    </h4>
                    <p class="text-[.95rem] leading-relaxed font-bold mb-5">
                        *penjelasan pasal 9
                    </p>
                    <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-left mb-4">
                        Hutan merupakan kesatuan ekosistem
                        berupa hamparan lahan berisi sumber
                        daya alam hayati yang didominasi
                        pepohonan dalam komunitas alam
                        lingkungannya yang tidak dapat
                        dipisahkan satu sama lain. Penutupan
                        hutan (forest coverage) adalah
                        penutupan lahan oleh vegetasi dengan
                        komposisi dan kerapatan tertentu
                        sehingga membentuk fungsi hutan,
                        antara lain pengaturan iklim mikro, tata
                        air, dan habitat satwa.
                    </p>

                </div>
                <div class="border-r border-r-[#bc4a3c] p-4">
                    <h4 class="text-[1.20rem] font-bold text-left text-[#1a1a1a] mb-4">
                        Standar teknis dan pelaporan (FREL 2016, Permenhut No.14/2004)
                    </h4>
                    {{-- <p class="text-[.95rem] leading-relaxed font-bold mb-5">
                        *penjelasan pasal 9
                    </p> --}}
                    <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-left mb-4">
                        Suatu area dikategorikan sebagai hutan
                        apabila memiliki luas minimum 0,25
                        hektare, didominasi vegetasi pepohonan
                        dengan tinggi lebih dari 5 meter saat
                        dewasa, serta memiliki tutupan kanopi
                        lebih dari 30 persen.
                    </p>

                </div>
                <div class="border-r border-r-[#bc4a3c] p-4">
                    <h4 class="text-[1.20rem] font-bold text-left text-[#1a1a1a] mb-4">
                        Definisi operasional dan pemutakhiran data kehutanan
                    </h4>
                    {{-- <p class="text-[.95rem] leading-relaxed font-bold mb-5">
                        *penjelasan pasal 9
                    </p> --}}
                    <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-left mb-4">
                        Batas minimum luas pemetaan
                        (Minimum Mapping Unit, MMU)
                        berkembang dari 6,25 hektare pada skala
                        1:50.000 menjadi 1 hektare berdasarkan
                        Keputusan Dirjen Planologi Kehutanan
                        No. 17 Tahun 2025 tentang petunjuk
                        teknis penafsiran citra satelit resolusi
                        menengah untuk pemutakhiran data
                        penutupan lahan nasional. Pemutakhiran
                        dilakukan menggunakan mosaik citra
                        Landsat pansharpening resolusi 15
                        meter dengan skala interpretasi 1:20.000,
                        didukung data CSRT dan CSSRT untuk
                        meningkatkan akurasi.
                    </p>

                </div>
                <div class="p-4">
                    <h4 class="text-[1.20rem] font-bold text-left text-[#1a1a1a] mb-4">
                        Parameter fisik operasional (KLHK)
                    </h4>
                    {{-- <p class="text-[.95rem] leading-relaxed font-bold mb-5">
                        *penjelasan pasal 9
                    </p> --}}
                    <p class="text-[.95rem] leading-relaxed text-[#1a1a1a] text-left mb-4">
                        Penentuan hutan tetap mengacu pada
                        kriteria biofisik berupa tinggi pohon
                        minimal 5 meter pada saat dewasa
                        dan tutupan tajuk lebih dari 30 persen,
                        yang digunakan sebagai dasar delineasi
                        poligon tutu
                    </p>

                </div>
            </div>
        </div>
    </div>

    {{-- slide ke 3 --}}
    <div class="max-w-7xl mx-auto px-6 py-20">
        {{-- slide ke 3 --}}
        <h2
            class="text-[clamp(1.6rem,3.5vw,2.8rem)] font-black leading-tight tracking-tight text-[#1a1a1a] text-center mb-16">
            Bagaimana STADI mendefinisikan deforestasi?
        </h2>
        <div class="my-16 mb-[50px]">
            <div class="grid grid-cols-3">
                <div class="border-r border-r-[#bc4a3c] p-4 text-[#bc4a3c]">
                    <h4 class="text-[25px] font-bold text-left mb-4">
                        STADI - Simontini
                    </h4>
                    <div>
                        <p class="font-bold">
                            Definisi:
                        </p>
                        <p class="text-[.95rem] leading-relaxed text-left mb-4">
                            Deforestasi adalah penghilangan tutupan hutan
                            alam (baik primer dan sekunder) menjadi non
                            hutan karena aktivitas manusia (antropogenik).
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">
                            Apa yang diukur?
                        </p>
                        <ul class="list-disc ml-4">
                            <li>
                                Semua kehilangan hutan alam akibat akitivas manusia termasuk kebakaran.
                            </li>
                            <li>
                                Semua kehilangan hutan alam baik bersifat
                                permanen maupun sementara tanpa dikurangi
                                tutupan hutan yang tumbuh kembali/reforestasi.
                            </li>
                            <li>
                                Gangguan alami seperti banjir, tanah longsor,
                                dinamika musiman terkait periode kering dan
                                basah serta faktor alam lainnya tidak termasuk
                                dalam cakupan analisis deforestasi.
                            </li>
                            <li>
                                Perubahan tutupan pohon yang terkait dengan
                                praktik pengelolaan pertanian atau perkebunan,
                                termasuk siklus panen tanaman kayu atau kebun
                                kayu, tidak dikategorikan sebagai deforestasi.
                            </li>
                            <li>
                                Kejadian kehilangan berulang pada lokasi yang
                                sama tidak dihitung lebih dari satu kali sejak 2021.
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="border-r border-r-[#bc4a3c] p-4">
                    <h4 class="text-[25px] font-bold text-left mb-4">
                        Simontana - Kemenhut
                    </h4>
                    <div>
                        <p class="font-bold">
                            Definisi:
                        </p>
                        <p class="text-[.95rem] leading-relaxed text-left mb-4">
                            Deforestasi adalah perubahan kelas penutupan
                            lahan hutan alam, baik primer atau sekunder
                            menjadi kelas penutupan lahan non hutan.
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">
                            Apa yang diukur?
                        </p>
                        <ul class="list-disc ml-4">
                            <li>
                                Deforestasi Bruto: Perubahan Hutan menjadi Non
                                Hutan.
                            </li>
                            <li>
                                Deforestasi Netto: Deforestasi Bruto – Reforestasi.
                            </li>
                            <li>
                                Deforestasi dari hutan tanaman hanya dihitung
                                sekali pada saat terjadi perubahan dari hutan
                                alam menjadi hutan Tanaman.
                            </li>
                            <li>
                                Gangguan alami seperti banjir, tanah longsor,
                                dinamika musiman terkait periode kering dan
                                basah serta faktor alam lainnya tidak termasuk
                                dalam cakupan analisis deforestasi.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-r border-r-[#bc4a3c] p-4">
                    <h4 class="text-[25px] font-bold text-left mb-4">
                        Simontana - Kemenhut
                    </h4>
                    <div>
                        <p class="font-bold">
                            Definisi:
                        </p>
                        <p class="text-[.95rem] leading-relaxed text-left mb-4">
                            Deforestasi merupakan gangguan pada vegetasi
                            pohon dengan tinggi minimal sekitar lima meter.
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">
                            Apa yang diukur?
                        </p>
                        <ul class="list-disc ml-4">
                            <li>
                                Kehilangan hutan akibat aktivitas manusia
                                maupun faktor alam termasuk dalam
                                deforestasi.
                            </li>
                            <li>
                                Semua kehilangan hutan alam baik bersifat
                                permanen maupun sementara tanpa dikurangi
                                tutupan hutan yang tumbuh kembali/reforestasi.
                            </li>
                            <li>
                                Deforestasi tidak terkait dengan panen atau
                                siklus pengelolaan hutan.
                            </li>
                            <li>
                                Kejadian kehilangan berulang pada lokasi yang
                                sama tidak dihitung lebih dari satu kali sejak
                                2001.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- slide ke 4 --}}
    <div class="max-w-4xl mx-auto px-6 py-20">
        {{-- slide ke 4 --}}
        <h2
            class="text-[clamp(1.6rem,3.5vw,2.8rem)] font-black leading-tight tracking-tight text-[#1a1a1a] text-center mb-16">
            Jenis kehilangan hutan alam yang diukur sebagai
            deforestasi
        </h2>
        <div class="my-8 mb-[50px] overflow-x-auto">
            <table class="w-full border-collapse text-[.9rem]">
                <thead>
                    <tr class="border-b-2 border-[#1a1a1a]">
                        <th class="p-4 text-left font-normal bg-[#fdf2f0] w-[34%]"></th>
                        <th class="p-4 text-center font-bold  bg-[#dc6657] w-[22%]">STADI – Simontini</th>
                        <th class="p-4 text-center font-bold bg-[#fdf2f0] w-[22%]">Simontana – Kemenhut</th>
                        <th class="p-4 text-center font-bold bg-[#fdf2f0] w-[22%]">GLAD-UMD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Aktivitas manusia</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Gangguan alam</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">–</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">–</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">✓</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Kebakaran</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Deforestasi sementara</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">–</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">✓</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Deforestasi permanen</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                        <td class="p-4 text-center font-bold">✓</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Kehilangan hutan alam primer dan sekunder</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">✓</td>
                        <td class="p-4 text-center bg-[#fdf2f0] text-[.75rem] leading-snug">fokus pada hutan primer tropis
                            matang, tidak termasuk hutan sekunder muda</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Deforestasi bersih</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">–</td>
                        <td class="p-4 text-center font-bold">✓</td>
                        <td class="p-4 text-center font-bold">–</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Deforestasi kotor</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">✓</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">✓</td>
                        <td class="p-4 text-center font-bold bg-[#fdf2f0]">✓</td>
                    </tr>
                    <tr class="border-b-2 border-[#1a1a1a]">
                        <td class="p-4 font-bold">Panen/siklus tanaman perkebunan</td>
                        <td class="p-4 text-center font-bold bg-[#dc6657]">–</td>
                        <td class="p-4 text-center font-bold">–</td>
                        <td class="p-4 text-center font-bold">–*</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- slide ke 5 --}}
    <div class="max-w-4xl mx-auto px-6 py-20">
        {{-- slide ke 5 --}}
        <h2
            class="text-[clamp(1.6rem,3.5vw,2.8rem)] font-black leading-tight tracking-tight text-[#1a1a1a] text-center mb-16">
            Jenis kehilangan hutan alam yang diukur sebagai
            deforestasi
        </h2>

        <div class="my-8 mb-[150px] overflow-x-auto">
            <table class="w-full border-collapse text-[.9rem]">
                <thead>
                    <tr class="border-b-2 border-[#1a1a1a]">
                        <th class="p-4 text-left font-normal bg-[#fdf2f0] w-[34%]"></th>
                        <th class="p-4 text-center font-bold  bg-[#dc6657] w-[22%]">STADI – Simontini</th>
                        <th class="p-4 text-center font-bold bg-[#fdf2f0] w-[22%]">Simontana – Kemenhut</th>
                        <th class="p-4 text-center font-bold bg-[#fdf2f0] w-[22%]">GLAD-UMD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Data input</td>
                        <td class="p-4 text-left bg-[#dc6657]">
                            <ul class="list-disc ml-4">
                                <li>
                                    2023-2024: Mosaik bulanan
                                    PlanetScope (4.77 meter)
                                </li>
                                <li>
                                    2025: Mosaic bulanan Sentinel 2 (10
                                    meter)
                                </li>
                            </ul>
                        </td>
                        <td class="p-4 text-left">
                            <ul class="list-disc ml-4">
                                <li>
                                    Hingga 2024: Mosaik Landsat (30
                                    meter)
                                </li>
                                <li>
                                    2025: Landsat Pansharpen (15m)
                                </li>
                            </ul>
                        </td>
                        <td class="p-4 text-center">Landsat (30 meter)</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Periode deforestasi</td>
                        <td class="p-4 text-center bg-[#dc6657]">Januari-Desember: per tahun sejak 2023</td>
                        <td class="p-4 text-left bg-[#fdf2f0]">
                            <ul class="list-disc ml-4">
                                <li>
                                    Juli-Juni: Per tahun sejak 2011 hingga
                                    2024
                                </li>
                                <li>
                                    Januari -Desember: Per tahun sejak
                                    2025
                                </li>
                            </ul>
                        </td>
                        <td class="p-4 text-center bg-[#fdf2f0]">Januari-Desember: Pertahun sejak 2001</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold">Unit pemetaan terkecil</td>
                        <td class="p-4 text-center bg-[#dc6657]">0.25 ha</td>
                        <td class="p-4 text-left">
                            <ul class="list-disc ml-4">
                                <li>
                                    Hingga 2024: 6,25 ha
                                </li>
                                <li>
                                    Sejak 2015: 1 ha
                                </li>
                            </ul>
                        </td>
                        <td class="p-4 text-center">0.09 ha</td>
                    </tr>
                    <tr class="border-b border-[#e2d0cc]">
                        <td class="p-4 font-bold bg-[#fdf2f0]">Metode klasifikasi/deteksi
                            deforestasi</td>
                        <td class="p-4 text-center bg-[#dc6657]">Deep learning U-Net (otomatis) +
                            verifikasi visual (hi-res image) dan
                            pengecekan lapangan</td>
                        <td class="p-4 text-left bg-[#fdf2f0]">
                            <p class="mb-5">
                                Interpretasi visual (manual) + machine
                                learning + pengecekan lapangan
                            </p>
                            <p>
                                Sejak 2025: Keputusan Dirjen Planologi
                                Kehutanan No. 17 Tahun 2025
                            </p>
                        </td>
                        <td class="p-4 text-center bg-[#fdf2f0]">Otomatis (machine learning)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
