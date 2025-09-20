@extends('layouts.dashboard')

@section('title', 'Content Management')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Content Management</h1>
        <a href="{{ route('dashboard.contents.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Content
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Search</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.contents.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category" class="form-control">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul, excerpt, atau author..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Content Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Content</h6>
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
                            <th>Kategori</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $index => $content)
                        <tr>
                            <td>{{ $contents->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" 
                                     style="width: 60px; height: 40px; object-fit: cover;" class="rounded">
                            </td>
                            <td>
                                <strong>{{ $content->title }}</strong><br>
                                <small class="text-muted">{{ Str::limit($content->excerpt, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $content->category_display_name }}</span>
                            </td>
                            <td>{{ $content->author }}</td>
                            <td>
                                @if($content->status == 'published')
                                    <span class="badge badge-success">Published</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $content->published_date->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.contents.show', $content) }}" 
                                       class="btn btn-info btn-sm" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.contents.edit', $content) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.contents.destroy', $content) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus content ini?')" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data content</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $contents->links() }}
        </div>
    </div>
</div>
@endsection