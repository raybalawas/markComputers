@extends('admin.layouts.app')

@section('content')
<style>
    .room-table-card { width: 100%; background: #ffffff; border-radius: 16px; box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06); padding: 24px; overflow: hidden; }
    .room-table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; flex-wrap: wrap; gap: 12px; }
    .room-table-title { font-size: 26px; font-weight: 700; color: #0f172a; margin: 0; }
    .btn-primary { background: #2563eb; color: #fff; padding: 12px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-block; }
    .btn-primary:hover { background: #1d4ed8; }
    .alert-success { background: #dcfce7; color: #166534; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #bbf7d0; }
    .alert-danger { background: #fee2e2; color: #991b1b; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #fecaca; }
    .search-form { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .search-form .form-control { flex: 1; min-width: 200px; padding: 8px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; }
    .search-form .btn-search { background: #2563eb; color: #fff; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; }
    .search-form .btn-clear { background: #6b7280; color: #fff; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .table-wrapper { overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; }
    .room-table { width: 100%; border-collapse: collapse; min-width: 700px; }
    .room-table thead { background: #0f172a; }
    .room-table thead th { color: #fff; font-size: 14px; font-weight: 600; padding: 14px; text-align: left; white-space: nowrap; }
    .room-table tbody td { padding: 14px; border-bottom: 1px solid #e2e8f0; color: #334155; font-size: 14px; vertical-align: middle; }
    .room-table tbody tr:hover { background: #f8fafc; }
    .badge-available { background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 999px; font-size: 13px; font-weight: 700; }
    .badge-occupied { background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 999px; font-size: 13px; font-weight: 700; }
    .badge-maintenance { background: #e0e7ff; color: #3730a3; padding: 6px 12px; border-radius: 999px; font-size: 13px; font-weight: 700; }
    .empty-row { text-align: center; padding: 22px !important; color: #64748b; font-weight: 500; }
    @media (max-width: 768px) { .room-table-title { font-size: 22px; } .room-table-header { flex-direction: column; align-items: flex-start; } .search-form { flex-direction: column; } .search-form .form-control { min-width: unset; } }
    .action-buttons { display: flex; gap: 8px; flex-wrap: wrap; }
    .btn-action { padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; color: white; border: none; cursor: pointer; }
    .btn-edit { background: #2563eb; } .btn-view { background: #16a34a; } .btn-delete { background: #dc2626; }
</style>

<div class="room-table-card">
    <div class="room-table-header">
        <h3 class="room-table-title">PG Rooms</h3>
        <a href="{{ route('superadmin.pg-rooms.create') }}" class="btn-primary">+ Add Room</a>
    </div>

    @if (session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="alert-danger">{{ session('error') }}</div> @endif

    <form method="GET" action="{{ route('superadmin.pg-rooms.index') }}" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search by room #, type or status..." value="{{ request('search') }}">
        <button type="submit" class="btn-search">Search</button>
        @if(request('search')) <a href="{{ route('superadmin.pg-rooms.index') }}" class="btn-clear">Clear</a> @endif
    </form>

    <div class="table-wrapper">
        <table class="room-table">
            <thead><tr><th>S.NO</th><th>Room #</th><th>Type</th><th>Status</th><th>Resident</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>#{{ $room->room_no }}</strong></td>
                    <td>{{ ucfirst($room->room_type) }}</td>
                    <td>
                        <form action="{{ route('superadmin.pg-rooms.status', $room->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button type="submit" style="border:none; cursor:pointer;" class="badge-{{ $room->status }}">
                                {{ ucfirst($room->status) }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $room->resident->name ?? 'Vacant' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('superadmin.pg-rooms.show', $room->id) }}" class="btn-action btn-view"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('superadmin.pg-rooms.edit', $room->id) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('superadmin.pg-rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this room?');">@csrf @method('DELETE') <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-row">No rooms found. Add a new room.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $rooms->links('pagination::bootstrap-5') }}
</div>
@endsection