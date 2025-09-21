@extends('layouts.app')

@section('title', 'Smanung Today - SMA Negeri Unggulan')

@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); padding: 80px 0 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item"><span class="text-white-50">Berita</span></li>
                            <li class="breadcrumb-item active text-white">Smanung Today</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3">Smanung Today</h1>
                    <p class="lead mb-0">Berita terkini dan informasi seputar kegiatan SMA Negeri Unggulan</p>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                <div class="hero-stats">
                    <div class="stat-item bg-white bg-opacity-10 rounded p-3 mb-3">
                        <h3 class="h4 text-white mb-1">{{ $totalContents }}</h3>
                        <span class="text-white-75 small">Total Artikel</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <!-- Search & Filter -->
                <div class="content-filters mb-4">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <form method="GET" action="{{ route('berita.today') }}" class="search-form">
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Cari artikel...">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <div class="content-count text-muted">
                                Menampilkan {{ $contents->count() }} dari {{ $contents->total() }} artikel
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                @if($contents->count() > 0)
                    <div class="row g-4">
                        @foreach($contents as $content)
                        <div class="col-lg-6 col-md-6">
                            <article class="content-card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                <div class="content-image position-relative">
                                    <img src="{{ $content->image_url }}" 
                                         alt="{{ $content->title }}" 
                                         class="w-100"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="content-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-3"
                                         style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                        <span class="content-category bg-primary text-white px-2 py-1 rounded small">
                                            {{ $content->category_display_name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="content-body p-3 d-flex flex-column">
                                    <h5 class="content-title mb-2">
                                        <a href="{{ route('berita.show', $content->slug) }}" 
                                           class="text-decoration-none text-dark stretched-link">
                                            {{ $content->title }}
                                        </a>
                                    </h5>
                                    <p class="content-excerpt text-muted mb-3 flex-grow-1">
                                        {{ $content->short_excerpt }}
                                    </p>
                                    <div class="content-meta d-flex justify-content-between align-items-center small text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user me-1"></i>
                                            <span>{{ $content->author }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar me-1"></i>
                                            <span>{{ $content->formatted_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-5">
                        <div class="col-12">
                            {{ $contents->links() }}
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted mb-2">Belum Ada Artikel</h4>
                        <p class="text-muted">
                            @if(request('search'))
                                Tidak ditemukan artikel dengan kata kunci "{{ request('search') }}"
                            @else
                                Artikel Smanung Today akan segera hadir.
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('berita.today') }}" class="btn btn-primary">
                                Lihat Semua Artikel
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Popular Articles Widget -->
                <div class="widget mb-4">
                    <div class="widget-header bg-primary text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-fire me-2"></i>Artikel Populer
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        @forelse($popularArticles as $article)
                            <div class="sidebar-item pb-3 mb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <h6 class="sidebar-item-title mb-1">
                                    <a href="{{ route('berita.show', $article->slug) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($article->title, 60) }}
                                    </a>
                                </h6>
                                <div class="sidebar-item-meta small text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $article->formatted_date }}
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada artikel populer.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Articles Widget -->
                <div class="widget mb-4">
                    <div class="widget-header bg-success text-white p-3 rounded-top">
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
                                        {{ $article->category_display_name }}
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

                <!-- Category Stats Widget -->
                <div class="widget">
                    <div class="widget-header bg-info text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Kategori Lainnya
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        <div class="category-list">
                            <div class="category-item d-flex justify-content-between align-items-center mb-2">
                                <a href="{{ route('berita.siswa-prestasi') }}" class="text-decoration-none">
                                    <i class="fas fa-star text-success me-2"></i>Siswa Prestasi
                                </a>
                                <span class="badge bg-light text-dark">
                                    {{ \App\Models\Content::published()->byCategory('siswa_prestasi')->count() }}
                                </span>
                            </div>
                            <div class="category-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('berita.agenda') }}" class="text-decoration-none">
                                    <i class="fas fa-calendar-alt text-warning me-2"></i>Agenda Sekolah
                                </a>
                                <span class="badge bg-light text-dark">
                                    {{ \App\Models\Content::published()->byCategory('agenda_sekolah')->count() }}
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
.content-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.content-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.content-image {
    overflow: hidden;
}

.content-card:hover .content-image img {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.widget {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-form .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

.breadcrumb-item a:hover {
    color: white !important;
}
</style>
@endpush