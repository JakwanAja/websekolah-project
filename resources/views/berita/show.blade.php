@extends('layouts.app')

@section('title', $content->title . ' - SMA Negeri Unggulan')

@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); padding: 60px 0 40px;">
    <div class="container">
        <div class="hero-content text-white">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item"><span class="text-white-50">Berita</span></li>
                    <li class="breadcrumb-item">
                        <a href="@if($content->category === 'smanung_today'){{ route('berita.today') }}@elseif($content->category === 'siswa_prestasi'){{ route('berita.siswa-prestasi') }}@else{{ route('berita.agenda') }}@endif" class="text-white-50">
                            {{ $content->category_display }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white">{{ Str::limit($content->title, 50) }}</li>
                </ol>
            </nav>
            <span class="badge bg-{{ $content->category === 'smanung_today' ? 'primary' : ($content->category === 'siswa_prestasi' ? 'success' : 'warning') }} mb-2">
                {{ $content->category_display }}
            </span>
            <h1 class="h2 fw-bold mb-0">{{ $content->title }}</h1>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <!-- Article Content -->
                <article class="article-content">
                    <!-- Article Header -->
                    <div class="article-header mb-4">
                        <div class="article-meta d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="author-info">
                                    <span class="text-muted small d-block">Ditulis oleh</span>
                                    <strong class="text-dark">{{ $content->author }}</strong>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="text-muted small d-block">Dipublikasikan</span>
                                <strong class="text-dark">{{ $content->formatted_date }}</strong>
                            </div>
                        </div>
                        
                        <!-- Featured Image -->
                        @if($content->image)
                        <div class="article-image mb-4">
                            <img src="{{ $content->image_url }}" 
                                 alt="{{ $content->title }}" 
                                 class="w-100 rounded shadow-sm"
                                 style="height: 400px; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Article Excerpt -->
                        <div class="article-excerpt">
                            <p class="lead text-muted">{{ $content->excerpt }}</p>
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="article-body">
                        <div class="content-text">
                            {!! nl2br(e($content->content)) !!}
                        </div>
                    </div>

                    <!-- Article Footer -->
                    <div class="article-footer mt-5 pt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="article-tags">
                                    <strong class="me-2">Kategori:</strong>
                                    <span class="badge bg-{{ $content->category === 'smanung_today' ? 'primary' : ($content->category === 'siswa_prestasi' ? 'success' : 'warning') }}">
                                        {{ $content->category_display }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="share-buttons">
                                    <strong class="me-2">Bagikan:</strong>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($content->title) }}" 
                                       target="_blank" 
                                       class="btn btn-outline-info btn-sm me-1">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($content->title . ' ' . request()->fullUrl()) }}" 
                                       target="_blank" 
                                       class="btn btn-outline-success btn-sm">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                <div class="related-articles mt-5">
                    <h3 class="h4 mb-4">Artikel Terkait</h3>
                    <div class="row g-3">
                        @foreach($relatedArticles as $related)
                        <div class="col-lg-6 col-md-6">
                            <div class="related-card border rounded p-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-4">
                                        <img src="{{ $related->image_url }}" 
                                             alt="{{ $related->title }}" 
                                             class="w-100 rounded"
                                             style="height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="mb-1">
                                            <a href="{{ route('berita.show', $related->slug) }}"
                                               class="text-decoration-none text-dark">
                                                {{ Str::limit($related->title, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ $related->formatted_date }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Back to Category -->
                <div class="widget mb-4">
                    <div class="widget-body bg-light rounded p-3">
                        <a href="@if($content->category === 'smanung_today'){{ route('berita.today') }}@elseif($content->category === 'siswa_prestasi'){{ route('berita.siswa-prestasi') }}@else{{ route('berita.agenda') }}@endif" 
                           class="btn btn-{{ $content->category === 'smanung_today' ? 'primary' : ($content->category === 'siswa_prestasi' ? 'success' : 'warning') }} w-100">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke {{ $content->category_display }}
                        </a>
                    </div>
                </div>

                <!-- Recent Articles Widget -->
                <div class="widget mb-4">
                    <div class="widget-header bg-primary text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-clock me-2"></i>Artikel Terbaru
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        @forelse($recentArticles as $article)
                            <div class="sidebar-item pb-3 mb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <h6 class="sidebar-item-title mb-1">
                                    <a href="{{ route('berita.show', $article->slug) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($article->title, 60) }}
                                    </a>
                                </h6>
                                <div class="sidebar-item-meta small text-muted">
                                    <span class="badge bg-{{ $article->category === 'smanung_today' ? 'primary' : ($article->category === 'siswa_prestasi' ? 'success' : 'warning') }} me-2">
                                        {{ $article->category_display }}
                                    </span>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $article->human_date }}
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada artikel terbaru.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Category Navigation Widget -->
                <div class="widget">
                    <div class="widget-header bg-info text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-list me-2"></i>Kategori Berita
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        <div class="category-list">
                            <div class="category-item d-flex justify-content-between align-items-center mb-2 {{ $content->category === 'smanung_today' ? 'bg-light rounded p-2' : '' }}">
                                <a href="{{ route('berita.today') }}" class="text-decoration-none {{ $content->category === 'smanung_today' ? 'fw-bold' : '' }}">
                                    <i class="fas fa-newspaper text-primary me-2"></i>Smanung Today
                                </a>
                                <span class="badge bg-light text-dark">
                                    {{ \App\Models\Content::where('category', 'smanung_today')->where('status', 'published')->count() }}
                                </span>
                            </div>
                            <div class="category-item d-flex justify-content-between align-items-center mb-2 {{ $content->category === 'siswa_prestasi' ? 'bg-light rounded p-2' : '' }}">
                                <a href="{{ route('berita.siswa-prestasi') }}" class="text-decoration-none {{ $content->category === 'siswa_prestasi' ? 'fw-bold' : '' }}">
                                    <i class="fas fa-star text-success me-2"></i>Siswa Prestasi
                                </a>
                                <span class="badge bg-light text-dark">
                                    {{ \App\Models\Content::where('category', 'siswa_prestasi')->where('status', 'published')->count() }}
                                </span>
                            </div>
                            <div class="category-item d-flex justify-content-between align-items-center {{ $content->category === 'agenda_sekolah' ? 'bg-light rounded p-2' : '' }}">
                                <a href="{{ route('berita.agenda') }}" class="text-decoration-none {{ $content->category === 'agenda_sekolah' ? 'fw-bold' : '' }}">
                                    <i class="fas fa-calendar-alt text-warning me-2"></i>Agenda Sekolah
                                </a>
                                <span class="badge bg-light text-dark">
                                    {{ \App\Models\Content::where('category', 'agenda_sekolah')->where('status', 'published')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.article-content {
    font-size: 16px;
    line-height: 1.8;
}

.content-text {
    color: #333;
    font-size: 16px;
    line-height: 1.8;
}

.content-text p {
    margin-bottom: 1rem;
}

.article-image img {
    transition: transform 0.3s ease;
}

.article-image:hover img {
    transform: scale(1.02);
}

.related-card {
    transition: all 0.3s ease;
    border: 1px solid #dee2e6 !important;
}

.related-card:hover {
    border-color: #007bff !important;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.share-buttons a {
    transition: all 0.3s ease;
}

.share-buttons a:hover {
    transform: translateY(-2px);
}

.widget {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.breadcrumb-item a:hover {
    color: white !important;
}

.sidebar-item-title a:hover {
    color: #007bff !important;
}

.category-item a:hover {
    color: #007bff !important;
}
</style>
@endpush

@push('scripts')
<script>
// Smooth scroll for back to top
window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
        if (!document.getElementById('back-to-top')) {
            const backToTop = document.createElement('button');
            backToTop.id = 'back-to-top';
            backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
            backToTop.className = 'btn btn-primary position-fixed';
            backToTop.style.cssText = 'bottom: 20px; right: 20px; z-index: 1000; border-radius: 50%; width: 50px; height: 50px;';
            backToTop.onclick = function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
            document.body.appendChild(backToTop);
        }
    } else {
        const backToTop = document.getElementById('back-to-top');
        if (backToTop) {
            backToTop.remove();
        }
    }
});
</script>
@endpush