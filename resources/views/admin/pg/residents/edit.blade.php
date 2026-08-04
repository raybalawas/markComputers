@extends('admin.layouts.app')

@section('content')
<style>
    .student-form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .form-title {
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .btn-secondary {
        background: #6b7280;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #0f172a;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col-md-6 {
        flex: 1 1 calc(50% - 20px);
        min-width: 200px;
    }

    .col-md-12 {
        flex: 1 1 100%;
    }

    .btn-submit {
        background: #2563eb;
        color: #fff;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #1d4ed8;
    }

    /* 🚀 ADVANCED DRAG & DROP AADHAR UPLOADER STYLES */
    .upload-container {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        background-color: #f8fafc;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        margin-top: 5px;
    }

    .upload-container.dragover {
        border-color: #2563eb;
        background-color: #eff6ff;
    }

    .upload-container .icon-wrapper {
        font-size: 40px;
        color: #6b7280;
        margin-bottom: 10px;
    }

    .upload-container .file-info {
        font-size: 14px;
        color: #64748b;
    }

    .upload-container input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Preview Styles */
    .upload-preview {
        display: none;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
    }

    .upload-preview img {
        max-width: 120px;
        max-height: 120px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        object-fit: cover;
        background: #ffffff;
    }

    .upload-preview .file-details {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-remove-file {
        background: #ef4444;
        color: white;
        border: none;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-remove-file:hover {
        background: #dc2626;
    }

    /* 📱 MOBILE RESPONSIVENESS OPTIMIZATION */
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 1 1 100%;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .student-form-card {
            padding: 16px;
        }

        .btn-secondary,
        .btn-submit {
            width: 100%;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            font-size: 16px !important;
        }

        .upload-container {
            padding: 16px;
        }

        .upload-preview img {
            max-width: 80px;
            max-height: 80px;
        }
    }
</style>

<div class="student-form-card">
    <div class="form-header">
        <h3 class="form-title">Edit Resident</h3>
        <a href="{{ route('superadmin.pg-residents.index') }}" class="btn-secondary">← Back</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- ✅ REQUIRED: Added enctype="multipart/form-data" for file uploads -->
    <form action="{{ route('superadmin.pg-residents.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $resident->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $resident->phone) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $resident->email) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="aadhar">Aadhar Number</label>
                    <input type="text" name="aadhar" id="aadhar" class="form-control" value="{{ old('aadhar', $resident->aadhar) }}" placeholder="e.g. 1234 5678 9012">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="room_id">Assign Room</label>
                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">-- No Room assigned --</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $resident->room->id ?? '') == $room->id ? 'selected' : '' }}>
                            #{{ $room->room_no }} – {{ ucfirst($room->status) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fee">Registration Fee (₹)</label>
                    <input type="number" step="0.01" name="fee" id="fee" class="form-control" value="{{ old('fee', $resident->fee) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" name="joining_date" id="joining_date" class="form-control" value="{{ old('joining_date', $resident->joining_date ? $resident->joining_date->format('Y-m-d') : '') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" {{ old('status', $resident->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $resident->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="2" class="form-control">{{ old('address', $resident->address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 🚀 Advanced Aadhar Image Uploader (Multiple images support) -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="aadhar_image">Update Aadhar Images (Max 2: Front & Back)</label>
                    <div class="upload-container" id="dropzone">
                        <div class="icon-wrapper"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="file-info">
                            <strong>Click to upload new</strong> or drag and drop<br>
                            <small style="color:#94a3b8;">PNG, JPG, JPEG up to 2MB each</small>
                        </div>
                        <!-- Multiple file input with array name -->
                        <input type="file" name="aadhar_images[]" id="aadhar_image" accept="image/png,image/jpeg,image/jpg" multiple>

                        <!-- Preview Container for Front and Back -->
                        <div class="row" id="previewContainer" style="display: none; margin-top: 15px;">
                            <div class="col-md-6">
                                <div class="upload-preview" id="frontPreviewArea" style="display:none;">
                                    <div class="file-details">
                                        <img id="frontPreviewImg" src="" alt="Front Preview" style="max-width:120px; max-height:120px; border-radius:8px; border:1px solid #e2e8f0;">
                                        <div id="frontFileName" style="font-weight:600;font-size:14px;color:#0f172a;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="upload-preview" id="backPreviewArea" style="display:none;">
                                    <div class="file-details">
                                        <img id="backPreviewImg" src="" alt="Back Preview" style="max-width:120px; max-height:120px; border-radius:8px; border:1px solid #e2e8f0;">
                                        <div id="backFileName" style="font-weight:600;font-size:14px;color:#0f172a;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden input to tell backend to remove existing images -->
                    <input type="hidden" name="remove_aadhar" id="remove_aadhar" value="0">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Update Resident</button>
    </form>
</div>

<!-- 🚀 Advanced JS for Drag & Drop Uploader (Multiple images support) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('aadhar_image');
        const previewContainer = document.getElementById('previewContainer');
        const frontPreviewArea = document.getElementById('frontPreviewArea');
        const frontPreviewImg = document.getElementById('frontPreviewImg');
        const frontFileName = document.getElementById('frontFileName');
        const backPreviewArea = document.getElementById('backPreviewArea');
        const backPreviewImg = document.getElementById('backPreviewImg');
        const backFileName = document.getElementById('backFileName');
        const removeHidden = document.getElementById('remove_aadhar');

        // 1. Load existing images (if any) from database (array)
        @if($resident->aadhar_image && is_array($resident->aadhar_image) && count($resident->aadhar_image) > 0)
            @php $images = $resident->aadhar_image; @endphp
            // Front image (index 0)
            @if(isset($images[0]))
                frontPreviewImg.src = "{{ Storage::url($images[0]) }}";
                frontFileName.textContent = "Current Front Image";
                frontPreviewArea.style.display = 'block';
                previewContainer.style.display = 'flex';
            @endif
            // Back image (index 1)
            @if(isset($images[1]))
                backPreviewImg.src = "{{ Storage::url($images[1]) }}";
                backFileName.textContent = "Current Back Image";
                backPreviewArea.style.display = 'block';
                previewContainer.style.display = 'flex';
            @endif
        @endif

        // 2. Click to upload
        dropzone.addEventListener('click', () => fileInput.click());

        // 3. Drag and Drop events
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('dragover');
            }, false);
        });

        dropzone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFiles(files);
            }
        });

        // 4. Handle standard file selection
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                handleFiles(this.files);
            } else {
                // Reset if user cancels selection
                previewContainer.style.display = 'none';
                frontPreviewArea.style.display = 'none';
                backPreviewArea.style.display = 'none';
                frontPreviewImg.src = '';
                backPreviewImg.src = '';
                frontFileName.textContent = '';
                backFileName.textContent = '';
            }
        });

        // 5. Process multiple files (MAX 2)
        function handleFiles(files) {
            if (files.length > 2) {
                alert('You can only upload up to 2 images (Front & Back side of the Aadhar).');
                fileInput.value = ''; // clear invalid selection
                return;
            }

            // Reset previous previews
            previewContainer.style.display = 'none';
            frontPreviewArea.style.display = 'none';
            backPreviewArea.style.display = 'none';
            frontPreviewImg.src = '';
            backPreviewImg.src = '';
            frontFileName.textContent = '';
            backFileName.textContent = '';

            // --- Process Image 1 (Front Side) ---
            if (files[0]) {
                if (!files[0].type.startsWith('image/')) {
                    alert('Front side must be an image file.');
                    fileInput.value = ''; return;
                }
                if (files[0].size > 2 * 1024 * 1024) {
                    alert('Front side image must be less than 2MB.');
                    fileInput.value = ''; return;
                }
                const readerFront = new FileReader();
                readerFront.onload = function(e) {
                    frontPreviewImg.src = e.target.result;
                    frontFileName.textContent = files[0].name + " (New)";
                    frontPreviewArea.style.display = 'block';
                    previewContainer.style.display = 'flex';
                    removeHidden.value = '0'; // User selected new file, so do not remove
                }
                readerFront.readAsDataURL(files[0]);
            }

            // --- Process Image 2 (Back Side) ---
            if (files[1]) {
                if (!files[1].type.startsWith('image/')) {
                    alert('Back side must be an image file.');
                    fileInput.value = ''; return;
                }
                if (files[1].size > 2 * 1024 * 1024) {
                    alert('Back side image must be less than 2MB.');
                    fileInput.value = ''; return;
                }
                const readerBack = new FileReader();
                readerBack.onload = function(e) {
                    backPreviewImg.src = e.target.result;
                    backFileName.textContent = files[1].name + " (New)";
                    backPreviewArea.style.display = 'block';
                    previewContainer.style.display = 'flex';
                    removeHidden.value = '0'; // User selected new file, so do not remove
                }
                readerBack.readAsDataURL(files[1]);
            }
        }
    });
</script>
@endsection