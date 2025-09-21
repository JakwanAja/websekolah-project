@extends('layouts.dashboard')

@section('title', 'Edit Fasilitas & Ekstrakulikuler')

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
        width: 100%;
    }
    
    .remove-preview {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(220, 53, 69, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }
    
    .remove-preview:hover {
        background: rgba(220, 53, 69, 1);
    }

    .current-image-info {
        background-color: #e3f2fd;
        border: 1px solid #bbdefb;
        border-radius: 4px;
        padding: 8px 12px;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Fasilitas & Ekstrakulikuler</h1>
        <a href="{{ route('dashboard.facilities.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Fasilitas/Ekstrakulikuler</h6>
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

            <form action="{{ route('dashboard.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data" id="facilityEditForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $facility->title) }}" required
                                   placeholder="Masukkan judul fasilitas/ekstrakulikuler">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select class="form-control @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                <option value="">Pilih Type</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ old('type', $facility->type) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" required>{{ old('description', $facility->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Gunakan toolbar di atas untuk memformat deskripsi Anda</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        @if($facility->image)
                            <div class="current-image-info">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Gambar saat ini: <strong>{{ basename($facility->image) }}</strong>
                                </small>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="image">
                                {{ $facility->image ? 'Ganti Gambar' : 'Upload Gambar' }}
                            </label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" 
                                   onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPEG, PNG, JPG, WEBP. Maksimal: 2MB</small>
                        </div>

                        <div class="form-group">
                            <label>Preview</label>
                            <div class="border rounded p-2 text-center image-preview-container" style="min-height: 200px;">
                                @if($facility->image)
                                    <img id="imagePreview" 
                                         src="{{ $facility->image_url }}" 
                                         alt="Preview" 
                                         style="max-width: 100%; max-height: 180px; object-fit: cover;" 
                                         class="rounded">
                                    <button type="button" class="remove-preview" onclick="removeCurrentImage()" title="Hapus gambar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <div id="noImageText" class="d-flex align-items-center justify-content-center text-muted h-100" 
                                         style="display: none !important;">
                                        <div>
                                            <i class="fas fa-image fa-3x mb-3"></i>
                                            <br>Tidak ada gambar
                                        </div>
                                    </div>
                                @else
                                    <img id="imagePreview" 
                                         src="#" 
                                         alt="Preview" 
                                         style="max-width: 100%; max-height: 180px; display: none; object-fit: cover;" 
                                         class="rounded">
                                    <div id="noImageText" class="d-flex align-items-center justify-content-center text-muted h-100">
                                        <div>
                                            <i class="fas fa-image fa-3x mb-3"></i>
                                            <br>Tidak ada gambar
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Hidden input to track image removal -->
                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                            
                            <button type="button" class="btn btn-sm btn-danger mt-2" id="removePreview" 
                                    onclick="removeImagePreview()" style="display: none;">
                                <i class="fas fa-times"></i> Hapus Preview
                            </button>
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
                    <a href="{{ route('dashboard.facilities.index') }}" class="btn btn-secondary">
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
                <h5 class="modal-title" id="previewModalLabel">Preview Fasilitas/Ekstrakulikuler</h5>
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
    $('#description').summernote({
        height: 300,
        minHeight: 250,
        maxHeight: 500,
        lang: 'id-ID',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        styleTags: [
            'p',
            { title: 'Heading 2', tag: 'h2', className: 'h2' },
            { title: 'Heading 3', tag: 'h3', className: 'h3' },
            { title: 'Heading 4', tag: 'h4', className: 'h4' },
            'blockquote'
        ],
        fontSizes: ['10', '11', '12', '14', '16', '18', '20', '24', '28', '32'],
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onChange: function(contents, $editable) {
                // Auto-save functionality can be added here
            }
        },
        placeholder: 'Tulis deskripsi fasilitas/ekstrakulikuler di sini...',
        dialogsInBody: true,
        dialogsFade: true
    });

    // Form validation before submit
    $('#facilityEditForm').on('submit', function(e) {
        const content = $('#description').summernote('code');
        if (content === '<p><br></p>' || content.trim() === '') {
            e.preventDefault();
            alert('Deskripsi tidak boleh kosong!');
            return false;
        }

        // Show loading state
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengupdate...');
    });
});

// Upload image to Summernote
function uploadImage(file) {
    // Validate file size (2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file terlalu besar. Maksimal 2MB.');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        $('#description').summernote('insertImage', e.target.result);
    }
    reader.readAsDataURL(file);
}

// Preview new image when file is selected
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const noImageText = document.getElementById('noImageText');
    const removeBtn = document.getElementById('removePreview');
    const currentRemoveBtn = document.querySelector('.remove-preview');
    
    if (input.files && input.files[0]) {
        // Validate file size (2MB)
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            noImageText.style.display = 'none';
            removeBtn.style.display = 'block';
            
            // Hide current image remove button since we're showing new preview
            if (currentRemoveBtn) {
                currentRemoveBtn.style.display = 'none';
            }
            
            // Reset remove image flag
            document.getElementById('remove_image').value = '0';
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Remove new image preview (back to original or no image)
function removeImagePreview() {
    const preview = document.getElementById('imagePreview');
    const noImageText = document.getElementById('noImageText');
    const removeBtn = document.getElementById('removePreview');
    const fileInput = document.getElementById('image');
    const currentRemoveBtn = document.querySelector('.remove-preview');
    
    // Clear file input
    fileInput.value = '';
    removeBtn.style.display = 'none';
    
    if (hasOriginalImage && document.getElementById('remove_image').value === '0') {
        // Show original image
        preview.src = originalImageUrl;
        preview.style.display = 'block';
        noImageText.style.display = 'none';
        if (currentRemoveBtn) {
            currentRemoveBtn.style.display = 'flex';
        }
    } else {
        // Show no image placeholder
        preview.style.display = 'none';
        noImageText.style.display = 'flex';
        if (currentRemoveBtn) {
            currentRemoveBtn.style.display = 'none';
        }
    }
}
// Preview content functionality
function previewContent() {
    const title = $('#title').val();
    const type = $('#type option:selected').text();
    const content = $('#description').summernote('code');
    const hasImage = $('#imagePreview').is(':visible');
    const imageSrc = hasImage ? $('#imagePreview').attr('src') : '';
    
    let imageHtml = '';
    if (hasImage && imageSrc && imageSrc !== '#') {
        imageHtml = `<div class="mb-3"><img src="${imageSrc}" alt="Preview" style="max-width: 100%; height: auto;" class="img-fluid rounded"></div>`;
    }
    
    const previewHtml = `
        <div class="preview-content">
            <h3>${title || 'Judul belum diisi'}</h3>
            <div class="mb-3">
                <span class="badge badge-primary">${type !== 'Pilih Type' ? type : 'Type belum dipilih'}</span>
            </div>
            ${imageHtml}
            <div class="content-body">
                ${content || '<p class="text-muted">Deskripsi belum diisi</p>'}
            </div>
        </div>
    `;
    
    $('#previewContent').html(previewHtml);
    $('#previewModal').modal('show');
}
</script>
@endpush