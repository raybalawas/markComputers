<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Computer Super Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
            color: #1e293b;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            padding: 22px 0;
            box-shadow: 4px 0 18px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 35px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: 0.5px;
        }

        .logo span {
            color: #38bdf8;
        }

        .menu {
            list-style: none;
            padding: 0 12px;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 15px;
            font-weight: 500;
        }

        .menu li a i {
            width: 18px;
            text-align: center;
        }

        .menu li a:hover,
        .menu li a.active {
            background: rgba(56, 189, 248, 0.15);
            color: #fff;
            transform: translateX(4px);
        }

        /* ================= MAIN ================= */
        .main-content {
            flex: 1;
            margin-left: 270px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            background: #fff;
            padding: 18px 28px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
        }

        .admin-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-name {
            background: #f1f5f9;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-name i {
            color: #2563eb;
        }

        .logout-btn {
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .content {
            padding: 28px;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 992px) {
            .sidebar {
                width: 230px;
            }

            .main-content {
                margin-left: 230px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 210px;
            }

            .main-content {
                margin-left: 210px;
            }

            .topbar {
                padding: 15px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .page-title {
                font-size: 18px;
            }

            .admin-right {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .wrapper {
                flex-direction: column;
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
                    <a href="{{ route('superadmin.dashboard') }}"
                        class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('superadmin.enquiry.index') }}"
                        class="{{ request()->routeIs('superadmin.enquiry.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-graduate"></i>
                        Enquiries
                    </a>
                </li>

                <li>
                    <a href="{{ route('superadmin.categories.index') }}"
                        class="{{ request()->routeIs('superadmin.categories.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i>
                        Categories
                    </a>
                </li>

                <li>
                    <a href="{{ route('superadmin.courses.index') }}"
                        class="{{ request()->routeIs('superadmin.courses.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book-open"></i>
                        Courses
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="libraryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-book-open"></i> Library
                    </a>
                    <ul class="dropdown-menu"   aria-labelledby="libraryDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('superadmin.seats.*') ? 'active' : '' }}" href="{{ route('superadmin.seats.index') }}">
                                <i class="fas fa-chair"></i> Library Seats
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('superadmin.library-students.*') ? 'active' : '' }}" href="{{ route('superadmin.library-students.index') }}">
                                <i class="fas fa-user-graduate"></i> Library Students
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="libraryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-home"></i> PG HOME
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="libraryDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('superadmin.pg-rooms.*') ? 'active' : '' }}" href="{{ route('superadmin.pg-rooms.index') }}">
                                <i class="fas fa-bed"></i> PG Rooms
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('superadmin.pg-residents.*') ? 'active' : '' }}" href="{{ route('superadmin.pg-residents.index') }}">
                                <i class="fas fa-users"></i>Residents
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>

        <div class="main-content">
            <div class="topbar">
                <div class="page-title">
                    {{-- Super Admin Panel --}}
                </div>

                <div class="admin-right">
                    <div class="admin-name">
                        <i class="fa-solid fa-user-shield"></i>
                        {{ auth('superadmin')->user()->email ?? 'Super Admin' }}
                    </div>

                    <form method="POST" action="{{ route('superadmin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>