@extends('layouts.stadi2025')

@section('meta')
    @include('partials.insightMeta')
@endsection

@section('content')
    <div id="site-loader" role="status" aria-live="polite" aria-label="Memuat halaman SIMONTINI">
        <div class="loader-mark">
            <img src="{{ asset('assets/images/logo1.png') }}" alt="" class="">
            <!-- <div class="loader-title">SIMONTINI</div> -->
            <div class="loader-sub">Status of deforestation in Indonesia 2025</div>
            <div class="loader-bar"><span></span></div>
        </div>
    </div>


    <!-- STICKY NAV -->
    <nav id="sitenav"
        class="fixed top-0 left-0 right-0 z-[100] flex items-center justify-between h-[52px] px-[5vw]  backdrop-blur-md border-b border-[#e2d8cc]">
        <div
            class="nav-brand flex items-center gap-1.5 uppercase tracking-[0.18em] text-[#8b2a1a] text-[.65rem] font-semibold">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo1.png') }}" alt=""
                    class="h-8"></a>
        </div>
        <div class="nav-actions">
            <ul class="nav-links flex list-none">
                <li><a href="#pendahuluan">Introduction</a></li>
                <li><a href="#metodologi">Methodology</a></li>
                <li><a href="#deforestasi">Deforestation 2025</a></li>
                {{-- <li><a href="#konsesi">Concessions</a></li> --}}
                <li><a href="#diskusi">Discussion</a></li>
                <li><a href="#rekomendasi">Recommendations</a></li>
            </ul>
            <div class="global-lang" aria-label="language switcher">
                <a href="{{ url('/id/status-deforestasi-indonesia-2025') }}" id="lang-id" class="g-lang-btn">ID</a>
                <a href="{{ url('/en/status-of-deforestation-in-indonesia-2025') }}" id="lang-en"
                    class="g-lang-btn active">EN</a>
            </div>
        </div>
    </nav>
    <section id="hero">
        <h1>Status of Deforestation in Indonesia 2025</h1>
        <div class="hero-meta">
            <div class="hero-stat">
                <span class="hs-val">433.751</span>
                <span class="hs-unit">Hectares</span>
            </div>
            <div class="hero-divider"></div>
            <!-- <div class="hero-stat">
                                                                                                                                                                                                                                                                                         <span class="hs-val">+66%</span>
                                                                                                                                                                                                                                                                                         <span class="hs-unit">Peningkatan dari 2024</span>
                                                                                                                                                                                                                                                                                         </div> -->
            <div class="hero-divider"></div>
            <div class="hero-desc">
                Deforestation surges - the time is right for Indonesia to protect all of its remaining natural forest.
            </div>
        </div>
        <div class="scroll-hint">
            <div class="scroll-dot"></div>
        </div>
    </section>

    <!-- PENDAHULUAN -->
    <span class="s-anchor" id="pendahuluan"></span>

    <section class="page-section px-[5vw]">
        <div class="section-label">I. Introduction</div>
        <p class="lead">
            In November 2021, during the 26th United Nations Climate Change Conference (COP26) in Glasgow, Scotland, leaders
            of 144 nations, including Indonesia, signed the Glasgow Leaders’ Declaration on Forest and Land Use, or the <a
                href="https://webarchive.nationalarchives.gov.uk/ukgwa/20230418175226/https:/ukcop26.org/glasgow-leaders-declaration-on-forests-and-land-use/"
                target="_blank" rel="noopener noreferrer" style="color: #bc4a3c;">Glasgow Declaration</a>. The declaration
            constitutes an agreement to work collectively to halt and reverse forest loss and land degradation.
        </p>
        <p class="body-text">
            In Indonesia, efforts to halt deforestation or the loss of natural forests did not begin with the declaration. A
            decade earlier, President Susilo Bambang Yudhoyono signed Presidential Instruction No. 10/2011, commonly
            referred to as the Moratorium Instruction (<a
                href="https://peraturan.bpk.go.id/Download/68485/Inpres_no_10_2011.pdf" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">Inpres Moratorium</a>), prohibiting the issuance of
            conversion permits in primary natural forests and protected peatlands. President Joko Widodo continued this
            policy by issuing Presidential Instruction No. 8/2018, or the Oil Palm Moratorium (<a
                href="https://peraturan.bpk.go.id/Download/261461/Inpres%20Nomor%208%20Tahun%202018.PDF" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">Inpres Moratorium Sawit</a>), which was intended to
            optimize existing oil palm plantations and halt deforestation driven by palm oil expansion.
        </p>
        <p class="body-text">
            Indonesia also ratified the Paris Agreement, which aims to keep global temperature increases to below 2°C while
            pursuing efforts to limit the rise to 1.5°C above pre-industrial levels. Within this framework, the Government
            of Indonesia issued <a
                href="https://peraturan.bpk.go.id/Download/180699/Perpres%20Nomor%2098%20Tahun%202021.pdf" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">Presidential Regulation No. 98/2021</a> on the
            Implementation of Carbon Pricing and elaborated it in greater detail through Minister of Environment and
            Forestry Decree No. 168/2022 on Indonesia’s <a
                href="https://eos.co.id/main/wp-content/uploads/2022/03/1647210373656.pdf" target="_blank"
                rel="noopener noreferrer" style="color: #bc4a3c;">FOLU Net Sink 2030</a> for Climate Change Control.
        </p>
        <p class="body-text">
            These policies led to falls in deforestation rates in Indonesia for five consecutive years starting in 2017.
            However, in 2022, Indonesian deforestation rates began to rise again, as shown in the graph below. Deforestation
            in Indonesia subsequently surged in 2025.
        </p>
        <!-- embedded chart using TailwindUI layout -->
        <div class="viz-block viz-block--full mt-12 mb-2" id="chart-app-wrap">
            <div class=" ">
                <div id="chart-app" class="w-full py-4 md:py-8" style="background:white;">
                    <div id="chart-inner" class="px-6 w-full max-w-[1400px] mx-auto">
                        <div id="chart-viz" class="w-full min-w-0">
                            <div class="block w-full sm:max-w-6xl mx-auto mb-4">
                                <h2 class=" text-[#1a1a1a] text-lg md:text-xl font-bold tracking-tight mb-1">Deforestation
                                    in Indonesia,
                                    2001–2025</h2>
                                {{-- <p class="chart-sub text-sm" style="color:#8b7355;">Annual deforestation rate ·
                                    hectares</p> --}}
                            </div>
                            <div id="chart-body" class="relative flex" style="height:420px;">
                                <div id="y-axis"
                                    class="flex flex-col-reverse justify-between pb-[48px] w-[42px] md:w-[56px] shrink-0">
                                </div>
                                <div id="bars-wrap" class="relative flex-1 flex flex-col">
                                    <div id="grid-lines" class="relative flex flex-col-reverse justify-between flex-1">
                                    </div>
                                    <div id="bars-svg-wrap"
                                        class="absolute inset-x-0 top-0 bottom-[48px] grid items-end gap-[2px] px-0.5">
                                    </div>
                                    <div id="x-axis"
                                        class="relative grid gap-[2px] px-[2px] mt-2 h-[48px] items-start overflow-hidden"
                                        style="background:white;z-index:2;">

                                    </div>
                                    {{-- <small style="font-size: 12px !important;" class="text-black font-bold text-center -mt-6 z-20">
                                        <i>Deforestation in Indonesia, 2001-2025</i>
                                    </small> --}}
                                </div>
                            </div>
                            <div class="md:hidden mt-3">
                                <div id="pres-strip" class="flex flex-col gap-[2px]"></div>
                            </div>
                            <!-- Mobile-only era totals -->
                            {{-- <div id="mobile-era-totals" class="md:hidden grid grid-cols-2 gap-[2px] mt-3"></div> --}}
                            {{-- <div class="text-[0.55rem] text-gray-500 mt-4 px-1 text-right">Data: University of Maryland
                                Lossyear ·
                                Auriga STADI · simontini.id</div> --}}
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
            <div class="section-label">II. Methodology</div>

            <p class="body-text">
                <strong>Stages and Data Processing:</strong> The 2025 deforestation map was produced using deep learning
                modeling on Sentinel satellite imagery. The stages were as follows.
            </p>

            <div class="method-steps">
                <div class="method-step">
                    <div class="ms-num">1.</div>
                    <div class="body-text">
                        <p>
                            <strong>Deforestation modelling.</strong> Knowledge accumulated to date – from field monitoring
                            and deforestation data for 2023 and 2024 – was modelled with U-Net deep learning. This model was
                            then trained on 10-meter resolution Sentinel satellite imagery.
                        </p>
                    </div>
                </div>
                <div class="method-step">
                    <div class="ms-num">2.</div>
                    <div class="body-text">
                        <!-- <h4>Inspeksi visual</h4> -->
                        <p><strong>Defining scoping areas</strong> (<em>scoping area</em>). Monthly deforestation alerts
                            produced by the University of Maryland (usually referred to as GLAD alerts) were compiled. For
                            efficiency, only high-confidence alerts were collected. These alerts were then “bound” or
                            aggregated in bounding boxes with search radii of 10,240 meters. These bounding boxes then
                            became the scoping areas.
                        </p>
                    </div>
                </div>
                <div class="method-step">
                    <div class="ms-num">3.</div>
                    <div class="body-text">
                        <!-- <h4>Pemantauan lapangan</h4> -->
                        <p><strong>Deforestation Model</strong> the developed deforestation model was then run on 10-meter
                            resolution Sentinel-2 satellite imagery in the defined scoping areas.
                        </p>
                    </div>
                </div>
                <div class="method-step">
                    <div class="ms-num">4.</div>
                    <div class="body-text">
                        <!-- <h4>Pemantauan lapangan</h4> -->
                        <p><strong> Areas where deforestation</strong> was identified (indicative deforestation) were overlaid with forest
                            cover maps. Four forest cover references were used: (1) MapBiomas Indonesia; (2) land cover maps
                            produced by the Ministry of Forestry; (3) tropical-moist forest (TMF) data produced by the
                            European Commission’s Joint Research Centre; and (4) the Forest Persistence dataset produced by
                            Google.
                        </p>
                    </div>
                </div>
                <div class="method-step">
                    <div class="ms-num">5.</div>
                    <div class="body-text">
                        <!-- <h4>Pemantauan lapangan</h4> -->
                        <p> <strong>Verification processes:</strong> Indicative deforestation outside the four forest cover
                            references (forest-reference area) were inspected visually. Due to the large numbers of
                            polygons and limited time available, polygons smaller than one hectare could not be inspected
                            and were consequently excluded from the deforestation area. For indicative deforestation inside
                            forest-reference area, visual inspections and historical screening (temporal filtering) were
                            conducted on areas larger than 10 hectares, as well as on all areas under 10 hectares located
                            inside concessions and conservation areas. Areas identified as false positives or not having
                            deforestation were removed from the dataset, whereas areas that were not inspected (below 10
                            hectares) were included as deforestation areas.
                        </p><br>
                        <p>
                            Verifications were also carried out through field visits and on-the-ground documentation. In
                            total, Auriga Nusantara conducted field visits covering 49,321 hectares of deforestation sites –
                            equivalent to 11% of total deforestation in 2025 – across 38 villages in 28 regencies spanning
                            16 provinces in Sumatra, Kalimantan, Sulawesi, Nusa Tenggara, the Maluku Archipelago, and Papua.
                        </p>
                    </div>
                </div>
                <div class="method-step">
                    <div class="ms-num">6.</div>
                    <div class="body-text">
                        <!-- <h4>Pemantauan lapangan</h4> -->
                        <p><strong>Filtering:</strong> Focusing on deforestation caused by human activity (anthropogenic deforestation),
                            filtering was conducted to exclude deforestation areas resulting from landslides or river
                            shifts. For example, 11,693 hectares of forest cover were lost due to landslides in Aceh, North
                            Sumatra, and West Sumatra in the hydrometeorological disaster at the end of 2025. Loss of forest
                            cover due to river shifts was also relatively prevalent in conservation areas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- step 1 --}}
    <div class="viz-block viz-block--full alur" style="margin-top: -60px !important;">
        <div class="block w-full sm:max-w-6xl mx-auto">
            <h2 class=" text-[#1a1a1a] text-lg md:text-xl font-bold tracking-tight mb-1 px-2">Stages and processing of
                deforestation data 2025</h2>
            {{-- <p class="chart-sub text-sm" style="color:#8b7355;">Annual deforestation rate ·
                hectares</p> --}}
        </div>
        <img src="{{ asset('assets/Tahap_ok_Eng.png') }}" alt="Simontini - 2025 Methodology"
            class="sm:max-w-6xl w-full mx-auto h-auto object-contain sm:block hidden">
        <img src="{{ asset('assets/Tahap-Eng.png') }}" alt="Simontini - 2025 Methodology"
            class="sm:max-w-6xl w-full mx-auto h-auto object-contain sm:hidden block">

        {{-- <small
            class="block w-full sm:max-w-6xl mx-auto text-center mt-2 font-bold"
            style="font-size: 12px !important;">
            <i>Stages and processing of deforestation data 2025</i>
        </small> --}}

        <section class="page-section px-[5vw] pt-8 pb-6">
            <div class="body-text">
                <p>
                    <strong>Accuracy Assessment:</strong>. To determine the level of precision of the 2025 deforestation data,
                    an accuracy assessment was conducted by visually inspecting deforestation polygons using PlanetScope
                    imagery with a spatial resolution of 3.7 meters. The polygons selected for inspection were chosen
                    randomly using a stratified random sampling method. Deforestation polygons were grouped by area, namely:
                    <0.5 ha, 0.5–1 ha, 1–5 ha, 5–10 ha, 10–50 ha, and>50 ha. The number of samples was determined using the
                        Slovin formula with a 5% margin of error.
                </p><br>
                <p>
                    Results of this accuracy assessment showed the 2025 deforestation data having an accuracy level of 89%, as
                    presented in the table below.
                </p><br>
                {{-- <p>
                    Hasil pengujian akurasi data deforestasi 2025 ini sebesar 89%, sebagaimana terlihat dalam tabel berikut.
                </p> --}}
            </div>

            <div class="viz-block viz-block--full mt-12 mb-2">

                <div class="max-w-3xl mx-auto mt-4">

                    <div
                        class=" sm:mx-auto overflow-x-auto overflow-y-hidden  sm:rounded-none bg-white shadow-[0_4px_28px_rgba(26,26,26,.08)] md:overflow-x-visible">
                        <div class="border-b border-[#ddd5c8] px-4 py-4 sm:px-6">
                            <div class="text-[12px] font-semibold tracking-[-0.01em] text-[#1a1a1a] sm:text-[13px]">Accuracy assessment result of the 2025 deforestation data</div>
                        </div>

                        <table
                            class="akurasi-table w-full min-w-[480px] table-fixed border-collapse text-[10px] text-[#1a1a1a] sm:text-[11px] md:min-w-full md:text-[12px]">
                            <thead>
                                <tr>
                                    <th colspan="3"
                                        class="border-r border-white/15 text-center bg-[#8b2a1a] px-2 py-3 text-left font-semibold uppercase tracking-[0.08em] text-white sm:px-4">
                                        Deforestation Area</th>
                                    <th colspan="3"
                                        class="bg-[#8b2a1a] px-2 py-3 text-center font-semibold uppercase tracking-[0.08em] text-white sm:px-4">
                                        Accuracy Test</th>
                                </tr>
                                <tr>
                                    <th
                                        class="w-[16%] bg-[#a33520] px-2 py-2 text-left font-semibold text-white/90 sm:px-4">
                                        Strata (ha)
                                    </th>
                                    <th
                                        class="w-[17%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">
                                        Area (ha)</th>
                                    <th
                                        class="w-[14%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">
                                        Polygons</th>
                                    <th
                                        class="w-[18%]  bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">
                                        Sample
                                        Polygons</th>
                                    <th
                                        class="w-[10%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">
                                        TRUE</th>
                                    <th
                                        class="w-[25%] bg-[#a33520] px-2 py-2 text-right font-semibold text-white/90 sm:px-4">
                                        Accuracy</th>
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
                            Swipe the table to the side to view all columns.
                        </div>
                        {{-- <div class="tight text-[10px] px-2 mb-2 w-full">
                            Interactive table of the results of the 2025 deforestation data accuracy test, broken down by
                            polygon area.
                        </div> --}}
                    </div>
                </div>

            </div>
        </section>




        <!-- DEFORESTASI 2025 -->
        <span class="s-anchor" id="deforestasi"></span>
        <section class="page-section px-[5vw] py-8">
            <div class="section-label">III. Deforestation in 2025</div>

            <p class="body-text">
                With the methodology outlined above, <strong>deforestation in Indonesia by 2025 reached 433,751
                    hectares</strong>, an increase of 66% compared to the <a
                    href="https://simontini.id/id/status-deforestasi-indonesia-2024"
                    class="text-[#bc4a3c] hover:underline" target="_blank" rel="noopener noreferrer">261,575 hectares</a>
                recorded for the previous year. The
                largest area of deforestation once again occurred in Kalimantan, followed by Sumatra. Papua, which ranked
                fourth in 2024, rose to third place in 2025, overtaking Sulawesi.
            </p>
            <p class="body-text">
                The following table displays the deforestation data per major island in Indonesia for the years 2023-2025.
            </p><br><br>



            <div id="peta-embed" class="mx-auto">
                <div class="block sm:max-w-6xl mx-auto mb-4 text-left">
              <h2 class=" text-[#1a1a1a] text-lg md:text-xl font-bold tracking-tight mb-1">Deforestation per major island in Indonesia</h2>
              {{-- <p class="chart-sub text-sm" style="color:#8b7355;">Annual deforestation rate ·
                  hectares</p> --}}
          </div>
                <!-- MAP SECTION -->
                <div class="relative bg-black overflow-hidden" style="height:500px;">


                    <!-- Map -->
                    <div id="peta-bg-map" class="absolute inset-0 z-10" style="background:#0a0a0a;"></div>

                    <!-- Year ghost -->
                    {{-- <div id="peta-year-ghost"
                        class="absolute bottom-[15px] sm:bottom-[90px] right-2 sm:right-10 z-10 pointer-events-none font-poppins font-black text-[#f5f0e8] opacity-10 leading-none tracking-tighter"
                        style="font-size:clamp(4rem,10vw,10rem)">2025</div> --}}

                    <!-- Charts layer -->
                    <div class="absolute inset-0 z-20 pointer-events-none">

                        <!-- Charts wrap: desktop = absolute inset-0 passthrough; mobile = single grid box -->
                        <div id="peta-charts-wrap" class="absolute inset-0 pointer-events-none">

                            <!-- Sumatra chart -->
                            <div class="peta-island-chart hidden absolute pointer-events-auto origin-top-left scale-75 sm:scale-100"
                                id="peta-chart-sumatra"
                                style="left:22%;top:28%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                                <div
                                    class="bg-[rgba(245,240,232,.96)] sm:bg-[rgba(16,10,1,0.25)] sm:backdrop-blur-xl border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                                    <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">
                                        Sumatera</div>
                                    <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">thousand hectares
                                    </div>
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
                                id="peta-chart-kalimantan"
                                style="left:35%;top:3%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                                <div
                                    class="bg-[rgba(245,240,232,.96)] sm:bg-[rgba(16,10,1,0.25)] sm:backdrop-blur-xl border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                                    <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">
                                        Kalimantan</div>
                                    <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">thousand hectares
                                    </div>
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
                                id="peta-chart-sulawesi"
                                style="left:52%;top:3%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                                <div
                                    class="bg-[rgba(245,240,232,.96)] sm:bg-[rgba(16,10,1,0.25)] sm:backdrop-blur-xl border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                                    <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">
                                        Sulawesi</div>
                                    <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">thousand hectares
                                    </div>
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
                                id="peta-chart-papua"
                                style="left:65%;top:28%;filter:drop-shadow(0 6px 20px rgba(26,26,26,.2))">
                                <div
                                    class="bg-[rgba(245,240,232,.96)] sm:bg-[rgba(16,10,1,0.25)] sm:backdrop-blur-xl border border-[rgba(212,196,160,.8)] border-t-[3px] border-t-[#8b2a1a] p-[14px_16px] min-w-[210px]">
                                    <div class="font-poppins text-[1.1rem] font-bold text-[#1a1a1a] mb-0.5 leading-[1.05]">
                                        Papua</div>
                                    <div class="font-poppins text-[.52rem] font-bold text-[#1a1a1a] mb-2.5">thousand hectares
                                    </div>
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
                        class="absolute bottom-[30px] left-0 right-0 sm:left-1/2 sm:right-auto sm:-translate-x-1/2 flex gap-1 sm:gap-3 z-30 pointer-events-none items-center justify-center px-1 sm:px-0">
                        <div class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(16,10,1,0.25)] sm:text-[rgba(16,10,1,0.25)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
                            id="peta-b0" onclick="petaSelectYear(0)">
                            <div class="b-yr text-[.6rem] font-semibold">2021</div>
                            <div class="b-val font-bold leading-[1.1]">229.982</div>
                            <div class="b-u text-[.58rem] opacity-85">ha</div>
                        </div>
                        <div class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(16,10,1,0.25)] sm:text-[rgba(16,10,1,0.25)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
                            id="peta-b1" onclick="petaSelectYear(1)">
                            <div class="b-yr text-[.6rem] font-semibold">2022</div>
                            <div class="b-val font-bold leading-[1.1]">230.760</div>
                            <div class="b-u text-[.58rem] opacity-85">ha</div>
                        </div>
                        <div class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(16,10,1,0.25)] sm:text-[rgba(16,10,1,0.25)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
                            id="peta-b2" onclick="petaSelectYear(2)">
                            <div class="b-yr text-[.6rem] font-semibold">2023</div>
                            <div class="b-val font-bold leading-[1.1]">257.385</div>
                            <div class="b-u text-[.58rem] opacity-85">ha</div>
                        </div>
                        <div class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(16,10,1,0.25)] sm:text-[rgba(16,10,1,0.25)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
                            id="peta-b3" onclick="petaSelectYear(3)">
                            <div class="b-yr text-[.6rem] font-semibold">2024</div>
                            <div class="b-val font-bold leading-[1.1]">261.574</div>
                            <div class="b-u text-[.58rem] opacity-85">ha</div>
                        </div>
                        <div class="peta-bub flex flex-col items-center justify-center rounded-full border-2 border-[rgba(16,10,1,0.25)] sm:text-[rgba(16,10,1,0.25)] transition-all duration-300 shrink-0 pointer-events-auto cursor-pointer"
                            id="peta-b4" onclick="petaSelectYear(4)">
                            <div class="b-yr font-semibold">2025</div>
                            <div class="b-val font-bold leading-[1.1]">433.751</div>
                            <div class="b-u text-[.58rem] opacity-85">ha</div>
                        </div>
                    </div>

                </div><!-- /map section -->

                <!-- TABLE SECTION -->
                <div id="peta-table-section" class="bg-[#ece8df] text-black  px-4 sm:px-12 relative">
                    <div class="flex items-center gap-1.5  sm:hidden"
                        style="background:#ece8df; border-bottom:1px solid rgba(255,255,255,.05);">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="black"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        <span style="font-size:.6rem; color:black; letter-spacing:.08em;">Swipe the table to the side to view all columns</span>
                    </div>
                    <div class="max-w-[980px] mx-auto overflow-x-auto">
                        <table class="w-full border-collapse min-w-[560px]">
                            <thead>
                                <tr c lass="border-b-2 border-[#8b2a1a]">
                                    <th rowspan="2"
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-left align-bottom">
                                        Island</th>
                                    <th colspan="3"
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-[#c04030] py-1 sm:py-[9px] px-2 sm:px-[14px] text-center border-b border-[rgba(255,255,255,.1)]">
                                        Deforestations (ha)</th>
                                    <th colspan="2"
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase py-1 sm:py-[9px] px-2 sm:px-[14px] text-center border-b border-[rgba(255,255,255,.1)]"
                                        style="color:#c04030">Expansion 2025 vs 2024</th>
                                </tr>
                                <tr class="border-b-2 border-[#8b2a1a]">
                                    <th
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                                        2023</th>
                                    <th
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                                        2024</th>
                                    <th
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                                        2025</th>
                                    <th
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                                        Hectares</th>
                                    <th
                                        class="font-poppins text-[.45rem] sm:text-[.65rem] tracking-[.07em] uppercase text-black py-1 sm:py-[9px] px-2 sm:px-[14px] text-right">
                                        Percent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Kalimantan</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        124.611</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        129.896</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        158.283</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        28.387</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        22%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Sumatera</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        33.311</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        91.248</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        144.150</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        52.901</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        58%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Papua</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        55.981</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        17.341</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        77.678</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        60.337</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        348%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Sulawesi</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        36.814</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        17.361</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        39.685</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        22.324</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        129%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Maluku</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        4.034</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        3.537</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        7.527</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        3.989</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        113%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Bali &amp; Nusa Tenggara</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        2.052</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        1.780</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        4.209</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        2.429</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        136%</td>
                                </tr>
                                <tr class="border-b border-[rgba(255,255,255,.07)] hover:bg-[rgba(255,255,255,.04)]">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem] text-black">
                                        Jawa</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        582</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        411</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        2.221</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        1.810</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct text-[#c04030] font-semibold">
                                        440%</td>
                                </tr>
                                <tr class="tot border-t-2 border-[#8b2a1a] text-[#c04030] font-semibold">
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-left font-semibold text-[.65rem] sm:text-[.88rem]">
                                        Total</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        257.385</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        261.575</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        433.751</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem]">
                                        172.177</td>
                                    <td
                                        class="py-1.5 sm:py-[11px] px-2 sm:px-[14px] text-right font-poppins text-[.62rem] sm:text-[.8rem] pct">
                                        66%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <small class="block w-full sm:max-w-6xl mx-auto text-center font-bold"
                    style="font-size: 12px !important;">
                    <i>Deforestation per major island in Indonesia</i>
                </small> --}}
            </div><br><br>



            <p class="body-text">
                Deforestation occurred in all Indonesian provinces except the Jakarta Special Capital Region and the Special
                Region of Yogyakarta. Where the top ten provinces for deforestation in 2024, in order, were: (1) East
                Kalimantan, (2) West Kalimantan, (3) Central Kalimantan, (4) Riau, (5) South Sumatra, (6) Jambi, (7) Aceh,
                (8) North Kalimantan, (9) Bangka Belitung, and (10) North Sumatra, the top ten ranking in 2025 shifted to:
                (1) Central Kalimantan, (2) East Kalimantan, (3) Aceh, (4) West Kalimantan, (5) Central Papua, (6) West
                Sumatra, (7) North Sumatra, (8) North Kalimantan, (9) Riau, and (10) Highland Papua.
            </p>

            <p class="body-text">
                Three provinces that experienced catastrophic landslides and flooding in northern Sumatra at the end of 2025
                recorded dramatic increases in deforestation: Aceh (426%), North Sumatra (281%), and West Sumatra
                (1,034%).<br>
            </p>

            <p class="body-text">
                Deforestation occurred in 383 regencies/municipalities, or 74% of Indonesia’s total of 514, down from 428 in
                the previous year. The top ten regencies for deforestation were in Kalimantan and Papua, accounting for
                95,733 hectares or 22% of national deforestation.<br>
            </p>

            <p class="body-text">
                Seen in terms of land control status, 307,861 hectares (71%) of deforestation occurred inside forest estates
                managed by the Ministry of Forestry, while 125,890 hectares occurred in other land use areas (APL) managed
                by regional governments or land/concession holders.<br>
            </p>


            <p class="body-text">
                Deforestation in conservation areas surged from 7,704 hectares in 2024 to 25,077 hectares in 2025 This
                deforestation occurred in 163 conservation areas. The top ten conservation areas alone accounted for 17,153
                hectares, or 68% of total deforestation within all conservation areas.<br>
            </p>

            <p class="body-text">
                Deforestation of 156,463 hectares – excluding double counting in overlapping habitats – occurred in 29
                million hectares of tiger, rhino, elephant and orangutan habitats.<br>
            </p>



            <p class="body-text">
                In late December 2024, two months after the inauguration of President Prabowo Subianto and Vice President
                Gibran Rakabuming Raka, the Government of Indonesia launched a food security program allocating 20.6 million
                hectares of the forest estate for food, energy, and water reserves. A total of 78,213 hectares, or 18% of
                national deforestation occurred within these designated areas.<br>
            </p>

            <p class="body-text">
                Around 44% of deforestation occurred inside concession areas, with forestry concessions accounting for the
                highest percentage (58%). The majority of deforestation in concessions (65%) occurred in Kalimantan.<br>
            </p>

            <p class="body-text">
                Deforestation amounting to 41,162 hectares occurred inside 1,140 mining permit or concession areas, with the
                top ten accounting for 22% (8,929 hectares).<br>
            </p><br>

            {{-- chart bulanan --}}
            <div class="viz-block viz-block--full mt-10 mb-6" id="chart-monthly-wrap">
                <div class="max-w-4xl mx-auto">
                    <div class="">
                        <div class=" px-4  sm:px-6">
                            <div class=" text-[#1a1a1a] text-lg md:text-xl font-bold tracking-tight mb-1">
                                Deforestation
                                in Indonesia by Month, 2025</div>
                            {{-- <div class="text-[11px] mt-0.5" style="color:#8b7355;">Deforested area per month ·
                                hectares</div> --}}
                        </div>
                        <div id="chart-monthly-inner" class="px-4 sm:px-6 py-4 w-full min-w-0">
                            <div id="chart-monthly-body" class="relative flex" style="height:380px;">
                                <div id="chart-monthly-yaxis"
                                    class="flex flex-col-reverse justify-between pb-[48px] w-[42px] md:w-[56px] shrink-0">
                                </div>
                                <div id="chart-monthly-bars-wrap" class="relative flex-1 flex flex-col">
                                    <div id="chart-monthly-grid"
                                        class="relative flex flex-col-reverse justify-between flex-1"></div>
                                    <div id="chart-monthly-bars"
                                        class="absolute inset-x-0 top-0 bottom-[48px] grid items-end gap-[3px] md:gap-[5px] px-1">
                                    </div>
                                    <div id="chart-monthly-xaxis"
                                        class="relative grid gap-[3px] md:gap-[5px] px-[4px] mt-2 h-[48px] items-center"
                                        style="background:white;z-index:2;"></div>
                                </div>
                            </div>
                            {{-- <small class="block w-full sm:max-w-6xl mx-auto text-center font-bold"
                                style="font-size: 12px !important;">
                                <i>Monthly deforestation in Indonesia in 2025</i>
                            </small><br><br> --}}
                        </div>
                    </div>
                </div>
            </div>

            <p class="body-text">
                Deforestation amounting to 37,910 hectares occurred inside 719 oil palm concessions throughout 2025, with
                the top ten concessions accounting for 36% (13,610 hectares).<br>
            </p>

            <p class="body-text">
                Deforestation amounting to 110,898 hectares occurred inside 486 forestry concessions, with 74,409 hectares
                in logging concessions, 33,063 hectares in pulpwood concessions, 671 hectares in ecosystem restoration
                concessions, and 2,754 hectares in other forestry concessions.<br>
            </p>

            <p class="body-text">
                Deforestation occurred in 212 pulpwood concessions, with the top ten accounting for 34 percent.<br>
            </p>

            <p class="body-text">
                Deforestation occurred in 237 logging concessions, with the top ten accounting for 28 percent.<br>
            </p>


            {{-- <div class="section-label">IV. Peta Tematik Deforestasi</div> --}}
            <p class="body-text">
                Deforestation by province Deforestation by district Deforestation in conservation areas Deforestation
                in
                habitats of iconic megafauna Deforestation within concessions
            </p><br><br>

            <div class="viz-block viz-block--full">
                <div class="block sm:max-w-6xl mx-auto mb-4 text-left">
              <h2 class=" text-[#1a1a1a] text-lg md:text-xl font-bold tracking-tight mb-1">2025 Deforestation Thematic Map</h2>
              {{-- <p class="chart-sub text-sm" style="color:#8b7355;">Annual deforestation rate ·
                  hectares</p> --}}
          </div>

                <!-- PETA TEMATIK (inline) -->
                <!-- ── MODE PILL BAR ── -->
                <div id="mode-pill-bar">
                    <div class="pill-bar-label">Select analysis type · 2025</div>
                    <div id="mode-btn-rail">
                        <button class="mode-btn active" data-mode="provinsi">
                            <span class="mode-btn-switch" aria-hidden="true"><span class="mode-btn-knob"></span></span>
                            <span class="mode-btn-label">Province</span>
                        </button>
                        <button class="mode-btn" data-mode="kabupaten">
                            <span class="mode-btn-switch" aria-hidden="true"><span class="mode-btn-knob"></span></span>
                            <span class="mode-btn-label">Regency</span>
                        </button>
                        <button class="mode-btn" data-mode="konservasi">
                            <span class="mode-btn-switch" aria-hidden="true"><span class="mode-btn-knob"></span></span>
                            <span class="mode-btn-label">Conservation</span>
                        </button>
                        <button class="mode-btn" data-mode="megafauna">
                            <span class="mode-btn-switch" aria-hidden="true"><span class="mode-btn-knob"></span></span>
                            <span class="mode-btn-label">Megafauna</span>
                        </button>
                        <button class="mode-btn" data-mode="konsesi">
                            <span class="mode-btn-switch" aria-hidden="true"><span class="mode-btn-knob"></span></span>
                            <span class="mode-btn-label">Concession</span>
                        </button>
                        <div id="konsesi-submenu" class="hidden">
                            <button class="cat-btn" data-cat="kebun-kayu"><span class="cat-btn-switch"
                                    aria-hidden="true"><span class="cat-btn-knob"></span></span><span
                                    class="cat-btn-label">Kebun Kayu</span></button>
                            <button class="cat-btn" data-cat="logging"><span class="cat-btn-switch"
                                    aria-hidden="true"><span class="cat-btn-knob"></span></span><span
                                    class="cat-btn-label">Logging</span></button>
                            <button class="cat-btn" data-cat="sawit"><span class="cat-btn-switch"
                                    aria-hidden="true"><span class="cat-btn-knob"></span></span><span
                                    class="cat-btn-label">Sawit</span></button>
                            <button class="cat-btn" data-cat="tambang"><span class="cat-btn-switch"
                                    aria-hidden="true"><span class="cat-btn-knob"></span></span><span
                                    class="cat-btn-label">Tambang</span></button>
                        </div>
                    </div>
                </div>

                <div id="peta-tematik" class="overflow-hidden">

                    <main id="wrap" class="relative w-full h-full bg-[#ece8df] flex flex-col overflow-hidden">
                        <div id="map" class="w-full flex-1 h-40"></div>
                        <div id="map-loading"
                            class="hidden absolute inset-0 z-[700] flex flex-col items-center justify-center pointer-events-none">
                            <div class="map-loading-spinner"></div>
                            <div class="map-loading-label">Memuat data peta..</div>
                        </div>
                        <div id="satwa-badges"
                            class="hidden absolute top-4 right-[14px] z-[450] pointer-events-none px-[18px] py-[10px] flex-row items-end justify-end gap-[10px] flex-nowrap overflow-x-auto bg-[rgba(248,244,238,.7)] backdrop-blur-[6px]  max-w-[60vw]">
                        </div>


                        <div id="title-block" class="absolute top-[10px] left-[14px] z-[600] pointer-events-none">
                            <h2 id="map-title"
                                class="font-bold text-[clamp(.9rem,1.5vw,1.5rem)] leading-[1.2] text-[#1a1a1a] [text-shadow:0_2px_10px_rgba(255,255,255,.7)]">
                                Deforestasi berbasis provinsi</h2>
                        </div>

                        <div id="bl-stack" class="hidden">
                            <div id="kpi-float">
                                <div id="kpi-items"></div>
                            </div>
                        </div>

                        <div id="others-bubble" class="hidden" style="display:none!important">
                            <div id="bubble-label"></div>
                            <div id="bubble-val"></div>
                            <div id="bubble-unit"></div>
                        </div>

                        <div id="notes-wrap"
                            class="absolute left-[14px] bottom-[12px] z-[620] w-[min(360px,38vw)] flex flex-col">
                            <div id="notes-box" class=" pt-[14px] px-[14px] pb-[10px]">
                                <ul id="notes-list"
                                    class="pl-[18px] [&>li]:text-[.82rem] [&>li]:leading-[1.48] [&>li]:mb-[6px]"></ul>
                            </div>
                        </div>

                        <div id="map-legend" class="absolute left-[14px] bottom-[52px] z-[620] flex flex-col gap-[4px]"
                            style="display:none"></div>

                        <div id="table-panel"
                            class="absolute right-0 top-0 bottom-0 w-[min(600px,56vw)] bg-[#1a1a1a] z-[650] translate-x-full transition-transform duration-[280ms] ease-[cubic-bezier(.4,0,.2,1)] flex flex-col border-l-2 border-white/[.1] shadow-[-10px_0_40px_rgba(0,0,0,.45)]">
                            <button id="table-toggle" style="display:none!important"></button>
                            <div class="flex items-center justify-between px-4 py-3 border-b border-white/[.1] shrink-0">
                                <span class="text-[.65rem] font-bold tracking-[.1em] uppercase text-[#d4c4a0]">Tabel
                                    Data</span>
                                <button id="table-close"
                                    class="flex items-center justify-center w-7 h-7 rounded-full bg-white/[.08] hover:bg-white/[.16] border-0 cursor-pointer transition-colors"
                                    aria-label="Tutup tabel">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M1 1l10 10M11 1L1 11" stroke="#f5f0e8" stroke-width="1.8"
                                            stroke-linecap="round" />
                                    </svg>
                                </button>
                            </div>
                            <div id="table-wrap" class="flex-1 overflow-y-auto overflow-x-hidden flex flex-col"></div>
                        </div>
                    </main>

                </div>

                <aside id="sidebar"
                    class="w-full shrink-0 bg-[#1a1a1a] text-[#f5f0e8] border-t border-white/[.08] flex flex-col overflow-hidden"
                    style="max-height:400px">
                    <span id="sidebar-mode-label" class="hidden"></span>
                    <div id="sidebar-table-wrap"
                        class="flex-1 flex flex-row items-stretch justify-center overflow-y-hidden overflow-x-auto"></div>
                </aside>

                {{-- <small class="block w-full sm:max-w-6xl mx-auto text-center font-bold"
                    style="font-size: 12px !important;">
                    <i>Deforestation 2025 by administrative region, conservation area, and concession</i>
                </small> --}}

            </div><br><br>


            <div class="mx-[50px] relative pl-10 py-2">
                <!-- Tanda kutip besar di kiri atas -->
                <span class="absolute top-0 left-0 text-black font-black leading-none" style="font-size: 3.5rem; line-height: 1;">&rdquo;</span>

                <p class="text-black text-[20px] md:text-[20px] leading-snug">
                    Of 433,751 hectares of deforestation area, 166,590 hectares are above 5 hectares deforestation spots. 62% of deforestation occurred on spots smaller than 5 hectares, with 149,159 hectares occurring on 1 to 5 hectare spots.
                    <span class="font-black" style="font-size: 3.5rem; line-height: 0; vertical-align: -0.3em;">&rdquo;</span>
                </p>
            </div>
        </section>



        <!-- DISKUSI -->
        <span class="s-anchor" id="diskusi"></span>
        <section class="page-section px-[5vw] py-10">
            <div class="section-label">IV. Discussion</div>

            <div class="mt-10">
                <div class="chapter-header">
                    <span class="ms-num">1.</span>
                    <h3 class="chapter-title"><strong>Government Policies have Contribute to Deforestation</strong></h3>
                </div>
                <p class="body-text">
                    During the Joko Widodo presidency, particularly the second term, environmental protection weakened,
                    especially with the enactment of the Job Creation Law or Omnibus Law. For example, the requirement for
                    every region to maintain at least 30% forest cover was removed from regulatory text. Further, government
                    projects, particularly those labeled National Strategic Projects, were afforded flexibility to encroach
                    on forest estates. Such projects are often not accompanied by adequate planning, including spatial
                    planning.
                </p>
                <p class="body-text">
                    The Prabowo–Gibran presidential era appears to be persisting with this policy. Its doggedness in
                    continuing the food estate program in Merauke is one such example. The government is developing rice
                    fields in Merauke while, at the same time, eradicating rice fields in Sulawesi for smelter construction
                    and nickel mining expansion. Not only that, these nickel mines have triggered the destruction of sago
                    plants in eastern Indonesia, despite sago being a staple food in the region.
                </p>
                <p class="body-text">
                    At the end of December 2024, two months after the inauguration of Prabowo–Gibran, the government
                    launched a program to designate 20 million hectares of forest for food, energy, and water reserves. As
                    things progressed, the total area became 20.6 million hectares. Auriga Nusantara analysis shows 8.8
                    million hectares of natural forest inside these designated reserves, and 18% of deforestation in 2025
                    occurring within such areas. This deforestation was driven by populist food programs, such as the
                    Community Ricefield Development or Cetak Sawah Rakyat (CSR) program in Central Kalimantan – the province
                    with the highest deforestation area in 2025, despite ranking third in 2024.
                </p>
                <p class="body-text">
                    The issuing of conversion permits for mining, oil palm plantations, and industrial timber plantations in
                    areas with natural forest is another major driver of deforestation. Auriga Nusantara’s analysis
                    indicates that, as of 2024, there were 9.6 million hectares of natural forest cover within conversion
                    concessions. In 2025, deforestation inside these concessions reached 114,823 hectares, or 26% of
                    national deforestation.
                </p>
                <p class="body-text">
                    Additionally, the release of forest estate to become other land use (APL) areas, despite still having
                    natural forest cover, often marks the initial step towards deforestation, as logging inside APL areas is
                    not against the law. Such forest estate releases frequently occur to accommodate specific concessions or
                    at the request of regional governments through spatial planning revisions (RTRW). As of 2024, there were
                    10.2 million hectares of natural forest inside APL areas, and in 2025, deforestation in such areas
                    reached 125,997 hectares, or 28% of national deforestation.
                </p>




                <!-- <ul class="insight-list">
                                                                                                                                                                                                                                                                                          <li>Pengenduran perlindungan lingkungan mempermudah pembukaan hutan</li>
                                                                                                                                                                                                                                                                                          <li>Program pangan, energi, dan air beririsan dengan jutaan hektare hutan alam</li>
                                                                                                                                                                                                                                                                                          <li>Deforestasi dalam konsesi konversi mencapai 26% dari deforestasi nasional</li>
                                                                                                                                                                                                                                                                                          <li>Deforestasi dalam APL mencapai 28% dari deforestasi nasional</li>
                                                                                                                                                                                                                                                                                        </ul> -->
            </div>

            <div class="viz-block viz-block--full mt-2 mb-2">
                <div class="viz-frame viz-frame--padded">
                    <div class="max-w-5xl mx-auto px-4 z-20 relative">

                        <div x-data="{
                            active: 0,
                            images: [{
                                    src: '{{ asset('assets/images/stadi2025/diskusi 1/HTE Kaltara.jpg') }}',
                                    desc: '<strong>Natural forest cover within the timber plantation concession of PT Malinau Hijau Lestari (MHL) in Malinau, North Kalimantan.</strong> The granting of timber plantation permits in areas covered by natural forest such as this constitutes a form of government-sanctioned deforestation, as it allows MHL to clear the natural forest and replace it (convert it) with an energy (biomass) timber plantation that will be harvested periodically.',
                                    cc: '© Auriga Nusantara, May 2024.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 1/IMIP.jpg') }}',
                                    desc: '<strong>Deforestation caused by the expansion of PT Weda Bay Nickel’s nickel mine in Central Halmahera, North Maluku.</strong> By issuing a mining permit for a forested area, the government is essentially planning deforestation to facilitate nickel extraction within this mining concession.',
                                    cc: '© Auriga Nusantara, December 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 1/IPIP.jpg') }}',
                                    desc: '<strong>Deforestation caused by the development of the Pomalaa Industry Park (IPIP) in Kolaka, Southeast Sulawesi.</strong> This industrial park is one of the National Strategic Projects (PSN) and is located within a Conversion Production Forest Area. ',
                                    cc: '© Auriga Nusantara, December 2025'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 1/PLTA.jpg') }}',
                                    desc: '<strong>Deforestation caused by the construction of the Mentarang hydroelectric power plant in Malinau, North Kalimantan.</strong> This project is one of the National Strategic Projects. ',
                                    cc: '© Auriga Nusantara, October 2025.'
                                }
                            ]
                        }">

                            <!-- IMAGE -->
                            <div class="relative" x-ref="mainImg">
                                <img :src="images[active].src"
                                    @click="GLightbox({
                                                                    elements: images.map(img => ({
                                                                      href: img.src,
                                                                      description: img.desc
                                                                    })),
                                                                    startAt: active
                                                                  }).open()"
                                    class="w-full aspect-video sm:aspect-auto sm:h-[60vh] object-cover object-top cursor-pointer hover:brightness-50 transition duration-300" />

                                <!-- PREV -->
                                <button x-show="active > 0" @click="active--"
                  class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ◀
                </button>

                <button x-show="active < images.length - 1" @click="active++"
                  class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ▶
                </button>
                            </div>

                            <!-- DESC -->
                            <!-- <div class="mt-4" x-show="images[active].desc" style="line-height: 1;" style="line-height: 1;">
                                <small style="font-size: 12px;" x-html="images[active].desc"></small>
                              </div> -->

                            <!-- THUMB + LOKASI -->
                            <div class="sm:flex hidden flex-col sm:flex-row sm:justify-between gap-4 mt-4">
                                <div class="grid grid-cols-3 gap-2 sm:flex sm:gap-2"
                                    :style="$el.offsetParent && window.innerWidth < 640 ? 'width: ' + $refs.mainImg
                                        .offsetWidth + 'px' : ''">
                                    <template x-for="(img, index) in images" :key="index">
                                        <div @click="active = index" class="cursor-pointer aspect-square sm:w-20"
                                            :class="active === index ? 'opacity-100 ring-2 ring-black' :
                                                'opacity-50 hover:opacity-80'">
                                            <img :src="img.src" alt="thumbnail"
                                                class="w-full h-full object-cover object-top transition duration-200" />
                                        </div>
                                    </template>
                                </div>

                                <div
                                    class="text-right text-[12px] leading-tight flex flex-col justify-between h-28 max-w-md">

                                    <div x-html="images[active].desc"></div>

                                    <div class="opacity-60" x-html="images[active].cc"></div>

                                </div>
                                <!-- <small style="font-size: 12px; line-height: 1;" x-html="images[active].desc" class="text-right"></small> -->
                            </div>

                        </div>

                    </div>
                </div>
            </div><br><br>


            <hr class="divider"><br><br>

            <div>
                <div class="chapter-header">
                    <span class="ms-num">2.</span>
                    <h3 class="chapter-title">The epicenter of deforestation is shifting to Papua</h3>
                </div>
                <p class="body-text">
                    Kalimantan once again recorded the greatest extent of deforestation, making it the region with
                    Indonesia’s highest deforestation rate for consecutive years <a href="" class="text-[#bc4a3c]"
                        target="_blank">since 2013</a>, or for 13 years in a row. However, the greatest increase in
                    deforestation in 2025 occurred in Papua, with 60,337 hectares positioning the island in third place
                    behind Kalimantan and Sumatra, overtaking Sulawesi which ranked third for deforestation in 2024.
                </p>
                <p class="body-text">
                    Government programs, such as National Strategic Projects and food estates, are key drivers of increasing
                    deforestation in Papua. Infrastructure development, which frequently follows fragmentation to form new
                    administrative regions, has also contributed to forest loss on the island. Similarly, the expansion of
                    monoculture commodities, particularly oil palm, has further accelerated deforestation.
                </p>
                <p class="body-text">
                    This combination of factors must be afforded serious attention in efforts to curb deforestation in Papua
                    moving forward. Simulations conducted by Auriga Nusantara in Aceh and Riau show that deforestation
                    surges once palm oil mills begin operating, and the closer an area is to a mill, the higher its
                    deforestation rate will be. A similar phenomenon has occurred in Sulawesi and North Maluku since nickel
                    smelters began operating in 2016. Accordingly, infrastructure development and fragmentation of
                    administrative regions in Papua will make the establishment of new mills or processing industries a
                    likelihood. Moreover, most oil palm plantations in Papua are still young and are expected to reach peak
                    production within the next 5–10 years, increasing the need for processing mills. If such mills do
                    appear, and infrastructure continues to improve, how can deforestation rates on the island be held back?
                </p>
            </div>
            <div class="viz-block viz-block--full mt-2 mb-2">
                <div class="viz-frame viz-frame--padded">
                    <div class="max-w-5xl mx-auto px-4 z-20 relative">

                        <div x-data="{
                            active: 0,
                            images: [{
                                    src: '{{ asset('assets/images/stadi2025/diskusi 2/Nabire.jpg') }}',
                                    desc: '<strong>Deforestation within the logging concession of PT Jati Dharma Indah Plywood Industries in Nabire, Central Papua.</strong> ',
                                    cc: '© Auriga Nusantara, December 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 2/Raja Ampat.jpg') }}',
                                    desc: '<strong>Deforestation caused by the nickel mining operations of PT Anugerah Surya Pratama, Manuram Island, Raja Ampat, Papua.</strong>',
                                    cc: '© Auriga Nusantara, September 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 2/Sarmi.jpg') }}',
                                    desc: '<strong>Natural forest cover in Sarmi Regency, Papua.</strong> However, the government has issued a nickel mining permit to PT Iriana Mutiara Mining for this area, thereby paving the way for the loss of this natural forest cover. ',
                                    cc: '© Auriga Nusantara, December 2024.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 2/Sorong.jpg') }}',
                                    desc: '<strong>Deforestation of natural forest by the food estate project in Sorong, West Papua.</strong> ',
                                    cc: '© Auriga Nusantara, April 2026.'
                                }
                            ]
                        }">

                            <!-- IMAGE -->
                            <div class="relative" x-ref="mainImg">
                                <img :src="images[active].src"
                                    @click="GLightbox({
                                                                elements: images.map(img => ({
                                                                  href: img.src,
                                                                  description: img.desc
                                                                })),
                                                                startAt: active
                                                              }).open()"
                                    class="w-full aspect-video sm:aspect-auto sm:h-[60vh] object-cover object-top cursor-pointer hover:brightness-50 transition duration-300" />

                                <!-- PREV -->
                                <button x-show="active > 0" @click="active--"
                  class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ◀
                </button>

                <button x-show="active < images.length - 1" @click="active++"
                  class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ▶
                </button>
                            </div>

                            <!-- DESC -->
                            <!-- <div class="mt-4" x-show="images[active].desc" style="line-height: 1;" style="line-height: 1;">
                                <small style="font-size: 12px;" x-html="images[active].desc"></small>
                              </div> -->


                            <div class="sm:flex hidden flex-col sm:flex-row sm:justify-between gap-4 mt-4">
                                <div class="grid grid-cols-3 gap-2 sm:flex sm:gap-2"
                                    :style="$el.offsetParent && window.innerWidth < 640 ? 'width: ' + $refs.mainImg
                                        .offsetWidth + 'px' : ''">
                                    <template x-for="(img, index) in images" :key="index">
                                        <div @click="active = index" class="cursor-pointer aspect-square sm:w-20"
                                            :class="active === index ? 'opacity-100 ring-2 ring-black' :
                                                'opacity-50 hover:opacity-80'">
                                            <img :src="img.src" alt="thumbnail"
                                                class="w-full h-full object-cover object-top transition duration-200" />
                                        </div>
                                    </template>
                                </div>

                                <div
                                    class="text-right text-[12px] leading-tight flex flex-col justify-between h-28 max-w-md">

                                    <div x-html="images[active].desc"></div>

                                    <div class="opacity-60" x-html="images[active].cc"></div>

                                </div>
                                <!-- <small style="font-size: 12px; line-height: 1;" x-html="images[active].desc" class="text-right"></small> -->
                            </div>

                        </div>

                    </div>
                </div>
            </div><br><br>

            <hr class="divider"><br><br>

            <div>
                <div class="chapter-header">
                    <span class="ms-num">3.</span>
                    <h3 class="chapter-title">Expansion of industrial commodities is a key driver of deforestation in
                        Indonesia</h3>
                </div>
                <p class="body-text">
                    Expansion of industrial commodities remains a major threat to Indonesia’s remaining natural forests. The
                    development of new oil palm plantations is a primary driver of deforestation in Sumatra, as has happened
                    in Sijunjung Protection Forest in West Sumatra. Deforestation for oil palm development has even
                    encroached into conservation areas like Rawa Singkil Wildlife Sanctuary in Aceh.
                </p>
                <p class="body-text">
                    Deforestation from oil palm expansion has tended to slow, partly due to market saturation. However,
                    government biodiesel subsidy policies, unaccompanied by safeguard mechanisms for forests, continue to
                    drive deforestation. After previously mandating a biodiesel blend containing 30% palm oil (B30), which
                    then increased to B35, since early 2025, the government has been applying its <a
                        href="https://www.esdm.go.id/id/media-center/arsip-berita/wujudkan-ketahanan-energi-dan-kurangi-impor-menteri-esdm-mandatori-b40-berlaku-1-januari-2025"
                        class="text-[#bc4a3c]" target="_blank">B40 policy</a>.

                </p>
                <p class="body-text">
                    In Kalimantan, the main driver of deforestation is the expansion of pulpwood plantations for the pulp
                    and paper industry. The issuing of a license to build the giant PT Phoenix Resources International pulp
                    mill in Tarakan, North Kalimantan, is the main cause, as the mill lacks its own managed supplier
                    concessions. Much of the deforestation occurring in Central and East Kalimantan leads to this mill.
                </p>
                <p class="body-text">
                    The global boom in electric vehicles is a driver of nickel mining and processing industry expansion.
                    Permits for these industries being issued without clarity over raw material sources, particularly to
                    avoid deforestation, resulted in a surge in deforestation in Sulawesi and North Maluku.
                <p class="body-text">
                    Nickel mining is nothing new in Sulawesi, and dates back to the 1930s, with nickel smelters being in
                    operation since 1973. Prior to 2014, only three smelters were operating in Sulawesi, before the number
                    grew rapidly during the Joko Widodo presidency. From 2014 to 2024, at least 16 new nickel smelters began
                    operating on the island, which has one of the world’s highest levels of endemism.
                </p>
                <p class="body-text">
                    Rising gold prices have also contributed to deforestation. Notably, two gold mining concessions – PT
                    Agincourt Resources and PT Blok Waringin Agung – rank among the top ten deforesters among mining
                    concessions.
                </p>


            </div>
            <div class="viz-block viz-block--full mt-2 mb-2">
                <div class="viz-frame viz-frame--padded">
                    <div class="max-w-5xl mx-auto px-4 z-20 relative">

                        <div x-data="{
                            active: 0,
                            images: [{
                                    src: '{{ asset('assets/images/stadi2025/diskusi 3/Konsesi PBPH, PT Toba Pulp Lestari.jpg') }}',
                                    desc: '<strong>Deforestation caused by the construction of logging roads within PT Toba Pulp Lestari’s timber plantation concession.</strong> These roads will serve as gateways to massive deforestation in this area.',
                                    cc: '© Auriga Nusantara/Earthsight, December 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 3/Konsesi Kebun, PT Equator Sumber Rezeki.jpg') }}',
                                    desc: '<strong>Deforestation of natural forest due to oil palm plantation development within the PT Equator Sumber Rezeki concession in Kapuas Hulu, West Kalimantan.</strong> ',
                                    cc: '© Auriga Nusantara, June 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 3/konsesi pbph.jpg') }}',
                                    desc: '<strong>Deforestation caused by the development of timber plantations within PT Industrial Forest Plantation’s concession in Kapuas, Central Kalimantan.</strong> ',
                                    cc: '© Auriga Nusantara/Earthsight, July 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 3/Tambang.jpg') }}',
                                    desc: '<strong>Deforestation of natural forests caused by the expansion of a nickel mine in Kolonodale, North Morowali, Central Sulawesi.</strong>',
                                    cc: '© Auriga Nusantara, October 2025.'
                                }
                            ]
                        }">

                            <!-- IMAGE -->
                            <div class="relative" x-ref="mainImg">
                                <img :src="images[active].src"
                                    @click="GLightbox({
                                                          elements: images.map(img => ({
                                                            href: img.src,
                                                            description: img.desc
                                                          })),
                                                          startAt: active
                                                        }).open()"
                                    class="w-full aspect-video sm:aspect-auto sm:h-[60vh] object-cover object-top cursor-pointer hover:brightness-50 transition duration-300" />

                                <!-- PREV -->
                                <button x-show="active > 0" @click="active--"
                  class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ◀
                </button>

                <button x-show="active < images.length - 1" @click="active++"
                  class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ▶
                </button>
                            </div>

                            <!-- DESC -->
                            <!-- <div class="mt-4" x-show="images[active].desc" style="line-height: 1;" style="line-height: 1;">
                                <small style="font-size: 12px;" x-html="images[active].desc"></small>
                              </div> -->

                            <!-- THUMB + LOKASI -->
                            <div class="sm:flex hidden flex-col sm:flex-row sm:justify-between gap-4 mt-4">
                                <div class="grid grid-cols-3 gap-2 sm:flex sm:gap-2"
                                    :style="$el.offsetParent && window.innerWidth < 640 ? 'width: ' + $refs.mainImg
                                        .offsetWidth + 'px' : ''">
                                    <template x-for="(img, index) in images" :key="index">
                                        <div @click="active = index" class="cursor-pointer aspect-square sm:w-20"
                                            :class="active === index ? 'opacity-100 ring-2 ring-black' :
                                                'opacity-50 hover:opacity-80'">
                                            <img :src="img.src" alt="thumbnail"
                                                class="w-full h-full object-cover object-top transition duration-200" />
                                        </div>
                                    </template>
                                </div>

                                <div
                                    class="text-right text-[12px] leading-tight flex flex-col justify-between h-28 max-w-md">

                                    <div x-html="images[active].desc"></div>

                                    <div class="opacity-60" x-html="images[active].cc"></div>

                                </div>
                                <!-- <small style="font-size: 12px; line-height: 1;" x-html="images[active].desc" class="text-right"></small> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div><br><br>

            <hr class="divider"><br><br>

            <div>
                <div class="chapter-header">
                    <span class="ms-num">4.</span>
                    <h3 class="chapter-title">Legal deforestation as a root cause</h3>
                </div>
                <p class="body-text">
                    One effect of Indonesia’s convoluted regulatory framework is difficulty in recognizing whether
                    deforestation is legal or illegal. While many regulations aim to protect forests, numerous loopholes
                    render them unprotected.
                </p>
                <p class="body-text">
                    In a presentation to Commission IV of the Republic of Indonesia House of Representatives (DPR RI) on
                    July 15, 2025, Auriga Nusantara revealed that, as of 2024, 41.6 million hectares, or 44% of Indonesia’s
                    natural forest cover, had no legal protection. Under the current situation, causing forest loss is still
                    possible through legally permissible mechanisms, such as conversion permit issuance or spatial plan
                    revisions.
                </p>
                <p class="body-text">
                    Of all deforestation in 2025, the only deforestation that could be directly classified as illegal was
                    deforestation in conservation areas (20,077 hectares), in protection forests (80,023 hectares), logging
                    concessions (74,409 hectares), and ecosystem restoration concessions (617 hectares), totaling 180,370
                    hectares or 42% of national deforestation. In other words, 58% of deforestation in 2025 constituted
                    legal deforestation.
                </p>


            </div>

            <div class="viz-block viz-block--full mt-2 mb-2">
                <div class="viz-frame viz-frame--padded">
                    <div class="max-w-5xl mx-auto px-4 z-20 relative">

                        <div x-data="{
                            active: 0,
                            images: [{
                                    src: '{{ asset('assets/images/stadi2025/diskusi 4/Konsesi PBPH, PT Indosubur Sukses Makmur.jpg') }}',
                                    desc: '<strong>Deforestation within the timber plantation concession of PT Indosubur Sukses Makmur in East Kutai, East Kalimantan.</strong> The issuance of timber plantation permits in areas covered by natural forest such as this is an example of legal deforestation in Indonesia.',
                                    cc: '© Auriga Nusantara/Earthsight, January 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 4/Konsesi Kebun Sawit, PT Borneo Internasional.jpg') }}',
                                    desc: '<strong>Conversion of natural forest into large-scale oil palm plantations within the PT Borneo International Anugerah concession in Kapuas Hulu, West Kalimantan.</strong> The existence of permits for monoculture plantations in this area has allowed the company to clear the existing natural forest.',
                                    cc: '© Auriga Nusantara, June 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 4/Batang Toru.jpg') }}',
                                    desc: '<strong>Gold mining operations by PT Agincourt Resources in the Batang Toru landscape, North Sumatra.</strong> The Batang Toru landscape is the only habitat of the Tapanuli orangutan (Pongo tapanuliensis) in the world. The existence of mining permits indicates that the clearing of natural forests is occurring as a form of legal deforestation.',
                                    cc: '© Auriga Nusantara, May 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 4/Konsesi PBPH, PT Banyan Tumbuh Lestari.jpg') }}',
                                    desc: '<strong>Deforestation of natural forest within the palm oil concession of PT Banyan Tumbuh Lestari in Pohuwato, Gorontalo.</strong> The company’s permit is technically for a palm oil plantation, but in practice, the company is establishing a biomass timber plantation. The government’s decision to reclassify this forest area as an “Other Use Area” has opened the door to legal deforestation in this region.',
                                    cc: '© Auriga Nusantara, May 2025.'
                                }
                            ]
                        }">

                            <!-- IMAGE -->
                            <div class="relative" x-ref="mainImg">
                                <img :src="images[active].src"
                                    @click="GLightbox({
                                                      elements: images.map(img => ({
                                                        href: img.src,
                                                        description: img.desc
                                                      })),
                                                      startAt: active
                                                    }).open()"
                                    class="w-full aspect-video sm:aspect-auto sm:h-[60vh] object-cover object-top cursor-pointer hover:brightness-50 transition duration-300" />

                                <!-- PREV -->
                                <button x-show="active > 0" @click="active--"
                  class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ◀
                </button>

                <button x-show="active < images.length - 1" @click="active++"
                  class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ▶
                </button>
                            </div>

                            <!-- DESC -->
                            <!-- <div class="mt-4" x-show="images[active].desc" style="line-height: 1;" style="line-height: 1;">
                                <small style="font-size: 12px;" x-html="images[active].desc"></small>
                              </div> -->

                            <!-- THUMB + LOKASI -->
                            <div class="sm:flex hidden flex-col sm:flex-row sm:justify-between gap-4 mt-4">
                                <div class="grid grid-cols-3 gap-2 sm:flex sm:gap-2"
                                    :style="$el.offsetParent && window.innerWidth < 640 ? 'width: ' + $refs.mainImg
                                        .offsetWidth + 'px' : ''">
                                    <template x-for="(img, index) in images" :key="index">
                                        <div @click="active = index" class="cursor-pointer aspect-square sm:w-20"
                                            :class="active === index ? 'opacity-100 ring-2 ring-black' :
                                                'opacity-50 hover:opacity-80'">
                                            <img :src="img.src" alt="thumbnail"
                                                class="w-full h-full object-cover object-top transition duration-200" />
                                        </div>
                                    </template>
                                </div>

                                <div
                                    class="text-right text-[12px] leading-tight flex flex-col justify-between h-28 max-w-md">

                                    <div x-html="images[active].desc"></div>

                                    <div class="opacity-60" x-html="images[active].cc"></div>

                                </div>
                                <!-- <small style="font-size: 12px; line-height: 1;" x-html="images[active].desc" class="text-right"></small> -->
                            </div>

                        </div>

                    </div>
                </div>
            </div><br><br>




            <hr class="divider"><br><br>

            <div>
                <div class="chapter-header">
                    <span class="ms-num">5.</span>
                    <h3 class="chapter-title">Significant deforestation in conservation areas</h3>
                </div>
                <p class="body-text">
                    Currently, government conservation efforts tend to focus only on designated conservation areas within
                    the forest estate. These include natural sanctuaries such as nature reserves and wildlife sanctuaries;
                    and conservation estates such as national parks and grand forest parks. Indonesia currently has 22.1
                    million hectares of conservation areas.
                </p>
                <p class="body-text">
                    However, a large number of ecologically important areas lie outside conservation areas. These include
                    22.8 million hectares of habitat for iconic species – tigers, rhinos, elephants, and orangutans; and
                    21.6 million hectares of key biodiversity areas (KBAs) identified by the International Union for
                    Conservation of Nature (IUCN). These areas combined, without double counting, cover 63.5 million
                    hectares.
                </p>
                <p class="body-text">
                    Deforestation within conservation areas surged from 7,704 hectares in 2024 to 25,077 hectares in 2025,
                    an increase of 225%. Meanwhile, deforestation across all conservation areas reached 186,465 hectares,
                    accounting for 43% of national deforestation.
                </p>
            </div>
             <div class="viz-block viz-block--full mt-2 mb-2">
        <div class="viz-frame viz-frame--padded">
          <div class="max-w-5xl mx-auto px-4 z-20 relative">

            <div x-data="{
                                                                          active: 0,
                                                                          images: [
                                                                            {
                                                                              src: '{{ asset('assets/images/stadi2025/diskusi 5/Deforestasi, Kawasan Konservasi, Suaka Margasatwa Rawa Singkil, Aceh Selatan, Aceh, Agustus 2022.jpg') }}',
                                    desc: '<strong>Deforestation of natural forest within the Rawa Singkil Wildlife Reserve, Aceh.</strong> The presence of canals indicates that this activity did not occur overnight, raising questions about the effectiveness of the management of this conservation area by the Aceh Natural Resources Conservation Agency (BKSDA).',
                                    cc: '© HAKA'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 5/Habitat Orang Utan.jpg') }}',
                                    desc: '<strong>Deforestation of natural forests—habitat of orangutans—for the development of oil palm plantations within the PT Borneo Internasional Anugerah concession in Kapuas Hulu, West Kalimantan.</strong>',
                                    cc: '© Auriga Nusantara, June 2025.'
                                },
                                {
                                    src: '{{ asset('assets/images/stadi2025/diskusi 5/Rawa Singkil.jpg') }}',
                                    desc: '<strong>Deforestation in the Rawa Singkil Wildlife Reserve, Aceh.</strong> This deforestation is believed to be for the development of oil palm plantations in one of Indonesia’s most densely populated orangutan habitats.',
                                    cc: '© HAKA, Agustus 2025.'
                                                                            }
                                                                          ]
                                                                        }">

              <!-- IMAGE -->
              <div class="relative" x-ref="mainImg">
                <img :src="images[active].src" @click="GLightbox({
                    elements: images.map(img => ({
                        href: img.src,
                        description: img.desc + (img.cc ? '<br><br>' + img.cc: '')
                    })),
                    startAt: active
                }).open()"
                  class="w-full aspect-video sm:aspect-auto sm:h-[60vh] object-cover object-top cursor-pointer hover:brightness-50 transition duration-300" />

                <!-- PREV -->
                <button x-show="active > 0" @click="active--"
                  class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ◀
                </button>

                <button x-show="active < images.length - 1" @click="active++"
                  class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center transition">
                  ▶
                </button>
              </div>

              <!-- DESC -->
              <!-- <div class="mt-4" x-show="images[active].desc" style="line-height: 1;" style="line-height: 1;">
                                          <small style="font-size: 12px;" x-html="images[active].desc"></small>
                                        </div> -->

              <!-- THUMB + LOKASI -->
              <div class="sm:flex hidden flex-col sm:flex-row sm:justify-between gap-4 mt-4">
                <div class="grid grid-cols-3 gap-2 sm:flex sm:gap-2"
                  :style="$el.offsetParent && window.innerWidth < 640 ? 'width: ' + $refs.mainImg.offsetWidth + 'px' : ''">
                  <template x-for="(img, index) in images" :key="index">
                    <div @click="active = index" class="cursor-pointer aspect-square sm:w-20"
                      :class="active === index ? 'opacity-100 ring-2 ring-black' : 'opacity-50 hover:opacity-80'">
                      <img :src="img.src" alt="thumbnail"
                        class="w-full h-full object-cover object-top transition duration-200" />
                    </div>
                  </template>
                </div>

                <div class="text-right text-[12px] leading-tight flex flex-col justify-between h-28 max-w-md">

                  <div x-html="images[active].desc"></div>

                  <div class="opacity-60" x-html="images[active].cc"></div>

                </div>
                <!-- <small style="font-size: 12px; line-height: 1;" x-html="images[active].desc" class="text-right"></small> -->
              </div>

            </div>

          </div>
        </div>
      </div><br>
        </section>

        <!-- REKOMENDASI -->
        <span class="s-anchor" id="rekomendasi"></span>
        <section class="page-section px-[5vw] pt-10 pb-20">
            <div class="mx-auto max-w-[820px]">
                <div class="section-label">V. Recommendations</div>

                {{-- <p class="body-text">
                    Perlindungan hutan alam tersisa perlu diperkuat melalui kombinasi regulasi, tata ruang, kelembagaan, dan
                    tanggung jawab para pemegang izin. Rekomendasi berikut menempatkan perlindungan hutan sebagai agenda
                    kebijakan
                    yang harus dijalankan secara serentak.
                </p> --}}

                <div class="method-steps">
                    <div class="border-b pt-0 pb-12">
                        <div class="method-step">
                            <div class="ms-num">1.</div>
                            <div>
                                <h4 class="chapter-title">Issue legislation to ensure the protection of all remaining
                                    natural forests in Indonesia </h4><br>
                                <p class="body-text">
                                    Legal protection over natural forests should ideally be in the form of a law. However,
                                    enacting laws is not easy and often takes years. Even lower tier legislation like
                                    government regulations can take considerable time to develop, largely due to the
                                    intricacies and complexities involved in the cross-ministerial approvals required in
                                    their formulation. Consequently, a presidential regulation would constitute a tactical
                                    breakthrough that could act as an emergency brake to address this issue. Thus, it is
                                    time for President Prabowo Subianto to issue a presidential regulation on the protection
                                    of all remaining natural forests in Indonesia.
                                </p>
                            </div>
                        </div>

                        <div class="viz-block viz-block--full !mt-0 !pt-0 mb-2">
                            <div class="viz-frame !p-0 flex items-start !mt-[-20px]">

                                <div x-data="{
                                    currentSlide: 4,
                                    startX: 0,
                                    images: [{
                                            src: '{{ asset('assets/images/stadi2025/RUDP1 en.jpg') }}',
                                            desc: '<strong>Nearly half of Indonesia’s natural forests lack legal protection.</strong> Indonesia has 118.7 million hectares of terrestrial forest areas. It is worth noting that a forest area is a region designated as such. It is not uncommon for forest areas to lack forest cover. Conversely, a significant amount of natural forest cover lies outside designated forest areas.'
                                        },
                                        {
                                            src: '{{ asset('assets/images/stadi2025/RUDP2 en.jpg') }}',
                                            desc: '<strong>Nearly half of Indonesia’s natural forests lack legal protection.</strong> Of the 22 million hectares of conservation forest areas, 4.7 million hectares are not covered by natural forest. Legally, all natural forests within conservation forest areas are protected.'
                                        },
                                        {
                                            src: '{{ asset('assets/images/stadi2025/RUDP3 en.jpg') }}',
                                            desc: '<strong>Nearly half of Indonesia’s natural forests lack legal protection.</strong> There are 227,127 hectares of natural forest cover within protected forests that lie outside the moratorium area, leaving them vulnerable to deforestation due to government policies or projects.'
                                        },
                                        {
                                            src: '{{ asset('assets/images/stadi2025/RUDP4 en.jpg') }}',
                                            desc: '<strong>Nearly half of Indonesia’s natural forests lack legal protection.</strong> There are 22.5 million hectares of natural forest cover in production forests located outside the moratorium area, making them vulnerable to deforestation because they lack legal protection.'
                                        },
                                        {
                                            src: '{{ asset('assets/images/stadi2025/RUDP5 en.jpg') }}',
                                            desc: '<strong>Nearly half of Indonesia’s natural forests lack legal protection.</strong> There are 9 million hectares of natural forest cover outside designated forest areas—or located within Other Land Use Areas (APL)—and 8.1 million hectares of that are outside the moratorium area. In total, 41.6 million hectares (44%) of Indonesia’s natural forest cover lack legal protection.'
                                        }
                                    ],
                                    get totalSlides() { return this.images.length },

                                    openLightbox(index) {
                                        GLightbox({
                                            elements: this.images.map(img => ({
                                                href: img.src,
                                                description: img.desc
                                            })),
                                            startAt: index
                                        }).open();
                                    },

                                    startSwipe(e) { this.startX = e.touches[0].clientX },
                                    handleTouchMove(e) {
                                        let diff = this.startX - e.touches[0].clientX
                                        if (Math.abs(diff) > 50) {
                                            if (diff > 0 && this.currentSlide < this.totalSlides - 1) this.currentSlide++
                                            else if (diff < 0 && this.currentSlide > 0) this.currentSlide--
                                            this.startX = e.touches[0].clientX
                                        }
                                    }
                                }" @touchstart="startSwipe" @touchmove="handleTouchMove"
                                    class="relative max-w-4xl mx-auto overflow-hidden w-full">

                                    <!-- SLIDER -->
                                    <div class="flex " :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">

                                        <template x-for="(item, index) in images" :key="index">
                                            <div class="w-full flex-shrink-0">

                                                <div class="max-w-4xl mx-auto px-12 sm:px-0 py-3 text-justify"
                                                    style="line-height: 1; padding-right: 8rem; padding-left: 5rem;">
                                                    <small style="font-size: 12px;" x-html="item.desc"></small>
                                                </div>


                                                <!-- GAMBAR -->
                                                <div class="relative">
                                                    <img :src="item.src" @click="openLightbox(index)"
                                                        class="w-full object-contain h-[220px] sm:h-[60vh] cursor-pointer" />

                                                    <!-- PREV -->
                                                    <button @click="currentSlide--" x-show="currentSlide > 0"
                                                        class="absolute top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center"
                                                        style="left: 1rem;">
                                                        ◀
                                                    </button>

                                                    <!-- NEXT -->
                                                    <button @click="currentSlide++" x-show="currentSlide < totalSlides - 1"
                                                        class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center"
                                                        style="right: 7rem;">
                                                        ▶
                                                    </button>
                                                </div>

                                                <!-- CAPTION -->

                                            </div>
                                        </template>

                                    </div>

                                    <!-- DOTS -->
                                    <div class="flex justify-center gap-2 mt-3">
                                        <template x-for="(item, index) in images" :key="index">
                                            <button @click="currentSlide = index"
                                                :class="currentSlide === index ? 'bg-black' : 'bg-gray-400'"
                                                class="w-2 h-2 rounded-full"></button>
                                        </template>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="method-step border-b">
                        <div class="ms-num">2.</div>
                        <div class="">
                            <h4 class="chapter-title">Establish and apply instruments to control spatial plan
                                revisions
                            </h4><br>

                            <p class="body-text ">
                                In mid-2023, the public was surprised by a proposed revision to the spatial plan for
                                East Kalimantan Province, which would enable the release of 612,355 hectares of
                                forest
                                estate to become other land use (APL) areas, and downgrade the status of 101,788
                                hectares of forest estate to make it eligible for mining, despite at least 389,596
                                hectares <a href="https://www.youtube.com/watch?v=Mx4638DmEjI" class="text-[#bc4a3c]"
                                    target="_blank">(55%) of this area having natural forest
                                    cover</a>. Meanwhile,
                                several months earlier, the North Kalimantan Provincial Government had proposed a
                                spatial plan revision that would reclassify <a
                                    href="https://korankaltara.com/762-ribu-hektare-hutan-diusulkan-beralih-fungsi"
                                    class="text-[#bc4a3c]" target="_blank">762,000 hectares</a> of forest estate. In
                                Aceh, regional government maneuvering is expected to threaten the protected status
                                of
                                the Leuser Ecosystem Area, a designated biosphere reserve and buffer zone for Mount
                                Leuser National Park. These examples highlight the urgent need for instruments to
                                control regional spatial planning revisions, guaranteeing such processes are
                                transparent
                                and ensuring impacted parties are involved so that any revisions are only in the
                                public
                                interest.
                            </p>
                        </div>
                    </div>

                    <div class="method-steps">
                        <div class="border-b pt-0 pb-12">
                            <div class="method-step ">
                                <div class="ms-num">3.</div>
                                <div class="">
                                    <h4 class="chapter-title">Accelerate the expansion of preservation areas, especially
                                        outside
                                        the
                                        forest estate
                                    </h4><br>
                                    <p class="body-text">
                                        As noted above, existing conservation estates are far from sufficient to cover all
                                        conservation areas. At least 31,358 hectares of iconic species’ habitats and key
                                        biodiversity areas are located inside APL areas. The Ministry of Forestry’s weak
                                        conservation performance inside the forest estate necessitates new models for
                                        managing
                                        conservation areas. Conservation Law No. 32/2024 has opened space for this through
                                        its
                                        concept of preservation areas. However, the absence of any implementing regulation
                                        has
                                        meant
                                        such areas have yet to be realized. Therefore, the establishment of an implementing
                                        regulation should be expedited. Nevertheless, it should be underlined that such
                                        preservation
                                        areas should adopt new management models; for example, being managed by and for
                                        regional
                                        governments or local communities, with them being the recipients of any economic
                                        benefits,
                                        and coordination or supervision by the Ministry of Forestry.
                                    </p>
                                </div>
                            </div>

                            <div class="viz-block viz-block--full !mt-0 !pt-0 mb-2">
                                <div class="viz-frame !p-0 flex items-start">

                                    <div x-data="{
                                        currentSlide: 0,
                                        startX: 0,
                                        images: [{
                                            src: '{{ asset('assets/images/stadi2025/RUDP8 in.jpg') }}',
                                            desc: '<strong>There are at least 41.4 million hectares of ecologically important areas located outside conservation forest areas.</strong> These areas should be prioritized for preservation as stipulated in the Conservation Law.'
                                        }],
                                        get totalSlides() { return this.images.length },

                                        openLightbox(index) {
                                            GLightbox({
                                                elements: this.images.map(img => ({
                                                    href: img.src,
                                                    description: img.desc
                                                })),
                                                startAt: index
                                            }).open();
                                        },

                                        startSwipe(e) { this.startX = e.touches[0].clientX },
                                        handleTouchMove(e) {
                                            let diff = this.startX - e.touches[0].clientX
                                            if (Math.abs(diff) > 50) {
                                                if (diff > 0 && this.currentSlide < this.totalSlides - 1) this.currentSlide++
                                                else if (diff < 0 && this.currentSlide > 0) this.currentSlide--
                                                this.startX = e.touches[0].clientX
                                            }
                                        }
                                    }" @touchstart="startSwipe" @touchmove="handleTouchMove"
                                        class="relative max-w-4xl mx-auto overflow-hidden w-full">

                                        <!-- SLIDER -->
                                        <div class="flex " :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">

                                            <template x-for="(item, index) in images" :key="index">
                                                <div class="w-full flex-shrink-0">
                                                    <div class="max-w-3xl mx-auto px-12 sm:px-0 py-3 text-justify"
                                                        style="line-height: 1;">
                                                        <small style="font-size: 12px;" x-html="item.desc"></small>
                                                    </div>

                                                    <!-- GAMBAR -->
                                                    <div class="relative">
                                                        <img :src="item.src" @click="openLightbox(index)"
                                                            class="w-full object-contain h-[220px] sm:h-[60vh] cursor-pointer" />



                                                        <!-- CAPTION -->

                                                    </div>
                                            </template>

                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="border-b py-12">
                        <div class="method-step">
                            <div class="ms-num">4.</div>
                            <div class="">
                                <h4 class="chapter-title">Redistribute forest management institutions and personnel so that
                                    all natural forests have rangers to protect them</h4><br>
                                <p class="body-text">
                                    President Prabowo Subianto has reportedly instructed a doubling of the number of forest
                                    rangers – a step deserving of appreciation. However, as Auriga Nusantara has previously
                                    <a href="https://www.youtube.com/watch?v=fXpCyo4TrlU&t=7193s" class="text-[#bc4a3c]"
                                        target="_blank">outlined</a> to Commission IV of the Indonesian House of
                                    Representatives (DPR RI), forest protection personnel have tended to be concentrated on
                                    the island of Java. The same applies to budgeting, with allocations per hectare of
                                    forest estate being significantly higher in Java than elsewhere. Therefore, in addition
                                    to increasing personnel numbers – or redistributing authority and management functions
                                    to regional governments – there is also a need to redistribute personnel so that all
                                    remaining natural forest areas have rangers and associated budgets.
                                </p>
                            </div>
                        </div>

                        <div class="viz-block viz-block--full !mt-0 !pt-0 mb-2">
                            <div class="viz-frame !p-0 flex items-start">

                                <div x-data="{
                                    currentSlide: 0,
                                    startX: 0,
                                    images: [{
                                            src: '{{ asset('assets/images/stadi2025/RUDP6 in.jpg') }}',
                                            desc: '<strong> Forest protection budgets and personnel are concentrated on the island of Java.</strong> The budget available for managing one hectare of conservation forest outside national parks in Papua is only Rp 60,718 per hectare; in the Maluku Islands, Rp 82,374; in Kalimantan, Rp 361,395; in Sulawesi, Rp 530,208; in Sumatra, Rp 1,622,440; and in Bali and Nusa Tenggara, Rp 2,694,521. However, in Java, the budget per hectare is Rp 116,225,764.'
                                        },
                                        {
                                            src: '{{ asset('assets/images/stadi2025/RUDP7 in.jpg') }}',
                                            desc: '<strong> Forest protection budgets and personnel are concentrated on the island of Java.</strong> On average, each staff member at Lorentz National Park in Papua manages 38,548 hectares, while the budget available for management is Rp 6,707. Such a vast area per staff member, coupled with minimal budget availability, is relatively common across national parks outside Java. This stands in stark contrast, for example, to Gede Pangrango National Park, which has a budget of Rp 898,381 per hectare, with one staff member managing 157 hectares.'
                                        }
                                    ],
                                    get totalSlides() { return this.images.length },

                                    openLightbox(index) {
                                        GLightbox({
                                            elements: this.images.map(img => ({
                                                href: img.src,
                                                description: img.desc
                                            })),
                                            startAt: index
                                        }).open();
                                    },

                                    startSwipe(e) { this.startX = e.touches[0].clientX },
                                    handleTouchMove(e) {
                                        let diff = this.startX - e.touches[0].clientX
                                        if (Math.abs(diff) > 50) {
                                            if (diff > 0 && this.currentSlide < this.totalSlides - 1) this.currentSlide++
                                            else if (diff < 0 && this.currentSlide > 0) this.currentSlide--
                                            this.startX = e.touches[0].clientX
                                        }
                                    }
                                }" @touchstart="startSwipe" @touchmove="handleTouchMove"
                                    class="relative max-w-4xl mx-auto overflow-hidden w-full">

                                    <!-- SLIDER -->
                                    <div class="flex " :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">

                                        <template x-for="(item, index) in images" :key="index">
                                            <div class="w-full flex-shrink-0">

                                                <div class="max-w-3xl mx-auto px-12 sm:px-0 py-3 text-justify"
                                                    style="line-height: 1;">
                                                    <small style="font-size: 12px;" x-html="item.desc"></small>
                                                </div>

                                                <!-- GAMBAR -->
                                                <div class="relative">
                                                    <img :src="item.src" @click="openLightbox(index)"
                                                        class="w-full object-contain h-[220px] sm:h-[60vh] cursor-pointer" />

                                                    <!-- PREV -->
                                                   <button @click="currentSlide--" x-show="currentSlide > 0"
                                                    class="absolute top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center">
                                                    ◀
                                                    </button>

                                                    <!-- NEXT -->
                                                    <button @click="currentSlide++" x-show="currentSlide < totalSlides - 1"
                                                    class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-gray-300 text-black rounded-full flex items-center justify-center">
                                                    ▶
                                                    </button>
                                                </div>

                                                <!-- CAPTION -->

                                            </div>
                                        </template>

                                    </div>

                                    <!-- DOTS -->
                                    <div class="flex justify-center gap-2 mt-3">
                                        <template x-for="(item, index) in images" :key="index">
                                            <button @click="currentSlide = index"
                                                :class="currentSlide === index ? 'bg-black' : 'bg-gray-400'"
                                                class="w-2 h-2 rounded-full"></button>
                                        </template>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="method-step border-b">
                        <div class="ms-num">5.</div>
                        <div class="">
                            <h4 class="chapter-title">Companies that manage areas with natural forest cover should make
                                environmental, social, and good governance (ESG commitments) </h4><br>
                            <p class="body-text">
                                Nearly half of deforestation in 2025 occurred inside concession areas. Meanwhile there are
                                more than nine million hectares of natural forest cover remaining within conversion
                                concessions (mining, oil palm, industrial timber). Corporations managing these areas should
                                declare environmental, social, and good governance (ESG commitments), including not
                                perpetrating nor being involved in deforestation.
                            </p>
                        </div>
                    </div>
                    <div class="method-step border-b">
                        <div class="ms-num">6.</div>
                        <div class="">
                            <h4 class="chapter-title">Provide incentives for regional governments, local communities and
                                corporations that protect natural forest</h4><br>
                            <p class="body-text">Perlindungan hutan semestinya dipandang sebagai investasi, selain karena
                                Forest protection should be viewed as an investment, not only because forests provide
                                environmental services for the public, but also because economic activities will be
                                disrupted if the environment is degraded or does not function in the way it should.
                                Therefore, the state should provide incentives to those who protect forests, including local
                                communities, regional governments (provincial, regency, and village), and corporations. In
                                addition to incentives, economic benefits, such as carbon services, should also be
                                accessible to those protecting forests. Such incentives and benefits could serve as both a
                                stimulus for forest protection and a provider of financing for long-term protection efforts
                                by such parties.<span class="text-[#bc4a3c] text-2xl">●</span>
                            </p>
                        </div>
                    </div>
                </div>


                {{-- <hr class="divider"> --}}

                {{-- <div class="text-lg film-credit-block mx-auto">
                    <div class="ab-group">
                        <div class="ab-label">Authors</div>
                        <div class="ab-names">Timer Manurung, Dedy Sukmara, Andhika Younastya</div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-label">Data and processing</div>
                        <div class="ab-names">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika
                            Laura, Dedy
                            Sukmara, Jumrio Nakul, M. Alichamdan, M. Dendi Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno
                        </div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-label">Verification Team</div>
                        <div class="ab-names">Achmad Rafly Gymnastiar, Aditya Prima Yudha, Adzra Aqila Muthia, Andhika
                            Younastya,
                            Anggun Detrina Napitupulu, Annisa Meira Nurfauziah, Bagus Sugiarto, Cecilinia Tika Laura,
                            Chairul Soleh,
                            Dedi Septyadi Wibisono, Fadela Yunika Sari, Hafid Azi Darma, Jonathan, Jumrio Nakul, Jundy Zaky
                            Makarim,
                            Luhut Simanjutak, M. Dendi Alfitrah, M. Irfan Nurrahman, M. Irfandi Andriansyah, Muhammad Nabil
                            Astaqafi,
                            Nebo Yok Jonah Marpaung, Reza Fahlevi, Rianti Gina Violeta, Riszki Is Hardianto, Sulih Primara
                            Putra,
                            Supintri Yohar Tri Wahyuni, Valentina Yulia Permatasari, Wahyu Ananta Nugraha, Yanuar Vira
                            Febiyanti, Yudi
                            Nofiandi, Yustinus Seno, Zerin Darma Kusuma</div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-label">Accuracy Team</div>
                        <div class="ab-names">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Jumrio Nakul,
                            M. Dendi
                            Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno</div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-label">Creative Design</div>
                        <div class="ab-names">Robby Eebor, Tim Teknologi</div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-label">Technology Team</div>
                        <div class="ab-names">M. Alichamdan, M. Fachri, Thoriq Fa'iqoh</div>
                    </div>
                    <div class="ab-group">
                        <div class="ab-names">© Auriga Nusantara. 2026. <br><em>Status Deforestasi Indonesia 2025, diakses
                                pada
                                [DD/MM/YYYY] melalui tautan [LINK].
                                Auriga Nusantara. 2025 </em><br>.</div>
                    </div>
                </div> --}}

            </div>

        </section>
        <hr class="divider max-w-6xl mx-auto mt-[-60px] mb-5">
        <div class="max-w-6xl mx-auto text-center mb-[40px]">
            <p class="text-[13px]">
                <strong>AUTHOR</strong> Timer Manurung, Andhika Younastya, Dedy Sukmara, Yustinus Seno, Wahyu Ananta Nugraha, Dendi Alfitrah
                <strong>DATA PROCESSOR</strong> Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika Laura, Dedy Sukmara, Jumrio Nakul, M. Alichamdan, M. Dendi Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno
                <strong>VERIFICATION TEAM</strong> Achmad Rafly Gymnastiar, Aditya Prima Yudha, Adzra Aqila Muthia, Andhika Younastya, Anggun Detrina Napitupulu, Annisa Meira Nurfauziah, Bagus Sugiarto, Cecilinia Tika Laura, Chairul Soleh, Dedi Septyadi Wibisono, Fadela Yunika Sari, Hafid Azi Darma, Jonathan, Jumrio Nakul, Jundy Zaky Makarim, Luhut Simanjutak, M. Dendi Alfitrah, M. Irfan Nurrahman, M. Irfandi Andriansyah, Muhammad Nabil Astaqafi, Nebo Yok Jonah Marpaung, Reza Fahlevi, Rianti Gina Violeta, Riszki Is Hardianto, Sulih Primara Putra, Supintri Yohar Tri Wahyuni, Valentina Yulia Permatasari, Wahyu Ananta Nugraha, Yanuar Vira Febiyanti, Yudi Nofiandi, Yustinus Seno, Zerin Darma Kusuma
                <strong>ACCURACY TEAM</strong> Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Jumrio Nakul, M. Dendi Alfitrah, Wahyu Ananta Nugraha, Yustinus Seno
                <strong>CREATIVE DESIGN</strong> M. Alichamdan, M. Fachri, Robby Eebor, Thoriq Fa'iqoh
            </p>

            <p class="mt-4 text-[15px]">
                <strong>CITATION:</strong><br>
                Status deforestation in Indonesia 2025, accessed on [DD/MM/YYYY] via the link [LINK]. Auriga Nusantara. 2025
            </p>

            <p class="mt-2 text-[15px]">© Auriga Nusantara. 2026.</p>
        </div>
    @endsection


    @push('scripts')
        <script>
            (function() {
                function createLightbox(selectorID) {
                    const lightbox = GLightbox({
                        selector: selectorID,
                        touchNavigation: true,

                        openEffect: 'none',
                        closeEffect: 'none',
                        slideEffect: 'none'
                    });
                }
                for (let i = 1; i <= 21; i++) {
                    createLightbox(`.glightbox${i}`);
                }

                function hideLoader() {
                    var loader = document.getElementById('site-loader');
                    if (!loader) return;
                    // Reveal the sticky nav (CSS hides it by default via translateY)
                    try {
                        var nav = document.getElementById('sitenav');
                        if (nav) nav.classList.add('show');
                    } catch (e) {}

                    // Re-enable page scrolling (removed during preloading)
                    try {
                        document.body.classList.remove('is-preloading');
                    } catch (e) {}
                    try {
                        document.documentElement.style.overflow = '';
                        document.body.style.overflow = '';
                    } catch (e) {}

                    // Prevent the loader from blocking pointer events while it fades
                    try {
                        loader.style.pointerEvents = 'none';
                    } catch (e) {}

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
                            }, {
                                once: true
                            });
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
                    window.addEventListener('load', hideLoader, {
                        once: true
                    });
                }

                // Nav active links on scroll (sticky nav always visible)
                var navLinks = document.querySelectorAll('.nav-links a');
                var sectionIds = Array.from(navLinks).map(function(link) {
                    return link.getAttribute('href').replace('#', '');
                });
                var sections = sectionIds.map(function(id) {
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
                                navLinks.forEach(function(link) {
                                    link.classList.remove('active');
                                });
                                navLinks[i].classList.add('active');
                                found = true;
                                break;
                            }
                        }
                    }
                    if (!found) {
                        navLinks.forEach(function(link) {
                            link.classList.remove('active');
                        });
                    }

                    if (hero) {
                        var y = window.scrollY * 0.35;
                        hero.style.backgroundPosition = 'center calc(80% + ' + y + 'px)';
                    }
                }
                window.addEventListener('scroll', function() {
                    window.requestAnimationFrame(onScroll);
                });
                // Initial highlight + parallax position
                window.addEventListener('DOMContentLoaded', function() {
                    onScroll();
                });

                // --- Chart code injected from chart-deforestasi.html ---
                function buildDeforestationChart() {
                    var DATA = [{
                            year: 2001,
                            val: 133913
                        },
                        {
                            year: 2002,
                            val: 281030
                        },
                        {
                            year: 2003,
                            val: 253907
                        },
                        {
                            year: 2004,
                            val: 486010
                        },
                        {
                            year: 2005,
                            val: 483324
                        },
                        {
                            year: 2006,
                            val: 474863
                        },
                        {
                            year: 2007,
                            val: 533334
                        },
                        {
                            year: 2008,
                            val: 472889
                        },
                        {
                            year: 2009,
                            val: 691985
                        },
                        {
                            year: 2010,
                            val: 546069
                        },
                        {
                            year: 2011,
                            val: 621836
                        },
                        {
                            year: 2012,
                            val: 876456
                        },
                        {
                            year: 2013,
                            val: 523588
                        },
                        {
                            year: 2014,
                            val: 829144
                        },
                        {
                            year: 2015,
                            val: 768991
                        },
                        {
                            year: 2016,
                            val: 1055796
                        },
                        {
                            year: 2017,
                            val: 424048
                        },
                        {
                            year: 2018,
                            val: 389052
                        },
                        {
                            year: 2019,
                            val: 371087
                        },
                        {
                            year: 2020,
                            val: 307532
                        },
                        {
                            year: 2021,
                            val: 229982
                        },
                        {
                            year: 2022,
                            val: 230760
                        },
                        {
                            year: 2023,
                            val: 257384
                        },
                        {
                            year: 2024,
                            val: 261575
                        },
                        {
                            year: 2025,
                            val: 433751
                        },
                        {
                            year: 2026,
                            val: 0
                        },
                        {
                            year: 2027,
                            val: 0
                        },
                        {
                            year: 2028,
                            val: 0
                        }
                    ];

                    var MAX_VAL = Math.max.apply(null, DATA.map(function(d) {
                        return d.val;
                    }));
                    var AXIS_MAX = 1500000;
                    var TICK_STEP = AXIS_MAX <= 600000 ? 100000 : AXIS_MAX <= 1200000 ? 200000 : 400000;
                    var Y_TICKS = [];
                    for (var v = 0; v <= AXIS_MAX; v += TICK_STEP) Y_TICKS.push(v);

                    function fmt(v) {
                        return v.toLocaleString('id-ID');
                    }

                    var yAxis = document.getElementById('y-axis');
                    if (!yAxis) return;
                    yAxis.innerHTML = '';
                    Y_TICKS.forEach(function(t) {
                        var el = document.createElement('div');
                        el.className = 'y-tick text-[0.6rem] text-right pr-3 font-normal whitespace-nowrap';
                        el.style.color = '#8b7355';
                        el.textContent = t === 0 ? '0' : (t >= 1000000 ? (t / 1000000).toFixed(1).replace('.',
                            ',') + 'jt' : (t / 1000) + 'rb');
                        yAxis.appendChild(el);
                    });

                    var gridWrap = document.getElementById('grid-lines');
                    gridWrap.innerHTML = '';
                    Y_TICKS.forEach(function(t) {
                        var line = document.createElement('div');
                        line.className = 'grid-line absolute inset-x-0 h-[1px]';
                        line.style.background = 'rgba(139,115,85,0.18)';
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
                    xAxis.style.justifyItems = 'center';

                    DATA.forEach(function(d, i) {
                        var col = document.createElement('div');
                        col.className =
                            'bar-col flex flex-col items-center justify-end h-full cursor-pointer relative';
                        col.dataset.index = i;

                        var hoverBg = document.createElement('div');
                        hoverBg.style.cssText =
                            'position:absolute;inset:0;background:rgba(0,0,0,0.04);opacity:0;transition:opacity:.18s;pointer-events:none;';
                        col.appendChild(hoverBg);

                        var rect = document.createElement('div');
                        rect.className = 'bar-rect origin-bottom scale-y-0 transition-colors duration-150 relative';
                        var pct = (d.val / AXIS_MAX) * 130;
                        rect.style.cssText = 'width:100%;max-width:52px;min-width:3px;height:' + pct +
                            '%;background:#bc4a3c;' + (d.val === 0 ? 'visibility:hidden;' : '');

                        var barLabel = document.createElement('div');
                        barLabel.style.cssText =
                            'position:absolute;left:50%;transform:translateX(-50%);bottom:calc(' + pct +
                            '% + 6px);font-size:0.58rem;font-weight:700;color:#1a1a1a;white-space:nowrap;opacity:0;transition:opacity .18s;pointer-events:none;z-index:10;background:rgba(255,255,255,.92);border:1px solid rgba(0,0,0,.12);padding:2px 6px;border-radius:4px;box-shadow:0 1px 6px rgba(0,0,0,.1);';
                        if (d.val > 0) barLabel.textContent = fmt(d.val);
                        col.appendChild(barLabel);

                        col.appendChild(rect);
                        barsWrap.appendChild(col);
                        barEls.push({
                            col: col,
                            rect: rect,
                            hoverBg: hoverBg,
                            label: barLabel
                        });

                        var lbl = document.createElement('div');
                        lbl.className =
                            'x-label flex-1 text-[0.52rem] text-center font-normal writing-vertical-rl rotate-180 pt-1 ' +
                            (d.year % 4 === 1 ? 'font-semibold' : '');
                        lbl.style.color = d.year % 4 === 1 ? '#8b2a1a' : '#8b7355';
                        lbl.style.writingMode = 'vertical-rl';
                        if (d.val > 0) lbl.textContent = d.year;
                        xAxis.appendChild(lbl);
                    });

                    gsap.to(barEls.map(function(b) {
                        return b.rect;
                    }), {
                        scaleY: 1,
                        duration: 0.9,
                        ease: 'power3.out',
                        stagger: 0.045,
                        delay: 0.2
                    });

                    var PRESIDENTS = [{
                            name: 'Megawati',
                            start: 2001,
                            end: 2004,
                            photo: '/assets/images/presiden/meg.jpeg'
                        },
                        {
                            name: 'Susilo Bambang Yudhoyono',
                            start: 2005,
                            end: 2014,
                            photo: '/assets/images/presiden/sby.jpg'
                        },
                        {
                            name: 'Jokowi',
                            start: 2015,
                            end: 2024,
                            photo: '/assets/images/presiden/jok.jpeg'
                        },
                        {
                            name: 'Prabowo',
                            start: 2025,
                            end: 2028,
                            labelEnd: 2025,
                            photo: '/assets/images/presiden/pra.jpeg'
                        }
                    ];

                    function getPresident(year) {
                        return PRESIDENTS.find(function(p) {
                            return year >= p.start && year <= p.end;
                        }) || null;
                    }

                    function calcTotal(p) {
                        return DATA.filter(function(d) {
                            return d.year >= p.start && d.year <= p.end;
                        }).reduce(function(s, d) {
                            return s + d.val;
                        }, 0);
                    }

                    function fmtTotal(v) {
                        return (v / 1000000).toFixed(2).replace('.', ',') + ' jt';
                    }

                    var presStrip = document.getElementById('pres-strip');
                    presStrip.innerHTML = '';
                    var stripEls = [];

                    var barsWrapEl = document.getElementById('bars-wrap');
                    var totalYears = DATA.length;
                    var photoOverlayEls = [];

                    var isDesktop = window.innerWidth >= 768;
                    var ERA_COLORS = ['rgba(188,74,60,0.06)', 'rgba(188,74,60,0.09)', 'rgba(188,74,60,0.12)',
                        'rgba(188,74,60,0.18)'
                    ];

                    PRESIDENTS.forEach(function(p, pi) {
                        var total = calcTotal(p);
                        var yearCount = p.end - p.start + 1;
                        var startIdx = DATA.findIndex(function(d) {
                            return d.year === p.start;
                        });
                        var leftPct = (startIdx / totalYears) * 100;
                        var widthPct = (yearCount / totalYears) * 100;

                        // Era background shading inside chart (desktop only)
                        var eraBg = document.createElement('div');
                        if (isDesktop) {
                            eraBg.style.cssText = 'position:absolute;left:' + leftPct + '%;width:' + widthPct +
                                '%;top:0;bottom:48px;background:' + ERA_COLORS[pi] +
                                ';pointer-events:none;z-index:1;transition:background .3s;';
                            barsWrapEl.appendChild(eraBg);
                        }

                        // Photo + card: wrapped together so card sits to the right of photo
                        var photoWrap = document.createElement('div');
                        var el = document.createElement('div'); // strip card placeholder (hidden)
                        if (isDesktop) {
                            var photoOffset = p.name === 'Jokowi' ? (widthPct * 0.4) + '%' :
                                p.name === 'Susilo Bambang Yudhoyono' ? (widthPct * 0.5) + '%' :
                                '4px';
                            var presGroup = document.createElement('div');
                            presGroup.style.cssText = 'position:absolute;left:calc(' + leftPct + '% + ' +
                                photoOffset +
                                ');top:0;z-index:4;display:flex;flex-direction:row;align-items:flex-start;transform:translateX(' +
                                (p.name === 'Susilo Bambang Yudhoyono' ? '-50%' : '0') + ');';

                            photoWrap.style.cssText = 'pointer-events:none;transition:opacity .3s;flex-shrink:0;';
                            var img = document.createElement('img');
                            img.src = p.photo;
                            img.alt = p.name;
                            img.style.cssText =
                                'height:100px;width:auto;object-fit:cover;object-position:top center;display:block;';
                            img.onerror = function() {
                                this.style.display = 'none';
                            };
                            photoWrap.appendChild(img);

                            el.style.cssText =
                                'opacity:0;pointer-events:none;transition:opacity .25s;min-width:140px;padding:8px 10px;background:rgba(255,255,255,0.96);border-left:2px solid rgba(0,0,0,.1);box-shadow:4px 4px 16px rgba(0,0,0,.1);cursor:pointer;align-self:stretch;display:flex;flex-direction:column;justify-content:center;';
                            el.innerHTML =
                                '<div style="font-size:.72rem;font-weight:700;color:#1a1a1a;line-height:1.2;white-space:nowrap;margin-bottom:2px;">' +
                                p.name + '</div>' +
                                '<div style="font-size:.68rem;color:rgba(0,0,0,.4);margin-bottom:5px;white-space:nowrap;">' +
                                (p.start === (p.labelEnd || p.end) ? p.start : p.start + '\u2013' + (p.labelEnd || p
                                    .end)) + '</div>' +
                                '<div style="font-size:.88rem;font-weight:800;color:#8b2a1a;line-height:1;white-space:nowrap;">' +
                                total.toLocaleString('id-ID') + '</div>' +
                                '<div style="font-size:.58rem;color:#8b7355;margin-top:2px;white-space:nowrap;">hectares deforestation</div>';

                            presGroup.appendChild(photoWrap);
                            presGroup.appendChild(el);
                            barsWrapEl.appendChild(presGroup);
                        }
                        photoOverlayEls.push({
                            bg: eraBg,
                            photo: photoWrap,
                            idx: pi
                        });
                        el.dataset.presIdx = pi;
                        stripEls.push(el);

                        // Mobile strip item (always visible, with photo)
                        if (!isDesktop) {
                            var mel = document.createElement('div');
                            mel.dataset.mobile = '1';
                            mel.dataset.presIdx = pi;
                            mel.style.cssText =
                                'display:none;flex-direction:row;align-items:stretch;border-top:2px solid rgba(0,0,0,.1);transition:border-color .25s,opacity .25s;cursor:pointer;overflow:hidden;';
                            var mPhoto = document.createElement('img');
                            mPhoto.src = p.photo;
                            mPhoto.alt = p.name;
                            mPhoto.style.cssText =
                                'width:64px;flex-shrink:0;object-fit:cover;object-position:top center;display:block;';
                            mPhoto.onerror = function() {
                                this.style.display = 'none';
                            };
                            var mInfo = document.createElement('div');
                            mInfo.style.cssText =
                                'padding:10px 12px;display:flex;flex-direction:column;justify-content:center;min-width:0;';
                            mInfo.innerHTML =
                                '<div style="font-size:.72rem;font-weight:700;color:#1a1a1a;line-height:1.2;margin-bottom:2px;">' +
                                p.name + '</div>' +
                                '<div style="font-size:.58rem;color:rgba(0,0,0,.4);margin-bottom:5px;white-space:nowrap;">' +
                                (p.start === (p.labelEnd || p.end) ? p.start : p.start + '\u2013' + (p.labelEnd || p
                                    .end)) + '</div>' +
                                '<div style="font-size:.88rem;font-weight:800;color:#8b2a1a;line-height:1;white-space:nowrap;">' +
                                total.toLocaleString('id-ID') + '</div>' +
                                '<div style="font-size:.58rem;color:#8b7355;margin-top:2px;white-space:nowrap;">ha hilang</div>';
                            mel.appendChild(mPhoto);
                            mel.appendChild(mInfo);
                            presStrip.appendChild(mel);
                            stripEls.push(mel);
                        }
                    });

                    var activeEra = null;

                    function presName(i) {
                        return PRESIDENTS[parseInt(stripEls[i].dataset.presIdx)].name;
                    }

                    function setEra(name) {
                        activeEra = name;
                        barEls.forEach(function(item, i) {
                            var p = getPresident(DATA[i].year);
                            var match = p && p.name === name;
                            gsap.to(item.col, {
                                opacity: 1,
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                            item.rect.style.background = match ? '#8b2a1a' : '#d4c4a0';
                        });
                        stripEls.forEach(function(el, i) {
                            var match = presName(i) === name;
                            var isMobile = el.dataset.mobile === '1';
                            if (isMobile) {
                                el.style.display = match ? 'flex' : 'none';
                                el.style.borderTopColor = match ? '#8b2a1a' : 'rgba(0,0,0,.1)';
                            } else {
                                el.style.opacity = match ? '1' : '0';
                                el.style.pointerEvents = match ? 'auto' : 'none';
                                el.style.borderTopColor = match ? '#8b2a1a' : 'rgba(0,0,0,.1)';
                            }
                        });
                        photoOverlayEls.forEach(function(ov, i) {
                            ov.photo.style.opacity = PRESIDENTS[i].name === name ? '1' : '0.2';
                            ov.bg.style.background = PRESIDENTS[i].name === name ? 'rgba(139,42,26,0.1)' :
                                'rgba(0,0,0,0.02)';
                        });
                    }

                    function clearEra() {
                        activeEra = null;
                        barEls.forEach(function(item) {
                            gsap.to(item.col, {
                                opacity: 1,
                                duration: 0.3,
                                ease: 'power2.out'
                            });
                            item.rect.style.background = '#bc4a3c';
                        });
                        stripEls.forEach(function(el) {
                            var isMobile = el.dataset.mobile === '1';
                            if (isMobile) {
                                el.style.display = 'none';
                            } else {
                                el.style.opacity = '0';
                                el.style.pointerEvents = 'none';
                            }
                            el.style.borderTopColor = 'rgba(0,0,0,.1)';
                        });
                        photoOverlayEls.forEach(function(ov) {
                            ov.photo.style.opacity = '';
                            ov.bg.style.background = ERA_COLORS[ov.idx];
                        });
                    }

                    stripEls.forEach(function(el, i) {
                        el.addEventListener('click', function() {
                            var name = presName(i);
                            if (activeEra === name) clearEra();
                            else setEra(name);
                        });
                    });

                    barEls.forEach(function(item, i) {
                        item.col.addEventListener('mouseenter', function() {
                            gsap.to(item.rect, {
                                scaleY: 1.025,
                                transformOrigin: 'bottom center',
                                duration: .18,
                                ease: 'power1.out'
                            });
                            item.hoverBg.style.opacity = '1';
                            item.label.style.opacity = '1';
                            if (!activeEra) {
                                var hovPres = getPresident(DATA[i].year);
                                barEls.forEach(function(bi, ci) {
                                    bi.rect.style.background = hovPres && getPresident(DATA[ci]
                                            .year) && getPresident(DATA[ci].year).name === hovPres
                                        .name ? '#bc4a3c' : '#d4c4a0';
                                });
                                stripEls.forEach(function(el, ci) {
                                    var match = hovPres && presName(ci) === hovPres.name;
                                    var isMobile = el.dataset.mobile === '1';
                                    if (isMobile) {
                                        el.style.display = match ? 'flex' : 'none';
                                    } else {
                                        el.style.opacity = match ? '1' : '0';
                                        el.style.pointerEvents = match ? 'auto' : 'none';
                                    }
                                });
                                photoOverlayEls.forEach(function(ov, ci) {
                                    var match = hovPres && PRESIDENTS[ci].name === hovPres.name;
                                    ov.photo.style.opacity = match ? '1' : '0.15';
                                    ov.bg.style.background = match ? 'rgba(188,74,60,0.1)' :
                                        'rgba(0,0,0,0.02)';
                                });
                            }
                        });
                        item.col.addEventListener('mouseleave', function() {
                            gsap.to(item.rect, {
                                scaleY: 1,
                                duration: .22,
                                ease: 'power1.out'
                            });
                            item.hoverBg.style.opacity = '0';
                            item.label.style.opacity = '0';
                            if (!activeEra) {
                                barEls.forEach(function(bi) {
                                    bi.rect.style.background = '#bc4a3c';
                                });
                                stripEls.forEach(function(el) {
                                    var isMobile = el.dataset.mobile === '1';
                                    if (isMobile) {
                                        el.style.display = 'none';
                                    } else {
                                        el.style.opacity = '0';
                                        el.style.pointerEvents = 'none';
                                    }
                                });
                                photoOverlayEls.forEach(function(ov) {
                                    ov.photo.style.opacity = '';
                                    ov.bg.style.background = ERA_COLORS[ov.idx];
                                });
                            }
                        });
                        item.col.addEventListener('click', function() {
                            var pres = getPresident(DATA[i].year);
                            if (!pres) return;
                            if (activeEra === pres.name) clearEra();
                            else setEra(pres.name);
                        });
                    });

                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') clearEra();
                    });
                }

                function buildMonthlyChart() {
                    var MONTHLY_DATA = [{
                            month: 'Jan',
                            val: 2710
                        },
                        {
                            month: 'Feb',
                            val: 10367
                        },
                        {
                            month: 'Mar',
                            val: 29539
                        },
                        {
                            month: 'Apr',
                            val: 57982
                        },
                        {
                            month: 'Mei',
                            val: 75082
                        },
                        {
                            month: 'Jun',
                            val: 48351
                        },
                        {
                            month: 'Jul',
                            val: 34669
                        },
                        {
                            month: 'Agu',
                            val: 54847
                        },
                        {
                            month: 'Sep',
                            val: 33204
                        },
                        {
                            month: 'Okt',
                            val: 48364
                        },
                        {
                            month: 'Nov',
                            val: 19559
                        },
                        {
                            month: 'Des',
                            val: 19076
                        }
                    ];

                    var M_AXIS_MAX = 80000;
                    var M_TICK_STEP = 10000;
                    var M_TICKS = [];
                    for (var v = 0; v <= M_AXIS_MAX; v += M_TICK_STEP) M_TICKS.push(v);

                    function mFmt(v) {
                        return v.toLocaleString('id-ID');
                    }

                    var yAxis = document.getElementById('chart-monthly-yaxis');
                    if (!yAxis) return;
                    yAxis.innerHTML = '';
                    M_TICKS.forEach(function(t) {
                        var el = document.createElement('div');
                        el.className = 'text-[0.6rem] text-right pr-3 font-normal whitespace-nowrap';
                        el.style.color = '#8b7355';
                        el.textContent = t === 0 ? '0' : (t / 1000) + '.000';
                        yAxis.appendChild(el);
                    });

                    var gridWrap = document.getElementById('chart-monthly-grid');
                    gridWrap.innerHTML = '';
                    M_TICKS.forEach(function(t) {
                        var line = document.createElement('div');
                        line.className = 'absolute inset-x-0 h-[1px]';
                        line.style.cssText =
                            'background:rgba(139,115,85,0.18);position:absolute;left:0;right:0;bottom:' + ((t /
                                M_AXIS_MAX) * 100) + '%;';
                        gridWrap.appendChild(line);
                    });

                    var barsEl = document.getElementById('chart-monthly-bars');
                    var xAxisEl = document.getElementById('chart-monthly-xaxis');
                    barsEl.innerHTML = '';
                    xAxisEl.innerHTML = '';

                    var colsTemplate = 'repeat(' + MONTHLY_DATA.length + ', minmax(0, 1fr))';
                    barsEl.style.gridTemplateColumns = colsTemplate;
                    xAxisEl.style.gridTemplateColumns = colsTemplate;
                    xAxisEl.style.justifyItems = 'center';

                    var barRects = [];

                    MONTHLY_DATA.forEach(function(d) {
                        var pct = (d.val / M_AXIS_MAX) * 100;

                        var col = document.createElement('div');
                        col.className = 'relative flex flex-col items-center justify-end h-full';

                        // Static value label always shown above bar
                        var valLabel = document.createElement('div');
                        valLabel.style.cssText =
                            'font-size:0.58rem;font-weight:700;color:#1a1a1a;white-space:nowrap;text-align:center;margin-bottom:4px;line-height:1;';
                        valLabel.textContent = mFmt(d.val);
                        col.appendChild(valLabel);

                        var rect = document.createElement('div');
                        rect.className = 'origin-bottom scale-y-0 w-full';
                        rect.style.cssText = 'height:' + pct + '%;background:#bc4a3c;min-height:2px;max-width:46px';
                        col.appendChild(rect);

                        barsEl.appendChild(col);
                        barRects.push(rect);

                        var lbl = document.createElement('div');
                        lbl.className = 'text-[0.65rem] md:text-[0.72rem] font-semibold text-center';
                        lbl.style.color = '#8b2a1a';
                        lbl.textContent = d.month;
                        xAxisEl.appendChild(lbl);
                    });

                    // Use IntersectionObserver to trigger animation on scroll
                    var chartWrap = document.getElementById('chart-monthly-wrap');
                    if (!chartWrap) return;

                    function animateMonthly() {
                        if (typeof gsap !== 'undefined') {
                            gsap.to(barRects, {
                                scaleY: 1,
                                duration: 0.8,
                                ease: 'power3.out',
                                stagger: 0.06,
                                delay: 0.1
                            });
                        } else {
                            barRects.forEach(function(r) {
                                r.style.transform = 'scaleY(1)';
                            });
                        }
                    }

                    var obs = new IntersectionObserver(function(entries) {
                        if (entries[0].isIntersecting) {
                            animateMonthly();
                            obs.disconnect();
                        }
                    }, {
                        threshold: 0.2
                    });
                    obs.observe(chartWrap);
                }

                // ensure GSAP is loaded
                if (typeof gsap === 'undefined') {
                    var gsapScript = document.createElement('script');
                    gsapScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js';
                    gsapScript.onload = function() {
                        buildDeforestationChart();
                        buildMonthlyChart();
                    };
                    document.head.appendChild(gsapScript);
                } else {
                    buildDeforestationChart();
                    buildMonthlyChart();
                }

                function alurToggle(card) {
                    var desc = card.querySelector('.card-desc');
                    if (!desc) return;
                    var isHidden = desc.classList.contains('hidden');
                    var embed = document.getElementById('alur-embed');
                    if (embed) {
                        embed.querySelectorAll('.card-desc').forEach(function(d) {
                            d.classList.add('hidden');
                        });
                        embed.querySelectorAll('.card.active').forEach(function(c) {
                            c.classList.remove('active');
                        });
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
                    svg.setAttribute('style', 'position:absolute;top:0;left:0;width:' + dw + 'px;height:' + dh +
                        'px;pointer-events:none;overflow:visible;z-index:10;');

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
                    mk.appendChild(mkp);
                    defs.appendChild(mk);
                    svg.appendChild(defs);

                    // Returns position relative to #dwrap via offsetParent chain (scroll-independent).
                    // display:none elements return all-zero dimensions.
                    function getPos(el) {
                        var x = 0,
                            y = 0,
                            node = el;
                        while (node && node !== dwrap) {
                            x += node.offsetLeft;
                            y += node.offsetTop;
                            node = node.offsetParent;
                        }
                        return {
                            left: x,
                            top: y,
                            right: x + el.offsetWidth,
                            bottom: y + el.offsetHeight,
                            cx: x + el.offsetWidth / 2,
                            cy: y + el.offsetHeight / 2,
                            width: el.offsetWidth,
                            height: el.offsetHeight
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
                        if (pos.height > 0) return pos; // card is visible — use directly
                        // Card is hidden inside a collapsed row — fall back to row boundary
                        var row = el.closest('[id^="row"]');
                        if (!row) return null;
                        var lane = row.querySelector('.a-lane');
                        var rp = getPos(row);
                        var lp = lane ? getPos(lane) : rp;
                        return {
                            left: lp.left,
                            top: rp.top,
                            right: lp.right,
                            bottom: rp.bottom,
                            cx: lp.cx,
                            cy: rp.top + rp.height / 2,
                            width: lp.width,
                            height: rp.height,
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
                    (function() {
                        var fr = getAnchor('outmodel');
                        var tr = getAnchor('normcit');
                        if (!fr || !tr) return;
                        var rail = Math.min(Math.max(fr.right, tr.right) + 18, dw - 4);
                        var d = 'M' + fr.right + ',' + fr.cy +
                            ' L' + rail + ',' + fr.cy +
                            ' L' + rail + ',' + tr.cy +
                            ' L' + tr.right + ',' + tr.cy;
                        svg.appendChild(makePath(d));
                    })();

                    // ── Connector 2: Agregasi True Alert → Bounding Box
                    // Cubic bezier bowing right. When collapsed, lane-centre x + row boundary.
                    (function() {
                        var fr = getAnchor('agreg');
                        var tr = getAnchor('bbox');
                        if (!fr || !tr) return;
                        var dy = tr.top - fr.bottom;
                        var bow = Math.max(dy * 0.45, 30);
                        var cx1 = fr.cx + bow;
                        var cy1 = fr.bottom + dy * 0.25;
                        var cx2 = tr.cx + bow;
                        var cy2 = tr.top - dy * 0.25;
                        var d = 'M' + fr.cx + ',' + fr.bottom +
                            ' C' + cx1 + ',' + cy1 +
                            ' ' + cx2 + ',' + cy2 +
                            ' ' + tr.cx + ',' + tr.top;
                        svg.appendChild(makePath(d));
                    })();

                    // ── Connector 3: Data Deforestasi Indikatif → Overlay & Filter Area
                    // Straight vertical using source cx (both cards are leftmost in their rows).
                    (function() {
                        var fr = getAnchor('dataindikatif');
                        var tr = getAnchor('r4c1');
                        if (!fr || !tr) return;
                        var d = 'M' + fr.cx + ',' + fr.bottom +
                            ' L' + fr.cx + ',' + tr.top;
                        svg.appendChild(makePath(d));
                    })();

                    dwrap.appendChild(svg);
                }

                window.addEventListener('load', function() {
                    // rAF ensures layout is complete before measuring positions
                    requestAnimationFrame(function() {
                        requestAnimationFrame(drawAlurConnector);
                    });
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
                    tick.style.cssText =
                        'position:absolute;right:0;text-align:right;transform:translateY(-50%);font-family:Poppins,sans-serif;font-size:.52rem;font-weight:700;color:#1a1a1a;line-height:1;white-space:nowrap;';
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
                    bw.style.cssText =
                        'display:flex;flex-direction:column;align-items:center;justify-content:flex-end;flex:1;height:100%;opacity:0;transition:opacity .3s;';
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
                    lbl.style.cssText =
                        'flex:1;text-align:center;font-family:Poppins,sans-serif;font-size:.58rem;font-weight:700;color:#1a1a1a;line-height:1;opacity:0;transition:opacity .3s;';
                    lbl.textContent = String(PETA_YEARS[i]).slice(2);
                    xlabels.appendChild(lbl);
                });
            }

            const petaSelectedYears = new Set();
            let petaChartsOpen = false;

            function petaRevealBars(_, barOffset) {
                barOffset = barOffset || 0;
                const selected = Array.from(petaSelectedYears).sort((a, b) => a - b);
                PETA_ALL_ISLANDS.forEach((id, islandIdx) => {
                    const islandDelay = islandIdx * barOffset;
                    const barsWrap = document.getElementById('peta-bars-' + id);
                    const xlabelsWrap = document.getElementById('peta-xlabels-' + id);
                    // Hide all first
                    barsWrap.querySelectorAll('[data-baridx]').forEach(el => el.style.opacity = '0');
                    xlabelsWrap.querySelectorAll('[data-baridx]').forEach(el => el.style.opacity = '0');
                    // Show only selected indices with stagger
                    selected.forEach((j, order) => {
                        setTimeout(() => {
                            const bEl = barsWrap.querySelector('[data-baridx="' + j + '"]');
                            const lEl = xlabelsWrap.querySelector('[data-baridx="' + j + '"]');
                            if (bEl) bEl.style.opacity = '1';
                            if (lEl) lEl.style.opacity = '1';
                        }, islandDelay + order * 130);
                    });
                });
            }

            function petaSelectYear(idx) {
                const ghost = document.getElementById('peta-year-ghost');
                const wrap = document.getElementById('peta-charts-wrap');

                // Toggle selection
                if (petaSelectedYears.has(idx)) {
                    petaSelectedYears.delete(idx);
                } else {
                    petaSelectedYears.add(idx);
                }

                // Nothing selected → close everything
                if (petaSelectedYears.size === 0) {
                    petaChartsOpen = false;
                    document.querySelectorAll('#peta-bubbles .peta-bub').forEach(b => b.classList.remove('on'));
                    PETA_ALL_ISLANDS.forEach(id => {
                        document.getElementById('peta-chart-' + id).classList.add('hidden');
                        document.getElementById('peta-bars-' + id).querySelectorAll('[data-baridx]').forEach(el => el
                            .style.opacity = '0');
                        document.getElementById('peta-xlabels-' + id).querySelectorAll('[data-baridx]').forEach(el => el
                            .style.opacity = '0');
                    });
                    if (ghost) ghost.textContent = '2025';
                    if (wrap) wrap.classList.remove('peta-open');
                    return;
                }

                const maxIdx = Math.max(...petaSelectedYears);
                if (ghost) ghost.textContent = PETA_YEARS[maxIdx];

                // Update bubble active states
                document.querySelectorAll('#peta-bubbles .peta-bub').forEach((b, i) => b.classList.toggle('on',
                    petaSelectedYears.has(i)));

                // Update bar highlight states
                PETA_ALL_ISLANDS.forEach(id => {
                    document.querySelectorAll('#peta-bars-' + id + ' .peta-bar').forEach((bar, i) => {
                        bar.classList.toggle('hi', petaSelectedYears.has(i));
                    });
                });

                if (wrap) wrap.classList.add('peta-open');
                if (petaChartsOpen) {
                    petaRevealBars(maxIdx, 0);
                    return;
                }
                petaChartsOpen = true;
                PETA_ALL_ISLANDS.forEach((id, i) => {
                    setTimeout(() => document.getElementById('peta-chart-' + id).classList.remove('hidden'), i * 200);
                });
                petaRevealBars(maxIdx, 200);
            }

            document.addEventListener('DOMContentLoaded', () => {
                Object.keys(PETA_DATA).forEach(k => petaBuildBars(k, PETA_DATA[k]));
                // Select all years by default
                PETA_YEARS.forEach((_, i) => petaSelectYear(i));
                const totals = [229982, 230760, 257385, 261574, 433751];
                const minV = Math.min(...totals),
                    maxV = Math.max(...totals);
                const isMobile = window.innerWidth < 640;
                const minS = isMobile ? 50 : 54,
                    maxS = isMobile ? 48 : 90;
                document.querySelectorAll('#peta-bubbles .peta-bub').forEach((bub, i) => {
                    const t = (totals[i] - minV) / (maxV - minV);
                    const s = Math.round(minS + t * (maxS - minS));
                    bub.style.width = s + 'px';
                    bub.style.height = s + 'px';
                    const valEl = bub.querySelector('.b-val');
                    if (valEl) valEl.style.fontSize = (isMobile ? 0.48 : 0.78) + (t * (isMobile ? 0.22 :
                        0.46)) + 'rem';
                    const yrEl = bub.querySelector('.b-yr');
                    if (yrEl) yrEl.style.fontSize = (isMobile ? 0.42 : 0.60) + (t * (isMobile ? 0.06 : 0.14)) +
                        'rem';
                });
            });
        </script>

        <!-- PETA TEMATIK: Leaflet + Map JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-gesture-handling@1.2.2/dist/leaflet-gesture-handling.min.js"></script>
        <script>
            // ── peta-bg-map: decorative background Leaflet map ──
            (function() {
                var _isMobile = window.innerWidth < 640;
                var bgMap = L.map('peta-bg-map', {
                    zoomControl: false,
                    attributionControl: false,
                    dragging: false,
                    touchZoom: false,
                    doubleClickZoom: false,
                    scrollWheelZoom: false,
                    boxZoom: false,
                    keyboard: false,
                }).setView(_isMobile ? [-7.3, 118] : [-0.4, 119], _isMobile ? 3 : 3.5);
                L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
                    layers: 'proteus:POLITICAL_LEVEL_1_dissolved',
                    format: 'image/png',
                    transparent: true,
                }).addTo(bgMap);
            })();
        </script>
        <script>
            (function() {
                const isMobile = window.innerWidth < 640;
                const map = L.map('map', {
                    zoomControl: false,
                    attributionControl: false,
                    gestureHandling: true,
                    scrollWheelZoom: false,
                    doubleClickZoom: false,
                    minZoom: isMobile ? 0.1 : 4,
                    maxZoom: isMobile ? 3 : 9
                }).setView(isMobile ? [-7.3, 118] : [-3.4, 118], isMobile ? 3 : 5);

                L.tileLayer('', {
                    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
                    maxZoom: 19
                }).addTo(map);

                var wmsLayer = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
                    layers: 'proteus:POLITICAL_LEVEL_1_dissolved ',
                    format: 'image/png',
                    transparent: true
                }).addTo(map);

                // Custom panes so toggling choropleth layers is a single CSS display flip
                map.createPane('choroplethPane');
                map.getPane('choroplethPane').style.zIndex = 350;
                map.createPane('choroplethLabelPane');
                map.getPane('choroplethLabelPane').style.zIndex = 351;
                map.getPane('choroplethPane').style.display = 'none';
                map.getPane('choroplethLabelPane').style.display = 'none';
                map.createPane('kabupatenPane');
                map.getPane('kabupatenPane').style.zIndex = 352;
                map.createPane('kabupatenLabelPane');
                map.getPane('kabupatenLabelPane').style.zIndex = 353;
                map.getPane('kabupatenPane').style.display = 'none';
                map.getPane('kabupatenLabelPane').style.display = 'none';

                const stadi2025Layer = L.layerGroup().addTo(map);
                const choroplethLayer = L.layerGroup().addTo(map);
                const choroplethLabelLayer = L.layerGroup().addTo(map);
                const kabupatenLayer = L.layerGroup().addTo(map);
                const kabupatenLabelLayer = L.layerGroup().addTo(map);
                const markerLayer = L.layerGroup().addTo(map);
                const polygonLayer = L.layerGroup().addTo(map);
                const calloutLayer = {
                    clearLayers: () => {}
                };
                let markerRegistry = [];
                let activeMarker = null;
                let activeRow = null;
                let currentMode = 'provinsi';
                const activeModes = new Set();
                let currentKonsesiCat = null;
                const activeKonsesiCats = new Set();
                let activeEntry = null;
                let activePolygonSpecies = null;
                let stadi2025Loaded = false;
                let choroplethGeoLayer = null;
                let kabupatenGeoLayer = null;

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
                        bubble: {
                            label: 'Kabupaten lainnya (373)',
                            value: '131.258',
                            unit: 'hektare'
                        },
                        markers: [{
                                lat: -1.60615374,
                                lng: 113.416,
                                rank: 1,
                                name: 'Kalimantan Tengah',
                                value: '56.900',
                                dir: 'right'
                            },
                            {
                                lat: 0.45468874,
                                lng: 116.451,
                                rank: 2,
                                name: 'Kalimantan Timur',
                                value: '47.135',
                                dir: 'right'
                            },
                            {
                                lat: 4.22572873,
                                lng: 96.912,
                                rank: 3,
                                name: 'Aceh',
                                value: '38.157',
                                dir: 'right'
                            },
                            {
                                lat: -0.08652108,
                                lng: 111.121,
                                rank: 4,
                                name: 'Kalimantan Barat',
                                value: '31.876',
                                dir: 'left'
                            },
                            {
                                lat: -3.91073545,
                                lng: 136.624,
                                rank: 5,
                                name: 'Papua Tengah',
                                value: '26.978',
                                dir: 'left'
                            },
                            {
                                lat: -0.84851756,
                                lng: 100.465,
                                rank: 6,
                                name: 'Sumatera Barat',
                                value: '26.940',
                                dir: 'right'
                            },
                            {
                                lat: 2.18843942,
                                lng: 99.058,
                                rank: 7,
                                name: 'Sumatera Utara',
                                value: '20.512',
                                dir: 'right'
                            },
                            {
                                lat: 2.91502507,
                                lng: 116.246,
                                rank: 8,
                                name: 'Kalimantan Utara',
                                value: '19.716',
                                dir: 'right'
                            },
                            {
                                lat: 0.50874453,
                                lng: 101.815,
                                rank: 9,
                                name: 'Riau',
                                value: '17.812',
                                dir: 'left'
                            },
                            {
                                lat: -4.22893963,
                                lng: 139.454,
                                rank: 10,
                                name: 'Papua Pegunungan',
                                value: '16.468',
                                dir: 'left'
                            }
                        ],
                        dlUrl: 'https://simontini.id/assets/2025-data/provinsi.xlsx',

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
                        bubble: {
                            label: 'Kabupaten lainnya (373)',
                            value: '338.018',
                            unit: 'hektare'
                        },
                        markers: [{
                                lat: 1.908,
                                lng: 117.537,
                                rank: 1,
                                name: 'Berau',
                                value: '19.163',
                                dir: 'right'
                            },
                            {
                                lat: 0.87,
                                lng: 117.191,
                                rank: 2,
                                name: 'Kutai Timur',
                                value: '12.781',
                                dir: 'left'
                            },
                            {
                                lat: -1.314,
                                lng: 114.326,
                                rank: 3,
                                name: 'Kapuas',
                                value: '11.850',
                                dir: 'left'
                            },
                            {
                                lat: 0.808,
                                lng: 112.386,
                                rank: 4,
                                name: 'Kapuas Hulu',
                                value: '9.393',
                                dir: 'left'
                            },
                            {
                                lat: -1.314,
                                lng: 113.074,
                                rank: 5,
                                name: 'Katingan',
                                value: '8.934',
                                dir: 'left'
                            },
                            {
                                lat: -1.251,
                                lng: 131.34,
                                rank: 6,
                                name: 'Sorong',
                                value: '7.168',
                                dir: 'right'
                            },
                            {
                                lat: -0.236,
                                lng: 114.48,
                                rank: 7,
                                name: 'Murung Raya',
                                value: '7.140',
                                dir: 'bottom'
                            },
                            {
                                lat: -7.88,
                                lng: 140.237,
                                rank: 8,
                                name: 'Merauke',
                                value: '6.557',
                                dir: 'top'
                            },
                            {
                                lat: -1.108,
                                lng: 113.541,
                                rank: 9,
                                name: 'Gunung Mas',
                                value: '6.539',
                                dir: 'bottom'
                            },
                            {
                                lat: 2.686,
                                lng: 117.22,
                                rank: 10,
                                name: 'Bulungan',
                                value: '6.208',
                                dir: 'right'
                            }
                        ],
                        tables: [],
                        dlUrl: 'https://simontini.id/assets/2025-data/kabupaten.xlsx'
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
                        dlUrl: 'https://simontini.id/assets/2025-data/konservasi.xlsx',
                        bubble: {
                            label: 'konservasi lainnya (373)',
                            value: '7.924',
                            unit: 'hektare'
                        },

                        markers: [{
                                lat: -2.33,
                                lng: 101.684,
                                rank: 1,
                                name: 'TN Kerinci Seblat',
                                value: '6.362',
                                dir: 'left'
                            },
                            {
                                lat: -4.244,
                                lng: 140.255,
                                rank: 2,
                                name: 'SM Pegunungan Jayawijaya',
                                value: '3.210',
                                dir: 'right'
                            },
                            {
                                lat: 3.744,
                                lng: 97.703,
                                rank: 3,
                                name: 'TN Gunung Leuser',
                                value: '1.379',
                                dir: 'left'
                            },
                            {
                                lat: 4.423,
                                lng: 97.159,
                                rank: 4,
                                name: 'TB Lingga Isaq',
                                value: '1.199',
                                dir: 'left'
                            },
                            {
                                lat: -3.757,
                                lng: 136.263,
                                rank: 5,
                                name: 'CA Enarotali',
                                value: '1.049',
                                dir: 'right'
                            },
                            {
                                lat: -2.84,
                                lng: 138.797,
                                rank: 6,
                                name: 'SM Mamberamo Foja',
                                value: '950',
                                dir: 'right'
                            },
                            {
                                lat: -4.223,
                                lng: 138.023,
                                rank: 7,
                                name: 'TN Lorentz',
                                value: '889',
                                dir: 'right'
                            },
                            {
                                lat: -1.15,
                                lng: 133.295,
                                rank: 8,
                                name: 'CA Pegunungan Tamrau Selatan',
                                value: '796',
                                dir: 'right'
                            },
                            {
                                lat: -0.819,
                                lng: 101.211,
                                rank: 9,
                                name: 'CA Batang Pangean I',
                                value: '779',
                                dir: 'left'
                            },
                            {
                                lat: -0.352,
                                lng: 101.105,
                                rank: 10,
                                name: 'SM Bukit Rimbang Bukit Baling',
                                value: '539',
                                dir: 'left'
                            }
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
                        species: [{
                                lokal: 'Harimau Sumatra',
                                lat: 3.4,
                                lng: 94.2,
                                icon: '🐅',
                                image: '/assets/images/satwa/image.png',
                                name: 'Panthera tigris sumatrae',
                                value: '78.049 hektare',
                                dir: 'left',
                                geojsonUrl: '/geojson/def_harimau.json'
                            },
                            {
                                lokal: 'Gajah Sumatra',
                                lat: -0.38,
                                lng: 96.0,
                                icon: '🐘',
                                image: '/assets/images/satwa/image-2.png',
                                name: 'Elephas maximus sumatranus',
                                value: '25.301',
                                dir: 'left',
                                geojsonUrl: '/geojson/def_gajah.json'
                            },
                            {
                                lokal: 'Badak Sumatra',
                                lat: -6.2,
                                lng: 101.7,
                                icon: '🦏',
                                image: '/assets/images/satwa/image-3.png',
                                name: 'Dicerorhinus sumatrensis sumatrensis',
                                value: '18.477',
                                dir: 'left',
                                geojsonUrl: '/geojson/def_Dicerorhinus_Sumatrensis.json'
                            },
                            {
                                lokal: 'Orangutan Tapanuli',
                                lat: 5.7,
                                lng: 98.2,
                                icon: '🦧',
                                image: '/assets/images/satwa/image-4.png',
                                name: 'Pongo tapanuliensis',
                                value: '505',
                                dir: 'right',
                                geojsonUrl: '/geojson/def_pongo_tapanuliensis.json'
                            },
                            {
                                lokal: 'Orangutan Sumatra',
                                lat: 1.0,
                                lng: 102.6,
                                icon: '🦧',
                                image: '/assets/images/satwa/image-5.png',
                                name: 'Pongo abelii',
                                value: '16.519',
                                dir: 'right',
                                geojsonUrl: '/geojson/def_pongo_abelii.json'
                            },
                            {
                                lokal: 'Orangutan Kalimantan',
                                lat: 3.5,
                                lng: 111.5,
                                icon: '🦧',
                                image: '/assets/images/satwa/image-6.png',
                                name: 'Pongo pygmaeus',
                                value: '66.890',
                                dir: 'left',
                                geojsonUrl: '/geojson/def_pongo_pygmaeus.json'
                            },
                            {
                                lokal: 'Badak Kalimantan',
                                lat: 2.5,
                                lng: 121.5,
                                icon: '🦏',
                                image: '/assets/images/satwa/image-7.png',
                                name: 'Dicerorhinus sumatrensis harrissoni',
                                value: '3.057',
                                dir: 'right',
                                geojsonUrl: '/geojson/def_Dicerorhinus_Sumatrensis_Harrissoni.json'
                            }
                        ],
                        tables: [],
                        dlUrl: ''
                    },

                    konsesi: {
                        kpiLabel: 'Pilih kategori konsesi',
                        kpiVal: '—',
                        kpiUnit: 'hektare',
                        notesSidebar: ['Pilih kategori konsesi di atas untuk melihat data.',
                            'Menampilkan 10 konsesi teratas per kategori.'
                        ],
                        notesBox: [''],
                        markers: [],
                        tables: [],
                        subCategories: {
                            'kebun-kayu': {
                                title: 'Konsesi Kebun Kayu',
                                kpiLabel: 'Total 10 teratas (kebun kayu)',
                                kpiVal: '11.265',
                                othersLabel: '202 izin Lainnya',
                                othersVal: '21.799',
                                bullets: [''],
                                geojsonFile: '/geojson/kebun-kayu.geojson',
                                dlUrl: 'https://simontini.id/assets/2025-data/kebun-kayu.xlsx',
                                markers: [{
                                        lat: 2.17,
                                        lng: 117.521,
                                        rank: 1,
                                        name: 'PT TANJUNG REDEB HUTANI',
                                        value: 1408,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 0.394,
                                        lng: 110.954,
                                        rank: 2,
                                        name: 'PT FINNANTARA INTIGA',
                                        value: 1341,
                                        dir: 'left'
                                    },
                                    {
                                        lat: 0.417,
                                        lng: 116.378,
                                        rank: 3,
                                        name: 'PT MAHAKARYA PERDANA GEMILANG UNIT II',
                                        value: 1324,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 0.527,
                                        lng: 117.221,
                                        rank: 4,
                                        name: 'PT DIVA PERDANA PESONA',
                                        value: 1296,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -1.333,
                                        lng: 114.131,
                                        rank: 5,
                                        name: 'PT BUMI HIJAU PRIMA',
                                        value: 1294,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -1.974,
                                        lng: 111.138,
                                        rank: 6,
                                        name: 'PT GRACE PUTRI PERDANA',
                                        value: 1171,
                                        dir: 'left'
                                    },
                                    {
                                        lat: 1.858,
                                        lng: 117.738,
                                        rank: 7,
                                        name: 'PT HUTAN BERAU LESTARI',
                                        value: 1097,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 0.056,
                                        lng: 115.924,
                                        rank: 8,
                                        name: 'PT SENDAWAR ADHI KARYA',
                                        value: 1019,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 1.354,
                                        lng: 118.134,
                                        rank: 9,
                                        name: 'PT SWADAYA PERKASA',
                                        value: 662,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 1.4,
                                        lng: 101.685,
                                        rank: 10,
                                        name: 'PT SEKATO PRATAMA MAKMUR',
                                        value: 652,
                                        dir: 'bottom'
                                    }
                                ]
                            },
                            'logging': {
                                title: 'Konsesi Logging',
                                kpiLabel: 'Total 10 teratas (logging)',
                                kpiVal: '20.749',
                                othersLabel: '227 izin Lainnya',
                                othersVal: '53.661',
                                bullets: [''],
                                geojsonFile: '/geojson/logging.geojson',
                                dlUrl: 'https://simontini.id/assets/2025-data/logging.xlsx',
                                markers: [{
                                        lat: 0.881264893236657,
                                        lng: 117.026904047300249,
                                        rank: 1,
                                        name: 'PT KIANI LESTARI',
                                        value: 3739,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -1.252358059458737,
                                        lng: 114.487610383463576,
                                        rank: 2,
                                        name: 'PT DASA INTIGA',
                                        value: 3195,
                                        dir: 'left'
                                    },
                                    {
                                        lat: 2.098063545278295,
                                        lng: 101.015865352762475,
                                        rank: 3,
                                        name: 'PT DIAMOND RAYA TIMBER',
                                        value: 2741,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -3.017296513002015,
                                        lng: 101.832872347710747,
                                        rank: 4,
                                        name: 'PT ANUGERAH PRATAMA INSPIRASI',
                                        value: 2211,
                                        dir: 'bottom'
                                    },
                                    {
                                        lat: -0.75146963045224,
                                        lng: 116.510730877588813,
                                        rank: 5,
                                        name: 'PT ITCI KARTIKA UTAMA (ITCIKU)',
                                        value: 1902,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 2.028798962469609,
                                        lng: 117.080426147312622,
                                        rank: 6,
                                        name: 'PT INHUTANI I UNIT LABANAN',
                                        value: 1688,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -3.502650172817841,
                                        lng: 135.621210438578998,
                                        rank: 7,
                                        name: 'PT JATI DHARMA INDAH PLYWOOD INDUSTRIES',
                                        value: 1415,
                                        dir: 'bottom'
                                    },
                                    {
                                        lat: 2.474287034103671,
                                        lng: 117.210276665613563,
                                        rank: 8,
                                        name: 'PT INHUTANI I UNIT SAMBARATA',
                                        value: 1330,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -1.051472046229932,
                                        lng: 113.055533404223866,
                                        rank: 9,
                                        name: 'PT DWIMA JAYA UTAMA',
                                        value: 1267,
                                        dir: 'top'
                                    },
                                    {
                                        lat: 1.288242736097689,
                                        lng: 99.580298186802281,
                                        rank: 10,
                                        name: 'PT BARUMUN RAYA PADANG LANGKAT',
                                        value: 1260,
                                        dir: 'left'
                                    }
                                ]
                            },
                            'sawit': {
                                title: 'Konsesi Sawit',
                                kpiLabel: 'Total 10 teratas (sawit)',
                                kpiVal: '13.610',
                                othersLabel: '709 izin Lainnya',
                                othersVal: '24.300',
                                bullets: [''],
                                geojsonFile: '/geojson/sawit.geojson',
                                dlUrl: 'https://simontini.id/assets/2025-data/sawit.xlsx',
                                markers: [{
                                        lat: -1.163,
                                        lng: 131.378,
                                        rank: 1,
                                        name: 'Inti Kebun Lestari',
                                        value: 2624,
                                        dir: 'top'
                                    },
                                    {
                                        lat: 0.679,
                                        lng: 121.502,
                                        rank: 2,
                                        name: 'Banyan Tumbuh Lestari',
                                        value: 2094,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -1.316,
                                        lng: 131.233,
                                        rank: 3,
                                        name: 'Inti Kebun Sejahtera',
                                        value: 2053,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -7.918,
                                        lng: 140.71,
                                        rank: 4,
                                        name: 'Merauke Sawit Jaya',
                                        value: 1808,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -1.391,
                                        lng: 131.193,
                                        rank: 5,
                                        name: 'Papua Lestari Abadi',
                                        value: 1300,
                                        dir: 'right'
                                    },
                                    {
                                        lat: 0.868,
                                        lng: 112.804,
                                        rank: 6,
                                        name: 'Borneo International Anugerah',
                                        value: 877,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -1.673,
                                        lng: 113.417,
                                        rank: 7,
                                        name: 'Agro Kalimantan Lestari',
                                        value: 784,
                                        dir: 'left'
                                    },
                                    {
                                        lat: 1.229,
                                        lng: 118.277,
                                        rank: 8,
                                        name: 'Anugrah Surya Mandiri',
                                        value: 713,
                                        dir: 'top'
                                    },
                                    {
                                        lat: 0.996,
                                        lng: 112.031,
                                        rank: 9,
                                        name: 'Khatulistiwa Agro Abadi',
                                        value: 682,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -0.191,
                                        lng: 104.85,
                                        rank: 10,
                                        name: 'Citra Sugi Aditya',
                                        value: 676,
                                        dir: 'bottom'
                                    }
                                ]
                            },
                            'tambang': {
                                title: 'Konsesi Tambang',
                                kpiLabel: 'Total 10 teratas (tambang)',
                                kpiVal: '8.929',
                                othersLabel: '1.131 izin Lainnya',
                                othersVal: '32.233',
                                bullets: [''],
                                geojsonFile: '/geojson/tambang.geojson',
                                dlUrl: 'https://simontini.id/assets/2025-data/tambang.xlsx',
                                markers: [{
                                        lat: 2.09,
                                        lng: 117.323,
                                        rank: 1,
                                        name: 'Berau Coal (Batubara)',
                                        value: 1473,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -3.013,
                                        lng: 121.841,
                                        rank: 2,
                                        name: 'Sulawesi Cahaya Mineral (Nikel)',
                                        value: 1085,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -0.102,
                                        lng: 114.889,
                                        rank: 3,
                                        name: 'Maruwai Coal (Batubara)',
                                        value: 920,
                                        dir: 'top'
                                    },
                                    {
                                        lat: 0.64,
                                        lng: 127.99,
                                        rank: 4,
                                        name: 'Weda Bay Nickel (Nikel)',
                                        value: 902,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -2.633,
                                        lng: 121.621,
                                        rank: 5,
                                        name: 'Vale Indonesia TBK (Nikel)',
                                        value: 842,
                                        dir: 'left'
                                    },
                                    {
                                        lat: 1.109,
                                        lng: 99.205,
                                        rank: 6,
                                        name: 'Agincourt Resources (Emas)',
                                        value: 840,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -0.278,
                                        lng: 114.902,
                                        rank: 7,
                                        name: 'Lahai Coal (Batubara)',
                                        value: 770,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -1.537,
                                        lng: 112.523,
                                        rank: 8,
                                        name: 'Blok Waringin Agung (Emas)',
                                        value: 764,
                                        dir: 'right'
                                    },
                                    {
                                        lat: -1.068,
                                        lng: 114.624,
                                        rank: 9,
                                        name: 'Suprabari Mapanindo Mineral',
                                        value: 673,
                                        dir: 'left'
                                    },
                                    {
                                        lat: -2.891,
                                        lng: 122.045,
                                        rank: 10,
                                        name: 'Bintang Delapan Mineral (Nikel)',
                                        value: 659,
                                        dir: 'bottom'
                                    }
                                ]
                            }
                        }
                    }
                };

                function clearModeVisuals() {
                    markerLayer.clearLayers();
                    polygonLayer.clearLayers();
                    // Instantly hide/show choropleth layers via CSS pane display — zero DOM traversal.
                    // Kabupaten overrides provinsi: hide provinsi pane when kabupaten is active
                    if (!activeModes.has('provinsi') || activeModes.has('kabupaten')) {
                        map.getPane('choroplethPane').style.display = 'none';
                        map.getPane('choroplethLabelPane').style.display = 'none';
                    }
                    if (!activeModes.has('kabupaten')) {
                        map.getPane('kabupatenPane').style.display = 'none';
                        map.getPane('kabupatenLabelPane').style.display = 'none';
                    }
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

                function registerMarker(entry) {
                    markerRegistry.push(entry);
                }

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
                    if (rowEl) {
                        clearActiveRow();
                        rowEl.classList.add('active-row');
                        activeRow = rowEl;
                    }
                    setActiveMarker(found.marker);
                    const satwaBadges = document.getElementById('satwa-badges');
                    const isSatwaActive = currentMode === 'megafauna' && satwaBadges && satwaBadges.classList.contains(
                        'has-active');
                    if (!isSatwaActive) {
                        map.flyTo(found.marker.getLatLng(), Math.max(map.getZoom(), 6), {
                            duration: 0.6
                        });
                    }
                    setTimeout(() => showCallout(found), 260);
                }

                function buildPopupHtml(entry) {
                    const item = entry.item;
                    const unitMap = {
                        provinsi: 'hektare',
                        kabupaten: 'hektare',
                        konservasi: 'hektare',
                        megafauna: 'hektare habitat terdampak'
                    };
                    const tagMap = {
                        provinsi: 'provinsi',
                        kabupaten: 'kabupaten',
                        konservasi: 'kawasan konservasi',
                        megafauna: 'megafauna'
                    };
                    const unit = unitMap[entry.mode] || 'hektare';
                    const rank = entry.kind !== 'species' ? `<div class="popup-rank"></div>` :
                        `<div class="popup-rank">Megafauna ikonik</div>`;
                    return `<div class="popup-inner">${rank}<div class="popup-name">${item.name}</div><div class="popup-val">${item.value}</div><div class="popup-unit">${unit}</div></div>`;
                }

                function showCallout(entry) {
                    if (!entry) return;
                    activeEntry = entry;
                    setActiveMarker(entry.marker);
                    entry.marker.setPopupContent(buildPopupHtml(entry));
                    entry.marker.openPopup();
                }

                function createRankMarker(item, modeOverride) {
                    const mode = modeOverride || currentMode;
                    const dotColors = {
                        provinsi: '#c04030',
                        kabupaten: '#e07840',
                        konservasi: '#4a8c5c',
                        megafauna: '#7060b0'
                    };
                    const catColors = {
                        'kebun-kayu': '#b06020',
                        logging: '#c04030',
                        sawit: '#4a8c5c',
                        tambang: '#7060b0'
                    };
                    const color = mode === 'konsesi' ? (catColors[item.cat] || '#b06020') : (dotColors[mode] || '#8b2a1a');
                    const icon = L.divIcon({
                        className: '',
                        html: `<div class="rank-dot" style="background:${color};box-shadow:0 2px 8px ${color}88">${item.rank}</div>`,
                        iconSize: [28, 28],
                        iconAnchor: [14, 14]
                    });
                    const marker = L.marker([item.lat, item.lng], {
                        icon
                    }).addTo(markerLayer);
                    const entry = {
                        name: item.name,
                        marker,
                        value: item.value,
                        mode,
                        item,
                        kind: 'rank'
                    };
                    marker.bindPopup('', {
                        closeButton: true,
                        maxWidth: 280,
                        minWidth: 190
                    });
                    marker.on('mouseover', () => setActiveMarker(marker));
                    marker.on('mouseout', () => {
                        if (!activeEntry || activeEntry.marker !== marker) setActiveMarker(null);
                    });
                    marker.on('click', () => {
                        showCallout(entry);
                        clearActiveRow();
                    });
                    registerMarker(entry);
                }

                function createSpeciesMarker(item) {
                    const icon = L.divIcon({
                        className: '',
                        html: '<div style="display:none;"></div>',
                        iconSize: [0, 0],
                        iconAnchor: [0, 0]
                    });
                    const marker = L.marker([item.lat, item.lng], {
                        icon
                    }).addTo(markerLayer);
                    const entry = {
                        name: item.name,
                        marker,
                        value: item.value,
                        mode: currentMode,
                        item,
                        kind: 'species'
                    };
                    marker.on('click', () => {
                        showCallout(entry);
                        clearActiveRow();
                    });
                    registerMarker(entry);
                    createSatwaBadge(item, entry);
                }

                function createSatwaBadge(item, entry) {
                    const badgesContainer = document.getElementById('satwa-badges');
                    const badge = document.createElement('div');
                    badge.className = 'satwa-badge';
                    badge.dataset.species = item.name;
                    const shortName = item.name.split(' ').slice(-2).join(' ');
                    badge.innerHTML =
                        `
                                                                                                                                                                          <div class="satwa-badge-circle"><img src="${item.image || ''}" alt="${item.name}"></div>
                                                                                                                                                                          <div class="satwa-badge-name" title="${item.name}">${shortName}</div>
                                                                                                                                                                          <div class="satwa-badge-detail">
                                                                                                                                                                          <span class="si-name">${item.name}</span>
                                                                                                                                                                          <span class="si-val">${item.value}</span>
                                                                                                                                                                          <span class="si-val">${item.lokal}</span>
                                                                                                                                                                          <span class="si-unit">deforestasi di habitat</span>
                                                                                                                                                                          </div>
                                                                                                                                                                      `;
                    badge.addEventListener('click', async (e) => {
                        e.stopPropagation();
                        const isActive = badge.classList.contains('active');
                        document.querySelectorAll('.satwa-badge.active').forEach(b => b.classList.remove(
                            'active'));
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
                                L.geoJSON(item.geojson, {
                                    style: {
                                        color: '#bc4a3c',
                                        weight: 1,
                                        opacity: 0.85,
                                        fillColor: '#bc4a3c',
                                        fillOpacity: 1
                                    }
                                }).addTo(polygonLayer);
                            }
                        } else {
                            map.closePopup();
                        }
                    });
                    badgesContainer.appendChild(badge);
                    return {
                        badge,
                        entry
                    };
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
                    tbl.headers.forEach(h => {
                        const th = document.createElement('th');
                        th.textContent = h;
                        hr.appendChild(th);
                    });
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

                function renderAllSidebarCards() {
                    const wrap = document.getElementById('sidebar-table-wrap');
                    const lbl = document.getElementById('sidebar-mode-label');
                    if (!wrap) return;
                    wrap.innerHTML = '';
                    const modeNames = {
                        provinsi: 'Province',
                        kabupaten: 'Regency',
                        konservasi: 'Conservation Area',
                        megafauna: 'Megafauna',
                        konsesi: 'Concession'
                    };
                    const catNames = {
                        'kebun-kayu': 'Kebun Kayu',
                        logging: 'Logging',
                        sawit: 'Sawit',
                        tambang: 'Mining'
                    };
                    if (activeModes.size === 0) {
                        if (lbl) lbl.textContent = '—';
                        return;
                    }
                    if (lbl) lbl.textContent = [...activeModes].map(mk => modeNames[mk] || mk).join(', ');

                    const countRows = (markers, totalVal, othersVal) => {
                        let n = (markers?.length || 0);
                        if (totalVal) n += 1;
                        if (othersVal) n += 1;
                        return n;
                    };

                    let maxVisibleRows = 0;
                    [...activeModes].forEach(modeKey => {
                        if (modeKey === 'konsesi') {
                            activeKonsesiCats.forEach(ck => {
                                const c = MODES.konsesi.subCategories[ck];
                                if (c) maxVisibleRows = Math.max(maxVisibleRows, countRows(c.markers || [],
                                    c.kpiVal, c.othersVal || null));
                            });
                            return;
                        }
                        const mode = MODES[modeKey];
                        if (!mode) return;
                        maxVisibleRows = Math.max(maxVisibleRows, countRows(mode.markers || mode.species || [], mode
                            .kpiVal || null, mode.bubble?.value || null));
                    });

                    function appendSidebarCard(heading, markers, totalVal, othersVal, targetRows = 0, dlUrl = '') {
                        if (!markers || !markers.length) return;
                        const card = document.createElement('div');
                        card.className = 'sb-card';
                        const head = document.createElement('div');
                        head.className = 'sb-card-head';
                        head.innerHTML =
                            `<span class="sb-card-head-title">${heading}</span><span class="sb-card-head-badge">TOP 10</span>`;
                        card.appendChild(head);
                        const table = document.createElement('table');
                        table.className = 'stbl';
                        const formattedVals = markers.map(m => {
                            const raw = m.value;
                            const num = typeof raw === 'number' ? raw : parseFloat(String(raw).replace(/\./g, '')
                                .replace(',', '.'));
                            return isNaN(num) ? String(raw) : num.toLocaleString('id-ID');
                        });
                        const maxValLen = Math.max(
                            5,
                            ...formattedVals.map(v => String(v).length),
                            String(totalVal || '').length,
                            String(othersVal || '').length
                        );
                        const valueColCh = Math.max(7, Math.min(14, maxValLen + 1));
                        table.style.setProperty('--val-col', `${valueColCh}ch`);

                        const colgroup = document.createElement('colgroup');
                        const colName = document.createElement('col');
                        colName.className = 'stbl-col-name';
                        const colVal = document.createElement('col');
                        colVal.className = 'stbl-col-val';
                        colgroup.appendChild(colName);
                        colgroup.appendChild(colVal);
                        table.appendChild(colgroup);
                        const thead = document.createElement('thead');
                        const trH = document.createElement('tr');
                        trH.className = 'stbl-colhead';
                        const thN = document.createElement('th');
                        thN.textContent = 'Location';
                        const thV = document.createElement('th');
                        thV.textContent = 'ha';
                        trH.appendChild(thN);
                        trH.appendChild(thV);
                        thead.appendChild(trH);
                        table.appendChild(thead);
                        const tbody = document.createElement('tbody');
                        markers.forEach((m, i) => {
                            const tr = document.createElement('tr');
                            tr.className = 'stbl-row';
                            tr.addEventListener('click', () => focusMarkerByLabel(m.name, tr));
                            const tdN = document.createElement('td');
                            tdN.className = 'stbl-name';
                            tdN.textContent = m.name;
                            const tdV = document.createElement('td');
                            tdV.className = 'stbl-val';
                            tdV.textContent = formattedVals[i];
                            tr.appendChild(tdN);
                            tr.appendChild(tdV);
                            tbody.appendChild(tr);
                        });
                        const currentRows = countRows(markers, totalVal, othersVal);
                        const fillerRows = Math.max(0, targetRows - currentRows);
                        for (let i = 0; i < fillerRows; i += 1) {
                            const trF = document.createElement('tr');
                            trF.className = 'stbl-row stbl-filler';
                            const tdFN = document.createElement('td');
                            tdFN.className = 'stbl-name';
                            tdFN.innerHTML = '&nbsp;';
                            const tdFV = document.createElement('td');
                            tdFV.className = 'stbl-val';
                            tdFV.innerHTML = '&nbsp;';
                            trF.appendChild(tdFN);
                            trF.appendChild(tdFV);
                            tbody.appendChild(trF);
                        }

                        if (totalVal) {
                            const trT = document.createElement('tr');
                            trT.className = 'stbl-total';
                            const tdTN = document.createElement('td');
                            tdTN.className = 'stbl-name';
                            tdTN.textContent = 'Total';
                            const tdTV = document.createElement('td');
                            tdTV.className = 'stbl-val';
                            tdTV.textContent = totalVal;
                            trT.appendChild(tdTN);
                            trT.appendChild(tdTV);
                            tbody.appendChild(trT);
                        }
                        if (othersVal) {
                            const trL = document.createElement('tr');
                            trL.className = 'stbl-others';
                            const tdLN = document.createElement('td');
                            tdLN.className = 'stbl-name';
                            tdLN.textContent = 'Other';
                            const tdLV = document.createElement('td');
                            tdLV.className = 'stbl-val';
                            tdLV.textContent = othersVal;
                            trL.appendChild(tdLN);
                            trL.appendChild(tdLV);
                            tbody.appendChild(trL);
                        }

                        table.appendChild(tbody);
                        const scrollWrap = document.createElement('div');
                        scrollWrap.className = 'stbl-scroll';
                        scrollWrap.appendChild(table);
                        card.appendChild(scrollWrap);

                        const dlBtn = document.createElement('a');
                        dlBtn.className = 'sb-card-dl-btn';
                        dlBtn.innerHTML =
                            `<svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v6M2.5 5l3 3 3-3M1 9.5h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Download Data`;
                        if (dlUrl) {
                            dlBtn.href = dlUrl;
                            dlBtn.target = '_blank';
                            dlBtn.rel = 'noopener noreferrer';
                            dlBtn.download = '';
                        } else {
                            dlBtn.href = '#';
                            dlBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                const rows = [
                                    ['Lokasi', 'ha']
                                ];
                                markers.forEach(m => rows.push([m.name, m.value]));
                                if (totalVal) rows.push(['Total', totalVal]);
                                if (othersVal) rows.push(['Other', othersVal]);
                                const csv = rows.map(r => r.map(c => `"${String(c).replace(/"/g, '""')}"`).join(
                                    ',')).join('\n');
                                const a = document.createElement('a');
                                a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
                                a.download = heading.replace(/[^a-z0-9]/gi, '_') + '.csv';
                                a.click();
                            });
                        }
                        card.appendChild(dlBtn);
                        wrap.appendChild(card);
                    }

                    [...activeModes].forEach(modeKey => {
                        if (modeKey === 'konsesi') {
                            if (!activeKonsesiCats.size) return;
                            activeKonsesiCats.forEach(ck => {
                                const cat = MODES.konsesi.subCategories[ck];
                                if (!cat) return;
                                appendSidebarCard(catNames[ck] || ck, cat.markers || [], cat.kpiVal, cat
                                    .othersVal || null, maxVisibleRows, cat.dlUrl || '');
                            });
                            return;
                        }

                        const mode = MODES[modeKey];
                        if (!mode) return;
                        const markers = mode.markers || mode.species || [];
                        appendSidebarCard(modeNames[modeKey] || modeKey, markers, mode.kpiVal || null, mode.bubble
                            ?.value || null, maxVisibleRows, mode.dlUrl || '');
                    });

                    updateSidebarDynamicHeight();
                    buildLegend();
                }

                function updateSidebarDynamicHeight() {
                    const sidebar = document.getElementById('sidebar');
                    const wrap = document.getElementById('sidebar-table-wrap');
                    if (!sidebar || !wrap) return;

                    const cards = wrap.querySelectorAll('.sb-card');
                    if (!cards.length) {
                        sidebar.style.height = '180px';
                        return;
                    }

                    const prevHeight = sidebar.style.height;
                    sidebar.style.height = 'auto';

                    let maxCardHeight = 0;
                    cards.forEach(card => {
                        maxCardHeight = Math.max(maxCardHeight, card.scrollHeight);
                    });

                    const wrapStyle = getComputedStyle(wrap);
                    const sidebarStyle = getComputedStyle(sidebar);
                    const padTop = parseFloat(wrapStyle.paddingTop) || 0;
                    const padBottom = parseFloat(wrapStyle.paddingBottom) || 0;
                    const borderTop = parseFloat(sidebarStyle.borderTopWidth) || 0;
                    const borderBottom = parseFloat(sidebarStyle.borderBottomWidth) || 0;

                    const target = Math.ceil(maxCardHeight + padTop + padBottom + borderTop + borderBottom);
                    const minH = 180;
                    sidebar.style.height = `${Math.max(minH, target)}px`;

                    if (!sidebar.style.height && prevHeight) sidebar.style.height = prevHeight;
                }
                // ─────────────────────────────────────────────────────────────────────────

                // ── CHOROPLETH: WMS tiles from GeoServer ──────────────────────────────────

                function showChoroplethPanes() {
                    map.getPane('choroplethPane').style.display = '';
                    map.getPane('choroplethLabelPane').style.display = '';
                }

                function loadProvinsiChoropleth() {
                    if (choroplethGeoLayer) {
                        showChoroplethPanes();
                        return;
                    }
                    choroplethGeoLayer = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
                        layers: 'proteus:PROVINSI_STADI_2025',
                        format: 'image/png',
                        transparent: true,
                        version: '1.1.0',
                        pane: 'choroplethPane'
                    }).addTo(choroplethLayer);
                    showChoroplethPanes();
                }

                function showKabupatenPanes() {
                    map.getPane('kabupatenPane').style.display = '';
                    map.getPane('kabupatenLabelPane').style.display = '';
                }

                function loadKabupatenChoropleth() {
                    if (kabupatenGeoLayer) {
                        showKabupatenPanes();
                        return;
                    }
                    kabupatenGeoLayer = L.tileLayer.wms('https://aws.simontini.id/geoserver/wms', {
                        layers: 'proteus:KABUPATEN_STADI_2025',
                        format: 'image/png',
                        transparent: true,
                        version: '1.1.0',
                        pane: 'kabupatenPane'
                    }).addTo(kabupatenLayer);
                    showKabupatenPanes();
                }
                // ─────────────────────────────────────────────────────────────────────────

                function renderModeVisuals(modeKey) {
                    const mode = MODES[modeKey];
                    if (!mode) return;
                    currentMode = modeKey;
                    if (mode.markers) mode.markers.forEach(m => createRankMarker(m, modeKey));
                    if (mode.species) mode.species.forEach(createSpeciesMarker);
                    const tableWrap = document.getElementById('table-wrap');
                    if (mode.tables && mode.tables.length) {
                        mode.tables.forEach(t => tableWrap.appendChild(renderTableCard(t)));
                        document.getElementById('table-toggle').style.display = 'block';
                    }
                    if (modeKey === 'konsesi') {
                        const submenu = document.getElementById('konsesi-submenu');
                        submenu.classList.remove('hidden');
                        submenu.classList.add('show');
                        document.querySelectorAll('.cat-btn').forEach(b => b.classList.toggle('active', activeKonsesiCats
                            .has(b.dataset.cat)));
                        activeKonsesiCats.forEach(ck => {
                            const cat = MODES.konsesi.subCategories[ck];
                            if (cat?.markers) cat.markers.forEach(p => createRankMarker({
                                lat: p.lat,
                                lng: p.lng,
                                rank: p.rank,
                                name: p.name,
                                value: String(p.value),
                                dir: p.dir || 'right',
                                cat: ck
                            }, 'konsesi'));
                        });
                    }
                    if (modeKey === 'megafauna') positionSatwaBadges(mode.species);
                    // Show choropleth panes or load WFS data for the first time
                    if (modeKey === 'provinsi') {
                        if (!choroplethGeoLayer) {
                            loadProvinsiChoropleth();
                        } else {
                            map.getPane('choroplethPane').style.display = '';
                            map.getPane('choroplethLabelPane').style.display = '';
                        }
                    }
                    if (modeKey === 'kabupaten') {
                        if (!kabupatenGeoLayer) {
                            loadKabupatenChoropleth();
                        } else {
                            map.getPane('kabupatenPane').style.display = '';
                            map.getPane('kabupatenLabelPane').style.display = '';
                        }
                    }
                }

                function toggleMode(modeKey) {
                    const btn = document.querySelector(`.mode-btn[data-mode="${modeKey}"]`);
                    if (activeModes.has(modeKey)) {
                        activeModes.delete(modeKey);
                        if (btn) btn.classList.remove('active');
                    } else {
                        activeModes.add(modeKey);
                        if (btn) btn.classList.add('active');
                        currentMode = modeKey;
                    }
                    // Defer heavy map work so the button visual (knob animation) paints first
                    requestAnimationFrame(() => {
                        clearModeVisuals();
                        // Update sidebar KPI/title from the most recently activated mode still active
                        const uiKey = activeModes.has(currentMode) ? currentMode : [...activeModes].slice(-1)[0];
                        const uiMode = uiKey ? MODES[uiKey] : null;
                        // KPI float: separate row per active mode (runs regardless of uiMode)
                        const _kpiNames = {
                            provinsi: 'Provinsi',
                            kabupaten: 'Kabupaten',
                            konservasi: 'Konservasi',
                            megafauna: 'Megafauna',
                            konsesi: 'Konsesi'
                        };
                        const _kpiHtml = [...activeModes].map(mk => {
                            const m = MODES[mk];
                            if (!m?.kpiVal) return '';
                            return `<div style="margin-bottom:3px;"><div style="font-size:.42rem;text-transform:uppercase;letter-spacing:.08em;color:#d4c4a0;line-height:1.4;">${_kpiNames[mk] || mk}</div><div style="font-size:1.2rem;font-weight:700;line-height:1;margin-top:1px;">${m.kpiVal}</div><div style="font-size:.45rem;color:#d4c4a0;margin-top:1px;">hektare</div></div>`;
                        }).filter(Boolean).join('');
                        document.getElementById('kpi-items').innerHTML = _kpiHtml;
                        if (uiMode) {
                            document.getElementById('map-title').textContent = uiMode.title;
                            //   document.getElementById('sidebar-notes').innerHTML = uiMode.notesSidebar.map(n => `<li>${n}</li>`).join('');
                            document.getElementById('notes-list').innerHTML = uiMode.notesBox.map(n =>
                                `<li>${n}</li>`).join('');
                            const bubble = document.getElementById('others-bubble');
                            if (uiMode.bubble) {
                                bubble.style.display = 'flex';
                                document.getElementById('bubble-label').textContent = uiMode.bubble.label;
                                document.getElementById('bubble-val').textContent = uiMode.bubble.value;
                                document.getElementById('bubble-unit').textContent = uiMode.bubble.unit;
                            } else {
                                bubble.style.display = 'none';
                            }
                        }
                        if (!activeModes.has('konsesi')) {
                            const submenu = document.getElementById('konsesi-submenu');
                            submenu.classList.add('hidden');
                            submenu.classList.remove('show');
                            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
                            currentKonsesiCat = null;
                            activeKonsesiCats.clear();
                        }
                        activeModes.forEach(mk => renderModeVisuals(mk));
                        map.invalidateSize();
                        renderAllSidebarCards();
                    });
                }

                function loadKonsesiCategory(catKey) {
                    const cat = MODES.konsesi.subCategories[catKey];
                    if (!cat) return;
                    if (activeKonsesiCats.has(catKey)) {
                        activeKonsesiCats.delete(catKey);
                    } else {
                        activeKonsesiCats.add(catKey);
                    }
                    currentKonsesiCat = catKey;
                    document.querySelectorAll('.cat-btn').forEach(b => b.classList.toggle('active', activeKonsesiCats.has(b
                        .dataset.cat)));

                    document.getElementById('kpi-items').innerHTML =
                        `<div><div style="font-size:.42rem;text-transform:uppercase;letter-spacing:.08em;color:#d4c4a0;line-height:1.4;">Konsesi</div><div style="font-size:1.2rem;font-weight:700;line-height:1;margin-top:1px;">${cat.kpiVal} </div></div>`;
                    //   document.getElementById('sidebar-notes').innerHTML = cat.bullets.map(b => `<li>${b}</li>`).join('');
                    //   document.getElementById('map-title').textContent = 'Deforestasi ' + cat.title;
                    const bubble = document.getElementById('others-bubble');
                    bubble.style.display = 'flex';
                    document.getElementById('bubble-label').innerHTML = cat.othersLabel;
                    document.getElementById('bubble-val').textContent = cat.othersVal;
                    document.getElementById('bubble-unit').textContent = 'hektare';
                    document.getElementById('notes-list').innerHTML = cat.bullets.map(b => `<li>${b}</li>`).join('');

                    clearModeVisuals();
                    activeModes.forEach(mk => renderModeVisuals(mk));
                    map.invalidateSize();
                    renderAllSidebarCards();
                }

                document.querySelectorAll('.mode-btn').forEach(btn => btn.addEventListener('click', () => toggleMode(btn
                    .dataset.mode)));
                document.querySelectorAll('.cat-btn').forEach(btn => btn.addEventListener('click', () =>
                    loadKonsesiCategory(btn.dataset.cat)));
                window.addEventListener('resize', updateSidebarDynamicHeight);

                // ── LEGEND ────────────────────────────────────────────────────────────────
                const legendVisible = new Set();

                function buildLegend() {
                    const el = document.getElementById('map-legend');
                    if (!el) return;
                    el.innerHTML = '';
                    const modeColors = {
                        provinsi: '#c04030',
                        kabupaten: '#e07840',
                        konservasi: '#4a8c5c',
                        megafauna: '#7060b0',
                        konsesi: '#b06020'
                    };
                    const catColors = {
                        'kebun-kayu': '#b06020',
                        logging: '#c04030',
                        sawit: '#4a8c5c',
                        tambang: '#7060b0'
                    };
                    const modeLabels = {
                        provinsi: 'Provinsi',
                        kabupaten: 'Kabupaten',
                        konservasi: 'Konservasi',
                        megafauna: 'Megafauna'
                    };
                    const catLabels = {
                        'kebun-kayu': 'Kebun Kayu',
                        logging: 'Logging',
                        sawit: 'Sawit',
                        tambang: 'Tambang'
                    };

                    const entries = [];
                    [...activeModes].forEach(mk => {
                        if (mk === 'konsesi') {
                            activeKonsesiCats.forEach(ck => entries.push({
                                key: 'konsesi:' + ck,
                                label: catLabels[ck] || ck,
                                color: catColors[ck] || '#c04030'
                            }));
                        } else if (MODES[mk]?.markers?.length || MODES[mk]?.species?.length) {
                            entries.push({
                                key: mk,
                                label: modeLabels[mk] || mk,
                                color: modeColors[mk] || '#c04030'
                            });
                        }
                    });

                    if (!entries.length) {
                        el.style.display = 'none';
                        return;
                    }
                    el.style.display = 'flex';
                    const titleEl = document.createElement('div');
                    titleEl.className = 'map-legend-title';
                    titleEl.textContent = 'Legend Top 10';
                    el.appendChild(titleEl);

                    entries.forEach(({
                        key,
                        label,
                        color
                    }) => {
                        if (!legendVisible.has(key)) legendVisible.add(key);
                        const item = document.createElement('button');
                        item.className = 'map-legend-item' + (legendVisible.has(key) ? ' active' : '');
                        item.dataset.legendKey = key;
                        item.innerHTML =
                            `<span class="map-legend-switch"><span class="map-legend-knob" style="background:${color}"></span></span><span class="map-legend-label">${label}</span>`;
                        item.addEventListener('click', () => {
                            if (legendVisible.has(key)) {
                                legendVisible.delete(key);
                                item.classList.remove('active');
                            } else {
                                legendVisible.add(key);
                                item.classList.add('active');
                            }
                            applyLegendVisibility();
                        });
                        el.appendChild(item);
                    });
                }

                function applyLegendVisibility() {
                    markerRegistry.forEach(entry => {
                        let key = entry.mode === 'konsesi' ? 'konsesi:' + (entry.item?.cat || '') : entry.mode;
                        const show = !key || legendVisible.has(key);
                        entry.marker.setOpacity(show ? 1 : 0);
                        if (entry.marker._icon) entry.marker._icon.style.pointerEvents = show ? '' : 'none';
                    });
                }

                window.addEventListener('keydown', (e) => {
                    const mapping = {
                        '1': 'provinsi',
                        '2': 'kabupaten',
                        '3': 'konservasi',
                        '4': 'megafauna',
                        '5': 'konsesi'
                    };
                    const mode = mapping[e.key];
                    if (!mode) return;
                    toggleMode(mode);
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
                        window.kpiFloatToggle = function() {
                            if (!fullH) {
                                kpiEl.style.maxHeight = 'none';
                                fullH = kpiEl.scrollHeight;
                            }
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

                toggleMode('provinsi');
            })();
        </script>
    @endpush
