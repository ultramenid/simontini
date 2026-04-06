@extends('layouts.stadi2025')

@section('meta')
  @include('partials.insightMeta')
@endsection

@section('content')
  <div id="site-loader" role="status" aria-live="polite" aria-label="Memuat halaman SIMONTINI">
    <div class="loader-mark">
      <img src="{{ asset('assets/images/logo1.png') }}" alt="" class="">
      <!-- <div class="loader-title">SIMONTINI</div> -->
      <div class="loader-sub">Status Deforestasi Indonesia 2025</div>
      <div class="loader-bar"><span></span></div>
    </div>
  </div>


  <!-- STICKY NAV -->
  <nav id="sitenav"
    class="fixed top-0 left-0 right-0 z-[100] flex items-center justify-between h-[52px] px-[5vw] bg-[rgba(245,240,232,.92)] backdrop-blur-md border-b border-[#e2d8cc]">
    <div
      class="nav-brand flex items-center gap-1.5 uppercase tracking-[0.18em] text-[#8b2a1a] text-[.65rem] font-semibold">
      <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo1.png') }}" alt="" class="h-8"></a>
    </div>
    <div class="nav-actions">
      <ul class="nav-links flex list-none">
        <li><a href="#pendahuluan">Pendahuluan</a></li>
        <li><a href="#metodologi">Metodologi</a></li>
        <li><a href="#deforestasi">Deforestasi 2025</a></li>
        <li><a href="#konsesi">Konsesi</a></li>
        <li><a href="#diskusi">Diskusi</a></li>
        <li><a href="#rekomendasi">Rekomendasi</a></li>
      </ul>
      <div class="global-lang" aria-label="language switcher">
        <button type="button" id="lang-id" class="g-lang-btn active">ID</button>
        <button type="button" id="lang-en" class="g-lang-btn">EN</button>
      </div>
    </div>
  </nav>
  <section id="hero">
    <h1>Status Deforestasi Indonesia 2025</h1>
    <div class="hero-meta">
      <div class="hero-stat">
        <span class="hs-val">433.751</span>
        <span class="hs-unit">Hektare</span>
      </div>
      <div class="hero-divider"></div>
      <!-- <div class="hero-stat">
                                             <span class="hs-val">+66%</span>
                                             <span class="hs-unit">Peningkatan dari 2024</span>
                                             </div> -->
      <div class="hero-divider"></div>
      <div class="hero-desc">
        Deforestasi melonjak, saatnya pemerintah menerbitkan
        regulasi yang melindungi seluruh hutan alam tersisa
      </div>
    </div>
    <div class="scroll-hint">
      <div class="scroll-dot"></div>
    </div>
  </section>

  <!-- PENDAHULUAN -->
  <span class="s-anchor" id="pendahuluan"></span>

  <section class="page-section px-[5vw]">
    <div class="section-label">01 / Pendahuluan</div>
    <p class="lead">
      Pada November 2021 dalam ajang KTT Iklim ke-26 Glasgow, Skotlandia, pemimpin 144 negara, termasuk Indonesia,
      menandatangani
      <a href="https://webarchive.nationalarchives.gov.uk/ukgwa/20230418175226/https:/ukcop26.org/glasgow-leaders-declaration-on-forests-and-land-use/"
        target="_blank" rel="noopener noreferrer" style="color: #bc4a3c;">Glasgow Leaders</a>.
      Declaration on Forest and Land Use atau Glasgow Declaration. Deklarasi ini merupakan kesepakatan untuk bekerja
      secara kolektif menghentikan dan membalik hilangnya hutan dan degradasi lahan.
    </p>
    <p class="body-text">
      Di Indonesia, upaya untuk menghentikan deforestasi atau hilangnya hutan alam tidak bermula dari deklarasi tersebut.
      Satu dekade sebelumnya, Presiden Susilo Bambang Yudhoyono menandatangani Instruksi Presiden No. 10 tahun 2011, biasa
      disebut
      <a href="https://peraturan.bpk.go.id/Download/68485/Inpres_no_10_2011.pdf" target="_blank" rel="noopener noreferrer"
        style="color: #bc4a3c;">Inpres Moratorium</a>,
      yang melarang penerbitan izin konversi di hutan alam primer dan lahan gambut dilindungi. Presiden Joko Widodo yang
      meneruskan kebijakan tersebut juga menerbitkan Instruksi Presiden No. 8 tahun 2018, atau Inpres
      <a href="https://peraturan.bpk.go.id/Download/261461/Inpres%20Nomor%208%20Tahun%202018.PDF" target="_blank"
        rel="noopener noreferrer" style="color: #bc4a3c;">Moratorium Sawit</a>,
      yang diharapkan dapat mengoptimalkan kebun-kebun sawit eksisting dan menghentikan laju deforestasi oleh ekspansi
      sawit.
    </p>
    <p class="body-text">
      Indonesia pun meratifikasi Kesepakatan Paris (Paris Agreement), yang dimaksudkan untuk menahan kenaikan suhu global
      di bawah 2°C, sembari berupaya membatasi kenaikannya maksimum 1,5°C dari era pra-industri. Dalam kerangka ini,
      Pemerintah Indonesia menerbitkan
      <a href="https://peraturan.bpk.go.id/Download/180699/Perpres%20Nomor%2098%20Tahun%202021.pdf" target="_blank"
        rel="noopener noreferrer" style="color: #bc4a3c;">Peraturan Presiden No. 98 tahun 2021</a>
      tentang Penyelenggaraan Nilai Ekonomi Karbon dan menerjemahkannya lebih rinci melalui Keputusan Menteri LHK No. 168
      tahun 2022 tentang Indonesia’s
      <a href="https://eos.co.id/main/wp-content/uploads/2022/03/1647210373656.pdf" target="_blank"
        rel="noopener noreferrer" style="color: #bc4a3c;">FOLU Net Sink 2030</a>
      untuk Pengendalian Perubahan Iklim.
    </p>
    <p class="body-text">
      Berbagai kebijakan tersebut membuat deforestasi di Indonesia menurun dalam lima tahun berturut-turut sejak 2017.
      Namun, sejak 2022 deforestasi Indonesia kembali meningkat, sebagaimana terlihat dalam grafik berikut. Bahkan,
      deforestasi di Indonesia melonjak pada 2025.
    </p>
    <!-- embedded chart using TailwindUI layout -->
    <div class="viz-block viz-block--full mt-12 mb-2" id="chart-app-wrap">
      <div class=" ">
        <div id="chart-app" class="w-full bg-black py-6 md:py-12">
          <div id="chart-inner" class="flex flex-col md:flex-row px-4 w-full max-w-[980px] mx-auto gap-4 min-h-[360px]">
            <div id="chart-viz" class="flex-1 min-w-0">
              <div class="chart-header mb-4">
                <h2 class="chart-title text-white text-lg md:text-xl font-bold tracking-tight mb-1">Deforestasi Indonesia,
                  2001–2025</h2>
                <p class="chart-sub text-[#7a9e97] text-sm">Luas hutan yang hilang per tahun · hektare</p>
              </div>
              <div id="chart-body" class="relative flex h-full">
                <div id="y-axis" class="flex flex-col-reverse justify-between pb-[78px] w-[52px] md:w-[72px] shrink-0">
                </div>
                <div id="bars-wrap" class="relative flex-1 flex flex-col">
                  <div id="grid-lines" class="relative flex flex-col-reverse justify-between flex-1"></div>
                  <div id="bars-svg-wrap" class="absolute inset-x-0 top-0 bottom-[78px] grid items-end gap-[3px] px-0.5">
                  </div>
                  <div id="x-axis" class="grid gap-[3px] px-[2px] mt-0 h-[78px] items-start"></div>
                </div>
              </div>
            </div>
            <div id="detail-panel"
              class="w-full md:w-[280px] bg-[#1a2826] border-t md:border-t-0 md:border-l border-[rgba(255,255,255,.07)] flex flex-col">
              <div class="panel-inner p-4 flex flex-col h-full overflow-y-auto">
                <div class="w-full justify-between flex sm:flex-col flex-row">
                  <div class="panel-header mb-4">
                    <div class="ph-title text-[#e07060] text-xs font-bold uppercase tracking-widest mb-1">Era Kepemimpinan
                    </div>
                    <div class="ph-sub text-[rgba(255,255,255,.2)] text-xs">klik untuk sorot era</div>
                  </div>
                  <div class="year-display">
                    <div id="yd-year"
                      class="yd-label text-[#7a9e97] text-xs font-semibold uppercase tracking-[0.14em] mb-1">Arahkan
                      kursor ke bar</div>
                    <div id="yd-val" class="yd-val text-2xl font-bold text-white mb-1">—</div>
                    <div class="yd-unit text-sm text-[#7a9e97]">ha </div>
                  </div>
                </div>

                <div id="pres-list" class="space-y-2 grid grid-cols-2 md:grid-cols-1 gap-2"></div>
                <div class="panel-note text-[0.55rem] text-gray-600 mt-auto pt-3">Data: University of Maryland Lossyear ·
                  Auriga STADI<br>simontini.id</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- METODOLOGI -->
  <span class="s-anchor" id="metodologi"></span>
  <section class="page-section px-[5vw]  section-after-chart">
    <div class="section-body">
      <div class="section-label">02 / Metodologi</div>

      <p class="body-text">
        <strong>Tahapan dan pemrosesan data.</strong> Peta deforestasi 2025 diperoleh dengan pemodelan deep learning pada
        citra satelit Sentinel. Tahapannya sebagai berikut.
      </p>

      <div class="method-steps">
        <div class="method-step">
          <div class="ms-num">01</div>
          <div class="body-text">
            <p>
              <em>Pertama, </em>
              pemodelan deforestasi. Pengetahuan yang terkumpul selama ini, seperti dari pemantauan lapangan dan data-data
              deforestasi
              <a href="https://simontini.id/presentation/Deforestasi_Indonesia-2023-paparan.pdf" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">2023</a>

              dan
              <a href="https://simontini.id/id/status-deforestasi-indonesia-2024" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">2024</a>,
              dimodelkan dengan
              <em>deep learning</em>
              U-Net. Model ini kemudian dilatih
              (<em>training</em>) pada citra satelit Sentinel resolusi 10 meter.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">02</div>
          <div class="body-text">
            <!-- <h4>Inspeksi visual</h4> -->
            <p>
              <em>Kedua</em>, penentuan area cakupan (<em>scoping area</em>). Isyarat deforestasi (<em>deforestation
                alert</em>, atau biasa disebut GLAD alert) bulanan yang diproduksi Universitas Maryland dikumpulkan. Demi
              efektivitas, yang dikumpul hanya isyarat dengan tingkat kepercayaan tinggi (<em>high confidence</em>).
              Isyarat-isyarat ini kemudian “diikat” atau diagregasi pada satu kotak (<em>bounding box</em>) bersisi 10.240
              meter. Bounding boxes inilah yang menjadi area cakupan.

            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">03</div>
          <div class="body-text">
            <!-- <h4>Pemantauan lapangan</h4> -->
            <p>
              <em>Ketiga</em>, model deforestasi yang telah dibangun kemudian dijalankan pada citra satelit Sentinel 2
              resolusi 10 meter di area-area cakupan.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">04</div>
          <div class="body-text">
            <!-- <h4>Pemantauan lapangan</h4> -->
            <p>
              <em>Keempat</em>, area-area yang terdeteksi deforestasi (deforestasi indikatif) ditampalkan
              (<em>overlay</em>) dengan peta tutupan hutan. Terdapat 4 referensi tutupan hutan yang dipakai, yakni: (1)
              MapBiomas Indonesia, (2) Peta Penutupan Lahan yang diproduksi Kementerian Kehutanan, (3) Tropical-moist
              forest (TMF) yang diproduksi European Commission’s Joint Research Centre, dan (4) Forest Persistence yang
              diproduksi Google.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">05</div>
          <div class="body-text">
            <!-- <h4>Pemantauan lapangan</h4> -->
            <p>
              Kelima, proses verifikasi. Deforestasi indikatif yang terdapat di luar irisan keempat tutupan hutan
              referensi (forest-agreement area) diinspeksi secara visual. Berhubung banyaknya poligon, sementara waktu
              yang tersedia terbatas, poligon di bawah 1 hektare tidak dapat diinspeksi sehingga dihilangkan dari area
              deforestasi. Untuk deforestasi indikatif di dalam irisan tutupan hutan referensi (forest-agreement area) ,
              inspeksi visual maupun penapisan historikal (temporal filter) dilakukan pada area-area di atas 10 hektare
              berikut seluruh area di bawah 10 hektare dalam konsesi dan kawasan konservasi. Area yang dideteksi sebagai
              false atau bukan deforestasi dihilangkan dari data, sedangkan area yang tidak diinspeksi (di bawah 10
              hektare) dimasukkan ke dalam area deforestasi.
            </p><br>
            <p>
              Verifikasi juga dilakukan dengan melakukan kunjungan atau pendokumentasian lapangan. Secara keseluruhan,
              Auriga Nusantara mengunjungi 49.321 hektare area deforestasi—setara 11% deforestasi 2025—di 38 lokasi atau
              desa pada 28 kabupaten di 16 provinsi di Sumatera, Kalimantan, Sulawesi, Kepulauan Maluku, Nusa Tenggara,
              dan Tanah Papua.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">06</div>
          <div class="body-text">
            <!-- <h4>Pemantauan lapangan</h4> -->
            <p>
              <em>Keenam</em>, penapisan atau <em>filtering</em>. Dengan berfokus pada deforestasi yang diakibatkan oleh
              aktivitas manusia (<em>anthropogenic deforestation</em>), penapisan dilakukan dengan mengeluarkan area-area
              deforestasi akibat longsor atau pergeseran sungai. Misalnya tutupan hutan seluas 11.693 hektare yang hilang
              akibat longsor di Aceh, Sumatera Utara, dan Sumatera Barat saat bencana hidrometeorologi pada penghujung
              2025. Tutupan hutan yang hilang akibat pergeseran sungai juga relatif banyak terjadi di kawasan konservasi.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- step 1 --}}
  <div class="viz-block viz-block--full alur" style="margin-top: -60px !important;">
    <div style="background:#0d0d0d; margin-bottom:0;" class="alur-embed">
      <div style="background:#0d0d0d; border-radius:0;">
        <div class="embed-bar" style="background:#161616; border-bottom-color:rgba(255,255,255,.08);">
          <span class="embed-bar-title" style="color:rgba(255,255,255,.45);">Tahapan & Pemrosesan Data SIMONTINI</span>
        </div>
        <div class="flex items-center gap-1.5 px-4 py-2 sm:hidden"
          style="background:#161616; border-bottom:1px solid rgba(255,255,255,.05);">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
          <span style="font-size:.6rem; color:rgba(255,255,255,.3); letter-spacing:.08em;">geser untuk melihat alur
            lengkap</span>
        </div>

        <!-- ALUR INLINE — replaces <iframe src="alur.html"> -->
        <div id="alur-embed" class="bg-[#0e0e0e] font-poppins text-[#e8e2d8] antialiased overflow-x-auto px-4">

          <div class="px-4 sm:px-[60px] pt-6 pb-8 min-w-[680px] sm:min-w-0 max-w-[1400px] mx-auto relative" id="dwrap">

            <!-- ═══ ROW 1 · Deep Learning Modeling ═══ -->
            <div class="flex items-stretch border-t border-white/[0.07] relative" id="row1">
              <div
                class="w-[160px] min-w-[160px] pr-5 py-7 flex flex-col justify-center border-r border-white/[0.07] a-lane select-none"
                id="ll1" onclick="alurRowToggle(this)">
                <div class="text-[11px] font-bold tracking-[0.12em] mb-1.5 text-[#C75B2E]">01</div>
                <div class="text-[23px] font-bold text-[#e8e2d8] leading-[1.35]">Deep Learning Modeling</div>
                <div class="mt-2 a-chevron"><svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <polyline points="1,1 5,5 9,1" stroke="rgba(199,91,46,0.6)" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg></div>
              </div>
              <div class="steps flex-1 pl-8 flex items-center relative">

                <div class="flex items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r1c1" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Training Dataset</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Sentinel 2
                      × STADI 2024.<br>Sampel berlabel {0, 1}.</div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r1a1"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r1c2" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Normalisasi Dataset</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                      <ul class="pl-3.5">
                        <li class="mb-0.5">Cropping, tiling, slicing</li>
                        <li class="mb-0.5">Normalisasi citra</li>
                      </ul>
                    </div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r1a2"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r1c3" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Deep Learning — UNET</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                      <ul class="pl-3.5">
                        <li class="mb-0.5">Augmentasi &amp; rotasi</li>
                        <li class="mb-0.5">Encoder &amp; Decoder</li>
                        <li class="mb-0.5">Confusion Matrix</li>
                      </ul>
                    </div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r1a3"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex items-center [flex:0.8]">
                  <div
                    class="card flex-1 border border-[rgba(199,91,46,0.3)] bg-[rgba(199,91,46,0.06)] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="outmodel" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Ouput Model</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Model
                      pemetaan deforestasi siap pakai untuk deteksi skala besar.</div>
                  </div>
                </div>

              </div>
            </div>

            <!-- ═══ ROW 2 · Scoping Area ═══ -->
            <div class="flex items-stretch border-t border-white/[0.07] relative" id="row2">
              <div
                class="w-[160px] min-w-[160px] pr-5 py-7 flex flex-col justify-center border-r border-white/[0.07] a-lane select-none"
                id="ll2" onclick="alurRowToggle(this)">
                <div class="text-[11px] font-bold tracking-[0.12em] mb-1.5 text-[#C75B2E]">02</div>
                <div class="text-[23px] font-bold text-[#e8e2d8] leading-[1.35]">Scoping Area Deforestasi</div>
                <div class="mt-2 a-chevron"><svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <polyline points="1,1 5,5 9,1" stroke="rgba(199,91,46,0.6)" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg></div>
              </div>
              <div class="steps flex-1 pl-8 flex items-center relative">

                <div class="flex items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r2c1" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Penentuan Wilayah &amp; Periode</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                      <ul class="pl-3.5">
                        <li class="mb-0.5">Hutan alam 2024</li>
                        <li class="mb-0.5">Alert Januari–Desember</li>
                      </ul>
                    </div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r2a1"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r2c2" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Penapisan Alert</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">GLAD
                      confidence level 3 ∩ tutupan hutan 2024.</div>
                  </div>
                  <div class="arrow w-[50px] min-w-[50px] flex items-center justify-center shrink-0 a-arr" id="r2a2">
                    <svg viewBox="0 0 50 90" fill="none" width="50" height="90">
                      <line x1="0" y1="45" x2="18" y2="45" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="10" x2="18" y2="80" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="10" x2="40" y2="10" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="80" x2="40" y2="80" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="34,5 41,10 34,15" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                      <polyline points="34,75 41,80 34,85" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg>
                  </div>
                </div>

                <!-- True + False alert -->
                <div class="flex self-stretch items-stretch flex-1">
                  <div class="flex flex-col flex-1 gap-0">
                    <div class="flex items-center flex-1">
                      <div
                        class="card flex-1 bg-[rgba(46,139,90,0.06)] border border-[rgba(46,139,90,0.3)] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                        id="r2c3a" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">True Alert</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Alert
                          yang teridentifikasi sebagai kejadian deforestasi nyata. Diproses lebih lanjut.</div>
                      </div>
                      <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r2a3">
                        <svg viewBox="0 0 36 14" fill="none">
                          <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                          <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                            stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                        </svg>
                      </div>
                    </div>
                    <div class="flex items-center flex-1 mt-2">
                      <div
                        class="card flex-1 bg-transparent border border-white/[0.07] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#1e1e1e] a-card"
                        id="r2c3b" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#6b6460] leading-[1.3]">False Alert</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Positif
                          palsu — tidak diproses lebih lanjut dalam alur ini.</div>
                      </div>
                      <div class="w-[40px] min-w-[40px]"></div>
                    </div>
                  </div>
                </div>

                <div class="flex self-stretch [flex:0.8]">
                  <div class="flex flex-col flex-1">
                    <div class="flex items-center flex-1">
                      <div
                        class="card flex-1 border border-[rgba(199,91,46,0.3)] bg-[rgba(199,91,46,0.06)] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                        id="agreg" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Agregasi True Alert</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                          <ul class="pl-3.5">
                            <li class="mb-0.5">Pengelompokan alert</li>
                            <li class="mb-0.5">Jarak maks. 10.240 m</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 mt-2"></div>
                  </div>
                </div>

              </div>
            </div>

            <!-- ═══ ROW 3 · Deforestasi Indikatif (reversed) ═══ -->
            <div class="flex items-stretch border-t border-white/[0.07] relative" id="row3">
              <div
                class="w-[160px] min-w-[160px] pr-5 py-7 flex flex-col justify-center border-r border-white/[0.07] a-lane select-none"
                id="ll3" onclick="alurRowToggle(this)">
                <div class="text-[11px] font-bold tracking-[0.12em] mb-1.5 text-[#C75B2E]">03</div>
                <div class="text-[23px] font-bold text-[#e8e2d8] leading-[1.35]">Deforestasi Indikatif</div>
                <div class="mt-2 a-chevron"><svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <polyline points="1,1 5,5 9,1" stroke="rgba(199,91,46,0.6)" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg></div>
              </div>
              <div class="steps rev flex-1 pl-8 flex items-center relative flex-row-reverse">

                <div class="flex flex-row-reverse items-center flex-1">
                  <div
                    class="card flex-1 border border-[rgba(199,91,46,0.3)] bg-[rgba(199,91,46,0.06)] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="normcit" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Normalisasi Citra Sentinel 2</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                      <ul class="pl-3.5">
                        <li class="mb-0.5">Spasial &amp; temporal filter</li>
                        <li class="mb-0.5">Cloud masking</li>
                        <li class="mb-0.5">Seleksi band</li>
                      </ul>
                    </div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r3a1"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex flex-row-reverse items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="bbox" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Bounding Box</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Radius
                      10.240 m dari ID agregasi alert.</div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r3a2"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex flex-row-reverse items-center flex-1">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r3c3" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Akuisisi Citra Otomatis</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Download
                      Sentinel 2 per bulan kejadian secara otomatis.</div>
                  </div>
                  <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r3a3"><svg
                      viewBox="0 0 36 14" fill="none">
                      <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg></div>
                </div>

                <div class="flex flex-row-reverse items-center [flex:0.8]">
                  <div
                    class="card flex-1 border border-[rgba(199,91,46,0.3)] bg-[rgba(199,91,46,0.06)] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="dataindikatif" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Data Deforestasi Indikatif</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Prediksi
                      citra Sentinel via <em class="italic text-[#8a7e78]">deep learning</em> model yang sudah dilatih.
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- ═══ ROW 4 · Verifikasi ═══ -->
            <div class="flex items-stretch border-t border-white/[0.07] relative" id="row4">
              <div
                class="w-[160px] min-w-[160px] pr-5 py-7 flex flex-col justify-center border-r border-white/[0.07] a-lane select-none"
                id="ll4" onclick="alurRowToggle(this)">
                <div class="text-[11px] font-bold tracking-[0.12em] mb-1.5 text-[#C75B2E]">04</div>
                <div class="text-[23px] font-bold text-[#e8e2d8] leading-[1.35]">Verifikasi</div>
                <div class="mt-2 a-chevron"><svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <polyline points="1,1 5,5 9,1" stroke="rgba(199,91,46,0.6)" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg></div>
              </div>
              <div class="steps flex-1 pl-8 flex items-center relative">

                <div class="flex [flex:0.8] self-stretch items-center">
                  <div
                    class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                    id="r4c1" onclick="alurToggle(this)">
                    <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Overlay &amp; Filter Area</div>
                    <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                      <ul class="pl-3.5">
                        <li class="mb-0.5">Tutupan hutan 2024</li>
                        <li class="mb-0.5">Min. mapping unit 0.25 Ha</li>
                      </ul>
                    </div>
                  </div>
                  <div class="arrow w-[50px] min-w-[50px] flex items-center justify-center shrink-0 a-arr" id="r4a1">
                    <svg viewBox="0 0 50 130" fill="none" width="50" height="130">
                      <line x1="0" y1="65" x2="18" y2="65" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="15" x2="18" y2="115" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="15" x2="40" y2="15" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="65" x2="40" y2="65" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <line x1="18" y1="115" x2="40" y2="115" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                      <polyline points="34,10 41,15 34,20" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                      <polyline points="34,60 41,65 34,70" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                      <polyline points="34,110 41,115 34,120" stroke="#C75B2E" stroke-width="1.2" fill="none"
                        stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                    </svg>
                  </div>
                </div>

                <div class="self-stretch items-stretch [flex:1.5] flex">
                  <div class="flex flex-col flex-1 gap-2 py-2">

                    <div class="flex items-center flex-1">
                      <div
                        class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                        id="r4c2a" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Inspeksi Visual</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                          Verifikasi melalui pemeriksaan visual langsung pada citra satelit.</div>
                      </div>
                      <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r4a2a">
                        <svg viewBox="0 0 36 14" fill="none">
                          <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                          <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                            stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                        </svg>
                      </div>
                    </div>

                    <div class="flex items-center flex-1">
                      <div
                        class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                        id="r4c2b" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Penapisan Temporal</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">
                          Analisis multi-temporal untuk memastikan perubahan bersifat permanen.</div>
                      </div>
                      <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r4a2b">
                        <svg viewBox="0 0 36 14" fill="none">
                          <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                          <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                            stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                        </svg>
                      </div>
                    </div>

                    <div class="flex items-center flex-1">
                      <div
                        class="card flex-1 bg-[#1e1e1e] border border-white/[0.12] rounded-[10px] px-5 py-[18px] cursor-pointer relative overflow-hidden transition-all duration-[220ms] hover:bg-[#262626] hover:border-[rgba(199,91,46,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(0,0,0,0.4),0_0_0_1px_rgba(199,91,46,0.15)] a-card"
                        id="r4c2c" onclick="alurToggle(this)">
                        <div class="text-sm font-bold text-[#e8e2d8] leading-[1.3]">Pengecekan Lapangan</div>
                        <div class="card-desc hidden text-[12.5px] text-[#6b6460] leading-[1.6] mt-2.5 font-light">Survey
                          lapangan ke lokasi terindikasi untuk konfirmasi kondisi aktual.</div>
                      </div>
                      <div class="arrow w-[40px] min-w-[40px] flex items-center justify-center shrink-0 a-arr" id="r4a2c">
                        <svg viewBox="0 0 36 14" fill="none">
                          <line x1="0" y1="7" x2="28" y2="7" stroke="#C75B2E" stroke-width="1.2" opacity="0.6" />
                          <polyline points="22,2 29,7 22,12" stroke="#C75B2E" stroke-width="1.2" fill="none"
                            stroke-linejoin="miter" stroke-linecap="square" opacity="0.6" />
                        </svg>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="[flex:0.8] self-stretch flex">
                  <div
                    class="card-final flex-1 bg-[#C75B2E] rounded-[10px] px-5 py-6 flex flex-col justify-center relative overflow-hidden min-h-[160px] a-card"
                    id="card-final">
                    <div class="font-poppins text-[22px] font-extrabold text-white leading-[1.1] relative">
                      Data<br>Deforestasi</div>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- /#dwrap -->
        </div><!-- /#alur-embed -->

        <div
          style="padding:10px 16px 14px; font-size:.72rem; line-height:1.7; color:rgba(255,255,255,.45); text-align:center;">
          Diagram interaktif alur kerja SIMONTINI dari pemodelan deep learning hingga verifikasi lapangan. Klik kotak
          oranye untuk melihat detail setiap tahapan.
        </div>
      </div>
    </div>

    <section class="page-section px-[5vw] pt-8 pb-6">
      <div class="body-text">
        <p>
          <strong>Uji akurasi</strong>. Uji akurasi dilakukan untuk mengetahui tingkat akurasi data deforestasi 2025 ini,
          dengan menginspeksi secara visual poligon deforestasi pada citra Planet Scope resolusi spasial 3,7 meter.
          Poligon yang diinspeksi dipilih secara acak (<em>random</em>) dengan metode <em>stratified random sampling</em>.
          Poligon deforestasi dikelompokkan berdasarkan luasan, yakni <0,5 ha, 0,5-1 ha, 1-5 ha, 5-10 ha, 10-50 ha, dan>50
            ha. Jumlah sampel ditentukan berdasarkan rumus Slovin dengan tingkat kesalahan 5%.
        </p><br>
        <p>
          Hasil pengujian akurasi data deforestasi 2025 ini sebesar 89%, sebagaimana terlihat dalam tabel berikut.
        </p>
      </div>

      <div class="viz-block viz-block--full mt-12 mb-2">
        <div class="max-w-3xl mx-auto mt-4">
          <div
            class=" sm:mx-auto overflow-x-auto overflow-y-hidden  sm:rounded-none bg-white shadow-[0_4px_28px_rgba(26,26,26,.08)] md:overflow-x-visible">
            <div class="border-b border-[#ddd5c8] px-4 py-4 sm:px-6">
              <div class="text-[12px] font-semibold tracking-[-0.01em] text-[#1a1a1a] sm:text-[13px]">Hasil uji akurasi
                terhadap data deforestasi 2025</div>
            </div>

            <table
              class="akurasi-table w-full min-w-[480px] table-fixed border-collapse text-[10px] text-[#1a1a1a] sm:text-[11px] md:min-w-full md:text-[12px]">
              <thead>
                <tr>
                  <th colspan="3"
                    class="border-r border-white/15 text-center bg-[#8b2a1a] px-2 py-3 text-left font-semibold uppercase tracking-[0.08em] text-white sm:px-4">
                    Area deforestasi</th>
                  <th colspan="3"
                    class="bg-[#8b2a1a] px-2 py-3 text-center font-semibold uppercase tracking-[0.08em] text-white sm:px-4">
                    Uji akurasi</th>
                </tr>
                <tr>
                  <th class="w-[16%] bg-[#a33520] px-2 py-2 text-left font-semibold text-white/90 sm:px-4">Strata (ha)
                  </th>
                  <th class="w-[17%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">Luas (ha)</th>
                  <th class="w-[14%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">Poligon</th>
                  <th class="w-[18%]  bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">Sampel
                    poligon</th>
                  <th class="w-[10%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">TRUE</th>
                  <th class="w-[25%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">Akurasi</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-[#ddd5c8]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">&lt;0,5</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">59.743</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">322.725</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">261</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">227</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>87%</span>
                    </div>
                  </td>
                </tr>
                <tr class="border-b border-[#ddd5c8] bg-[#f9f5ef]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">0,5 – 1</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">58.260</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">84.211</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">69</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">61</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>88%</span>
                    </div>
                  </td>
                </tr>
                <tr class="border-b border-[#ddd5c8]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">1 – 5</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">149.159</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">77.445</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">63</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">59</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>94%</span>
                    </div>
                  </td>
                </tr>
                <tr class="border-b border-[#ddd5c8] bg-[#f9f5ef]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">5 – 10</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">44.585</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">6.495</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">6</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">6</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>100%</span>
                    </div>
                  </td>
                </tr>
                <tr class="border-b border-[#ddd5c8]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">10 – 50</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">69.113</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">3.648</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">3</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">3</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>100%</span>
                    </div>
                  </td>
                </tr>
                <tr class="border-b border-[#ddd5c8] bg-[#f9f5ef]">
                  <td class="px-2 py-3 font-semibold text-[#7a6e60] sm:px-4">&gt; 50</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">52.892</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">432</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">1</td>
                  <td class="px-2 py-3 text-right font-bold sm:px-4">1</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>100%</span>
                    </div>
                  </td>
                </tr>
                <tr class="bg-[#fdf6f4] font-semibold">
                  <td class="px-2 py-3 font-bold text-[#8b2a1a] sm:px-4">Total</td>
                  <td class="px-2 py-3 text-right sm:px-4">433.751</td>
                  <td class="px-2 py-3 text-right sm:px-4">494.956</td>
                  <td class=" border-[#ddd5c8] px-2 py-3 text-right sm:px-4">403</td>
                  <td class="px-2 py-3 text-right sm:px-4">357</td>
                  <td class="px-2 py-3 sm:px-4">
                    <div class="flex items-center justify-end gap-2">
                      <span>89%</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="border-t border-[#ddd5c8] px-2 py-2 text-[10px] text-[#7a6e60] sm:hidden">
              Geser tabel ke samping untuk melihat semua kolom.
            </div>
            <div class="tight text-[10px] px-2 mb-2 w-full">
              Tabel interaktif hasil uji akurasi data deforestasi 2025 berdasarkan strata luas poligon.
            </div>
          </div>
        </div>

      </div>
    </section>




    <!-- DEFORESTASI 2025 -->
    <span class="s-anchor" id="deforestasi"></span>
    <section class="page-section px-[5vw] py-8">
      <div class="section-label">03 / Deforestasi 2025</div>

      <p class="body-text">
        Dengan metode tersebut, <strong> di Indonesia pada 2025 mencapai 433.751 hektare</strong>. Deforestasi ini
        meningkat sebesar 66% dari tahun sebelumnya seluas
        <a href="https://simontini.id/id/status-deforestasi-indonesia-2024" target="_blank" rel="noopener noreferrer"
          style="color: #bc4a3c;">261.575 hektare</a>.
        Deforestasi terluas kembali terjadi di Kalimantan, disusul Sumatera. Tanah Papua, yang pada 2024 berada di
        peringkat keempat, pada tahun 2025 menempati peringkat ketiga menggantikan Sulawesi.
      </p>
      <p class="body-text">
        Tabel berikut menampilkan data deforestasi per pulau besar di Indonesia tahun 2023-2025.
      </p>

      <div id="peta-embed" class="mx-auto">
        <!-- MAP SECTION -->
        <div class="relative bg-black overflow-hidden" style="height:550px;">

          <!-- Header -->
          <div
            class="absolute top-0 left-0 right-0 z-50 pt-4 sm:pt-6 px-4 sm:px-10 flex justify-between items-start pointer-events-none">
            <h1 class="font-poppins text-[clamp(1.6rem,3vw,2.6rem)] font-bold leading-[1.1] text-[#f5f0e8]">
              Deforestasi<br>melonjak pada <span class="text-[#8b2a1a]">2025</span>
            </h1>
          </div>

          <!-- Map -->
          <div class="absolute inset-0 pt-[90px] pb-[168px] flex items-center justify-center z-10">
            <img id="indonesia-map" class="w-full max-h-full object-contain pointer-events-none select-none"
              style="filter:saturate(.65) brightness(1.05);" src="{{ asset('assets/images/indonesia-map.jpg') }}"
              alt="Peta Indonesia" />
          </div>

          <!-- Year ghost -->
          <div id="peta-year-ghost"
            class="absolute bottom-[15px] sm:bottom-[90px] right-2 sm:right-10 z-10 pointer-events-none font-poppins font-black text-[#f5f0e8] opacity-10 leading-none tracking-tighter"
            style="font-size:clamp(4rem,10vw,10rem)">2025</div>

          <!-- Charts layer -->
          <div class="absolute inset-0 z-20 pointer-events-none">

            <!-- Charts wrap: desktop = absolute inset-0 passthrough; mobile = single grid box -->
            <div id="peta-charts-wrap" class="absolute inset-0 pointer-events-none">

              <!-- Sumatra chart -->
              <div class="peta-island-chart hidden absolute pointer-events-auto origin-top-left scale-75 sm:scale-100"
                id="peta-chart-sumatra" style="left:3%;top:28%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                <div
                  class="bg-[rgba(245,240,232,.96)] border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                  <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">Sumatera</div>
                  <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">ribu hektare</div>
                  <div class="grid grid-cols-[40px_1fr] gap-2 items-start">
                    <div class="relative h-[78px] mt-[14px]" id="peta-axis-sumatra"></div>
                    <div>
                      <div class="relative h-[92px] flex items-end">
                        <div class="peta-grid-lines absolute inset-0 pointer-events-none">
                          <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="relative z-10 w-full flex items-end gap-1.5 h-[92px] border-b-2 border-[#1a1a1a]"
                          id="peta-bars-sumatra"></div>
                      </div>
                      <div class="flex gap-1.5 pt-[3px]" id="peta-xlabels-sumatra"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Kalimantan chart -->
              <div class="peta-island-chart hidden absolute pointer-events-auto origin-top-left scale-75 sm:scale-100"
                id="peta-chart-kalimantan" style="left:31%;top:8%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                <div
                  class="bg-[rgba(245,240,232,.96)] border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                  <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">Kalimantan</div>
                  <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">ribu hektare</div>
                  <div class="grid grid-cols-[40px_1fr] gap-2 items-start">
                    <div class="relative h-[78px] mt-[14px]" id="peta-axis-kalimantan"></div>
                    <div>
                      <div class="relative h-[92px] flex items-end">
                        <div class="peta-grid-lines absolute inset-0 pointer-events-none">
                          <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="relative z-10 w-full flex items-end gap-1.5 h-[92px] border-b-2 border-[#1a1a1a]"
                          id="peta-bars-kalimantan"></div>
                      </div>
                      <div class="flex gap-1.5 pt-[3px]" id="peta-xlabels-kalimantan"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Sulawesi chart -->
              <div class="peta-island-chart hidden absolute pointer-events-auto origin-top-left scale-75 sm:scale-100"
                id="peta-chart-sulawesi" style="left:55%;top:10%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                <div
                  class="bg-[rgba(245,240,232,.96)] border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                  <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">Sulawesi</div>
                  <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">ribu hektare</div>
                  <div class="grid grid-cols-[40px_1fr] gap-2 items-start">
                    <div class="relative h-[78px] mt-[14px]" id="peta-axis-sulawesi"></div>
                    <div>
                      <div class="relative h-[92px] flex items-end">
                        <div class="peta-grid-lines absolute inset-0 pointer-events-none">
                          <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="relative z-10 w-full flex items-end gap-1.5 h-[92px] border-b-2 border-[#1a1a1a]"
                          id="peta-bars-sulawesi"></div>
                      </div>
                      <div class="flex gap-1.5 pt-[3px]" id="peta-xlabels-sulawesi"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Papua chart -->
              <div class="peta-island-chart hidden absolute pointer-events-auto origin-top-left scale-75 sm:scale-100"
                id="peta-chart-papua" style="left:72%;top:16%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                <div
                  class="bg-[rgba(245,240,232,.96)] border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                  <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">Papua</div>
                  <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">ribu hektare</div>
                  <div class="grid grid-cols-[40px_1fr] gap-2 items-start">
                    <div class="relative h-[78px] mt-[14px]" id="peta-axis-papua"></div>
                    <div>
                      <div class="relative h-[92px] flex items-end">
                        <div class="peta-grid-lines absolute inset-0 pointer-events-none">
                          <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="relative z-10 w-full flex items-end gap-1.5 h-[92px] border-b-2 border-[#1a1a1a]"
                          id="peta-bars-papua"></div>
                      </div>
                      <div class="flex gap-1.5 pt-[3px]" id="peta-xlabels-papua"></div>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- /peta-charts-wrap -->

          </div><!-- /charts-layer -->

          <!-- Bubbles -->
          <div id="peta-bubbles"
            class="absolute bottom-[105px] left-0 right-0 sm:left-1/2 sm:right-auto sm:-translate-x-1/2 flex gap-1 sm:gap-3 z-30 pointer-events-none items-center justify-center px-1 sm:px-0">
            <div
              class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(245,240,232,.25)] text-[rgba(245,240,232,.55)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
              id="peta-b0" onclick="petaSelectYear(0)">
              <div class="b-yr text-[.6rem] font-semibold">2021</div>
              <div class="b-val font-bold leading-[1.1]">229.982</div>
              <div class="b-u text-[.58rem] opacity-85">ha</div>
            </div>
            <div
              class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(245,240,232,.25)] text-[rgba(245,240,232,.55)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
              id="peta-b1" onclick="petaSelectYear(1)">
              <div class="b-yr text-[.6rem] font-semibold">2022</div>
              <div class="b-val font-bold leading-[1.1]">230.760</div>
              <div class="b-u text-[.58rem] opacity-85">ha</div>
            </div>
            <div
              class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(245,240,232,.25)] text-[rgba(245,240,232,.55)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
              id="peta-b2" onclick="petaSelectYear(2)">
              <div class="b-yr text-[.6rem] font-semibold">2023</div>
              <div class="b-val font-bold leading-[1.1]">257.385</div>
              <div class="b-u text-[.58rem] opacity-85">ha</div>
            </div>
            <div
              class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(245,240,232,.25)] text-[rgba(245,240,232,.55)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
              id="peta-b3" onclick="petaSelectYear(3)">
              <div class="b-yr text-[.6rem] font-semibold">2024</div>
              <div class="b-val font-bold leading-[1.1]">261.574</div>
              <div class="b-u text-[.58rem] opacity-85">ha</div>
            </div>
            <div
              class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(245,240,232,.25)] text-[rgba(245,240,232,.55)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
              id="peta-b4" onclick="petaSelectYear(4)">
              <div class="b-yr font-semibold">2025</div>
              <div class="b-val font-bold leading-[1.1]">433.751</div>
              <div class="b-u text-[.58rem] opacity-85">ha</div>
            </div>
          </div>

        </div><!-- /map section -->

        <!-- TABLE SECTION -->
        <div id="peta-table-section" class="bg-[#1a1a1a] text-[#f5f0e8] py-8 sm:py-20 px-4 sm:px-12 relative">
          <div class="flex items-center gap-1.5 px-4 py-2 sm:hidden"
            style="background:#161616; border-bottom:1px solid rgba(255,255,255,.05);">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
            <span style="font-size:.6rem; color:rgba(255,255,255,.3); letter-spacing:.08em;">geser untuk melihat alur
              lengkap</span>
          </div>
          <div class="max-w-[980px] mx-auto overflow-x-auto">
            <table class="w-full border-collapse min-w-[560px]">
              <thead>
                <tr c lass="border-b-2 border-[#8b2a1a]">
                  <th rowspan="2"
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-left align-bottom">
                    Pulau</th>
                  <th colspan="3"
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#c04030] py-1 sm:py-[9px] px-2 sm:px-[14px] text-center border-b border-[rgba(255,255,255,.1)]">
                    Deforestasi (ha)</th>
                  <th colspan="2"
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase py-1 sm:py-[9px] px-2 sm:px-[14px] text-center border-b border-[rgba(255,255,255,.1)]"
                    style="color:#ff6b4a">Perluasan 2025 vs 2024</th>
                </tr>
                <tr class="border-b-2 border-[#8b2a1a]">
                  <th
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                    2023</th>
                  <th
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                    2024</th>
                  <th
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                    2025</th>
                  <th
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                    Hektare</th>
                  <th
                    class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#d4c4a0] py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                    Persen</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Kalimantan</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    124.611</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    129.896</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    158.283</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    28.387</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    22%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Sumatera</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    33.311</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    91.248</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    144.150</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    52.901</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    58%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Papua</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    55.981</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    17.341</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    77.678</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    60.337</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    348%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Sulawesi</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    36.814</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    17.361</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    39.685</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    22.324</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    129%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Maluku</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    4.034</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    3.537</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    7.527</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    3.989</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    113%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Bali &amp; Nusa Tenggara</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    2.052</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    1.780</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    4.209</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    2.429</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    136%</td>
                </tr>
                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-[#f5f0e8]">
                    Jawa</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    582</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    411</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    2.221</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    1.810</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                    440%</td>
                </tr>
                <tr class="tot border-t-2 border-[#8b2a1a] text-[#c04030] font-semibold">
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem]">
                    Total</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    257.385</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    261.575</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    433.751</td>
                  <td class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                    172.177</td>
                  <td
                    class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct">
                    66%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><br><br>



      <p class="body-text">
        Deforestasi terjadi di seluruh provinsi Indonesia, kecuali DKI Jakarta dan Daerah Istimewa Yogyakarta. Bila 10
        provinsi teratas deforestasi pada 2024 secara berurut adalah (1) Kalimantan Timur, (2) Kalimantan Barat, (3)
        Kalimantan Tengah, (4) Riau, (5) Sumatera Selatan, (6) Jambi, (7) Aceh, (8) Kalimantan Utara, (9) Bangka Belitung,
        dan (10) Sumatera Utara; pada 2025 urutannya menjadi (1) Kalimantan Tengah, (2) Kalimantan Timur, (3) Aceh, (4)
        Kalimantan Barat, (5) Papua Tengah, (6) Sumatera Barat, (7) Sumatera Utara, (8) Kalimantan Utara, (9) Riau, dan
        (10) Papua Pegunungan.
      </p><br>

      <p class="body-text">
        Tiga provinsi yang mengalami bencana longsor-banjir dahsyat di Sumatera Bagian Utara pada penghujung 2025
        mengalami lonjakan deforestasi luar biasa: Aceh (426%), Sumatera Utara (281%), dan Sumatera Barat (1.034%).<br>
      </p><br>

      <div class="viz-block viz-block--full mt-2 mb-2">
        <div class="viz-frame viz-frame--padded">
          <div class="mx-auto w-full" style="max-width:980px;">

            <div style="overflow:hidden;">

              <div id="gallery">

                <div class="w-full aspect-[16/9] overflow-hidden">
                  <img id="mainImage" src="{{ asset('assets/images/gallery2025/Kawasan Hutan Produksi.jpg') }}"
                    class="w-full h-full object-cover cursor-pointer" onclick="
                    $('#popupImage').attr('src', this.src);
                    $('#popupTitle').text($('#title').text());
                    $('#popupSub').text($('#sub').text());
                    $('#popupCaption').removeClass('hidden');
                    $('#popup').fadeIn(200);
                  ">
                </div>

                <div
                  class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 py-3 md:px-0 text-black border-t border-gray-200">

                  <div class="flex gap-3 overflow-x-auto md:overflow-visible">

                    <img class="w-[70px] h-[70px] sm:w-[80px] sm:h-[80px] object-cover border cursor-pointer shrink-0"
                      src="{{ asset('assets/images/gallery2025/Kawasan Hutan Produksi.jpg') }}" onclick="
                      $('#mainImage').attr('src', this.src);
                      $('#title').text('Kawasan Hutan Produksi,');
                      $('#sub').text('Bireun, Aceh, Desember 2025');
                    ">

                    <img class="w-[70px] h-[70px] sm:w-[80px] sm:h-[80px] object-cover border cursor-pointer shrink-0"
                      src="{{ asset('assets/images/gallery2025/Konsesi PBPH, PT Toba Pulp Lestari,.jpg') }}" onclick="
                      $('#mainImage').attr('src', this.src);
                      $('#title').text('Konsesi PBPH, PT Toba Pulp Lestari,');
                      $('#sub').text('Aek Raja, Sumatera Utara, Desember 2025');
                    ">

                    <img class="w-[70px] h-[70px] sm:w-[80px] sm:h-[80px] object-cover border cursor-pointer shrink-0"
                      src="{{ asset('assets/images/gallery2025/Deforestasi, Kawasan Hutan Lindung,.jpg') }}" onclick="
                      $('#mainImage').attr('src', this.src);
                      $('#title').text('Kawasan Hutan Lindung,');
                      $('#sub').text('Sijunjung, Sumatera Barat, Desember 2025');
                    ">

                  </div>

                  <div
                    class="text-right md:text-right text-[13px] sm:text-[14px] leading-snug md:ml-auto max-w-full md:max-w-[280px] break-words">
                    <div id="title">Kawasan Hutan Produksi</div>
                    <div id="sub">Bireun, Aceh, Desember 2025</div>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div><br><br>

      <p class="body-text">
        Deforestasi terjadi di 383 kabupaten/kota atau 74% kabupaten/kota se-Indonesia yang jumlahnya 514, menurun dari
        tahun sebelumnya sebanyak 428 kabupaten/kota. Sepuluh teratas kabupaten deforestasi berada di Kalimantan dan Tanah
        Papua, dengan luas deforestasi mencapai 95.733 hektare atau 22% deforestasi nasional.<br>
      </p><br>

      <p class="body-text">
        Dilihat dari status penguasaan lahan, 307.861 hektare (71%) deforestasi terjadi di kawasan hutan yang dikelola
        Kementerian Kehutanan, dan 125.890 hektare terjadi di area penggunaan lain (APL) yang dikelola pemerintah daerah
        atau pemilik lahan/konsesi.<br>
      </p>

      <div class="viz-block viz-block--full mt-2 mb-2">
        <div class="viz-frame viz-frame--padded">
          <div class="mx-auto w-full" style="max-width:980px;">

            <div>

              <!-- IMAGE -->
              <div class="w-full aspect-[16/9] overflow-hidden">
                <img src="{{ asset('assets/images/gallery2025/Konsesi Sawit, PT Banyan Tumbuh Lestari.jpg') }}"
                  class="w-full h-full object-cover cursor-pointer" onclick="
                          let img = $('#popupImage');

                          img.attr('src', this.src);
                          img.data({zoom:1,x:0,y:0,drag:false,dragging:false});
                          img.css('transform','translate(0,0) scale(1)');

                          $('#popupTitle').text('Area Penggunaan Lain, Konsesi Sawit, PT Banyan Tumbuh Lestari,');
                          $('#popupSub').text('Pahuwato, Gorontalo, Mei 2025');

                          $('#popupCaption').show();
                          $('#popup').fadeIn(200);
                        ">
              </div>

              <!-- CAPTION -->
              <div class=" py-3 text-black text-right">
                <div class="text-[14px] leading-tight">
                  <div>Area Penggunaan Lain, Konsesi Sawit, PT Banyan Tumbuh Lestari,</div>
                  <div>Pahuwato, Gorontalo, Mei 2025</div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div><br>

      <p class="body-text">
        Deforestasi mengalami lonjakan di kawasan konservasi. Pada 2024, deforestasi di kawasan konservasi seluas 7.704
        hektare, menjadi 25.077 hektare pada 2025 yang terjadi pada 163 kawasan konservasi. Sepuluh teratas deforestasi di
        kawasan konservasi mencapai 17.153 hektare, atau 68% deforestasi di seluruh kawasan konservasi.<br>

      </p><br>

      <p class="body-text">
        Di 29 juta hektare habitat harimau, gajah, badak, dan orangutan, terjadi deforestasi seluas 156.463 hektare, tanpa
        menghitung perulangan di area yang beririsan.<br>

      </p>

      <div class="viz-block viz-block--full mt-2 mb-2">
        <div class="viz-frame viz-frame--padded">
          <div class="mx-auto w-full" style="max-width:980px;">

            <div ">

                <!-- IMAGE -->
                <div class=" w-full aspect-[16/9] overflow-hidden">
              <img src="{{ asset('assets/images/gallery2025/Suaka Margasatwa Rawa Singkil.JPG') }}"
                class="w-full h-full object-cover cursor-pointer" onclick="
                        let img = $('#popupImage');

                        img.attr('src', this.src);
                        img.data({zoom:1,x:0,y:0,drag:false,dragging:false});
                        img.css('transform','translate(0,0) scale(1)');

                        $('#popupTitle').text('Kawasan Konservasi, Suaka Margasatwa Rawa Singkil,');
                        $('#popupSub').text('Aceh Selatan, Aceh, Agustus 2025, © HAKA');

                        $('#popupCaption').show();
                        $('#popup').fadeIn(200);
                      ">
            </div>

            <!-- CAPTION -->
            <div class="py-3 text-black text-right">
              <div class="text-[14px] leading-tight">
                <div>Kawasan Konservasi, Suaka Margasatwa Rawa Singkil,</div>
                <div>Aceh Selatan, Aceh, Agustus 2025, © HAKA</div>
              </div>
            </div>

          </div>

        </div>
      </div>
  </div>
  <br>



  <p class="body-text">
    Pada akhir Desember 2024, dua bulan setelah Prabowo-Gibran dilantik, Pemerintah Indonesia mencanangkan program
    ketahanan pangan melalui pengalokasian 20,6 juta hektare kawasan hutan untuk cadangan pangan, energi, dan air.
    Sebesar 78.123 hektare deforestasi terjadi di area pencadangan ini, atau 18% deforestasi nasional.<br>

  </p><br>

  <p class="body-text">
    Sebesar 44% deforestasi terjadi di dalam konsesi, dengan konsesi kehutanan sebagai penyumbang terbesar (58%).
    Sebagian besar (65%) deforestasi dalam konsesi terjadi di Kalimantan.<br>

  </p><br>

  <p class="body-text">
    Deforestasi seluas 41.162 hektare terjadi pada 1.140 izin atau konsesi tambang, dengan 22% (8.929 hektare) terjadi
    pada sepuluh teratas.<br>

  </p>
  <div class="viz-block viz-block--full mt-2 mb-2">
    <div class="viz-frame viz-frame--padded">
      <div class="mx-auto w-full" style="max-width:980px;">

        <div ">

                <!-- IMAGE -->
                <div class=" w-full aspect-[16/9] overflow-hidden">
          <img src="{{ asset('assets/images/gallery2025/Konsesi Kebun, PT Equator Sumber Rezeki.jpg') }}"
            class="w-full h-full object-cover cursor-pointer" onclick="
                        let img = $('#popupImage');

                        img.attr('src', this.src);
                        img.data({zoom:1,x:0,y:0,drag:false,dragging:false});
                        img.css('transform','translate(0,0) scale(1)');

                        $('#popupTitle').text('Area Penggunaan Lain, Konsesi Kebun, PT Equator Sumber Rezeki,');
                        $('#popupSub').text('Kapuas Hulu, Kalimantan Barat, Juni 2025');

                        $('#popupCaption').show();
                        $('#popup').fadeIn(200);
                      ">
        </div>

        <!-- CAPTION -->
        <div class="py-3 text-black text-right">
          <div class="text-[14px] leading-tight">
            <div>Area Penggunaan Lain, Konsesi Kebun, PT Equator Sumber Rezeki,</div>
            <div>Kapuas Hulu, Kalimantan Barat, Juni 2025</div>
          </div>
        </div>

      </div>

    </div>
  </div>
  </div><br><br>

  <p class="body-text">
    Deforestasi seluas 37.910 hektare terjadi di 719 konsesi sawit sepanjang 2025, dengan 36% (13.610 hektare) terjadi
    pada sepuluh konsesi teratas.<br>

  </p><br>

  <p class="body-text">
    Deforestasi seluas 110.898 hektare terjadi pada 486 konsesi kehutanan, yakni 74.409 hektare konsesi logging,
    33.063 hektare konsesi kebun kayu, 671 hektare konsesi restorasi ekosistem, dan 2.754 hektare konsesi kehutanan
    lainnya. Deforestasi terjadi di 212 konsesi kebun kayu, 34 persennya terjadi di sepuluh teratas.<br>

  </p><br>

  <p class="body-text">
    Deforestasi terjadi di 237 konsesi logging, 28 persennya terjadi di sepuluh teratas.<br>

  </p>


  <div class="viz-block viz-block--full">

    <!-- PETA TEMATIK (inline) -->
    <div id="peta-tematik" style="height: 60vh" class="flex overflow-hidden">
      <aside id="sidebar"
        class="sm:w-[350px] w-full shrink-0 bg-[#1a1a1a] text-[#f5f0e8] px-4 py-4 overflow-y-auto border-r border-white/[.08]">
        <h1 class="text-[1.05rem] font-bold leading-[1.15] mb-1 p-1">Peta Tematik Deforestasi</h1>
        <p class="px-1 text-[.58rem] tracking-[.1em] uppercase text-[#d4c4a0] mb-[10px]">Pilih jenis analisis · 2025
        </p>
        <div class="flex items-center gap-1.5 px-4 py-2 sm:hidden"
          style="background:#161616; border-bottom:1px solid rgba(255,255,255,.05);">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
          <span style="font-size:.6rem; color:rgba(255,255,255,.3); letter-spacing:.08em;">geser untuk melihat alur
            lengkap</span>
        </div>
        <div id="mode-btn-rail">
          <button
            class="mode-btn w-full border border-white/[.12] bg-transparent text-[rgba(245,240,232,.65)] rounded-md px-3 py-[7px] mb-[5px] text-left cursor-pointer text-[.75rem] font-semibold transition-all active"
            data-mode="provinsi">Deforestasi berbasis provinsi</button>
          <button
            class="mode-btn w-full border border-white/[.12] bg-transparent text-[rgba(245,240,232,.65)] rounded-md px-3 py-[7px] mb-[5px] text-left cursor-pointer text-[.75rem] font-semibold transition-all"
            data-mode="kabupaten">Deforestasi berbasis kabupaten</button>
          <button
            class="mode-btn w-full border border-white/[.12] bg-transparent text-[rgba(245,240,232,.65)] rounded-md px-3 py-[7px] mb-[5px] text-left cursor-pointer text-[.75rem] font-semibold transition-all"
            data-mode="konservasi">Deforestasi di kawasan konservasi</button>
          <button
            class="mode-btn w-full border border-white/[.12] bg-transparent text-[rgba(245,240,232,.65)] rounded-md px-3 py-[7px] mb-[5px] text-left cursor-pointer text-[.75rem] font-semibold transition-all"
            data-mode="megafauna">Deforestasi di Habitat megafauna ikonik</button>
          <button
            class="mode-btn w-full border border-white/[.12] bg-transparent text-[rgba(245,240,232,.65)] rounded-md px-3 py-[7px] mb-[5px] text-left cursor-pointer text-[.75rem] font-semibold transition-all"
            data-mode="konsesi">Deforestasi dalam Konsesi</button>
        </div><!-- /#mode-btn-rail -->

        <!-- Sub-menu konsesi (hidden by default) -->
        <div id="konsesi-submenu" class="hidden pl-4">
          <button
            class="cat-btn sm:w-full w-6/12 border border-white/[.1] bg-transparent text-[rgba(245,240,232,.58)] rounded px-2 py-[5px] mb-[4px] text-left cursor-pointer text-[.7rem] font-semibold transition-all"
            data-cat="kebun-kayu"> Kebun Kayu</button>
          <button
            class="cat-btn sm:w-full w-6/12 border border-white/[.1] bg-transparent text-[rgba(245,240,232,.58)] rounded px-2 py-[5px] mb-[4px] text-left cursor-pointer text-[.7rem] font-semibold transition-all"
            data-cat="logging">Logging</button>
          <button
            class="cat-btn sm:w-full w-6/12 border border-white/[.1] bg-transparent text-[rgba(245,240,232,.58)] rounded px-2 py-[5px] mb-[4px] text-left cursor-pointer text-[.7rem] font-semibold transition-all"
            data-cat="sawit"> Sawit</button>
          <button
            class="cat-btn sm:w-full w-6/12 border border-white/[.1] bg-transparent text-[rgba(245,240,232,.58)] rounded px-2 py-[5px] mb-[4px] text-left cursor-pointer text-[.7rem] font-semibold transition-all"
            data-cat="tambang"> Tambang</button>
        </div>

      </aside>

      <main id="wrap" class="relative flex-1 min-w-0 bg-[#ece8df] flex flex-col overflow-hidden">
        <div id="map" class="w-full flex-1"></div>
        <div id="satwa-badges"
          class="hidden absolute top-4 left-1/2 -translate-x-1/2 z-[450] pointer-events-none px-[18px] py-[10px] flex-row items-end justify-center gap-[10px] flex-nowrap overflow-x-auto bg-[rgba(248,244,238,.7)] backdrop-blur-[6px]  max-w-[92vw]">
        </div>


        <div id="title-block" class="absolute top-[10px] left-[14px] z-[600] pointer-events-none">
          <h2 id="map-title"
            class="font-bold text-[clamp(.9rem,1.5vw,1.5rem)] leading-[1.2] text-[#1a1a1a] [text-shadow:0_2px_10px_rgba(255,255,255,.7)]">
            Deforestasi berbasis provinsi</h2>
        </div>

        <div id="kpi-float"
          class="absolute left-[14px] bottom-[14px] z-[610] bg-[rgba(20,20,20,.82)] backdrop-blur-[4px] border-l-[3px] border-l-[#8b2a1a] rounded-md px-3 py-[7px] w-44 text-[#f5f0e8]">
          <button id="kpi-toggle" onclick="kpiFloatToggle()" style="display:none"
            class="w-full flex flex-col items-center pt-[10px] pb-[8px] cursor-pointer bg-transparent border-0 outline-none gap-[5px]">
            <span class="block w-7 h-[3px] rounded-full bg-white/30"></span>
            <svg id="kpi-chevron" width="14" height="8" viewBox="0 0 14 8" fill="none"
              style="transition:transform .25s ease">
              <path d="M1 7L7 1L13 7" stroke="rgba(245,240,232,.5)" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </button>
          <div class="text-[.5rem] tracking-[.08em] uppercase text-[#d4c4a0]" id="kpi-label">Total</div>
          <div class="text-[1.25rem] font-bold leading-none mt-[2px]" id="kpi-val">0</div>
          <div class="text-[.5rem] text-[#d4c4a0] mt-[2px]" id="kpi-unit">hektare</div>
          <ul id="sidebar-notes" class="mt-[6px] pt-[6px] border-t border-white/[.18] text-[.62rem]"></ul>
        </div>

        <div id="others-bubble"
          class="absolute right-[14px] top-[10px] z-[620] w-[120px] h-[120px] rounded-full bg-[rgba(192,64,48,.95)] text-white hidden text-center items-center justify-center flex-col p-3 shadow-[0_8px_26px_rgba(139,42,26,.35)]">
          <div class="text-[.58rem] leading-[1.3]" id="bubble-label">Kabupaten lainnya</div>
          <div class="text-[1.4rem] font-bold leading-none mt-[3px]" id="bubble-val">0</div>
          <div class="text-[.5rem] mt-[1px] opacity-90" id="bubble-unit">hektare</div>
        </div>

        <div id="notes-wrap" class="absolute left-[14px] bottom-[12px] z-[620] w-[min(360px,38vw)] flex flex-col">
          <div id="notes-box" class=" pt-[14px] px-[14px] pb-[10px]">
            <ul id="notes-list" class="pl-[18px] [&>li]:text-[.82rem] [&>li]:leading-[1.48] [&>li]:mb-[6px]"></ul>
          </div>
        </div>

        <div id="table-panel"
          class="absolute right-0 top-0 bottom-0 w-[min(600px,56vw)] bg-[#1a1a1a] z-[650] translate-x-full transition-transform duration-[280ms] ease-[cubic-bezier(.4,0,.2,1)] flex flex-col border-l-2 border-white/[.1] shadow-[-10px_0_40px_rgba(0,0,0,.45)]">
          <button id="table-toggle"
            class="absolute left-[-36px] top-1/2 -translate-y-1/2 z-10 [writing-mode:vertical-rl] [text-orientation:mixed] bg-[#1a1a1a] text-[#f5f0e8] border-0 rounded-l-lg py-5 px-[9px] text-[.6rem] font-bold tracking-[.1em] uppercase cursor-pointer shadow-[-4px_0_14px_rgba(0,0,0,.3)] transition-colors leading-none whitespace-nowrap hidden">Tabel
            ▶</button>
          <div class="flex items-center justify-between px-4 py-3 border-b border-white/[.1] shrink-0">
            <span class="text-[.65rem] font-bold tracking-[.1em] uppercase text-[#d4c4a0]">Tabel Data</span>
            <button id="table-close"
              class="flex items-center justify-center w-7 h-7 rounded-full bg-white/[.08] hover:bg-white/[.16] border-0 cursor-pointer transition-colors"
              aria-label="Tutup tabel">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M1 1l10 10M11 1L1 11" stroke="#f5f0e8" stroke-width="1.8" stroke-linecap="round" />
              </svg>
            </button>
          </div>
          <div id="table-wrap" class="flex-1 overflow-y-auto overflow-x-hidden flex flex-col"></div>
        </div>
      </main>
    </div>

  </div><br><br>



  <p class="body-text">
    Deforestasi terjadi di 383 kabupaten/kota atau 74% kabupaten/kota se-Indonesia yang jumlahnya 514, mengalami
    penurunan dari tahun sebelumnya yang terjadi di 428 kabupaten/kota. Sepuluh teratas kabupaten deforestasi berada
    di Kalimantan dan Tanah Papua, dengan deforestasi seluas 95.874 hektare atau 22% deforestasi nasional.
  </p>
  <p class="body-text">
    Dilihat dari status penguasaan lahan, 308.261 hektare (72%) deforestasi terjadi di kawasan hutan yang dikelola
    Kementerian Kehutanan, dan 125.997 hektare terjadi di area penggunaan lain (APL) yang dikelola pemerintah daerah
    atau pemilik lahan/konsesi.
  </p>



  <div class="pull-quote">
    <p>Deforestasi di Kalimantan meningkat drastis setiap tahun sejak 2021, didorong oleh ekspansi konsesi kebun kayu,
      sawit, dan pertambangan yang beroperasi secara legal di bawah izin yang diterbitkan pemerintah.</p>
    <cite>—Analisis SIMONTINI 2025</cite>
  </div>
  </section>

  <!-- KONSESI -->
  <span class="s-anchor" id="konsesi"></span>
  <section class="page-section px-[5vw] py-10">
    <div class="section-body">
      <div class="section-label">04 / Deforestasi dalam Konsesi</div>

      <p class="body-text">
        Pemberian izin-izin konversi, seperti tambang, sawit, kebun kayu, di area-area yang memiliki tutupan hutan alam
        juga menjadi pemicu deforestasi. Analisis Auriga Nusantara menunjukkan bahwa per 2024 terdapat 9,6 juta hektare
        tutupan hutan alam di dalam konsesi konversi. Pada 2025, deforestasi di dalam konsesi seperti ini mencapai
        114.823 hektare atau 26% dari deforestasi nasional. Visual berikut menampilkan sepuluh teratas deforestasi dalam
        konsesi per kategori.
      </p>

      <!-- <div class="viz-block viz-block--full" data-include-html="partials/konsesi-embed.html"></div> -->


      <!-- <hr class="divider"> -->

      <div class="callout">
        <p>
          <strong>Catatan:</strong> Hanya 3% deforestasi 2025 yang terjadi di kawasan konservasi, sementara 49% di hutan
          produksi dan 43% di luar kawasan hutan. Artinya, <strong>97% deforestasi yang terjadi berpotensi
            legal</strong> karena dilakukan di daerah berizin.
        </p>
      </div>
    </div>
  </section>

  <!-- DISKUSI -->
  <span class="s-anchor" id="diskusi"></span>
  <section class="page-section px-[5vw] py-10">
    <div class="section-label">05 / Diskusi</div>

    <div class="mt-10">
      <div class="chapter-header">
        <span class="ms-num">01</span>
        <h3 class="chapter-title"><strong>Kebijakan pemerintah turut memicu deforestasi</strong></h3>
      </div>
      <p class="body-text">
        Di era presidensi Joko Widodo, terutama pada periode kedua, perlindungan lingkungan mengalami pengenduran,
        terutama melalui pengesahan Undang-Undang Cipta Kerja atau Omnibus Law. Batasan 30% hutan untuk setiap wilayah,
        sebagai misal, dihilangkan dari teks aturan. Tidak hanya itu, proyek-proyek pemerintah, terutama yang dibungkus
        dengan judul Proyek Strategis Nasional, diberi kemudahan menabrak kawasan hutan. Padahal, proyek-proyek ini
        kerap tidak disertai perencanaan matang, termasuk secara spasial.
      </p>
      <p class="body-text">
        Era kepresidenan Prabowo-Gibran tampak meneruskan kebijakan ini. Kengototan meneruskan program lumbung pangan
        (<em>estate</em>) di Merauke salah satu contohnya. Pemerintah membangun sawah di Merauke, tapi pada saat
        bersamaan menghilangkan banyak sawah di Sulawesi demi pembangunan smelter dan ekspansi tambang nikel. Tidak
        hanya itu, tambang-tambang nikel ini justru memicu pemusnahan tumbuhan sagu di Indonesia Timur, padahal sagu
        merupakan salah satu makanan pokok di Indonesia Timur.
      </p>
      <p class="body-text">
        Pada akhir Desember 2024, dua bulan setelah Prabowo-Gibran dilantik, pemerintah mencanangkan program 20 juta
        hektare hutan untuk cadangan pangan, energi, dan air. Pada perkembangannya, total area untuk program ini menjadi
        20,6 juta hektare. Analisis Auriga Nusantara menunjukkan bahwa terdapat 8,8 juta hektare hutan alam di dalam
        area pencadangan ini dan 18% deforestasi 2025 terjadi di dalam area ini. Deforestasi ini terjadi melalui
        program-program pangan populis, seperti Cetak Sawah Rakyat (CSR) di Kalimantan Tengah, provinsi yang menjadi
        pemuncak deforestasi pada 2025. Padahal pada 2024 provinsi ini berada di urutan ketiga provinsi terdeforestasi.
      </p>
      <p class="body-text">
        Pemberian izin-izin konversi, seperti tambang, sawit, kebun kayu, di area-area yang memiliki tutupan hutan alam
        juga menjadi pemicu deforestasi. Analisis Auriga Nusantara menunjukkan bahwa per 2024 terdapat 9,6 juta hektare
        tutupan hutan alam di dalam konsesi konversi. Pada 2025, deforestasi di dalam konsesi ini mencapai 114.823
        hektare atau 26% dari deforestasi nasional.
      </p>
      <p class="body-text">
        Selain itu, pelepasan kawasan hutan menjadi area penggunaan lain (APL) namun memiliki tutupan hutan alam juga
        menjadi langkah awal deforestasi, karena penebangan hutan di dalam APL tidak melanggar hukum. Pelepasan kawasan
        hutan seperti ini kerap terjadi untuk konsesi tertentu atau oleh permintaan pemerintah daerah melalui revisi
        rencana tata ruang (RTRW). Per 2024 terdapat 10,2 juta hektare hutan alam di dalam APL. Dan, pada 2025
        deforestasi dalam APL seluas 125.997 hektare atau 28% deforestasi nasional.
      </p>
      <!-- <ul class="insight-list">
                                          <li>Pengenduran perlindungan lingkungan mempermudah pembukaan hutan</li>
                                          <li>Program pangan, energi, dan air beririsan dengan jutaan hektare hutan alam</li>
                                          <li>Deforestasi dalam konsesi konversi mencapai 26% dari deforestasi nasional</li>
                                          <li>Deforestasi dalam APL mencapai 28% dari deforestasi nasional</li>
                                        </ul> -->
    </div>

    <hr class="divider">

    <div>
      <div class="chapter-header">
        <span class="ms-num">02</span>
        <h3 class="chapter-title">Episentrum deforestasi mengarah ke Tanah Papua</h3>
      </div>
      <p class="body-text">
        Deforestasi tertinggi memang masih dipegang Kalimantan. Pulau ini menjadi pemuncak deforestasi di Indonesia
        <a href="https://simontini.id/id/status-deforestasi-indonesia-2024" target="_blank" rel="noopener noreferrer"
          style="color: #bc4a3c;">sejak 2013</a>,
        atau 13 tahun terakhir secara berturut. Namun begitu, perluasan deforestasi terbesar pada 2025 terjadi di Tanah
        Papua, yakni seluas 60.337 hektare, yang menempatkan pulau ini di peringkat ketiga, di bawah Kalimantan dan
        Sumatera, menggantikan Sulawesi yang menempati posisi itu pada deforestasi 2024.
      </p>
      <p class="body-text">
        Program pemerintah, seperti Proyek Strategis Nasional, lumbung pangan (food estate), menjadi pemicu peningkatan
        deforestasi di Tanah Papua. Pembangunan infrastruktur yang tak jarang sebagai kelanjutan dari pemekaran wilayah
        administrasi ditengarai turut memicu deforestasi di pulau ini. Demikian pula perluasan komoditas monokultur,
        terutama sawit, turut memicu peningkatan deforestasi tersebut.
      </p>
      <p class="body-text">
        Kombinasi hal-hal di atas harus menjadi perhatian serius dalam upaya menahan laju deforestasi di Tanah Papua ke
        depan. Simulasi yang dilakukan Auriga Nusantara di Aceh dan Riau menunjukkan bahwa deforestasi melonjak setelah
        pabrik sawit beroperasi, dan semakin dekat dengan pabrik akan semakin tinggi tingkat deforestasi. Fenomena mirip
        terjadi di Sulawesi dan Maluku Utara dengan pengoperasian smelter-smelter nikel sejak 2016. Dengan demikian,
        pembangunan infrastruktur dan pemekaran wilayah administrasi di Tanah Papua akan menjadi pemungkin terhadap
        hadirnya pabrik-pabrik atau industri pengolahan baru. Apalagi sawit-sawit di Tanah Papua saat ini kebanyakan
        pada usia muda dan akan mengalami puncak produksi pada 5-10 tahun ke depan sehingga akan membutuhkan
        pabrik-pabrik sawit. Bila pabrik-pabrik sawit bermunculan, dan infrastruktur semakin baik, bagaimana menahan
        laju deforestasi di pulau ini?
      </p>
    </div>

    <hr class="divider">

    <div>
      <div class="chapter-header">
        <span class="ms-num">03</span>
        <h3 class="chapter-title">Ekspansi komoditas industrial menjadi pemicu deforestasi Indonesia</h3>
      </div>
      <p class="body-text">
        Ekspansi komoditas industrial tetap menjadi momok bagi hutan alam tersisa di Indonesia. Pengembangan kebun-kebun
        baru sawit menjadi salah satu pemicu (driver) utama di Sumatera, sebagaimana terjadi di Hutan Lindung Sijunjung
        di Sumatera Barat. Deforestasi demi pembangunan kebun sawit bahkan merangsek ke kawasan konservasi, seperti
        terjadi di Suaka Margasatwa Rawa Singkil di Aceh.
      </p>
      <p class="body-text">
        Deforestasi oleh ekspansi sawit sejatinya cenderung melambat, terutama karena pasar yang sudah mulai jenuh.
        Tapi, kebijakan subsidi biodiesel oleh pemerintah yang tidak disertai dengan mekanisme pelindung (safeguard)
        terhadap tutupan hutan turut memicu deforestasi ini. Setelah sebelumnya mewajibkan kandungan bahan bakar nabati
        berbasis sawit dalam bahan bakar minyak jenis solar sebesar 30% (B30) kemudian meningkat menjadi 35% (B35),
        sejak awal 2025 pemerintah menerapkan
        <a href="https://www.esdm.go.id/id/media-center/arsip-berita/wujudkan-ketahanan-energi-dan-kurangi-impor-menteri-esdm-mandatori-b40-berlaku-1-januari-2025"
          target="_blank" rel="noopener noreferrer" style="color: #bc4a3c;">kebijakan B40</a>.

      </p>
      <p class="body-text">
        Di Kalimantan, pemicu utama deforestasi berupa perluasan kebun kayu demi industri <em>pulp & paper</em>.
        Pemberian izin pembangunan pabrik pulp raksasa PT Phoenix Resources International di Tarakan, Kalimantan Utara
        menjadi penyebab utama, karena dalam perencanaannya pabrik ini tidak memiliki konsesi pemasok yang dikelola
        sendiri. Banyak deforestasi terjadi di Kalimantan Tengah dan Kalimantan Timur yang bermuara ke pabrik ini.
      </p>
      <p class="body-text">
        <em>Booming</em> kendaraan listrik menjadi pemicu ekspansi tambang dan industri nikel. Namun, pemberian izin
        industri yang tidak disertai dengan kejelasan sumber bahan baku, terutama untuk menghindari deforestasi,
        mengakibatkan melonjaknya deforestasi di Sulawesi (dan Maluku Utara).
      </p>
      <p class="body-text">
        Tambang dan industri nikel bukan barang baru di Sulawesi, karena penambangan nikel sudah ada sejak 1930-an, dan
        industri pengolahan (smelter) nikel sudah beroperasi sejak 1973. Hingga 2014 hanya 3 smelter nikel yang
        beroperasi di Sulawesi. Kemudian jumlahnya membengkak di era presidensi Joko Widodo. Pada 2014-2024 setidaknya
        ada 16 smelter nikel baru yang beroperasi di pulau dengan tingkat endemisme tertinggi di dunia ini.
      </p>
      <p class="body-text">
        Meningkatnya harga emas juga turut memicu deforestasi. Bahkan, 2 konsesi tambang emas bertengger dalam sepuluh
        teratas deforestasi dalam konsesi tambang, yakni PT Agincourt Resources dan PT Blok Waringin Agung.
      </p>

      <!-- <div class="callout">
                                          <strong>Faktor pendorong utama:</strong>
                                          <ul style="margin-top:8px;padding-left:16px;font-size:.82rem;line-height:1.75;color:var(--ink-mid);">
                                            <li>Ekspansi sawit dan kebun kayu di area berhutan</li>
                                            <li>Pemberian izin industri tanpa kejelasan sumber bahan baku bebas deforestasi</li>
                                            <li>Kenaikan harga komoditas seperti nikel dan emas</li>
                                          </ul>
                                        </div> -->
    </div>

    <hr class="divider">

    <div>
      <div class="chapter-header">
        <span class="ms-num">04</span>
        <h3 class="chapter-title">Legal deforestasi sebagai biang masalah</h3>
      </div>
      <p class="body-text">
        Salah satu efek dari kerumitan aturan di Indonesia adalah ketidaklugasan dalam mengenali legal atau tidaknya
        suatu deforestasi. Terdapat banyak aturan yang melindungi hutan, tapi tidak sedikit celah yang membuatnya tidak
        terlindungi.
      </p>
      <p class="body-text">
        Dalam sebuah presentasi pada
        <a href="https://www.youtube.com/watch?v=fXpCyo4TrlU&t=7193s" target="_blank" rel="noopener noreferrer"
          style="color: #bc4a3c;">Rapat Dengar Pendapat Umum</a>
        di Komisi 4 Dewan Perwakilan Rakyat Republik Indonesia (DPR RI) pada 15 Juli 2025 Auriga Nusantara
        mengungkapkan, per 2024, seluas 41,6 juta hektare atau 44% tutupan hutan alam di Indonesia tidak punya
        perlindungan hukum. Dengan kondisi demikian, manuver yang tidak melanggar hukum yang akan menghilangkan hutan
        tersebut, seperti melalui penerbitan izin konversi atau revisi tata ruang, masih memungkinkan.
      </p>
      <p class="body-text">
        Dari total deforestasi 2025, deforestasi yang secara langsung bisa dikategorikan ilegal hanya deforestasi di
        kawasan konservasi (20.077 hektare), di hutan lindung (80.023 hektare), di konsesi logging (74.409 hektare), dan
        konsesi restorasi ekosistem (617 hektare), yang seluruhnya berjumlah 180.370 hektare atau 42% deforestasi
        nasional. Dengan kata lain, 58% deforestasi 2025 berupa deforestasi legal (<em>legal deforestation</em>).
      </p>
    </div>

    <hr class="divider">

    <div>
      <div class="chapter-header">
        <span class="ms-num">05</span>
        <h3 class="chapter-title">Deforestasi tinggi di area konservasi</h3>
      </div>
      <p class="body-text">
        Saat ini, perlakuan konservasi oleh pemerintah cenderung hanya pada kawasan konservasi, yakni area konservasi
        yang ada di dalam kawasan hutan. Kawasan konservasi adalah penggabungan kawasan suaka alam, seperti cagar alam,
        suaka margasatwa; dan kawasan pelestarian alam, seperti taman nasional, taman hutan raya. Kawasan konservasi di
        Indonesia saat ini seluas 22,1 juta hektare.
      </p>
      <p class="body-text">
        Akan tetapi terdapat sejumlah besar area-area yang penting secara ekologi di luar kawasan konservasi. Area di
        luar kawasan konservasi ini merupakan habitat spesies ikonik harimau, badak, gajah, orangutan seluas 22,8 juta
        hektare; dan Key Biodiversity Area (KBA) yang dikembangkan IUCN seluas 21,6 juta hektare. Ketiga wilayah ini
        bila digabungkan sebagai area konservasi seluruhnya –tanpa menghitung perulangan– seluas 63,5 juta hektare.
      </p>
      <p class="body-text">
        Deforestasi di kawasan konservasi pada 2024 seluas 7.704 hektare, melonjak menjadi 25.077 hektare pada 2025,
        atau meningkat 225%. Sementara, deforestasi di seluruh area konservasi terhitung seluas 186.465 hektare atau 43%
        deforestasi nasional.
      </p>
    </div>
  </section>

  <!-- REKOMENDASI -->
  <span class="s-anchor" id="rekomendasi"></span>
  <section class="page-section px-[5vw] pt-10 pb-20">
    <div class="mx-auto max-w-[820px]">
      <div class="section-label">06 / Rekomendasi</div>

      <p class="body-text">
        Perlindungan hutan alam tersisa perlu diperkuat melalui kombinasi regulasi, tata ruang, kelembagaan, dan
        tanggung jawab para pemegang izin. Rekomendasi berikut menempatkan perlindungan hutan sebagai agenda kebijakan
        yang harus dijalankan secara serentak.
      </p>

      <div class="method-steps">
        <div class="method-step">
          <div class="ms-num">01</div>
          <div>
            <h4 class="chapter-title">Penerbitan regulasi yang memastikan perlindungan seluruh hutan alam tersisa di
              Indonesia.</h4><br>
            <p class="body-text">
              Perlindungan hukum terhadap hutan alam idealnya dalam bentuk undang-undang. Namun, menghadirkan sebuah
              undang-undang bukan perkara mudah, dan kerap butuh waktu bertahun-tahun. Peraturan di bawahnya, yakni
              peraturan pemerintah, pun tak jarang memerlukan waktu lama untuk pembuatannya, terutama oleh kerumitan dan
              kompleksitas persetujuan lintas kementerian, sebuah prasyarat yang diperlukan dalam penyusunan peraturan
              pemerintah. Karenanya, peraturan presiden akan merupakan terobosan taktis, namun cukup menjawab persoalan,
              sebagai rem darurat. Maka, saatnya Presiden Prabowo menerbitkan peraturan presiden mengenai perlindungan
              <strong> seluruh </strong> hutan alam tersisa di Indonesia.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">02</div>
          <div class="">
            <h4 class="chapter-title">Pengadaan dan pemberlakuan instrumen pengendalian revisi tata ruang.</h4><br>
            <p class="body-text">
              pertengahan 2023 publik dikejutkan dengan usulan revisi tata ruang Provinsi Kalimantan Timur yang
              ditengarai akan melepaskan 612.355 hektare kawasan hutan (menjadi area penggunaan lain), menurunkan fungsi
              kawasan hutan (sehingga memungkinkan ditambang) seluas 101.788 hektare. Padahal, setidaknya 389.596
              hektare
              <a href="https://www.youtube.com/watch?v=Mx4638DmEjI" target="_blank" rel="noopener noreferrer"
                style="color: #bc4a3c;">(55%) area ini bertutupan hutan alam</a>.
              Sementara, beberapa bulan sebelumnya Pemerintah Provinsi Kalimantan Utara mengusulkan revisi tata ruang
              yang akan mengalihkan fungsi kawasan hutan seluas
              <a href="https://korankaltara.com/762-ribu-hektare-hutan-diusulkan-beralih-fungsi" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">762.000 hektare</a>.
              Di Aceh, manuver pemerintah daerah ditengarai akan berdampak pada hilangnya status perlindungan Kawasan
              Ekosistem Leuser yang telah ditetapkan sebagai cagar biosfer sekaligus sebagai penyangga Taman Nasional
              Gunung Leuser. Sekelumit kecil contoh empirik ini menunjukkan kemendesakan perlunya instrumen pengendalian
              revisi tata ruang wilayah yang menjamin prosesnya berlangsung secara transparan dan memastikan pelibatan
              pihak terdampak sehingga hasil revisinya semata-mata demi kepentingan publik.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">03</div>
          <div class="">
            <h4 class="chapter-title">Percepatan perluasan area preservasi, terutama di luar kawasan hutan</h4><br>
            <p class="body-text">
              Sebagaimana disampaikan di atas, kawasan konservasi eksisting jauh dari memadai untuk mencakup seluruh
              area konservasi. Bahkan, setidaknya 31.358 hektare habitat spesies ikonik dan area penting biodiversitas
              tersebut berada dalam area penggunaan lain (APL). Di tengah rendahnya kinerja pelestarian dalam kawasan
              konservasi oleh Kementerian Kehutanan, perlu model-model baru pengelolaan area konservasi. Undang-Undang
              Konservasi 32/2024 telah membuka ruang untuk ini, yakni sebagai area preservasi. Namun, kekosongan
              peraturan pelaksananya mengakibatkan belum adanya perwujudan area preservasi hingga saat ini. Oleh karena
              itu, pengadaan aturan pelaksana ini perlu disegerakan. Namun begitu, perlu digarisbawahi bahwa area
              preservasi ini semestinya merupakan model-model baru, semisal pengelolaannya, termasuk penerima manfaat
              ekonominya, oleh dan untuk pemerintah daerah atau komunitas lokal dengan kordinasi atau supervisi oleh
              Kementerian Kehutanan.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">04</div>
          <div class="">
            <h4 class="chapter-title">Redistribusi kelembagaan dan aparatur pengelola hutan sehingga seluruh tutupan
              hutan alam memiliki aparatur penjaga.</h4><br>
            <p class="body-text">
              Presiden Prabowo disebut telah memerintahkan penggandaan jumlah polisi hutan. Satu langkah yang semestinya
              patut diapresiasi. Akan tetapi, sebagaimana pernah
              <a href="https://www.youtube.com/watch?v=fXpCyo4TrlU&t=7193s" target="_blank" rel="noopener noreferrer"
                style="color: #bc4a3c;">dipaparkan</a> Auriga Nusantara ke Komisi 4 DPR RI, keberadaan aparatur penjaga
              hutan selama ini cenderung terkonsentrasi di Pulau Jawa. Demikian juga penganggaran, porsi anggaran negara
              per hektare kawasan hutan jauh lebih tinggi di Jawa. Karena itu, selain penambahan aparatur –atau
              redistribusi kewenangan dan fungsi pengelolaan ke pemerintah daerah– diperlukan juga redistribusi aparatur
              sehingga seluruh tutupan hutan alam memiliki aparatur penjaga berikut anggarannya.

            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">05</div>
          <div class="">
            <h4 class="chapter-title">Korporasi yang mengelola area bertutupan hutan alam berkomitmen terhadap
              lingkungan, sosial, dan tata kelola yang baik (ESG Commitment).</h4><br>
            <p class="body-text">
              Hampir separuh deforestasi 2025 terjadi di dalam konsesi, sementara terdapat lebih dari 9 juta hektare
              tutupan hutan alam di dalam konsesi konversi (tambang, sawit, kebun kayu). Korporasi-korporasi yang
              mengelola areal bertutupan hutan alam ini semestinya menyatakan komitmen lingkungan, sosial, dan tata
              kelola yang baik, termasuk untuk tidak melakukan atau terlibat dengan deforestasi.
            </p>
          </div>
        </div>
        <div class="method-step">
          <div class="ms-num">06</div>
          <div class="">
            <h4 class="chapter-title">Penyediaan insentif bagi pemerintah daerah, komunitas lokal, dan korporasi yang
              melakukan perlindungan hutan alam.</h4><br>
            <p class="body-text">Perlindungan hutan semestinya dipandang sebagai investasi, selain karena fungsi dan
              jasa lingkungannya yang dinikmati publik, juga karena kegiatan ekonomi akan terganggu bila lingkungan
              rusak atau tidak berfungsi semestinya. Karena itu, insentif semestinya disediakan negara kepada
              pihak-pihak yang melindungi hutan, baik komunitas lokal, pemerintah daerah (provinsi, kabupaten, dan
              desa), maupun korporasi. Selain insentif, manfaat ekonomi, seperti jasa karbon, atas keberadaan hutan
              semestinya diperoleh juga oleh pihak-pihak yang melindungi hutan. Insentif dan manfaat ekonomi ini selain
              sebagai stimulus untuk perlindungan hutan alam, juga sebagai penyedia pembiayaan untuk perlindungan hutan
              dalam jangka panjang oleh pihak-pihak tersebut.
            </p>
          </div>
        </div>
      </div>

      <p class="body-text">
        Selain itu, komitmen ESG para pemilik atau pengelola izin serta insentif bagi pemerintah daerah, komunitas
        lokal, dan swasta dalam perlindungan hutan alam perlu diperkuat agar perlindungan hutan tidak hanya bergantung
        pada pendekatan administratif semata.
      </p>

      <hr class="divider">

      <div class="author-block film-credit-block">
        <div class="ab-group">
          <div class="ab-label">Penulis</div>
          <div class="ab-names">Timer Manurung, Dedy Sukmara, Andhika Younastya</div>
        </div>
        <div class="ab-group">
          <div class="ab-label">Pengolah Data</div>
          <div class="ab-names">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika Laura, Dedy
            Sukmara, Jumrio Nakul, M. Alichamdan, M. Dendi Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno</div>
        </div>
        <div class="ab-group">
          <div class="ab-label">Tim Verifikasi</div>
          <div class="ab-names">Achmad Rafly Gymnastiar, Aditya Prima Yudha, Adzra Aqila Muthia, Andhika Younastya,
            Anggun Detrina Napitupulu, Annisa Meira Nurfauziah, Bagus Sugiarto, Cecilinia Tika Laura, Chairul Soleh,
            Dedi Septyadi Wibisono, Fadela Yunika Sari, Hafid Azi Darma, Jonathan, Jumrio Nakul, Jundy Zaky Makarim,
            Luhut Simanjutak, M. Dendi Alfitrah, M. Irfan Nurrahman, M. Irfandi Andriansyah, Muhammad Nabil Astaqafi,
            Nebo Yok Jonah Marpaung, Reza Fahlevi, Rianti Gina Violeta, Riszki Is Hardianto, Sulih Primara Putra,
            Supintri Yohar Tri Wahyuni, Valentina Yulia Permatasari, Wahyu Ananta Nugraha, Yanuar Vira Febiyanti, Yudi
            Nofiandi, Yustinus Seno, Zerin Darma Kusuma</div>
        </div>
        <div class="ab-group">
          <div class="ab-label">Tim Uji Akurasi</div>
          <div class="ab-names">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Jumrio Nakul, M. Dendi
            Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno</div>
        </div>
        <div class="ab-group">
          <div class="ab-label">Kreatif Desain</div>
          <div class="ab-names">Robby Eebor, M. Fachri</div>
        </div>
        <div class="ab-group">
          <div class="ab-label">Tim Teknologi</div>
          <div class="ab-names">M. Alichamdan, M. Fachri, Thoriq Fa'iqoh</div>
        </div>
        <div class="ab-group">
          <div class="ab-names">© Auriga Nusantara. 2026. <br><em>Status Deforestasi Indonesia 2025, diakses pada
              [DD/MM/YYYY] melalui tautan [LINK].
              Auriga Nusantara. 2025 </em><br>.</div>
        </div>
      </div>
    </div>


  </section>

@endsection

<!-- Pop up -->
<div id="popup" class="fixed inset-0 bg-black/90 flex items-center justify-center p-6 z-[999999]" style="display:none"
  onclick="
    if($(event.target).attr('id')==='popup'){
      let img = $('#popupImage');

      if(img.data('zoom') > 1){
        img.css('transform','translate(0,0) scale(1)');
        img.data({zoom:1,x:0,y:0,drag:false,dragging:false});
        $('#popupCaption').show();
      }else{
        $('#popup').fadeOut(200);
      }
    }
  ">

  <div class="w-full max-w-[1100px]">

    <img id="popupImage" src="" class="w-full max-h-[80vh] object-contain select-none" draggable="false" data-zoom="1"
      data-x="0" data-y="0" data-drag="false" data-dragging="false"
      style="cursor:pointer; transition: transform 0.2s ease; transform-origin:center;" onclick="
        if($(this).data('dragging')) return;

        let img = $(this);
        let z = img.data('zoom') || 1;

        let rect = this.getBoundingClientRect();
        let offsetX = event.clientX - rect.left;
        let offsetY = event.clientY - rect.top;

        let currentX = img.data('x') || 0;
        let currentY = img.data('y') || 0;

        if(z === 1){
          let newZoom = 2;

          let moveX = currentX - (offsetX - rect.width / 2) * (newZoom - 1);
          let moveY = currentY - (offsetY - rect.height / 2) * (newZoom - 1);

          img.data({zoom:newZoom,x:moveX,y:moveY});
          img.css('transform', `translate(${moveX}px,${moveY}px) scale(${newZoom})`);

          $('#popupCaption').hide();
        } else {
          img.data({zoom:1,x:0,y:0,drag:false,dragging:false});
          img.css('transform','translate(0,0) scale(1)');
          $('#popupCaption').show();
        }
      " onmousedown="
        if($(this).data('zoom')===1) return;

        $(this).data('drag', true);
        $(this).data('dragging', false);

        $(this).data('startX', event.clientX - ($(this).data('x')||0));
        $(this).data('startY', event.clientY - ($(this).data('y')||0));

        $(this).css('cursor','grabbing');
      " onmousemove="
        if(!$(this).data('drag')) return;

        let x = event.clientX - $(this).data('startX');
        let y = event.clientY - $(this).data('startY');

        if(Math.abs(x - ($(this).data('x')||0)) > 2 || Math.abs(y - ($(this).data('y')||0)) > 2){
          $(this).data('dragging', true);
        }

        $(this).data('x', x);
        $(this).data('y', y);

        let z = $(this).data('zoom') || 1;
        $(this).css('transform',`translate(${x}px,${y}px) scale(${z})`);
      " onmouseup="
        $(this).data('drag', false);
        setTimeout(() => $(this).data('dragging', false), 10);
        $(this).css('cursor','grab');
      " onmouseleave="
        $(this).data('drag', false);
        $(this).data('dragging', false);
      " onmouseenter="
        if($(this).data('zoom')>1){
          $(this).css('cursor','grab');
        }else{
          $(this).css('cursor','pointer');
        }
      ">

    <!-- CAPTION DI BAWAH GAMBAR -->
    <div id="popupCaption" class="bg-white text-black px-4 py-3 text-sm">
      <div id="popupTitle" class="text-xs"></div>
      <div id="popupSub" class="text-xs opacity-70 mt-1"></div>
    </div>

  </div>

</div>


@push('scripts')
  <script>
    (function () {
      function hideLoader() {
        var loader = document.getElementById('site-loader');
        if (!loader) return;
        // Reveal the sticky nav (CSS hides it by default via translateY)
        try {
          var nav = document.getElementById('sitenav');
          if (nav) nav.classList.add('show');
        } catch (e) { }

        // Re-enable page scrolling (removed during preloading)
        try { document.body.classList.remove('is-preloading'); } catch (e) { }
        try { document.documentElement.style.overflow = ''; document.body.style.overflow = ''; } catch (e) { }

        // Prevent the loader from blocking pointer events while it fades
        try { loader.style.pointerEvents = 'none'; } catch (e) { }

        loader.setAttribute('aria-hidden', 'true');
        loader.removeAttribute('aria-live');
        // Smooth fade-out
        loader.style.transition = 'opacity .45s ease, visibility .45s ease';
        loader.style.opacity = '0';
        loader.style.visibility = 'hidden';

        function cleanup() {
          if (loader && loader.parentNode) loader.parentNode.removeChild(loader);
        }

        // Remove when the CSS transition finishes. If there's no transition, remove immediately.
        try {
          var cs = window.getComputedStyle(loader);
          var dur = cs.transitionDuration || cs.webkitTransitionDuration || '0s';
          var sec = 0;
          if (dur && typeof dur === 'string') {
            // transitionDuration may contain multiple values like '0.45s, 0s'
            sec = parseFloat(dur.split(',')[0]) || 0;
          }
          if (sec > 0) {
            loader.addEventListener('transitionend', function onEnd(e) {
              if (!e || e.propertyName === 'opacity') {
                loader.removeEventListener('transitionend', onEnd);
                cleanup();
              }
            }, { once: true });
          } else {
            cleanup();
          }
        } catch (err) {
          cleanup();
        }
      }

      // Wait for full page load (images, fonts, etc.) before hiding loader
      if (document.readyState === 'complete') {
        hideLoader();
      } else {
        window.addEventListener('load', hideLoader, { once: true });
      }

      // Nav active links on scroll (sticky nav always visible)
      var navLinks = document.querySelectorAll('.nav-links a');
      var sectionIds = Array.from(navLinks).map(function (link) {
        return link.getAttribute('href').replace('#', '');
      });
      var sections = sectionIds.map(function (id) {
        return document.getElementById(id) || document.querySelector('[id="' + id + '"]');
      });

      var hero = document.getElementById('hero');
      function onScroll() {
        var offset = 120; // adjust for nav height
        var found = false;
        for (var i = sections.length - 1; i >= 0; i--) {
          var section = sections[i];
          if (section) {
            var rect = section.getBoundingClientRect();
            if (rect.top <= offset) {
              navLinks.forEach(function (link) { link.classList.remove('active'); });
              navLinks[i].classList.add('active');
              found = true;
              break;
            }
          }
        }
        if (!found) {
          navLinks.forEach(function (link) { link.classList.remove('active'); });
        }

        if (hero) {
          var y = window.scrollY * 0.35;
          hero.style.backgroundPosition = 'center calc(80% + ' + y + 'px)';
        }
      }
      window.addEventListener('scroll', function () {
        window.requestAnimationFrame(onScroll);
      });
      // Initial highlight + parallax position
      window.addEventListener('DOMContentLoaded', function () {
        onScroll();
      });

      // --- Chart code injected from chart-deforestasi.html ---
      function buildDeforestationChart() {
        var DATA = [
          { year: 2001, val: 133913 },
          { year: 2002, val: 281030 },
          { year: 2003, val: 253907 },
          { year: 2004, val: 486010 },
          { year: 2005, val: 483324 },
          { year: 2006, val: 474863 },
          { year: 2007, val: 533334 },
          { year: 2008, val: 472889 },
          { year: 2009, val: 691985 },
          { year: 2010, val: 546069 },
          { year: 2011, val: 621836 },
          { year: 2012, val: 876456 },
          { year: 2013, val: 523588 },
          { year: 2014, val: 829144 },
          { year: 2015, val: 768991 },
          { year: 2016, val: 1055796 },
          { year: 2017, val: 424048 },
          { year: 2018, val: 389052 },
          { year: 2019, val: 371087 },
          { year: 2020, val: 307532 },
          { year: 2021, val: 229982 },
          { year: 2022, val: 230760 },
          { year: 2023, val: 257384 },
          { year: 2024, val: 261575 },
          { year: 2025, val: 433751 }
        ];

        var MAX_VAL = Math.max.apply(null, DATA.map(function (d) { return d.val; }));
        var AXIS_MAX = Math.ceil(MAX_VAL / 200000) * 200000;
        var TICK_STEP = AXIS_MAX <= 600000 ? 100000 : AXIS_MAX <= 1200000 ? 200000 : 400000;
        var Y_TICKS = [];
        for (var v = 0; v <= AXIS_MAX; v += TICK_STEP) Y_TICKS.push(v);

        function fmt(v) {
          return v.toLocaleString('id-ID');
        }

        var yAxis = document.getElementById('y-axis');
        if (!yAxis) return;
        yAxis.innerHTML = '';
        Y_TICKS.forEach(function (t) {
          var el = document.createElement('div');
          el.className = 'y-tick text-[0.6rem] text-[#7a9e97] text-right pr-3 font-normal whitespace-nowrap';
          el.textContent = t === 0 ? '0' : (t >= 1000000 ? (t / 1000000).toFixed(1).replace('.', ',') + 'jt' : (t / 1000) + 'rb');
          yAxis.appendChild(el);
        });

        var gridWrap = document.getElementById('grid-lines');
        gridWrap.innerHTML = '';
        Y_TICKS.forEach(function (t) {
          var line = document.createElement('div');
          line.className = 'grid-line absolute inset-x-0 h-[1px] bg-[rgba(255,255,255,.07)]';
          line.style.bottom = ((t / AXIS_MAX) * 100) + '%';
          gridWrap.appendChild(line);
        });

        var barsWrap = document.getElementById('bars-svg-wrap');
        var xAxis = document.getElementById('x-axis');
        barsWrap.innerHTML = '';
        xAxis.innerHTML = '';

        var barEls = [];
        var colsTemplate = 'repeat(' + DATA.length + ', minmax(0, 1fr))';
        barsWrap.style.gridTemplateColumns = colsTemplate;
        xAxis.style.gridTemplateColumns = colsTemplate;

        DATA.forEach(function (d, i) {
          var col = document.createElement('div');
          col.className = 'bar-col flex flex-col items-center justify-end h-full cursor-pointer relative';
          col.dataset.index = i;

          var hoverBg = document.createElement('div');
          hoverBg.style.cssText = 'position:absolute;inset:0;background:rgba(255,255,255,0.1);border-radius:3px;opacity:0;transition:opacity:.18s;pointer-events:none;';
          col.appendChild(hoverBg);

          var rect = document.createElement('div');
          rect.className = 'bar-rect w-full  bg-[#bc4a3c] origin-bottom scale-y-0 transition-colors duration-150 relative';
          var pct = (d.val / AXIS_MAX) * 100;
          rect.style.height = pct + '%';
          col.appendChild(rect);
          barsWrap.appendChild(col);
          barEls.push({ col: col, rect: rect, hoverBg: hoverBg });

          var lbl = document.createElement('div');
          lbl.className = 'x-label flex-1 text-[0.52rem] text-[#7a9e97] text-center font-normal writing-vertical-rl rotate-180 pt-1 ' + (d.year % 4 === 1 ? 'font-semibold text-[#e07060]' : '');
          lbl.style.writingMode = 'vertical-rl';
          lbl.textContent = d.year;
          xAxis.appendChild(lbl);
        });

        gsap.to(barEls.map(function (b) { return b.rect; }), {
          scaleY: 1,
          duration: 0.9,
          ease: 'power3.out',
          stagger: 0.045,
          delay: 0.2
        });

        var PRESIDENTS = [
          { name: 'Megawati', start: 2001, end: 2004, photo: '/assets/images/presiden/meg.jpeg' },
          { name: 'Susilo Bambang Yudhoyono', start: 2005, end: 2014, photo: '/assets/images/presiden/sby.jpg' },
          { name: 'Jokowi', start: 2015, end: 2024, photo: '/assets/images/presiden/jok.jpeg' },
          { name: 'Prabowo', start: 2025, end: 2025, photo: '/assets/images/presiden/pra.jpeg' }
        ];

        function getPresident(year) {
          return PRESIDENTS.find(function (p) { return year >= p.start && year <= p.end; }) || null;
        }
        function calcTotal(p) {
          return DATA.filter(function (d) { return d.year >= p.start && d.year <= p.end; }).reduce(function (s, d) { return s + d.val; }, 0);
        }
        function fmtTotal(v) {
          return (v / 1000000).toFixed(2).replace('.', ',') + ' jt';
        }

        var presList = document.getElementById('pres-list');
        presList.innerHTML = '';
        var cardEls = [];

        PRESIDENTS.forEach(function (p) {
          var total = calcTotal(p);
          var card = document.createElement('div');
          card.className = 'pres-card flex items-center gap-2 p-2.5  cursor-pointer mb-1 border border-transparent opacity-60 transition duration-150';
          card.innerHTML = '<div class="pres-avatar">' +
            '<img src="' + p.photo + '" alt="' + p.name + '" onerror="this.style.display=\'none\'">' +
            '<span class="pres-initials">' + p.name.slice(0, 3).toUpperCase() + '</span>' +
            '</div>' +
            '<div class="pres-info"><div class="pres-name">' + p.name + '</div><div class="pres-period">' + (p.start === p.end ? p.start : (p.start + '–' + p.end)) + '</div></div>' +
            '<div class="pres-stat"><div class="pres-total">' + fmtTotal(total) + '</div><div class="pres-total-unit">ha hilang</div></div>';
          presList.appendChild(card);
          cardEls.push(card);
        });

        var activeEra = null;

        function setEra(name) {
          activeEra = name;
          barEls.forEach(function (item, i) {
            var p = getPresident(DATA[i].year);
            var match = p && p.name === name;
            gsap.to(item.col, { opacity: match ? 1 : 0.12, duration: 0.3, ease: 'power2.out' });
            item.rect.style.background = match ? '#e07060' : '';
          });
          cardEls.forEach(function (c, i) {
            c.style.opacity = '';
            c.classList.toggle('active', PRESIDENTS[i].name === name);
          });
        }

        function clearEra() {
          activeEra = null;
          barEls.forEach(function (item) {
            gsap.to(item.col, { opacity: 1, duration: 0.3, ease: 'power2.out' });
            item.rect.style.background = '';
          });
          cardEls.forEach(function (c) {
            c.style.opacity = '';
            c.classList.remove('active');
          });
        }

        cardEls.forEach(function (card, i) {
          card.addEventListener('click', function () {
            if (activeEra === PRESIDENTS[i].name) clearEra(); else setEra(PRESIDENTS[i].name);
          });
        });

        var ydYear = document.getElementById('yd-year');
        var ydVal = document.getElementById('yd-val');
        function updateYearDisplay(d) {
          ydYear.textContent = d ? d.year : 'Arahkan kursor ke bar';
          ydVal.textContent = d ? d.val.toLocaleString('id-ID') : '\u2014';
        }

        barEls.forEach(function (item, i) {
          item.col.addEventListener('mouseenter', function () {
            gsap.to(item.rect, { scaleY: 1.025, transformOrigin: 'bottom center', duration: .18, ease: 'power1.out' });
            item.hoverBg.style.opacity = '1';
            updateYearDisplay(DATA[i]);
            if (!activeEra) {
              var hovPres = getPresident(DATA[i].year);
              cardEls.forEach(function (c, ci) { c.style.opacity = hovPres && PRESIDENTS[ci].name === hovPres.name ? '1' : '0.3'; });
            }
          });
          item.col.addEventListener('mouseleave', function () {
            gsap.to(item.rect, { scaleY: 1, duration: .22, ease: 'power1.out' });
            item.hoverBg.style.opacity = '0';
            updateYearDisplay(null);
            if (!activeEra) cardEls.forEach(function (c) { c.style.opacity = ''; });
          });
          item.col.addEventListener('click', function () {
            var pres = getPresident(DATA[i].year);
            if (!pres) return;
            if (activeEra === pres.name) clearEra(); else setEra(pres.name);
          });
        });

        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') clearEra(); });
      }

      // ensure GSAP is loaded
      if (typeof gsap === 'undefined') {
        var gsapScript = document.createElement('script');
        gsapScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js';
        gsapScript.onload = buildDeforestationChart;
        document.head.appendChild(gsapScript);
      } else {
        buildDeforestationChart();
      }

      function alurToggle(card) {
        var desc = card.querySelector('.card-desc');
        if (!desc) return;
        var isHidden = desc.classList.contains('hidden');
        var embed = document.getElementById('alur-embed');
        if (embed) {
          embed.querySelectorAll('.card-desc').forEach(function (d) { d.classList.add('hidden'); });
          embed.querySelectorAll('.card.active').forEach(function (c) { c.classList.remove('active'); });
        }
        if (isHidden) {
          desc.classList.remove('hidden');
          card.classList.add('active');
        }
      }
      function alurRowToggle(lane) {
        var row = lane.closest('[id^="row"]');
        if (!row) return;
        var steps = row.querySelector('.steps');
        if (!steps) return;
        row.classList.toggle('row-collapsed');
        // Remove stale SVG immediately; redraw on next paint (display:none is instant).
        var old = document.getElementById('alur-csvy');
        if (old) old.remove();
        requestAnimationFrame(drawAlurConnector);
      }

      function drawAlurConnector() {
        var dwrap = document.getElementById('dwrap');
        if (!dwrap) return;

        var old = document.getElementById('alur-csvy');
        if (old) old.remove();

        var NS = 'http://www.w3.org/2000/svg';
        var svg = document.createElementNS(NS, 'svg');
        svg.id = 'alur-csvy';
        var dw = dwrap.offsetWidth;
        var dh = dwrap.offsetHeight;
        svg.setAttribute('style', 'position:absolute;top:0;left:0;width:' + dw + 'px;height:' + dh + 'px;pointer-events:none;overflow:visible;z-index:10;');

        // Shared filled arrowhead marker
        var defs = document.createElementNS(NS, 'defs');
        var mk = document.createElementNS(NS, 'marker');
        mk.setAttribute('id', 'alur-mk');
        mk.setAttribute('viewBox', '0 0 8 8');
        mk.setAttribute('refX', '8');
        mk.setAttribute('refY', '4');
        mk.setAttribute('markerWidth', '5');
        mk.setAttribute('markerHeight', '5');
        mk.setAttribute('orient', 'auto');
        var mkp = document.createElementNS(NS, 'path');
        mkp.setAttribute('d', 'M0,0 L8,4 L0,8 Z');
        mkp.setAttribute('fill', 'rgba(199,91,46,0.7)');
        mk.appendChild(mkp); defs.appendChild(mk); svg.appendChild(defs);

        // Returns position relative to #dwrap via offsetParent chain (scroll-independent).
        // display:none elements return all-zero dimensions.
        function getPos(el) {
          var x = 0, y = 0, node = el;
          while (node && node !== dwrap) {
            x += node.offsetLeft;
            y += node.offsetTop;
            node = node.offsetParent;
          }
          return {
            left: x, top: y,
            right: x + el.offsetWidth, bottom: y + el.offsetHeight,
            cx: x + el.offsetWidth / 2, cy: y + el.offsetHeight / 2,
            width: el.offsetWidth, height: el.offsetHeight
          };
        }

        // Returns anchor position for cardId.
        // When the card is inside a .row-collapsed row (steps hidden, height = 0),
        // falls back to the row's visible boundary so connectors always draw.
        // cx/cy use the lane header centre so the arrow points to the visible row header.
        function getAnchor(cardId) {
          var el = document.getElementById(cardId);
          if (!el) return null;
          var pos = getPos(el);
          if (pos.height > 0) return pos;   // card is visible — use directly
          // Card is hidden inside a collapsed row — fall back to row boundary
          var row = el.closest('[id^="row"]');
          if (!row) return null;
          var lane = row.querySelector('.a-lane');
          var rp = getPos(row);
          var lp = lane ? getPos(lane) : rp;
          return {
            left: lp.left, top: rp.top,
            right: lp.right, bottom: rp.bottom,
            cx: lp.cx, cy: rp.top + rp.height / 2,
            width: lp.width, height: rp.height,
            collapsed: true
          };
        }

        function makePath(d) {
          var p = document.createElementNS(NS, 'path');
          p.setAttribute('d', d);
          p.setAttribute('fill', 'none');
          p.setAttribute('stroke', 'rgba(199,91,46,0.55)');
          p.setAttribute('stroke-width', '1.4');
          p.setAttribute('stroke-linejoin', 'miter');
          p.setAttribute('stroke-linecap', 'butt');
          p.setAttribute('marker-end', 'url(#alur-mk)');
          return p;
        }

        // ── Connector 1: Output Model → Normalisasi Citra Sentinel 2
        // Right-side corridor. When collapsed, row right edge + lane cy used.
        (function () {
          var fr = getAnchor('outmodel');
          var tr = getAnchor('normcit');
          if (!fr || !tr) return;
          var rail = Math.min(Math.max(fr.right, tr.right) + 18, dw - 4);
          var d = 'M' + fr.right + ',' + fr.cy
            + ' L' + rail + ',' + fr.cy
            + ' L' + rail + ',' + tr.cy
            + ' L' + tr.right + ',' + tr.cy;
          svg.appendChild(makePath(d));
        })();

        // ── Connector 2: Agregasi True Alert → Bounding Box
        // Cubic bezier bowing right. When collapsed, lane-centre x + row boundary.
        (function () {
          var fr = getAnchor('agreg');
          var tr = getAnchor('bbox');
          if (!fr || !tr) return;
          var dy = tr.top - fr.bottom;
          var bow = Math.max(dy * 0.45, 30);
          var cx1 = fr.cx + bow;
          var cy1 = fr.bottom + dy * 0.25;
          var cx2 = tr.cx + bow;
          var cy2 = tr.top - dy * 0.25;
          var d = 'M' + fr.cx + ',' + fr.bottom
            + ' C' + cx1 + ',' + cy1
            + ' ' + cx2 + ',' + cy2
            + ' ' + tr.cx + ',' + tr.top;
          svg.appendChild(makePath(d));
        })();

        // ── Connector 3: Data Deforestasi Indikatif → Overlay & Filter Area
        // Straight vertical using source cx (both cards are leftmost in their rows).
        (function () {
          var fr = getAnchor('dataindikatif');
          var tr = getAnchor('r4c1');
          if (!fr || !tr) return;
          var d = 'M' + fr.cx + ',' + fr.bottom
            + ' L' + fr.cx + ',' + tr.top;
          svg.appendChild(makePath(d));
        })();

        dwrap.appendChild(svg);
      }

      window.addEventListener('load', function () {
        // rAF ensures layout is complete before measuring positions
        requestAnimationFrame(function () { requestAnimationFrame(drawAlurConnector); });
      });
      window.addEventListener('resize', drawAlurConnector);

      // Re-draw connectors when the horizontal scroll container scrolls
      // (outmodel→normcit is on the far right — needs redraw after scroll)
      var embedEl = document.getElementById('alur-embed');
      if (embedEl) embedEl.addEventListener('scroll', drawAlurConnector);

      // Expose onclick handlers to global scope (IIFE-scoped functions
      // cannot be found by inline onclick attributes otherwise)
      window.alurToggle = alurToggle;
      window.alurRowToggle = alurRowToggle;
    })();
  </script>
@endpush

@push('scripts')
  <script id="peta-embed-script">
    const PETA_YEARS = [2021, 2022, 2023, 2024, 2025];
    const PETA_DATA = {
      sumatra: [70, 65, 33, 91, 144],
      kalimantan: [95, 105, 124, 129, 158],
      sulawesi: [18, 22, 36, 17, 39],
      papua: [10, 20, 55, 17, 77],
    };
    const PETA_ALL_ISLANDS = ['sumatra', 'kalimantan', 'sulawesi', 'papua'];

    function petaBuildAxis(id, max) {
      const axis = document.getElementById('peta-axis-' + id);
      if (!axis) return;
      axis.innerHTML = '';
      const steps = [max, max * 0.75, max * 0.5, max * 0.25, 0];
      steps.forEach((value, i) => {
        const tick = document.createElement('div');
        tick.style.cssText = 'position:absolute;right:0;text-align:right;transform:translateY(-50%);font-family:Poppins,sans-serif;font-size:.52rem;font-weight:700;color:#1a1a1a;line-height:1;white-space:nowrap;';
        tick.style.top = (i * 25) + '%';
        tick.textContent = Number.isInteger(value) ? String(value) : value.toFixed(1);
        axis.appendChild(tick);
      });
    }

    function petaBuildBars(id, data) {
      const wrap = document.getElementById('peta-bars-' + id);
      const xlabels = document.getElementById('peta-xlabels-' + id);
      const max = 200;
      petaBuildAxis(id, max);
      data.forEach((v, i) => {
        const bw = document.createElement('div');
        bw.style.cssText = 'display:flex;flex-direction:column;align-items:center;justify-content:flex-end;flex:1;height:100%;opacity:0;transition:opacity .3s;';
        bw.dataset.baridx = i;
        const bar = document.createElement('div');
        bar.className = 'peta-bar';
        bar.style.cssText = 'width:100%;max-width:22px;background:#c14c3b;min-height:2px;';
        const h = Math.round((v / max) * 78);
        bar.style.height = h + 'px';
        bar.dataset.idx = i;
        bw.appendChild(bar);
        wrap.appendChild(bw);
        const lbl = document.createElement('div');
        lbl.dataset.baridx = i;
        lbl.style.cssText = 'flex:1;text-align:center;font-family:Poppins,sans-serif;font-size:.58rem;font-weight:700;color:#1a1a1a;line-height:1;opacity:0;transition:opacity .3s;';
        lbl.textContent = String(PETA_YEARS[i]).slice(2);
        xlabels.appendChild(lbl);
      });
    }

    let petaActiveYear = -1;
    let petaChartsOpen = false;

    function petaRevealBars(idx, barOffset) {
      barOffset = barOffset || 0;
      PETA_ALL_ISLANDS.forEach((id, islandIdx) => {
        const islandDelay = islandIdx * barOffset;
        const barsWrap = document.getElementById('peta-bars-' + id);
        const xlabelsWrap = document.getElementById('peta-xlabels-' + id);
        barsWrap.querySelectorAll('[data-baridx]').forEach(el => {
          if (parseInt(el.dataset.baridx) > idx) el.style.opacity = '0';
        });
        xlabelsWrap.querySelectorAll('[data-baridx]').forEach(el => {
          if (parseInt(el.dataset.baridx) > idx) el.style.opacity = '0';
        });
        for (let j = 0; j <= idx; j++) {
          setTimeout(() => {
            const bEl = barsWrap.querySelector('[data-baridx="' + j + '"]');
            const lEl = xlabelsWrap.querySelector('[data-baridx="' + j + '"]');
            if (bEl) bEl.style.opacity = '1';
            if (lEl) lEl.style.opacity = '1';
          }, islandDelay + j * 130);
        }
      });
    }

    function petaSelectYear(idx) {
      const ghost = document.getElementById('peta-year-ghost');
      const wrap = document.getElementById('peta-charts-wrap');
      if (petaActiveYear === idx) {
        petaActiveYear = -1;
        petaChartsOpen = false;
        document.querySelectorAll('#peta-bubbles .peta-bub').forEach(b => b.classList.remove('on'));
        PETA_ALL_ISLANDS.forEach(id => {
          document.getElementById('peta-chart-' + id).classList.add('hidden');
          document.getElementById('peta-bars-' + id).querySelectorAll('[data-baridx]').forEach(el => el.style.opacity = '0');
          document.getElementById('peta-xlabels-' + id).querySelectorAll('[data-baridx]').forEach(el => el.style.opacity = '0');
        });
        if (ghost) ghost.textContent = '2025';
        if (wrap) wrap.classList.remove('peta-open');
        return;
      }
      petaActiveYear = idx;
      if (ghost) ghost.textContent = PETA_YEARS[idx];
      document.querySelectorAll('#peta-bubbles .peta-bub').forEach((b, i) => b.classList.toggle('on', i === idx));
      PETA_ALL_ISLANDS.forEach(id => {
        document.querySelectorAll('#peta-bars-' + id + ' .peta-bar').forEach((bar, i) => {
          bar.classList.toggle('hi', i === idx);
        });
      });
      if (wrap) wrap.classList.add('peta-open');
      if (petaChartsOpen) {
        petaRevealBars(idx, 0);
        return;
      }
      petaChartsOpen = true;
      PETA_ALL_ISLANDS.forEach((id, i) => {
        setTimeout(() => document.getElementById('peta-chart-' + id).classList.remove('hidden'), i * 200);
      });
      petaRevealBars(idx, 200);
    }

    document.addEventListener('DOMContentLoaded', () => {
      Object.keys(PETA_DATA).forEach(k => petaBuildBars(k, PETA_DATA[k]));
      const totals = [229982, 230760, 257385, 261574, 433751];
      const minV = Math.min(...totals), maxV = Math.max(...totals);
      const isMobile = window.innerWidth < 640;
      const minS = isMobile ? 50 : 54, maxS = isMobile ? 48 : 90;
      document.querySelectorAll('#peta-bubbles .peta-bub').forEach((bub, i) => {
        const t = (totals[i] - minV) / (maxV - minV);
        const s = Math.round(minS + t * (maxS - minS));
        bub.style.width = s + 'px'; bub.style.height = s + 'px';
        const valEl = bub.querySelector('.b-val');
        if (valEl) valEl.style.fontSize = (isMobile ? 0.48 : 0.78) + (t * (isMobile ? 0.22 : 0.46)) + 'rem';
        const yrEl = bub.querySelector('.b-yr');
        if (yrEl) yrEl.style.fontSize = (isMobile ? 0.42 : 0.60) + (t * (isMobile ? 0.06 : 0.14)) + 'rem';
      });
    });
  </script>

  <!-- PETA TEMATIK: Leaflet + Map JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-gesture-handling@1.2.2/dist/leaflet-gesture-handling.min.js"></script>
  <script>
    (function () {
      const isMobile = window.innerWidth < 640;
      const map = L.map('map', {
        zoomControl: false,
        attributionControl: false,
        gestureHandling: true,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        minZoom: isMobile ? 0.1 : 4,
        maxZoom: isMobile ? 3 : 9
      }).setView(isMobile ? [-6.3, 118] : [-2.3, 118], isMobile ? 3 : 5);

      L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Physical_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
        maxZoom: 19
      }).addTo(map);

      const stadi2025Layer = L.layerGroup().addTo(map);
      const markerLayer = L.layerGroup().addTo(map);
      const polygonLayer = L.layerGroup().addTo(map);
      const calloutLayer = { clearLayers: () => { } };
      let markerRegistry = [];
      let activeMarker = null;
      let activeRow = null;
      let currentMode = 'provinsi';
      let activeEntry = null;
      let activePolygonSpecies = null;
      let stadi2025Loaded = false;

      const MODES = {
        provinsi: {
          kpiLabel: 'Deforestasi di 10 provinsi teratas',
          kpiVal: '302.493',
          kpiUnit: 'hektare',
          notesSidebar: [
            '10 provinsi teratas didominasi Kalimantan dan Sumatera.',
            'Kalimantan Tengah naik ke peringkat pertama pada 2025.',
            'Aceh, Sumatera Utara, dan Sumatera Barat melonjak tajam.'
          ],
          notesBox: [''],
          markers: [
            { lat: -1.8, lng: 113.0, rank: 1, name: 'Kalimantan Tengah', value: '56.900', dir: 'right' },
            { lat: 0.9, lng: 117.1, rank: 2, name: 'Kalimantan Timur', value: '47.135', dir: 'right' },
            { lat: 4.3, lng: 96.8, rank: 3, name: 'Aceh', value: '38.157', dir: 'right' },
            { lat: -0.5, lng: 111.3, rank: 4, name: 'Kalimantan Barat', value: '31.876', dir: 'left' },
            { lat: -3.2, lng: 138.5, rank: 5, name: 'Papua Tengah', value: '26.978', dir: 'left' },
            { lat: -0.9, lng: 100.5, rank: 6, name: 'Sumatera Barat', value: '26.940', dir: 'right' },
            { lat: 2.2, lng: 99.3, rank: 7, name: 'Sumatera Utara', value: '20.512', dir: 'right' },
            { lat: 2.8, lng: 116.5, rank: 8, name: 'Kalimantan Utara', value: '19.716', dir: 'right' },
            { lat: 0.5, lng: 101.7, rank: 9, name: 'Riau', value: '17.812', dir: 'left' },
            { lat: -5.7, lng: 140.6, rank: 10, name: 'Papua Pegunungan', value: '16.468', dir: 'left' }
          ],
          tables: [
            {
              title: 'Provinsi 2025',
              headers: ['2025', '2024', 'Provinsi', '2025 (ha)', '2024 (ha)'],
              rows: [
                ['1', '↑3', 'Kalimantan Tengah', '56.900', '33.389'],
                ['2', '↓1', 'Kalimantan Timur', '47.135', '44.483'],
                ['3', '↑7', 'Aceh', '38.157', '8.962'],
                ['4', '↓2', 'Kalimantan Barat', '31.876', '39.598'],
                ['5', '↑12', 'Papua Tengah', '26.978', '6.360'],
                ['6', '↑20', 'Sumatera Barat', '26.940', '2.606'],
                ['7', '↑10', 'Sumatera Utara', '20.512', '7.303'],
                ['8', '8', 'Kalimantan Utara', '19.716', '8.767'],
                ['9', '↓4', 'Riau', '17.812', '20.812'],
                ['10', '↑18', 'Papua Pegunungan', '16.468', '2.688'],
                ['11', '↑11', 'Sulawesi Tengah', '15.839', '7.019'],
                ['12', '↓6', 'Jambi', '15.334', '14.839'],
                ['13', '↑15', 'Bengkulu', '13.095', '4.300'],
                ['14', '↓5', 'Sumatera Selatan', '9.771', '20.184'],
                ['15', '↑17', 'Papua Barat Daya', '9.459', '2.966'],
                ['16', '↑21', 'Papua Barat', '9.108', '2.303'],
                ['17', '↓14', 'Sulawesi Tenggara', '9.104', '4.413'],
                ['18', '↑24', 'Papua', '8.421', '1.768'],
                ['19', '↓13', 'Papua Selatan', '7.248', '5.010'],
                ['20', '↑23', 'Sulawesi Selatan', '5.526', '1.928'],
                ['21', '↑26', 'Sulawesi Barat', '4.867', '1.170'],
                ['22', '↓19', 'Maluku Utara', '4.454', '2.648'],
                ['23', '↑22', 'Gorontalo', '3.849', '2.180'],
                ['24', '↑27', 'Maluku', '3.072', '889'],
                ['25', '↓16', 'Kalimantan Selatan', '2.656', '3.659'],
                ['26', '↑29', 'Nusa Tenggara Timur', '2.335', '497'],
                ['27', '↓25', 'Nusa Tenggara Barat', '1.813', '1.276'],
                ['28', '↑32', 'Lampung', '1.111', '145'],
                ['29', '↑30', 'Kepulauan Riau', '965', '387'],
                ['30', '↑35', 'Banten', '784', '55'],
                ['31', '↑33', 'Jawa Barat', '690', '87'],
                ['32', '↓31', 'Jawa Timur', '657', '209'],
                ['33', '↓28', 'Sulawesi Utara', '495', '650'],
                ['34', '↓9', 'Kepulauan Bangka Belitung', '454', '7.956'],
                ['35', '↑34', 'Jawa Tengah', '89', '59'],
                ['36', '36', 'Bali', '61', '7'],
                ['37', '37', 'Daerah Istimewa Yogyakarta', '0', '0.3'],
                ['Total', '', 'Seluruh provinsi', '433.751', '261.575']
              ]
            }
          ]
        },

        kabupaten: {
          kpiLabel: 'Deforestasi di 10 kabupaten teratas',
          kpiVal: '95.733',
          kpiUnit: 'hektare',
          notesSidebar: [
            'Top-10 kabupaten mencakup 22% deforestasi nasional.',
            'Didominasi Kalimantan dan Tanah Papua.',
            'Kutai Timur dan Kapuas menjadi hotspot utama.'
          ],
          notesBox: [''],
          bubble: { label: 'Kabupaten lainnya (373)', value: '338.018', unit: 'hektare' },
          markers: [
            { lat: 1.2, lng: 117.5, rank: 1, name: 'Berau', value: '19.163', dir: 'right' },
            { lat: 0.7, lng: 117.4, rank: 2, name: 'Kutai Timur', value: '12.781', dir: 'left' },
            { lat: -0.6, lng: 112.9, rank: 3, name: 'Kapuas', value: '11.850', dir: 'left' },
            { lat: 0.9, lng: 114.4, rank: 4, name: 'Kapuas Hulu', value: '9.393', dir: 'left' },
            { lat: -1.8, lng: 113.4, rank: 5, name: 'Katingan', value: '8.934', dir: 'left' },
            { lat: -0.8, lng: 131.3, rank: 6, name: 'Sorong', value: '7.168', dir: 'right' },
            { lat: -0.3, lng: 114.7, rank: 7, name: 'Murung Raya', value: '7.140', dir: 'bottom' },
            { lat: -8.4, lng: 140.4, rank: 8, name: 'Merauke', value: '6.557', dir: 'top' },
            { lat: -1.5, lng: 113.0, rank: 9, name: 'Gunung Mas', value: '6.539', dir: 'bottom' },
            { lat: 2.9, lng: 117.3, rank: 10, name: 'Bulungan', value: '6.208', dir: 'right' }
          ],
          tables: []
        },

        konservasi: {
          kpiLabel: 'Deforestasi di area kawasan konservasi',
          kpiVal: '25.077',
          kpiUnit: 'hektare',
          notesSidebar: [
            'Termasuk kawasan konservasi, KBA, dan habitat spesies dilindungi.',
            'Papua dan Sumatera menjadi lokasi dominan.',
            'Tekanan tertinggi terjadi di TN Kerinci Seblat dan Jayawijaya.'
          ],
          notesBox: [''],
          markers: [
            { lat: -2.4, lng: 101.5, rank: 1, name: 'TN Kerinci Seblat', value: '6.362', dir: 'left' },
            { lat: -4.0, lng: 138.8, rank: 2, name: 'SM Pegunungan Jayawijaya', value: '3.210', dir: 'right' },
            { lat: 3.8, lng: 97.3, rank: 3, name: 'TN Gunung Leuser', value: '1.379', dir: 'left' },
            { lat: 0.2, lng: 104.6, rank: 4, name: 'TB Lingga Isaq', value: '1.199', dir: 'left' },
            { lat: -3.5, lng: 137.2, rank: 5, name: 'CA Enarotali', value: '1.049', dir: 'right' },
            { lat: -2.7, lng: 138.7, rank: 6, name: 'SM Mamberamo Foja', value: '950', dir: 'right' },
            { lat: -3.6, lng: 138.1, rank: 7, name: 'TN Lorentz', value: '889', dir: 'right' },
            { lat: -1.0, lng: 132.8, rank: 8, name: 'CA Pegunungan Tamrau Selatan', value: '796', dir: 'right' },
            { lat: -1.2, lng: 100.8, rank: 9, name: 'CA Batang Pangean I', value: '779', dir: 'left' },
            { lat: 0.7, lng: 101.2, rank: 10, name: 'SM Bukit Rimbang Bukit Baling', value: '539', dir: 'left' }
          ]
        },

        megafauna: {
          kpiLabel: 'Total habitat terdampak',
          kpiVal: '156.463',
          kpiUnit: 'hektare',
          notesSidebar: [
            'Mencakup habitat harimau, badak, gajah, dan orangutan.',
            'Sebaran terbesar terdapat di Sumatera dan Kalimantan.',
            'Nilai tidak menghitung duplikasi area habitat yang beririsan.'
          ],
          notesBox: [''],
          species: [
            { lat: 3.4, lng: 94.2, icon: '🐅', image: '/assets/images/satwa/image.png', name: 'Panthera tigris sumatrae', value: '78.049 hektare', dir: 'left', geojsonUrl: '/geojson/panthera-tigris-sumatrae.json' },
            { lat: -0.38, lng: 96.0, icon: '🐘', image: '/assets/images/satwa/image-2.png', name: 'Elephas maximus sumatranus', value: '25.301', dir: 'left', geojsonUrl: '/geojson/elephas-maximus-sumatranus.json' },
            { lat: -6.2, lng: 101.7, icon: '🦏', image: '/assets/images/satwa/image-3.png', name: 'Dicerorhinus sumatrensis sumatrensis', value: '18.477', dir: 'left', geojsonUrl: '/geojson/dicerorhinus-sumatrensis-sumatrensis.json' },
            { lat: 5.7, lng: 98.2, icon: '🦧', image: '/assets/images/satwa/image-4.png', name: 'Pongo tapanuliensis', value: '505', dir: 'right', geojsonUrl: '/geojson/pongo-tapanuliensis.json' },
            { lat: 1.0, lng: 102.6, icon: '🦧', image: '/assets/images/satwa/image-5.png', name: 'Pongo abelii', value: '16.519', dir: 'right', geojsonUrl: '/geojson/pongo-abelii.json' },
            { lat: 3.5, lng: 111.5, icon: '🦧', image: '/assets/images/satwa/image-6.png', name: 'Pongo pygmaeus', value: '66.890', dir: 'left', geojsonUrl: '/geojson/pongo-pygmaeus.json' },
            { lat: 2.5, lng: 121.5, icon: '🦏', image: '/assets/images/satwa/image-7.png', name: 'Dicerorhinus sumatrensis harrissoni', value: '3.057', dir: 'right', geojsonUrl: '/geojson/dicerorhinus-sumatrensis-harrissoni.json' }
          ],
          tables: []
        },

        konsesi: {
          kpiLabel: 'Pilih kategori konsesi',
          kpiVal: '—',
          kpiUnit: 'hektare',
          notesSidebar: ['Pilih kategori konsesi di atas untuk melihat data.', 'Menampilkan 10 konsesi teratas per kategori.'],
          notesBox: [''],
          markers: [],
          tables: [],
          subCategories: {
            'kebun-kayu': {
              title: 'Konsesi Kebun Kayu', kpiLabel: 'Total 10 teratas (kebun kayu)', kpiVal: '11.265',
              othersLabel: '202 izin Lainnya', othersVal: '21.799', bullets: [''], geojsonFile: '/geojson/kebun-kayu.geojson',
              markers: [
                { lat: 2.126959285437297, lng: 117.55112979226557, rank: 1, name: 'PT TANJUNG REDEB HUTANI', value: 1408, dir: 'right' },
                { lat: 0.397174210774834, lng: 110.992844937424763, rank: 2, name: 'PT FINNANTARA INTIGA', value: 1341, dir: 'left' },
                { lat: 0.407421960214845, lng: 116.367172445672026, rank: 3, name: 'PT MAHAKARYA PERDANA GEMILANG UNIT II', value: 1324, dir: 'right' },
                { lat: 0.566679872006894, lng: 117.174814762389829, rank: 4, name: 'PT DIVA PERDANA PESONA', value: 1296, dir: 'right' },
                { lat: -1.335276267511383, lng: 114.138747007539251, rank: 5, name: 'PT BUMI HIJAU PRIMA', value: 1294, dir: 'left' },
                { lat: -2.009800604760271, lng: 111.153569955554644, rank: 6, name: 'PT GRACE PUTRI PERDANA', value: 1171, dir: 'left' },
                { lat: 1.853305859481002, lng: 117.594275093006445, rank: 7, name: 'PT HUTAN BERAU LESTARI', value: 1097, dir: 'right' },
                { lat: 0.026386043655114, lng: 115.929349893182021, rank: 8, name: 'PT SENDAWAR ADHI KARYA', value: 1019, dir: 'right' },
                { lat: 1.340801486700338, lng: 118.240850579581576, rank: 9, name: 'PT SWADAYA PERKASA', value: 662, dir: 'right' },
                { lat: 1.374270568895824, lng: 101.806156676794458, rank: 10, name: 'PT SEKATO PRATAMA MAKMUR', value: 652, dir: 'bottom' }
              ]
            },
            'logging': {
              title: 'Konsesi Logging', kpiLabel: 'Total 10 teratas (logging)', kpiVal: '20.749',
              othersLabel: '227 izin Lainnya', othersVal: '53.661', bullets: [''], geojsonFile: '/geojson/logging.geojson',
              markers: [
                { lat: 0.881264893236657, lng: 117.026904047300249, rank: 1, name: 'PT KIANI LESTARI', value: 3739, dir: 'right' },
                { lat: -1.252358059458737, lng: 114.487610383463576, rank: 2, name: 'PT DASA INTIGA', value: 3195, dir: 'left' },
                { lat: 2.098063545278295, lng: 101.015865352762475, rank: 3, name: 'PT DIAMOND RAYA TIMBER', value: 2741, dir: 'right' },
                { lat: -3.017296513002015, lng: 101.832872347710747, rank: 4, name: 'PT ANUGERAH PRATAMA INSPIRASI', value: 2211, dir: 'bottom' },
                { lat: -0.75146963045224, lng: 116.510730877588813, rank: 5, name: 'PT ITCI KARTIKA UTAMA (ITCIKU)', value: 1902, dir: 'right' },
                { lat: 2.028798962469609, lng: 117.080426147312622, rank: 6, name: 'PT INHUTANI I UNIT LABANAN', value: 1688, dir: 'right' },
                { lat: -3.502650172817841, lng: 135.621210438578998, rank: 7, name: 'PT JATI DHARMA INDAH PLYWOOD INDUSTRIES', value: 1415, dir: 'bottom' },
                { lat: 2.474287034103671, lng: 117.210276665613563, rank: 8, name: 'PT INHUTANI I UNIT SAMBARATA', value: 1330, dir: 'left' },
                { lat: -1.051472046229932, lng: 113.055533404223866, rank: 9, name: 'PT DWIMA JAYA UTAMA', value: 1267, dir: 'top' },
                { lat: 1.288242736097689, lng: 99.580298186802281, rank: 10, name: 'PT BARUMUN RAYA PADANG LANGKAT', value: 1260, dir: 'left' }
              ]
            },
            'sawit': {
              title: 'Konsesi Sawit', kpiLabel: 'Total 10 teratas (sawit)', kpiVal: '13.610',
              othersLabel: '709 izin Lainnya', othersVal: '24.300', bullets: [''], geojsonFile: '/geojson/sawit.geojson',
              markers: [
                { lat: -1.171071756797254, lng: 131.391544937632204, rank: 1, name: 'Inti Kebun Lestari', value: 2624, dir: 'top' },
                { lat: 0.675035799730648, lng: 121.473335486617259, rank: 2, name: 'Banyan Tumbuh Lestari', value: 2094, dir: 'right' },
                { lat: -1.283649245406992, lng: 131.24771276041497, rank: 3, name: 'Inti Kebun Sejahtera', value: 2053, dir: 'right' },
                { lat: -7.873776279100799, lng: 140.650276678006122, rank: 4, name: 'Merauke Sawit Jaya', value: 1808, dir: 'left' },
                { lat: -1.444431042873964, lng: 131.2297651958757, rank: 5, name: 'Papua Lestari Abadi', value: 1300, dir: 'right' },
                { lat: 0.876612002390529, lng: 112.828968572362726, rank: 6, name: 'Borneo International Anugerah', value: 877, dir: 'right' },
                { lat: -1.6730810929783, lng: 113.408354095172541, rank: 7, name: 'Agro Kalimantan Lestari', value: 784, dir: 'left' },
                { lat: 1.223818358664025, lng: 118.285216683843913, rank: 8, name: 'Anugrah Surya Mandiri', value: 713, dir: 'top' },
                { lat: 0.996544524718871, lng: 112.051890133518881, rank: 9, name: 'Khatulistiwa Agro Abadi', value: 682, dir: 'left' },
                { lat: -0.228874466961059, lng: 104.847611995376113, rank: 10, name: 'Citra Sugi Aditya', value: 676, dir: 'bottom' }
              ]
            },
            'tambang': {
              title: 'Konsesi Tambang', kpiLabel: 'Total 10 teratas (tambang)', kpiVal: '8.929',
              othersLabel: '1.131 izin Lainnya', othersVal: '32.233', bullets: [''], geojsonFile: '/geojson/tambang.geojson',
              markers: [
                { lat: 2.138922060693282, lng: 117.395321188956885, rank: 1, name: 'Berau Coal (Batubara)', value: 1473, dir: 'right' },
                { lat: -3.003818526025582, lng: 121.809448329238492, rank: 2, name: 'Sulawesi Cahaya Mineral (Nikel)', value: 1085, dir: 'right' },
                { lat: -0.090328260786384, lng: 114.919059555847099, rank: 3, name: 'Maruwai Coal (Batubara)', value: 920, dir: 'top' },
                { lat: 0.627934768307973, lng: 128.004841288293079, rank: 4, name: 'Weda Bay Nickel (Nikel)', value: 902, dir: 'right' },
                { lat: -2.634066859436454, lng: 121.488538466272828, rank: 5, name: 'Vale Indonesia TBK (Nikel)', value: 842, dir: 'left' },
                { lat: 1.370910557959839, lng: 99.149585821220384, rank: 6, name: 'Agincourt Resources (Emas)', value: 840, dir: 'left' },
                { lat: -0.207788395378338, lng: 115.026603507062106, rank: 7, name: 'Lahai Coal (Batubara)', value: 770, dir: 'left' },
                { lat: -1.541190947688207, lng: 112.517178689769239, rank: 8, name: 'Blok Waringin Agung (Emas)', value: 764, dir: 'right' },
                { lat: -1.039139704484105, lng: 114.625074268594773, rank: 9, name: 'Suprabari Mapanindo Mineral', value: 673, dir: 'left' },
                { lat: -2.843717003693491, lng: 121.980032209226394, rank: 10, name: 'Bintang Delapan Mineral (Nikel)', value: 659, dir: 'bottom' }
              ]
            }
          }
        }
      };

      function clearModeVisuals() {
        markerLayer.clearLayers();
        polygonLayer.clearLayers();
        map.closePopup();
        markerRegistry = [];
        activeMarker = null;
        activeRow = null;
        activeEntry = null;
        activePolygonSpecies = null;
        document.getElementById('table-wrap').innerHTML = '';
        document.getElementById('table-panel').classList.remove('open');
        document.getElementById('table-toggle').style.display = 'none';
        const sp = document.getElementById('satwa-badges');
        sp.innerHTML = '';
        sp.classList.remove('visible', 'has-active');
      }

      function setActiveMarker(marker) {
        if (activeMarker && activeMarker._icon) {
          activeMarker._icon.querySelector('.rank-dot, .species-dot')?.classList.remove('active');
        }
        activeMarker = marker;
        if (activeMarker && activeMarker._icon) {
          activeMarker._icon.querySelector('.rank-dot, .species-dot')?.classList.add('active');
        }
      }

      function clearActiveRow() {
        if (activeRow) activeRow.classList.remove('active-row');
        activeRow = null;
      }

      function registerMarker(entry) { markerRegistry.push(entry); }

      function findMarkerByLabel(label) {
        const q = (label || '').toLowerCase().replace(/[^a-z0-9]/g, '');
        if (!q) return null;
        return markerRegistry.find(item => {
          const n = (item.name || '').toLowerCase().replace(/[^a-z0-9]/g, '');
          return n.includes(q) || q.includes(n);
        }) || null;
      }

      function focusMarkerByLabel(label, rowEl = null) {
        const found = findMarkerByLabel(label);
        if (!found) return;
        if (rowEl) { clearActiveRow(); rowEl.classList.add('active-row'); activeRow = rowEl; }
        setActiveMarker(found.marker);
        const satwaBadges = document.getElementById('satwa-badges');
        const isSatwaActive = currentMode === 'megafauna' && satwaBadges && satwaBadges.classList.contains('has-active');
        if (!isSatwaActive) { map.flyTo(found.marker.getLatLng(), Math.max(map.getZoom(), 6), { duration: 0.6 }); }
        setTimeout(() => showCallout(found), 260);
      }

      function buildPopupHtml(entry) {
        const item = entry.item;
        const unitMap = { provinsi: 'hektare', kabupaten: 'hektare', konservasi: 'hektare', megafauna: 'hektare habitat terdampak' };
        const tagMap = { provinsi: 'provinsi', kabupaten: 'kabupaten', konservasi: 'kawasan konservasi', megafauna: 'megafauna' };
        const unit = unitMap[entry.mode] || 'hektare';
        const rank = entry.kind !== 'species' ? `<div class="popup-rank"></div>` : `<div class="popup-rank">Megafauna ikonik</div>`;
        return `<div class="popup-inner">${rank}<div class="popup-name">${item.name}</div><div class="popup-val">${item.value}</div><div class="popup-unit">${unit}</div></div>`;
      }

      function showCallout(entry) {
        if (!entry) return;
        activeEntry = entry;
        setActiveMarker(entry.marker);
        entry.marker.setPopupContent(buildPopupHtml(entry));
        entry.marker.openPopup();
      }

      function createRankMarker(item) {
        const icon = L.divIcon({
          className: '',
          html: `<div class="rank-dot">${item.rank}</div>`,
          iconSize: [28, 28],
          iconAnchor: [14, 14]
        });
        const marker = L.marker([item.lat, item.lng], { icon }).addTo(markerLayer);
        const entry = { name: item.name, marker, value: item.value, mode: currentMode, item, kind: 'rank' };
        marker.bindPopup('', { closeButton: true, maxWidth: 280, minWidth: 190 });
        marker.on('mouseover', () => setActiveMarker(marker));
        marker.on('mouseout', () => { if (!activeEntry || activeEntry.marker !== marker) setActiveMarker(null); });
        marker.on('click', () => { showCallout(entry); clearActiveRow(); });
        registerMarker(entry);
      }

      function createSpeciesMarker(item) {
        const icon = L.divIcon({ className: '', html: '<div style="display:none;"></div>', iconSize: [0, 0], iconAnchor: [0, 0] });
        const marker = L.marker([item.lat, item.lng], { icon }).addTo(markerLayer);
        const entry = { name: item.name, marker, value: item.value, mode: currentMode, item, kind: 'species' };
        marker.on('click', () => { showCallout(entry); clearActiveRow(); });
        registerMarker(entry);
        createSatwaBadge(item, entry);
      }

      function createSatwaBadge(item, entry) {
        const badgesContainer = document.getElementById('satwa-badges');
        const badge = document.createElement('div');
        badge.className = 'satwa-badge';
        badge.dataset.species = item.name;
        const shortName = item.name.split(' ').slice(-2).join(' ');
        badge.innerHTML = `
                                        <div class="satwa-badge-circle"><img src="${item.image || ''}" alt="${item.name}"></div>
                                        <div class="satwa-badge-name" title="${item.name}">${shortName}</div>
                                        <div class="satwa-badge-detail">
                                          <span class="si-name">${item.name}</span>
                                          <span class="si-val">${item.value}</span>
                                          <span class="si-unit">habitat terdampak</span>
                                        </div>
                                      `;
        badge.addEventListener('click', async (e) => {
          e.stopPropagation();
          const isActive = badge.classList.contains('active');
          document.querySelectorAll('.satwa-badge.active').forEach(b => b.classList.remove('active'));
          badgesContainer.classList.remove('has-active');
          polygonLayer.clearLayers();
          activePolygonSpecies = null;
          if (!isActive) {
            badge.classList.add('active');
            badgesContainer.classList.add('has-active');
            activePolygonSpecies = item.name;
            showCallout(entry);
            if (!item.geojson && item.geojsonUrl) {
              badge.classList.add('loading');
              try {
                const res = await fetch(item.geojsonUrl);
                if (!res.ok) throw new Error('HTTP ' + res.status);
                item.geojson = await res.json();
              } catch (err) {
                console.error('Failed to load GeoJSON for', item.name, err);
              } finally {
                badge.classList.remove('loading');
              }
            }
            if (item.geojson) {
              L.geoJSON(item.geojson, { style: { color: '#bc4a3c', weight: 1, opacity: 0.85, fillColor: '#bc4a3c', fillOpacity: 1 } }).addTo(polygonLayer);
            }
          } else {
            map.closePopup();
          }
        });
        badgesContainer.appendChild(badge);
        return { badge, entry };
      }

      function positionSatwaBadges(species) {
        if (!species || species.length === 0) return;
        document.getElementById('satwa-badges').classList.add('visible');
      }

      function renderTableCard(tbl) {
        const card = document.createElement('div');
        card.className = 'table-card';
        const title = document.createElement('div');
        title.className = 'table-title';
        title.textContent = tbl.title;
        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const hr = document.createElement('tr');
        tbl.headers.forEach(h => { const th = document.createElement('th'); th.textContent = h; hr.appendChild(th); });
        thead.appendChild(hr);
        const is5col = tbl.headers.length >= 5;
        const tbody = document.createElement('tbody');
        tbl.rows.forEach(row => {
          const tr = document.createElement('tr');
          const isTotalRow = String(row[0]).toLowerCase() === 'total';
          if (isTotalRow) tr.classList.add('total-row');
          row.forEach((cell, ci) => {
            const td = document.createElement('td');
            if (is5col && ci === 1 && !isTotalRow) {
              const s = String(cell);
              if (s.startsWith('↑')) td.className = 'td-up';
              else if (s.startsWith('↓')) td.className = 'td-down';
              else td.className = 'td-same';
            }
            td.textContent = cell;
            tr.appendChild(td);
          });
          if (!isTotalRow) {
            const maybeLabel = is5col ? (row[2] || '') : (row[1] || row[0] || '');
            tr.addEventListener('click', () => focusMarkerByLabel(maybeLabel, tr));
          }
          tbody.appendChild(tr);
        });
        table.appendChild(thead);
        table.appendChild(tbody);
        card.appendChild(title);
        card.appendChild(table);
        return card;
      }

      function renderMode(modeKey) {
        const mode = MODES[modeKey];
        currentMode = modeKey;
        clearModeVisuals();
        document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.toggle('active', btn.dataset.mode === modeKey));
        document.getElementById('map-title').textContent = mode.title;
        document.getElementById('kpi-label').textContent = mode.kpiLabel;
        document.getElementById('kpi-val').textContent = mode.kpiVal;
        document.getElementById('kpi-unit').textContent = mode.kpiUnit;
        document.getElementById('sidebar-notes').innerHTML = mode.notesSidebar.map(n => `<li>${n}</li>`).join('');
        document.getElementById('notes-list').innerHTML = mode.notesBox.map(n => `<li>${n}</li>`).join('');
        const bubble = document.getElementById('others-bubble');
        if (mode.bubble) {
          bubble.style.display = 'flex';
          document.getElementById('bubble-label').textContent = mode.bubble.label;
          document.getElementById('bubble-val').textContent = mode.bubble.value;
          document.getElementById('bubble-unit').textContent = mode.bubble.unit;
        } else { bubble.style.display = 'none'; }
        if (mode.markers) mode.markers.forEach(createRankMarker);
        if (mode.species) mode.species.forEach(createSpeciesMarker);
        const tableWrap = document.getElementById('table-wrap');
        const tableToggle = document.getElementById('table-toggle');
        if (mode.tables && mode.tables.length) {
          mode.tables.forEach(t => tableWrap.appendChild(renderTableCard(t)));
          tableToggle.style.display = 'block';
        } else { tableToggle.style.display = 'none'; }
        const submenu = document.getElementById('konsesi-submenu');
        if (modeKey === 'konsesi') {
          submenu.classList.remove('hidden');
          submenu.classList.add('show');
          const activecat = submenu.querySelector('.cat-btn.active');
          if (!activecat) { const firstCat = submenu.querySelector('.cat-btn'); if (firstCat) loadKonsesiCategory(firstCat.dataset.cat); }
        } else {
          submenu.classList.add('hidden');
          submenu.classList.remove('show');
          document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
        }
        requestAnimationFrame(() => map.invalidateSize());
        if (modeKey === 'megafauna') positionSatwaBadges(mode.species);
      }

      function loadKonsesiCategory(catKey) {
        const cat = MODES.konsesi.subCategories[catKey];
        if (!cat) return;
        document.querySelectorAll('.cat-btn').forEach(b => b.classList.toggle('active', b.dataset.cat === catKey));
        markerLayer.clearLayers();
        markerRegistry = [];
        activeMarker = null;
        map.closePopup();
        document.getElementById('kpi-label').textContent = cat.kpiLabel;
        document.getElementById('kpi-val').textContent = cat.kpiVal;
        document.getElementById('kpi-unit').textContent = 'hektare';
        document.getElementById('sidebar-notes').innerHTML = cat.bullets.map(b => `<li>${b}</li>`).join('');
        //   document.getElementById('map-title').textContent = 'Deforestasi ' + cat.title;
        const bubble = document.getElementById('others-bubble');
        bubble.style.display = 'flex';
        document.getElementById('bubble-label').innerHTML = cat.othersLabel;
        document.getElementById('bubble-val').textContent = cat.othersVal;
        document.getElementById('bubble-unit').textContent = 'hektare';
        document.getElementById('notes-list').innerHTML = cat.bullets.map(b => `<li>${b}</li>`).join('');
        function placeMarkers(points) {
          points.forEach(p => createRankMarker({ lat: p.lat, lng: p.lng, rank: p.rank, name: p.name, value: String(p.value), dir: p.dir || 'right' }));
        }
        if (cat.geojsonFile) {
          fetch(cat.geojsonFile)
            .then(r => { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
            .then(geojson => {
              const pts = geojson.features.map(f => ({ lat: f.geometry.coordinates[1], lng: f.geometry.coordinates[0], rank: f.properties.rank, name: f.properties.namobj, value: f.properties.value, dir: f.properties.dir || 'right' }));
              placeMarkers(pts);
            })
            .catch(() => { if (cat.markers && cat.markers.length) placeMarkers(cat.markers); });
        } else if (cat.markers && cat.markers.length) { placeMarkers(cat.markers); }
      }

      document.querySelectorAll('.mode-btn').forEach(btn => btn.addEventListener('click', () => renderMode(btn.dataset.mode)));
      document.querySelectorAll('.cat-btn').forEach(btn => btn.addEventListener('click', () => loadKonsesiCategory(btn.dataset.cat)));

      window.addEventListener('keydown', (e) => {
        const mapping = { '1': 'provinsi', '2': 'kabupaten', '3': 'konservasi', '4': 'megafauna', '5': 'konsesi' };
        const mode = mapping[e.key];
        if (!mode) return;
        renderMode(mode);
      });

      document.getElementById('table-toggle').addEventListener('click', () => {
        const panel = document.getElementById('table-panel');
        panel.classList.toggle('open');
        setTimeout(() => map.invalidateSize(), 300);
      });

      document.getElementById('table-close').addEventListener('click', () => {
        const panel = document.getElementById('table-panel');
        panel.classList.remove('open');
        setTimeout(() => map.invalidateSize(), 300);
      });

      // Mobile: kpi-float collapsible bottom sheet
      if (window.innerWidth < 640) {
        const kpiEl = document.getElementById('kpi-float');
        const togBtn = document.getElementById('kpi-toggle');
        const chevron = document.getElementById('kpi-chevron');
        if (kpiEl && togBtn) {
          togBtn.style.display = 'flex';
          let fullH = 0;
          function kpiMeasure() {
            kpiEl.style.maxHeight = 'none';
            fullH = kpiEl.scrollHeight;
            kpiEl.style.maxHeight = Math.round(fullH * 0.4) + 'px';
          }
          requestAnimationFrame(() => setTimeout(kpiMeasure, 120));
          window.kpiFloatToggle = function () {
            if (!fullH) { kpiEl.style.maxHeight = 'none'; fullH = kpiEl.scrollHeight; }
            if (kpiEl.classList.contains('kpi-expanded')) {
              kpiEl.style.maxHeight = Math.round(fullH * 0.4) + 'px';
              kpiEl.classList.remove('kpi-expanded');
              if (chevron) chevron.style.transform = 'rotate(0deg)';
            } else {
              kpiEl.style.maxHeight = fullH + 'px';
              kpiEl.classList.add('kpi-expanded');
              if (chevron) chevron.style.transform = 'rotate(180deg)';
            }
          };
        }
      }

      renderMode('provinsi');
    })();
  </script>
@endpush