@extends('layouts.dashboard')

@section('title', 'Detail Content')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Content</h1>
        <div>
            <a href="{{ route('dashboard.contents.edit', $content) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Main Content -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $content->title }}</h6>
                </div>
                <div class="card-body">
                    @if($content->image)
                    <div class="mb-4">
                        <img src="{{ $content->image_url }}" alt="{{ $content->title }}" 
                             class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                    </div>
                    @endif

                    <div class="mb-3">
                        <strong>Excerpt:</strong>
                        <p class="text-muted">{{ $content->excerpt }}</p>
                    </div>

                    <div class="content-body">
                        <strong>Konten:</strong>
                        <div class="mt-2" style="line-height: 1.8;">
                            {!! nl2br(e($content->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Content Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Content</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Kategori:</strong></td>
                            <td>
                                <span class="badge badge-info">{{ $content->category }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if($content->status == 'published')
                                    <span class="badge badge-success">Published</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Author:</strong></td>
                            <td>{{ $content->author }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Publikasi:</strong></td>
                            <td>{{ $content->published_date->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat:</strong></td>
                            <td>{{ $content->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Diupdate:</strong></td>
                            <td>{{ $content->updated_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Slug:</strong></td>
                            <td>
                                <code>{{ $content->slug }}</code>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('dashboard.contents.edit', $content) }}" 
                       class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Content
                    </a>
                    
                    <form action="{{ route('dashboard.contents.destroy', $content) }}" 
                          method="POST" onsubmit="return confirm('Yakin ingin menghapus content ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Hapus Content
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection