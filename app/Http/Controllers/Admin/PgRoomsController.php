<?php

namespace App\Http\Controllers\Admin;

// namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\PgRooms;
use App\Models\PgResident;
use Illuminate\Http\Request;

class PgRoomsController extends Controller
{
    public function index(Request $request)
    {
        $query = PgRooms::with('resident');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('room_no', 'LIKE', "%{$search}%")
                    ->orWhere('room_type', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        $rooms = $query->latest()->paginate(20)->withQueryString();
        return view('admin.pg.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $residents = PgResident::where('status', 'active')->orderBy('name')->get();
        return view('admin.pg.rooms.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_no' => 'required|string|unique:pg_rooms,room_no',
            'room_type' => 'required|in:single,double,triple,dorm',
            'status' => 'required|in:available,occupied,maintenance',
            'resident_id' => 'nullable|exists:pg_residents,id',
        ]);

        PgRooms::create($validated);

        return redirect()
            ->route('superadmin.pg-rooms.index')
            ->with('success', "Room #{$validated['room_no']} created successfully.");
    }

    public function show($id)
    {
        $room = PgRooms::with('resident')->findOrFail($id);
        return view('admin.pg.rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = PgRooms::findOrFail($id);
        $residents = PgResident::where('status', 'active')->orderBy('name')->get();
        return view('admin.pg.rooms.edit', compact('room', 'residents'));
    }

    public function update(Request $request, $id)
    {
        $room = PgRooms::findOrFail($id);

        $validated = $request->validate([
            'room_no' => 'required|string|unique:pg_rooms,room_no,' . $id,
            'room_type' => 'required|in:single,double,triple,dorm',
            'status' => 'required|in:available,occupied,maintenance',
            'resident_id' => 'nullable|exists:pg_residents,id',
        ]);

        $room->update($validated);

        return redirect()
            ->route('superadmin.pg-rooms.index')
            ->with('success', "Room #{$validated['room_no']} updated successfully.");
    }

    public function destroy($id)
    {
        $room = PgRooms::findOrFail($id);
        $room->delete();

        return redirect()
            ->route('superadmin.pg-rooms.index')
            ->with('success', "Room #{$room->room_no} deleted.");
    }

    public function changeStatus($id)
    {
        $room = PgRooms::findOrFail($id);
        $statuses = ['available', 'occupied', 'maintenance'];
        $currentIndex = array_search($room->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        $room->status = $statuses[$nextIndex];
        $room->save();

        return back()->with('success', "Room #{$room->room_no} status changed to '{$room->status}'.");
    }
}