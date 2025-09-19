<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Data untuk Hero Carousel
        $heroSlides = [
            [
                'title' => 'Selamat Datang di SMA Negeri Unggulan',
                'subtitle' => 'Pendidikan Berkualitas',
                'description' => 'Membentuk generasi cerdas dan berkarakter dengan fasilitas modern dan tenaga pengajar profesional.',
                'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1200&h=600&fit=crop',
                'button_text' => 'Pelajari Lebih Lanjut',
                'button_link' => '/tentang'
            ],
            [
                'title' => 'Prestasi Gemilang Siswa Kami',
                'subtitle' => 'Kebanggaan Sekolah',
                'description' => 'Siswa-siswi kami meraih berbagai prestasi di tingkat nasional dan internasional.',
                'image' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1200&h=600&fit=crop',
                'button_text' => 'Lihat Prestasi',
                'button_link' => '/prestasi'
            ],
            [
                'title' => 'Fasilitas Modern dan Lengkap',
                'subtitle' => 'Infrastruktur Terbaik',
                'description' => 'Dilengkapi dengan laboratorium, perpustakaan digital, dan fasilitas olahraga yang memadai.',
                'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=1200&h=600&fit=crop',
                'button_text' => 'Jelajahi Fasilitas',
                'button_link' => '/fasilitas'
            ]
        ];

        // Data untuk Quick Info
        $quickInfo = [
            [
                'title' => 'Pendaftaran Siswa Baru',
                'description' => 'Buka pendaftaran untuk tahun ajaran baru dengan berbagai program unggulan.',
                'icon' => 'fas fa-user-graduate',
                'color' => 'primary',
                'link' => '/pendaftaran'
            ],
            [
                'title' => 'Program Unggulan',
                'description' => 'Kelas olimpiade, MIPA unggulan, dan program akselerasi untuk siswa berprestasi.',
                'icon' => 'fas fa-trophy',
                'color' => 'success',
                'link' => '/program'
            ],
            [
                'title' => 'Ekstrakurikuler',
                'description' => 'Lebih dari 20 kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat.',
                'icon' => 'fas fa-users',
                'color' => 'warning',
                'link' => '/ekstrakurikuler'
            ],
            [
                'title' => 'Konsultasi Akademik',
                'description' => 'Layanan bimbingan konseling dan konsultasi akademik untuk siswa.',
                'icon' => 'fas fa-comments',
                'color' => 'info',
                'link' => '/konsultasi'
            ]
        ];

        // Data untuk Announcements/Pengumuman
        $announcements = [
            [
                'title' => 'Pengumuman Libur Semester',
                'type' => 'Pengumuman',
                'date' => '2025-09-15',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Pendaftaran Olimpiade Matematika',
                'type' => 'Kompetisi',
                'date' => '2025-09-18',
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Workshop Coding untuk Siswa',
                'type' => 'Kegiatan',
                'date' => '2025-09-20',
                'image' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Ujian Tengah Semester',
                'type' => 'Akademik',
                'date' => '2025-10-01',
                'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Festival Seni dan Budaya',
                'type' => 'Event',
                'date' => '2025-10-05',
                'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Rapat Orang Tua Siswa',
                'type' => 'Rapat',
                'date' => '2025-10-10',
                'image' => 'https://images.unsplash.com/photo-1560439514-4e9645039924?w=400&h=250&fit=crop'
            ]
        ];

        // Data untuk Featured Video
        $featuredVideo = [
            'title' => 'Profil SMA Negeri Unggulan 2025',
            'thumbnail' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&h=400&fit=crop',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'
        ];

        // Data untuk Media Gallery
        $mediaGallery = [
            [
                'title' => 'Kegiatan Pembelajaran',
                'thumbnail' => 'https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=300&h=200&fit=crop',
                'full_url' => 'https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=800&h=600&fit=crop'
            ],
            [
                'title' => 'Laboratorium Komputer',
                'thumbnail' => 'https://images.unsplash.com/photo-1484807352052-23338990c6c6?w=300&h=200&fit=crop',
                'full_url' => 'https://images.unsplash.com/photo-1484807352052-23338990c6c6?w=800&h=600&fit=crop'
            ],
            [
                'title' => 'Perpustakaan Digital',
                'thumbnail' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=200&fit=crop',
                'full_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop'
            ],
            [
                'title' => 'Lapangan Olahraga',
                'thumbnail' => 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?w=300&h=200&fit=crop',
                'full_url' => 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?w=800&h=600&fit=crop'
            ]
        ];

        // Data untuk Latest News
        $latestNews = [
            [
                'title' => 'Siswa SMA Negeri Unggulan Raih Juara 1 Olimpiade Fisika Nasional',
                'excerpt' => 'Prestasi membanggakan kembali diraih siswa kami dalam kompetisi tingkat nasional...',
                'category' => 'Prestasi',
                'author' => 'Admin',
                'date' => '2025-09-18',
                'image' => 'https://images.unsplash.com/photo-1636466497217-26a8cbeaf0aa?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Launching Program Kelas Digital berbasis AI',
                'excerpt' => 'Sekolah meluncurkan program inovatif untuk mempersiapkan siswa menghadapi era digital...',
                'category' => 'Program',
                'author' => 'Kepala Sekolah',
                'date' => '2025-09-17',
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400&h=250&fit=crop'
            ],
            [
                'title' => 'Kunjungan Industri ke Perusahaan Teknologi Terkemuka',
                'excerpt' => 'Siswa kelas XII berkesempatan mengunjungi perusahaan teknologi untuk menambah wawasan...',
                'category' => 'Kegiatan',
                'author' => 'Guru BK',
                'date' => '2025-09-16',
                'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=400&h=250&fit=crop'
            ]
        ];

        // Data untuk Dynamic Content (untuk versi portal berita)
        $dynamicContent = [
            'berita_today' => [
                [
                    'title' => 'Pelaksanaan Ujian Nasional 2025 Berjalan Lancar',
                    'excerpt' => 'Seluruh siswa kelas XII mengikuti ujian nasional dengan protokol kesehatan ketat.',
                    'category' => 'Pendidikan',
                    'author' => 'Panitia UN',
                    'date' => '2025-09-19',
                    'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=250&fit=crop'
                ],
                [
                    'title' => 'Workshop Kepemimpinan untuk OSIS',
                    'excerpt' => 'Pelatihan kepemimpinan diikuti oleh seluruh pengurus OSIS dan MPK.',
                    'category' => 'Kegiatan',
                    'author' => 'Pembina OSIS',
                    'date' => '2025-09-18',
                    'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop'
                ],
                [
                    'title' => 'Program Beasiswa untuk Siswa Berprestasi',
                    'excerpt' => 'Sekolah memberikan beasiswa penuh untuk 10 siswa berprestasi terbaik.',
                    'category' => 'Beasiswa',
                    'author' => 'Wakil Kepala Sekolah',
                    'date' => '2025-09-17',
                    'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop'
                ]
            ],
            'siswa_prestasi' => [
                [
                    'title' => 'Juara 1 Kompetisi Robotika Tingkat Provinsi',
                    'excerpt' => 'Tim robotika sekolah berhasil meraih juara pertama dalam kompetisi bergengsi.',
                    'category' => 'Robotika',
                    'author' => 'Pembina Robotika',
                    'date' => '2025-09-15',
                    'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=250&fit=crop'
                ],
                [
                    'title' => 'Medali Emas Olimpiade Matematika Internasional',
                    'excerpt' => 'Siswa kelas XI meraih medali emas dalam olimpiade matematika tingkat internasional.',
                    'category' => 'Matematika',
                    'author' => 'Guru Matematika',
                    'date' => '2025-09-14',
                    'image' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=400&h=250&fit=crop'
                ]
            ],
            'agenda_sekolah' => [
                [
                    'title' => 'Peringatan Hari Kemerdekaan RI ke-80',
                    'excerpt' => 'Upacara bendera dan berbagai lomba dalam rangka memperingati HUT RI.',
                    'category' => 'Nasional',
                    'author' => 'Panitia HUT RI',
                    'date' => '2025-08-17',
                    'image' => 'https://images.unsplash.com/photo-1569949381669-ecf31ae8e613?w=400&h=250&fit=crop'
                ],
                [
                    'title' => 'Open House Program Pendidikan',
                    'excerpt' => 'Acara terbuka untuk memperkenalkan program-program unggulan sekolah.',
                    'category' => 'Promosi',
                    'author' => 'Humas',
                    'date' => '2025-09-25',
                    'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&h=250&fit=crop'
                ]
            ]
        ];

        // Data untuk Posters
        $posters = [
            [
                'title' => 'Pendaftaran Siswa Baru 2025/2026',
                'type' => 'pendaftaran',
                'date' => '2025-01-15',
                'priority' => 'high',
                'image' => 'https://i.pinimg.com/736x/f8/1e/5d/f81e5ddc58f6a98b1237eed47af355fc.jpg'
            ],
            [
                'title' => 'Kompetisi Sains Nasional',
                'type' => 'kompetisi',
                'date' => '2025-03-20',
                'priority' => 'medium',
                'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&h=800&fit=crop'
            ]
        ];

        // Data untuk Latest Videos
        $latestVideos = [
            [
                'title' => 'Profil Sekolah 2025',
                'thumbnail' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=480&h=360&fit=crop',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration' => '05:30',
                'views' => '1,234',
                'upload_date' => '2025-09-15'
            ],
            [
                'title' => 'Kegiatan Ekstrakurikuler',
                'thumbnail' => 'https://images.unsplash.com/photo-1551731409-43eb3e517a1a?w=480&h=360&fit=crop',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration' => '03:45',
                'views' => '856',
                'upload_date' => '2025-09-12'
            ]
        ];

        // Data untuk Editor Picks
        $editorPicks = [
            [
                'title' => 'Program Unggulan Tahun 2025',
                'date' => '2025-09-18'
            ],
            [
                'title' => 'Prestasi Terbaru Siswa',
                'date' => '2025-09-17'
            ],
            [
                'title' => 'Inovasi Pembelajaran Digital',
                'date' => '2025-09-16'
            ]
        ];

        // Data untuk Popular Posts
        $popularPosts = [
            [
                'title' => 'Tips Sukses Ujian Nasional',
                'date' => '2025-09-15',
                'views' => '2,145'
            ],
            [
                'title' => 'Panduan Memilih Jurusan Kuliah',
                'date' => '2025-09-14',
                'views' => '1,876'
            ],
            [
                'title' => 'Kegiatan Pembelajaran Jarak Jauh',
                'date' => '2025-09-13',
                'views' => '1,654'
            ]
        ];

        // Data untuk Popular Categories
        $popularCategories = [
            ['name' => 'Prestasi', 'count' => 45],
            ['name' => 'Kegiatan', 'count' => 38],
            ['name' => 'Akademik', 'count' => 29],
            ['name' => 'Ekstrakurikuler', 'count' => 22]
        ];

        return view('home', compact(
            'heroSlides',
            'quickInfo', 
            'announcements', 
            'featuredVideo', 
            'mediaGallery', 
            'latestNews',
            'dynamicContent',
            'posters',
            'latestVideos',
            'editorPicks',
            'popularPosts',
            'popularCategories'
        ));
    }
}