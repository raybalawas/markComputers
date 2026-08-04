@extends('admin.layouts.app')
@section('content')
<style>
    .form-card { background: #ffffff; border-radius: 16px; box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06); padding: 24px; }
    .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; flex-wrap: wrap; gap: 12px; }
    .form-title { font-size: 26px; font-weight: 700; color: #0f172a; margin: 0; }
    .btn-secondary { background: #6b7280; color: #fff; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .btn-secondary:hover { background: #4b5563; }
    .form-group { margin-bottom: 18px; }
    .form-group label { font-weight: 600; display: block; margin-bottom: 6px; color: #0f172a; }
    .form-control { width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; }
    .form-control:focus { border-color: #2563eb; outline: none; box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2); }
    .row { display: flex; flex-wrap: wrap; gap: 20px; }
    .col-md-6 { flex: 1 1 calc(50% - 20px); min-width: 200px; }
    .btn-submit { background: #2563eb; color: #fff; padding: 12px 28px; border: none; border-radius: 8px; font-weight: 600; font-size: 16px; cursor: pointer; transition: 0.3s; }
    .btn-submit:hover { background: #1d4ed8; }
    @media (max-width: 768px) { .col-md-6 { flex: 1 1 100%; } .form-header { flex-direction: column; align-items: flex-start; } }
</style>

<div class="form-card">
    <div class="form-header">
        <h3 class="form-title">Edit Room #{{ $room->room_no }}</h3>
        <a href="{{ route('superadmin.pg-rooms.index') }}" class="btn-secondary">← Back</a>
    </div>
    @if ($errors->any()) <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif

    <form action="{{ route('superadmin.pg-rooms.update', $room->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="room_no">Room Number *</label>
                    <input type="text" name="room_no" id="room_no" class="form-control" value="{{ old('room_no', $room->room_no) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="room_type">Room Type *</label>
                    <select name="room_type" id="room_type" class="form-control" required>
                        <option value="single" {{ old('room_type', $room->room_type) == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="double" {{ old('room_type', $room->room_type) == 'double' ? 'selected' : '' }}>Double</option>
                        <option value="triple" {{ old('room_type', $room->room_type) == 'triple' ? 'selected' : '' }}>Triple</option>
                        <option value="dorm" {{ old('room_type', $room->room_type) == 'dorm' ? 'selected' : '' }}>Dormitory</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="resident_id">Assign to Resident (optional)</label>
                    <select name="resident_id" id="resident_id" class="form-control">
                        <option value="">-- None --</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}" {{ old('resident_id', $room->resident_id) == $resident->id ? 'selected' : '' }}>
                                {{ $resident->name }} ({{ $resident->resident_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Update Room</button>
    </form>
</div>
@endsection