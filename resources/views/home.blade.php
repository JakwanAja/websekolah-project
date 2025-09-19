@extends('layouts.app')

@section('title', 'Beranda - SMA Negeri Unggulan')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Portal Berita & Informasi</h1>
            <h2 class="hero-subtitle">SMA Negeri Unggulan</h2>
            <p class="hero-description">Dapatkan informasi terkini seputar prestasi, kegiatan, dan perkembangan sekolah</p>
        </div>
    </div>
</section>

<!-- Dynamic Content Slider with Poster Section -->
<section class="dynamic-content-section py-5">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Left Side - Dynamic Content (70%) -->
            <div class="col-lg-8 pe-lg-4">
                <div class="content-wrapper">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs content-tabs mb-4" id="contentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="berita-today-tab" data-bs-toggle="tab" data-bs-target="#berita-today" type="button" role="tab">
                                <i class="fas fa-newspaper me-2"></i>SMANUNG TODAY
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="siswa-prestasi-tab" data-bs-toggle="tab" data-bs-target="#siswa-prestasi" type="button" role="tab">
                                <i class="fas fa-trophy me-2"></i>SISWA PRESTASI
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="agenda-sekolah-tab" data-bs-toggle="tab" data-bs-target="#agenda-sekolah" type="button" role="tab">
                                <i class="fas fa-calendar-alt me-2"></i>AGENDA SEKOLAH
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="contentTabsContent">
                        <!-- Berita Today -->
                        <div class="tab-pane fade show active" id="berita-today" role="tabpanel">
                            <div class="row g-3">
                                @foreach($dynamicContent['berita_today'] as $index => $news)
                                <div class="col-lg-6 col-md-12">
                                    <article class="content-card">
                                        <div class="content-image">
                                            <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}">
                                            <div class="content-overlay">
                                                <span class="content-category bg-primary">{{ $news['category'] }}</span>
                                            </div>
                                        </div>
                                        <div class="content-body">
                                            <h5 class="content-title">{{ $news['title'] }}</h5>
                                            <p class="content-excerpt">{{ $news['excerpt'] }}</p>
                                            <div class="content-meta">
                                                <span class="meta-author">
                                                    <i class="fas fa-user me-1"></i>{{ $news['author'] }}
                                                </span>
                                                <span class="meta-date">
                                                    <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($news['date'])->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Siswa Prestasi -->
                        <div class="tab-pane fade" id="siswa-prestasi" role="tabpanel">
                            <div class="row g-3">
                                @foreach($dynamicContent['siswa_prestasi'] as $news)
                                <div class="col-lg-6 col-md-12">
                                    <article class="content-card">
                                        <div class="content-image">
                                            <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}">
                                            <div class="content-overlay">
                                                <span class="content-category bg-success">{{ $news['category'] }}</span>
                                            </div>
                                        </div>
                                        <div class="content-body">
                                            <h5 class="content-title">{{ $news['title'] }}</h5>
                                            <p class="content-excerpt">{{ $news['excerpt'] }}</p>
                                            <div class="content-meta">
                                                <span class="meta-author">
                                                    <i class="fas fa-user me-1"></i>{{ $news['author'] }}
                                                </span>
                                                <span class="meta-date">
                                                    <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($news['date'])->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Agenda Sekolah -->
                        <div class="tab-pane fade" id="agenda-sekolah" role="tabpanel">
                            <div class="row g-3">
                                @foreach($dynamicContent['agenda_sekolah'] as $news)
                                <div class="col-lg-6 col-md-12">
                                    <article class="content-card">
                                        <div class="content-image">
                                            <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}">
                                            <div class="content-overlay">
                                                <span class="content-category bg-warning">{{ $news['category'] }}</span>
                                            </div>
                                        </div>
                                        <div class="content-body">
                                            <h5 class="content-title">{{ $news['title'] }}</h5>
                                            <p class="content-excerpt">{{ $news['excerpt'] }}</p>
                                            <div class="content-meta">
                                                <span class="meta-author">
                                                    <i class="fas fa-user me-1"></i>{{ $news['author'] }}
                                                </span>
                                                <span class="meta-date">
                                                    <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($news['date'])->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Single Poster Section (30%) -->
            <div class="col-lg-4">
                <div class="single-poster-sidebar">
                    @if(isset($posters[0]))
                    <div class="single-poster-card">
                        <div class="single-poster-image">
                            <img src="{{ $posters[0]['image'] }}" alt="{{ $posters[0]['title'] }}" class="poster-img-4-5">
                            <div class="single-poster-badge {{ $posters[0]['priority'] === 'high' ? 'badge-high' : 'badge-medium' }}">
                                {{ strtoupper($posters[0]['type']) }}
                            </div>
                            <div class="single-poster-overlay">
                                <a href="#" class="btn btn-light">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Poster Section -->
<section class="poster-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="section-title">Berita & Pengumuman</h2>
        <div class="row g-4">
            @foreach($posters as $poster)
            <div class="col-lg-4 col-md-6">
                <div class="poster-card">
                    <div class="poster-image">
                        <img src="{{ $poster['image'] }}" alt="{{ $poster['title'] }}">
                        <div class="poster-badge {{ $poster['priority'] === 'high' ? 'badge-high' : 'badge-medium' }}">
                            {{ strtoupper($poster['type']) }}
                        </div>
                    </div>
                    <div class="poster-content">
                        <h5 class="poster-title">{{ $poster['title'] }}</h5>
                        <p class="poster-date">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ \Carbon\Carbon::parse($poster['date'])->format('d F Y') }}
                        </p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section py-5">
    <div class="container">
        <h2 class="section-title">Video Terbaru</h2>
        <div class="row g-4">
            @foreach($latestVideos as $index => $video)
            <div class="col-lg-4 col-md-6">
                <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal{{ $index }}">
                    <div class="video-thumbnail">
                        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}">
                        <div class="video-play-btn">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-duration">{{ $video['duration'] }}</div>
                    </div>
                    <div class="video-info">
                        <h6 class="video-title">{{ $video['title'] }}</h6>
                        <div class="video-stats">
                            <span class="video-views">
                                <i class="fas fa-eye me-1"></i>{{ $video['views'] }} views
                            </span>
                            <span class="video-date">
                                <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($video['upload_date'])->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Sidebar Content -->
<section class="sidebar-content py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <!-- Editor Picks -->
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h4 class="widget-title">EDITOR PICKS</h4>
                    <div class="widget-content">
                        @foreach($editorPicks as $pick)
                        <div class="sidebar-item">
                            <h6 class="sidebar-item-title">{{ $pick['title'] }}</h6>
                            <p class="sidebar-item-date">{{ \Carbon\Carbon::parse($pick['date'])->format('d/m/Y') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Popular Posts -->
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h4 class="widget-title">POPULAR POSTS</h4>
                    <div class="widget-content">
                        @foreach($popularPosts as $post)
                        <div class="sidebar-item">
                            <h6 class="sidebar-item-title">{{ $post['title'] }}</h6>
                            <div class="sidebar-item-meta">
                                <span>{{ \Carbon\Carbon::parse($post['date'])->format('d/m/Y') }}</span>
                                <span class="ms-2">{{ $post['views'] }} views</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Popular Categories -->
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h4 class="widget-title">POPULAR CATEGORY</h4>
                    <div class="widget-content">
                        @foreach($popularCategories as $category)
                        <div class="category-item">
                            <span class="category-name">{{ $category['name'] }}</span>
                            <span class="category-count">{{ $category['count'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modals -->
@foreach($latestVideos as $index => $video)
<div class="modal fade" id="videoModal{{ $index }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $index }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel{{ $index }}">{{ $video['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $video['video_url'] }}" title="{{ $video['title'] }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
// Stop video when modal is closed
document.querySelectorAll('[id^="videoModal"]').forEach(function(modal) {
    modal.addEventListener('hidden.bs.modal', function () {
        const iframe = this.querySelector('iframe');
        if (iframe) {
            const src = iframe.src;
            iframe.src = src;
        }
    });
});
</script>
@endpush