@extends('layouts.stadiLayout') @section('meta') @include('partials.insightMeta') @endsection @section('content')


<!-- topbar -->
<div class="bg-white py-4 top-0 sticky z-30">

    <div class="max-w-7xl mx-auto relative z-10 px-6   flex  gap-10 items-center">
        <div class="flex space-x-2 text-gray-300 text-sm">
            <a href="{{ url('/en/status-of-deforestation-in-indonesia-2024')}}" class="cursor-pointer text-simontini font-bold  ">EN</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ url('/id/status-deforestasi-indonesia-2024') }}" class="cursor-pointer   ">ID</a>
        </div>
        <a href="{{ route('index', 'en') }}" class="md:w-2/12 w-4/12"><img src="{{ asset('assets/logo-simontinus.png') }}" alt="betahita" class="  sm:h-6 h-5 "></a>
        <div class=" w-8/12  flex sm:gap-6 gap-2 items-center overflow-auto no-scrollbar">
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#pendahuluan">Introduction</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#metodologi">Methodology</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#deforestasi2024">Deforestation 2024</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#diskusi">Discussion</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#rekomendasi">Recommendations</a>
        </div>
    </div>
</div>

<div id="loader" class=" px-6 fixed w-full min-h-screen z-50 overflow-hidden bg-white mx-auto inset-0 top-0 flex items-center justify-center">
    <img src="{{ asset('assets/logo-simontinus.png') }}" alt="simontini - stadi 2024" class="animate-pulse h-20">
</div>


<div class="fixed z-10 md:bottom-56 bottom-2/3 md:left-[16%] left-5 md:w-[34%] w-[90%]" id="stickyText">
    <a class="md:text-5xl text-2xl text-white font-bold">Status of Deforestation in Indonesia 2024</a>
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


<div class="max-w-2xl mx-auto px-4 z-20 relative mt-12">
    <div class="flex w-full justify-center">
        <p class=" md:text-xl text-base mt-2 italic text-center max-w-1xl">Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.</p>
    </div>
    <div id="pendahuluan" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini block">INTRODUCTION</h1>
        <p class="mt-6 leading-relaxed">Despite appearing reluctant – when viewed in light of some statements from state officials, the refusal to use certain terms, the tinkering with definitions of forests, and the various policies still providing room to exploit them – the Government
            of Indonesia is basically striving to curb deforestation in the country. Moratoria on new licenses for primary forests and peatlands, and FOLU Net Sink 2030 are examples of such efforts.</p>
        <p class="mt-4 leading-relaxed">However, periodic annual deforestation data for Indonesia has yet to be available, with the exception of data published by Global Forest Watch in collaboration with the University of Maryland and the World Resources Institute. To date, deforestation
            data released by the Government of Indonesia through the Ministry of Forestry – formerly the Ministry of Environment and Forestry – cannot be considered annual as it runs from July to June the following year, meaning that despite covering
            a twelve-month period, it references months over two consecutive years. This twelve-monthly deforestation data, published since 2012, follows eight previous publications (2012, 2009, 2006, 2003, 2003, 2000, 1996, and 1990). Yet, the Government
            of Indonesia only releases statistical data on deforestation, with no accompanying maps, thereby making it difficult to verify independently, or to engage public participation.</p>
        <p class="mt-4 leading-relaxed">Technological developments, particularly machine learning and computation like the Google Earth Engine, along with the open access availability of satellite imagery like Landsat, Sentinel, and Planet, has resulted in the provision of annual, or
            even near real-time deforestation data. A spirit of transparency and public participation to halt deforestation was the basis for Auriga Nusantara, which has also initiated and coordinates <a href="https://mapbiomas.id" class="underline text-simontini">MapBiomas Indonesia</a>,
            to present annual deforestation data at the beginning of each year.
        </p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/raden-1-2.jpg" class="glightbox1 z-20" data-glightbox=" description: An aerial photo shows a cleared natural forest in the PT Anugerah Langkat Makmur concession. This photo was taken in February 2024.">
        <img src="https://simontini.id/assets/stadi2024/raden-1-2.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
        <p class=" text-xs mt-2">An aerial photo shows a cleared natural forest in the PT Anugerah Langkat Makmur concession. This photo was taken in February 2024.</p>
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="metodologi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini">METHODOLOGY</h1>
        <p class="mt-6 leading-relaxed">The deforestation referred to in this study is the loss of natural forest cover, and does not count loss in timber plantations and/or plantation forests. Natural forest is a vegetative association dominated by naturally occurring woody growth.
            Therefore, this natural forest terminology covers both primary and secondary forests.</p>
        <p class="mt-4 leading-relaxed">
            Timber plantations are areas filled with timber crops that are harvested periodically within 10 years, while plantation forests are areas filled with timber crops that are not harvested below 10 years of age.
        </p>
        <p class="mt-4 leading-relaxed">Timber plantations in Indonesia can be for producing pulp or energy crops. They are called ‘plantation forests’ by the Ministry of Forestry, so they fall under the category of agricultural crops. The plantation forest category established by Auriga
            Nusantara includes things such as teak plantations in Java, which it categorizes as forest.
        </p>
        <p class="mt-4 leading-relaxed">
            Deforestation data for 2024 was generated through three stages as follows: {{-- tahap-1 --}}
            <h1 class="leading-relaxed mt-4"><b>1. Detection of suspected deforestation: </b> Suspected deforestation was obtained using two approaches:</h1>
            <ul class="list-[lower-alpha] pl-12">
                <ul class="list-[lower-alpha] pl-12">
                    <li class="leading-relaxed mt-4">Monthly deforestation alerts: Suspected monthly deforestation was established by using monthly deforestation alerts developed by the University of Maryland. These alerts were overlaid on MapBiomas Indonesia forest cover data for 2023
                        (which will be released imminently) to remove alerts outside forest cover (false). Alerts located within forest cover (true) were then expanded (buffered) to radii of 1.5 kilometers, called scope areas. After removing areas obscured
                        by cloud, these scope areas for every month throughout 2024 were determined as deforestation, and classified by detecting changes against forest cover from the end of December 2023. Classification results were then filtered temporally
                        and spatially to ensure deforestation occurrence and remove areas below the minimum mapping unit of 0.25 hectares (ha).
                    </li>
                    <li class="mt-4">
                        <p class="leading-relaxed">Suspected annual deforestation: This was identified based on changes in the NDVI (Normalized Difference Vegetation Index) for natural forest cover. NDVI was obtained through red band and NIR (near-infrared) extraction on 4.7-meter
                            resolution NICFI/Planet satellite imagery. Based on the Auriga Nusantara team’s measurements, natural forest vegetation values of more than 0.8 (on a scale of -1 to +1, where NDVI vegetation area > 0.5) and NDVI decreases of
                            more than 0.2, were identified as deforestation. </p>
                        <p class="mt-4 leading-relaxed">A natural forest baseline, or T0, was established from an agreement on natural forest cover in 2017 for MapBiomas Indonesia Collection 3 – due for imminent release – and Global Forest Canopy Height developed by the University of
                            Maryland. Consequently, analysis years (Tx) were 2018 and subsequent years, including 2024. The choice of this baseline year was adjusted to the availability of NICFI/Planet satellite imagery data, which covers all regions
                            of Indonesia. Differences in NDVI were measured against T0 in the same times/semesters/quarters in the analysis years. </p>
                        <p class="mt-4 leading-relaxed">Then, to avoid noise resulting from cloud cover or shadow, filtering was applied by comparing them against a remaining forest mask obtained by taking away all alerts available in GLAD (Global Land Analysis and Discovery) and RADD
                            (Radar for Detecting Deforestation) since 2019 from the natural forest baseline. Meanwhile, spatial filters were applied to remove areas below the minimum mapping unit of 100 connected pixels or 250 square meters (0.025 ha).</p>
                        <p class="mt-4 leading-relaxed">All data processing and analysis was conducted in the Google Earth Engine (GEE) platform, including its cloud-based computing technology.</p>
                        <p class="mt-4 leading-relaxed">Data produced from the two approaches was then merged to obtain 968,845 deforestation areas (polygons) covering a total area of 299,650 ha.</p>
                    </li>
                </ul>
            </ul>

            {{-- tahap-2 --}}
            <h2 class="leading-relaxed mt-4"><b>2. Visual inspection: </b> The aforementioned suspected deforestation areas were then inspected visually. Suspected deforestation was checked polygon-by-polygon on 3-meter resolution NICFI/Planet satellite imagery throughout 2024. Considering the large number of deforestation polygons, Auriga Nusantara decided to only inspect all suspected deforestation in excess of 1 ha.</h2>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative mt-6">
    {{-- table-1 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">INSPECTION/VERIFICATION RESULT</h3>
    <div class="overflow-x-auto w-full">
        <table class="border h-[200px] w-full border-black text-sm text-white">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th rowspan="2" class="border border-black px-4 py-2">CATEGORY</th>
                    <th colspan="2" class="border border-black px-4 py-2">SUSPECTED DEFORESTATION</th>
                    <th colspan="4" class="border border-black px-4 py-2">INSPECTION/VERIFICATION RESULTS</th>
                </tr>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-black px-4 py-2">POLYGONS</th>
                    <th class="border border-black px-4 py-2">AREA (ha)</th>
                    <th class="border border-black px-4 py-2">POLYGONS TRUE</th>
                    <th class="border border-black px-4 py-2">POLYGONS FALSE</th>
                    <th class="border border-black px-4 py-2">AREA TRUE (ha)</th>
                    <th class="border border-black px-4 py-2">AREA FALSE (ha)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700">
                <tr>
                    <td class="border border-black px-4 py-2">
                            < 1</td>
                            <td class="border border-black px-4 py-2 text-right">351,718</td>
                            <td class="border border-black px-4 py-2 text-right">72,762</td>
                            <td class="border border-black px-4 py-2 text-right">351,718</td>
                            <td class="border border-black px-4 py-2">*</td>
                            <td class="border border-black px-4 py-2">72,762</td>
                            <td class="border border-b border-black px-4 py-2">*</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">1 - 5</td>
                    <td class="border border-black px-4 py-2 text-right">35,533</td>
                    <td class="border border-black px-4 py-2 text-right">73,345</td>
                    <td class="border border-black px-4 py-2 text-right">28,756</td>
                    <td class="border border-black px-4 py-2 text-right">6,777</td>
                    <td class="border border-black px-4 py-2 text-right">60,077</td>
                    <td class="border border-black px-4 py-2 text-right">13,268</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">5 - 10</td>
                    <td class="border border-black px-4 py-2 text-right">5,195</td>
                    <td class="border border-black px-4 py-2 text-right">35,471</td>
                    <td class="border border-black px-4 py-2 text-right">4,434</td>
                    <td class="border border-black px-4 py-2 text-right">761</td>
                    <td class="border border-black px-4 py-2 text-right">30,306</td>
                    <td class="border border-black px-4 py-2 text-right">5,166</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">10 - 50</td>
                    <td class="border border-black px-4 py-2 text-right">3,117</td>
                    <td class="border border-black px-4 py-2 text-right">57,626</td>
                    <td class="border border-black px-4 py-2 text-right">2,566</td>
                    <td class="border border-black px-4 py-2 text-right">551</td>
                    <td class="border border-black px-4 py-2 text-right">47,563</td>
                    <td class="border border-black px-4 py-2 text-right">10,063</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">> 50</td>
                    <td class="border border-black px-4 py-2 text-right">408</td>
                    <td class="border border-black px-4 py-2 text-right">58,746</td>
                    <td class="border border-black px-4 py-2 text-right">344</td>
                    <td class="border border-black px-4 py-2 text-right">64</td>
                    <td class="border border-black px-4 py-2 text-right">50,868</td>
                    <td class="border border-black px-4 py-2 text-right">7,879</td>
                </tr>
                <tr class="bg-gray-800 font-bold">
                    <td class="border border-black px-4 py-2">TOTAL</td>
                    <td class="border border-black px-4 py-2 text-right">395,971</td>
                    <td class="border border-black px-4 py-2 text-right">297,950</td>
                    <td class="border border-black px-4 py-2 text-right">387,818</td>
                    <td class="border border-black px-4 py-2 text-right">8,153</td>
                    <td class="border border-black px-4 py-2 text-right font-bold text-xl underline">261,575</td>
                    <td class="border border-black px-4 py-2 text-right">36,375</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-sm">*Not inspected</p>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    {{-- tahap-3 --}}
    <h2 class="leading-relaxed mt-4">
            <p><b>3. Field monitoring: </b> Monitoring was carried out on specific areas throughout 2024. Choices of monitoring area were based on representative categories, i.e., geography, forest estate typology, government projects, and land-based concessions (mining, timber plantation, logging, and oil palm).</h2>
    <p class="mt-4 leading-relaxed">
        Throughout 2024, the Auriga Nusantara research team visited deforestation areas in Aceh, North Sumatra, Riau, Jambi, Bengkulu, South Sumatra, West Kalimantan, Central Kalimantan, East Kalimantan, North Kalimantan, Central Sulawesi, Gorontalo, North Maluku, Southwest Papua, and Papua provinces. In total, the Auriga Nusantara research team visited areas representing 22,350 ha of deforestation in 2024.
    </p>
</div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/raden-2.jpg" class="glightbox2 mt-4" data-glightbox=" description: Auriga Nusantara's monitoring team verified the presence of natural forest logging in PT Kayan Kaltara Coal's concession. This photo was taken in December 2024.">
        <img src="https://simontini.id/assets/stadi2024/raden-2.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
        <p class=" text-xs mt-2">Auriga Nusantara's monitoring team verified the presence of natural forest logging in PT Kayan Kaltara Coal's concession. This photo was taken in December 2024.</p>
    </a>

</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="deforestasi2024" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini">DEFORESTATION IN 2024</h1>
        <p class="mt-6 leading-relaxed">
            Indonesian deforestation in 2024 was identified to be 261.575 ha; an increase of 4,191 ha on the previous year, which was recorded at <a href="https://simontini.id/presentation/Deforestasi_Indonesia-2023-paparan.pdf" target="_blank" class="underline text-simontini">257.384</a>            ha. Deforestation occurred in all regions of Indonesia, with increases in Kalimantan and Sumatra, and decreases in Sulawesi, Papua, the Moluccas, Java, and Bali and Nusa Tenggara.
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
        Deforestation occurred in all of Indonesia’s provinces with the exception of the Jakarta Special Region. Where the top ten provinces for deforestation in 2023 were: (1) West Kalimantan, (2) Central Kalimantan, (3) East Kalimantan, (4) Central Sulawesi,
        (5) South Kalimantan, (6) North Kalimantan, (7) Riau, (8) South Papua, (9) Central Papua, and (10) West Papua; the top ten in 2024 were: (1) East Kalimantan, (2) West Kalimantan, (3) Central Kalimantan, (4) Riau, (5) South Sumatra, (6) Jambi,
        (7) Aceh, (8) North Kalimantan, (9) Bangka Belitung, and (10) North Sumatra.
    </p>
    {{-- table-2 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">TOP TEN PROVINCES OF DEFORESTATION, 2024(hectare)</h3>
    <div class="mb-6 flex w-full flex-col gap-4 text-white sm:flex-row">
        <!-- 2023 Table -->
        <div class="w-full sm:w-6/12">
            <table class="w-full border border-black text-lg text-white">
                <tbody class="bg-gray-800">
                    <tr>
                        <td class="px-4 py-4 text-2xl font-bold">2023</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">West Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">35,162</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Central Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">30,433</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">East Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">28,633</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Central Sulawesi</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">16,679</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">South Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">16,067</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">North Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">14,316</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Riau</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">13,268</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">South Papua</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">12,640</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Central Papua</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">11,336</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">West Papua</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">10,990</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 text-sm font-bold sm:text-base">27 other provinces</td>
                        <td class="border border-black px-4 py-2 text-right text-sm font-bold sm:text-base">67,858</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 2024 Table -->
        <div class="w-full sm:w-6/12">
            <table class="w-full border border-black text-lg text-white">
                <tbody class="bg-gray-800">
                    <tr>
                        <td class="px-4 py-4 text-2xl font-bold">2024</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">East Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">44,483</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">West Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">39,598</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Central Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">33,389</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Riau</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">20,812</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Sumatera Selatan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">20,184</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Jambi</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">14,839</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Aceh</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">8,962</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">North Kalimantan</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">8,767</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">Bangka Belitung</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">7,956</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">North Sumatra</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">7,303</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 text-sm font-bold sm:text-base">27 other provinces</td>
                        <td class="border border-black px-4 py-2 text-right text-sm font-bold sm:text-base">55,282</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <p class="mt-4 leading-relaxed">
        In 2024, deforestation occurred in 428, or 83% of Indonesia’s 514 regencies and municipalities. Sixty-eight regencies showed deforestation exceeding 1,000 ha. As shown in the table below, nine of the top-ten regencies for deforestation were in Kalimantan.
    </p>

    {{-- table-3 --}}
    <h3 class="mt-6 text-simontini font-bold mb-2">TOP TEN DEFORESTED REGENCY, 2024</h3>
    <div class="text-white  mb-4 w-full overflow-auto">
        <table class="border border-black text-white  w-full">
            <thead class="bg-black">
                <tr>
                    <th class="border border-black px-6 py-2 font-bold text-left">REGENCY</th>
                    <th class="border border-black px-6 py-2 font-bold text-left">PROVINCE</th>
                    <th class="border border-black px-6 py-2 font-bold text-right">DEFORESTATION (HA)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800">
                <tr>
                    <td class="border border-black px-6 py-2 ">East Kutai</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">16,578</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">Berau</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">9,378</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">Ketapang</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">9,115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Musi Banyuasin</td>
                    <td class="border border-black px-6 py-2">South Sumatra</td>
                    <td class="border border-black px-6 py-2 text-right">8,517</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kutai Kartanegara</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">7,887</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kapuas Hulu</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">7,340</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">West Kutai</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">6,364</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Kapuas</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">5,589</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Sanggau</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">5,336</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">Katingan</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">4,809</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold text-sm">18 other regency</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">180,663</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mt-12 leading-relaxed">
        Seen in terms of land control status, 57% of this deforestation occurred on land controlled by the state, or forest estate.
    </p>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">

    <a href="https://simontini.id/assets/stadi2024/Stadi20245.jpg" class="glightbox4 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi20245.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-10 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
    {{-- table-4 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">TOP TEN DEFORESTATION IN LOGGING CONCESSIONS (HPH/PBPH HHK-HA)</h3>
    <div class="w-full overflow-auto bg-gray-800 ">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">CONSESSION</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">PROVINCE</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">DEFORESTATION (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-4 py-2">PT Panambangan</td>
                    <td class="border border-black px-4 py-2">East Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">5,485</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Kiani Lestari</td>
                    <td class="border border-black px-4 py-2">East Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">3,304</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Daya Maju Lestari (d.h. PT Marimun Timber IDS)</td>
                    <td class="border border-black px-4 py-2">East Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">2,641</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Putra Duta Indah Wood</td>
                    <td class="border border-black px-4 py-2 ">Jambi</td>
                    <td class="border border-black px-4 py-2 text-right">2,053</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Diamond Raya Timber</td>
                    <td class="border border-black px-4 py-2">Riau</td>
                    <td class="border border-black px-4 py-2 text-right">1,264</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Inhutani I (Unit Labanan)</td>
                    <td class="border border-black px-4 py-2">East Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">1,166</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Dasa Intiga</td>
                    <td class="border border-black px-4 py-2">Central Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">805</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Anugerah Pratama Inspirasi</td>
                    <td class="border border-black px-4 py-2">Bengkulu</td>
                    <td class="border border-black px-4 py-2 text-right">796</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Austral Byna</td>
                    <td class="border border-black px-4 py-2">Central Kalimantan</td>
                    <td class="border border-black px-4 py-2 text-right">740</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Wana Kencana Sejati</td>
                    <td class="border border-black px-4 py-2">North Maluku</td>
                    <td class="border border-black px-4 py-2 text-right">689</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">244 other logging concessions</td>
                    <td class="border border-black px-4 py-2"></td>
                    <td class="border border-black px-4 py-2 text-right">17,124</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-4 py-2 font-bold">Total</td>
                    <td class="border border-black px-4 py-2 font-bold"></td>
                    <td class="border border-black px-4 py-2 font-bold text-right">36,068</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-5 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">TOP TEN DEFORESTATION IN TIMBER PLANTATION CONCESSIONS (HTI/PBPH HHK-HTI)</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONSESSION</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINCE</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTATION (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Mayawana Persada</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">6,145</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Finnantara Intiga</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">1,551</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Sendawar Adhi Karya</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">1,170</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Industrial Forest Plantation</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">1,105</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Meranti Laksana</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">918</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Grace Putri Perdana</td>
                    <td class="border border-black px-6 py-2">West Kalimantan - Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">875</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Permata Borneo Abadi</td>
                    <td class="border border-black px-6 py-2">East Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">786</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Paramitra Mulia Langgeng</td>
                    <td class="border border-black px-6 py-2">Lampung - South Sumatra</td>
                    <td class="border border-black px-6 py-2 text-right">661</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Andalan Karya Pertiwi</td>
                    <td class="border border-black px-6 py-2">Bangka Belitung</td>
                    <td class="border border-black px-6 py-2 text-right">661</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Perawang Sukses Perkasa</td>
                    <td class="border border-black px-6 py-2">Riau</td>
                    <td class="border border-black px-6 py-2 text-right">660</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">270 other timber plantation concessions</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">26,800</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">Total</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">41,332</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-6 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">TOP TEN DEFORESTATION IN MINING CONCESSIONS, 2024</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONSESSION</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">COMMODITIES</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTATION (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Berau Coal</td>
                    <td class="border border-black px-6 py-2">Coal</td>
                    <td class="border border-black px-6 py-2 text-right">2,039</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Cita Mineral Investindo Tbk</td>
                    <td class="border border-black px-6 py-2">Bauxite</td>
                    <td class="border border-black px-6 py-2 text-right">1,442</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Timah Tbk</td>
                    <td class="border border-black px-6 py-2">Tin</td>
                    <td class="border border-black px-6 py-2 text-right">1,070</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Sumber Sentosa Bersama</td>
                    <td class="border border-black px-6 py-2">Quartz sand</td>
                    <td class="border border-black px-6 py-2 text-right">808</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Vale Tbk</td>
                    <td class="border border-black px-6 py-2">Nickel</td>
                    <td class="border border-black px-6 py-2 text-right">689</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Battoman Coal</td>
                    <td class="border border-black px-6 py-2">Coal</td>
                    <td class="border border-black px-6 py-2 text-right">651</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Weda Bay Nickel</td>
                    <td class="border border-black px-6 py-2">Nickel</td>
                    <td class="border border-black px-6 py-2 text-right">650</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Kayan Kaltara Coal</td>
                    <td class="border border-black px-6 py-2">Coal</td>
                    <td class="border border-black px-6 py-2 text-right">595</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Ridatama Cahaya Abadi</td>
                    <td class="border border-black px-6 py-2">Bauxite</td>
                    <td class="border border-black px-6 py-2 text-right">540</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Aneka Tambang Tbk</td>
                    <td class="border border-black px-6 py-2">Multi-commodity</td>
                    <td class="border border-black px-6 py-2 text-right">497</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">1580 other mining business permit</td>
                    <td class="border border-black px-6 py-2">Mineral & Coal</td>
                    <td class="border border-black px-6 py-2 text-right">29,635</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">Total mining deforestation</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">38,615</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-7 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">TOP TEN DEFORESTATION IN PALM OIL CONCESSIONS, 2024</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONCESSIONS</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINCE</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTATION (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">2,019</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">1,534</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Banyan Tumbuh Lestari</td>
                    <td class="border border-black px-6 py-2">Gorontalo</td>
                    <td class="border border-black px-6 py-2 text-right">1,521</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Uniseraya</td>
                    <td class="border border-black px-6 py-2">Riau</td>
                    <td class="border border-black px-6 py-2 text-right">1,408</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">1,347</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sawit</td>
                    <td class="border border-black px-6 py-2">Southwest Papua</td>
                    <td class="border border-black px-6 py-2 text-right">1,115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sejahtera</td>
                    <td class="border border-black px-6 py-2">Southwest Papua</td>
                    <td class="border border-black px-6 py-2 text-right">1,057</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">932</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Berkah Sawit Abadi</td>
                    <td class="border border-black px-6 py-2">West Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">819</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Tewah Bahana Lestari</td>
                    <td class="border border-black px-6 py-2">Central Kalimantan</td>
                    <td class="border border-black px-6 py-2 text-right">783</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">1,082 other palm oil concessions</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">24,948</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">Total</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">37,483</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">

    <p class="mt-12 leading-relaxed">The majority of natural forest lost in Indonesia in 2024 constituted habitat for rare and protected species. The table/figure below shows the area of deforestation in habitats for iconic megafauna (flagship species) protected by regulations in Indonesia.</p>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/Stadi202411.jpg" class="glightbox5 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi202411.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="diskusi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-20 text-simontini">DISCUSSION</h1> {{-- diskusi-1 --}}
        <h2 class="font-bold mt-8">1. Legal deforestation as the greatest threat</h2>
        <div id="diskusi-1" class="pl-5">
            <p class="mt-4 leading-relaxed">Essentially, Indonesia’s legal system does not prohibit deforestation, because as long as the government issues a license, the license holder is basically able to carry out deforestation. Since the passing of the Omnibus Law, government projects
                can freely clear existing natural forests.</p>
            <p class="mt-4 leading-relaxed">
                It may true that companies are not allowed to deforest arbitrarily, even inside concessions, as they have to secure approval for their annual work plans (RKTs) in the case of forestry concessions, or work, budget and expenditure plans (RKABs) in the case
                of mining concessions. For oil palm concessions, conversion licenses are carried out though forest estate releases. The problem is, because the government never releases forestry company RKTs, mining company RKABs, or oil palm company
                forest estate release maps, concession owners can claim that their clearing of natural forest in conversion concessions (for timber plantations, oil palm, and mining) is legal.
            </p>
            <p class="mt-4 leading-relaxed">
                Only 3% of all deforestation in 2024 occurred in conservation areas, while 5% occurred in protection forest estates, 49% in production forests, and 43% outside the forest estate. Examined in more depth, deforestation in protection and production forest
                estates occurred in areas licensed for forest utilization (read: concessions) or for government programs, such as national strategic projects (PSN). This means, 97% of deforestation occurring in 2024 was legal deforestation.
            </p>

        </div>
    </div>
</div>

{{-- slide-1 --}}
<div x-data="{ currentSlide: 0, totalSlides: 4 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-biomassa-mhl.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestation for biomass plantation within PT. Malinau Hijau Lestari’s concession in North Kalimantan. It might potentially legal due since the area has been released by the Ministry of Environment and Forestry and converted from forest area into Non-Forest Area. Photo: May 2024 ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/1-biomassa-mhl.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for biomass plantation within PT. Malinau Hijau Lestari’s concession in North Kalimantan. It might potentially legal due since the area has been released by the Ministry of Environment and Forestry and converted from forest area into Non-Forest Area. Photo: May 2024 ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-biomassa-gorontalo.jpg" class="glightbox6 mt-4 gbox" data-glightbox="description: Deforestation of biomass plantation by PT. Banyan Tumbuh Lestari and PT. Inti Global Laksana in Gorontalo. It might potentially legal since the natural forest has been released by the Ministry of Environment and Forestry for palm oil expansion by both companies. However, ground truthing shows it was not palm oil but biomass plantation sourced by PT. Biomasa Jaya Abadi located within one of the company concession. Photo: May 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/1-biomassa-gorontalo.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation of biomass plantation by PT. Banyan Tumbuh Lestari and PT. Inti Global Laksana in Gorontalo. It might potentially legal since the natural forest has been released by the Ministry of Environment and Forestry for palm oil expansion by both companies. However, ground truthing shows it was not palm oil but biomass plantation sourced by PT. Biomasa Jaya Abadi located within one of the company concession. Photo: May 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/1-imip.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestation for mining and nickel industrial park Indonesia Morowali Industrial Park in Central Sulawesi. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/1-imip.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestation for mining and nickel industrial park Indonesia Morowali Industrial Park in Central Sulawesi. Photo: December 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/merauke-food-estate.jpg" class="glightbox6 mt-4 gbox" data-glightbox=" description: Deforestasi for food estate development in Merauke of South Papua. Photo: September 2024, ©Tempo">
                <img src="https://simontini.id/assets/stadi2024/merauke-food-estate.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestasi for food estate development in Merauke of South Papua. Photo: September 2024, ©Tempo</p>
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

        {{-- diskusi-2 --}}
        <h2 class="font-bold mt-12">2. The most extensive deforestation once again occurred in Kalimantan</h2>
        <div id="diskusi-2" class="pl-5">
            <p class="mt-4 leading-relaxed">Kalimantan was again home to the most extensive annual deforestation in 2024, as it had been for the previous eleven years. In contrast to other regions, where deforestation has remained relatively stagnant, in Kalimantan deforestation has
                increased drastically every year since 2021.</p>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    <iframe src='https://flo.uri.sh/visualisation/21408609/embed' title='Simontini - stadi 2024' class='flourish-embed-iframe w-full h-full' frameborder='0' scrolling='no' style="height: 500px" sandbox='allow-same-origin allow-forms allow-scripts allow-downloads allow-popups allow-popups-to-escape-sandbox allow-top-navigation-by-user-activation'></iframe>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>

        <p class="mt-4 leading-relaxed">
            The designation of an area in North Penajam Paser Regency to become the new national capital city (IKN) has been one reason for this increase in deforestation, as seen from the East Kalimantan Provincial Government’s proposal to change its provincial
            spatial plan, which if agreed, will result in the release or change in function of 736,055 ha of existing forest estate. North Kalimantan has submitted a similar process with the potential to impact 762,947 ha of existing forest estate. One
            argument put forward by the two provinces is economic development in line with the presence of the new capital city.
        </p>
        <p class="mt-4 leading-relaxed">
            Seen by commodity, timber plantation (29,898 ha), mining (23,583 ha), and oil palm (23,430 ha) development are the main causes of deforestation in Kalimantan. Deforestation for these three commodities accounted for 59% of all deforestation across Kalimantan.
            The top-ten companies in terms of deforestation for the development of these three commodities in Kalimantan in 2024 are as follows:
        </p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    <div>

        {{-- table-8 --}}
        <h3 class="text-simontini mt-6 mb-2 font-bold">TOP TEN DEFORESTATION BY CONVERSION LICENSE IN KALIMANTAN, 2024</h3>
        <div class="mb-4 w-full overflow-auto bg-gray-800">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-black">
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">COMPANY</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONSESSION</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINCE</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">DEFORESTAION (HA)</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <td class="border border-black px-6 py-2">PT Mayawana Persada</td>
                        <td class="border border-black px-6 py-2">Timber Plantation</td>
                        <td class="border border-black px-6 py-2">West Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">6,145</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Berau Coal</td>
                        <td class="border border-black px-6 py-2">Coal Mine</td>
                        <td class="border border-black px-6 py-2">East Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">2,039</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                        <td class="border border-black px-6 py-2">Palm</td>
                        <td class="border border-black px-6 py-2">West Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">2,019</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Finnantara Intiga</td>
                        <td class="border border-black px-6 py-2">Timber Plantation</td>
                        <td class="border border-black px-6 py-2">West Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,551</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                        <td class="border border-black px-6 py-2">Palm</td>
                        <td class="border border-black px-6 py-2">West Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,534</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Cita Mineral Investindo Tbk</td>
                        <td class="border border-black px-6 py-2">Bauxite mine</td>
                        <td class="border border-black px-6 py-2">West Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,442</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                        <td class="border border-black px-6 py-2">Palm</td>
                        <td class="border border-black px-6 py-2">Central Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,347</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Sendawar Adhi Karya</td>
                        <td class="border border-black px-6 py-2">Timber Plantation</td>
                        <td class="border border-black px-6 py-2">East Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,170</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Industrial Forest Plantation</td>
                        <td class="border border-black px-6 py-2">Timber Plantation</td>
                        <td class="border border-black px-6 py-2">Central Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">1,105</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                        <td class="border border-black px-6 py-2">Palm</td>
                        <td class="border border-black px-6 py-2">Central Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">932</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
{{-- slide-2 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-meranti-laksana.jpg" class="glightbox7 mt-4 gbox" data-glightbox=" description: Deforestation for timber plantation within PT. Meranti Laksana in West Kalimantan. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/2-meranti-laksana.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for timber plantation within PT. Meranti Laksana in West Kalimantan. Photo: December 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-berau-prima-nusantara.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description: Deforestation within coal mining concession of PT. Berau Prima Nusantara in North Kalimantan. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/2-berau-prima-nusantara.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation within coal mining concession of PT. Berau Prima Nusantara in North Kalimantan. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-kurnisa-sejahtera.jpg" class="glightbox7 mt-4 gbox" data-glightbox=" description: Deforestation within coal mining concession of PT. Kurnia Sejahtera in North Kalimantan. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/2-kurnisa-sejahtera.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top rounded-lg hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestation within coal mining concession of PT. Kurnia Sejahtera in North Kalimantan. Photo: December 2024, ©AurigaNusantara </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-kayan-kaltara-coal.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description:  Deforestation within coal mining concession of PT. Kayan Kaltara Coal in North Kalimantan. Photo: December 2024 ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/2-kayan-kaltara-coal.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4"> Deforestation within coal mining concession of PT. Kayan Kaltara Coal in North Kalimantan. Photo: December 2024 ©AurigaNusantara        </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/2-phoenix-mill.jpg" class="glightbox7 mt-4 gbox" data-glightbox="description: Giant pulp paper of PT. Phoenix Resources International in Tarakan Regency of North Kalimantan. Based on it raw material fulfilment data, the factory has been operating since 2024 by sourcing from concessions which deforested natural forest.">
                <img src="https://simontini.id/assets/stadi2024/2-phoenix-mill.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Giant pulp paper of PT. Phoenix Resources International in Tarakan Regency of North Kalimantan. Based on it raw material fulfilment data, the factory has been operating since 2024 by sourcing from concessions which deforested natural forest.</p>
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
    {{-- diskusi-3 --}}
    <h2 class="font-bold mt-12">3. Timber plantations as drivers of deforestation</h2>
    <div id="diskusi-3" class="pl-5">
        <p class="mt-4 leading-relaxed">In 2023, timber plantation development was the greatest cause of deforestation in Indonesia, occurring mainly in Kalimantan. Despite this deforestation being so extensive, it occurred in only a few concessions. </p>
        <p class="mt-4 leading-relaxed">This situation continued in 2024, almost entirely in the same concessions, or those with ownership links. As an example, massive deforestation in the PT Mayawana Persada timber plantation concession in West Kalimantan expanded significantly in
            2024, with the same thing happening in the PT Industrial Forest Plantation concession in Central Kalimantan. Even though a coalition of civil society organizations had already exposed deforestation in the two concessions the previous year
            in reports entitled Pulping Borneo (2023) about deforestation in PT Industrial Forest Plantation and Deforestation Anonymous (March 2024) highlighting deforestation in the PT Mayawana Persada concession, deforestation continued in both concessions
            in 2024.</p>
        <p class="mt-4 leading-relaxed"> However, some timber plantations also began in 2024, as was the case with three neighboring concessions in Melawi Regency, West Kalimantan – PT Meranti Laksana, PT Meranti Lestari, and PT Lahan Cakrawala – which commenced operations in the second
            half of 2024. Auriga Nusantara researchers documented deforestation in November 2024, and will soon publish a dedicated report.</p>
        <p class="mt-4 leading-relaxed">Deforestation from timber plantation development appears set to continue in Kalimantan in the coming year, as the government has issued a license to establish the giant PT Phoenix Resources International pulp mill in Tarakan, North Kalimantan.
            No clarification has been given to the public about the source of raw materials for the mill, and, most worryingly, there are indications of ownership/management connections between PT Phoenix Resources International and PT Mayawana Persada,
            PT Industrial Forest Plantation, PT Meranti Laksana, PT Meranti Lestari, and PT Lahan Cakrawala.</p>
        <p class="mt-4 leading-relaxed">Deforestation for timber plantation development in 2024 was not only carried out by the pulp industry, but also by energy or biomass plantations, as was the case with three neighboring concessions – PT Inti Global Laksana, PT Banyan Tumbuh Lestari,
            and PT Biomasa Jaya Abadi – in Gorontalo; PT Malinau Hijau Lestari in North Kalimantan; PT Jaya Bumi Paser in East Kalimantan; and PT Babugus Wahana Lestari in Central Kalimantan. </p>
        <p class="mt-4 leading-relaxed">
            Deforestation for energy plantation development looks set to continue in coming years, bearing in mind (1) the high market demand, especially from Japan and South Korea; (2) national electricity policy providing room for the use of wood-based biomass
            as a raw material for generating around 5% – 10% of the country’s electricity by 2030; and (3) the drastic increase in energy plantation concession licenses issued by the Ministry of Forestry. A warning about high levels of deforestation for
            the development of biomass energy plantations has been voiced by a coalition of civil society organizations through a report entitled <a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id"
            target="_blank" class="underline text-simontini">Unheeded Warnings: Forest Biomass Threats to Tropical Forests in Indonesia and Southeast Asia.</a>
        </p>
    </div>
</div>
{{-- slide-3 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-mayawana.jpg" class="glightbox21 mt-4 gbox" data-glightbox=" description: In 2024, civil society coalition of Auriga Nusantara, Environmental Paper Network, Rainforest Action Network, Woods & Wayside International and Greenpeace International exposed the massive deforestation within the timber plantation of PT. Mayawana Persada in West Kalimantan. Up to December 2024, the company continuously deforested the remaining natural forest within its concession. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/3-mayawana.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                In 2024, civil society coalition of Auriga Nusantara, Environmental Paper Network, Rainforest Action Network, Woods & Wayside International and Greenpeace International exposed the massive deforestation within the timber plantation of PT. Mayawana Persada in West Kalimantan. Up to December 2024, the company continuously deforested the remaining natural forest within its concession. Photo: December 2024, ©AurigaNusantara
                </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-lahan-cakrawala.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Deforestation for timber plantation within the concession of PT. Lahan Cakrawala in West Kalimantan. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/3-lahan-cakrawala.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top rounded-lg hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for timber plantation within the concession of PT. Lahan Cakrawala in West Kalimantan. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/mayawana-maret.jpg" class="glightbox21 mt-4 gbox" data-glightbox=" description: Excavators are clearing natural forest in PT Mayawana Persada's timber plantation concession in West Kalimantan. Photo: March 2024 ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/mayawana-maret.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Excavators are clearing natural forest in PT Mayawana Persada's timber plantation concession in West Kalimantan. Photo: March 2024 ©Auriga Nusantara </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-jaya-bumi-paser.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Deforesting natural forest for biomass plantation within the PT. Jaya Bumi Paser in East Kalimantan. Photo: May 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/3-jaya-bumi-paser.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforesting natural forest for biomass plantation within the PT. Jaya Bumi Paser in East Kalimantan. Photo: May 2024, ©AurigaNusantara
                </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/3-babugus.jpg" class="glightbox21 mt-4 gbox" data-glightbox="description: Natural forest cutting for road line of biomass plantation development within the concession of PT. Babugus Wahana Lestari in Central Kalimantan. Photo: August 2024 ©AurigaNusantara/Earthsight">
                <img src="https://simontini.id/assets/stadi2024/3-babugus.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Natural forest cutting for road line of biomass plantation development within the concession of PT. Babugus Wahana Lestari in Central Kalimantan. Photo: August 2024 ©AurigaNusantara/Earthsight</p>
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

    {{-- diskusi-4 --}}
    <h2 class="font-bold mt-12">4. Oil palm continues to prey on Indonesia’s natural forests</h2>
    <div id="diskusi-4" class="pl-5">
        <p class="mt-4 leading-relaxed">

            <i>“.. moving forward, we must plant more oil palm. There’s no need to be afraid ... endanger deforestation,”</i> <a href="https://youtu.be/faoo-qTC9Rg?si=MgZGUFJDCbtoQStH" target="_blank" class="underline text-simontini">said President Prabowo</a>            at the National Development Deliberation (Musrenbangnas) on 30 December 2024. Whether in line with this thought, or not, Prabowo is building justification for oil palm expansion that converts natural forest. Clearly, in 2024 deforestation
            for oil palm development remained high in Indonesia, especially in Sumatra and Kalimantan. In 2024, oil palm development accounted for 37,483 ha, or 14% of all deforestation.
        </p>
        <p class="mt-4 leading-relaxed">Deforestation for oil palm tending to occur on a large scale in almost every oil palm deforestation point in 2024, indicates oil palm development being carried out by corporations, or being propped up by large investors, rather than smallholders
            (categorized as under 25 ha). This was apparent with 2,019 ha of deforestation for oil palm in the PT Borneo International Anugerah (BIA) concession in West Kalimantan, and 1,347 ha in the PT Alam Lestari Indah concession in Central Kalimantan.
            Deforestation for oil palm not only occurred in oil palm concessions, but also in the PT Diamond Raya Timber plantation concession in Riau Province.</p>
    </div>
</div>
{{-- slide-4 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-subussalam.jpg" class="glightbox20 mt-4 gbox" data-glightbox=" description: Deforestation for palm oil expansion. Ground truthing found no legal permit for palm oil plantation neighbouring to palm oil estate of PT. Laot Bangko and PT. Indo Sawit Perkasa in Subussalam Regency of Aceh. Photo: February 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/4-subussalam.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for palm oil expansion. Ground truthing found no legal permit for palm oil plantation neighbouring to palm oil estate of PT. Laot Bangko and PT. Indo Sawit Perkasa in Subussalam Regency of Aceh. Photo: February 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-anugerah-langkat-makmur.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Deforestation for palm oil expansion within the concession of PT. Anugerah Langkah Makmur in Mandailing Natal Regency of North Sumatera. Photo: February 2024, ©AurigaNusantara/Konsorsium Pembaruan Agraria">
                <img src="https://simontini.id/assets/stadi2024/4-anugerah-langkat-makmur.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4 ">
                Deforestation for palm oil expansion within the concession of PT. Anugerah Langkah Makmur in Mandailing Natal Regency of North Sumatera. Photo: February 2024, ©AurigaNusantara/Konsorsium Pembaruan Agraria
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-DRT.jpg" class="glightbox20 mt-4 gbox" data-glightbox=" description: Location within the logging concession of PT. Diamond Raya Timber in Riau. However, local testimonies and ground truthing exposed that the deforestation was for palm oil expansion. Ground truthing in February 2024 exposed similar case also found within the concession of PT. Anugerah Pratama Inspirasi in Bengkulu. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/4-DRT.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Location within the logging concession of PT. Diamond Raya Timber in Riau. However, local testimonies and ground truthing exposed that the deforestation was for palm oil expansion. Ground truthing in February 2024 exposed similar case also found within the concession of PT. Anugerah Pratama Inspirasi in Bengkulu. Photo: December 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/hph-bentara-arga-timber.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Deforestation inside PT Bentara Arga Timber’s logging concession in Bengkulu. The locals’ testimonies and ground-truth’s documentation indicated the deforestation are for oil palm plantations. Photo: February 2024, ©Auriga Nusantara">
                <img src="https://simontini.id/assets/stadi2024/hph-bentara-arga-timber.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestation inside PT Bentara Arga Timber’s logging concession in Bengkulu. The locals’ testimonies and ground-truth’s documentation indicated the deforestation are for oil palm plantations. Photo: February 2024, ©Auriga Nusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/4-pulau-lau-kalsel.jpg" class="glightbox20 mt-4 gbox" data-glightbox="description: Deforestation for palm oil expansion within the concession of PT. Bersama Sejahtera Sakti in Pulau Laut, Kotabaru Regency, South Kalimantan. Photo: May 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/4-pulau-lau-kalsel.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestation for palm oil expansion within the concession of PT. Bersama Sejahtera Sakti in Pulau Laut, Kotabaru Regency, South Kalimantan. Photo: May 2024, ©AurigaNusantara</p>
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

    {{-- diskusi-5 --}}
    <h2 class="font-bold mt-12">5. Nickel, gold, and timber plantations: A threefold threat to Sulawesi’s forests</h2>
    <div id="diskusi-5" class="pl-5">
        <p class="mt-4 leading-relaxed">
            Deforestation in Sulawesi fell significantly in 2024. Nevertheless, bearing in mind the area of forest cover on the island is far below that of Papua, Kalimantan, and Sumatra, its deforestation figures should still be taken seriously. Deforestation in
            Sulawesi, from highest to lowest, occurred in Central Sulawesi, Southeast Sulawesi, Gorontalo, West Sulawesi, South Sulawesi, and North Sulawesi.
        </p>
        <p class="mt-4 leading-relaxed">
            In contrast to relatively flat Kalimantan, undulating hills are predominant on Sulawesi. The island, the entirety of which sits in the Wallacea region, is known for its high levels of floral and faunal endemism, particularly in its birds. In addition
            to having significant potential to result in landslides and flash floods, deforestation on the island also has the potential to trigger higher levels of species extinction.
        </p>
        <p class="mt-4 leading-relaxed">
            Seen by commodity, the nickel industry was the greatest driver of deforestation in Sulawesi, accounting for an area of 4,262 ha in 210 concessions in Central Sulawesi, Southeast Sulawesi, and South Sulawesi.
        </p>
        <p class="mt-4 leading-relaxed">
            A special note should be given to Gorontalo, a small province in northern Sulawesi, which has a relatively small area of natural forest, but experienced 2,180 ha of deforestation in 2024. As much as 71% of this deforestation was for energy plantation
            development (biomass) by neighboring concessions, PT Inti Global Laksana, and PT Banyan Tumbuh Lestari, which supply the nearby PT Biomasa Jaya Abadi wood pellet mill. Auriga Nusantara analysis, due for imminent release, shows ownership links
            between the three companies.
        </p>
        <p class="mt-4 leading-relaxed">
            The formation of this island through volcanic activity has resulted in it containing high levels of mining commodities. Not only is it home to nickel, the island also has relatively large gold reserves. Unfortunately, this potential threatens its natural
            forest cover. An area of 181 ha of deforestation from gold mining activities was identified in 2024. This figure is what transpired inside mining operation concession areas; however, such activities were even identified to be encroaching on
            conservation areas like Nantu Wildlife Refuge in Gorontalo, and Bogani Nani Wartabone National Park in North Sulawesi.
        </p>
    </div>
</div>
{{-- slide-5 --}}
<div x-data="{ currentSlide: 0, totalSlides: 3 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-bintang-delapan.jpg" class="glightbox8 mt-4 gbox" data-glightbox=" description: Deforestation within nickel mining concession of PT. Bintang Delapan Mineral in Central Sulawesi. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/5-bintang-delapan.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation within nickel mining concession of PT. Bintang Delapan Mineral in Central Sulawesi. Photo: December 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-hengjaya.jpg" class="glightbox8 mt-4 gbox" data-glightbox="description: Deforestation within nickel mining concession of PT. Hengjaya Mineralindo in Morowali Regency, Central Sulawesi. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/5-hengjaya.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation within nickel mining concession of PT. Hengjaya Mineralindo in Morowali Regency, Central Sulawesi. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/5-surya-cahaya-mineral.jpg" class="glightbox8 mt-4 gbox" data-glightbox="description: Road towards existing mining location within the nickel concession of PT. Surya Cahaya Mineral in North Konawe Regency, Southeast Sulawesi. At glance in background shows an open area caused by deforestation for nickel mining within the company concession. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/5-surya-cahaya-mineral.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Road towards existing mining location within the nickel concession of PT. Surya Cahaya Mineral in North Konawe Regency, Southeast Sulawesi. At glance in background shows an open area caused by deforestation for nickel mining within the company concession. Photo: December 2024, ©AurigaNusantara </p>
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
    <h2 class="font-bold mt-12">6. Deforestation for nickel ravages Tanah Papua</h2>
    <div id="diskusi-6" class="pl-5">
        <p class="mt-4 leading-relaxed">The public perhaps still thinks of Raja Ampat as an untouched cluster of small islands surrounded by beautiful calm seas filled with coral reefs. This island cluster – now a regency in Southwest Papua – is indeed known as a tourist destination
            and for its natural beauty, especially its coral reef-filled waters. None other than President Jokowi even saw in the new year there.</p>
        <p class="mt-4 leading-relaxed">
            However, this area of such national and international acclaim has been unable to withstand the onslaught of nickel mining. At least four small islands in Raja Ampat: Gag, Waigeo, Manuram, and Kawei have already been affected by nickel mines. Analysis
            of satellite imagery indicates that to 2024, nickel mining had resulted in 174 ha of deforestation across the four islands.
        </p>
        <p class="mt-4 leading-relaxed">
            Not only that, but new nickel mining licenses have been issued to PT Mulia Raymond Perkasa for the islands of Batang Pele and Manyaifun, though mining operations have yet to commence.
        </p>
        <p class="mt-4 leading-relaxed">
            Deforestation for nickel looks set to expand in Tanah Papua, as there are five mining licenses in this easternmost region of Indonesia. These licenses cover a total area of 38,529 ha, with 58%, or 22,452 ha, constituting natural forest cover.
        </p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    {{-- table-9 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">NICKEL MINING PERMIT IN PAPUA LAND</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONSESSION</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">LOCATION</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PERMIT AREA</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">NATURAL FOREST IN CONCESSION</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Anugerah Surya Pratama</td>
                    <td class="border border-black px-6 py-2">Raja Ampat, Southwest Papua</td>
                    <td class="border border-black px-6 py-2 text-right">1,167</td>
                    <td class="border border-black px-6 py-2 text-right">209</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Kawei Sejahtera Mining</td>
                    <td class="border border-black px-6 py-2">Raja Ampat, Southwest Papua</td>
                    <td class="border border-black px-6 py-2 text-right">5,691</td>
                    <td class="border border-black px-6 py-2 text-right">2,361</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mulia Raymond Perkasa</td>
                    <td class="border border-black px-6 py-2">Raja Ampat, West Papua</td>
                    <td class="border border-black px-6 py-2 text-right">2,194</td>
                    <td class="border border-black px-6 py-2 text-right">874</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Gag Nikel</td>
                    <td class="border border-black px-6 py-2">Raja Ampat, West Papua</td>
                    <td class="border border-black px-6 py-2 text-right">13,078</td>
                    <td class="border border-black px-6 py-2 text-right">2,838</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Iriana Mutiara Mining</td>
                    <td class="border border-black px-6 py-2">Sarmi, Papua</td>
                    <td class="border border-black px-6 py-2 text-right">16,399</td>
                    <td class="border border-black px-6 py-2 text-right">16,170</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">TOTAL</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">38,529</td>
                    <td class="border border-black px-6 py-2 text-right font-bold">22,452</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
 {{-- slide-6 --}}
<div x-data="{ currentSlide: 0, totalSlides: 5 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-gag-nikel.jpg" class="glightbox9 mt-4 gbox" data-glightbox=" description:  Deforestation by nickel mine of PT. Gag Nickel in small island Gag in Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/6-gag-nikel.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation by nickel mine of PT. Gag Nickel in small island Gag in Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara</p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-pt-ksm.jpg" class="glightbox9 mt-4 gbox" data-glightbox="description: Deforestation of nickel mining by PT. Kawei Sejahtera Mining is small island Kawei in Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/6-pt-ksm.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation of nickel mining by PT. Kawei Sejahtera Mining is small island Kawei in Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-pt-ksp.jpg" class="glightbox9 mt-4 gbox" data-glightbox=" description: Deforestation by nickel mining activity of PT. Anugerah Surya Pratama in small island Manuram, Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/6-pt-ksp.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Deforestation by nickel mining activity of PT. Anugerah Surya Pratama in small island Manuram, Raja Ampat Regency of Southwest Papua. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-batang-pele.jpg" class="glightbox9 mt-4 gbox" data-glightbox="description: In small island of Batang Pele in Raja Ampat Regency of Southwest Papua, a permit has been released for nickel mining of PT. Mulya Raymond Perkasa. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/6-batang-pele.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">In small island of Batang Pele in Raja Ampat Regency of Southwest Papua, a permit has been released for nickel mining of PT. Mulya Raymond Perkasa. Photo: December 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/6-imm-sarmi.jpeg" class="glightbox9 mt-4 gbox" data-glightbox="description: Lake and natural forest are threaten with extinction since a permit on the area has been released for PT. Iriana Mutiara Mining. Photo: December 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/6-imm-sarmi.jpeg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">Lake and natural forest are threaten with extinction since a permit on the area has been released for PT. Iriana Mutiara Mining. Photo: December 2024, ©AurigaNusantara</p>
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
        <h2 class="font-bold mt-12">7. Massive deforestation is also occurring in conservation areas</h2>
        <div id="diskusi-7" class="pl-5">
            <p class="mt-4 leading-relaxed">
                On 31 October 2024, a coalition of civil society organizations involving Ekspedisi Indonesia Baru, HAKA Aceh, Forest Watch Indonesia, Greenpeace Indonesia, Pusaka Belantara Rakyat, and Auriga Nusantara released the film <b>17 Sweet Letters</b>                at the COP 16 Convention on Biological Diversity in Cali, Colombia. The Indonesian language version of the film, entitled <b>17 Surat Cinta</b> and released domestically on 17 November 2024, tells the story of how deforestation has continued
                for years in the Rawa Singkil Wildlife Refuge conservation area in Aceh. Conservation activists had already sent 17 letters of complaint to the government, but the deforestation continued unabated. During 2024, 159 ha of deforestation
                was identified in this habitat for elephants, orangutans, and other iconic wildlife.
            </p>
            <p class="mt-4 leading-relaxed">
                Throughout 2024, 7,704 ha of deforestation was identified inside conservation areas. This deforestation occurred in national parks, wildlife refuges, nature reserves, great forest parks, ecotourism parks, and game parks in 37 provinces.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestation inside conservation areas should be of particular concern as dedicated management agencies, such as natural resources conservation agencies and technical management units, have already been established, and it is strictly prohibited by at
                least four laws: the conservation law, forestry law, environmental law, and illegal logging eradication law.
            </p>
        </div>
    </div>
    <div class="max-w-5xl mx-auto px-4 z-20 relative">
        {{-- table-10 --}}
        <h3 class="text-simontini mt-6 mb-2 font-bold">TOP TEN CONSERVATION AREA DEFORESTATION BY 2024</h3>
        <div class="w-full overflow-auto bg-gray-800">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-black">
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">CONSERVATION AREA</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">PROVINCE</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">Deforestation in 2024 (HA)</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <td class="border border-black px-6 py-2">Kerinci Seblat National Park</td>
                        <td class="border border-black px-6 py-2">Bengkulu, Jambi, West Sumatra dan South Sumatra</td>
                        <td class="border border-black px-6 py-2 text-right">1,283</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Lorentz National Park</td>
                        <td class="border border-black px-6 py-2">Papua Mountains, South Papua dan Central Papua</td>
                        <td class="border border-black px-6 py-2 text-right">900</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Memberamo Foja Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">Papua, Papua Mountains, Central Papua</td>
                        <td class="border border-black px-6 py-2 text-right">490</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Bukit Soeharto Forest Park</td>
                        <td class="border border-black px-6 py-2">East Kalimantan</td>
                        <td class="border border-black px-6 py-2 text-right">363</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Jayawijaya Mountains Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">Papua Mountains</td>
                        <td class="border border-black px-6 py-2 text-right">357</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Gunung Leuser National Park</td>
                        <td class="border border-black px-6 py-2">Aceh dan North Sumatra</td>
                        <td class="border border-black px-6 py-2 text-right">335</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Bukit Rimbun Bukit Baling Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">Riau dan West Sumatra</td>
                        <td class="border border-black px-6 py-2 text-right">312</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Tesso Nilo National Park</td>
                        <td class="border border-black px-6 py-2">Riau</td>
                        <td class="border border-black px-6 py-2 text-right">251</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Dangku Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">South Sumatra</td>
                        <td class="border border-black px-6 py-2 text-right">236</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Giam Siak Kecil Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">Riau</td>
                        <td class="border border-black px-6 py-2 text-right">221</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">188 other conservation area</td>
                        <td class="border border-black px-6 py-2"></td>
                        <td class="border border-black px-6 py-2 text-right">2,933</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- slide-7 --}}
<div x-data="{ currentSlide: 0, totalSlides: 2 }" @touchstart="startX = $event.touches[0].clientX" @touchmove="handleTouchMove($event)" class="relative bg-gray-100 pb-4 mt-12 max-w-5xl mx-auto z-20 overflow-hidden">
    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/7-rawa-singkil.jpg" class="glightbox10 mt-4 gbox" data-glightbox="description: Deforestation for palm oil expansion within the Wildlife Reserve in Rawa Singkil of Aceh. Photo: February 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/7-rawa-singkil.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for palm oil expansion within the Wildlife Reserve in Rawa Singkil of Aceh. Photo: February 2024, ©AurigaNusantara
            </p>
        </div>
        <div class="swiper-slide w-full flex-shrink-0">
            <a href="https://simontini.id/assets/stadi2024/7-tesso-nilo.jpg" class="glightbox10 mt-4 gbox" data-glightbox=" description: Deforestation for palm oil expansion within the Tesso Nilo National Park in Riau. Photo: February 2024, ©AurigaNusantara">
                <img src="https://simontini.id/assets/stadi2024/7-tesso-nilo.jpg" alt="Simontini - stadi 2024" class="sm:h-[60vh] h-[40vh] w-full object-cover object-top  hover:brightness-50 transition duration-300 ease-in-out" />
            </a>
            <p class=" text-black font-light sm:text-sm text-xs mt-2 text-left  leading-relaxed px-4">
                Deforestation for palm oil expansion within the Tesso Nilo National Park in Riau. Photo: February 2024, ©AurigaNusantara</p>
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
                <h1 class="text-3xl font-bold mt-12 text-simontini">RECOMMENDATIONS</h1>
                <p class="mt-6 leading-relaxed">
                    Currently, legal protection for natural forest in Indonesia only applies to natural forests inside conservation areas, as the conversion of forest cover and/or landscapes within them is prohibited. Of a total 22.4 million ha of conservation areas in Indonesia,
                    17.3 million ha constitute natural forest cover.
                </p>
                <p class="mt-4 leading-relaxed">
                    There is indeed a moratorium policy on new licenses for primary forest (and peatlands). However, it should be underlined that this moratorium is a policy, not a regulation, so the protection it affords is not permanent. Moratoria, formally designated
                    through indicative maps called Peta Indikatif Penundaan Pemberian Izin Baru (PIPPIB) pada Hutan Alam Primer and Lahan Gambut, have been designated through Minister of Environment and Forestry decrees. In the most recent decree, dated
                    November 2023, the PIPPIB area covered 66.3 million ha. A spatial analysis of this map showed 53.5 million ha of natural forest inside the moratorium area. Still, all conservation areas are included inside the PIPPIB area.
                </p>
                <p class="mt-4 leading-relaxed">
                    Natural forests outside the two categories above have no legal protection or policy at all. For that reason, Minister of Forestry, Raja Juli Antoni, for instance, could blithely say he will provide <a href="https://www.youtube.com/watch?v=xaRhYDmVTWc"
                    target="_blank" class="underline text-simontini">20 million ha of forest estate</a> for food, energy, and water reserves.
                </p>
                <p class="mt-4 leading-relaxed">
                    Meanwhile, as shown by MapBiomas Indonesia Collection 3, Indonesia currently has 94.9 million ha of natural forests, 52.9 million ha of which are in PIPPIB areas. This means, 42 million ha of natural forest have no legal protection or policy. An aggregate
                    nine million ha of this figure is even inside conversion concessions for oil palm (2.3 million ha), mining (3.2 million ha), and timber plantations (3.5 million ha).
                </p>

            </div>
        </div>
    </div>
    <div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
        <iframe src='https://flo.uri.sh/visualisation/21408542/embed' title='Simontini - stadi 2024' class='flourish-embed-iframe w-full h-full' frameborder='0' scrolling='no' style="height: 500px" sandbox='allow-same-origin allow-forms allow-scripts allow-downloads allow-popups allow-popups-to-escape-sandbox allow-top-navigation-by-user-activation'></iframe>
        <p class="text-sm mt-2">Deforestation in 2001-2022 gathered by overlaying University of Maryland's Lossyear data against forest cover in 2000 by Ministry of Forestry</p>
        <p class="text-sm sm:-mt-1 mt-2">Deforestation in 2023 and 2024 using Auriga Nusantara STADI (Indonesia Deforestation Status) which available on https://simontini.id/</p>
    </div>
    <div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
        <div>
            <div>
                <p class="mt-4 leading-relaxed">
                    Legal protection for natural forest should ideally be in the form of a law. Though passing a law is not an easy task, and always takes years. Even the level of legislation immediately below, i.e., a government regulation, frequently takes a long time,
                    particularly as it is complicated by the complexities of securing inter-ministerial agreement; a necessary precondition for a government regulation.
                </p>
                <p class="mt-4 leading-relaxed">
                    For that reason, a legal breakthrough could be undertaken in a short time in the form of a presidential regulation, which has similar force to a government regulation. Therefore, it is time for President Prabowo Subianto to issue a presidential regulation
                    that provides legal protection for all remaining natural forest in Indonesia. </b><span class="bg-red-500 h-3 w-3 inline-flex"></span>
                </p>

            </div>

            <div class="text-center border-black mt-24">
                    <div class="mb-4">
                        <a class=" font-semibold mb-1 ">Authors: </a>
                        <p >Timer Manurung, Dedy Sukmara, Andhika Younastya</p>
                    </div>
                    <div class="mt-6">
                        <a class=" font-semibold ">Data and processing </a>
                        <p class="mt-1">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika Laura, Dedy Sukmara, M. Alichamdan, M. Dendi Alfitrah, Sesilia Maharani Putri, Wahyu Ananta Nugraha, Yustinus Seno</p>
                    </div>

                    <div class="mt-6">
                        <a class="  font-semibold ">On-ground verification: </a>
                        <p class="mt-1">
                            Bagus Subgiarto, Fajar Simanjuntak, Gilang Ekselsa, Hafid Azi Darma, Hilman Afif, Riszki Is Hardianto, Robby Eebor, Supintri Yohar, Yudi Nofiandi, Sulih Primara Putra
                        </p>
                    </div>

                </div>

                <div class="flex flex-col w-full text-center justify-center mb-24 mt-6">
                    <a class="font-semibold mb-1">Suggested citation:</a>
                    <p>Auriga Nusantara. 2025. Status of Deforestation in Indonesia 2024, accessed on [DD/MM/YYYY] through [LINK].</p>
                </div>




            </div>
        </div>

        @endsection @push('scripts')
        <script>
            function createLightbox(selectorID) {
                    const lightbox = GLightbox({
                        selector: selectorID,
                        touchNavigation: true,
                        loop: false,
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
