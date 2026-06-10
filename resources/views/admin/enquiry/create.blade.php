@extends('admin.layouts.app')

@section('content')
<style>
    .enquiry-card {
        width: 100%;
        background: #fff;
        border-radius: 14px;
        padding: 24px 28px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    }

    .enquiry-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 22px;
    }

    .enquiry-title-wrap {
        flex: 1;
    }

    .enquiry-title {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
        display: inline-block;
        border-bottom: 2px solid #9ca3af;
        padding-bottom: 4px;
        margin-bottom: 18px;
    }

    .top-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        max-width: 100%;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .photo-box {
        width: 150px;
        height: 180px;
        border: 2px dashed #9ca3af;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #374151;
        font-weight: 700;
        font-size: 14px;
        background: #fafafa;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-box span {
        letter-spacing: 1px;
    }

    .enquiry-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px 18px;
    }

    .full-col {
        grid-column: 1 / -1;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 7px;
        color: #111827;
    }

    .form-control {
        width: 100%;
        height: 46px;
        border: 1px solid #9ca3af;
        border-radius: 4px;
        padding: 0 12px;
        font-size: 15px;
        background: #fff;
        outline: none;
    }

    textarea.form-control {
        height: auto;
        padding: 10px 12px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.10);
    }

    .file-control {
        height: auto;
        padding: 10px 12px;
    }

    .enquiry-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .btn {
        display: inline-block;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #64748b;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        padding: 14px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        border: 1px solid #fecaca;
    }

    .error-list {
        margin: 8px 0 0 18px;
    }

    .bottom-submit {
        margin-top: 18px;
    }

    .checkbox-group {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .checkbox-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: normal;
        cursor: pointer;
    }

    .checkbox-group input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .signature-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 991px) {
        .enquiry-header {
            flex-direction: column;
        }

        .top-info-grid {
            grid-template-columns: 1fr;
            max-width: 100%;
        }

        .photo-box {
            width: 130px;
            height: 160px;
        }

        .enquiry-grid {
            grid-template-columns: 1fr;
        }

        .full-col {
            grid-column: auto;
        }

        .enquiry-actions {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .signature-section {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="enquiry-card">
    <div class="enquiry-actions">
        <h3 style="font-size: 24px; margin: 0; color: #111827;">Admission Form</h3>
        <a href="{{ route('superadmin.enquiry.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
    <div class="alert-danger">
        <ul class="error-list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('superadmin.enquiry.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="enquiry-header">
            <div class="enquiry-title-wrap">
                <div class="top-info-grid">
                    <div class="form-group">
                        <label>Name of Student</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Enter student name" required>
                    </div>

                    <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}"
                            placeholder="Enter father's name">
                    </div>

                    <div class="form-group">
                        <label>Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}"
                            placeholder="Enter mother's name">
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="" disabled selected>Select Category</option>
                            <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                            <option value="OBC" {{ old('category') == 'OBC' ? 'selected' : '' }}>OBC</option>
                            <option value="SC" {{ old('category') == 'SC' ? 'selected' : '' }}>SC</option>
                            <option value="ST" {{ old('category') == 'ST' ? 'selected' : '' }}>ST</option>
                            <!-- <option value="DBC" {{ old('category') == 'DBC' ? 'selected' : '' }}>DBC</option> -->
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label>Gender & Marital Status</label>
                        <div class="checkbox-group">
                            <label><input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}> Male</label>
                            <label><input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}> Female</label>
                            <label><input type="radio" name="marital_status" value="Married" {{ old('marital_status') == 'Married' ? 'checked' : '' }}> Married</label>
                            <label><input type="radio" name="marital_status" value="Single" {{ old('marital_status') == 'Single' ? 'checked' : '' }}> Single</label>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Enter complete address">{{ old('address') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}"
                            placeholder="Enter mobile number" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label>Aadhar No.</label>
                        <input type="text" name="aadhar_number" class="form-control" value="{{ old('aadhar_number') }}"
                            placeholder="Enter Aadhar number">
                    </div>

                    <div class="form-group">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}"
                            placeholder="e.g., 12th, Graduate">
                    </div>

                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" name="pin_code" class="form-control" value="{{ old('pin_code') }}"
                            placeholder="Enter pin code">
                    </div>
                </div>
            </div>

            <div>
                <div class="photo-box" id="imagePreviewBox">
                    <span>PHOTO</span>
                </div>
            </div>
        </div>

        <div class="enquiry-grid">
            <div class="form-group">
                <label>Course Name</label>
                <select name="course_name" class="form-control" required>
                    <option value="" disabled selected>Select a Course</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->course_name }}"
                        {{ old('course_name') == $course->course_name ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Batch Start Time</label>
                <input type="time" name="batch_start_time" class="form-control"
                    value="{{ old('batch_start_time', $enquiry->batch_start_time ?? '') }}">
            </div>

            <div class="form-group">
                <label>Batch End Time</label>
                <input type="time" name="batch_end_time" class="form-control"
                    value="{{ old('batch_end_time', $enquiry->batch_end_time ?? '') }}">
            </div>

            <div class="form-group">
                <label>Admission Date</label>
                <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date', date('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label>Total Fees (₹)</label>
                <input type="number" step="0.01" name="total_fees" id="total_fees" class="form-control"
                    value="{{ old('total_fees') }}" placeholder="Enter total fee">
            </div>

            <div class="form-group">
                <label>Deposit Fees (₹)</label>
                <input type="number" step="0.01" name="due_fees" id="due_fees" class="form-control"
                    value="{{ old('due_fees') }}" placeholder="Enter deposit fee">
            </div>

            <div class="form-group">
                <label>Remaining Fee (₹)</label>
                <input type="number" step="0.01" name="revenue_fees" id="revenue_fees" class="form-control"
                    value="{{ old('revenue_fees') }}" placeholder="Auto calculated" readonly>
            </div>

            <div class="form-group">
                <label>Book Issue Status</label>
                <select name="book_issue" class="form-control">
                    <option value="Pending" selected>Pending</option>
                    <option value="Issued">Issued</option>
                    <option value="Returned">Returned</option>
                </select>
            </div>

            <div class="form-group">
                <label>Student Image</label>
                @if (!empty($enquiry->image))
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}" alt="Student Image"
                        style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                </div>
                @endif
                <input type="file" name="image" id="imageInput" class="form-control file-control" accept="image/*">
            </div>

            <div class="form-group full-col">
                <label>Documents (Multiple files allowed)</label>
                @php
                $docs = is_array($enquiry->docs ?? null)
                ? $enquiry->docs
                : json_decode($enquiry->docs ?? '[]', true);
                @endphp
                @if (!empty($docs))
                <div style="margin-bottom:10px; display:flex; gap:10px; flex-wrap:wrap;">
                    @foreach ($docs as $doc)
                    <a href="{{ asset('uploads/enquiry/docs/' . $doc) }}" target="_blank"
                        style="padding:8px 12px; background:#f1f5f9; border-radius:6px; text-decoration:none;">
                        📄 {{ $doc }}
                    </a>
                    @endforeach
                </div>
                @endif
                <input type="file" name="docs[]" class="form-control file-control" multiple>
            </div>
        </div>

        <!-- Signature Section (Optional - kept but can be skipped if not needed) -->
        <!-- <div class="signature-section">
            <div class="form-group">
                <label>Parents/Guardian Signature</label>
                <input type="file" name="parent_signature" class="form-control file-control" accept="image/*">
                <small class="text-muted" style="font-size: 12px; color: #6b7280;">(Upload signature image if available)</small>
            </div>

            <div class="form-group">
                <label>Center Head Signature</label>
                <input type="file" name="center_head_signature" class="form-control file-control" accept="image/*">
                <small class="text-muted" style="font-size: 12px; color: #6b7280;">(Upload signature image if available)</small>
            </div>
        </div> -->

        <div class="bottom-submit" style="display:flex; gap:12px; flex-wrap:wrap;">
            <button type="submit" name="action" value="save" class="btn btn-primary">
                Save Enquiry
            </button>
            <!-- Save & Download I-Card button is commented as per your request -->
        </div>
    </form>
</div>

<script>
    const totalFees = document.getElementById('total_fees');
    const dueFees = document.getElementById('due_fees');
    const revenueFees = document.getElementById('revenue_fees');
    const imageInput = document.getElementById('imageInput');
    const imagePreviewBox = document.getElementById('imagePreviewBox');

    function calculateRevenueFees() {
        let total = parseFloat(totalFees.value) || 0;
        let due = parseFloat(dueFees.value) || 0;
        let revenue = total - due;

        if (revenue < 0) {
            revenue = 0;
        }

        revenueFees.value = revenue.toFixed(2);
    }

    if (totalFees && dueFees) {
        totalFees.addEventListener('input', calculateRevenueFees);
        dueFees.addEventListener('input', calculateRevenueFees);
        calculateRevenueFees();
    }

    if (imageInput && imagePreviewBox) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) {
                imagePreviewBox.innerHTML = '<span>PHOTO</span>';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreviewBox.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        });
    }
</script>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const files = document.querySelector('input[type="file"][multiple]').files;
        let totalSize = 0;

        for (let i = 0; i < files.length; i++) {
            totalSize += files[i].size;
        }

        const maxSize = 500 * 1024 * 1024; // 200MB
        const maxSizeMB = 500;

        if (totalSize > maxSize) {
            e.preventDefault();
            alert(`Total file size (${(totalSize / 1024 / 1024).toFixed(2)}MB) exceeds maximum allowed size (${maxSizeMB}MB). Please reduce file sizes.`);
            return false;
        }

        // Check individual file size (max 20MB each)
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > 20 * 1024 * 1024) {
                e.preventDefault();
                alert(`File "${files[i].name}" is larger than 20MB. Please compress or split the file.`);
                return false;
            }
        }
    });
</script>
@endsection