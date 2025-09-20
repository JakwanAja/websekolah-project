<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Content;

class HomeController extends Controller
{
    public function index()
    {
        // Data untuk Hero Carousel (tetap static)
        $heroSlides = [
            [
                'title' => 'Portal Berita & Informasi',
                'subtitle' => 'SMA Negeri Unggulan',
                'description' => 'Dapatkan informasi terkini seputar prestasi, kegiatan, dan perkembangan sekolah',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=250&fit=crop',
                'button_text' => 'Jelajahi Berita',
                'button_link' => '#berita-today'
            ],
            [
                'title' => 'Prestasi Gemilang Siswa',
                'subtitle' => 'SMA Negeri Unggulan',
                'description' => 'Siswa-siswi kami terus menorehkan prestasi di tingkat nasional dan internasional',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop',
                'button_text' => 'Lihat Prestasi',
                'button_link' => '#siswa-prestasi'
            ],
            [
                'title' => 'Inovasi Pembelajaran Digital',
                'subtitle' => 'SMA Negeri Unggulan',
                'description' => 'Menerapkan teknologi terdepan dalam proses pembelajaran untuk masa depan yang cerah',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop',
                'button_text' => 'Pelajari Program',
                'button_link' => '#agenda-sekolah'
            ],
            [
                'title' => 'Fasilitas Modern & Lengkap',
                'subtitle' => 'SMA Negeri Unggulan',
                'description' => 'Dilengkapi dengan fasilitas terbaik untuk mendukung kegiatan belajar mengajar',
                'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=1200&h=600&fit=crop',
                'button_text' => 'Lihat Fasilitas',
                'button_link' => '#'
            ]
        ];

        // Data untuk Dynamic Content (dari database)
        $dynamicContent = [
            'berita_today' => Content::published()
                ->byCategory('smanung_today')
                ->orderBy('published_date', 'desc')
                ->limit(3)
                ->get()
                ->map(function($content) {
                    return [
                        'title' => $content->title,
                        'excerpt' => $content->excerpt,
                        'category' => $content->category_display_name,
                        'author' => $content->author,
                        'date' => $content->published_date->format('Y-m-d'),
                        'image' => $content->image_url
                    ];
                })->toArray(),
            
            'siswa_prestasi' => Content::published()
                ->byCategory('siswa_prestasi')
                ->orderBy('published_date', 'desc')
                ->limit(3)
                ->get()
                ->map(function($content) {
                    return [
                        'title' => $content->title,
                        'excerpt' => $content->excerpt,
                        'category' => $content->category_display_name,
                        'author' => $content->author,
                        'date' => $content->published_date->format('Y-m-d'),
                        'image' => $content->image_url
                    ];
                })->toArray(),
            
            'agenda_sekolah' => Content::published()
                ->byCategory('agenda_sekolah')
                ->orderBy('published_date', 'desc')
                ->limit(3)
                ->get()
                ->map(function($content) {
                    return [
                        'title' => $content->title,
                        'excerpt' => $content->excerpt,
                        'category' => $content->category_display_name,
                        'author' => $content->author,
                        'date' => $content->published_date->format('Y-m-d'),
                        'image' => $content->image_url
                    ];
                })->toArray()
        ];

        // Data untuk Posters (tetap static untuk sementara)
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
            ],
            [
                'title' => 'Festival Seni dan Budaya',
                'type' => 'event',
                'date' => '2025-10-05',
                'priority' => 'medium',
                'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=250&fit=crop'
            ]
        ];

        // Data untuk Latest Videos (tetap static untuk sementara)
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
            ],
            [
                'title' => 'Program Pembelajaran Digital',
                'thumbnail' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=480&h=360&fit=crop',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'duration' => '04:15',
                'views' => '698',
                'upload_date' => '2025-09-10'
            ]
        ];

        // Data untuk Editor Picks (dari database)
        $editorPicks = Content::published()
            ->byCategory('berita')
            ->orderBy('published_date', 'desc')
            ->limit(4)
            ->get()
            ->map(function($content) {
                return [
                    'title' => $content->title,
                    'date' => $content->published_date->format('Y-m-d')
                ];
            })->toArray();

        // Jika editor picks kosong, gunakan data dari semua kategori
        if (empty($editorPicks)) {
            $editorPicks = Content::published()
                ->orderBy('published_date', 'desc')
                ->limit(4)
                ->get()
                ->map(function($content) {
                    return [
                        'title' => $content->title,
                        'date' => $content->published_date->format('Y-m-d')
                    ];
                })->toArray();
        }

        // Data untuk Popular Posts (simulasi dari database dengan view count random)
        $popularPosts = Content::published()
            ->inRandomOrder()
            ->limit(4)
            ->get()
            ->map(function($content) {
                return [
                    'title' => $content->title,
                    'date' => $content->published_date->format('Y-m-d'),
                    'views' => rand(1000, 3000) // simulasi view count
                ];
            })->toArray();

        // Data untuk Popular Categories (hitung dari database)
        $popularCategories = [
            [
                'name' => 'SMANUNG Today', 
                'count' => Content::published()->byCategory('smanung_today')->count()
            ],
            [
                'name' => 'Siswa Prestasi', 
                'count' => Content::published()->byCategory('siswa_prestasi')->count()
            ],
            [
                'name' => 'Agenda Sekolah', 
                'count' => Content::published()->byCategory('agenda_sekolah')->count()
            ],
            [
                'name' => 'Berita/Artikel', 
                'count' => Content::published()->byCategory('berita')->count()
            ]
        ];

        // Urutkan berdasarkan jumlah terbanyak
        usort($popularCategories, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        return view('home', compact(
            'heroSlides',
            'dynamicContent',
            'posters',
            'latestVideos',
            'editorPicks',
            'popularPosts',
            'popularCategories'
        ));
    }
}