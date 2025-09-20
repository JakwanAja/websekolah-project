@extends('layouts.app')

@section('title', 'Beranda - SMA Negeri Unggulan')

@section('content')
<!-- Hero Carousel Section -->
<section class="hero-carousel">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($heroSlides as $index => $slide)
            <button type="button" 
                    data-bs-target="#heroCarousel" 
                    data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}" 
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $index + 1 }}">
            </button>
            @endforeach
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            @foreach($heroSlides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                <div class="hero-content">
                    <div class="container">
                        <h1 class="hero-title">{{ $slide['title'] }}</h1>
                        <h2 class="hero-subtitle">{{ $slide['subtitle'] }}</h2>
                        <p class="hero-description">{{ $slide['description'] }}</p>
                        <a href="{{ $slide['button_link'] }}" class="hero-btn">{{ $slide['button_text'] }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
<section class="video-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <!-- Channel Header -->
        @if($channelInfo)
        <div class="channel-header mb-4">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="channel-avatar">
                        <img src="{{ $channelInfo['thumbnail'] }}" alt="{{ $channelInfo['title'] }} Avatar" class="rounded-circle" style="width: 88px; height: 88px; object-fit: cover;">
                    </div>
                </div>
                <div class="col">
                    <div class="channel-info">
                        <h2 class="channel-name mb-1" style="font-size: 24px; font-weight: 400; color: #0f0f0f;">{{ $channelInfo['title'] }}</h2>
                        <div class="channel-stats text-muted" style="font-size: 14px;">
                            <span class="me-3">{{ $channelInfo['subscriber_count'] }} Subscribers</span>
                            <span class="me-3">{{ $channelInfo['video_count'] }} Videos</span>
                            <span>{{ $channelInfo['view_count'] }} Views</span>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="https://www.youtube.com/@pertajampolapikir" target="_blank" class="btn btn-danger d-flex align-items-center" style="background-color: #ff0000; border: none; font-weight: 500; padding: 10px 16px;">
                        <svg viewBox="0 0 24 24" width="20" height="20" class="me-2" fill="white">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        YouTube {{ $channelInfo['subscriber_count'] }}
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Tab Navigation -->
        <div class="channel-tabs mb-4">
            <ul class="nav nav-tabs border-0" style="border-bottom: 1px solid #e5e5e5 !important;" id="videoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-3 border-0 video-tab-btn" id="terbaru-tab" data-bs-toggle="tab"data-bs-target="#terbaru" data-category="terbaru" type="button" 
                            role="tab" 
                            style="color: #0f0f0f; font-weight: 500; border-bottom: 2px solid #065fd4 !important; background: none;">
                        TERBARU
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-3 border-0 video-tab-btn" id="ramadhan-tab" data-bs-toggle="tab" data-bs-target="#ramadhan" data-category="ramadhan"type="button" 
                            role="tab" 
                            style="color: #606060; font-weight: 500; background: none;">
                        KATEGORI 1
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-3 border-0 video-tab-btn" 
                            id="profil-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#profil" 
                            data-category="profil"
                            type="button" 
                            role="tab" 
                            style="color: #606060; font-weight: 500; background: none;">
                        PROFIL SMANUNG
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="videoTabsContent">
            <!-- Terbaru Tab -->
            <div class="tab-pane fade show active" id="terbaru" role="tabpanel" aria-labelledby="terbaru-tab">
                <div class="row g-4" id="videos-container-terbaru">
                    @if(count($latestVideos) > 0)
                        @foreach($latestVideos as $index => $video)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="video-card h-100" style="cursor: pointer; transition: transform 0.2s;" 
                                 data-bs-toggle="modal" data-bs-target="#videoModal{{ $index }}"
                                 onmouseover="this.style.transform='scale(1.02)'" 
                                 onmouseout="this.style.transform='scale(1)'">
                                
                                <!-- Video Thumbnail -->
                                <div class="video-thumbnail position-relative mb-3" style="aspect-ratio: 16/9; border-radius: 12px; overflow: hidden;">
                                    <img src="{{ $video['thumbnail'] }}" 
                                         alt="{{ $video['title'] }}" 
                                         class="w-100 h-100" 
                                         style="object-fit: cover;">
                                    <!-- Play Button Overlay -->
                                    <div class="video-play-overlay position-absolute top-50 start-50 translate-middle"
                                         style="width: 68px; height: 48px; background: rgba(0,0,0,0.8); border-radius: 12px; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s;">
                                        <svg viewBox="0 0 24 24" width="24" height="24" fill="white">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                    <!-- Duration Badge -->
                                    <div class="video-duration position-absolute bottom-0 end-0 m-2 px-2 py-1 text-white" 
                                         style="background: rgba(0,0,0,0.8); font-size: 12px; font-weight: 500; border-radius: 4px;">
                                        {{ $video['duration'] }}
                                    </div>
                                </div>
                                
                                <!-- Video Info -->
                                <div class="video-info">
                                    <h6 class="video-title mb-2" style="font-size: 14px; font-weight: 500; line-height: 1.4; color: #0f0f0f; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $video['title'] }}
                                    </h6>
                                    <div class="video-stats" style="font-size: 12px; color: #606060; line-height: 1.3;">
                                        <div>{{ $video['views'] }} tayangan</div>
                                        <div>{{ \Carbon\Carbon::parse($video['upload_date'])->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-video fa-3x mb-3"></i>
                                <p>Video tidak tersedia saat ini</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!--Kategori 1 Tab -->
            <div class="tab-pane fade" id="ramadhan" role="tabpanel" aria-labelledby="ramadhan-tab">
                <div class="row g-4" id="videos-container-ramadhan">
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat video...</p>
                    </div>
                </div>
            </div>

            <!-- Profil Tab -->
            <div class="tab-pane fade" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                <div class="row g-4" id="videos-container-profil">
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat video...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="https://www.youtube.com/@pertajampolapikir/videos" target="_blank" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 18px; font-weight: 500;">
                <i class="fab fa-youtube me-2"></i>Lihat Semua Video di YouTube
            </a>
        </div>
    </div>
</section>

<!-- Sidebar Content 
<section class="sidebar-content py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
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
@endsection -->

@push('styles')
<style>
/* Hero Carousel Styles */
.hero-carousel {
    height: 50vh;
    min-height: 400px;
    max-height: 500px;
    overflow: hidden;
    position: relative;
}

.hero-carousel .carousel-item {
    height: 50vh;
    min-height: 400px;
    max-height: 500px;
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.8), rgba(80, 200, 120, 0.8));
    position: relative;
}

.hero-carousel .carousel-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.hero-carousel .carousel-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 0 15px;
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    font-size: 1.6rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-description {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    max-width: 600px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    animation: fadeInUp 1s ease-out 0.4s both;
}

.hero-btn {
    padding: 12px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border: none;
    border-radius: 50px;
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    color: white;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    text-shadow: none;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.hero-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    color: white;
}

/* Carousel Controls */
.hero-carousel .carousel-control-prev,
.hero-carousel .carousel-control-next {
    width: 5%;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.hero-carousel .carousel-control-prev:hover,
.hero-carousel .carousel-control-next:hover {
    opacity: 1;
}

.hero-carousel .carousel-control-prev-icon,
.hero-carousel .carousel-control-next-icon {
    width: 2rem;
    height: 2rem;
}

/* Carousel Indicators */
.hero-carousel .carousel-indicators {
    bottom: 30px;
}

.hero-carousel .carousel-indicators [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    background-color: transparent;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.hero-carousel .carousel-indicators .active {
    opacity: 1;
    background-color: white;
    transform: scale(1.2);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-carousel {
        height: 45vh;
        min-height: 350px;
        max-height: 400px;
    }
    
    .hero-carousel .carousel-item {
        height: 45vh;
        min-height: 350px;
        max-height: 400px;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
    }
    
    .hero-description {
        font-size: 1rem;
        margin-bottom: 1.2rem;
    }
}

@media (max-width: 576px) {
    .hero-carousel {
        height: 40vh;
        min-height: 300px;
        max-height: 350px;
    }
    
    .hero-carousel .carousel-item {
        height: 40vh;
        min-height: 300px;
        max-height: 350px;
    }
    
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-btn {
        padding: 10px 25px;
        font-size: 1rem;
    }
}
</style>
@endpush

<!-- Custom Styles -->
<style>
.video-card:hover .video-play-overlay {
    opacity: 1 !important;
}

.channel-tabs .nav-link:hover {
    color: #0f0f0f !important;
}

.channel-tabs .nav-link.active {
    background: none !important;
}

/* YouTube-like responsive grid */
@media (max-width: 768px) {
    .channel-header .channel-name {
        font-size: 20px !important;
    }
    
    .channel-header .channel-stats {
        font-size: 13px !important;
    }
    
    .channel-tabs .nav-link {
        padding: 12px 16px !important;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .row.g-4 {
        --bs-gutter-x: 0.5rem;
    }
    
    .video-thumbnail {
        border-radius: 8px !important;
    }
}
</style>

@push('scripts')
<script>
// Pause carousel on hover
const heroCarousel = document.querySelector('#heroCarousel');
if (heroCarousel) {
    heroCarousel.addEventListener('mouseenter', function() {
        bootstrap.Carousel.getInstance(this).pause();
    });
    
    heroCarousel.addEventListener('mouseleave', function() {
        bootstrap.Carousel.getInstance(this).cycle();
    });
}
</script>
@endpush