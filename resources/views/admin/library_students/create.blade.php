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

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 1 1 100%;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="student-form-card">
    <div class="form-header">
        <h3 class="form-title">Add Library Student</h3>
        <a href="{{ route('superadmin.library-students.index') }}" class="btn-secondary">← Back</a>
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

    <form action="{{ route('superadmin.library-students.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="seat_id">Assign Seat</label>
                    <select name="seat" id="seat_id" class="form-control">
                        <option value="">-- No seat assigned --</option>
                        @foreach($seats as $seat)
                        <option value="{{ $seat->seat_number }}" {{ old('seat') == $seat->seat_number ? 'selected' : '' }}>
                            #{{ $seat->seat_number }} – {{ ucfirst($seat->status) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fee">Registration Fee (₹)</label>
                    <input type="number" step="0.01" name="fee" id="fee" class="form-control" value="{{ old('fee') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="membership_date">Membership Date</label>
                    <input type="date" name="membership_date" id="membership_date" class="form-control" value="{{ old('membership_date', date('Y-m-d')) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="2" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
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

        <button type="submit" class="btn-submit">Save Student</button>
    </form>
</div>
@endsection