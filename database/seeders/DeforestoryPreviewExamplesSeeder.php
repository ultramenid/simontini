<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeforestoryPreviewExamplesSeeder extends Seeder
{
    public function run(): void
    {
        // Explicitly invoked local preview fixtures; never included in DatabaseSeeder.
        if (! app()->environment('local')) {
            throw new \RuntimeException('Preview examples may only be seeded locally.');
        }

        $topics = [
            ['Hutan Alam', 'Natural Forest', 'Menjaga Bentang Hutan', 'Protecting Forest Landscapes', 'konektivitas hutan dan perlindungan habitat', 'forest connectivity and habitat protection', ['Aceh', 'Papua', 'Kalimantan Barat']],
            ['Gambut', 'Peatland', 'Mengenal Tata Air Gambut', 'Understanding Peatland Hydrology', 'tata air dan upaya pembasahan kembali', 'water management and rewetting', ['Riau', 'Jambi', 'Kalimantan Tengah']],
            ['Mangrove', 'Mangrove', 'Merawat Hutan Pesisir', 'Caring for Coastal Forests', 'pemulihan mangrove dan penghidupan pesisir', 'mangrove recovery and coastal livelihoods', ['Sumatera Utara', 'Kalimantan Utara', 'Papua Barat']],
            ['Pertambangan', 'Mining', 'Membaca Perubahan Bentang Alam', 'Reading Landscape Changes', 'perubahan tutupan lahan dan pemantauan aliran sungai', 'land-cover change and river monitoring', ['Sulawesi Tenggara', 'Maluku Utara', 'Kalimantan Timur']],
            ['Perkebunan', 'Plantation', 'Memantau Batas Hutan dan Kebun', 'Monitoring Forest and Plantation Boundaries', 'batas penggunaan lahan dan perlindungan hutan tersisa', 'land-use boundaries and remaining forest protection', ['Sumatera Selatan', 'Bengkulu', 'Kalimantan Selatan']],
            ['Konservasi', 'Conservation', 'Menghubungkan Ruang Hidup Satwa', 'Connecting Wildlife Habitats', 'koridor satwa dan keterhubungan habitat', 'wildlife corridors and habitat connectivity', ['Lampung', 'Sulawesi Utara', 'Nusa Tenggara Timur']],
            ['Hutan Adat', 'Customary Forest', 'Merawat Hutan Bersama Masyarakat', 'Caring for Forests with Communities', 'pengetahuan lokal dan pengelolaan hutan partisipatif', 'local knowledge and participatory forest management', ['Sumatera Barat', 'Sulawesi Selatan', 'Maluku']],
            ['Restorasi', 'Restoration', 'Menumbuhkan Kembali Tutupan Hutan', 'Restoring Forest Cover', 'pemulihan vegetasi dan pemantauan jangka panjang', 'vegetation recovery and long-term monitoring', ['Jawa Barat', 'Jawa Tengah', 'Nusa Tenggara Barat']],
        ];

        $image = 'deforestory/examples/forest-illustration.jpg';
        Storage::disk('public')->put($image, file_get_contents(public_path('assets/images/stadi2025/Deforestasi, Kawasan Hutan Lindung.jpg')));

        DB::transaction(function () use ($topics, $image) {
            foreach ($topics as $topicIndex => [$categoryId, $categoryEn, $titleId, $titleEn, $focusId, $focusEn, $regions]) {
                foreach ($regions as $regionIndex => $region) {
                    $slug = 'contoh-preview-'.Str::slug($categoryId.'-'.$region);
                    // Reruns preserve any edits made in the CMS.
                    if (DB::table('deforestory')->where('slug', $slug)->exists()) {
                        continue;
                    }
                    $descriptionId = "Contoh cerita tentang {$focusId} di {$region}. Materi simulasi untuk meninjau tampilan Deforestory, bukan laporan kejadian terverifikasi.";
                    $descriptionEn = "Sample story about {$focusEn} in {$region}. Demonstration content for the Deforestory preview, not a verified incident report.";
                    $paragraphsId = [
                        'Materi ini merupakan contoh untuk pratinjau tata letak. Nama daerah digunakan sebagai konteks contoh dan tidak menyatakan adanya kejadian atau temuan lapangan tertentu.',
                        "Cerita bertema {$categoryId} ini mengambil latar {$region}, dengan fokus pada {$focusId}. Bagian pembuka menyediakan ruang untuk menjelaskan bentang alam dan pertanyaan utama yang akan ditelusuri.",
                        'Dalam artikel yang telah diverifikasi, bagian analisis dapat memuat perbandingan citra, periode pengamatan, sumber data, dan batas ketelitiannya. Angka perubahan tutupan lahan harus dilengkapi metode yang dapat diperiksa.',
                        'Bagian pengamatan lapangan dapat dilengkapi keterangan warga, dokumentasi lokasi, serta tanggapan pihak terkait. Contoh ini belum memuat wawancara, pengukuran, atau bukti lapangan.',
                        "Penutup dapat merangkum kebutuhan pemantauan {$focusId}, pihak yang perlu dilibatkan, dan informasi lanjutan yang masih diperlukan. Seluruh materi contoh perlu diganti dengan data terverifikasi sebelum dipublikasikan.",
                    ];
                    $paragraphsEn = [
                        'This is demonstration content for layout preview. The region provides sample context and does not indicate a specific incident or field finding.',
                        "This {$categoryEn} story is set in {$region} and focuses on {$focusEn}. The introduction provides space to describe the landscape and the questions to be explored.",
                        'A verified article may include imagery comparisons, observation periods, data sources, and uncertainty. Forest-cover change figures should be accompanied by a reproducible method.',
                        'Field observations may include community accounts, location photographs, and responses from relevant parties. This example contains no interviews, measurements, or field evidence.',
                        "The conclusion can describe monitoring needs for {$focusEn}, participants, and outstanding questions. Replace all sample material with verified information before publication.",
                    ];
                    $html = fn (array $paragraphs) => collect($paragraphs)->map(fn ($text) => '<p>'.e($text).'</p>')->implode("\n");
                    DB::table('deforestory')->insert([
                        'uuid' => (string) Str::uuid(), 'slug' => $slug,
                        'title_id' => "[Contoh] {$titleId} di {$region}",
                        'title_en' => "[Sample] {$titleEn} in {$region}",
                        'category_id' => $categoryId, 'category_en' => $categoryEn,
                        'region_id' => $region, 'region_en' => $region,
                        'meta_font_size' => 14,
                        'desrkirpsi_id' => $descriptionId, 'desrkirpsi_en' => $descriptionEn,
                        'content_type' => 'template',
                        'content_id' => $html($paragraphsId), 'content_en' => $html($paragraphsEn),
                        'image_id' => $image, 'image_en' => $image,
                        'date' => now()->startOfDay()->subDays($topicIndex * 3 + $regionIndex)->toDateString(),
                        'status' => 'draft', 'created_at' => now(), 'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
