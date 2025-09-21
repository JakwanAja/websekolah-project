<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'author',
        'status',
        'published_date'
    ];

    protected $casts = [
        'published_date' => 'date'
    ];

    // Auto generate slug from title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scope for published content
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope for recent content
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_date', 'desc')->limit($limit);
    }

    // Get category display name - UPDATED untuk konsistensi
    public function getCategoryDisplayNameAttribute()
    {
        $categories = [
            'berita' => 'Berita/Artikel',
            'smanung_today' => 'SMANUNG Today',
            'siswa_prestasi' => 'Siswa Prestasi',
            'agenda_sekolah' => 'Agenda Sekolah'
        ];

        return $categories[$this->category] ?? $this->category;
    }

    // Alias untuk konsistensi dengan views
    public function getCategoryDisplayAttribute()
    {
        return $this->category_display_name;
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        
        // Fallback berdasarkan kategori
        $placeholders = [
            'smanung_today' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&h=250&fit=crop',
            'siswa_prestasi' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=250&fit=crop',
            'agenda_sekolah' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=250&fit=crop',
            'berita' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=250&fit=crop'
        ];

        return $placeholders[$this->category] ?? $placeholders['berita'];
    }

    // Get formatted published date
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->published_date)->format('d F Y');
    }

    // Get human readable published date
    public function getHumanDateAttribute()
    {
        return Carbon::parse($this->published_date)->diffForHumans();
    }

    // Get excerpt with word limit
    public function getShortExcerptAttribute($limit = 20)
    {
        return Str::limit($this->excerpt, $limit * 5);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}