@extends('layouts.dashboard')

@section('title', 'Tambah Content')

@push('styles')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame .note-editing-area .note-editable {
        min-height: 300px;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .note-toolbar {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    
    .note-btn-group .note-btn {
        background: transparent;
        border: none;
        margin: 2px;
        border-radius: 3px;
        transition: all 0.2s ease;
    }
    
    .note-btn:hover {
        background-color: #e9ecef;
    }
    
    .note-btn.active {
        background-color: #007bff;
        color: white;
    }
    
    .image-preview-container {
        position: relative;
        display: inline-block;
    }
    
    .remove-preview {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(220, 53, 69, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .remove-preview:hover {
        background: rgba(220, 53, 69, 1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Content</h1>
        <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Content</h6>
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

            <form action="{{ route('dashboard.contents.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required placeholder="Masukkan judul content">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Excerpt/Ringkasan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" 
                                      maxlength="500" required placeholder="Masukkan ringkasan content (maksimal 500 karakter)">{{ old('excerpt') }}</textarea>
                            <div class="d-flex justify-content-between">
                                <small class="form-text text-muted">Maksimal 500 karakter</small>
                                <small class="form-text text-muted" id="excerptCounter">0/500</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summernote" name="content" required>{{ old('content') }}</textarea>
                            <small class="form-text text-muted">Gunakan toolbar di atas untuk memformat konten Anda</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" 
                                   value="{{ old('author', auth()->user()->name ?? '') }}" required placeholder="Nama penulis">
                        </div>

                        <div class="form-group">
                            <label for="published_date">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="published_date" name="published_date" 
                                   value="{{ old('published_date', date('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Gambar Featured</label>
                            <input type="file" class="form-control-file" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="form-text text-muted">
                                Format: JPEG, PNG, JPG, WEBP. Maksimal 2MB. Ukuran optimal: 800x600px
                            </small>
                        </div>

                        <div class="form-group" id="image-preview" style="display: none;">
                            <label>Preview Gambar</label><br>
                            <div class="image-preview-container">
                                <img id="preview-img" src="#" alt="Preview" 
                                     style="max-width: 100%; max-height: 200px; object-fit: cover;" 
                                     class="img-thumbnail">
                                <button type="button" class="remove-preview" onclick="removeImagePreview()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0 text-primary">
                                    <i class="fas fa-search me-2"></i>SEO Settings (Opsional)
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                           value="{{ old('meta_title') }}" maxlength="60" placeholder="Judul untuk SEO">
                                    <small class="form-text text-muted">Kosongkan untuk menggunakan judul utama</small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" 
                                              rows="2" maxlength="160" placeholder="Deskripsi untuk mesin pencari">{{ old('meta_description') }}</textarea>
                                    <small class="form-text text-muted">Kosongkan untuk menggunakan excerpt</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-info" onclick="previewContent()">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery (required for Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 JS (required for Summernote) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- Summernote Indonesian Language -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Summernote
    $('#summernote').summernote({
        height: 400,
        minHeight: 300,
        maxHeight: 600,
        lang: 'id-ID',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        styleTags: [
            'p',
            { title: 'Heading 2', tag: 'h2', className: 'h2' },
            { title: 'Heading 3', tag: 'h3', className: 'h3' },
            { title: 'Heading 4', tag: 'h4', className: 'h4' },
            { title: 'Heading 5', tag: 'h5', className: 'h5' },
            { title: 'Heading 6', tag: 'h6', className: 'h6' },
            'blockquote'
        ],
        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '28', '32', '36', '48', '64', '72'],
        callbacks: {
            onImageUpload: function(files) {
                // Handle image upload here if needed
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onChange: function(contents, $editable) {
                // Auto-save functionality can be added here
            }
        },
        placeholder: 'Tulis konten Anda di sini...',
        dialogsInBody: true,
        dialogsFade: true
    });

    // Excerpt character counter
    $('#excerpt').on('input', function() {
        const length = $(this).val().length;
        $('#excerptCounter').text(length + '/500');
        
        if (length > 450) {
            $('#excerptCounter').addClass('text-warning');
        } else if (length > 500) {
            $('#excerptCounter').addClass('text-danger').removeClass('text-warning');
        } else {
            $('#excerptCounter').removeClass('text-warning text-danger');
        }
    });

    // Image preview functionality
    $('#image').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                $(this).val('');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#image-preview').hide();
        }
    });

    // Form validation before submit
    $('#contentForm').on('submit', function(e) {
        const content = $('#summernote').summernote('code');
        if (content === '<p><br></p>' || content.trim() === '') {
            e.preventDefault();
            alert('Konten tidak boleh kosong!');
            return false;
        }

        // Show loading state
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
    });

    // Auto-generate meta title from title
    $('#title').on('input', function() {
        const title = $(this).val();
        if ($('#meta_title').val() === '') {
            $('#meta_title').val(title.substring(0, 60));
        }
    });

    // Auto-generate meta description from excerpt
    $('#excerpt').on('input', function() {
        const excerpt = $(this).val();
        if ($('#meta_description').val() === '') {
            $('#meta_description').val(excerpt.substring(0, 160));
        }
    });
});

// Upload image to Summernote
function uploadImage(file) {
    // This is a placeholder for image upload functionality
    // You would typically upload to your server and get back a URL
    const reader = new FileReader();
    reader.onload = function(e) {
        $('#summernote').summernote('insertImage', e.target.result);
    }
    reader.readAsDataURL(file);
}

// Remove image preview
function removeImagePreview() {
    $('#image').val('');
    $('#image-preview').hide();
}

// Preview content functionality
function previewContent() {
    const title = $('#title').val();
    const content = $('#summernote').summernote('code');
    const author = $('#author').val();
    const publishedDate = $('#published_date').val();
    
    const previewHtml = `
        <div class="preview-content">
            <h2>${title || 'Judul belum diisi'}</h2>
            <div class="mb-3">
                <small class="text-muted">
                    Oleh: ${author || 'Author belum diisi'} | 
                    Tanggal: ${publishedDate ? new Date(publishedDate).toLocaleDateString('id-ID') : 'Tanggal belum diisi'}
                </small>
            </div>
            <div class="content-body">
                ${content || '<p class="text-muted">Konten belum diisi</p>'}
            </div>
        </div>
    `;
    
    $('#previewContent').html(previewHtml);
    $('#previewModal').modal('show');
}
</script>
@endpush