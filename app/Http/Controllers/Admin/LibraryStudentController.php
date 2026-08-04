<?php

namespace App\Http\Controllers;

use App\Models\LibrarySeat;
use App\Models\LibraryStudent;
use Illuminate\Http\Request;

class LibraryStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LibraryStudent::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('member_code', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('admin.library_students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $seats = LibrarySeat::where('status', 'available')->orderBy('seat_number')->get();

        $seats = LibrarySeat::where('status', 'available')->orderBy('seat_number')->get();
        return view('admin.library_students.create', compact('seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'fee' => 'nullable|numeric|min:0',
            'seat' => 'nullable|string|max:50',
            'membership_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'seat' => 'nullable|exists:library_seats,id',

        ]);

        $student = LibraryStudent::create($validated);
        // dd($student->seat, $student->id);
        if (!empty($validated['seat'])) {
            $newSeat = LibrarySeat::find($validated['seat']);
            $newSeat->library_student_id = $student->id;
            $newSeat->status = 'occupied';
            $newSeat->save();
        }
        return redirect()
            ->route('superadmin.library-students.index')
            ->with('success', "Library student '{$student->name}' added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = LibraryStudent::findOrFail($id);
        return view('admin.library_students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = LibraryStudent::findOrFail($id);
        $seats = LibrarySeat::orderBy('seat_number')->get();

        // $allotedSeat =  $student->seat;
        // $seats = LibrarySeat::where('seat_number', $allotedSeat)->get();
        // echo '<pre>';
        // print_r($seats);
        // '<pre>';
        // exit;
        // dd($seats);
        return view('admin.library_students.edit', compact('student', 'seats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->seat);
        $student = LibraryStudent::findOrFail($id);
        // dd($student, $request->seat);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'fee' => 'nullable|numeric|min:0',
            'membership_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'seat' => 'nullable|exists:library_seats,id',
        ]);

        // If the student had a previously assigned seat, free it
        $oldSeat = LibrarySeat::where('library_student_id', $student->id)->first();
        // dd($request->seat, $oldSeat);

        if ($oldSeat) {
            $oldSeat->library_student_id = null;
            $oldSeat->status = 'available';
            $oldSeat->save();
        }
        // dd($student, $request->seat);

        $student->update($validated);

        // Assign new seat if selected
        if (!empty($validated['seat'])) {
            $newSeat = LibrarySeat::find($validated['seat']);
            $newSeat->library_student_id = $student->id;
            $newSeat->status = 'occupied';
            $newSeat->save();
        }

        return redirect()->route('superadmin.library-students.index')
            ->with('success', "Student '{$student->name}' updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = LibraryStudent::findOrFail($id);
        $student->delete();

        return redirect()
            ->route('superadmin.library-students.index')
            ->with('success', "Library student '{$student->name}' deleted successfully.");
    }

    public function changeStatus($id)
    {
        $student = LibraryStudent::findOrFail($id);
        $student->status = $student->status === 'active' ? 'inactive' : 'active';
        $student->save();

        return back()->with('success', "Status updated successfully.");
    }
}
