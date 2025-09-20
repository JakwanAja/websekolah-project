<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // Get category display name
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

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=250&fit=crop';
    }
}