@extends('layouts.stadiLayout')

@section('meta')
    @include('partials.insightMeta')
@endsection

@section('content')


    <!-- topbar -->
    <div class="bg-white py-4 top-0 sticky z-30">

        <div class="max-w-7xl mx-auto relative z-10 px-6   flex  gap-10 items-center" >
            <div class="flex space-x-2 text-gray-300 text-sm">
                <a href="{{ url('/en/stadi2024')}}"  class="cursor-pointer text-simontini font-bold  ">EN</a>
                <div class="border-l border-gray-300"></div>
                <a href="{{ url('/id/stadi2024') }}"  class="cursor-pointer   ">ID</a>
            </div>
          <a href="https://simontini.id" class="md:w-2/12 w-4/12"><img src="{{ asset('assets/logo-simontinus.png') }}" alt="betahita" class=" md:h-8 h-6"></a>
          <div class=" w-8/12  flex gap-6 items-center overflow-auto no-scrollbar">
            <a class="font-light md:text-base text-sm text-nowrap" href="#pendahuluan">Pendahuluan</a>
            <a class="font-light md:text-base text-sm text-nowrap" href="#metodologi">Methodology</a>
            <a class="font-light md:text-base text-sm text-nowrap" href="#deforestasi2024">Deforestasi 2024</a>
            <a class="font-light md:text-base text-sm text-nowrap" href="#diskusi">Diskusi</a>
            <a class="font-light md:text-base text-sm text-nowrap" href="#rekomendasi">Rekomendasi</a>
          </div>
        </div>
    </div>

    <div id="loader" class=" px-6 fixed w-full min-h-screen z-50 overflow-hidden bg-white mx-auto inset-0 top-0 flex items-center justify-center">
        <img src="{{ asset('assets/logo-simontinus.png') }}" alt="simontini - stadi 2024" class="animate-pulse h-20">
    </div>
    <!-- Single Sticky Text -->
    <div class="fixed z-10 md:bottom-36 bottom-2/3 md:left-[16%] left-5 md:w-[35%] w-[70%]"  id="stickyText" >
        <a class="text-white md:text-4xl text-sm"> Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.</a>
    </div>


    <div id="parallax1" class="md:hidden block md:h-screen h-[350px] overflow-hidden parallaxParent">
        <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-cover">
            <source src="https://simontini.id/assets/stadi2024/hero-3.MP4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


    <div id="parallax2" class="md:block hidden h-screen overflow-hidden parallaxParent">
        <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-center">
            <source src="https://simontini.id/assets/stadi2024/hero-3.MP4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div id="parallax3" class="md:block hidden h-screen overflow-hidden parallaxParent">
        <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-center">
            <source src="https://simontini.id/assets/stadi2024/hero-1.MP4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div id="parallax1" class="md:hidden hidden h-screen overflow-hidden parallaxParent">
        <video autoplay loop muted playsinline class="h-[200%] relative top-[-130%] w-full object-center">
            <source src="#" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


    <div class="max-w-2xl mx-auto px-4 mb-20 z-20 relative">

        <div id="pendahuluan" class="pt-[45px] -mt-[45px]" >
            <h1  class="text-3xl font-bold mt-12 text-simontini block">INTRODUCTION</h1>
            <p class="mt-6 leading-relaxed">Despite appearing reluctant – when viewed in light of some statements from state officials, the refusal to use certain terms, the tinkering with definitions of forests, and the various policies still providing room to exploit them – the Government of Indonesia is basically striving to curb deforestation in the country. Moratoria on new licenses for primary forests and peatlands, and FOLU Net Sink 2030 are examples of such efforts.</p>
            <p class="mt-4 leading-relaxed">However, periodic annual deforestation data for Indonesia has yet to be available, with the exception of data published by Global Forest Watch in collaboration with the University of Maryland and the World Resources Institute. To date, deforestation data released by the Government of Indonesia through the Ministry of Forestry – formerly the Ministry of Environment and Forestry – cannot be considered annual as it runs from July to June the following year, meaning that despite covering a twelve-month period, it references months over two consecutive years. This twelve-monthly deforestation data, published since 2012, follows eight previous publications (2012, 2009, 2006, 2003, 2003, 2000, 1996, and 1990). Yet, the Government of Indonesia only releases statistical data on deforestation, with no accompanying maps, thereby making it difficult to verify independently, or to engage public participation.</p>
            <p class="mt-4 leading-relaxed">Technological developments, particularly machine learning and computation like the Google Earth Engine, along with the open access availability of satellite imagery like Landsat, Sentinel, and Planet, has resulted in the provision of annual, or even near real-time deforestation data. A spirit of transparency and public participation to halt deforestation was the basis for Auriga Nusantara, which has also initiated and coordinates <a href="https://mapbiomas.id" class="underline text-simontini">MapBiomas Indonesia</a>, to present annual deforestation data at the beginning of each year.
            </p>
        </div>
        <div id="metodologi" class="pt-[45px] -mt-[45px]">
            <h1  class="text-3xl font-bold mt-12 text-simontini">METHODOLOGY</h1>
            <p class="mt-6 leading-relaxed">The deforestation referred to in this study is the loss of natural forest cover, and does not count loss in timber plantations and/or plantation forests. Natural forest is a vegetative association dominated by naturally occurring woody growth. Therefore, this natural forest terminology covers both primary and secondary forests.</p>
            <p class="mt-4 leading-relaxed">
                Timber plantations are areas filled with timber crops that are harvested periodically within 10 years, while plantation forests are areas filled with timber crops that are not harvested below 10 years of age.
                </p>
            <p class="mt-4 leading-relaxed">Timber plantations in Indonesia can be for producing pulp or energy crops. They are called ‘plantation forests’ by the Ministry of Forestry, so they fall under the category of agricultural crops. The plantation forest category established by Auriga Nusantara includes things such as teak plantations in Java, which it categorizes as forest.
            </p>
            <p class="mt-4 leading-relaxed">
                Deforestation data for 2024 was generated through three stages as follows:
                <ul class="list-decimal pl-10 mt-4">
                    <li class="leading-relaxed"><b>1.	Detection of suspected deforestation: </b> Suspected deforestation was obtained using two approaches: </li>
                    <ul class="list-[lower-alpha] pl-12">
                        <li class="leading-relaxed mt-4">Monthly deforestation alerts: Suspected monthly deforestation was established by using monthly deforestation alerts developed by the University of Maryland. These alerts were overlaid on MapBiomas Indonesia forest cover data for 2023 (which will be released imminently) to remove alerts outside forest cover (false). Alerts located within forest cover (true) were then expanded (buffered) to radii of 1.5 kilometers, called scope areas. After removing areas obscured by cloud, these scope areas for every month throughout 2024 were determined as deforestation, and classified by detecting changes against forest cover from the end of December 2023. Classification results were then filtered temporally and spatially to ensure deforestation occurrence and remove areas below the minimum mapping unit of 0.25 hectares (ha).
                        </li>
                        <li class="mt-4"><p class="leading-relaxed">b.	Suspected annual deforestation: This was identified based on changes in the NDVI (Normalized Difference Vegetation Index) for natural forest cover. NDVI was obtained through red band and NIR (near-infrared) extraction on 4.7-meter resolution NICFI/Planet satellite imagery. Based on the Auriga Nusantara team’s measurements, natural forest vegetation values of more than 0.8 (on a scale of -1 to +1, where NDVI vegetation area > 0.5) and NDVI decreases of more than 0.2, were identified as deforestation. </p>
                        <p class="mt-4 leading-relaxed">A natural forest baseline, or T0, was established from an agreement on natural forest cover in 2017 for MapBiomas Indonesia Collection 3 – due for imminent release – and Global Forest Canopy Height developed by the University of Maryland. Consequently, analysis years (Tx) were 2018 and subsequent years, including 2024. The choice of this baseline year was adjusted to the availability of NICFI/Planet satellite imagery data, which covers all regions of Indonesia. Differences in NDVI were measured against T0 in the same times/semesters/quarters in the analysis years. </p>
                        <p class="mt-4 leading-relaxed">Then, to avoid noise resulting from cloud cover or shadow, filtering was applied by comparing them against a remaining forest mask obtained by taking away all alerts available in GLAD (Global Land Analysis and Discovery) and RADD (Radar for Detecting Deforestation) since 2019 from the natural forest baseline. Meanwhile, spatial filters were applied to remove areas below the minimum mapping unit of 100 connected pixels or 250 square meters (0.025 ha).</p>
                        <p class="mt-4 leading-relaxed">All data processing and analysis was conducted in the Google Earth Engine (GEE) platform, including its cloud-based computing technology.</p>
                        <p class="mt-4 leading-relaxed">Data produced from the two approaches was then merged to obtain 968,845 deforestation areas (polygons) covering a total area of 299,650 ha.</p>
                        </li>

                    </ul>
                    <li class="mt-4 leading-relaxed">
                        <b>Visual inspection: </b> The aforementioned suspected deforestation areas were then inspected visually. Suspected deforestation was checked polygon-by-polygon on 3-meter resolution NICFI/Planet satellite imagery throughout 2024. Considering the large number of deforestation polygons, Auriga Nusantara decided to only inspect all suspected deforestation in excess of 1 ha.
                        <a href="https://simontini.id/assets/stadi2024/Stadi2024-2.jpg" class="glightbox1 mt-4">
                            <img src="https://simontini.id/assets/stadi2024/Stadi2024-2.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                        </a>
                    </li>
                    <li class="mt-4 leading-relaxed">
                        <p><b>Field monitoring: </b> Monitoring was carried out on specific areas throughout 2024. Choices of monitoring area were based on representative categories, i.e., geography, forest estate typology, government projects, and land-based concessions (mining, timber plantation, logging, and oil palm).
                        </p>
                        <p class="mt-4 leading-relaxed">
                            Throughout 2024, the Auriga Nusantara research team visited deforestation areas in Aceh, North Sumatra, Riau, Jambi, Bengkulu, South Sumatra, West Kalimantan, Central Kalimantan, East Kalimantan, North Kalimantan, Central Sulawesi, Gorontalo, North Maluku, Southwest Papua, and Papua provinces. In total, the Auriga Nusantara research team visited areas representing 22,350 ha of deforestation in 2024.
                        </p>

                    </li>
                </ul>
            </p>
        </div>
        <div id="deforestasi2024" class="pt-[45px] -mt-[45px]">
            <h1  class="text-3xl font-bold mt-12 text-simontini">DEFORESTATION IN 2024</h1>
            <p class="mt-6 leading-relaxed">
                Indonesian deforestation in 2024 was identified to be <a href="https://simontini.id/presentation/Deforestasi_Indonesia-2023-paparan.pdf" target="_blank" class="underline text-simontini">257.384</a> ha; an increase of 4,191 ha on the previous year, which was recorded at 257,384 ha. Deforestation occurred in all regions of Indonesia, with increases in Kalimantan and Sumatra, and decreases in Sulawesi, Papua, the Moluccas, Java, and Bali and Nusa Tenggara.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20242.jpg" class="glightbox2 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20242.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                Deforestation occurred in all of Indonesia’s provinces with the exception of the Jakarta Special Region. Where the top ten provinces for deforestation in 2023 were: (1) West Kalimantan, (2) Central Kalimantan, (3) East Kalimantan, (4) Central Sulawesi, (5) South Kalimantan, (6) North Kalimantan, (7) Riau, (8) South Papua, (9) Central Papua, and (10) West Papua; the top ten in 2024 were: (1) East Kalimantan, (2) West Kalimantan, (3) Central Kalimantan, (4) Riau, (5) South Sumatra, (6) Jambi, (7) Aceh, (8) North Kalimantan, (9) Bangka Belitung, and (10) North Sumatra.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20243.jpg" class="glightbox3 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20243.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                In 2024, deforestation occurred in 428, or 83% of Indonesia’s 514 regencies and municipalities. Sixty-eight regencies showed deforestation exceeding 1,000 ha. As shown in the table below, nine of the top-ten regencies for deforestation were in Kalimantan.
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi20244.jpg" class="glightbox4 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi20244.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-12 leading-relaxed">
                Seen in terms of land control status, 57% of this deforestation occurred on land controlled by the state, or forest estate.
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
            <p class="mt-12 leading-relaxed">The majority of natural forest lost in Indonesia in 2024 constituted habitat for rare and protected species. The table/figure below shows the area of deforestation in habitats for iconic megafauna (flagship species) protected by regulations in Indonesia.</p>
            <a href="https://simontini.id/assets/stadi2024/Stadi202411.jpg" class="glightbox4 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi202411.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
            </a>
        </div>
        <div id="diskusi" class="pt-[45px] -mt-[45px]">
            <h1  class="text-3xl font-bold mt-20 text-simontini">DISCUSSION</h1>
            <ul class="list-decimal pl-5 mt-6">
                {{-- diskusi-1 --}}
                <li class="font-bold">Legal deforestation as the greatest threat</li>
                <div id="diskusi-1">
                    <p class="mt-4 leading-relaxed">Essentially, Indonesia’s legal system does not prohibit deforestation, because as long as the government issues a license, the license holder is basically able to carry out deforestation. Since the passing of the Omnibus Law, government projects can freely clear existing natural forests.</p>
                    <p class="mt-4 leading-relaxed">
                        It may true that companies are not allowed to deforest arbitrarily, even inside concessions, as they have to secure approval for their annual work plans (RKTs) in the case of forestry concessions, or work, budget and expenditure plans (RKABs) in the case of mining concessions. For oil palm concessions, conversion licenses are carried out though forest estate releases. The problem is, because the government never releases forestry company RKTs, mining company RKABs, or oil palm company forest estate release maps, concession owners can claim that their clearing of natural forest in conversion concessions (for timber plantations, oil palm, and mining) is legal.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Only 3% of all deforestation in 2024 occurred in conservation areas, while 5% occurred in protection forest estates, 49% in production forests, and 43% outside the forest estate. Examined in more depth, deforestation in protection and production forest estates occurred in areas licensed for forest utilization (read: concessions) or for government programs, such as national strategic projects (PSN). This means, 97% of deforestation occurring in 2024 was legal deforestation.
                    </p>
                </div>

                {{-- diskusi-2 --}}
                <li class="font-bold mt-12">The most extensive deforestation once again occurred in Kalimantan</li>
                <div id="diskusi-2">
                    <p class="mt-4 leading-relaxed">Kalimantan was again home to the most extensive annual deforestation in 2024, as it had been for the previous eleven years. In contrast to other regions, where deforestation has remained relatively stagnant, in Kalimantan deforestation has increased drastically every year since 2021.</p>
                    <a href="https://simontini.id/assets/stadi2024/Stadi202412.jpg" class="glightbox9 mt-4">
                        <img src="https://simontini.id/assets/stadi2024/Stadi202412.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                    </a>
                    <p class="mt-4 leading-relaxed">
                        The designation of an area in North Penajam Paser Regency to become the new national capital city (IKN) has been one reason for this increase in deforestation, as seen from the East Kalimantan Provincial Government’s proposal to change its provincial spatial plan, which if agreed, will result in the release or change in function of 736,055 ha of existing forest estate. North Kalimantan has submitted a similar process with the potential to impact 762,947 ha of existing forest estate. One argument put forward by the two provinces is economic development in line with the presence of the new capital city.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Seen by commodity, timber plantation (29,898 ha), mining (23,583 ha), and oil palm (23,430 ha) development are the main causes of deforestation in Kalimantan. Deforestation for these three commodities accounted for 59% of all deforestation across Kalimantan. The top-ten companies in terms of deforestation for the development of these three commodities in Kalimantan in 2024 are as follows:
                    </p>
                    <a href="https://simontini.id/assets/stadi2024/Stadi202410.jpg" class="glightbox10 mt-4">
                        <img src="https://simontini.id/assets/stadi2024/Stadi202410.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-4"/>
                    </a>
                </div>

                {{-- diskusi-3 --}}
                <li class="font-bold mt-12">Timber plantations as drivers of deforestation</li>
                <div id="diskusi-3">
                    <p class="mt-4 leading-relaxed">In 2023, timber plantation development was the greatest cause of deforestation in Indonesia, occurring mainly in Kalimantan. Despite this deforestation being so extensive, it occurred in only a few concessions. </p>
                    <p class="mt-4 leading-relaxed">This situation continued in 2024, almost entirely in the same concessions, or those with ownership links. As an example, massive deforestation in the PT Mayawana Persada timber plantation concession in West Kalimantan expanded significantly in 2024, with the same thing happening in the PT Industrial Forest Plantation concession in Central Kalimantan. Even though a coalition of civil society organizations had already exposed deforestation in the two concessions the previous year in reports entitled Pulping Borneo (2023) about deforestation in PT Industrial Forest Plantation and Deforestation Anonymous (March 2024) highlighting deforestation in the PT Mayawana Persada concession, deforestation continued in both concessions in 2024.</p>
                    <p class="mt-4 leading-relaxed"> However, some timber plantations also began in 2024, as was the case with three neighboring concessions in Melawi Regency, West Kalimantan – PT Meranti Laksana, PT Meranti Lestari, and PT Lahan Cakrawala – which commenced operations in the second half of 2024. Auriga Nusantara researchers documented deforestation in November 2024, and will soon publish a dedicated report.</p>
                    <p class="mt-4 leading-relaxed">Deforestation from timber plantation development appears set to continue in Kalimantan in the coming year, as the government has issued a license to establish the giant PT Phoenix Resources International pulp mill in Tarakan, North Kalimantan. No clarification has been given to the public about the source of raw materials for the mill, and, most worryingly, there are indications of ownership/management connections between PT Phoenix Resources International and PT Mayawana Persada, PT Industrial Forest Plantation, PT Meranti Laksana, PT Meranti Lestari, and PT Lahan Cakrawala.</p>
                    <p class="mt-4 leading-relaxed">Deforestation for timber plantation development in 2024 was not only carried out by the pulp industry, but also by energy or biomass plantations, as was the case with three neighboring concessions – PT Inti Global Laksana, PT Banyan Tumbuh Lestari, and PT Biomasa Jaya Abadi – in Gorontalo; PT Malinau Hijau Lestari in North Kalimantan; PT Jaya Bumi Paser in East Kalimantan; and PT Babugus Wahana Lestari in Central Kalimantan. </p>
                    <p class="mt-4 leading-relaxed">Deforestasi oleh pembangunan kebun kayu biomassa ini juga tampaknya akan tetap berlanjut pada tahun mendatang mengingat (1) tingginya permintaan pasar, terutama Jepang dan Korea Selatan, (2) kebijakan kelistrikan nasional yang membuka ruang penggunaan biomassa berbasis kayu sebagai bahan bakar listrik hingga kisaran 5-10% pada 2030, dan (3) meningkatnya secara drastis konsesi kebun kayu biomassa yang diterbitkan Kementerian Kehutanan. Peringatan akan tingginya deforestasi oleh pembangunan kebun kayu biomassa ini telah disuarakan koalisi masyarakat sipil melalui laporan <a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id" target="_blank" class="underline text-simontini">Unheeded Warnings: Forest Biomass Threats to Tropical Forests in Indonesia and Southeast Asia.</a>
                    Deforestation for energy plantation development looks set to continue in coming years, bearing in mind (1) the high market demand, especially from Japan and South Korea; (2) national electricity policy providing room for the use of wood-based biomass as a raw material for generating around 5% – 10% of the country’s electricity by 2030; and (3) the drastic increase in energy plantation concession licenses issued by the Ministry of Forestry. A warning about high levels of deforestation for the development of biomass energy plantations has been voiced by a coalition of civil society organizations through a report entitled <a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id" target="_blank" class="underline text-simontini">Unheeded Warnings: Forest Biomass Threats to Tropical Forests in Indonesia and Southeast Asia.</a>
                    </p>
                </div>


                {{-- diskusi-4 --}}
                <li class="mt-12 font-bold">Oil palm continues to prey on Indonesia’s natural forests</li>
                <div id="diskusi-4">
                    <p class="mt-4 leading-relaxed">

                        <i>“.. moving forward, we must plant more oil palm. There’s no need to be afraid ... endanger deforestation,”</i> <a href="https://youtu.be/faoo-qTC9Rg?si=MgZGUFJDCbtoQStH" target="_blank" class="underline text-simontini">said President Prabowo</a>  at the National Development Deliberation (Musrenbangnas) on 30 December 2024. Whether in line with this thought, or not, Prabowo is building justification for oil palm expansion that converts natural forest. Clearly, in 2024 deforestation for oil palm development remained high in Indonesia, especially in Sumatra and Kalimantan. In 2024, oil palm development accounted for 37,483 ha, or 14% of all deforestation.
                    </p>
                    <p class="mt-4 leading-relaxed">Deforestation for oil palm tending to occur on a large scale in almost every oil palm deforestation point in 2024, indicates oil palm development being carried out by corporations, or being propped up by large investors, rather than smallholders (categorized as under 25 ha). This was apparent with 2,019 ha of deforestation for oil palm in the PT Borneo International Anugerah (BIA) concession in West Kalimantan, and 1,347 ha in the PT Alam Lestari Indah concession in Central Kalimantan. Deforestation for oil palm not only occurred in oil palm concessions, but also in the PT Diamond Raya Timber plantation concession in Riau Province.</p>
                </div>


                {{-- diskusi-5 --}}
                <li class="font-bold mt-12">Nickel, gold, and timber plantations: A threefold threat to Sulawesi’s forests</li>
                <div id="diskusi-5">
                    <p class="mt-4 leading-relaxed">
                        Deforestation in Sulawesi fell significantly in 2024. Nevertheless, bearing in mind the area of forest cover on the island is far below that of Papua, Kalimantan, and Sumatra, its deforestation figures should still be taken seriously. Deforestation in Sulawesi, from highest to lowest, occurred in Central Sulawesi, Southeast Sulawesi, Gorontalo, West Sulawesi, South Sulawesi, and North Sulawesi.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        In contrast to relatively flat Kalimantan, undulating hills are predominant on Sulawesi. The island, the entirety of which sits in the Wallacea region, is known for its high levels of floral and faunal endemism, particularly in its birds. In addition to having significant potential to result in landslides and flash floods, deforestation on the island also has the potential to trigger higher levels of species extinction.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Seen by commodity, the nickel industry was the greatest driver of deforestation in Sulawesi, accounting for an area of 4,262 ha in 210 concessions in Central Sulawesi, Southeast Sulawesi, and South Sulawesi.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        A special note should be given to Gorontalo, a small province in northern Sulawesi, which has a relatively small area of natural forest, but experienced 2,180 ha of deforestation in 2024. As much as 71% of this deforestation was for energy plantation development (biomass) by neighboring concessions, PT Inti Global Laksana, and PT Banyan Tumbuh Lestari, which supply the nearby PT Biomasa Jaya Abadi wood pellet mill. Auriga Nusantara analysis, due for imminent release, shows ownership links between the three companies.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        The formation of this island through volcanic activity has resulted in it containing high levels of mining commodities. Not only is it home to nickel, the island also has relatively large gold reserves. Unfortunately, this potential threatens its natural forest cover. An area of 181 ha of deforestation from gold mining activities was identified in 2024. This figure is what transpired inside mining operation concession areas; however, such activities were even identified to be encroaching on conservation areas like Nantu Wildlife Refuge in Gorontalo, and Bogani Nani Wartabone National Park in North Sulawesi.
                    </p>
                </div>

                {{-- diskusi-6 --}}
                <li class="font-bold mt-12">Deforestation for nickel ravages Tanah Papua</li>
                <div id="diskusi-6">
                    <p class="mt-4 leading-relaxed">The public perhaps still thinks of Raja Ampat as an untouched cluster of small islands surrounded by beautiful calm seas filled with coral reefs. This island cluster – now a regency in Southwest Papua – is indeed known as a tourist destination and for its natural beauty, especially its coral reef-filled waters. None other than President Jokowi even saw in the new year there.</p>
                    <p class="mt-4 leading-relaxed">
                        However, this area of such national and international acclaim has been unable to withstand the onslaught of nickel mining. At least four small islands in Raja Ampat: Gag, Waigeo, Manuram, and Kawei have already been affected by nickel mines. Analysis of satellite imagery indicates that to 2024, nickel mining had resulted in 174 ha of deforestation across the four islands.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Not only that, but new nickel mining licenses have been issued to PT Mulia Raymond Perkasa for the islands of Batang Pele and Manyaifun, though mining operations have yet to commence.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Deforestation for nickel looks set to expand in Tanah Papua, as there are five mining licenses in this easternmost region of Indonesia. These licenses cover a total area of 38,529 ha, with 58%, or 22,452 ha, constituting natural forest cover.
                    </p>
                </div>

                {{-- diskusi-7 --}}
                <li class="font-bold mt-12">Massive deforestation is also occurring in conservation areas</li>
                <div id="diskusi-6">
                    <p class="mt-4 leading-relaxed">
                        On 31 October 2024, a coalition of civil society organizations involving Ekspedisi Indonesia Baru, HAKA Aceh, Forest Watch Indonesia, Greenpeace Indonesia, Pusaka Belantara Rakyat, and Auriga Nusantara released the film <b>17 Sweet Letters</b> at the COP 16 Convention on Biological Diversity in Cali, Colombia. The Indonesian language version of the film, entitled <b>17 Surat Cinta</b> and released domestically on 17 November 2024, tells the story of how deforestation has continued for years in the Rawa Singkil Wildlife Refuge conservation area in Aceh. Conservation activists had already sent 17 letters of complaint to the government, but the deforestation continued unabated. During 2024, 159 ha of deforestation was identified in this habitat for elephants, orangutans, and other iconic wildlife.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Throughout 2024, 7,704 ha of deforestation was identified inside conservation areas. This deforestation occurred in national parks, wildlife refuges, nature reserves, great forest parks, ecotourism parks, and game parks in 37 provinces.
                    </p>
                    <p class="mt-4 leading-relaxed">
                        Deforestation inside conservation areas should be of particular concern as dedicated management agencies, such as natural resources conservation agencies and technical management units, have already been established, and it is strictly prohibited by at least four laws: the conservation law, forestry law, environmental law, and illegal logging eradication law.
                    </p>
                </div>
            </ul>
        </div>

        <div id="rekomendasi" class="pt-[45px] -mt-[45px]">
            <h1  class="text-3xl font-bold mt-12 text-simontini">RECOMMENDATIONS</h1>
            <p class="mt-6 leading-relaxed">
                Currently, legal protection for natural forest in Indonesia only applies to natural forests inside conservation areas, as the conversion of forest cover and/or landscapes within them is prohibited. Of a total 22.4 million ha of conservation areas in Indonesia, 17.3 million ha constitute natural forest cover.
            </p>
            <p class="mt-4 leading-relaxed">
                There is indeed a moratorium policy on new licenses for primary forest (and peatlands). However, it should be underlined that this moratorium is a policy, not a regulation, so the protection it affords is not permanent. Moratoria, formally designated through indicative maps called Peta Indikatif Penundaan Pemberian Izin Baru (PIPPIB) pada Hutan Alam Primer and Lahan Gambut, have been designated through Minister of Environment and Forestry decrees. In the most recent decree, dated November 2023, the PIPPIB area covered 66.3 million ha. A spatial analysis of this map showed 53.5 million ha of natural forest inside the moratorium area. Still, all conservation areas are included inside the PIPPIB area.
            </p>
            <p class="mt-4 leading-relaxed">
                Natural forests outside the two categories above have no legal protection or policy at all. For that reason, Minister of Forestry, Raja Juli Antoni, for instance, could blithely say he will provide <a href="https://www.youtube.com/watch?v=xaRhYDmVTWc" target="_blank" class="underline text-simontini">20 million ha of forest estate</a>  for food, energy, and water reserves.
            </p>
            <p class="mt-4 leading-relaxed">
                Meanwhile, as shown by MapBiomas Indonesia Collection 3, Indonesia currently has 94.9 million ha of natural forests, 52.9 million ha of which are in PIPPIB areas. This means, 42 million ha of natural forest have no legal protection or policy. An aggregate nine million ha of this figure is even inside conversion concessions for oil palm (2.3 million ha), mining (3.2 million ha), and timber plantations (3.5 million ha).
            </p>
            <a href="https://simontini.id/assets/stadi2024/Stadi202413.jpg" class="glightbox11 mt-4">
                <img src="https://simontini.id/assets/stadi2024/Stadi202413.jpg" alt="Simontini - stadi 2024"  class="w-full h-full mt-10"/>
            </a>
            <p class="mt-4 leading-relaxed">
                Legal protection for natural forest should ideally be in the form of a law. Though passing a law is not an easy task, and always takes years. Even the level of legislation immediately below, i.e., a government regulation, frequently takes a long time, particularly as it is complicated by the complexities of securing inter-ministerial agreement; a necessary precondition for a government regulation.
            </p>
            <p class="mt-4 leading-relaxed">
                For that reason, a legal breakthrough could be undertaken in a short time in the form of a presidential regulation, which has similar force to a government regulation. Therefore, it is time for President Prabowo Subianto to issue a presidential regulation that provides legal protection for all remaining natural forest in Indonesia.</b>
            </p>
            <div class="flex w-full justify-center mt-6">
                <a>[ t h a n k  y o u ]</a>

            </div>
        </div>
    </div>

@endsection


@push('scripts')
<script>
    $(window).on('load', function(){
      $('#loader').hide();
      $('#content').show();
    });
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
