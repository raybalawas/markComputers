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
    }

    .upload-preview .file-details {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 1 1 100%;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
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
        <h3 class="form-title">Add PG Resident</h3>
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

    <form action="{{ route('superadmin.pg-residents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. John Doe" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="e.g. 9876543210" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="e.g. johndoe@email.com">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="aadhar">Aadhar Number</label>
                    <input type="text" name="aadhar" id="aadhar" class="form-control" value="{{ old('aadhar') }}" placeholder="e.g. 1234 5678 9012">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="room_id">Assign Room</label>
                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">-- No room assigned --</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            #{{ $room->room_no }} – {{ ucfirst($room->room_type) }} ({{ ucfirst($room->status) }})
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fee">Registration Fee (₹)</label>
                    <input type="number" step="0.01" name="fee" id="fee" class="form-control" value="{{ old('fee') }}" placeholder="e.g. 5000">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" name="joining_date" id="joining_date" class="form-control" value="{{ old('joining_date', date('Y-m-d')) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Residential Address</label>
                    <textarea name="address" id="address" rows="2" class="form-control" placeholder="Enter full address...">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>

        <!-- 🚀 Advanced Aadhar Image Uploader -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="aadhar_image">Upload Aadhar Image (Optional)</label>
                    <div class="upload-container" id="dropzone">
                        <div class="icon-wrapper"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="file-info">
                            <strong>Click to upload</strong> or drag and drop<br>
                            <small style="color:#94a3b8;">PNG, JPG, JPEG up to 2MB</small>
                        </div>
                        <input type="file" name="aadhar_images[]" id="aadhar_image" accept="image/png,image/jpeg,image/jpg" multiple>

                        <!-- Preview Container -->
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
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Save Resident</button>
    </form>
</div>

<!-- 🚀 UPDATED JS to Handle Multiple Images (Limit 2) -->
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

        // 1. Click to upload
        dropzone.addEventListener('click', () => fileInput.click());

        // 2. Drag and Drop events
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

        // 3. Handle standard file selection
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

        // 4. Process multiple files
        function handleFiles(files) {
            // MAX LIMIT: 2 images (Front & Back)
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
                    frontFileName.textContent = files[0].name;
                    frontPreviewArea.style.display = 'block';
                    previewContainer.style.display = 'flex';
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
                    backFileName.textContent = files[1].name;
                    backPreviewArea.style.display = 'block';
                    previewContainer.style.display = 'flex';
                }
                readerBack.readAsDataURL(files[1]);
            }
        }
    });
</script>
@endsection