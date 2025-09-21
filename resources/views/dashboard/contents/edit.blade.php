@extends('layouts.dashboard')

@section('title', 'Edit Content')

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

    .current-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
    }

    .change-indicator {
        background: rgba(40, 167, 69, 0.1);
        border: 2px dashed #28a745;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        color: #28a745;
        margin-top: 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Content</h1>
        <div>
            <a href="{{ route('dashboard.contents.show', $content) }}" class="btn btn-info btn-sm me-2">
                <i class="fas fa-eye"></i> Lihat
            </a>
            <a href="{{ route('dashboard.contents.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Content</h6>
            <div class="text-muted small">
                <i class="fas fa-clock"></i> Terakhir diupdate: {{ $content->updated_at->format('d/m/Y H:i') }}
            </div>
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

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('dashboard.contents.update', $content) }}" method="POST" enctype="multipart/form-data" id="contentForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $content->title) }}" required placeholder="Masukkan judul content">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Excerpt/Ringkasan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" 
                                      maxlength="500" required placeholder="Masukkan ringkasan content (maksimal 500 karakter)">{{ old('excerpt', $content->excerpt) }}</textarea>
                            <div class="d-flex justify-content-between">
                                <small class="form-text text-muted">Maksimal 500 karakter</small>
                                <small class="form-text text-muted" id="excerptCounter">{{ strlen($content->excerpt) }}/500</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summernote" name="content" required>{{ old('content', $content->content) }}</textarea>
                            <small class="form-text text-muted">Gunakan toolbar di atas untuk memformat konten Anda</small>
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
                                   value="{{ old('author', $content->author) }}" required placeholder="Nama penulis">
                        </div>

                        <div class="form-group">
                            <label for="published_date">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="published_date" name="published_date" 
                                   value="{{ old('published_date', $content->published_date->format('Y-m-d')) }}" required>
                        </div>

                        @if($content->image)
                        <div class="form-group">
                            <label>Gambar Saat Ini</label><br>
                            <div class="current-image-container">
                                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" 
                                     style="max-width: 100%; max-height: 200px; object-fit: cover;" 
                                     class="img-thumbnail">
                                <button type="button" class="remove-preview" onclick="confirmRemoveCurrentImage()" title="Hapus gambar saat ini">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> Klik tombol X untuk menghapus gambar saat ini
                                </small>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image">
                                Gambar Featured 
                                @if($content->image)
                                    <span class="text-muted">(Upload baru untuk mengganti)</span>
                                @endif
                            </label>
                            <input type="file" class="form-control-file" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="form-text text-muted">
                                Format: JPEG, PNG, JPG, WEBP. Maksimal 2MB. Ukuran optimal: 800x600px
                            </small>
                        </div>

                        <!-- Hidden field to track image removal -->
                        <input type="hidden" id="remove_current_image" name="remove_current_image" value="0">

                        <div class="form-group" id="image-preview" style="display: none;">
                            <label>Preview Gambar Baru</label><br>
                            <div class="image-preview-container">
                                <img id="preview-img" src="#" alt="Preview" 
                                     style="max-width: 100%; max-height: 200px; object-fit: cover;" 
                                     class="img-thumbnail">
                                <button type="button" class="remove-preview" onclick="removeImagePreview()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="change-indicator">
                                <i class="fas fa-upload"></i> Gambar baru akan mengganti gambar saat ini
                            </div>
                        </div>

                        <!-- Content Stats -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0 text-info">
                                    <i class="fas fa-chart-line me-2"></i>Statistik Content
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-right">
                                            <h5 class="mb-1">{{ $content->views ?? 0 }}</h5>
                                            <small class="text-muted">Views</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1" id="wordCount">0</h5>
                                        <small class="text-muted">Kata</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <small class="text-muted">
                                        Dibuat: {{ $content->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <button type="button" class="btn btn-info" onclick="previewContent()">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <button type="button" class="btn btn-warning" onclick="saveDraft()">
                        <i class="fas fa-file-alt"></i> Simpan sebagai Draft
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

<!-- Confirm Remove Image Modal -->
<div class="modal fade" id="confirmRemoveModal" tabindex="-1" role="dialog" aria-labelledby="confirmRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmRemoveModalLabel">Konfirmasi Hapus Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus gambar saat ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="removeCurrentImage()">Ya, Hapus</button>
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
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onChange: function(contents, $editable) {
                updateWordCount(contents);
                // Auto-save functionality can be added here
            }
        },
        placeholder: 'Tulis konten Anda di sini...',
        dialogsInBody: true,
        dialogsFade: true
    });

    // Initial word count
    updateWordCount($('#summernote').summernote('code'));

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
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengupdate...');
    });

    // Auto-save functionality (every 30 seconds)
    let autoSaveInterval = setInterval(function() {
        if ($('#title').val() && $('#summernote').summernote('code')) {
            autoSave();
        }
    }, 30000);

    // Clear interval when leaving page
    $(window).on('beforeunload', function() {
        clearInterval(autoSaveInterval);
    });
});

// Update word count
function updateWordCount(content) {
    const text = $(content).text();
    const wordCount = text.trim() ? text.trim().split(/\s+/).length : 0;
    $('#wordCount').text(wordCount);
}

// Upload image to Summernote
function uploadImage(file) {
    // Placeholder for image upload functionality
    const reader = new FileReader();
    reader.onload = function(e) {
        $('#summernote').summernote('insertImage', e.target.result);
    }
    reader.readAsDataURL(file);
}

// Remove new image preview
function removeImagePreview() {
    $('#image').val('');
    $('#image-preview').hide();
}

// Confirm remove current image
function confirmRemoveCurrentImage() {
    $('#confirmRemoveModal').modal('show');
}

// Remove current image
function removeCurrentImage() {
    $('#remove_current_image').val('1');
    $('.current-image-container').fadeOut();
    $('#confirmRemoveModal').modal('hide');
    
    // Show indicator
    $('.current-image-container').after('<div class="alert alert-warning" id="image-removed-alert"><i class="fas fa-exclamation-triangle"></i> Gambar saat ini akan dihapus saat form disimpan</div>');
}

// Preview content functionality
function previewContent() {
    const title = $('#title').val();
    const content = $('#summernote').summernote('code');
    const author = $('#author').val();
    const publishedDate = $('#published_date').val();
    const category = $('#category option:selected').text();
    
    const previewHtml = `
        <div class="preview-content">
            <div class="mb-2">
                <span class="badge badge-primary">${category}</span>
            </div>
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

// Save as draft
function saveDraft() {
    $('#status').val('draft');
    $('#contentForm').submit();
}

// Auto-save functionality
function autoSave() {
    const formData = new FormData();
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');
    formData.append('title', $('#title').val());
    formData.append('excerpt', $('#excerpt').val());
    formData.append('content', $('#summernote').summernote('code'));
    formData.append('category', $('#category').val());
    formData.append('status', 'draft'); // Always save as draft for auto-save
    formData.append('author', $('#author').val());
    formData.append('published_date', $('#published_date').val());
    formData.append('auto_save', '1');

    $.ajax({
        url: '{{ route("dashboard.contents.update", $content) }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Show auto-save indicator
            if (!$('#auto-save-indicator').length) {
                $('.card-header').append('<small class="text-success ml-2" id="auto-save-indicator"><i class="fas fa-check-circle"></i> Auto-saved</small>');
                setTimeout(function() {
                    $('#auto-save-indicator').fadeOut();
                }, 3000);
            }
        },
        error: function(xhr) {
            console.log('Auto-save failed:', xhr.responseText);
        }
    });
}
</script>
@endpush