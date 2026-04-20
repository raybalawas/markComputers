@extends('admin.layouts.app')

@section('content')
    <style>
        .course-table-card {
            width: 100%;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
            padding: 24px;
            overflow: hidden;
        }

        .course-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .course-table-title {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #bbf7d0;
        }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .course-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .course-table thead {
            background: #0f172a;
        }

        .course-table thead th {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 14px;
            text-align: left;
            white-space: nowrap;
        }

        .course-table tbody td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            font-size: 14px;
            vertical-align: middle;
        }

        .course-table tbody tr:hover {
            background: #f8fafc;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .empty-row {
            text-align: center;
            padding: 22px !important;
            color: #64748b;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .course-table-title {
                font-size: 22px;
            }

            .course-table-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .btn-edit {
            background: #2563eb;
        }

        .btn-view {
            background: #16a34a;
        }

        .btn-delete {
            background: #dc2626;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="course-table-card">
        <div class="course-table-header">
            <h3 class="course-table-title">Courses</h3>
            <a href="{{ route('superadmin.courses.create') }}" class="btn-primary">
                + Add Course
            </a>
        </div>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table class="course-table">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Category Name</th>
                        <th>Course Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->category->name ?? '-' }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>
                                <form action="{{ route('superadmin.courses.status', $course->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" style="border:none; cursor:pointer;"
                                        class="{{ $course->status == 1 ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $course->status == 1 ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('superadmin.courses.edit', $course->id) }}"
                                        class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('superadmin.courses.destroy', $course->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">
                                No courses found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
