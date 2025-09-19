@extends('layouts.app')

@section('title', $title . ' - SMA Negeri Unggulan')
@section('description', 'Halaman ' . $title . ' sedang dalam pengembangan. Kembali lagi nanti untuk konten yang lebih lengkap.')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="py-5">
                <i class="fas fa-tools text-primary mb-4" style="font-size: 5rem;"></i>
                <h1 class="display-4 fw-bold text-primary mb-4">{{ $title }}</h1>
                <p class="lead text-muted mb-4">
                    Halaman ini sedang dalam proses pengembangan. 
                    Kami akan segera melengkapi konten untuk memberikan informasi terbaik bagi Anda.
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection