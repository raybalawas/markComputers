<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Computer Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #1e293b, #0f172a);
            color: #fff;
            padding: 20px 0;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar .logo span {
            color: #38bdf8;
        }

        .menu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            margin: 8px 0;
        }

        .menu li a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 22px;
            border-left: 4px solid transparent;
            transition: 0.3s;
            font-size: 15px;
        }

        .menu li a:hover,
        .menu li a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left: 4px solid #38bdf8;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            padding: 18px 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h2 {
            font-size: 22px;
            color: #1e293b;
        }

        .topbar .admin-name {
            color: #475569;
            font-weight: 600;
        }

        .content {
            padding: 30px;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            padding: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            overflow: hidden;
            border-radius: 10px;
        }

        table thead {
            background: #0f172a;
            color: white;
        }

        table th, table td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #2563eb;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        ul.error-list {
            padding-left: 20px;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .page-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="logo">
                Mark <span>Computer</span>
            </div>

            <ul class="menu">
                <li>
                    <a href="{{ route('enquiry.index') }}" class="{{ request()->routeIs('enquiry.*') ? 'active' : '' }}">
                        Enquiries
                    </a>
                </li>
            </ul>

            <ul class="menu">
                <li>
                    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        Categories
                    </a>
                </li>
            </ul>

            <ul class="menu">
                <li>
                    <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        Courses
                    </a>
                </li>
            </ul>
        </aside>

        <div class="main-content">
            <div class="topbar">
                <h2>Admin Panel</h2>
                <div class="admin-name">Welcome Admin</div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>