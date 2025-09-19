@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="page-title">Dashboard</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="text-muted">
            <i class="fas fa-calendar me-2"></i>{{ date('d F Y') }}
        </div>
    </div>
</div>

<!-- Welcome Alert -->
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-info-circle me-3 fs-4"></i>
        <div>
            <h5 class="alert-heading mb-1">Selamat Datang, {{ Auth::user()->name }}!</h5>
            <p class="mb-0">Anda login sebagai <strong>{{ ucfirst(Auth::user()->getRoleNames()->first()) }}</strong></p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<!-- Stats Cards Row -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-number">150</div>
            <div class="stats-label">Total Siswa</div>
            <div class="stats-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #00d4aa, #00cae3);">
            <div class="stats-number">25</div>
            <div class="stats-label">Total Berita</div>
            <div class="stats-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #ffc107, #ff8c00);">
            <div class="stats-number">89</div>
            <div class="stats-label">Total Galeri</div>
            <div class="stats-icon">
                <i class="fas fa-images"></i>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #ff4c51, #e91e63);">
            <div class="stats-number">{{ \App\Models\User::count() }}</div>
            <div class="stats-label">Total Users</div>
            <div class="stats-icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock text-primary me-2"></i>
                    Aktivitas Terbaru
                </h5>
                <small class="text-muted">Hari ini</small>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Berita "Prestasi Siswa" dipublish</h6>
                            <p class="text-muted mb-0">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">10 foto baru ditambahkan ke galeri</h6>
                            <p class="text-muted mb-0">4 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">User baru terdaftar: John Doe</h6>
                            <p class="text-muted mb-0">6 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Backup database berhasil</h6>
                            <p class="text-muted mb-0">1 hari yang lalu</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        Lihat Semua Aktivitas
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Info -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt text-warning me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-plus me-2"></i>Tambah Berita
                    </button>
                    <button class="btn btn-success btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-upload me-2"></i>Upload Galeri
                    </button>
                    @role('super admin')
                    <button class="btn btn-warning btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-user-plus me-2"></i>Tambah User
                    </button>
                    @endrole
                    <button class="btn btn-info btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-cog me-2"></i>Pengaturan
                    </button>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-server text-info me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <div class="p-2">
                            <h6 class="text-success mb-1">Server Status</h6>
                            <small class="text-muted">Online</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2">
                            <h6 class="text-primary mb-1">Laravel</h6>
                            <small class="text-muted">v8.x</small>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small>PHP Version:</small>
                    <span class="badge bg-light text-dark">{{ PHP_VERSION }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small>Database:</small>
                    <span class="badge bg-light text-dark">MySQL</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Last Login:</small>
                    <small class="text-muted">{{ now()->format('H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users (Only for Super Admin) -->
@role('super admin')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users text-primary me-2"></i>
                    Users Terdaftar
                </h5>
                <button class="btn btn-primary btn-sm" onclick="alert('Fitur akan segera hadir!')">
                    <i class="fas fa-user-plus me-1"></i>Tambah User
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\User::with('roles')->take(5)->get() as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 35px; height: 35px; font-size: 0.8rem;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles->isNotEmpty())
                                        <span class="badge bg-{{ $user->hasRole('super admin') ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->roles->first()->name) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">No Role</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm" onclick="alert('Fitur akan segera hadir!')" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($user->id !== Auth::id())
                                        <button class="btn btn-outline-danger btn-sm" onclick="alert('Fitur akan segera hadir!')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-primary btn-sm" onclick="alert('Fitur akan segera hadir!')">
                        Lihat Semua Users
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@push('styles')
<style>
    .timeline {
        position: relative;
        padding: 0;
        margin: 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 2.5rem;
        padding-bottom: 1.5rem;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 0.6rem;
        top: 2rem;
        width: 2px;
        height: calc(100% - 1rem);
        background-color: #e9ecef;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 0.25rem;
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #e9ecef;
    }

    .avatar {
        font-weight: 600;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }

    .btn-group-sm > .btn {
        padding: 0.375rem 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Animate stats numbers
    document.addEventListener('DOMContentLoaded', function() {
        const statsNumbers = document.querySelectorAll('.stats-number');
        statsNumbers.forEach(function(element) {
            const finalNumber = parseInt(element.textContent);
            let currentNumber = 0;
            const increment = finalNumber / 50;
            
            const timer = setInterval(function() {
                currentNumber += increment;
                if (currentNumber >= finalNumber) {
                    element.textContent = finalNumber;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(currentNumber);
                }
            }, 20);
        });
    });
</script>
@endpush
@endsection