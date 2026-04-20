@extends('admin.layouts.app')

@section('content')
    <style>
        .dashboard-wrapper {
            width: 100%;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .dashboard-title h2 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            color: #0f172a;
        }

        .dashboard-title p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 15px;
        }

        .logout-btn {
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .welcome-card {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.18);
            margin-bottom: 28px;
        }

        .welcome-card h3 {
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 700;
        }

        .welcome-card p {
            margin: 0;
            opacity: 0.95;
            font-size: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .stat-card h4 {
            margin: 0;
            font-size: 16px;
            color: #64748b;
            font-weight: 600;
        }

        .stat-card .number {
            margin-top: 14px;
            font-size: 34px;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-card small {
            display: block;
            margin-top: 8px;
            color: #94a3b8;
        }

        @media (max-width: 991px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-title h2 {
                font-size: 24px;
            }

            .welcome-card h3 {
                font-size: 22px;
            }
        }
    </style>

    <div class="dashboard-wrapper">
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h2>Super Admin Dashboard</h2>
                <p>Manage categories, courses, enquiries and full system access</p>
            </div>

            {{-- <form method="POST" action="{{ route('superadmin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form> --}}
        </div>

        <div class="welcome-card">
            <h3>Welcome Super Admin 👋</h3>
            <p>You are logged in successfully. Use sidebar menu to manage the complete system.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h4>Total Categories</h4>
                <div class="number">{{ \App\Models\Category::count() }}</div>
                <small>Available course categories</small>
            </div>

            <div class="stat-card">
                <h4>Total Courses</h4>
                <div class="number">{{ \App\Models\Course::count() }}</div>
                <small>Courses created in system</small>
            </div>

            <div class="stat-card">
                <h4>Total Enquiries</h4>
                <div class="number">{{ \App\Models\Enquiry::count() }}</div>
                <small>Student admission enquiries</small>
            </div>
        </div>
    </div>
@endsection