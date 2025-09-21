@extends('layouts.app')

@section('title', 'Fasilitas & Ekstrakulikuler - SMA Negeri Unggulan')

@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); padding: 80px 0 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item"><span class="text-white-50">Profil</span></li>
                            <li class="breadcrumb-item active text-white">Fasilitas & Ekstrakulikuler</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3">Fasilitas & Ekstrakulikuler</h1>
                    <p class="lead mb-0">Fasilitas lengkap dan beragam kegiatan ekstrakurikuler untuk mendukung prestasi siswa</p>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                <div class="hero-stats">
                    <div class="stat-item bg-white bg-opacity-10 rounded p-3 mb-3">
                        <h3 class="h4 text-white mb-1">{{ $totalFacilities }}</h3>
                        <span class="text-white-75 small">Total Item</span>
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
                            <form method="GET" action="{{ route('profil.fasilitas') }}" class="search-form">
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Cari fasilitas atau ekstrakurikuler...">
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <div class="filter-tabs">
                                <a href="{{ route('profil.fasilitas') }}" 
                                   class="btn {{ !request('type') ? 'btn-success' : 'btn-outline-success' }} btn-sm me-2">
                                    Semua
                                </a>
                                <a href="{{ route('profil.fasilitas', ['type' => 'fasilitas']) }}" 
                                   class="btn {{ request('type') == 'fasilitas' ? 'btn-success' : 'btn-outline-success' }} btn-sm me-2">
                                    Fasilitas
                                </a>
                                <a href="{{ route('profil.fasilitas', ['type' => 'ekstrakurikuler']) }}" 
                                   class="btn {{ request('type') == 'ekstrakurikuler' ? 'btn-success' : 'btn-outline-success' }} btn-sm">
                                    Ekstrakurikuler
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Count -->
                <div class="content-count text-muted mb-4">
                    Menampilkan {{ $facilities->count() }} dari {{ $facilities->total() }} item
                    @if(request('type'))
                        untuk kategori "{{ request('type') == 'fasilitas' ? 'Fasilitas' : 'Ekstrakurikuler' }}"
                    @endif
                    @if(request('search'))
                        dengan pencarian "{{ request('search') }}"
                    @endif
                </div>

                <!-- Content Grid -->
                @if($facilities->count() > 0)
                    <div class="row g-4">
                        @foreach($facilities as $facility)
                        <div class="col-lg-6 col-md-6">
                            <article class="facility-card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                <div class="facility-image position-relative">
                                    <img src="{{ $facility->image_url }}" 
                                         alt="{{ $facility->title }}" 
                                         class="w-100"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="facility-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-3"
                                         style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                        <span class="facility-type bg-{{ $facility->type == 'fasilitas' ? 'info' : 'success' }} text-white px-2 py-1 rounded small">
                                            {{ $facility->type_display_name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="facility-body p-3 d-flex flex-column">
                                    <h5 class="facility-title mb-2">
                                        {{ $facility->title }}
                                    </h5>
                                    <p class="facility-excerpt text-muted mb-3 flex-grow-1">
                                        {{ $facility->short_excerpt }}
                                    </p>
                                    <div class="facility-meta d-flex justify-content-between align-items-center small text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-{{ $facility->type == 'fasilitas' ? 'building' : 'users' }} me-1"></i>
                                            <span>{{ $facility->type_display_name }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar me-1"></i>
                                            <span>{{ $facility->created_at->format('M Y') }}</span>
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
                            {{ $facilities->links() }}
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-building fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted mb-2">Belum Ada Data</h4>
                        <p class="text-muted">
                            @if(request('search'))
                                Tidak ditemukan fasilitas dengan kata kunci "{{ request('search') }}"
                            @elseif(request('type'))
                                Belum ada data untuk kategori "{{ request('type') == 'fasilitas' ? 'Fasilitas' : 'Ekstrakurikuler' }}"
                            @else
                                Data fasilitas dan ekstrakurikuler akan segera hadir.
                            @endif
                        </p>
                        @if(request('search') || request('type'))
                            <a href="{{ route('profil.fasilitas') }}" class="btn btn-success">
                                Lihat Semua Data
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Statistics Widget -->
                <div class="widget mb-4">
                    <div class="widget-header bg-success text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Statistik
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        <div class="stat-list">
                            <div class="stat-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building text-info me-2"></i>
                                    <span>Fasilitas</span>
                                </div>
                                <span class="badge bg-info">{{ $fasilitasCount }}</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-success me-2"></i>
                                    <span>Ekstrakurikuler</span>
                                </div>
                                <span class="badge bg-success">{{ $ekstrakulikulerCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Items Widget -->
                <div class="widget mb-4">
                    <div class="widget-header bg-info text-white p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-clock me-2"></i>Terbaru
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        @forelse($recentFacilities as $recent)
                            <div class="sidebar-item pb-3 mb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="d-flex">
                                    <img src="{{ $recent->image_url }}" 
                                         alt="{{ $recent->title }}" 
                                         class="rounded me-2"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="sidebar-item-title mb-1">
                                            {{ Str::limit($recent->title, 40) }}
                                        </h6>
                                        <div class="sidebar-item-meta small text-muted">
                                            <span class="badge bg-{{ $recent->type == 'fasilitas' ? 'info' : 'success' }} me-1">
                                                {{ $recent->type_display_name }}
                                            </span>
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $recent->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada data terbaru.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Links Widget -->
                <div class="widget">
                    <div class="widget-header bg-warning text-dark p-3 rounded-top">
                        <h5 class="widget-title mb-0">
                            <i class="fas fa-link me-2"></i>Menu Profil
                        </h5>
                    </div>
                    <div class="widget-body bg-white border border-top-0 rounded-bottom p-3">
                        <div class="quick-links">
                            <a href="{{ route('profil.visi-misi') }}" class="d-flex align-items-center text-decoration-none mb-2 p-2 rounded hover-bg-light">
                                <i class="fas fa-eye text-primary me-2"></i>
                                <span>Visi & Misi</span>
                            </a>
                            <a href="{{ route('profil.prestasi') }}" class="d-flex align-items-center text-decoration-none mb-2 p-2 rounded hover-bg-light">
                                <i class="fas fa-trophy text-warning me-2"></i>
                                <span>Prestasi</span>
                            </a>
                            <a href="{{ route('profil.fasilitas') }}" class="d-flex align-items-center text-decoration-none p-2 rounded bg-light">
                                <i class="fas fa-building text-success me-2"></i>
                                <span>Fasilitas & Ekstrakulikuler</span>
                            </a>
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
.facility-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.facility-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.facility-image {
    overflow: hidden;
}

.facility-card:hover .facility-image img {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.widget {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-form .form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
}

.breadcrumb-item a:hover {
    color: white !important;
}

.filter-tabs .btn {
    border-radius: 20px;
}

.hover-bg-light:hover {
    background-color: #f8f9fa !important;
}
</style>
@endpush