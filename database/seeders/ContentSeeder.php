<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // SMANUNG TODAY
        Content::create([
            'title' => 'Pelaksanaan Ujian Nasional 2025 Berjalan Lancar',
            'slug' => Str::slug('Pelaksanaan Ujian Nasional 2025 Berjalan Lancar'),
            'excerpt' => 'Seluruh siswa kelas XII mengikuti ujian nasional dengan protokol kesehatan ketat.',
            'content' => 'Pelaksanaan Ujian Nasional 2025 di SMA Negeri Unggulan telah berlangsung dengan lancar. Seluruh siswa kelas XII mengikuti ujian dengan protokol kesehatan yang ketat. Panitia telah menyiapkan segala sesuatunya dengan baik untuk memastikan ujian berjalan sesuai dengan standar yang ditetapkan oleh Kemendikbud.',
            'category' => 'smanung_today',
            'image' => null,
            'author' => 'Panitia UN',
            'status' => 'published',
            'published_date' => '2025-09-19'
        ]);

        Content::create([
            'title' => 'Workshop Kepemimpinan untuk OSIS',
            'slug' => Str::slug('Workshop Kepemimpinan untuk OSIS'),
            'excerpt' => 'Pelatihan kepemimpinan diikuti oleh seluruh pengurus OSIS dan MPK.',
            'content' => 'Workshop kepemimpinan telah diselenggarakan untuk seluruh pengurus OSIS dan MPK. Kegiatan ini bertujuan untuk meningkatkan kemampuan leadership siswa dalam mengelola organisasi sekolah. Materi yang disampaikan meliputi public speaking, manajemen organisasi, dan pengembangan karakter.',
            'category' => 'smanung_today',
            'image' => null,
            'author' => 'Pembina OSIS',
            'status' => 'published',
            'published_date' => '2025-09-18'
        ]);

        Content::create([
            'title' => 'Program Beasiswa untuk Siswa Berprestasi',
            'slug' => Str::slug('Program Beasiswa untuk Siswa Berprestasi'),
            'excerpt' => 'Sekolah memberikan beasiswa penuh untuk 10 siswa berprestasi terbaik.',
            'content' => 'SMA Negeri Unggulan memberikan apresiasi kepada siswa-siswa berprestasi dengan program beasiswa. Sebanyak 10 siswa terpilih mendapatkan beasiswa penuh untuk melanjutkan pendidikan. Kriteria penilaian meliputi prestasi akademik, non-akademik, dan kondisi ekonomi keluarga.',
            'category' => 'smanung_today',
            'image' => null,
            'author' => 'Wakil Kepala Sekolah',
            'status' => 'published',
            'published_date' => '2025-09-17'
        ]);

        // SISWA PRESTASI
        Content::create([
            'title' => 'Juara 1 Kompetisi Robotika Tingkat Provinsi',
            'slug' => Str::slug('Juara 1 Kompetisi Robotika Tingkat Provinsi'),
            'excerpt' => 'Tim robotika sekolah berhasil meraih juara pertama dalam kompetisi bergengsi.',
            'content' => 'Tim robotika SMA Negeri Unggulan yang terdiri dari 3 siswa kelas XI berhasil meraih juara pertama dalam Kompetisi Robotika Tingkat Provinsi. Kompetisi yang diikuti oleh 50 tim dari seluruh sekolah di provinsi ini menguji kemampuan siswa dalam mendesain dan memprogram robot. Prestasi ini membuktikan kualitas pendidikan STEM di sekolah kami.',
            'category' => 'siswa_prestasi',
            'image' => null,
            'author' => 'Pembina Robotika',
            'status' => 'published',
            'published_date' => '2025-09-15'
        ]);

        Content::create([
            'title' => 'Medali Emas Olimpiade Matematika Internasional',
            'slug' => Str::slug('Medali Emas Olimpiade Matematika Internasional'),
            'excerpt' => 'Siswa kelas XI meraih medali emas dalam olimpiade matematika tingkat internasional.',
            'content' => 'Ahmad Fauzi, siswa kelas XI IPA 1, berhasil meraih medali emas dalam International Mathematics Olympiad (IMO) 2025. Prestasi gemilang ini diraih setelah melalui seleksi ketat mulai dari tingkat kabupaten, provinsi, hingga nasional. Ahmad berhasil mengalahkan peserta dari 100 negara di seluruh dunia.',
            'category' => 'siswa_prestasi',
            'image' => null,
            'author' => 'Guru Matematika',
            'status' => 'published',
            'published_date' => '2025-09-14'
        ]);

        // AGENDA SEKOLAH
        Content::create([
            'title' => 'Peringatan Hari Kemerdekaan RI ke-80',
            'slug' => Str::slug('Peringatan Hari Kemerdekaan RI ke-80'),
            'excerpt' => 'Upacara bendera dan berbagai lomba dalam rangka memperingati HUT RI.',
            'content' => 'Dalam rangka memperingati Hari Kemerdekaan RI ke-80, SMA Negeri Unggulan mengadakan serangkaian kegiatan. Dimulai dengan upacara bendera, dilanjutkan dengan berbagai lomba seperti panjat pinang, balap karung, dan lomba makan kerupuk. Kegiatan ini bertujuan untuk menumbuhkan semangat nasionalisme di kalangan siswa.',
            'category' => 'agenda_sekolah',
            'image' => null,
            'author' => 'Panitia HUT RI',
            'status' => 'published',
            'published_date' => '2025-08-17'
        ]);

        Content::create([
            'title' => 'Open House Program Pendidikan',
            'slug' => Str::slug('Open House Program Pendidikan'),
            'excerpt' => 'Acara terbuka untuk memperkenalkan program-program unggulan sekolah.',
            'content' => 'SMA Negeri Unggulan akan mengadakan Open House pada tanggal 25 September 2025. Acara ini terbuka untuk umum, khususnya calon siswa dan orang tua. Dalam acara ini akan diperkenalkan program-program unggulan sekolah, fasilitas yang tersedia, dan prestasi-prestasi yang telah diraih.',
            'category' => 'agenda_sekolah',
            'image' => null,
            'author' => 'Humas',
            'status' => 'published',
            'published_date' => '2025-09-25'
        ]);

        // BERITA UMUM
        Content::create([
            'title' => 'Implementasi Kurikulum Merdeka di Tahun Ajaran Baru',
            'slug' => Str::slug('Implementasi Kurikulum Merdeka di Tahun Ajaran Baru'),
            'excerpt' => 'Sekolah siap menerapkan Kurikulum Merdeka untuk meningkatkan kualitas pembelajaran.',
            'content' => 'SMA Negeri Unggulan telah mempersiapkan diri untuk mengimplementasikan Kurikulum Merdeka di tahun ajaran 2025/2026. Para guru telah mengikuti pelatihan intensif dan menyiapkan perangkat pembelajaran yang sesuai dengan konsep merdeka belajar. Kurikulum ini diharapkan dapat memberikan pembelajaran yang lebih fleksibel dan sesuai dengan kebutuhan siswa.',
            'category' => 'berita',
            'image' => null,
            'author' => 'Tim Kurikulum',
            'status' => 'published',
            'published_date' => '2025-09-10'
        ]);

        Content::create([
            'title' => 'Renovasi Laboratorium Komputer Selesai',
            'slug' => Str::slug('Renovasi Laboratorium Komputer Selesai'),
            'excerpt' => 'Laboratorium komputer baru dilengkapi dengan perangkat terkini untuk mendukung pembelajaran digital.',
            'content' => 'Renovasi laboratorium komputer SMA Negeri Unggulan telah selesai dilakukan. Laboratorium yang baru dilengkapi dengan 40 unit komputer terbaru, proyektor interaktif, dan sistem jaringan yang lebih stabil. Fasilitas ini akan mendukung pembelajaran mata pelajaran Informatika dan kegiatan literasi digital siswa.',
            'category' => 'berita',
            'image' => null,
            'author' => 'Kepala Sekolah',
            'status' => 'published',
            'published_date' => '2025-09-08'
        ]);

        Content::create([
            'title' => 'Kerjasama dengan Universitas Ternama',
            'slug' => Str::slug('Kerjasama dengan Universitas Ternama'),
            'excerpt' => 'MoU ditandatangani untuk program dual enrollment dan bimbingan akademik.',
            'content' => 'SMA Negeri Unggulan menjalin kerjasama strategis dengan beberapa universitas ternama dalam dan luar negeri. MoU yang ditandatangani mencakup program dual enrollment, bimbingan akademik, dan penelitian bersama. Kerjasama ini diharapkan dapat membuka peluang yang lebih luas bagi siswa untuk melanjutkan pendidikan ke jenjang yang lebih tinggi.',
            'category' => 'berita',
            'image' => null,
            'author' => 'Wakil Kepala Sekolah',
            'status' => 'published',
            'published_date' => '2025-09-05'
        ]);
    }
}