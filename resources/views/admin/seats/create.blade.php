@extends('admin.layouts.app')

@section('content')
    <style>
        .form-card {
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

    <div class="form-card">
        <div class="form-header">
            <h3 class="form-title">Add Library Seat</h3>
            <a href="{{ route('superadmin.seats.index') }}" class="btn-secondary">← Back</a>
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

        <form action="{{ route('superadmin.seats.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="seat_number">Seat Number *</label>
                        <input type="number" name="seat_number" id="seat_number" class="form-control" value="{{ old('seat_number') }}" min="1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="library_student_id">Assign to Student (optional)</label>
                        <select name="library_student_id" id="library_student_id" class="form-control">
                            <option value="">-- None --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('library_student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->member_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Add Seat</button>
        </form>
    </div>
@endsection