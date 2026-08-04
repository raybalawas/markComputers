@extends('admin.layouts.app')
@section('content')
<style>
    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
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

    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-label {
        font-weight: 600;
        width: 150px;
        color: #0f172a;
    }

    .detail-value {
        color: #334155;
    }

    .badge-available {
        background: #dcfce7;
        color: #166534;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
    }

    .badge-occupied {
        background: #fef3c7;
        color: #92400e;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
    }

    .badge-maintenance {
        background: #e0e7ff;
        color: #3730a3;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
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
</style>

<div class="detail-card">
    <div class="detail-header">
        <h3 class="detail-title">Room Details</h3>
        <div>
            <a href="{{ route('superadmin.pg-rooms.edit', $room->id) }}" class="btn-submit">✎ Edit</a>
            <a href="{{ route('superadmin.pg-rooms.index') }}" class="btn-secondary">← Back</a>
        </div>
    </div>
    <div class="detail-row"><span class="detail-label">Room Number</span><span class="detail-value">#{{ $room->room_no }}</span></div>
    <div class="detail-row"><span class="detail-label">Room Type</span><span class="detail-value">{{ ucfirst($room->room_type) }}</span></div>
    <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value"><span class="badge-{{ $room->status }}">{{ ucfirst($room->status) }}</span></span></div>
    <div class="detail-row"><span class="detail-label">Assigned Resident</span><span class="detail-value">@if($room->resident){{ $room->resident->name }} ({{ $room->resident->resident_code }})@else Not Assigned @endif</span></div>
    <div class="detail-row"><span class="detail-label">Created At</span><span class="detail-value">{{ $room->created_at->format('d-m-Y H:i') }}</span></div>
    <div class="detail-row"><span class="detail-label">Updated At</span><span class="detail-value">{{ $room->updated_at->format('d-m-Y H:i') }}</span></div>
</div>
@endsection