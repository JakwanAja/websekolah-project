<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman Visi Misi & Motto
     */
    public function visiMisi()
    {
        $data = [
            'visi' => 'Menjadi sekolah menengah atas unggulan yang menghasilkan lulusan cerdas, berkarakter mulia, dan mampu bersaing di era global',
            'misi' => [
                'Menyelenggarakan pendidikan yang berkualitas dengan menerapkan kurikulum nasional dan internasional',
                'Mengembangkan potensi akademik dan non-akademik siswa melalui pembelajaran inovatif dan kegiatan ekstrakurikuler',
                'Membentuk karakter siswa yang berakhlak mulia, mandiri, dan memiliki jiwa kepemimpinan',
                'Memfasilitasi siswa dengan teknologi modern dan lingkungan belajar yang kondusif',
                'Membangun kerjasama dengan berbagai pihak untuk meningkatkan kualitas pendidikan dan kesempatan masa depan siswa'
            ],
            'motto' => [
                'utama' => 'Cerdas, Berkarakter, Berprestasi',
                'inggris' => 'Smart, Character, Achievement',
                'deskripsi' => 'Motto ini mencerminkan komitmen SMA Negeri Unggulan untuk mengembangkan siswa secara holistik.'
            ],
            'nilai' => [
                [
                    'nama' => 'Excellence',
                    'icon' => 'fas fa-graduation-cap',
                    'deskripsi' => 'Selalu berusaha memberikan yang terbaik dalam setiap aspek pembelajaran dan pengembangan diri'
                ],
                [
                    'nama' => 'Integrity', 
                    'icon' => 'fas fa-heart',
                    'deskripsi' => 'Menjunjung tinggi kejujuran, transparansi, dan konsistensi antara kata dan perbuatan'
                ],
                [
                    'nama' => 'Collaboration',
                    'icon' => 'fas fa-handshake', 
                    'deskripsi' => 'Membangun kerjasama yang solid antar semua stakeholder untuk kemajuan bersama'
                ],
                [
                    'nama' => 'Innovation',
                    'icon' => 'fas fa-lightbulb',
                    'deskripsi' => 'Mengembangkan kreativitas dan inovasi dalam pembelajaran dan pengembangan sekolah'
                ]
            ]
        ];
        
        return view('profil.visi-misi', compact('data'));
    }

    /**
     * Menampilkan halaman Fasilitas & Ekstrakurikuler
     */
    public function fasilitas(Request $request)
    {
        $query = Facility::query();

        // Filter berdasarkan type jika ada
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $facilities = $query->latest()->paginate(12);
        
        // Append query parameters untuk pagination
        $facilities->appends($request->query());

        // Get counts for each type
        $fasilitasCount = Facility::where('type', 'fasilitas')->count();
        $ekstrakulikulerCount = Facility::where('type', 'ekstrakurikuler')->count();
        $totalFacilities = $facilities->total();

        // Recent facilities for sidebar
        $recentFacilities = Facility::latest()->take(5)->get();

        return view('profil.fasilitas', compact(
            'facilities',
            'fasilitasCount',
            'ekstrakulikulerCount',
            'totalFacilities',
            'recentFacilities'
        ));
    }
}