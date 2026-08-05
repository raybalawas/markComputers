@extends('admin.layouts.app')

@section('title', 'Student Details')

@section('content')
<style>
    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
        margin: 20px;
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

    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-label {
        font-weight: 600;
        width: 160px;
        /* Slightly widened for better visual balance */
        color: #0f172a;
        flex-shrink: 0;
    }

    .detail-value {
        color: #334155;
        flex-grow: 1;
    }

    .badge-available {
        background: #dcfce7;
        color: #166534;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-occupied {
        background: #fef3c7;
        color: #92400e;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-reserved {
        background: #e0e7ff;
        color: #3730a3;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
        display: inline-block;
    }

    @media (max-width: 576px) {
        .detail-row {
            flex-direction: column;
            gap: 6px;
        }

        .detail-label {
            width: 100%;
        }
    }
</style>

<div class="container py-4">
    <div class="detail-card">
        <div class="detail-header">
            <h3 class="detail-title">Student Details</h3>
            <div>
                <a href="{{ route('superadmin.library-students.edit', $student->id) }}" class="btn-submit">✎ Edit</a>
                <a href="{{ route('superadmin.library-students.index') }}" class="btn-secondary">← Back</a>
            </div>
        </div>

        <!-- Info Rows -->
        <div class="detail-row">
            <div class="detail-label">Member Code</div>
            <div class="detail-value">{{ $student->member_code }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Name</div>
            <div class="detail-value">{{ $student->name }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Phone</div>
            <div class="detail-value">{{ $student->phone }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $student->email ?? 'N/A' }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Address</div>
            <div class="detail-value">{{ $student->address ?? 'N/A' }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Assigned Seat</div>
            <div class="detail-value">
                @if($student->seat)
                @php $seatStatus = $student->status; @endphp
                <span class="{{ $seatStatus == 'available' ? 'badge-available' : ($seatStatus == 'occupied' ? 'badge-occupied' : 'badge-reserved') }}">
                    #{{ $student->seat }} – {{ ucfirst($seatStatus) }}
                </span>
                @else
                <span class="text-muted">No seat assigned</span>
                @endif
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Registration Fee</div>
            <div class="detail-value">₹{{ number_format($student->fee, 2) }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Membership Date</div>
            <div class="detail-value">{{ optional($student->membership_date)->format('d-m-Y') ?? 'N/A' }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="badge bg-{{ $student->status == 'active' ? 'success' : 'danger' }} px-3 py-2 rounded-pill text-white">
                    {{ ucfirst($student->status) }}
                </span>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Created At</div>
            <div class="detail-value">{{ $student->created_at->format('d-m-Y H:i') }}</div>
        </div>

    </div>
</div>
@endsection