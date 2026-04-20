@extends('admin.layouts.app')
@section('content')
    <style>
        .enquiry-page-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        .header-right {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            display: flex;
            gap: 10px;
        }

        .search-input {
            width: 260px;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }

        .search-btn {
            background: #0f172a;
            color: white;
            border: none;
            padding: 11px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-add {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .custom-table thead {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: white;
        }

        .custom-table th,
        .custom-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .custom-table tbody tr:hover {
            background: #f8fafc;
        }

        .student-image {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #dbeafe;
        }

        .fee-badge {
            background: #fee2e2;
            color: #b91c1c;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
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

        .empty-row {
            text-align: center;
            padding: 30px;
            color: #64748b;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .pagination-wrapper {
            margin-top: 22px;
            display: flex;
            justify-content: center;
        }

        @media(max-width:768px) {
            .search-input {
                width: 100%;
            }

            .header-right {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .pagination-wrapper .page-item {
            display: inline-block;
        }

        .pagination-wrapper .page-link,
        .pagination-wrapper .page-item span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1px solid #dbeafe;
            background: #ffffff;
            color: #1e293b;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .pagination-wrapper .active span {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .pagination-wrapper .disabled span {
            background: #f8fafc;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }
    </style>

    <div class="enquiry-page-card">
        <div class="header-right">
            <a href="{{ route('superadmin.enquiry.create') }}" class="btn-add">
                + Add Enquiry
            </a>
        </div>
        <div class="page-header">
            <h3 class="page-title">Student Enquiries</h3>

            <div class="header-right">
                <form method="GET" class="search-box">
                    <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                        placeholder="Search by name, phone, course">
                    <button type="submit" class="search-btn">
                        Search
                    </button>
                </form>


            </div>
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
                        <th>S.No</th>
                        <th>Student</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Remaining Fee</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiries->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $enquiry->name }}</strong></td>
                            <td>{{ $enquiry->phone_number }}</td>
                            <td>{{ $enquiry->course_name ?? '-' }}</td>
                            <td>
                                <span class="fee-badge">₹{{ $enquiry->revenue_fees }}</span>
                            </td>
                            <td>
                                @if ($enquiry->image)
                                    <img src="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}" alt="Student"
                                        class="student-image">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('superadmin.enquiry.edit', $enquiry->id) }}"
                                        class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('superadmin.enquiry.show', $enquiry->id) }}"
                                        class="btn-action btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <form action="{{ route('superadmin.enquiry.destroy', $enquiry->id) }}" method="POST"
                                        style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
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
                            <td colspan="7" class="empty-row">
                                No student enquiries found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $enquiries->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
