@extends('admin.layouts.app')

@section('content')
<style>
    .course-form-wrapper {
        max-width: 760px;
        margin: 20px auto;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
        padding: 32px;
        border: 1px solid #e2e8f0;
    }

    .course-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .course-form-title {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .course-form-subtitle {
        font-size: 14px;
        color: #64748b;
        margin-top: 4px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #fff;
        padding: 12px 22px;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.28);
    }

    .btn-secondary {
        background: #64748b;
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 22px;
        border: 1px solid #fecaca;
    }

    .error-list {
        margin: 0;
        padding-left: 18px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        height: 50px;
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
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .submit-btn-wrap {
        margin-top: 28px;
    }

    .btn-full {
        width: 100%;
        height: 50px;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .course-form-wrapper {
            padding: 22px;
            margin: 10px;
        }

        .course-form-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .course-form-title {
            font-size: 24px;
        }
    }
</style>

<div class="course-form-wrapper">
    <div class="course-form-header">
        <div>
            <h3 class="course-form-title">Update Course</h3>
            <p class="course-form-subtitle">
                Update course category, name and status details
            </p>
        </div>

        <a href="{{ route('superadmin.courses.index') }}" class="btn-secondary">
            ← Back
        </a>
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

    <form action="{{ route('superadmin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Course Name</label>
            <input type="text"
                   name="course_name"
                   class="form-control"
                   value="{{ old('course_name', $course->course_name) }}"
                   placeholder="Enter course name"
                   required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="1"
                    {{ old('status', $course->status) == '1' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="0"
                    {{ old('status', $course->status) == '0' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <div class="submit-btn-wrap">
            <button type="submit" class="btn-primary btn-full">
                Update Course
            </button>
        </div>
    </form>
</div>
@endsection