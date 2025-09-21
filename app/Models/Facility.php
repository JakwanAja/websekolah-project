<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'image',
        'type',
        'slug'
    ];

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            if (empty($facility->slug)) {
                $facility->slug = Str::slug($facility->title);
                
                // Pastikan slug unik
                $originalSlug = $facility->slug;
                $counter = 1;
                while (static::where('slug', $facility->slug)->exists()) {
                    $facility->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });

        static::updating(function ($facility) {
            if ($facility->isDirty('title') && empty($facility->slug)) {
                $facility->slug = Str::slug($facility->title);
                
                // Pastikan slug unik (kecuali untuk record yang sedang diupdate)
                $originalSlug = $facility->slug;
                $counter = 1;
                while (static::where('slug', $facility->slug)->where('id', '!=', $facility->id)->exists()) {
                    $facility->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    // Accessor untuk URL gambar
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Check if file exists in public folder
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
        }
        
        // Gambar default jika tidak ada
        return asset('images/default-facility.jpg');
    }

    // Accessor untuk nama type yang lebih readable
    public function getTypeDisplayNameAttribute()
    {
        return $this->type === 'fasilitas' ? 'Fasilitas' : 'Ekstrakurikuler';
    }

    // Accessor untuk excerpt pendek
    public function getShortExcerptAttribute()
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    // Scope untuk filter berdasarkan type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }
}