@extends('admin.layouts.app')

@section('content')
    <style>
        .category-form-card {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
            padding: 28px;
        }

        .category-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .category-form-title {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #64748b;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }

        .error-list {
            margin: 0;
            padding-left: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label,
        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0 14px;
            font-size: 15px;
            outline: none;
            background: #fff;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .submit-btn-wrap {
            margin-top: 24px;
        }

        @media (max-width: 768px) {
            .category-form-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-form-title {
                font-size: 22px;
            }
        }
    </style>

    <div class="category-form-card">
        <div class="category-form-header">
            <h3 class="category-form-title">Add Category</h3>
            <a href="{{ route('superadmin.categories.index') }}" class="btn-secondary">Back</a>
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

        <form action="{{ route('superadmin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">

            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="submit-btn-wrap">
                <button type="submit" class="btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
