<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Content;
use App\Services\YouTubeService;

class HomeController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

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
                        'image' => $content->image_url,
                        'slug' => $content->slug // Tambahkan slug
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
                        'image' => $content->image_url,
                        'slug' => $content->slug // Tambahkan slug
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
                        'image' => $content->image_url,
                        'slug' => $content->slug // Tambahkan slug
                    ];
                })->toArray()
        ];

        // Get YouTube data
        $channelHandle = env('YOUTUBE_CHANNEL_HANDLE', '@pertajampolapikir');
        $channelInfo = $this->youtubeService->getChannelInfo($channelHandle);
        $latestVideos = $this->youtubeService->getChannelVideos($channelHandle, 6);

        // Video categories for tabs (untuk implementasi future)
        $videoCategories = [
            'terbaru' => $latestVideos,
            'ramadhan' => [],
            'profil' => []
        ];

        // Data untuk Posters 
        $posters = Content::published()
            ->whereIn('category', ['smanung_today', 'siswa_prestasi', 'agenda_sekolah'])
            ->inRandomOrder()
            ->limit(3) // Ambil 3 artikel random
            ->get()
            ->map(function($content) {
                $daysDiff = now()->diffInDays($content->published_date);
                $priority = $daysDiff <= 7 ? 'high' : 'medium'; 
                
                return [
                    'title' => $content->title,
                    'type' => str_replace('_', ' ', $content->category), // Format type
                    'date' => $content->published_date->format('Y-m-d'),
                    'priority' => $priority,
                    'image' => $content->image_url,
                    'slug' => $content->slug 
                ];
            })
            ->toArray();
        // Jika poster kosong atau kurang dari 3, tambahkan data fallback
        if (count($posters) < 3) {
            $fallbackPosters = [
                [
                    'title' => 'Pendaftaran Siswa Baru 2025/2026',
                    'type' => 'pendaftaran',
                    'date' => '2025-01-15',
                    'priority' => 'high',
                    'image' => 'https://i.pinimg.com/736x/f8/1e/5d/f81e5ddc58f6a98b1237eed47af355fc.jpg',
                    'slug' => null // Tidak ada link untuk fallback
                ]
            ];
            
            $posters = array_merge($posters, array_slice($fallbackPosters, 0, 3 - count($posters)));
        }

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
            'channelInfo',
            'latestVideos',
            'videoCategories',
            'posters',
            'editorPicks',
            'popularPosts',
            'popularCategories'
        ));
    }

    /**
     * AJAX method to load videos by category
     */
    public function getVideosByCategory(Request $request)
    {
        $category = $request->input('category', 'terbaru');
        $channelHandle = env('YOUTUBE_CHANNEL_HANDLE', '@pertajampolapikir');
        
        $videos = $this->youtubeService->getVideosByCategory($channelHandle, $category, 6);
        
        return response()->json([
            'success' => true,
            'videos' => $videos
        ]);
    }

    /**
     * Refresh YouTube cache
     */
    public function refreshYouTubeCache()
    {
        $channelHandle = env('YOUTUBE_CHANNEL_HANDLE', '@pertajampolapikir');
        $this->youtubeService->clearCache($channelHandle);
        
        return redirect()->back()->with('success', 'Cache YouTube berhasil diperbarui!');
    }
}