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

    .welcome-card {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: white;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.15);
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: "\f0e4";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: -20px;
        bottom: -40px;
        font-size: 150px;
        opacity: 0.06;
        color: #fff;
    }

    .welcome-card h3 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 700;
    }

    .welcome-card p {
        margin: 0;
        opacity: 0.85;
        font-size: 15px;
    }

    /* ================= STATS GRID (3x3 Layout) ================= */
    .module-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
        border-left: 5px solid #ccc;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.07);
    }

    .stat-card .stat-icon-bg {
        position: absolute;
        right: -10px;
        top: -10px;
        font-size: 70px;
        opacity: 0.08;
        pointer-events: none;
    }

    .stat-card .stat-content h4 {
        margin: 0;
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
    }

    .stat-card .stat-content .number {
        margin-top: 8px;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .stat-card .stat-content small {
        display: block;
        margin-top: 6px;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 500;
    }

    /* Module-specific Colors */
    .module-academics {
        border-left-color: #f59e0b;
    }

    .module-academics .number {
        color: #f59e0b;
    }

    .module-academics .stat-icon-bg {
        color: #f59e0b;
    }

    .module-library {
        border-left-color: #3b82f6;
    }

    .module-library .number {
        color: #3b82f6;
    }

    .module-library .stat-icon-bg {
        color: #3b82f6;
    }

    .module-pg {
        border-left-color: #8b5cf6;
    }

    .module-pg .number {
        color: #8b5cf6;
    }

    .module-pg .stat-icon-bg {
        color: #8b5cf6;
    }

    /* ================= ACTION & ACTIVITY WRAPPERS ================= */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .section-header h4 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .dashboard-grid-3col {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 35px;
    }

    /* ================= QUICK ACTIONS ================= */
    .quick-action-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.2s ease;
        margin-bottom: 8px;
    }

    .quick-action-card:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .quick-action-card .icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        flex-shrink: 0;
    }

    .quick-action-card .text-box {
        display: flex;
        flex-direction: column;
    }

    .quick-action-card .text-box strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 600;
    }

    .quick-action-card .text-box span {
        color: #64748b;
        font-size: 12px;
    }

    .bg-orange {
        background: #f59e0b;
    }

    .bg-blue {
        background: #3b82f6;
    }

    .bg-purple {
        background: #8b5cf6;
    }

    /* ================= ACTIVITY FEED TABLES ================= */
    .activity-module-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        padding: 16px;
    }

    .mini-activity-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .mini-activity-table th {
        text-align: left;
        padding: 8px 0;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: #94a3b8;
        border-bottom: 1px solid #f1f5f9;
    }

    .mini-activity-table td {
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
        color: #334155;
    }

    .mini-activity-table tr:last-child td {
        border-bottom: none;
    }

    .badge-new {
        background: #dcfce7;
        color: #166534;
        font-size: 10px;
        padding: 3px 10px;
        border-radius: 999px;
        font-weight: 600;
        display: inline-block;
    }

    /* Responsive */
    @media (max-width: 992px) {

        .module-stats-grid,
        .dashboard-grid-3col {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-title h2 {
            font-size: 24px;
        }

        .module-stats-grid,
        .dashboard-grid-3col {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <div class="dashboard-title">
            <h2>Admin Portal</h2>
            <p>Streamline oversight across Academics, Library, and PG operations.</p>
        </div>
        <div style="font-size: 13px; color: #64748b; background: #f1f5f9; padding: 8px 14px; border-radius: 8px;">
            <i class="fas fa-circle" style="color: #22c55e; font-size: 8px;"></i> All systems nominal
        </div>
    </div>

    <div class="welcome-card">
        <h3>Welcome back, Admin. 👋</h3>
        <p>Your ecosystem is fully operational. Get a clear snapshot of your Academics, Library, and PG activities below.</p>
    </div>

    <!-- ================= 3x3 STATS CARDS ================= -->
    <div class="module-stats-grid">
        <!-- Section 1: Academics -->
        <div class="stat-card module-academics">
            <i class="fas fa-user-graduate stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Total Enquiries</h4>
                <div class="number">{{ $totalEnquiries }}</div>
                <small><i class="fas fa-chart-line"></i> New admission requests</small>
            </div>
        </div>
        <div class="stat-card module-academics">
            <i class="fas fa-layer-group stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Total Categories</h4>
                <div class="number">{{ $totalCategories }}</div>
                <small>Course categories available</small>
            </div>
        </div>
        <div class="stat-card module-academics">
            <i class="fas fa-book-open stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Total Courses</h4>
                <div class="number">{{ $totalCourses }}</div>
                <small>Active learning modules</small>
            </div>
        </div>

        <!-- Section 2: Library -->
        <div class="stat-card module-library">
            <i class="fas fa-chair stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Total Seats</h4>
                <div class="number">{{ $totalSeats }}</div>
                <small><span style="color: #10b981; font-weight: bold;">{{ $availableSeats }} Available</span></small>
            </div>
        </div>
        <div class="stat-card module-library">
            <i class="fas fa-user-graduate stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Library Students</h4>
                <div class="number">{{ $totalLibStudents }}</div>
                <small>Active memberships</small>
            </div>
        </div>
        <div class="stat-card module-library">
            <i class="fas fa-clock stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Occupancy Rate</h4>
                <div class="number">
                    @if($totalSeats > 0)
                    {{ round((($totalSeats - $availableSeats) / $totalSeats) * 100) }}%
                    @else
                    0%
                    @endif
                </div>
                <small>Current seat utilization</small>
            </div>
        </div>

        <!-- Section 3: PG Management -->
        <div class="stat-card module-pg">
            <i class="fas fa-bed stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Total Rooms</h4>
                <div class="number">{{ $totalRooms }}</div>
                <small><span style="color: #10b981; font-weight: bold;">{{ $totalRooms - $occupiedRooms }} Vacant</span></small>
            </div>
        </div>
        <div class="stat-card module-pg">
            <i class="fas fa-building stat-icon-bg"></i>
            <div class="stat-content">
                <h4>Occupied Rooms</h4>
                <div class="number">{{ $occupiedRooms }}</div>
                <small>Currently occupied</small>
            </div>
        </div>
        <div class="stat-card module-pg">
            <i class="fas fa-users stat-icon-bg"></i>
            <div class="stat-content">
                <h4>PG Residents</h4>
                <div class="number">{{ $totalResidents }}</div>
                <small>Active boarders</small>
            </div>
        </div>
    </div>

    <!-- ================= QUICK ACTIONS (3 Columns) ================= -->
    <div class="section-header">
        <h4>⚡ Quick Actions</h4>
    </div>
    <div class="dashboard-grid-3col">
        <!-- Academics Actions -->
        <div>
            <p style="color: #f59e0b; font-weight: 700; font-size: 13px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 10px;">
                <i class="fas fa-graduation-cap"></i> Academics & Enquiry
            </p>
            <a href="{{ route('superadmin.categories.create') }}" class="quick-action-card">
                <div class="icon-box bg-orange"><i class="fas fa-plus"></i></div>
                <div class="text-box"><strong>Add Category</strong><span>Create new course category</span></div>
            </a>
            <a href="{{ route('superadmin.courses.create') }}" class="quick-action-card">
                <div class="icon-box bg-orange"><i class="fas fa-plus-circle"></i></div>
                <div class="text-box"><strong>Add Course</strong><span>Launch a new educational course</span></div>
            </a>
            <a href="{{ route('superadmin.enquiry.index') }}" class="quick-action-card">
                <div class="icon-box bg-orange"><i class="fas fa-users"></i></div>
                <div class="text-box"><strong>Manage Enquiries</strong><span>Check new admission requests</span></div>
            </a>
        </div>

        <!-- Library Actions -->
        <div>
            <p style="color: #3b82f6; font-weight: 700; font-size: 13px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 10px;">
                <i class="fas fa-book"></i> Library Management
            </p>
            <a href="{{ route('superadmin.seats.create') }}" class="quick-action-card">
                <div class="icon-box bg-blue"><i class="fas fa-plus"></i></div>
                <div class="text-box"><strong>Add Seat</strong><span>Create new library seat</span></div>
            </a>
            <a href="{{ route('superadmin.library-students.create') }}" class="quick-action-card">
                <div class="icon-box bg-blue"><i class="fas fa-user-plus"></i></div>
                <div class="text-box"><strong>Add Student</strong><span>Register a new library member</span></div>
            </a>
            <a href="{{ route('superadmin.seats.index') }}" class="quick-action-card">
                <div class="icon-box bg-blue"><i class="fas fa-chair"></i></div>
                <div class="text-box"><strong>View Seats</strong><span>Manage seat allocation</span></div>
            </a>
        </div>

        <!-- PG Actions -->
        <div>
            <p style="color: #8b5cf6; font-weight: 700; font-size: 13px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 10px;">
                <i class="fas fa-home"></i> PG Management
            </p>
            <a href="{{ route('superadmin.pg-rooms.create') }}" class="quick-action-card">
                <div class="icon-box bg-purple"><i class="fas fa-plus"></i></div>
                <div class="text-box"><strong>Add Room</strong><span>Create a new PG room</span></div>
            </a>
            <a href="{{ route('superadmin.pg-residents.create') }}" class="quick-action-card">
                <div class="icon-box bg-purple"><i class="fas fa-user-plus"></i></div>
                <div class="text-box"><strong>Add Resident</strong><span>Register a new boarder</span></div>
            </a>
            <a href="{{ route('superadmin.pg-rooms.index') }}" class="quick-action-card">
                <div class="icon-box bg-purple"><i class="fas fa-bed"></i></div>
                <div class="text-box"><strong>View Rooms</strong><span>Check room vacancy</span></div>
            </a>
        </div>
    </div>

    <!-- ================= RECENT ACTIVITY FEED (3 Columns) ================= -->
    <div class="section-header">
        <h4>🕒 Latest Activities Across Systems</h4>
    </div>
    <div class="dashboard-grid-3col">
        <!-- Recent Enquiries -->
        <div class="activity-module-card">
            <p style="color: #f59e0b; font-weight: 700; font-size: 14px; margin-bottom: 8px;">
                <i class="fas fa-bullhorn"></i> Recent Enquiries
            </p>
            <table class="mini-activity-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Received</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentEnquiries as $item)
                    <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->created_at->format('d M, h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align:center; color:#94a3b8;">No recent enquiries</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Library Students -->
        <div class="activity-module-card">
            <p style="color: #3b82f6; font-weight: 700; font-size: 14px; margin-bottom: 8px;">
                <i class="fas fa-user-graduate"></i> Recent Library Members
            </p>
            <table class="mini-activity-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLibStudents as $item)
                    <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->created_at->format('d M, h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align:center; color:#94a3b8;">No recent members</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent PG Residents -->
        <div class="activity-module-card">
            <p style="color: #8b5cf6; font-weight: 700; font-size: 14px; margin-bottom: 8px;">
                <i class="fas fa-users"></i> Recent PG Residents
            </p>
            <table class="mini-activity-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentResidents as $item)
                    <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->created_at->format('d M, h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align:center; color:#94a3b8;">No recent residents</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection