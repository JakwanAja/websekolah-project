<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Facility::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $facilities = $query->latest()->paginate(10);
        
        $facilities->appends($request->query());

        $types = [
            'fasilitas' => 'Fasilitas',
            'ekstrakurikuler' => 'Ekstrakurikuler'
        ];

        return view('dashboard.facilities.index', compact('facilities', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = [
            'fasilitas' => 'Fasilitas',
            'ekstrakurikuler' => 'Ekstrakurikuler'
        ];

        return view('dashboard.facilities.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:fasilitas,ekstrakurikuler',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'type']);
        
        // Generate slug
        $data['slug'] = Str::slug($request->title);
        
        // Pastikan slug unik
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Facility::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            $uploadPath = public_path('images/fasilitas');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file to public/images/fasilitas
            $image->move($uploadPath, $imageName);
            $data['image'] = 'images/fasilitas/' . $imageName;
        }

        Facility::create($data);

        return redirect()->route('dashboard.facilities.index')
                        ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        return view('dashboard.facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $types = [
            'fasilitas' => 'Fasilitas',
            'ekstrakurikuler' => 'Ekstrakurikuler'
        ];

        return view('dashboard.facilities.edit', compact('facility', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:fasilitas,ekstrakurikuler',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'type']);
        
        // Update slug jika title berubah
        if ($facility->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
            
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Facility::where('slug', $data['slug'])->where('id', '!=', $facility->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($facility->image && file_exists(public_path($facility->image))) {
                unlink(public_path($facility->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('images/fasilitas');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file to public/images/fasilitas
            $image->move($uploadPath, $imageName);
            $data['image'] = 'images/fasilitas/' . $imageName;
        }

        $facility->update($data);

        return redirect()->route('dashboard.facilities.index')
                        ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        // Delete image file
        if ($facility->image && file_exists(public_path($facility->image))) {
            unlink(public_path($facility->image));
        }

        $facility->delete();

        return redirect()->route('dashboard.facilities.index')
                        ->with('success', 'Fasilitas berhasil dihapus!');
    }
}