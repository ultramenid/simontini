<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeforestoryContentSeeder extends Seeder
{
    public function run(): void
    {
        $stories = [
            [
                'title_id' => 'Menjaga Hutan Alam Papua dari Tekanan Jalan Baru',
                'title_en' => 'Protecting Papua’s Natural Forests from New Road Pressure',
                'description_id' => 'Pemantauan ini menyoroti perubahan hutan Papua akibat jalan baru serta dampaknya pada keanekaragaman hayati dan kehidupan masyarakat adat.',
                'description_en' => 'This story monitors forest change from new roads in Papua and its impacts on biodiversity and Indigenous communities that depend on the forest.',
                'date' => '2026-08-17',
                'images' => ['Hutan+Alam+Papua', 'Pemantauan+Papua', 'Bentang+Alam+Papua'],
                'captions_id' => [
                    'Bentang hutan alam Papua yang menjadi ruang hidup masyarakat dan beragam satwa.',
                    'Pemantauan perubahan tutupan lahan dilakukan dengan membandingkan citra dari beberapa periode.',
                    'Dokumentasi lapangan membantu memastikan kondisi yang terlihat melalui citra.',
                ],
                'captions_en' => [
                    'Papua’s natural forest landscape supports local communities and diverse wildlife.',
                    'Forest-cover change is monitored by comparing imagery from several periods.',
                    'Field documentation helps verify conditions identified through imagery.',
                ],
                'paragraphs_id' => [
                    'Hutan alam Papua menyimpan keanekaragaman hayati tinggi sekaligus menopang sumber pangan, air, dan kebudayaan masyarakat adat. Bentang alam yang masih terhubung membuat satwa dapat bergerak dan menjaga proses ekologis tetap berlangsung.',
                    'Pembangunan jalan membuka akses menuju wilayah yang sebelumnya sulit dijangkau. Tanpa perencanaan dan pengawasan yang kuat, akses baru dapat diikuti pembukaan lahan, penebangan, serta fragmentasi habitat.',
                    'Pemantauan berkala diperlukan untuk mengenali perubahan sejak dini. Citra satelit dapat menunjukkan bukaan baru, sedangkan informasi masyarakat dan verifikasi lapangan membantu menjelaskan penyebab serta dampaknya.',
                    'Data dari berbagai sumber perlu dibaca secara bersama agar keputusan tidak hanya mempertimbangkan panjang jalan atau nilai investasi. Perlindungan wilayah penting, hak masyarakat adat, dan daya dukung lingkungan harus menjadi dasar perencanaan.',
                    'Keterbukaan data dan pengawasan bersama dapat mencegah kerusakan meluas. Setiap pembangunan perlu memastikan hutan bernilai konservasi tinggi tetap terlindungi dan masyarakat terlibat sejak awal.',
                ],
                'paragraphs_en' => [
                    'Papua’s natural forests hold exceptional biodiversity while supporting the food, water, and cultures of Indigenous communities. Connected landscapes allow wildlife to move and ecological processes to continue.',
                    'Road development creates access to areas that were previously difficult to reach. Without strong planning and oversight, new access can be followed by land clearing, logging, and habitat fragmentation.',
                    'Regular monitoring is needed to identify change early. Satellite imagery can reveal new clearings, while community information and field verification help explain their causes and impacts.',
                    'Evidence from different sources must be assessed together so decisions consider more than road length or investment value. Important habitats, Indigenous rights, and environmental capacity must guide planning.',
                    'Open data and joint oversight can prevent damage from expanding. Every development plan should protect high-conservation-value forests and involve communities from the beginning.',
                ],
            ],
            [
                'title_id' => 'Memulihkan Gambut Kalimantan setelah Kebakaran',
                'title_en' => 'Restoring Kalimantan’s Peatlands after Fire',
                'description_id' => 'Cerita ini membahas kebakaran gambut Kalimantan, perubahan tata air, pemantauan titik panas, pembasahan kembali, dan pencegahan bersama warga.',
                'description_en' => 'This story examines peat fires in Kalimantan, water-system changes, hotspot monitoring, rewetting, and community-based fire prevention.',
                'date' => '2026-08-16',
                'images' => ['Gambut+Kalimantan', 'Kanal+Gambut', 'Pemulihan+Gambut'],
                'captions_id' => [
                    'Lanskap gambut menyimpan karbon dan mengatur air bagi wilayah di sekitarnya.',
                    'Kanal dapat mengeringkan gambut apabila tata air tidak dikelola dengan baik.',
                    'Pemulihan vegetasi dilakukan setelah kondisi air gambut kembali stabil.',
                ],
                'captions_en' => [
                    'Peat landscapes store carbon and regulate water for surrounding areas.',
                    'Canals can dry peat when water management is inadequate.',
                    'Vegetation recovery follows the restoration of stable peat water levels.',
                ],
                'paragraphs_id' => [
                    'Ekosistem gambut terbentuk selama ribuan tahun dan menyimpan karbon dalam jumlah besar. Ketika tetap basah, gambut juga membantu mengurangi banjir, menjaga kualitas air, dan menyediakan habitat bagi berbagai spesies.',
                    'Pengeringan melalui kanal membuat permukaan air turun dan gambut mudah terbakar. Api dapat merambat di bawah permukaan, sulit dipadamkan, serta menghasilkan asap yang berdampak pada kesehatan masyarakat.',
                    'Pemantauan titik panas perlu dilengkapi pengukuran tinggi muka air dan pemeriksaan lapangan. Kombinasi data tersebut membantu menentukan lokasi rawan serta menilai apakah penanganan yang dilakukan sudah efektif.',
                    'Sekat kanal, pembasahan kembali, dan perlindungan area yang belum rusak merupakan bagian penting pemulihan. Kegiatan ini harus disesuaikan dengan kondisi hidrologi dan kebutuhan warga yang hidup di sekitar gambut.',
                    'Pemulihan gambut membutuhkan kerja jangka panjang. Pencegahan kebakaran, dukungan mata pencaharian berkelanjutan, dan pengawasan partisipatif harus berjalan bersama agar kerusakan tidak berulang.',
                ],
                'paragraphs_en' => [
                    'Peat ecosystems form over thousands of years and store vast amounts of carbon. When kept wet, they also reduce floods, maintain water quality, and provide habitat for many species.',
                    'Drainage canals lower the water table and make peat vulnerable to fire. Flames can spread below the surface, become difficult to extinguish, and produce smoke that harms public health.',
                    'Hotspot monitoring should be combined with water-table measurements and field inspection. Together, these data identify vulnerable areas and show whether interventions are effective.',
                    'Canal blocking, rewetting, and protecting intact areas are central to recovery. Each measure must respond to local hydrology and the needs of communities living around the peatlands.',
                    'Peatland recovery is a long-term effort. Fire prevention, sustainable livelihoods, and participatory monitoring must work together to keep damage from recurring.',
                ],
            ],
            [
                'title_id' => 'Koridor Gajah Sumatra yang Semakin Terdesak',
                'title_en' => 'Sumatran Elephant Corridors under Growing Pressure',
                'description_id' => 'Cerita ini menelusuri kehilangan hutan, penyempitan koridor gajah Sumatra, konflik dengan manusia, serta pentingnya pemantauan dan tata ruang.',
                'description_en' => 'This story traces forest loss, shrinking Sumatran elephant corridors, human conflict, and the importance of monitoring and spatial planning.',
                'date' => '2026-08-15',
                'images' => ['Koridor+Gajah+Sumatra', 'Hutan+Sumatra', 'Pemantauan+Satwa'],
                'captions_id' => [
                    'Koridor hutan menghubungkan habitat penting bagi pergerakan gajah Sumatra.',
                    'Perubahan tutupan lahan dapat memutus jalur pergerakan satwa.',
                    'Jejak dan informasi warga menjadi bagian dari pemantauan lapangan.',
                ],
                'captions_en' => [
                    'Forest corridors connect habitats that are important for Sumatran elephant movement.',
                    'Land-cover change can sever wildlife movement routes.',
                    'Tracks and community information form part of field monitoring.',
                ],
                'paragraphs_id' => [
                    'Gajah Sumatra membutuhkan ruang jelajah luas untuk mencari pakan, air, dan tempat berlindung. Koridor hutan memungkinkan kelompok gajah bergerak di antara habitat tanpa harus melewati permukiman atau kebun warga.',
                    'Ketika hutan terpecah, pilihan jalur gajah menjadi semakin terbatas. Pertemuan dengan manusia dapat meningkat dan menimbulkan kerugian bagi warga sekaligus risiko keselamatan bagi gajah.',
                    'Analisis perubahan tutupan lahan membantu menunjukkan bagian koridor yang menyempit atau terputus. Data tersebut perlu dipadukan dengan catatan pergerakan satwa, laporan warga, dan pemeriksaan langsung.',
                    'Pencegahan konflik tidak cukup dilakukan saat gajah sudah memasuki kebun. Perlindungan koridor, tata ruang yang mempertahankan konektivitas, serta sistem peringatan dini perlu dibangun secara konsisten.',
                    'Solusi yang bertahan lama harus melibatkan masyarakat dan memastikan keselamatan kedua pihak. Menjaga koridor berarti menjaga ruang hidup gajah sekaligus mengurangi risiko bagi desa di sekitarnya.',
                ],
                'paragraphs_en' => [
                    'Sumatran elephants need extensive ranges to find food, water, and shelter. Forest corridors allow herds to move between habitats without crossing settlements or community farms.',
                    'As forests become fragmented, elephants have fewer routes available. Encounters with people can increase, causing losses for communities and safety risks for elephants.',
                    'Land-cover analysis can identify corridor sections that are narrowing or disconnected. This evidence should be combined with movement records, community reports, and direct field checks.',
                    'Conflict prevention cannot begin only after elephants enter farmland. Corridor protection, spatial plans that maintain connectivity, and reliable early-warning systems are all needed.',
                    'Lasting solutions must involve communities and protect both people and wildlife. Maintaining corridors safeguards elephant habitat while reducing risks for surrounding villages.',
                ],
            ],
            [
                'title_id' => 'Mangrove sebagai Benteng Pesisir Indonesia',
                'title_en' => 'Mangroves as Indonesia’s Coastal Shield',
                'description_id' => 'Cerita ini membahas peran mangrove dalam melindungi pesisir, menyimpan karbon, menopang biota, serta mendukung penghidupan masyarakat pesisir.',
                'description_en' => 'This story explores how mangroves protect coastlines, store carbon, support wildlife, and sustain the livelihoods of coastal communities.',
                'date' => '2026-08-14',
                'images' => ['Mangrove+Indonesia', 'Pesisir+Mangrove', 'Restorasi+Mangrove'],
                'captions_id' => [
                    'Mangrove membentuk perlindungan alami di perbatasan darat dan laut.',
                    'Tutupan mangrove yang sehat menjadi tempat tumbuh berbagai biota pesisir.',
                    'Pemulihan mangrove perlu mengikuti kondisi pasang surut dan jenis habitat setempat.',
                ],
                'captions_en' => [
                    'Mangroves provide natural protection where land meets the sea.',
                    'Healthy mangrove cover serves as a nursery for diverse coastal species.',
                    'Mangrove recovery must follow local tidal patterns and habitat conditions.',
                ],
                'paragraphs_id' => [
                    'Mangrove membantu meredam gelombang, menahan sedimen, dan mengurangi abrasi di kawasan pesisir. Akarnya menjadi tempat berlindung dan berkembang bagi ikan, kepiting, serta biota lain yang bernilai ekologis dan ekonomi.',
                    'Bagi banyak desa pesisir, mangrove berhubungan langsung dengan perikanan dan keamanan ruang hidup. Hilangnya tutupan mangrove dapat membuat garis pantai lebih rentan sekaligus mengurangi hasil tangkapan masyarakat.',
                    'Perubahan mangrove dapat dipantau melalui citra berkala dan pengamatan lapangan. Pemetaan perlu membedakan kehilangan permanen, perubahan musiman, serta area yang sedang mengalami pemulihan alami.',
                    'Penanaman bukan satu-satunya jawaban. Pemulihan aliran air, perlindungan tegakan yang tersisa, pemilihan jenis yang sesuai, dan penghentian penyebab kerusakan sering kali lebih menentukan keberhasilan.',
                    'Mangrove yang sehat memberikan manfaat bagi iklim, keanekaragaman hayati, dan masyarakat. Pengelolaannya perlu menempatkan pengetahuan lokal serta akses masyarakat sebagai bagian utama perlindungan pesisir.',
                ],
                'paragraphs_en' => [
                    'Mangroves reduce wave energy, trap sediment, and limit erosion along coastlines. Their roots shelter fish, crabs, and other species with ecological and economic value.',
                    'For many coastal villages, mangroves are directly linked to fisheries and secure living space. Losing mangrove cover can expose shorelines while reducing community catches.',
                    'Mangrove change can be monitored through regular imagery and field observation. Mapping should distinguish permanent loss, seasonal change, and areas undergoing natural recovery.',
                    'Planting is not the only answer. Restoring water flows, protecting remaining stands, selecting suitable species, and stopping the causes of damage often determine success.',
                    'Healthy mangroves benefit the climate, biodiversity, and communities. Their management should place local knowledge and community access at the centre of coastal protection.',
                ],
            ],
            [
                'title_id' => 'Membaca Jejak Pertambangan Nikel di Sulawesi',
                'title_en' => 'Tracing the Footprint of Nickel Mining in Sulawesi',
                'description_id' => 'Pemantauan ini membaca perubahan bentang alam akibat tambang nikel Sulawesi, dari pembukaan hutan hingga risiko sedimentasi di sungai dan pesisir.',
                'description_en' => 'This story examines landscape change from nickel mining in Sulawesi, from forest clearing to sediment risks in rivers and coastal waters.',
                'date' => '2026-08-13',
                'images' => ['Tambang+Nikel+Sulawesi', 'Bentang+Alam+Sulawesi', 'Pesisir+Sulawesi'],
                'captions_id' => [
                    'Perubahan bentang alam terlihat pada wilayah pembukaan dan infrastruktur pertambangan.',
                    'Analisis citra membantu membandingkan kondisi sebelum dan setelah pembukaan lahan.',
                    'Wilayah aliran sungai dan pesisir perlu dipantau bersama dengan area tambang.',
                ],
                'captions_en' => [
                    'Landscape change is visible across cleared areas and mining infrastructure.',
                    'Imagery analysis compares conditions before and after land clearing.',
                    'Watersheds and coastal zones should be monitored alongside mining areas.',
                ],
                'paragraphs_id' => [
                    'Sulawesi memiliki hutan, sungai, dan wilayah pesisir yang saling terhubung. Di sejumlah tempat, kawasan tersebut juga bertumpang tindih dengan cadangan nikel dan pembangunan fasilitas pengolahan.',
                    'Pembukaan lahan mengubah permukaan tanah serta aliran air. Apabila pengendalian erosi tidak berjalan baik, sedimen dapat bergerak menuju sungai dan pesisir serta memengaruhi habitat dan kegiatan masyarakat.',
                    'Citra satelit membantu melihat perkembangan bukaan tambang, jalan, dan timbunan material dari waktu ke waktu. Verifikasi lapangan diperlukan untuk memeriksa kondisi drainase, sedimentasi, dan kepatuhan pengelolaan lingkungan.',
                    'Pemantauan harus mencakup keseluruhan bentang alam, bukan hanya batas izin. Dampak di hilir, akses masyarakat, keselamatan pekerja, dan pemulihan lahan perlu dinilai secara terbuka dan berkala.',
                    'Transisi industri yang bertanggung jawab membutuhkan standar lingkungan yang kuat dan data yang dapat diperiksa publik. Kerusakan harus dicegah sejak perencanaan, sementara area terdampak wajib dipulihkan secara terukur.',
                ],
                'paragraphs_en' => [
                    'Sulawesi’s forests, rivers, and coastal zones form interconnected systems. In some places, these landscapes overlap with nickel deposits and the development of processing facilities.',
                    'Land clearing alters soil surfaces and water flows. Where erosion controls are weak, sediment can travel into rivers and coastal waters, affecting habitats and community activities.',
                    'Satellite imagery tracks the expansion of mines, roads, and material stockpiles over time. Field verification is needed to inspect drainage, sedimentation, and compliance with environmental safeguards.',
                    'Monitoring must cover the whole landscape rather than stopping at permit boundaries. Downstream impacts, community access, worker safety, and land recovery should be assessed openly and regularly.',
                    'A responsible industrial transition requires strong environmental standards and publicly verifiable evidence. Damage must be prevented during planning, while affected areas must undergo measurable recovery.',
                ],
            ],
        ];

        foreach ($stories as $story) {
            $slug = Str::slug($story['title_id']);
            $values = [
                'title_id' => $story['title_id'],
                'title_en' => $story['title_en'],
                'desrkirpsi_id' => $story['description_id'],
                'desrkirpsi_en' => $story['description_en'],
                'content_type' => 'template',
                'date' => $story['date'],
                'content_id' => $this->content($story['images'], $story['captions_id'], $story['paragraphs_id']),
                'content_en' => $this->content($story['images'], $story['captions_en'], $story['paragraphs_en']),
                'status' => 'draft',
                'updated_at' => now(),
            ];

            if (DB::table('deforestory')->where('slug', $slug)->exists()) {
                DB::table('deforestory')->where('slug', $slug)->update($values);

                continue;
            }

            DB::table('deforestory')->insert([
                ...$values,
                'uuid' => (string) Str::uuid(),
                'slug' => $slug,
                'created_at' => now(),
            ]);
        }
    }

    /**
     * @param  array<int, string>  $images
     * @param  array<int, string>  $captions
     * @param  array<int, string>  $paragraphs
     */
    private function content(array $images, array $captions, array $paragraphs): string
    {
        return sprintf(
            '<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=%s" alt="%s" width="100%%"><figcaption class="story-content-caption">%s</figcaption></figure>'."\n".
            '<p>%s</p>'."\n".
            '<p>%s</p>'."\n".
            '<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=%s" alt="%s" width="100%%"><figcaption class="story-content-caption">%s</figcaption></figure>'."\n".
            '<p>%s</p>'."\n".
            '<p>%s</p>'."\n".
            '<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=%s" alt="%s" width="100%%"><figcaption class="story-content-caption">%s</figcaption></figure>'."\n".
            '<p>%s</p>',
            $images[0],
            e($captions[0]),
            e($captions[0]),
            e($paragraphs[0]),
            e($paragraphs[1]),
            $images[1],
            e($captions[1]),
            e($captions[1]),
            e($paragraphs[2]),
            e($paragraphs[3]),
            $images[2],
            e($captions[2]),
            e($captions[2]),
            e($paragraphs[4]),
        );
    }
}
