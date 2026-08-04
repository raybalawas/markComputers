<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LibrarySeat;
use App\Models\LibraryStudent;
use Illuminate\Http\Request;





class LibrarySeatController extends Controller
{
    public function index(Request $request)
    {
        $query = LibrarySeat::with('student');

        // Search by seat number or status
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('seat_number', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        $seats = $query->latest()->paginate(20)->withQueryString();

        return view('admin.seats.index', compact('seats'));
    }

    public function create()
    {
        $students = LibraryStudent::where('status', 'active')->orderBy('name')->get();
        return view('admin.seats.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'seat_number' => 'required|integer|min:1|unique:library_seats,seat_number',
            'status' => 'required|in:available,occupied,reserved',
            'library_student_id' => 'nullable|exists:library_students,id',
        ]);

        LibrarySeat::create($validated);

        return redirect()
            ->route('superadmin.seats.index')
            ->with('success', "Seat #{$validated['seat_number']} created successfully.");
    }

    public function show($id)
    {
        $seat = LibrarySeat::with('student')->findOrFail($id);
        return view('admin.seats.show', compact('seat'));
    }

    public function edit($id)
    {
        $seat = LibrarySeat::findOrFail($id);
        $students = LibraryStudent::where('status', 'active')->orderBy('name')->get();
        return view('admin.seats.edit', compact('seat', 'students'));
    }

    public function update(Request $request, $id)
    {
        $seat = LibrarySeat::findOrFail($id);

        $validated = $request->validate([
            'seat_number' => 'required|integer|min:1|unique:library_seats,seat_number,' . $id,
            'status' => 'required|in:available,occupied,reserved',
            'library_student_id' => 'nullable|exists:library_students,id',
        ]);

        $seat->update($validated);

        return redirect()
            ->route('superadmin.seats.index')
            ->with('success', "Seat #{$validated['seat_number']} updated successfully.");
    }

    public function destroy($id)
    {
        $seat = LibrarySeat::findOrFail($id);
        $seat->delete();

        return redirect()
            ->route('superadmin.seats.index')
            ->with('success', "Seat #{$seat->seat_number} deleted.");
    }

    public function changeStatus($id)
    {
        $seat = LibrarySeat::findOrFail($id);
        $statuses = ['available', 'occupied', 'reserved'];
        $currentIndex = array_search($seat->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        $seat->status = $statuses[$nextIndex];
        $seat->save();

        return back()->with('success', "Seat #{$seat->seat_number} status changed to '{$seat->status}'.");
    }

    // Bulk generate seats from 1 to 200
    public function bulkGenerate()
    {
        // dd('ok');
        if (LibrarySeat::count() > 0) {
            return redirect()
                ->route('superadmin.seats.index')
                ->with('error', 'Seats already exist. Cannot generate duplicate seats.');
        }

        $seats = [];
        for ($i = 1; $i <= 200; $i++) {
            $seats[] = [
                'seat_number' => $i,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        LibrarySeat::insert($seats);

        return redirect()
            ->route('superadmin.seats.index')
            ->with('success', '200 seats generated successfully (1 to 200).');
    }
}
