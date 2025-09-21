@extends('layouts.dashboard')

@section('title', 'Fasilitas & Ekstrakulikuler')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fasilitas & Ekstrakulikuler</h1>
        <a href="{{ route('dashboard.facilities.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Fasilitas/Ekstrakulikuler
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Search</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.facilities.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="">Semua Type</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Cari berdasarkan judul atau deskripsi..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('dashboard.facilities.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Facilities Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Fasilitas & Ekstrakulikuler</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facilities as $index => $facility)
                        <tr>
                            <td>{{ $facilities->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $facility->image_url }}" alt="{{ $facility->title }}" 
                                     style="width: 60px; height: 40px; object-fit: cover;" class="rounded">
                            </td>
                            <td>
                                <strong>{{ $facility->title }}</strong>
                            </td>
                            <td>
                                @if($facility->type == 'fasilitas')
                                    <span class="badge badge-info">Fasilitas</span>
                                @else
                                    <span class="badge badge-success">Ekstrakurikuler</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit(strip_tags($facility->description), 80) }}</small>
                            </td>
                            <td>{{ $facility->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.facilities.show', $facility) }}" 
                                       class="btn btn-info btn-sm" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.facilities.edit', $facility) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.facilities.destroy', $facility) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus fasilitas ini?')" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data fasilitas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $facilities->links() }}
        </div>
    </div>
</div>
@endsection