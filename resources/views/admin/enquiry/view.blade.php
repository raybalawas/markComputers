@extends('admin.layouts.app')

@section('content')
<style>
    .enquiry-card {
        width: 100%;
        max-width: 1200px;
        margin: auto;
        background: #fff;
        border-radius: 14px;
        padding: 24px 28px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    }

    .page-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #64748b;
        color: #fff;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .enquiry-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 22px;
    }

    .photo-box {
        width: 150px;
        height: 180px;
        border: 2px dashed #9ca3af;
        border-radius: 6px;
        overflow: hidden;
        background: #fafafa;
        flex-shrink: 0;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .enquiry-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 18px;
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

    .form-box {
        width: 100%;
        min-height: 46px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 12px;
        font-size: 15px;
        background: #f9fafb;
        color: #111827;
        font-weight: 500;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-male {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-female {
        background: #fce7f3;
        color: #9d174d;
    }

    .badge-married {
        background: #dcfce7;
        color: #166534;
    }

    .badge-single {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-pending {
        background: #fed7aa;
        color: #9a3412;
    }

    .badge-issued {
        background: #d1fae5;
        color: #065f46;
    }

    .fee-row {
        margin-top: 22px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .fee-box {
        border-radius: 10px;
        padding: 18px;
        color: #fff;
        text-align: center;
        font-weight: 700;
    }

    .fee-box.total {
        background: #2563eb;
    }

    .fee-box.deposit {
        background: #16a34a;
    }

    .fee-box.remaining {
        background: #dc2626;
    }

    .docs-section {
        margin-top: 28px;
    }

    .docs-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #111827;
    }

    .signature-section {
        margin-top: 28px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .signature-box {
        text-align: center;
        padding: 16px;
        background: #f9fafb;
        border-radius: 12px;
    }

    .signature-box h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #374151;
    }

    .signature-img {
        max-width: 200px;
        max-height: 80px;
        margin: 0 auto;
    }

    .signature-img img {
        max-width: 100%;
        max-height: 80px;
    }

    .no-signature {
        color: #9ca3af;
        font-style: italic;
        padding: 20px;
    }

    .doc-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
    }

    .doc-item {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .doc-preview {
        width: 100%;
        height: 140px;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 10px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .doc-preview img,
    .doc-preview iframe {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: none;
    }

    .doc-actions a {
        display: block;
        text-align: center;
        text-decoration: none;
        margin-top: 8px;
        color: #2563eb;
        font-weight: 600;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .enquiry-header {
            flex-direction: column;
        }

        .enquiry-grid,
        .fee-row,
        .signature-section {
            grid-template-columns: 1fr;
        }
    }

    .compact-doc-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 14px;
    }

    .compact-doc-item {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 8px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .compact-preview {
        width: 100%;
        height: 90px;
        border-radius: 6px;
        overflow: hidden;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .compact-preview img,
    .compact-preview iframe {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: none;
    }

    .compact-preview span {
        font-size: 28px;
    }

    .compact-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 8px;
    }

    .compact-actions a {
        text-decoration: none;
        font-size: 18px;
    }
</style>

<div class="enquiry-card">

    <div class="page-top">
        <h2 class="page-title">Admission Form</h2>

        <div class="button-group">
            <a href="{{ route('superadmin.enquiry.index') }}" class="btn-secondary">
                ← Back
            </a>
            <a href="{{ route('superadmin.enquiry.idcard', $enquiry->id) }}" class="btn-primary">
                Generate I-Card
            </a>
        </div>
    </div>

    <div class="enquiry-header">
        <div style="flex:1;">
            <div class="enquiry-grid">
                <!-- Personal Information -->
                <div class="form-group">
                    <label>Name of Student</label>
                    <div class="form-box">{{ $enquiry->name }}</div>
                </div>

                <div class="form-group">
                    <label>Father's Name</label>
                    <div class="form-box">{{ $enquiry->father_name ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Mother's Name</label>
                    <div class="form-box">{{ $enquiry->mother_name ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="form-box">
                        {{ $enquiry->dob ? \Carbon\Carbon::parse($enquiry->dob)->format('d-m-Y') : 'N/A' }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <div class="form-box">{{ $enquiry->category ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Gender & Marital Status</label>
                    <div class="form-box">
                        @if($enquiry->gender)
                        <span class="badge {{ $enquiry->gender == 'Male' ? 'badge-male' : 'badge-female' }}">
                            {{ $enquiry->gender }}
                        </span>
                        @endif
                        @if($enquiry->marital_status)
                        <span class="badge {{ $enquiry->marital_status == 'Married' ? 'badge-married' : 'badge-single' }}">
                            {{ $enquiry->marital_status }}
                        </span>
                        @endif
                        @if(!$enquiry->gender && !$enquiry->marital_status)
                        N/A
                        @endif
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Address</label>
                    <div class="form-box">{{ $enquiry->address ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Mobile No.</label>
                    <div class="form-box">{{ $enquiry->phone_number }}</div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="form-box">{{ $enquiry->email ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Aadhar No.</label>
                    <div class="form-box">{{ $enquiry->aadhar_number ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Qualification</label>
                    <div class="form-box">{{ $enquiry->qualification ?? 'N/A' }}</div>
                </div>

                <div class="form-group">
                    <label>Pin Code</label>
                    <div class="form-box">{{ $enquiry->pin_code ?? 'N/A' }}</div>
                </div>

                <!-- Course Information -->
                <div class="form-group">
                    <label>Course Name</label>
                    <div class="form-box">{{ $enquiry->course_name }}</div>
                </div>

                <div class="form-group">
                    <label>Batch Time</label>
                    <div class="form-box">
                        @if($enquiry->batch_start_time && $enquiry->batch_end_time)
                        {{ \Carbon\Carbon::parse($enquiry->batch_start_time)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($enquiry->batch_end_time)->format('h:i A') }}
                        @else
                        N/A
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Admission Date</label>
                    <div class="form-box">
                        {{ $enquiry->admission_date ? \Carbon\Carbon::parse($enquiry->admission_date)->format('d M Y') : $enquiry->created_at->format('d M Y') }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Book Issue</label>
                    <div class="form-box">
                        <span class="badge {{ $enquiry->book_issue == 'Issued' ? 'badge-issued' : 'badge-pending' }}">
                            {{ $enquiry->book_issue ?? 'Pending' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="photo-box">
            @if ($enquiry->image)
            <img src="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}" alt="Student Photo">
            @else
            <img src="https://via.placeholder.com/150x180?text=No+Photo" alt="No Photo">
            @endif
        </div>
    </div>

    <!-- Fee Details -->
    <div class="fee-row">
        <div class="fee-box total">
            Total Fee <br><br> ₹{{ number_format($enquiry->total_fees, 2) }}
        </div>

        <div class="fee-box deposit">
            Deposit Fee <br><br> ₹{{ number_format($enquiry->due_fees, 2) }}
        </div>

        <div class="fee-box remaining">
            Remaining Fee <br><br> ₹{{ number_format($enquiry->revenue_fees, 2) }}
        </div>
    </div>

    <!-- Documents Section -->
    <div class="docs-section">
        <div class="docs-title">Student Documents</div>

        @php
        $docs = is_array($enquiry->docs) ? $enquiry->docs : json_decode($enquiry->docs, true);
        @endphp

        <div class="doc-list compact-doc-list">
            @if (!empty($docs))
            @foreach ($docs as $doc)
            @php
            $filePath = asset('uploads/enquiry/docs/' . $doc);
            $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
            @endphp

            <div class="doc-item compact-doc-item">
                <div class="doc-preview compact-preview">
                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                    <img src="{{ $filePath }}" alt="Document">
                    @elseif($ext == 'pdf')
                    <iframe src="{{ $filePath }}"></iframe>
                    @else
                    <span>📄</span>
                    @endif
                </div>

                <div class="doc-actions compact-actions">
                    <a href="{{ $filePath }}" target="_blank" title="View">
                        👁️
                    </a>
                    <a href="{{ $filePath }}" download title="Download">
                        ⬇️
                    </a>
                </div>
            </div>
            @endforeach
            @else
            <p>No documents uploaded</p>
            @endif
        </div>
    </div>

    <!-- Signatures Section -->
    <!-- <div class="signature-section">
            <div class="signature-box">
                <h4>Parents/Guardian Signature</h4>
                @if($enquiry->parent_signature)
                    <div class="signature-img">
                        <img src="{{ asset('uploads/enquiry/signatures/' . $enquiry->parent_signature) }}" alt="Parent Signature">
                    </div>
                @else
                    <div class="no-signature">No signature uploaded</div>
                @endif
            </div>

            <div class="signature-box">
                <h4>Center Head Signature</h4>
                @if($enquiry->center_head_signature)
                    <div class="signature-img">
                        <img src="{{ asset('uploads/enquiry/signatures/' . $enquiry->center_head_signature) }}" alt="Center Head Signature">
                    </div>
                @else
                    <div class="no-signature">No signature uploaded</div>
                @endif
            </div>
        </div> -->

</div>
@endsection