<?php

namespace App\Http\Controllers\Admin;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\PgResident;
use App\Models\PgRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PgResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = PgResident::with('room');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('resident_code', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $residents = $query->latest()->paginate(10)->withQueryString();
        return view('admin.pg.residents.index', compact('residents'));
    }

    public function create()
    {
        $rooms = PgRooms::where('status', 'available')->orderBy('room_no')->get();
        return view('admin.pg.residents.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'fee' => 'nullable|numeric|min:0',
            'aadhar' => 'nullable|string|max:20',
            'aadhar_images' => 'nullable|array|max:2',
            'aadhar_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'joining_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'room_id' => 'nullable|exists:pg_rooms,id',
        ]);

        // Auto-generate resident code
        // $validated['resident_code'] = 'PG-' . strtoupper(Str::random(6));
        $paths = [];
        if ($request->hasFile('aadhar_images')) {
            foreach ($request->file('aadhar_images') as $file) {
                $paths[] = $file->store('aadhar_images', 'public');
            }
        }
        $validated['aadhar_image'] = $paths;
        $validated['resident_code'] = 'PG-' . strtoupper(Str::random(6));


        $resident = PgResident::create($validated);

        // If a room is assigned, update the room's status and resident_id
        if (!empty($validated['room_id'])) {
            $room = PgRooms::find($validated['room_id']);
            $room->resident_id = $resident->id;
            $room->status = 'occupied';
            $room->save();
        }

        return redirect()
            ->route('superadmin.pg-residents.index')
            ->with('success', "PG Resident '{$resident->name}' added successfully.");
    }

    public function show($id)
    {
        $resident = PgResident::with('room')->findOrFail($id);
        return view('admin.pg.residents.show', compact('resident'));
    }

    public function edit($id)
    {
        $resident = PgResident::with('room')->findOrFail($id);
        $rooms = PgRooms::orderBy('room_no')->get();
        return view('admin.pg.residents.edit', compact('resident', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $resident = PgResident::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'fee' => 'nullable|numeric|min:0',
            'aadhar' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'room_id' => 'nullable|exists:pg_rooms,id',
            'aadhar_images' => 'nullable|array|max:2',
            'aadhar_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'remove_aadhar' => 'nullable|in:0,1',
        ]);

        if ($request->input('remove_aadhar') == '1' && $resident->aadhar_image) {
            foreach ($resident->aadhar_image as $path) {
                Storage::disk('public')->delete($path);
            }
            $resident->aadhar_image = null;
            $resident->save(); // Save early to apply removal
        }

        // Handle upload
        if ($request->hasFile('aadhar_images')) {
            // Delete old if they are uploading new ones
            if ($resident->aadhar_image) {
                foreach ($resident->aadhar_image as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            $paths = [];
            foreach ($request->file('aadhar_images') as $file) {
                $paths[] = $file->store('aadhar_images', 'public');
            }
            $validated['aadhar_image'] = $paths;
        }

        $oldRoom = $resident->room;
        if ($oldRoom) {
            $oldRoom->status = 'available';
            $oldRoom->save();
        }

        $resident->update($validated);

        if (!empty($validated['room_id'])) {
            $newRoom = PgRooms::find($validated['room_id']);
            if ($newRoom) {
                $newRoom->status = 'occupied';
                $newRoom->save();
            }
        }

        return redirect()
            ->route('superadmin.pg-residents.index')
            ->with('success', "PG Resident '{$resident->name}' updated.");
    }

    public function destroy($id)
    {
        $resident = PgResident::findOrFail($id);
        // Free the assigned room before deleting
        $room = PgRooms::where('resident_id', $resident->id)->first();
        if ($room) {
            $room->resident_id = null;
            $room->status = 'available';
            $room->save();
        }

        $resident->delete();

        return redirect()
            ->route('superadmin.pg-residents.index')
            ->with('success', "PG Resident '{$resident->name}' deleted successfully.");
    }

    public function changeStatus($id)
    {
        $resident = PgResident::findOrFail($id);
        $resident->status = $resident->status === 'active' ? 'inactive' : 'active';
        $resident->save();

        return back()->with('success', "Status updated successfully.");
    }
}
