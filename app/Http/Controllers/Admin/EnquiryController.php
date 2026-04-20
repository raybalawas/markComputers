<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::latest();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('course_name', 'like', "%{$search}%");
            });
        }

        $enquiries = $query->paginate(10)->withQueryString();

        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function create()
    {
        $courses = Course::where('status', 1)->latest()->get();

        return view('admin.enquiry.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone_number'      => 'required|string|max:20',
            'course_name'       => 'required|string|max:255',
            'total_fees'        => 'required|numeric|min:0',
            'due_fees'          => 'nullable|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'docs.*'            => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
            'batch_start_time'  => 'nullable',
            'batch_end_time'    => 'nullable',
        ]);

        $totalFees = (float) $request->total_fees;
        $dueFees = (float) $request->due_fees;
        $revenueFees = $totalFees - $dueFees;

        if ($revenueFees < 0) {
            return back()->withErrors([
                'due_fees' => 'Deposit fee total fee se zyada nahi ho sakti.'
            ])->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_img.' . $request->image->extension();
            $request->image->move(public_path('uploads/enquiry/images'), $imageName);
        }

        $docsNames = [];
        if ($request->hasFile('docs')) {
            foreach ($request->file('docs') as $doc) {
                $docName = time() . '_' . uniqid() . '.' . $doc->extension();
                $doc->move(public_path('uploads/enquiry/docs'), $docName);
                $docsNames[] = $docName;
            }
        }

        $enquiry = Enquiry::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'course_name'       => $request->course_name,
            'total_fees'        => $totalFees,
            'due_fees'          => $dueFees,
            'revenue_fees'      => $revenueFees,
            'image'             => $imageName,
            'docs'              => !empty($docsNames) ? json_encode($docsNames) : null,
            'batch_start_time'  => $request->batch_start_time,
            'batch_end_time'    => $request->batch_end_time,
        ]);

        if ($request->action === 'save_download') {
            return redirect()->route('superadmin.enquiry.idcard', $enquiry->id);
        }

        return redirect()
            ->route('superadmin.enquiry.index')
            ->with('success', 'Enquiry added successfully.');
    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $courses = Course::where('status', 1)->latest()->get();

        return view('admin.enquiry.edit', compact('enquiry', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone_number'      => 'required|string|max:20',
            'course_name'       => 'required|string|max:255',
            'total_fees'        => 'required|numeric|min:0',
            'due_fees'          => 'required|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'docs.*'            => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
            'batch_start_time'  => 'nullable',
            'batch_end_time'    => 'nullable',
        ]);

        $totalFees = (float) $request->total_fees;
        $dueFees = (float) $request->due_fees;
        $revenueFees = $totalFees - $dueFees;

        if ($revenueFees < 0) {
            return back()->withErrors([
                'due_fees' => 'Deposit fee total fee se zyada nahi ho sakti.'
            ])->withInput();
        }

        /* Update image */
        if ($request->hasFile('image')) {
            $imageName = time() . '_img.' . $request->image->extension();
            $request->image->move(public_path('uploads/enquiry/images'), $imageName);
            $enquiry->image = $imageName;
        }

        /* Merge old + new docs */
        $existingDocs = is_array($enquiry->docs)
            ? $enquiry->docs
            : json_decode($enquiry->docs ?? '[]', true);

        if ($request->hasFile('docs')) {
            foreach ($request->file('docs') as $doc) {
                $docName = time() . '_' . uniqid() . '.' . $doc->extension();
                $doc->move(public_path('uploads/enquiry/docs'), $docName);
                $existingDocs[] = $docName;
            }
        }

        $enquiry->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'course_name'       => $request->course_name,
            'total_fees'        => $totalFees,
            'due_fees'          => $dueFees,
            'revenue_fees'      => $revenueFees,
            'docs'              => json_encode($existingDocs),
            'batch_start_time'  => $request->batch_start_time,
            'batch_end_time'    => $request->batch_end_time,
            'image'             => $enquiry->image,
        ]);

        return redirect()
            ->route('superadmin.enquiry.index')
            ->with('success', 'Enquiry updated successfully.');
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return view('admin.enquiry.view', compact('enquiry'));
    }

    public function downloadIdCard($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $pdf = Pdf::loadView('admin.enquiry.id-card', compact('enquiry'))
            ->setPaper([0, 0, 250, 400], 'portrait');

        return $pdf->download('student-id-card-' . $enquiry->name . '.pdf');
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()
            ->route('superadmin.enquiry.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}
