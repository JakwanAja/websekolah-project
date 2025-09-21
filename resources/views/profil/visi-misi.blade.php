@extends('layouts.app')

@section('title', 'Visi Misi & Motto - SMA Negeri Unggulan')
@section('description', 'Visi, Misi dan Motto SMA Negeri Unggulan dalam membentuk generasi cerdas dan berkarakter')

@section('content')
<!-- Hero Section -->
<section class="visi-misi-hero">
    <div class="container">
        <div class="hero-content">
            <div class="breadcrumb-modern">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Profil</a></li>
                        <li class="breadcrumb-item active">Visi Misi & Motto</li>
                    </ol>
                </nav>
            </div>
            
            <div class="text-center">
                <h1 class="display-4 fw-bold mb-3">Visi Misi & Motto</h1>
                <p class="lead mb-0">Landasan Filosofis SMA Negeri Unggulan dalam Membentuk Generasi Cerdas dan Berkarakter</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="content-section">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Visi Card -->
            <div class="col-lg-4 col-md-12">
                <div class="vision-card">
                    <div class="card-header-custom">
                        <div class="card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h2 class="card-title-custom">Visi</h2>
                    </div>
                    <div class="card-body-custom">
                        <p class="vision-text">
                            {{ $data['visi'] }}
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Misi Card -->
            <div class="col-lg-8 col-md-12">
                <div class="mission-card">
                    <div class="card-header-custom">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h2 class="card-title-custom">Misi</h2>
                    </div>
                    <div class="card-body-custom">
                        <ul class="mission-list">
                            @foreach($data['misi'] as $index => $misi)
                            <li class="mission-item">
                                <div class="mission-number">{{ $index + 1 }}</div>
                                <p class="mission-text">{{ $misi }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Motto Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="motto-card">
                    <div class="card-header-custom">
                        <div class="card-icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <h2 class="card-title-custom">Motto</h2>
                    </div>
                    <div class="card-body-custom">
                        <div class="motto-content">
                            <div class="motto-main">"{{ $data['motto']['utama'] }}"</div>
                            <div class="motto-sub">{{ $data['motto']['inggris'] }}</div>
                            <div class="motto-description">
                                <p>{{ $data['motto']['deskripsi'] }} <strong>Cerdas</strong> menggambarkan pengembangan intelektual dan kemampuan berpikir kritis. <strong>Berkarakter</strong> menekankan pentingnya pembentukan akhlak dan moral yang mulia. <strong>Berprestasi</strong> mendorong siswa untuk selalu memberikan yang terbaik dalam segala bidang.</p>
                                
                                <p>Melalui motto ini, kami berkomitmen untuk tidak hanya mencerdaskan siswa secara akademik, tetapi juga membentuk pribadi yang berintegritas tinggi dan mampu meraih prestasi gemilang baik di tingkat nasional maupun internasional.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Apply animation to cards
    document.querySelectorAll('.vision-card, .mission-card, .motto-card, .value-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
</script>
@endpush