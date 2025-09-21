@extends('layouts.dashboard')

@section('title', 'Detail Fasilitas & Ekstrakulikuler')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Fasilitas & Ekstrakulikuler</h1>
        <div>
            <a href="{{ route('dashboard.facilities.edit', $facility) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('dashboard.facilities.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Detail</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Judul:</strong></div>
                        <div class="col-sm-9">{{ $facility->title }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Type:</strong></div>
                        <div class="col-sm-9">
                            @if($facility->type == 'fasilitas')
                                <span class="badge badge-info">Fasilitas</span>
                            @else
                                <span class="badge badge-success">Ekstrakurikuler</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Slug:</strong></div>
                        <div class="col-sm-9">{{ $facility->slug }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Dibuat:</strong></div>
                        <div class="col-sm-9">{{ $facility->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Diperbarui:</strong></div>
                        <div class="col-sm-9">{{ $facility->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <h6><strong>Deskripsi:</strong></h6>
                            <div class="content-description">
                                {!! $facility->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gambar</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $facility->image_url }}" 
                         alt="{{ $facility->title }}" 
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 300px;">
                    @if($facility->image)
                        <small class="d-block text-muted mt-2">
                            {{ basename($facility->image) }}
                        </small>
                    @endif
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.facilities.edit', $facility) }}" 
                           class="btn btn-warning btn-sm mb-2">
                            <i class="fas fa-edit"></i> Edit Fasilitas
                        </a>
                        
                        <form action="{{ route('dashboard.facilities.destroy', $facility) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-trash"></i> Hapus Fasilitas
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.content-description {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
    padding: 1rem;
    background-color: #f8f9fc;
    max-height: 400px;
    overflow-y: auto;
}

.content-description img {
    max-width: 100%;
    height: auto;
}
</style>
@endpush