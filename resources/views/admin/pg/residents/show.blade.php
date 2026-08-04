@extends('admin.layouts.app')

@section('title', 'Resident Details')

@section('content')
<style>
    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
        margin: 20px auto;
        max-width: 1000px;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .detail-title {
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .btn-submit {
        background: #2563eb;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        color: #fff;
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
        color: #fff;
    }

    /* --- MODERN PROFILE HEADER --- */
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 16px 0 24px 0;
        border-bottom: 2px solid #f1f5f9;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .avatar-placeholder {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .profile-info h2 {
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
    }

    .profile-info .resident-code {
        font-size: 14px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* --- MODERN DETAIL GRID --- */
    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #2563eb;
    }

    .detail-item {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        width: 130px;
        color: #475569;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-value {
        color: #0f172a;
        flex-grow: 1;
        word-break: break-word;
    }

    /* --- BADGES --- */
    .badge-available {
        background: #dcfce7;
        color: #166534;
        padding: 4px 12px;
        border-radius: 999px;
        font-weight: 600;
        display: inline-block;
        font-size: 13px;
    }

    .badge-occupied {
        background: #fef3c7;
        color: #92400e;
        padding: 4px 12px;
        border-radius: 999px;
        font-weight: 600;
        display: inline-block;
        font-size: 13px;
    }

    .badge-reserved {
        background: #e0e7ff;
        color: #3730a3;
        padding: 4px 12px;
        border-radius: 999px;
        font-weight: 600;
        display: inline-block;
        font-size: 13px;
    }

    /* --- IMAGE --- */
    .aadhar-preview {
        max-width: 140px;
        max-height: 140px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 4px;
        background: #f8fafc;
        object-fit: cover;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .avatar-placeholder {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .detail-item {
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            width: 100%;
        }

        .detail-card {
            padding: 16px;
            margin: 10px;
        }

        .aadhar-preview {
            max-width: 100px;
            max-height: 100px;
        }
    }
</style>

<div class="container py-4">
    <div class="detail-card">
        <!-- Header: Title & Action Buttons -->
        <div class="detail-header">
            <h3 class="detail-title"><i class="fas fa-id-card me-2" style="color:#2563eb;"></i> Resident Profile</h3>
            <div>
                <a href="{{ route('superadmin.pg-residents.edit', $resident->id) }}" class="btn-submit"><i class="fas fa-edit me-1"></i> Edit</a>
                <a href="{{ route('superadmin.pg-residents.index') }}" class="btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
            </div>
        </div>

        <!-- Modern Profile Header Area -->
        <div class="profile-header">
            <div class="avatar-placeholder">
                {{ substr($resident->name, 0, 1) }}
            </div>
            <div class="profile-info">
                <h2>{{ $resident->name }}</h2>
                <div class="resident-code">
                    <i class="fas fa-barcode"></i> <strong>Resident Code:</strong> {{ $resident->resident_code }}
                    <span class="badge bg-{{ $resident->status == 'active' ? 'success' : 'danger' }} px-3 py-1 rounded-pill text-white ms-2" style="font-size: 12px;">
                        {{ ucfirst($resident->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Structured 2-Column Data Grid -->
        <div class="row">
            <!-- COLUMN 1: Personal Details -->
            <div class="col-md-6">
                <div class="section-title">
                    <i class="fas fa-user-circle"></i> Personal Information
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-phone text-secondary" style="width:20px;"></i> Phone</span>
                    <span class="detail-value">{{ $resident->phone }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-envelope text-secondary" style="width:20px;"></i> Email</span>
                    <span class="detail-value">{{ $resident->email ?? 'N/A' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-id-card text-secondary" style="width:20px;"></i> Aadhar</span>
                    <span class="detail-value">{{ $resident->aadhar ?? 'N/A' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-map-marker-alt text-secondary" style="width:20px;"></i> Address</span>
                    <span class="detail-value">{{ $resident->address ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- COLUMN 2: Accommodation & Fees -->
            <div class="col-md-6">
                <div class="section-title">
                    <i class="fas fa-bed"></i> Accommodation & Fee
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-door-open text-secondary" style="width:20px;"></i> Assigned Room</span>
                    <span class="detail-value">
                        @if($resident->room)
                        @php $roomStatus = $resident->room->status; @endphp
                        <span class="{{ $roomStatus == 'available' ? 'badge-available' : ($roomStatus == 'occupied' ? 'badge-occupied' : 'badge-reserved') }}">
                            #{{ $resident->room->room_no }} – {{ ucfirst($roomStatus) }}
                        </span>
                        @else
                        <span class="text-muted">No Room assigned</span>
                        @endif
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-indian-rupee-sign text-secondary" style="width:20px;"></i> Fee</span>
                    <span class="detail-value">₹{{ number_format($resident->fee, 2) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-calendar-alt text-secondary" style="width:20px;"></i> Joining Date</span>
                    <span class="detail-value">{{ optional($resident->joining_date)->format('d-m-Y') ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- FULL WIDTH: Aadhar Image & System Info -->
            <div class="col-12 mt-4">
                <div class="section-title">
                    <i class="fas fa-image"></i> Documents & History
                </div>
                <div class="row align-items-center">
                    <div class="row align-items-center">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="detail-item" style="border:none;">
                                    <span class="detail-label"><i class="fas fa-id-card text-secondary" style="width:20px;"></i> Aadhar Images</span>
                                    <span class="detail-value d-flex gap-3 flex-wrap">
                                        @if(is_array($resident->aadhar_image) && count($resident->aadhar_image) > 0)
                                        @foreach($resident->aadhar_image as $index => $path)
                                        <div style="display:flex; flex-direction:column; align-items:center;">
                                            <small class="text-muted d-block mb-1" style="font-size:12px;">
                                                @if($index == 0) Front Side @elseif($index == 1) Back Side @endif
                                            </small>
                                            <img src="{{ Storage::url($path) }}"
                                                alt="Aadhar Image"
                                                class="aadhar-preview"
                                                style="max-width:100px; max-height:100px; border-radius:8px; border:1px solid #e2e8f0;">
                                        </div>
                                        @endforeach
                                        @else
                                        <span class="text-muted">No images uploaded</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item" style="border:none;">
                                    <span class="detail-label"><i class="fas fa-clock text-secondary" style="width:20px;"></i> Created At</span>
                                    <span class="detail-value">{{ $resident->created_at->format('d-m-Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection