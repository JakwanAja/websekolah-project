@extends('layouts.dashboard')

@section('title', 'Edit Content')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Content</h1>
        <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Content</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.contents.update', $content) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $content->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Excerpt/Ringkasan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" 
                                      maxlength="500" required>{{ old('excerpt', $content->excerpt) }}</textarea>
                            <small class="form-text text-muted">Maksimal 500 karakter</small>
                        </div>

                        <div class="form-group">
                            <label for="content">Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="10" 
                                      required>{{ old('content', $content->content) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ old('category', $content->category) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="draft" {{ old('status', $content->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $content->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" 
                                   value="{{ old('author', $content->author) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="published_date">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="published_date" name="published_date" 
                                   value="{{ old('published_date', $content->published_date->format('Y-m-d')) }}" required>
                        </div>

                        @if($content->image)
                        <div class="form-group">
                            <label>Gambar Saat Ini</label><br>
                            <img src="{{ $content->image_url }}" alt="{{ $content->title }}" 
                                 style="max-width: 200px; max-height: 150px; object-fit: cover;" 
                                 class="img-thumbnail">
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Gambar {{ $content->image ? '(Upload baru untuk mengganti)' : '' }}</label>
                            <input type="file" class="form-control-file" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">
                                Format: JPEG, PNG, JPG. Maksimal 2MB
                            </small>
                        </div>

                        <div class="form-group" id="image-preview" style="display: none;">
                            <label>Preview Gambar Baru</label><br>
                            <img id="preview-img" src="#" alt="Preview" 
                                 style="max-width: 200px; max-height: 150px; object-fit: cover;" 
                                 class="img-thumbnail">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').style.display = 'none';
    }
});
</script>
@endsection