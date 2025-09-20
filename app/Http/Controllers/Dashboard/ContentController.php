<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::query();

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $contents = $query->orderBy('published_date', 'desc')->paginate(10);

        $categories = [
            'berita' => 'Berita/Artikel',
            'smanung_today' => 'SMANUNG Today',
            'siswa_prestasi' => 'Siswa Prestasi',
            'agenda_sekolah' => 'Agenda Sekolah'
        ];

        return view('dashboard.contents.index', compact('contents', 'categories'));
    }

    public function create()
    {
        $categories = [
            'berita' => 'Berita/Artikel',
            'smanung_today' => 'SMANUNG Today',
            'siswa_prestasi' => 'Siswa Prestasi',
            'agenda_sekolah' => 'Agenda Sekolah'
        ];

        return view('dashboard.contents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:berita,smanung_today,siswa_prestasi,agenda_sekolah',
            'author' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'published_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/contents'), $imageName);
            $data['image'] = 'images/contents/' . $imageName;
        }

        Content::create($data);

        return redirect()->route('dashboard.contents.index')
                        ->with('success', 'Content berhasil ditambahkan!');
    }

    public function show(Content $content)
    {
        return view('dashboard.contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        $categories = [
            'berita' => 'Berita/Artikel',
            'smanung_today' => 'SMANUNG Today',
            'siswa_prestasi' => 'Siswa Prestasi',
            'agenda_sekolah' => 'Agenda Sekolah'
        ];

        return view('dashboard.contents.edit', compact('content', 'categories'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:berita,smanung_today,siswa_prestasi,agenda_sekolah',
            'author' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'published_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($content->image && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/contents'), $imageName);
            $data['image'] = 'images/contents/' . $imageName;
        }

        $content->update($data);

        return redirect()->route('dashboard.contents.index')
                        ->with('success', 'Content berhasil diperbarui!');
    }

    public function destroy(Content $content)
    {
        // Delete image file
        if ($content->image && file_exists(public_path($content->image))) {
            unlink(public_path($content->image));
        }

        $content->delete();

        return redirect()->route('dashboard.contents.index')
                        ->with('success', 'Content berhasil dihapus!');
    }
}