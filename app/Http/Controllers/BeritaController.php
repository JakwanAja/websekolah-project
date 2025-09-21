<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    /**
     * Display Smanung Today articles
     */
    public function today(Request $request)
    {
        $query = Content::published()
                        ->byCategory('smanung_today')
                        ->orderBy('published_date', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $contents = $query->paginate(12);
        $totalContents = Content::published()
                               ->byCategory('smanung_today')
                               ->count();

        // Get popular articles for sidebar
        $popularArticles = Content::published()
                                 ->byCategory('smanung_today')
                                 ->recent(5)
                                 ->get();

        // Get recent articles for sidebar
        $recentArticles = Content::published()
                                ->recent(5)
                                ->get();

        return view('berita.today', compact(
            'contents', 
            'totalContents', 
            'popularArticles', 
            'recentArticles'
        ));
    }

    /**
     * Display Siswa Prestasi articles
     */
    public function siswaPrestasi(Request $request)
    {
        $query = Content::published()
                        ->byCategory('siswa_prestasi')
                        ->orderBy('published_date', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $contents = $query->paginate(12);
        $totalContents = Content::published()
                               ->byCategory('siswa_prestasi')
                               ->count();

        // Get popular articles for sidebar
        $popularArticles = Content::published()
                                 ->byCategory('siswa_prestasi')
                                 ->recent(5)
                                 ->get();

        // Get recent articles for sidebar
        $recentArticles = Content::published()
                                ->recent(5)
                                ->get();

        return view('berita.siswa-prestasi', compact(
            'contents', 
            'totalContents', 
            'popularArticles', 
            'recentArticles'
        ));
    }

    /**
     * Display Agenda Sekolah articles
     */
    public function agenda(Request $request)
    {
        $query = Content::published()
                        ->byCategory('agenda_sekolah')
                        ->orderBy('published_date', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $contents = $query->paginate(12);
        $totalContents = Content::published()
                               ->byCategory('agenda_sekolah')
                               ->count();

        // Get popular articles for sidebar
        $popularArticles = Content::published()
                                 ->byCategory('agenda_sekolah')
                                 ->recent(5)
                                 ->get();

        // Get recent articles for sidebar
        $recentArticles = Content::published()
                                ->recent(5)
                                ->get();

        return view('berita.agenda', compact(
            'contents', 
            'totalContents', 
            'popularArticles', 
            'recentArticles'
        ));
    }

    /**
     * Display single article
     */
    public function show($slug)
    {
        $content = Content::published()
                         ->where('slug', $slug)
                         ->firstOrFail();

        // Get related articles from same category
        $relatedArticles = Content::published()
                                 ->byCategory($content->category)
                                 ->where('id', '!=', $content->id)
                                 ->recent(4)
                                 ->get();

        // Get recent articles for sidebar
        $recentArticles = Content::published()
                                ->recent(5)
                                ->get();

        return view('berita.show', compact('content', 'relatedArticles', 'recentArticles'));
    }
}