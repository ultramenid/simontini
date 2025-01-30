@extends('layouts.stadiLayout')

@section('content')
    <!-- Single Sticky Text -->
    <div class="fixed bottom-36 left-[15%] w-[35%] text-4xl  text-white z-10 " id="stickyText" >Tahun lalu Auriga merilis data deforestasi
        2023 pada Maret. Mulai tahun ini, deforestasi
        tahunan akan dirilis setiap Januari.
    </div>

    <div id="parallax1" class="parallaxParent">
        <video autoplay loop muted playsinline class="object-center h-screen">
            <source src="https://simontini.id/assets/stadi2024/hero-1.MP4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div id="parallax2" class="parallaxParent">
        <video autoplay loop muted playsinline class="object-center h-screen">
            <source src="https://simontini.id/assets/stadi2024/hero-3.MP4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>




    {{-- <div id="parallax2" class="parallaxParent">
        <div style="background-image: url({{asset('assets/google-satelit.png')}}); background-size: cover; background-position: center; background-repeat: no-repeat;z-index: 20;"></div>
    </div> --}}

    <div class="max-w-2xl mx-auto px-4 mb-20">
        <div id="pendahuluan">
            <h1  class="text-3xl font-bold mt-12 text-simontini">PENDAHULUAN</h1>
            <p class="mt-6 leading-relaxed">Meski cenderung enggan–terlihat dari berbagai pernyataan penyelenggara negara, penolakan penggunaan terma, utak-atik definisi hutan, berbagai kebijakan yang masih membuka ruang–Pemerintah Indonesia pada dasarnya berupaya menekan deforestasi di Indonesia. Moratorium izin baru di hutan primer dan gambut dan FOLU Net Sink 2030 adalah contoh upaya tersebut.</p>
            <p class="mt-4 leading-relaxed">Namun demikian, data deforestasi tahunan Indonesia sejauh ini belum tersedia secara berkala, kecuali yang dipublikasi oleh Global Forest Watch kolaborasi Universitas Maryland dan World Resources Institute. Data deforestasi yang dirilis Pemerintah Indonesia melalui Kementerian Kehutanan, sebelumnya Kementerian Lingkungan Hidup dan Kehutanan, sejauh ini belum dapat disebut tahunan karena periodenya Juli-Juni sehingga, meski sepanjang 12 bulan, selalu mencakup bulan-bulan pada 2 tahun bersanding. Data deforestasi 12-bulan-an ini dipublikasi sejak 2012, setelah delapan publikasi sebelumnya per lintas-tahun (2012, 2009, 2006, 2003, 2000, 1996, dan 1990).</p>
            <p class="mt-4 leading-relaxed">Namun demikian, Pemerintah Indonesia hanya merilis data statistik deforestasi tersebut, tanpa disertai peta, sehingga menyulitkan untuk diverifikasi secara independen atau menyerap partisipasi publik. </p>
            <p class="mt-4 leading-relaxed">Perkembangan teknologi, terutama machine learning dan komputasi seperti Google Earth Engine, beserta tersedianya beragam citra satelit secara terbuka, seperti Landsat, Sentinel, dan Planet, mengakibatkan penyediaan data deforestasi tahunan, atau bahkan nyaris-kini (near real-time). Semangat transparansi dan partisipasi publik, guna menghentikan deforestasi, menjadi landasan Auriga Nusantara, yang juga menginisiasi dan mengkoordinir <a href="https://mapbiomas.id" target="_blank" class="underline text-simontini">MapBiomas Indonesia</a>, menghadirkan data deforestasi tahunan di setiap awal tahun.
            </p>
        </div>
        <div id="metodologi">
            <h1  class="text-3xl font-bold mt-12 text-simontini">METODOLOGI</h1>
            <p class="mt-6 leading-relaxed">Deforestasi yang dimaksud dalam kajian ini adalah hilangnya tutupan hutan alam, sehingga tidak menghitung kehilangan pada kebun kayu dan/atau hutan tanaman. Hutan alam merupakan asosiasi vegetasi yang didominasi tumbuhan berkayu yang tumbuh secara alami. Dengan demikian, hutan alam dalam terminologi ini mencakup baik hutan sekunder maupun hutan primer.</p>
            <p class="mt-4 leading-relaxed">Kebun kayu sendiri merupakan hamparan yang berisi tanaman berkayu yang dipanen secara periodik dalam rentang di bawah 10 tahun, sementara hutan tanaman adalah hamparan berisi tanaman berkayu namun tidak ditebang secara periodik di bawah 10 tahun.</p>
            <p class="mt-4 leading-relaxed">Kebun kayu di Indonesia dapat berupa hamparan kayu penghasil pulp atau kayu energi, yang oleh Kementerian Kehutanan disebut “hutan tanaman”, sehingga dimasukkan dalam kategori agrikultur atau pertanian. Hutan tanaman menurut kategori yang dibangun Auriga Nusantara semisal hamparan jati di Pulau Jawa, dan dikategorikan hutan.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestasi 2024 ini dihasilkan melalui tiga tahapan berikut:
                <ul class="list-decimal pl-10 mt-4">
                    <li class="leading-relaxed"><b>Deteksi dugaan deforestasi.</b> Dugaan deforestasi diperoleh dengan dua pendekatan:</li>
                    <ul class="list-[lower-alpha] pl-12">
                        <li class="leading-relaxed mt-4"><i>Deforestation alert</i> bulanan. Dugaan deforestasi bulanan ini dibangun dengan memanfaatkan alert deforestasi bulanan yang dikembangkan University of Maryland. <i>Alert</i> tersebut ditampalkan (<i>overlay</i>) dengan tutupan hutan 2023 MapBiomas Indonesia (yang akan dirilis dalam waktu dekat) sehingga terbuang alert di luar tutupan hutan (<i>false)</i>. Alert yang berada dalam tutupan hutan (<i>true</i>) kemudian diperluas (di-<i>buffer</i>) radius 1,5 kilometer atau disebut <i>scope area</i> (area tercakup). <i>Scope area</i> setiap bulan sepanjang 2024 ini, setelah membuang area tertutup awan yang dideteksi sebagai deforestasi, diklasifikasi dengan metode <i>change detection</i> terhadap tutupan hutan pada akhir Desember 2023. Hasil klasifikasi ini selanjutnya di-filter secara temporal dan spasial guna memastikan kejadian deforestasi dan menghapus area di bawah <i>minimum mapping unit</i> (0,25 hektare).
                        </li>
                        <li class="mt-4"><p class="leading-relaxed">Dugaan deforestasi tahunan. Dugaan deforestasi tahunan diidentifikasi berdasarkan perubahan nilai indeks vegetasi (NDVI - Normalized Difference Vegetation Index) terhadap tutupan hutan alam. NDVI diperoleh melalui ekstraksi Red band (kanal merah) dan NIR (Near-Infrared) pada citra satelit NICFI/Planet resolusi 4,7 meter. Berdasarkan pengukuran Tim Auriga Nusantara, nilai indeks vegetasi hutan alam berada pada nilai lebih dari 0,8 (pada rentang -1 sampai +1, yang mana NDVI area bervegetasi > 0,5), dan pengurangan NDVI lebih dari 0,2 terdeteksi sebagai deforestasi.</p>
                        <p class="mt-4 leading-relaxed">Patokan (baseline, atau T0) hutan alam dibangun dari kesesuaian (agreement) tutupan hutan alam 2017 MapBiomas Indonesia Koleksi 3–akan dirilis dalam waktu dekat– dan data tutupan vegetasi (Global Forest Canopy Height) yang dikembangkan oleh University of Maryland. Dengan demikian, tahun analisis (Tx) adalah 2018 dan tahun-tahun setelahnya, termasuk 2024. Pemilihan tahun awal ini disesuaikan dengan ketersediaan data citra satelit NICFI/Planet yang mencakup seluruh wilayah Indonesia. Selisih NDVI diukur pada waktu/semester/kuartal yang sama pada tahun analisis dengan T0.</p>
                        <p class="mt-4 leading-relaxed">Selanjutnya, untuk menghindarkan noise akibat tutupan/bayangan awan, dilakukan penyaringan (filtering) dengan membandingkannya terhadap area hutan alam tersisa (remaining forest mask) yang diperoleh dengan pengurangan baseline hutan alam dengan seluruh alert yang tersedia pada GLAD (Global Land Analysis and Discovery) dan RADD (Radar for Detecting Deforestation) sejak 2019. Sementara, spatial filter diterapkan untuk membuang area di bawah minimum mapping unit yang luasnya sebesar 100 pixel connected atau 250 meter persegi (0,025 ha).</p>
                        <p class="mt-4 leading-relaxed">Seluruh pengolahan dan analisis data dilakukan dalam platform Google Earth Engine (GEE), termasuk pemanfaatan teknologi komputasi virtual (cloud-based computing) yang dimilikinya.</p>
                        <p class="mt-4 leading-relaxed">Data yang dihasilkan kedua pendekatan tersebut kemudian digabungkan (merge) sehingga diperoleh 968.845 area (poligon) deforestasi yang keseluruhannya seluas 299.650 hektare.</p>
                        </li>

                    </ul>
                    <li class="mt-4 leading-relaxed">
                        <b>Inspeksi visual.</b> Area dugaan deforestasi di atas selanjutnya diinspeksi secara visual. Poligon demi poligon dugaan deforestasi dicek pada citra satelit NICFI/Planet resolusi 3 meter sepanjang 2024. Menimbang banyaknya poligon deforestasi, Auriga Nusantara memutuskan hanya menginspeksi seluruh dugaan deforestasi pada skala luas > 1 hektare.
                        <a href="https://simontini.id/assets/stadi2024/Stadi2024-2.jpg" class="glightbox1 mt-4">
                            <img src="https://simontini.id/assets/stadi2024/Stadi2024-2.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                        </a>
                    </li>
                    <li class="mt-4 leading-relaxed">
                        <p><b>Pemantauan lapangan.</b> Pemantauan ini dilakukan terhadap area-area tertentu sepanjang 2024. Pemilihan area pemantauan didasarkan pada keterwakilan kategori, yakni geografis, tipologi kawasan hutan, proyek pemerintah, dan konsesi berbasis lahan (tambang, kebun kayu, logging, dan sawit).
                        </p>
                        <p class="mt-4 leading-relaxed">
                            Sepanjang 2024, tim peneliti Auriga Nusantara mengunjungi area-area deforestasi di Aceh, Sumatera Utara, Riau, Jambi, Bengkulu, Sumatera Selatan, Kalimantan Barat, Kalimantan Tengah, Kalimantan Timur, Kalimantan Utara, Sulawesi Tengah, Gorontalo, Maluku Utara, Papua Barat Daya, dan Provinsi Papua. Secara keseluruhan, area deforestasi 2024 yang dikunjungi tim peneliti Auriga Nusantara merepresentasi area deforestasi seluas 22.350 hektare.
                        </p>

                    </li>
                </ul>
            </p>
        </div>
        <div id="deforestasi2024">
            <h1  class="text-3xl font-bold mt-12 text-simontini">DEFORESTASI 2024</h1>
            <p class="mt-6 leading-relaxed">
                Deforestasi Indonesia pada 2024 teridentifikasi seluas 261.575 hektare, meningkat 4.191 hektare dari deforestasi tahun sebelumnya yang tercatat seluas <a href="https://simontini.id/presentation/Deforestasi_Indonesia-2023-paparan.pdf" target="_blank" class="underline text-simontini">257.384</a> hektare. Deforestasi terjadi di seluruh pulau besar di Indonesia. Peningkatan deforestasi terjadi di Kalimantan dan Sumatera, sementara deforestasi di Sulawesi, Papua, Kepulauan Maluku, Jawa, Bali, dan Nusa Tenggara menurun.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20242.jpg" class="glightbox2 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20242.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                Deforestasi terjadi di seluruh provinsi Indonesia, kecuali DKI Jakarta. Bila 10 provinsi teratas deforestasi pada 2023 secara berurut adalah (1) Kalimantan Barat, (2) Kalimantan Tengah, (3) Kalimantan Timur, (4) Sulawesi Tengah, (5) Kalimantan Selatan, (6) Kalimantan Utara, (7) Riau, (8) Papua Selatan, (9) Papua Tengah, dan (10) Papua Barat; pada 2024 urutan ini dihuni (1) Kalimantan Timur, (2) Kalimantan Barat, (3) Kalimantan Tengah, (4) Riau, (5) Sumatera Selatan, (6) Jambi, (7) Aceh, (8) Kalimantan Utara, (9) Bangka Belitung, dan (10) Sumatera Utara.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20243.jpg" class="glightbox3 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20243.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                Pada 2024, deforestasi terjadi di 428 kabupaten/kota, atau pada 83% kabupaten/kota di Indonesia yang seluruhnya berjumlah 514. Terdapat 68 kabupaten yang memiliki deforestasi lebih dari 1.000 hektare. Sebagaimana terlihat pada tabel berikut, sembilan dari sepuluh teratas kabupaten yang mengalami deforestasi berada di Kalimantan.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20244.jpg" class="glightbox4 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20244.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-12 leading-relaxed">
                Dilihat dari segi status penguasaan lahan, 57% deforestasi terjadi pada lahan yang dikuasai negara atau kawasan hutan.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20245.jpg" class="glightbox4 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20245.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
            </a>
            <a href="https://simontini.id/assets/stadi2024/Stadi20246.jpg" class="glightbox5 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20246.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-2"/>
            </a>
            <a href="https://simontini.id/assets/stadi2024/Stadi20247.jpg" class="glightbox6 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20247.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-2"/>
            </a>
            <a href="https://simontini.id/assets/stadi2024/Stadi20248.jpg" class="glightbox7 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20248.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-2"/>
            </a>
            <a href="https://simontini.id/assets/stadi2024/Stadi20249.jpg" class="glightbox7 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20249.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-2"/>
            </a>
            <p class="mt-12 leading-relaxed">Sebagian besar hutan alam yang hilang pada 2024 merupakan habitat spesies langka dan dilindungi di Indonesia. Tabel berikut memperlihatkan luas habitat megafauna ikonik (flagship species) yang dilindungi oleh regulasi di Indonesia.</p>
            <a href="https://simontini.id/assets/stadi2024/Stadi202411.jpg" class="glightbox4 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi202411.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
            </a>
        </div>
        <div id="diskusi">
            <h1  class="text-3xl font-bold mt-20 text-simontini">DISKUSI</h1>
            <ul class="list-decimal pl-5 mt-6">
                {{-- diskusi-1 --}}
                <li class="font-bold">Deforestasi legal sebagai ancaman terbesar</li>
                <div id="diskusi-1">
                    <p class="mt-4 leading-relaxed">Sistem dan detail hukum Indonesia pada dasarnya tidak melarang deforestasi karena sepanjang pemerintah menerbitkan izin maka pada dasarnya pemilik izin dapat melakukan deforestasi. Sejak diberlakukannya Omnibus Law, proyek pemerintah dapat leluasa membabat hutan-hutan alam yang ada.</p>
                    <p class="mt-4 leading-relaxed">
                        Benar, bahwa di dalam konsesi pun perusahaan tidak boleh semena-mena melakukan deforestasi karena harus mendapatkan persetujuan rencana kerja tahunan (RKT) untuk konsesi kehutanan, atau rencana kerja anggaran dan biaya (RKAB) untuk konsesi pertambangan. Pada konsesi sawit, izin konversi dilakukan melalui pelepasan kawasan hutan. Yang menjadi masalah, pemerintah tidak pernah merilis RKT perusahaan kehutanan, RKAB perusahaan pertambangan, maupun peta detail pelepasan kawasan hutan untuk perusahaan sawit. Oleh karena itu, pembabatan hutan alam dalam izin konversi (kebun kayu, sawit, dan pertambangan) sangat terbuka dilakukan secara legal oleh pemilik/pengelola konsesi tersebut.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Hanya 3% deforestasi 2024 yang terjadi di kawasan konservasi, sementara 5% terjadi di hutan lindung, 49% di hutan produksi, dan 43% di luar kawasan hutan. Ditelisik lebih dalam, sebagian besar deforestasi di hutan lindung dan hutan produksi terjadi di daerah berizin, baik sebagai pemanfaatan atau pengusahaan hutan (baca: konsesi) maupun program pemerintah, seperti proyek strategis nasional (PSN). Artinya, 97% deforestasi yang terjadi pada 2024 adalah dapat berupa deforestasi legal.
                    </p>
                </div>

                {{-- diskusi-2 --}}
                <li class="font-bold mt-12">Deforestasi terbesar kembali terjadi di Kalimantan</li>
                <div id="diskusi-2">
                    <p class="mt-4 leading-relaxed">Kalimantan kembali menjadi pulau pemilik deforestasi tahunan terluas pada 2024. Pulau ini mengalami deforestasi tahunan terluas secara beruntun pada sebelas tahun terakhir. Bahkan, berbeda dengan pulau lainnya yang relatif stagnan, deforestasi Kalimantan justru meningkat drastis setiap tahun sejak 2021.</p>
                    <a href="https://simontini.id/assets/stadi2024/Stadi202412.jpg" class="glightbox9 mt-4">
                        <img src="https://simontini.id/assets/stadi2024/Stadi202412.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                    </a>
                    <p class="mt-4 leading-relaxed">
                        Penunjukan satu daerah di Kabupaten Penajam Paser Utara menjadi Ibukota Negara (IKN) tampaknya menjadi salah satu musabab meningkatnya deforestasi ini, terlihat dari adanya usulan Pemerintah Provinsi Kalimantan Timur mengubah rencana tata ruang provinsi tersebut yang, bila disetujui, berdampak pelepasan atau berubahnya fungsi 736.055 hektare kawasan hutan eksisting. Demikian juga Kalimantan Utara mengajukan proses serupa yang berpotensi berdampak pada 762.947 hektare kawasan hutan eksisting. Salah satu argumen yang disampaikan kedua provinsi tersebut adalah pengembangan ekonomi sejalan dengan keberadaan IKN.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Ditilik secara komoditas, deforestasi akibat pengembangan kebun kayu (29.898 ha), tambang (23.583 ha), dan sawit (23.430 ha) menjadi musabab utama deforestasi di Kalimantan. Deforestasi oleh ketiga komoditas ini mencakup 59% deforestasi di seluruh Pulau Kalimantan. Sepuluh teratas area deforestasi oleh pengembangan ketiga komoditas tersebut di Pulau Kalimantan pada 2024 adalah sebagai berikut:
                    </p>
                    <a href="https://simontini.id/assets/stadi2024/Stadi202410.jpg" class="glightbox10 mt-4">
                        <img src="https://simontini.id/assets/stadi2024/Stadi202410.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                    </a>
                </div>

                {{-- diskusi-3 --}}
                <li class="font-bold mt-12">Kebun kayu sebagai biang deforestasi</li>
                <div id="diskusi-3">
                    <p class="mt-4 leading-relaxed">Pada 2023, pengembangan kebun kayu menjadi penyebab deforestasi terbesar di Indonesia. Pengembangan kebun kayu ini terutama terjadi di Pulau Kalimantan. Meski luas deforestasinya sedemikian besar, namun terjadi hanya di beberapa konsesi. </p>
                    <p class="mt-4 leading-relaxed">Situasi ini berlanjut pada 2024, bahkan hampir seluruhnya di konsesi yang sama atau memiliki keterhubungan kepemilikan. Sebagai misal, deforestasi masif di konsesi kebun kayu PT Mayawana Persada di Kalimantan Barat meluas signifikan pada 2024. Demikian juga di konsesi PT Industrial Forest Plantation di Kalimantan Tengah. Meski koalisi masyarakat sipil telah mengungkap deforestasi di kedua konsesi ini pada tahun sebelumnya, yakni laporan Babat Kalimantan (2023) mengenai deforestasi di PT Industrial Forest Plantation dan Pembalak Anonim (Maret 2024) mengenai deforestasi di PT Mayawana Persada, namun deforestasi di kedua konsesi tetap terjadi pada 2024.</p>
                    <p class="mt-4 leading-relaxed"> Namun, terdapat juga kebun kayu yang bermula pada 2024, sebagaimana terjadi pada 3 konsesi bersebelahan, PT Meranti Laksana, PT Meranti Lestari, dan PT Lahan Cakrawala, di Kabupaten Melawi, Kalimantan Barat yang bermula pada paruh kedua 2024. Periset Auriga Nusantara mendokumentasikan deforestasi pada November 2024, dan dalam waktu dekat akan dipublikasi pada laporan tersendiri.</p>
                    <p class="mt-4 leading-relaxed">Deforestasi oleh pembangunan kebun kayu tampaknya akan berlanjut di Kalimantan pada tahun mendatang. Penyebabnya, diterbitkannya izin oleh pemerintah untuk pendirian pabrik pulp raksasa PT Phoenix Resources Internasional di Tarakan, Kalimantan Utara. Padahal, tidak ada kejelasan, setidaknya yang disampaikan secara terbuka ke publik, sumber bahan baku pabrik ini. Dan, yang paling mengkhawatirkan, terdapat indikasi keterhubungan kepemilikan/kepengurusan/pengelolaan PT Phoenix Resources International dengan PT Mayawana Persada, PT Industrial Forest Plantation, PT Meranti Laksana, PT Meranti Lestari, dan PT Lahan Cakrawala.</p>
                    <p class="mt-4 leading-relaxed">Pembangunan kebun kayu sebagai biang deforestasi 2024 tidak hanya oleh industri pulp, tapi juga oleh kebun kayu energi atau biomassa, sebagaimana terjadi di PT Inti Global Laksana, PT Banyan Tumbuh Lestari, dan PT Biomasa Jaya Abadi, ketiganya bersebelahan di Gorontalo, PT Malinau Hijau Lestari di Kalimantan Utara, PT Jaya Bumi Paser di Kalimantan Timur, dan PT Babugus Wahana Lestari di Kalimantan Tengah. </p>
                    <p class="mt-4 leading-relaxed">Deforestasi oleh pembangunan kebun kayu biomassa ini juga tampaknya akan tetap berlanjut pada tahun mendatang mengingat (1) tingginya permintaan pasar, terutama Jepang dan Korea Selatan, (2) kebijakan kelistrikan nasional yang membuka ruang penggunaan biomassa berbasis kayu sebagai bahan bakar listrik hingga kisaran 5-10% pada 2030, dan (3) meningkatnya secara drastis konsesi kebun kayu biomassa yang diterbitkan Kementerian Kehutanan. Peringatan akan tingginya deforestasi oleh pembangunan kebun kayu biomassa ini telah disuarakan koalisi masyarakat sipil melalui laporan <a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id" target="_blank" class="underline text-simontini">Unheeded Warnings: Forest Biomass Threats to Tropical Forests in Indonesia and Southeast Asia.</a> </p>
                </div>


                {{-- diskusi-4 --}}
                <li class="mt-12 font-bold">Sawit yang tetap memangsa hutan alam Indonesia</li>
                <div id="diskusi-4">
                    <p class="mt-4 leading-relaxed">
                        <i>“.. ke depan kita harus tambah tanam kelapa sawit. Enggak usah takut .. membahayakan deforestation,”</i> <a href="https://youtu.be/faoo-qTC9Rg?si=MgZGUFJDCbtoQStH" target="_blank" class="underline text-simontini">demikian Presiden Prabowo</a> pada pengarahan Musyawarah Pembangunan Nasional (Musrenbangnas) 30 Desember 2024. Entahlah karena sejalan dengan pemikiran ini, atau malah sebaliknya Prabowo sedang membangun pembenaran pada ekspansi sawit yang mengkonversi hutan alam. Yang jelas, pada 2024 deforestasi oleh pembangunan kebun sawit tetap tinggi di Indonesia, terutama di Sumatera dan Kalimantan. Deforestasi oleh pembangunan kebun sawit pada 2024 teridentifikasi seluas 37.483hektare, atau mencakup 14% dari keseluruhan deforestasi.
                    </p>
                    <p class="mt-4 leading-relaxed">Deforestasi oleh sawit cenderung terjadi secara besar-besaran di hampir setiap titik deforestasi sawit pada 2024, mengindikasikan bahwa pembangunan sawit-sawit ini dilakukan oleh korporasi atau ditopang oleh pemodal besar. Bukan oleh pekebun sawit rakyat (kategori luas di bawah 25 hektare). Hal ini terlihat dengan deforestasi sawit seluas 2.019 hektare di konsesi PT Borneo International Anugerah (BIA) di Kalimantan Barat, atau deforestasi seluas 1.347 hektare di konsesi PT Alam Lestari Indah di Kalimantan Tengah. Tidak hanya di konsesi sawit, deforestasi oleh sawit terjadi juga di konsesi kebun kayu PT Diamond Raya Timber di Provinsi Riau.</p>
                </div>


                {{-- diskusi-5 --}}
                <li class="font-bold mt-12">Nikel, emas, kebun kayu: tiga pengancam hutan Sulawesi</li>
                <div id="diskusi-5">
                    <p class="mt-4 leading-relaxed">
                        Deforestasi di Sulawesi mengalami penurunan signifikan pada 2024. Namun demikian, mengingat luas tutupan hutan di pulau ini yang sangat jauh di bawah Papua, Kalimantan, dan Sumatera, angka deforestasi tersebut tetap harus diperhatikan serius. Deforestasi di Sulawesi secara berurut terjadi di Sulawesi Tengah, Sulawesi Tenggara, Gorontalo, Sulawesi Barat, Sulawesi Selatan, dan Sulawesi Utara.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Berbeda dengan Kalimantan yang relatif datar, Pulau Sulawesi dominan bergelombang perbukitan. Pulau yang seluruhnya masuk dalam wilayah Wallacea ini dikenal dengan tingkat endemismenya yang tinggi, baik flora maupun fauna, terutama burung. Karenanya, selain sangat potensial mengakibatkan longsor dan banjir bandang, deforestasi di pulau ini juga potensial memicu kepunahan spesies yang lebih tinggi.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Ditilik berdasarkan komoditas, industri nikel menjadi penyebab deforestasi terbesar di Sulawesi. Tercatat deforestasi oleh industri ini seluas 4.262 hektare, yang terjadi di 210 konsesi di Sulawesi Tengah, Sulawesi Tenggara, dan Sulawesi Selatan.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Catatan khusus perlu diberikan kepada Provinsi Gorontalo, sebuah provinsi kecil di bagian utara Sulawesi. Dengan hutan alam yang relatif kecil namun mengalami deforestasi seluas 2.180 hektare pada 2024. Sebanyak 71% deforestasi ini terjadi oleh pengembangan kebun kayu energi (biomassa) oleh konsesi bersebelahan PT Inti Global Laksana dan PT Banyan Tumbuh Lestari yang memasok pabrik <i>wood pellet</i> PT Biomasa Jaya Abadi yang terletak di dalamnya. Analisis Auriga Nusantara, yang akan dirilis dalam waktu dekat, menunjukkan adanya keterhubungan kepemilikan ketiga perusahaan ini.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Pembentukan pulau ini yang sarat dengan kegiatan vulkanologi mengakibatnya mengandung komoditas pertambangan yang tinggi. Tidak hanya nikel, pulau ini juga mengandung cadangan emas yang relatif tinggi. Sayangnya, potensi ini justru mengancam tutupan hutan alamnya. Deforestasi oleh aktivitas pertambangan emas teridentifikasi setidaknya seluas 181 hektare pada 2024. Namun demikian, angka tersebut adalah yang terjadi di dalam wilayah izin usaha pertambangan, sementara aktivitas ini bahkan teridentifikasi merangsek ke berbagai kawasan konservasi, seperti Suaka Margasatwa Nantu di Gorontalo, Taman Nasional Bogani Nani Wartabone.
                    </p>
                </div>

                {{-- diskusi-6 --}}
                <li class="font-bold mt-12">Deforestasi nikel merangsek Tanah Papua</li>
                <div id="diskusi-6">
                    <p class="mt-4 leading-relaxed">Publik mungkin masih mengira bahwa Raja Ampat adalah gugusan 610 pulau kecil yang tidak terjamah perusakan alam, terutama karena gugusan pulau dikelilingi laut tenang nan indah penuh terumbu karang. Iya, gugusan pulau yang dijadikan sebagai satu kabupaten di Papua Barat Daya ini memang dikenal sebagai daerah tujuan wisata oleh keindahan alamnya, terutama hamparan laut berisi terumbu karang. Tak kurang Presiden Jokowi pernah menghabiskan malam tahun baru di pulau ini. Bahkan, UNESCO menobatkan Raja Ampat sebagai kawasan geopark.</p>
                    <p class="mt-4 leading-relaxed">
                        Akan tetapi, area sekeramat itu secara nasional dan internasional tak tahan menghadapi gempuran tambang nikel. Setidaknya daratan 4 pulau kecil, yakni Pulau Gag, Pulau Waigeo, Pulau Manuram, dan Pulau Kawei, di Raja Ampat telah dijamah tambang nikel. Analisis citra satelit mengindikasikan hingga 2024 telah terjadi deforestasi akibat penambangan nikel seluas 174 hektare di keempat pulau ini.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Tidak hanya itu, satu izin tambang nikel baru, meski belum beroperasi, telah diterbitkan di Pulau Batang Pele dan Manyaifun. Izin tambang nikel ini diterbitkan untuk PT Mulia Raymond Perkasa.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Deforestasi nikel tampaknya akan meluas di Tanah Papua, karena telah terdapat 5 izin tambang di pulau paling timur Indonesia ini. Seluruh izin ini mencakup area seluas 38.529 hektare, dengan 58%, atau 22.452 hektare, berupa tutupan hutan alam.
                    </p>
                </div>

                {{-- diskusi-7 --}}
                <li class="font-bold mt-12">Deforestasi juga massif di kawasan konservasi</li>
                <div id="diskusi-6">
                    <p class="mt-4 leading-relaxed">
                        Pada 31 Oktober 2024 koalisi masyarakat sipil Ekspedisi Indonesia Baru, HAKA Aceh, Forest Watch Indonesia, Greenpeace Indonesia, Pusaka Belantara Rakyat, dan Auriga Nusantara merilis film <b>17 Sweet Letters</b> pada perhelatan Conference on Parties ke-16 Konvensi Keragaman Hayati di Cali, Colombia. Film yang dalam versi Bahasa Indonesia berjudul <b>17 Surat Cinta</b> dan dirilis di dalam negeri pada 17 November 2024 ini berkisah bagaimana deforestasi bertahun-tahun berlangsung dalam kawasan konservasi Suaka Margasatwa Rawa Singkil, Aceh. Aktivis konservasi telah mengirim 17 surat pengaduan ke pemerintah, tapi deforestasi tetap berlanjut. Sepanjang 2024 teridentifikasi 159 hektare deforestasi di habitat gajah, orangutan, dan berbagai satwa ikonik ini.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Deforestasi dalam kawasan konservasi teridentifikasi seluas 7.704 hektare sepanjang 2024, terjadi di 37 provinsi pada berbagai kategori kawasan konservasi, yakni taman nasional, suaka margasatwa, cagar alam, taman hutan raya, taman wisata alam, taman buru.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Deforestasi dalam kawasan konservasi harus menjadi perhatian tersendiri karena telah dibentuk secara spesifik badan pengelolanya, yakni balai konservasi sumber daya alam atau unit pengelola teknis, dan secara tegas dilarang oleh setidaknya 4 undang-undang (UU), yakni UU Konservasi, UU Kehutanan, UU Lingkungan Hidup, dan UU Pemberantasan Illegal Logging.
                    </p>
                </div>
            </ul>
        </div>

        <div id="rekomendasi">
            <h1  class="text-3xl font-bold mt-12 text-simontini">REKOMENDASI</h1>
            <p class="mt-6 leading-relaxed">
                Saat ini, perlindungan hukum terhadap hutan alam di Indonesia hanya terdapat pada hutan-hutan alam yang berada di kawasan konservasi, karena perbuatan mengkonversi tutupan dan/atau bentang alam tidak diperbolehkan dilakukan di dalamnya. Dari total 22,4 juta hektare kawasan konservasi di Indonesia, 17,3 juta hektare berupa tutupan hutan alam.
            </p>
            <p class="mt-4 leading-relaxed">
                Memang ada kebijakan moratorium izin baru di hutan primer (dan gambut). Tapi, harus digarisbawahi bahwa moratorium ini adalah bentuk kebijakan, bukan peraturan, sehingga perlindungannya tidak tetap atau permanen. Moratorium ini secara formal disebut Peta Indikatif Penundaan Pemberian Izin Baru (PIPPIB) pada Hutan Alam Primer dan Lahan Gambut, yang ditunjuk melalui Surat Keputusan Menteri Lingkungan Hidup dan Kehutanan. Pada SK terakhir, November 2023, PIPPIB seluas 66,3 juta hektare. Analisis spasial terhadap peta ini menunjukkan hutan alam di dalamnya seluas 53,5 juta hektare. Namun begitu, seluruh kawasan konservasi dimasukkan dalam PIPPIB.
            </p>
            <p class="mt-4 leading-relaxed">
                Terhadap hutan alam di luar kedua hal di atas tidak ada perlindungan hukum atau kebijakan sama sekali. Karena itu, misalnya, Menteri Kehutanan Raja Juli Antoni dengan mudahnya menyebut akan menyediakan <a href="https://www.youtube.com/watch?v=xaRhYDmVTWc" target="_blank" class="underline text-simontini">20 juta hektare kawasan hutan</a> untuk cadangan pangan, energi, dan air.
            </p>
            <p class="mt-4 leading-relaxed">
                Sementara, sebagaimana Koleksi 3 MapBiomas Indonesia, hutan alam di Indonesia saat ini seluas 94,9 juta hektare, yang 52,9 juta hektare di antaranya berada di area PIPPIB. Artinya, 42 juta hektare hutan alam tersebut tidak memiliki perlindungan hukum atau kebijakan. Bahkan, agregat 9 juta hektare di antaranya berada di dalam konsesi konversi, seperti sawit (2,3 juta ha), tambang (3,2 juta ha), kebun kayu (3,5 juta ha).
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi202413.jpg" class="glightbox11 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi202413.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                Perlindungan hukum terhadap hutan alam ini idealnya dalam bentuk undang-undang. Namun, menghadirkan sebuah undang-undang bukan perkara mudah, dan kerap butuh bertahun-tahun. Peraturan di bawahnya, yakni peraturan pemerintah, pun tidak jarang memerlukan waktu lama, terutama oleh kerumitan dan kompleksitas memperoleh persetujuan lintas kementerian, sebuah prasyarat yang diperlukan oleh satu peraturan pemerintah.
            </p>
            <p class="mt-4 leading-relaxed">
                Karena itu, terobosan hukum yang bisa dilakukan dalam waktu cepat adalah dalam bentuk peraturan presiden, yang kekuatannya relatif setara dengan peraturan pemerintah. Oleh karena itu, saatnya <b>Presiden Prabowo Subianto menerbitkan peraturan presiden yang memberikan perlindungan hukum terhadap seluruh hutan alam tersisa di Indonesia.</b>
            </p>
            <div class="flex w-full justify-center mt-6">
                <a>[ t e r i m a  k a s i h ]</a>

            </div>
        </div>
    </div>

@endsection


@push('scripts')
<script>
    $(function () {

        function createLightbox(selectorID) {
            const lightbox = GLightbox({
                selector: selectorID,
                touchNavigation: true,
            });
        }
        for (let i = 1; i <= 11; i++) {
            createLightbox(`.glightbox${i}`);
        }



        var controller1 = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});

        new ScrollMagic.Scene({triggerElement: "#parallax1"})
            .setTween("#parallax1 video", {y: "80%", ease: Linear.easeNone})
            // .addIndicators()
            .addTo(controller1);

        new ScrollMagic.Scene({triggerElement: "#parallax2"})
            .setTween("#parallax2 video", {y: "80%", ease: Linear.easeNone})
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
