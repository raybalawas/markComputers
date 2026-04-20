@extends('admin.layouts.app')

@section('content')
    <style>
        .enquiry-card {
            width: 100%;
            max-width: 1100px;
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
        }

        .btn-primary:hover {
            background: #1d4ed8;
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

        @media (max-width: 768px) {
            .enquiry-header {
                flex-direction: column;
            }

            .enquiry-grid,
            .fee-row {
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
            <h2 class="page-title">Student Enquiry Details</h2>

            <a href="{{ route('superadmin.enquiry.idcard', $enquiry->id) }}" class="btn-primary">
                Generate I-Card
            </a>
        </div>

        <div class="enquiry-header">
            <div style="flex:1;">
                <div class="enquiry-grid">
                    <div class="form-group">
                        <label>Name</label>
                        <div class="form-box">{{ $enquiry->name }}</div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="form-box">{{ $enquiry->email ?? 'N/A' }}</div>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <div class="form-box">{{ $enquiry->phone_number }}</div>
                    </div>

                    <div class="form-group">
                        <label>Course Name</label>
                        <div class="form-box">{{ $enquiry->course_name }}</div>
                    </div>

                    <div class="form-group">
                        <label>Batch Start Time</label>
                        <div class="form-box">
                            {{ $enquiry->batch_start_time ? \Carbon\Carbon::parse($enquiry->batch_start_time)->format('h:i A') : 'N/A' }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Batch End Time</label>
                        <div class="form-box">
                            {{ $enquiry->batch_end_time ? \Carbon\Carbon::parse($enquiry->batch_end_time)->format('h:i A') : 'N/A' }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Admission Date</label>
                        <div class="form-box">{{ $enquiry->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="photo-box">
                @if ($enquiry->image)
                    <img src="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}">
                @else
                    <img src="https://via.placeholder.com/150x180?text=Photo">
                @endif
            </div>
        </div>

        <div class="fee-row">
            <div class="fee-box total">
                Total Fee <br><br> ₹{{ $enquiry->total_fees }}
            </div>

            <div class="fee-box deposit">
                Deposit Fee <br><br> ₹{{ $enquiry->due_fees }}
            </div>

            <div class="fee-box remaining">
                Remaining Fee <br><br> ₹{{ $enquiry->revenue_fees }}
            </div>
        </div>

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

    </div>
@endsection
