@extends('admin.layouts.app')

@section('content')
<style>
    .student-table-card {
        width: 100%;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
        overflow: hidden;
    }

    .student-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .student-table-title {
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

    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .search-form .form-control {
        flex: 1;
        min-width: 200px;
        padding: 8px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
    }

    .search-form .btn-search {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .search-form .btn-search:hover {
        background: #1d4ed8;
    }

    .search-form .btn-clear {
        background: #6b7280;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
    }

    .search-form .btn-clear:hover {
        background: #4b5563;
    }

    .table-wrapper {
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .student-table thead {
        background: #0f172a;
    }

    .student-table thead th {
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 14px;
        text-align: left;
        white-space: nowrap;
    }

    .student-table tbody td {
        padding: 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
    }

    .student-table tbody tr:hover {
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
        .student-table-title {
            font-size: 22px;
        }

        .student-table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-form {
            flex-direction: column;
        }

        .search-form .form-control {
            min-width: unset;
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
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #2563eb;
    }

    .btn-view {
        background: #16a34a;
    }

    .btn-delete {
        background: #dc2626;
    }

    .badge-pending {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-pending i {
        font-size: 12px;
    }

    .btn-slip {
        background: #10b981;
        /* Modern Emerald/Green */
        color: #fff;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .btn-slip:hover {
        background: #059669;
        color: #fff;
    }

    .btn-slip i {
        font-size: 12px;
    }

    /* ✅ NEW: Stylish Slip Button */
    .btn-slip {
        background: #10b981;
        /* Modern Emerald Green */
        color: #fff;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-slip:hover {
        background: #059669;
        color: #fff;
    }

    /* ✅ NEW: Simple Pending Badge */
    .badge-pending {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="student-table-card">
    <div class="student-table-header">
        <h3 class="student-table-title">Library Students</h3>
        <a href="{{ route('superadmin.library-students.create') }}" class="btn-primary">
            + Add New Student
        </a>
    </div>

    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('superadmin.library-students.index') }}" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search by name, member code, phone, email..." value="{{ request('search') }}">
        <button type="submit" class="btn-search">Search</button>
        @if(request('search'))
        <a href="{{ route('superadmin.library-students.index') }}" class="btn-clear">Clear</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="student-table">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Member Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Fee</th>
                    <th>Seat</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->member_code }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        {{-- $student->email??'N/A' --}}

                        @if(!is_null($student->fee) && $student->fee !== '')
                        <a href="{{ route('superadmin.library-students.feeSlip', $student->id) }}" class="btn-slip">
                            <i class="fas fa-file-invoice"></i> Fee Slip
                        </a>
                        @else
                        <span class="badge-pending">
                            <i class="fas fa-hourglass-half"></i> Pending
                        </span>
                        @endif
                    </td>
                    <td>{{ $student->seat ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('superadmin.library-students.status', $student->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" style="border:none; cursor:pointer;"
                                class="{{ $student->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($student->status) }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('superadmin.library-students.show', $student->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('superadmin.library-students.edit', $student->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('superadmin.library-students.destroy', $student->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this student?');">
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
                    <td colspan="8" class="empty-row">
                        No students found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="mt-3">
        {{ $students->links() }}
    </div>
</div>
@endsection