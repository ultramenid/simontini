@extends('layouts.stadiLayout')

@section('meta')
@include('partials.insightMeta')
@endsection


@section('content')

<!-- topbar -->
<div class="bg-white py-4 top-0 sticky z-30">

    <div class="max-w-7xl mx-auto relative z-10 px-6   flex  gap-10 items-center">
        <div class="flex space-x-2 text-gray-300 text-sm">
            <a href="{{ url('/en/status-of-deforestation-in-indonesia-2024')}}" class="cursor-pointer   ">EN</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ url('/id/status-deforestasi-indonesia-2024') }}" class="cursor-pointer   ">ID</a>
            <div class="border-l border-gray-300"></div>
            <a href="{{ url('/jp/status-of-deforestation-in-indonesia-2024') }}" class="cursor-pointer  text-simontini font-bold ">JP</a>
        </div>
        <a href="{{ route('index', 'en') }}" class="md:w-2/12 w-4/12"><img src="{{ asset('assets/logo-simontinus.png') }}" alt="betahita" class="  sm:h-6 h-5 "></a>
        <div class=" w-8/12  flex sm:gap-6 gap-2 items-center overflow-auto no-scrollbar">
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#pendahuluan">はじめに</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#metodologi">方法論</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#deforestasi2024">2024年の森林破壊</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#diskusi">ディスカッション</a>
            <a class=" md:text-base text-xs text-nowrap text-simontini font-semibold" href="#rekomendasi">提言</a>
        </div>
    </div>
</div>

<div id="loader" class=" px-6 fixed w-full min-h-screen z-50 overflow-hidden bg-white mx-auto inset-0 top-0 flex items-center justify-center">
    <img src="{{ asset('assets/logo-simontinus.png') }}" alt="simontini - stadi 2024" class="animate-pulse h-20">
</div>


<div class="fixed z-10 md:bottom-56 bottom-2/3 md:left-[16%] left-5 md:w-[34%] w-[90%]" id="stickyText">
    <a class="md:text-5xl text-2xl text-white font-bold">インドネシアにおける2024年の森林破壊の現状</a>
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
    {{-- <div class="flex w-full justify-center">
        <p class=" md:text-xl text-base mt-2 italic text-center max-w-1xl">Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.</p>
    </div> --}}
    <div id="pendahuluan" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini block">はじめに</h1>
        <p class="mt-6 leading-relaxed">-部の政府関係者の発言を見る限り、機微に触れるような用語を避けたり、森林の定義を弄んだり、森林を搾取する余地を残す政策をおこなうなど、依然、消極さがうかがえるものの、インドネシア政府は基本的に国内の森林減少を抑制しようとしています。原生林と泥炭地の新規許可のモラトリアムやFOLU Net Sink 2030（森林・土地利用分野からの温室効果ガス排出を2030年までにゼロにすることを目標とするインドネシア政府による計画）は、そのような取り組みの例です。</p>
        <p class="mt-4 leading-relaxed">しかしながら、メリーランド大学および世界資源研究所と協力してGlobal Forest Watchが発表したデータを除き、インドネシアの定期的な年次森林減少データはまだ利用できません。これまで、インドネシア政府が林業省（旧・環境林業省）を通じて発表してきた森林減少データは、7月から翌年6月までの期間を対象としているため、年次とはみなせず、12か月間をカバーしているものの2年にわたる月次ベースのデータを参照しています。この12か月間の森林減少データは2012年から発表されており、それ以前には8回（2012年、2009年、2006年、2003年、2003年、2000年、1996年、1990年）発表されています。しかし、インドネシア政府は森林減少に関する統計データのみを発表し、地図は添付されていないため、独立した検証や市民の参画が困難です。</p>
        <p class="mt-4 leading-relaxed">
            特に、機械学習やGoogle Earth Engineなどの計算技術の発展、Landsat、Sentinel、Planetなどの衛星画像へのオープンアクセスの利用可能性により、年間単位またはほぼリアルタイムの森林減少データの提供が可能になりました。森林減少を阻止するための透明性と公的参加の精神が、Auriga Nusantaraは毎年、年初に森林減少データを公表する取り組みを開始し、「<a href="https://mapbiomas.id" class="underline text-simontini">MapBiomas Indonesia</a>」の立ち上げと調整も担っています。
        </p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/raden-1-2.jpg" class="glightbox1 z-20" data-glightbox=" description: An aerial photo shows a cleared natural forest in the PT Anugerah Langkat Makmur concession. This photo was taken in February 2024.">
        <img src="https://simontini.id/assets/stadi2024/raden-1-2.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
        <p class=" text-xs mt-2">An aerial photo shows a cleared natural forest in the PT Anugerah Langkat Makmur concession in Mandailing Natal of North Sumatra Province. photo: February 2024, ©Auriga Nusantara.</p>
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="metodologi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-12 text-simontini">方法論</h1>
        <p class="mt-6 leading-relaxed">本レポートで言及される森林破壊（Deforestation）とは、天然林被覆の喪失を指し、産業植林やプランテーションの喪失は含まれていません。天然林（Natural Forest）とは、自然に発生した植物（Woody Growth）が優占する植生群集です。したがって、天然林という用語は原生林（Primary Forest）と二次林（Secondary Forest）の両方を含みます。</p>
        <p class="mt-4 leading-relaxed">
            産業植林は、10年以内に定期的に収穫される木材で満たされた地域であり、プランテーションは10年未満で収穫されない木材で満たされた地域です。
        </p>
        <p class="mt-4 leading-relaxed">インドネシアにおける産業植林は、パルプ生産やエネルギー向けに生産されています。林業省は「植林地（Hutan Tanaman）」と呼んでおり、農業作物のカテゴリーに分類されています。Auriga Nusantaraによる「Hutan Tanaman」のカテゴリーには、林業省が「森林」と分類するジャワ島のチーク植林なども含まれます。
        </p>
        <p class="mt-4 leading-relaxed">
            2024年の森林破壊データは、以下に示す3つの段階を通じて作成されています。 {{-- tahap-1 --}}
            <h1 class="leading-relaxed mt-4"><b>1. 森林破壊の疑いのある地域の特定 </b>：以下の2つのアプローチを用いて森林破壊の疑いのある地域が得られています。 </h1>
            <ul class="list-[lower-alpha] pl-12">
                <ul class="list-[lower-alpha] pl-12">
                    <li class="leading-relaxed mt-4">月毎の森林破壊アラート：月次単位の森林破壊の疑いは、メリーランド大学が開発した月毎の森林破壊アラートを用いて特定されました。これらのアラートは、2023年の「<a href="https://mapbiomas.id" class="underline text-simontini">MapBiomas Indonesia</a>」の森林被覆データ（近日中に公開予定）と重ね合わせ、森林被覆外に発生したアラートを除外しました。森林被覆内に位置するアラートは半径1.5キロメートルにバッファリングが拡大され、「スコープエリア」と呼ばれます。その後、雲被りによる見えない領域を取り除き、2024年の月ごとに得られたこれらのスコープエリアを森林破壊と見なし、2023年12月末時点の森林被覆との変化を分類しました。分類結果はさらに時間的および空間的にフィルタリングされ、森林破壊の発生を確実にし、最小マッピング単位である0.25ヘクタール未満の領域を除外しました。
                    </li>
                    <li class="mt-4">
                        <p class="leading-relaxed">推定年間森林破壊量：これは、天然林被覆のNDVI（植生の分布状況や活性を示す指標）の変化に基づいて特定しています。NDVIは、解像度4.7メートルのNICFI/Planetによる衛星画像の赤色バンドと近赤外バンド（NIR）の抽出を通じて取得されました。Auriga Nusantaraの測定によると、天然林植生値が「0.8」を超え（NDVI植生エリア>0.5、スケールは-1から+1）、NDVIの減少が「0.2」を超える場合、森林破壊であると特定しています。</p>
                        <p class="mt-4 leading-relaxed">天然林のベースライン、すなわちT0は、「MapBiomas Indonesia Collection 3」（近日公開予定）の2017年の天然林被覆に関する合意と、メリーランド大学が開発した「Global Forest Canopy Height」から確立されました。したがって、分析対象年（Tx）は2018年およびそれ以降の年（2024年を含む）としました。このベースライン年の選択は、インドネシアの全地域をカバーするNICFI/Planetによる衛星画像データの利用可能性に合わせて調整されました。NDVIの差異は、分析対象年の同じ時期／学期／四半期のT0と比較して測定されました。</p>
                        <p class="mt-4 leading-relaxed">その後、雲の被覆や影によるノイズを避けるため、天然林ベースラインから2019年以降のGLAD（Global Land Analysis and Discovery）およびRADD（Radar for Detecting Deforestation）で利用可能なすべてのアラートを除外して得られた残存森林マスクと比較することでフィルタリングが適用されました。一方、100連結ピクセルまたは250平方メートル（0.025ヘクタール）の最小マッピング単位未満の地域を除去するために空間フィルターが適用されました。</p>
                        <p class="mt-4 leading-relaxed">すべてのデータ処理と分析は、クラウドベースのコンピューティング技術を含むGoogle Earth Engine（GEE）プラットフォームで実施されました。</p>
                        <p class="mt-4 leading-relaxed">2つのアプローチから生成されたデータは、その後統合され、合計面積299,650ヘクタールをカバーする968,845の森林破壊エリア（ポリゴン）を取得しました。</p>
                    </li>
                </ul>
            </ul>

            {{-- tahap-2 --}}
            <h2 class="leading-relaxed mt-4"><b>2. 目視検査: </b> 前述の森林破壊と推定される地域は、その後目視で検査されます。疑わしい森林破壊は、2024年を通じてNICFI/Planetによる衛星画像（3メートル解像度）上でポリゴンごとにチェックされました。森林破壊ポリゴンの数が多いため、Auriga Nusantaraは1ヘクタール超の疑わしい森林破壊エリアのみを検査対象とする決定を下しました</h2>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative mt-6">
    {{-- table-1 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">INSPECTION/VERIFICATION RESULT</h3>
    <div class="overflow-x-auto w-full">
        <table class="border h-[200px] w-full border-black text-sm text-white">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th rowspan="2" class="border border-black px-4 py-2">カテゴリ</th>
                    <th colspan="2" class="border border-black px-4 py-2">疑いのある森林破壊</th>
                    <th colspan="4" class="border border-black px-4 py-2">検証結果</th>
                </tr>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-black px-4 py-2">ポリゴン</th>
                    <th class="border border-black px-4 py-2">地域(ha)</th>
                    <th class="border border-black px-4 py-2">ポリゴン TRUE</th>
                    <th class="border border-black px-4 py-2">ポリゴン FALSE</th>
                    <th class="border border-black px-4 py-2">地域 TRUE (ha)</th>
                    <th class="border border-black px-4 py-2">地域 FALSE (ha)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700">
                <tr>
                    <td class="border border-black px-4 py-2">
                            < 1</td>
                            <td class="border border-black px-4 py-2 text-right">351,718</td>
                            <td class="border border-black px-4 py-2 text-right">72,762</td>
                            <td class="border border-black px-4 py-2 text-right">351,718*</td>
                            <td class="border border-black px-4 py-2"></td>
                            <td class="border border-black px-4 py-2">72,762*</td>
                            <td class="border border-b border-black px-4 py-2"></td>
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
    <p class="text-sm">*検証未了</p>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    {{-- tahap-3 --}}
    <h2 class="leading-relaxed mt-4">
            <p><b>3. 現地モニタリング: </b> モニタリングは2024年を通じて特定の地域で実施されました。モニタリング地域の選択は、地理、森林地域類型、政府プロジェクト、土地ベースのコンセッション（鉱業、木材プランテーション、伐採、アブラヤシ）などの代表的なカテゴリーに基づいていました。</h2>
    <p class="mt-4 leading-relaxed">
        2024年を通じて、Auriga Nusantaraは、アチェ、北スマトラ、リアウ、ジャンビ、ベンクル、南スマトラ、西カリマンタン、中央カリマンタン、東カリマンタン、北カリマンタン、中央スラウェシ、ゴロンタロ、北マルク、南西パプア、パプアの諸州における森林破壊地域を訪問しました。合計で、2024年に森林破壊が起きた22,350ヘクタールの地域を訪問しました。
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
        <h1 class="text-3xl font-bold mt-12 text-simontini">2024年の森林破壊</h1>
        <p class="mt-6 leading-relaxed">
            2024年、インドネシアの森林破壊は261,575ヘクタールと確認され、前年の257,384ヘクタールから4,191ヘクタール増加しました。森林破壊はインドネシアのすべての地域で発生し、カリマンタンとスマトラで増加し、スラウェシ、パプア、マルク諸島、ジャワ、バリ、ヌサトゥンガラでは減少しています。
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
        森林破壊は、ジャカルタ特別州を除くインドネシアのすべての州で発生しました。2023年の森林破壊上位10州は、（1）西カリマンタン、（2）中央カリマンタン、（3）東カリマンタン、（4）中央スラウェシ、（5）南カリマンタン、（6）北カリマンタン、（7）リアウ、（8）南パプア、（9）中部パプア、（10）西パプアでした。2024年の上位10州は、（1）東カリマンタン、（2）西カリマンタン、（3）中央カリマンタン、（4）リアウ、（5）南スマトラ、（6）ジャンビ、（7）アチェ、（8）北カリマンタン、（9）バンカ・ブリトゥン、（10）北スマトラです。
    </p>
    {{-- table-2 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">森林破壊が起きた上位10州（2024年）</h3>
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
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">西カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">35,162</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">中央カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">30,433</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">東カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">28,633</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">中央スラウェシ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">16,679</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">南カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">16,067</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">北カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">14,316</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">リアウ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">13,268</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">南パプア</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">12,640</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">中部パプア</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">11,336</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">西パプア</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">10,990</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 text-sm font-bold sm:text-base">その他27州</td>
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
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">東カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">44,483</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">西カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">39,598</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">中央カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">33,389</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">リアウ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">20,812</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">南スマトラ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">20,184</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">ジャンビ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">14,839</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">アチェ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">8,962</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">北カリマンタン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">8,767</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">バンカ・ブリトゥン</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">7,956</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-2 text-sm sm:text-base">北スマトラ</td>
                        <td class="border border-black px-4 py-2 text-right text-sm sm:text-base">7,303</td>
                    </tr>
                    <tr class="bg-black">
                        <td class="border border-black px-4 py-2 text-sm font-bold sm:text-base">その他27州</td>
                        <td class="border border-black px-4 py-2 text-right text-sm font-bold sm:text-base">55,282</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <p class="mt-4 leading-relaxed">
        2024年には、インドネシアの514の県・市のうち428、すなわち83％で森林破壊が発生しました。68の県では1,000ヘクタールを超える森林破壊が起きました。下表に示すように、森林破壊上位10県のうち9県がカリマンタンに位置しています。
    </p>

    {{-- table-3 --}}
    <h3 class="mt-6 text-simontini font-bold mb-2">森林破壊が起きた上位10県（2024年）</h3>
    <div class="text-white  mb-4 w-full overflow-auto">
        <table class="border border-black text-white  w-full">
            <thead class="bg-black">
                <tr>
                    <th class="border border-black px-6 py-2 font-bold text-left">県</th>
                    <th class="border border-black px-6 py-2 font-bold text-left">州</th>
                    <th class="border border-black px-6 py-2 font-bold text-right">森林破壊面積 (HA)</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800">
                <tr>
                    <td class="border border-black px-6 py-2 ">東クタイ</td>
                    <td class="border border-black px-6 py-2">東カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">16,578</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">ベラウ</td>
                    <td class="border border-black px-6 py-2">東カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">9,378</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2 ">ケタパン</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">9,115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">ムシ・バニュアシン</td>
                    <td class="border border-black px-6 py-2">南スマトラ</td>
                    <td class="border border-black px-6 py-2 text-right">8,517</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">クタイ・カルタヌガラ</td>
                    <td class="border border-black px-6 py-2">東カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">7,887</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">カプアス・フル</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">7,340</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">西クタイ</td>
                    <td class="border border-black px-6 py-2">東カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">6,364</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">カプアス</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">5,589</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">サンガウ</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">5,336</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">カティンガン</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">4,809</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold text-sm">その他18県</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">180,663</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mt-12 leading-relaxed">
        土地ステータスの観点から見ると、この森林破壊の57％は国が管理する土地、すなわち森林地域で発生しました。
    </p>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">

    <a href="https://simontini.id/assets/stadi2024/Stadi20245.jpg" class="glightbox4 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi20245.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-10 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
    {{-- table-4 --}}
    <h3 class="text-simontini mt-6 font-bold mb-2">森林伐採事業権地(HPH/PBPH HHK-HA)における森林破壊企業上位10社（2024年）</h3>
    <div class="w-full overflow-auto bg-gray-800 ">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">州</th>
                    <th class="border border-black px-4 py-3 text-left font-semibold text-white uppercase">森林破壊面積 (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-4 py-2">PT Panambangan</td>
                    <td class="border border-black px-4 py-2">東カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">5,485</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Kiani Lestari</td>
                    <td class="border border-black px-4 py-2">東カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">3,304</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Daya Maju Lestari (d.h. PT Marimun Timber IDS)</td>
                    <td class="border border-black px-4 py-2">東カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">2,641</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Putra Duta Indah Wood</td>
                    <td class="border border-black px-4 py-2 ">ジャンビ</td>
                    <td class="border border-black px-4 py-2 text-right">2,053</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2 ">PT Diamond Raya Timber</td>
                    <td class="border border-black px-4 py-2">リアウ</td>
                    <td class="border border-black px-4 py-2 text-right">1,264</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Inhutani I (Unit Labanan)</td>
                    <td class="border border-black px-4 py-2">東カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">1,166</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Dasa Intiga</td>
                    <td class="border border-black px-4 py-2">中央カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">805</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Anugerah Pratama Inspirasi</td>
                    <td class="border border-black px-4 py-2">ベンクル</td>
                    <td class="border border-black px-4 py-2 text-right">796</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Austral Byna</td>
                    <td class="border border-black px-4 py-2">中央カリマンタン</td>
                    <td class="border border-black px-4 py-2 text-right">740</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">PT Wana Kencana Sejati</td>
                    <td class="border border-black px-4 py-2">北マルク</td>
                    <td class="border border-black px-4 py-2 text-right">689</td>
                </tr>
                <tr>
                    <td class="border border-black px-4 py-2">その他244の伐採コンセッション</td>
                    <td class="border border-black px-4 py-2"></td>
                    <td class="border border-black px-4 py-2 text-right">17,124</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-4 py-2 font-bold">合計</td>
                    <td class="border border-black px-4 py-2 font-bold"></td>
                    <td class="border border-black px-4 py-2 font-bold text-right">36,068</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-5 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">産業植林事業権地(HTI/PBPH HHK-HTI)における森林破壊企業上位10社（2024年）</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">州</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">森林破壊面積 (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Mayawana Persada</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">6,145</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Finnantara Intiga</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">1,551</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Sendawar Adhi Karya</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">1,170</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Industrial Forest Plantation</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">1,105</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Meranti Laksana</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">918</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Grace Putri Perdana</td>
                    <td class="border border-black px-6 py-2">西カリマンタン、中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">875</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Permata Borneo Abadi</td>
                    <td class="border border-black px-6 py-2">東カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">786</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Paramitra Mulia Langgeng</td>
                    <td class="border border-black px-6 py-2">ランプン、南スマトラ</td>
                    <td class="border border-black px-6 py-2 text-right">661</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Andalan Karya Pertiwi</td>
                    <td class="border border-black px-6 py-2">バンカ・ブリトゥン</td>
                    <td class="border border-black px-6 py-2 text-right">661</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Perawang Sukses Perkasa</td>
                    <td class="border border-black px-6 py-2">リアウ</td>
                    <td class="border border-black px-6 py-2 text-right">660</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">その他270の産業植林伐採コンセッション</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">26,800</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">合計</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">41,332</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-6 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">鉱山開発事業権地における森林破壊企業上位10社（2024年）</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コモディティ</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">森林破壊面積 (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Berau Coal</td>
                    <td class="border border-black px-6 py-2">石炭</td>
                    <td class="border border-black px-6 py-2 text-right">2,039</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Cita Mineral Investindo Tbk</td>
                    <td class="border border-black px-6 py-2">ボーキサイト</td>
                    <td class="border border-black px-6 py-2 text-right">1,442</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Timah Tbk</td>
                    <td class="border border-black px-6 py-2">錫</td>
                    <td class="border border-black px-6 py-2 text-right">1,070</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Sumber Sentosa Bersama</td>
                    <td class="border border-black px-6 py-2">ケイ砂</td>
                    <td class="border border-black px-6 py-2 text-right">808</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Vale Tbk</td>
                    <td class="border border-black px-6 py-2">ニッケル</td>
                    <td class="border border-black px-6 py-2 text-right">689</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Battoman Coal</td>
                    <td class="border border-black px-6 py-2">石炭</td>
                    <td class="border border-black px-6 py-2 text-right">651</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Weda Bay Nickel</td>
                    <td class="border border-black px-6 py-2">ニッケル</td>
                    <td class="border border-black px-6 py-2 text-right">650</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Kayan Kaltara Coal</td>
                    <td class="border border-black px-6 py-2">石炭</td>
                    <td class="border border-black px-6 py-2 text-right">595</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Ridatama Cahaya Abadi</td>
                    <td class="border border-black px-6 py-2">ボーキサイト</td>
                    <td class="border border-black px-6 py-2 text-right">540</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Aneka Tambang Tbk</td>
                    <td class="border border-black px-6 py-2">複数のコモディティ商品</td>
                    <td class="border border-black px-6 py-2 text-right">497</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">その他1580の鉱山開発事業</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">29,635</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">合計</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">38,615</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- table-7 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">アブラヤシ農園開発事業権地における森林破壊企業上位10社（2024年）</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">州</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">森林破壊面積 (HA)</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">2,019</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">1,534</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Banyan Tumbuh Lestari</td>
                    <td class="border border-black px-6 py-2">ゴロンタロ</td>
                    <td class="border border-black px-6 py-2 text-right">1,521</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Uniseraya</td>
                    <td class="border border-black px-6 py-2">リアウ</td>
                    <td class="border border-black px-6 py-2 text-right">1,408</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">1,347</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sawit</td>
                    <td class="border border-black px-6 py-2">パプア</td>
                    <td class="border border-black px-6 py-2 text-right">1,115</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Inti Kebun Sejahtera</td>
                    <td class="border border-black px-6 py-2">パプア</td>
                    <td class="border border-black px-6 py-2 text-right">1,057</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">932</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Berkah Sawit Abadi</td>
                    <td class="border border-black px-6 py-2">西カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">819</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Tewah Bahana Lestari</td>
                    <td class="border border-black px-6 py-2">中央カリマンタン</td>
                    <td class="border border-black px-6 py-2 text-right">783</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">その他1,082のアブラヤシ農園事業</td>
                    <td class="border border-black px-6 py-2"></td>
                    <td class="border border-black px-6 py-2 text-right">24,948</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">合計</td>
                    <td class="border border-black px-6 py-2 font-bold"></td>
                    <td class="border border-black px-6 py-2 text-right font-bold">37,483</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">

    <p class="mt-12 leading-relaxed">2024年のすべての森林破壊のうち、3％が保全地域で発生し、5％が保護林地域で、49％が生産林で、43％が森林地域外で発生しました。より詳しく見ると、保護林および生産林地域での森林破壊は、森林利用（すなわちコンセッション）または国家戦略プロジェクト（PSN）などの政府プログラムのために許可された地域で発生しました。これは、2024年に発生した森林破壊の97％が合法的なものであったことを意味します。</p>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    <a href="https://simontini.id/assets/stadi2024/Stadi202411.jpg" class="glightbox5 mt-4">
        <img src="https://simontini.id/assets/stadi2024/Stadi202411.jpg" alt="Simontini - stadi 2024" class="w-full h-full mt-4 hover:brightness-50 transition duration-300 ease-in-out" />
    </a>
</div>
<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative">
    <div id="diskusi" class="pt-[45px] -mt-[45px]">
        <h1 class="text-3xl font-bold mt-20 text-simontini">ディスカッション</h1> {{-- diskusi-1 --}}
        <h2 class="font-bold mt-8">1. 合法的な森林破壊が最大の脅威</h2>
        <div id="diskusi-1" class="pl-5">
            <p class="mt-4 leading-relaxed">インドネシアの法制度は、基本的に森林伐採を禁止していません。政府がライセンスを発行する限り、ライセンス保有者は基本的に森林伐採を行うことができます。雇用創出オムニバス法の成立以降、政府プロジェクトは既存の天然林を自由に皆伐することができます。</p>
            <p class="mt-4 leading-relaxed">
                企業がコンセッション内であっても手当たり次第に森林伐採を行うことは許可されていないのは事実です。これは、林業コンセッションの場合は年間作業計画（RKT）、鉱業コンセッションの場合は作業・予算・支出計画（RKAB）の承認を得る必要があるためです。アブラヤシ農園の場合、転換許可は林地指定の解除を通じて発行されます。問題は、政府が林業会社の年間作業計画（RKT）、鉱業会社の作業・予算・支出計画（RKAB）、あるいはアブラヤシ会社の林地指定の解除を示す地図を一切公開していないため、コンセッション保有者は転換コンセッション（木材プランテーション、アブラヤシ、鉱業）における天然林の皆伐は合法であると主張できるということです。
            </p>
            <p class="mt-4 leading-relaxed">
                2024年に起きた森林破壊のうち、保護地域で起きたのは3%、保護林では5%、生産林では49%、森林地域外では43%でした。さらに詳しい調査によれば、保護林と生産林における森林破壊は、森林利用許可（コンセッション）を受けた地域、または国家戦略プロジェクト（PSN）などの政府プログラムのために行われた地域で発生しました。つまり、2024年に起きた森林破壊の97%は合法的な森林破壊であったことになります。
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
        <h2 class="font-bold mt-12">2. もっとも大規模な森林破壊はカリマンタンで発生</h2>
        <div id="diskusi-2" class="pl-5">
            <p class="mt-4 leading-relaxed">カリマンタンは、過去11年間と同様に、2024年もっとも広範囲な森林破壊が起きた場所でした。他の地域では森林破壊が比較的停滞しているのに対し、カリマンタンでは2021年以降、劇的に増加しています。</p>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    <iframe src='https://flo.uri.sh/visualisation/21408609/embed' title='Simontini - stadi 2024' class='flourish-embed-iframe w-full h-full' frameborder='0' scrolling='no' style="height: 500px" sandbox='allow-same-origin allow-forms allow-scripts allow-downloads allow-popups allow-popups-to-escape-sandbox allow-top-navigation-by-user-activation'></iframe>
</div>

<div class="max-w-2xl mx-auto px-4 mb-4 z-20 relative mt-12">
    <div>

        <p class="mt-4 leading-relaxed">
            北プナジャム・パセル県の地域を新しい国家首都（IKN）に指定したことが、この森林破壊増加の理由の一つです。これは、東カリマンタン州政府の空間計画の変更提案からも見て取れ、もし合意されれば既存の森林地域736,055ヘクタールの解除または機能変更がもたらされます。また北カリマンタンでも、既存の森林地域762,947ヘクタールに影響を与える可能性のある同様のプロセスが提出されています。両州が提出した論拠の一つは、新首都の存在に沿った経済発展です。
        </p>
        <p class="mt-4 leading-relaxed">
            コモディティ別に見ると、木材プランテーション（29,898ヘクタール）、鉱山開発（23,583ヘクタール）、アブラヤシ農園開発（23,430ヘクタール）がカリマンタンの森林破壊の主な原因です。これら3つのコモディティによる森林破壊は、全体の59％を占めています。
        </p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 z-20 relative mt-12">
    <div>

        {{-- table-8 --}}
        <h3 class="text-simontini mt-6 mb-2 font-bold">カリマンタンにおける転換許可を持つ森林破壊企業上位10社（2024年）</h3>
        <div class="mb-4 w-full overflow-auto bg-gray-800">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-black">
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">企業名</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">州</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">森林破壊面積 (HA)</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <td class="border border-black px-6 py-2">PT Mayawana Persada</td>
                        <td class="border border-black px-6 py-2">木材プランテーション</td>
                        <td class="border border-black px-6 py-2">西カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">6,145</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Berau Coal</td>
                        <td class="border border-black px-6 py-2">石炭採掘</td>
                        <td class="border border-black px-6 py-2">東カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">2,039</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Borneo International Anugerah</td>
                        <td class="border border-black px-6 py-2">アブラヤシ</td>
                        <td class="border border-black px-6 py-2">西カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">2,019</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Finnantara Intiga</td>
                        <td class="border border-black px-6 py-2">木材プランテーション</td>
                        <td class="border border-black px-6 py-2">西カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,551</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Mitra Kapuas Agro</td>
                        <td class="border border-black px-6 py-2">アブラヤシ</td>
                        <td class="border border-black px-6 py-2">西カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,534</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Cita Mineral Investindo Tbk</td>
                        <td class="border border-black px-6 py-2">ボーキサイト採掘</td>
                        <td class="border border-black px-6 py-2">西カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,442</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Alam Lestari Indah</td>
                        <td class="border border-black px-6 py-2">アブラヤシ</td>
                        <td class="border border-black px-6 py-2">中央カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,347</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Sendawar Adhi Karya</td>
                        <td class="border border-black px-6 py-2">木材プランテーション</td>
                        <td class="border border-black px-6 py-2">東カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,170</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Industrial Forest Plantation</td>
                        <td class="border border-black px-6 py-2">木材プランテーション</td>
                        <td class="border border-black px-6 py-2">中央カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">1,105</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">PT Archipelago Timur Abadi</td>
                        <td class="border border-black px-6 py-2">アブラヤシ</td>
                        <td class="border border-black px-6 py-2">中央カリマンタン</td>
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
    <h2 class="font-bold mt-12">3. 木材プランテーションが森林破壊の主要原因</h2>
    <div id="diskusi-3" class="pl-5">
        <p class="mt-4 leading-relaxed">2023年には、木材プランテーション開発がインドネシアの森林破壊の最大の原因であり、そのほとんどがカリマンタンで発生しました。この森林破壊は非常に広範囲に及びましたが、発生したのはごく一部のコンセッションのみでした。 </p>
        <p class="mt-4 leading-relaxed">この状況は2024年も続き、ほぼ完全に同じ企業、または所有権のつながりのある企業が引き起こしています。例えば、西カリマンタン州のマヤワナ・ペルサダ（Mayawana Persada）社による大規模な森林破壊は2024年に大幅に拡大し、中央カリマンタン州のインダストリアル・フォレスト・プランテーション（Industrial Forest Plantation）社でも同様でした。</p>
        <p class="mt-4 leading-relaxed"> しかし、2024年に操業を開始した一部の木材プランテーションもあります。西カリマンタンのメラウィ県の3つの隣接するコンセッション（メランティ・ラクサナ（Meranti Laksana）社、メランティ・レスタリ（Meranti Lestari）社、ラハン・チャクラワラ（Lahan Cakrawala）社）は2024年後半に操業を開始しました。Auriga Nusantaraの研究者は2024年11月に森林破壊を記録し、特別レポートを間もなく発表する予定です。</p>
        <p class="mt-4 leading-relaxed">木材プランテーション開発による森林破壊は、政府が北カリマンタン州のタラカンにおいてフェニックス・リソーシーズ・インターナショナル（Phoenix Resources International）社に巨大パルプ工場の設立許可を発行したため、来年もカリマンタンで続く見込みです。工場の原材料供給源について公的な説明はなく、もっとも懸念されるのは、フェニックス・リソーシーズ・インターナショナル（Phoenix Resources International）社とマヤワナ・ペルサダ（Mayawana Persada）社、インダストリアル・フォレスト・プランテーション（Industrial Forest Plantation）社、メランティ・ラクサナ（Meranti Laksana）社、メランティ・レスタリ（Meranti Lestari）社、ラハン・チャクラワラ（Lahan Cakrawala）社の間に所有権／経営のつながりがある兆候が見られることです。</p>
        <p class="mt-4 leading-relaxed">2024年の木材プランテーション開発による森林破壊は、パルプ産業だけでなく、エネルギー用植林地またはバイオマス用植林地によっても引き起こされました。ゴロンタロ州の3つの隣接するコンセッション（インティ・グローバル・ラクサナ（Inti Global Laksana）社、バンヤン・トゥンブ・レスタリ（Banyan Tumbuh Lestari）社、ビオマサ・ジャヤ・アバディ（Biomasa Jaya Abadi）社）、北カリマンタン州のマリナウ・ヒジャウ・レスタリ（Malinau Hijau Lestari）社、東カリマンタン州のジャヤ・ブミ・パセル（Jaya Bumi Paser）社、中央カリマンタン州のバブグス・ワハナ・レスタリ（Babugus Wahana Lestari）社がその例です。 </p>
        <p class="mt-4 leading-relaxed">

            エネルギー用植林地の開発による森林破壊は、（1）特に日本と韓国からの高い市場需要、（2）2030年までに国の電力の約5％～10％を木材ベースのバイオマスで発電するための国家電力政策、（3）林業省によるエネルギー用植林地の事業許可の劇的な増加を考慮すると、今後数年間続く見込みです。エネルギー用植林地の開発による深刻な森林破壊について、市民社会団体の連合が『<a href="https://auriga.or.id/report/download/id/report/112/bioenergy_threats_report_en_hi_res_id.pdf?lang=id"
            target="_blank" class="underline text-simontini">無視された警告：インドネシアと東南アジアの熱帯林を脅かす森林バイオマス</a>』と題する報告書を通じて警鐘を鳴らしました。

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
    <h2 class="font-bold mt-12">4. アブラヤシはインドネシアの天然林を食い荒らし続けている</h2>
    <div id="diskusi-4" class="pl-5">
        <p class="mt-4 leading-relaxed">
            今後、私たちはもっと多くのアブラヤシを植えなければならない。恐れる必要はない…たとえそれによって森林破壊という危険にさらされるとしても」と、プラボウォ大統領は2024年12月30日の国家開発計画会議（Musrenbangnas）で述べました。この考えに沿っているかどうかは別として、プラボウォは天然林を転換するアブラヤシ拡大の正当化を構築しています。明らかに、2024年におけるアブラヤシ農園開発による森林破壊はインドネシア、特にスマトラとカリマンタンで高いままでした。2024年には、アブラヤシ農園開発が37,483ヘクタール、すべての森林破壊の14％を占めました。
        </p>
        <p class="mt-4 leading-relaxed">2024年のほぼすべてのアブラヤシ森林破壊地点で大規模に発生する傾向があることは、アブラヤシ開発が小規模農家（25ヘクタール未満に分類）ではなく、企業や大規模投資家によって行われていることを示しています。これは、西カリマンタン州のボルネオ・インターナショナル・アヌゲラ（Borneo International Anugerah）社のコンセッションでアブラヤシのために2,019ヘクタール、中央カリマンタン州のアラム・レスタリ・インダ（Alam Lestari Indah）社のコンセッションで1,347ヘクタールの森林が失われたことからも明らかです。アブラヤシによる森林破壊は、アブラヤシ農園だけでなく、リアウ州のダイアモンド・ラヤ・ティンバー（Diamond Raya Timber）社のプランテーションコンセッションでも発生しました。</p>
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
    <h2 class="font-bold mt-12">5. ニッケル、金、木材プランテーション：スラウェシ島における3つの脅威</h2>
    <div id="diskusi-5" class="pl-5">
        <p class="mt-4 leading-relaxed">
            スラウェシでの森林破壊は2024年に大幅に減少しました。それにもかかわらず、島の森林被覆面積がパプア、カリマンタン、スマトラに比べてはるかに少ないことを考慮すると、森林破壊面積の数値は依然として深刻に受け止めなければなりません。スラウェシでの森林破壊は、中央スラウェシ州、南東スラウェシ州、ゴロンタロ州、西スラウェシ州、南スラウェシ州、北スラウェシ州の順に発生しました。
        </p>
        <p class="mt-4 leading-relaxed">
            比較的平坦なカリマンタンとは異なり、スラウェシでは丘陵地が優勢です。全域がウォーレシア地域に位置するこの島は、特に鳥類において高い動植物固有性で知られています。地滑りや鉄砲水のリスクが高いだけでなく、島での森林破壊はより高いレベルの種の絶滅を引き起こす可能性もあります。
        </p>
        <p class="mt-4 leading-relaxed">
            コモディティ別に見ると、ニッケル産業がスラウェシでの森林破壊の最大の要因であり、中央スラウェシ州、南東スラウェシ州、南スラウェシ州の210のコンセッションで4,262ヘクタールの面積を占めました。
        </p>
        <p class="mt-4 leading-relaxed">
            スラウェシ北部の小さな州であるゴロンタロには特別な注意が必要です。この州は比較的天然林の面積が小さいにもかかわらず、2024年に2,180ヘクタールの森林破壊が起きました。この森林破壊の71％は、近隣のインティ・グローバル・ラクサナ（Inti Global Laksana）社とバンヤン・トゥンブ・レスタリ（Banyan Tumbuh Lestari）社によるエネルギー用植林地の開発（バイオマス）のためであり、これらは近くのビオマサ・ジャヤ・アバディ（Biomasa Jaya Abadi）社による木質ペレット工場に供給しています。まもなく発表されるAuriga Nusantaraの分析は、これら3社間の所有関係のつながりを示しています。
        </p>
        <p class="mt-4 leading-relaxed">
            この島は火山活動によって形成されたため、豊富な鉱物資源を有しています。ニッケルの一大産地であるだけでなく、比較的大きな金の埋蔵量もあります。しかし残念ながら、この可能性は天然林被覆を脅かしています。2024年には金採掘活動による181ヘクタールの森林破壊が起きました。この数字は鉱山開発の地域内で発生したものですが、そのような活動はゴロンタロ州のナントゥ野生動物保護区や北スラウェシ州のボガニ・ナニ・ワルタボネ国立公園などの保全地域にも侵入していることが判明しています。
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
    <h2 class="font-bold mt-12">6. ニッケル採掘のための森林破壊がパプアの土地を荒廃させる</h2>
    <div id="diskusi-6" class="pl-5">
        <p class="mt-4 leading-relaxed">おそらく一般の人々は、ラジャ・アンパット諸島を美しく静かな海とサンゴ礁に囲まれた手つかずの小さな島々の集まりとして考えているでしょう。現在は南西パプアの県となっているこの諸島は、確かに観光地として、特にサンゴ礁で満たされた水域の自然の美しさで知られています。ジョコウィ大統領でさえそこで新年を過ごしました。</p>
        <p class="mt-4 leading-relaxed">
            しかし、このような国内外の評価を受けた地域も、ニッケル採掘の猛攻撃（開発の波）には耐えられませんでした。ラジャ・アンパット諸島にある少なくとも4つの小さな島、ガグ、ワイゲオ、マヌラン、カウェイはすでにニッケル鉱山の影響を受けています。衛星画像の分析によると、2024年までにニッケル採掘はこれら4つの島で174ヘクタールの森林破壊をもたらしました。
        </p>
        <p class="mt-4 leading-relaxed">
            さらに、バタンペレ島とマニャイフン島では、Mulia Raymond Perkasa社が新たなニッケル採掘の許可を得ていますが、採掘事業はまだ始まっていません。
        </p>
        <p class="mt-4 leading-relaxed">
            パプアでのニッケル採掘による森林破壊は拡大する見込みです。インドネシア最東端地域には5つの採掘許可があり、これらの許可は合計38,529ヘクタールの面積をカバーし、そのうち58％、22,452ヘクタールが天然林に覆われています。
        </p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 z-20 relative">
    {{-- table-9 --}}
    <h3 class="text-simontini mt-6 mb-2 font-bold">パプアでのニッケル鉱山開発許可</h3>
    <div class="w-full overflow-auto bg-gray-800">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-black">
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">地域</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">許可地面積（ha）</th>
                    <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">コンセッション地域内の天然林（ha）</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <tr>
                    <td class="border border-black px-6 py-2">PT Anugerah Surya Pratama</td>
                    <td class="border border-black px-6 py-2">ラジャアンパット、南西パプア</td>
                    <td class="border border-black px-6 py-2 text-right">1,167</td>
                    <td class="border border-black px-6 py-2 text-right">209</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Kawei Sejahtera Mining</td>
                    <td class="border border-black px-6 py-2">ラジャアンパット、南西パプア</td>
                    <td class="border border-black px-6 py-2 text-right">5,691</td>
                    <td class="border border-black px-6 py-2 text-right">2,361</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Mulia Raymond Perkasa</td>
                    <td class="border border-black px-6 py-2">ラジャアンパット、西パプア</td>
                    <td class="border border-black px-6 py-2 text-right">2,194</td>
                    <td class="border border-black px-6 py-2 text-right">874</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Gag Nikel</td>
                    <td class="border border-black px-6 py-2">ラジャアンパット、西パプア</td>
                    <td class="border border-black px-6 py-2 text-right">13,078</td>
                    <td class="border border-black px-6 py-2 text-right">2,838</td>
                </tr>
                <tr>
                    <td class="border border-black px-6 py-2">PT Iriana Mutiara Mining</td>
                    <td class="border border-black px-6 py-2">サルミ、パプア</td>
                    <td class="border border-black px-6 py-2 text-right">16,399</td>
                    <td class="border border-black px-6 py-2 text-right">16,170</td>
                </tr>
                <tr class="bg-black">
                    <td class="border border-black px-6 py-2 font-bold">合計</td>
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
        <h2 class="font-bold mt-12">7. 保全地域でも大規模な森林破壊が起きている</h2>
        <div id="diskusi-7" class="pl-5">
            <p class="mt-4 leading-relaxed">
                2024年10月31日、Ekspedisi Indonesia Baru、HAKA Aceh、Forest Watch Indonesia、Greenpeace Indonesia、Pusaka Belantara Rakyat、Auriga Nusantaraからなる市民社会組織連合が、コロンビア・カリで開催された生物多様性条約第16回締約国会議（COP 16）で映画「17 Sweet Letters」を発表しました。そのインドネシア語版「17 Surat Cinta」は2024年11月17日に国内で公開され、アチェ州のラワ・シンキル野生動物保護区で長年続く森林破壊の物語を描いています。保全活動家たちは政府に対し17通の苦情文書を送っていましたが、森林破壊は続いています。2024年には、ゾウやオランウータンなど象徴的な野生動物の生息地で159ヘクタールの森林破壊が確認されました。
            </p>
            <p class="mt-4 leading-relaxed">
                2024年を通じて、インドネシア全体で保全地域内の合計7,704ヘクタールの森林破壊が確認されました。この森林破壊は、37州の国立公園、野生生物保護区、自然保護区、大森林公園、エコツーリズム公園、狩猟エリアで行われています。
            </p>
            <p class="mt-4 leading-relaxed">
               保全地域内の森林破壊は、自然資源保全庁や技術管理ユニットなどの専門管理機関がすでに設置されており、少なくとも4つの法律（保全法、林業法、環境法、違法伐採撲滅法）によって厳しく禁止されているため、特に懸念されるべきです。
            </p>
        </div>
    </div>
    <div class="max-w-5xl mx-auto px-4 z-20 relative">
        {{-- table-10 --}}
        <h3 class="text-simontini mt-6 mb-2 font-bold">保護地域における森林破壊トップ10</h3>
        <div class="w-full overflow-auto bg-gray-800">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-black">
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">保全地域</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">州</th>
                        <th class="border border-black px-6 py-3 text-left font-semibold text-white uppercase">2024年の森林破壊面積（ha）</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <tr>
                        <td class="border border-black px-6 py-2">Kerinci Seblat National Park</td>
                        <td class="border border-black px-6 py-2">ベンクル、ジャンビ、西スマトラ、南スマトラ</td>
                        <td class="border border-black px-6 py-2 text-right">1,283</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Lorentz National Park</td>
                        <td class="border border-black px-6 py-2">山岳パプア、南パプア、中央パプア</td>
                        <td class="border border-black px-6 py-2 text-right">900</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Memberamo Foja Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">パプア、山岳パプア、中央パプア</td>
                        <td class="border border-black px-6 py-2 text-right">490</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Bukit Soeharto Forest Park</td>
                        <td class="border border-black px-6 py-2">東カリマンタン</td>
                        <td class="border border-black px-6 py-2 text-right">363</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Jayawijaya Mountains Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">山岳パプア</td>
                        <td class="border border-black px-6 py-2 text-right">357</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Gunung Leuser National Park</td>
                        <td class="border border-black px-6 py-2">アチェ、北スマトラ</td>
                        <td class="border border-black px-6 py-2 text-right">335</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Bukit Rimbun Bukit Baling Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">リアウ、西スマトラ</td>
                        <td class="border border-black px-6 py-2 text-right">312</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Tesso Nilo National Park</td>
                        <td class="border border-black px-6 py-2">リアウ</td>
                        <td class="border border-black px-6 py-2 text-right">251</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Dangku Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">南スマトラ</td>
                        <td class="border border-black px-6 py-2 text-right">236</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">Giam Siak Kecil Wildlife Sanctuary</td>
                        <td class="border border-black px-6 py-2">リアウ</td>
                        <td class="border border-black px-6 py-2 text-right">221</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-6 py-2">その他188の保全地域</td>
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
                <h1 class="text-3xl font-bold mt-12 text-simontini">提言</h1>
                <p class="mt-6 leading-relaxed">
                    現在、インドネシアの天然林に対する法的保護は、保全地域内の天然林にのみ適用されています。なぜなら、これらの地域では森林被覆やランドスケープの転換が禁止されているからです。インドネシアの保全地域の総面積2,240万ヘクタールのうち、1,730万ヘクタールが天然林被覆となっています。
                </p>
                <p class="mt-4 leading-relaxed">
                    確かに、原生林（および泥炭地）の新規許可に関するモラトリアム政策は存在します。しかし、このモラトリアムは政策であり規制ではないため、その保護は恒久的ではありません。「Peta Indikatif Penundaan Pemberian Izin Baru（PIPPIB）」と呼ばれる地図を通じて正式に指定されたこのモラトリアムは、環境林業大臣令によって定められています。2023年11月時点の最新版では、6,630万ヘクタールの地域をカバーしています。この地図の空間分析によれば、モラトリアム地域内には5,350万ヘクタールの天然林があります。それでも、すべての保全地域はPIPPIB地域内に含まれています。
                </p>
                <p class="mt-4 leading-relaxed">
                    上記の2つのカテゴリー以外の天然林には、法的保護や政策がまったくありません。例えば、林業大臣ラジャ・ジュリ・アントニ氏は、食料・エネルギー・水の備蓄のために2,000万ヘクタールの森林地域を提供すると発言しています。
                </p>
                <p class="mt-4 leading-relaxed">
                    一方、「MapBiomas Indonesia Collection 3」が示すように、インドネシアは現在9,490万ヘクタールの天然林を有しており、そのうち5,290万ヘクタールがモラトリアム地域にあります。これは、4,200万ヘクタールの天然林に法的保護や政策がないことを意味します。この数字のうち合計900万ヘクタールは、アブラヤシ（230万ヘクタール）、鉱業（320万ヘクタール）、木材プランテーション（350万ヘクタール）の転換コンセッション内にさえ含まれています。
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
                    天然林に対する保護は、理想的には法律の形を取るべきです。法律を制定するのは簡単な作業ではなく、通常何年もかかります。次のレベルの立法、すなわち政府規則でさえ、省庁間合意の確保という前提条件の複雑さにより、しばしば長い時間がかかります。
                </p>
                <p class="mt-4 leading-relaxed">
                   したがって、政府規則と同等の効力を持つ大統領令の形で、短期間で法的な突破口を実現することが可能です。したがって、プラボウォ・スビアント大統領がインドネシアの残存するすべての天然林に法的保護を提供する大統領令を発行する時が来ています。 <span class="bg-red-500 h-3 w-3 inline-flex"></span>
                </p>

            </div>

            <div class="text-center border-black mt-24">
                    <div class="mb-4">
                        <a class=" font-semibold mb-1 ">著者: </a>
                        <p >Timer Manurung, Dedy Sukmara, Andhika Younastya</p>
                    </div>
                    <div class="mt-6">
                        <a class=" font-semibold ">データ収集・編集 </a>
                        <p class="mt-1">Andhika Younastya, Anggun Detrina Napitupulu, Bagus Sugiarto, Cecilinia Tika Laura, Dedy Sukmara, M. Alichamdan, M. Dendi Alfitrah, Sesilia Maharani Putri, Wahyu Ananta Nugraha, Yustinus Seno</p>
                    </div>

                    <div class="mt-6">
                        <a class="  font-semibold ">実地検証: </a>
                        <p class="mt-1">
                            Bagus Subgiarto, Fajar Simanjuntak, Gilang Ekselsa, Hafid Azi Darma, Hilman Afif, Riszki Is Hardianto, Robby Eebor, Supintri Yohar, Yudi Nofiandi, Sulih Primara Putra
                        </p>
                    </div>

                </div>

                <div class="flex flex-col w-full text-center justify-center mb-24 mt-6">
                    <a class="font-semibold mb-1">Suggested citation:</a>
                    <p>Auriga Nusantara. 2025. Status of Deforestation in Indonesia 2024, accessed on [DD/MM/YYYY] through [LINK].</p>
                </div>

                <div class="flex flex-col w-full text-center justify-center mb-24 mt-6">
                    <p>The translation to Japanese is conducted by <a class="text-simontini underline" href="https://en.jatan.org/" target="_blank">JATAN</a></p>
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
