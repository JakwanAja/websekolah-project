<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SMA Negeri Unggulan')</title>
    <meta name="description" content="@yield('description', 'SMA Negeri Unggulan - Membentuk Generasi Cerdas dan Berkarakter')">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #f59e0b;
            --accent-color: #10b981;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #374151;
        }
        
        /* Navigation Styles */
        .navbar-brand img {
            height: 45px;
            width: auto;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover::after {
            width: 80%;
            left: 10%;
        }
        
        .navbar-nav .dropdown-menu {
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        
        .navbar-nav .dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: #374151;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
            padding-left: 1.5rem;
        }
        
        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
            color: #f1f5f9;
        }
        
        .hero-description {
            font-size: 1.1rem;
            color: #e2e8f0;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Single Poster Sidebar */
        .single-poster-sidebar {
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .single-poster-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
        }

        .single-poster-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.2);
        }

        .single-poster-image {
            position: relative;
            overflow: hidden;
        }

        .poster-img-4-5 {
            width: 100%;
            height: auto;
            aspect-ratio: 4/5;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .single-poster-card:hover .poster-img-4-5 {
            transform: scale(1.1);
        }

        .single-poster-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 2;
        }

        .single-poster-badge.badge-high {
            background: #e74c3c;
            color: white;
        }

        .single-poster-badge.badge-medium {
            background: #f39c12;
            color: white;
        }

        .single-poster-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 24px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .single-poster-card:hover .single-poster-overlay {
            opacity: 1;
        }

        .single-poster-overlay .btn {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            color: #2c3e50;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 25px;
        }

        .single-poster-overlay .btn:hover {
            background: #007bff;
            color: white;
        }
        
        /* Dynamic Content Section */
        .dynamic-content-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .content-tabs .nav-link {
            border: none;
            background: transparent;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 25px;
            transition: all 0.3s ease;
            margin-right: 8px;
        }
        
        .content-tabs .nav-link.active {
            background: #007bff;
            color: white;
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }
        
        /* Content Cards */
        .content-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .content-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .content-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .content-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .content-card:hover .content-image img {
            transform: scale(1.05);
        }
        
        .content-overlay {
            position: absolute;
            top: 12px;
            left: 12px;
        }
        
        .content-category {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }
        
        .content-body {
            padding: 20px;
        }
        
        .content-title {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .content-excerpt {
            font-size: 0.875rem;
            color: #6c757d;
            line-height: 1.5;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .content-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: #95a5a6;
        }
        
        .meta-author, .meta-date {
            display: flex;
            align-items: center;
        }
        
        /* Section Title */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        /* Poster Cards */
        .poster-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .poster-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .poster-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .poster-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .poster-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
        }
        
        .poster-badge.badge-high {
            background: #dc3545;
        }
        
        .poster-badge.badge-medium {
            background: #ffc107;
        }
        
        .poster-content {
            padding: 20px;
        }
        
        .poster-title {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .poster-date {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        /* Video Cards */
        .video-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .video-thumbnail {
            position: relative;
            height: 180px;
            overflow: hidden;
        }
        
        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #007bff;
            transition: all 0.3s ease;
        }
        
        .video-card:hover .video-play-btn {
            background: #007bff;
            color: white;
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
        }
        
        .video-info {
            padding: 1rem;
        }
        
        .video-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .video-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        /* Sidebar Content */
        .sidebar-widget {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .widget-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #007bff;
            text-transform: uppercase;
        }
        
        .sidebar-item {
            padding: 15px 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .sidebar-item:last-child {
            border-bottom: none;
        }
        
        .sidebar-item-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .sidebar-item-date {
            font-size: 0.8rem;
            color: #6c757d;
            margin: 0;
        }
        
        .sidebar-item-meta {
            font-size: 0.8rem;
            color: #6c757d;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .category-item:last-child {
            border-bottom: none;
        }
        
        .category-name {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .category-count {
            background: #007bff;
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer h5 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .footer p, .footer li {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }
        
        .footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }
        
        .social-links {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .social-links a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
        }
        
        /* Responsive Design */
        @media (max-width: 991.98px) {
            .single-poster-sidebar {
                margin-top: 40px;
                position: relative;
                top: auto;
            }
        }
        
        @media (max-width: 767.98px) {
            .single-poster-card {
                max-width: 300px;
                margin: 0 auto;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
            }
            
            .hero-description {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .content-image, .poster-image, .video-thumbnail {
                height: 180px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://images.unsplash.com/photo-1592280771190-3e2e4d571952?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&h=100&q=80" alt="Logo Sekolah" class="d-inline-block">
                <span class="ms-2 fw-bold text-primary">SMA Negeri Unggulan</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}"><i class="fas fa-bullseye me-2"></i>Visi Misi & Motto</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.prestasi') }}"><i class="fas fa-trophy me-2"></i>Prestasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.fasilitas') }}"><i class="fas fa-building me-2"></i>Fasilitas & Ekstrakurikuler</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Berita
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                            <li><a class="dropdown-item" href="{{ route('berita.today') }}"><i class="fas fa-newspaper me-2"></i>Smanung Today</a></li>
                            <li><a class="dropdown-item" href="{{ route('berita.siswa-prestasi') }}"><i class="fas fa-star me-2"></i>Siswa Prestasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('berita.agenda') }}"><i class="fas fa-calendar-alt me-2"></i>Agenda Sekolah</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('spmb') }}">SPMB</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sosmedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sosmed
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="sosmedDropdown">
                            <li><a class="dropdown-item" href="https://instagram.com" target="_blank"><i class="fab fa-instagram me-2"></i>Instagram Smanung</a></li>
                            <li><a class="dropdown-item" href="https://youtube.com" target="_blank"><i class="fab fa-youtube me-2"></i>YouTube Smanung</a></li>
                            <li><a class="dropdown-item" href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok me-2"></i>TikTok Smanung</a></li>
                        </ul>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>Informasi Sekolah</h5>
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Jl. Pendidikan No. 123, Kota Pendidikan, Indonesia 12345
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone me-2"></i>
                        (021) 555-0123
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-envelope me-2"></i>
                        info@smanegeriungulan.sch.id
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-globe me-2"></i>
                        www.smanegeriungulan.sch.id
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('profil.visi-misi') }}">Visi Misi & Motto</a></li>
                        <li class="mb-2"><a href="{{ route('profil.prestasi') }}">Prestasi Sekolah</a></li>
                        <li class="mb-2"><a href="{{ route('profil.fasilitas') }}">Fasilitas & Ekstrakurikuler</a></li>
                        <li class="mb-2"><a href="{{ route('spmb') }}">SPMB 2024/2025</a></li>
                        <li class="mb-2"><a href="{{ route('berita') }}">Berita & Pengumuman</a></li>
                        <li class="mb-2"><a href="{{ route('berita.agenda') }}">Agenda Kegiatan</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5>Follow Us</h5>
                    <p class="mb-3">Ikuti media sosial kami untuk mendapatkan informasi terbaru seputar kegiatan sekolah.</p>
                    <div class="social-links">
                        <a href="https://instagram.com" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://tiktok.com" target="_blank" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: #374151;">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} SMA Negeri Unggulan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Back to top button
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
        backToTop.className = 'btn btn-primary rounded-circle position-fixed';
        backToTop.style.cssText = 'bottom: 2rem; right: 2rem; z-index: 1000; display: none; width: 50px; height: 50px;';
        document.body.appendChild(backToTop);

        // Show/hide back to top button on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
            
            // Back to top button visibility
            if (window.scrollY > 300) {
                backToTop.style.display = 'block';
            } else {
                backToTop.style.display = 'none';
            }
        });

        // Back to top functionality
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize dropdowns on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>