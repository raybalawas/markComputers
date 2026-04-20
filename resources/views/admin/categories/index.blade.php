@extends('admin.layouts.app')

@section('content')
    <style>
        .category-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
            padding: 24px;
            overflow: hidden;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .category-title {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            padding: 10px 18px;
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
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        .custom-table thead {
            background: #0f172a;
            color: white;
        }

        .custom-table th,
        .custom-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .custom-table tbody tr {
            transition: 0.2s;
        }

        .custom-table tbody tr:hover {
            background: #f8fafc;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .empty-row {
            text-align: center;
            color: #64748b;
            font-weight: 600;
            padding: 24px 0;
        }

        @media (max-width: 768px) {
            .category-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-title {
                font-size: 22px;
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

    <div class="category-card">
        <div class="category-header">
            <h3 class="category-title">Course Categories</h3>
            <a href="{{ route('superadmin.categories.create') }}" class="btn-primary">
                + Add Category
            </a>
        </div>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Course Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form action="{{ route('superadmin.categories.status', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" style="border:none; cursor:pointer;"
                                        class="{{ $category->status == 1 ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('superadmin.categories.edit', $category->id) }}"
                                        class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('superadmin.categories.destroy', $category->id) }}"
                                        method="POST" style="display:inline-block;"
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
                            <td colspan="4" class="empty-row">
                                No categories found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
