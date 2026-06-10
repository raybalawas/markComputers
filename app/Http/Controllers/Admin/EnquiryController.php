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
                    ->orWhere('course_name', 'like', "%{$search}%")
                    ->orWhere('father_name', 'like', "%{$search}%")
                    ->orWhere('aadhar_number', 'like', "%{$search}%");
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
            'name'                  => 'required|string|max:255',
            'father_name'           => 'nullable|string|max:255',
            'mother_name'           => 'nullable|string|max:255',
            'dob'                   => 'nullable|date',
            'category'              => 'nullable|string|max:50',
            'gender'                => 'nullable|string|max:10',
            'marital_status'        => 'nullable|string|max:10',
            'address'               => 'nullable|string',
            'email'                 => 'nullable|email|max:255',
            'phone_number'          => 'required|string|max:20',
            'aadhar_number'         => 'nullable|string|max:20',
            'qualification'         => 'nullable|string|max:255',
            'pin_code'              => 'nullable|string|max:10',
            'course_name'           => 'required|string|max:255',
            'total_fees'            => 'required|numeric|min:0',
            'due_fees'              => 'nullable|numeric|min:0',
            'admission_date'        => 'nullable|date',
            'book_issue'            => 'nullable|string|max:50',
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'docs.*'            => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:20480', // 20MB per file
            'docs'              => 'nullable|array|max:20',
            'parent_signature'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'center_head_signature' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'batch_start_time'      => 'nullable',
            'batch_end_time'        => 'nullable',
        ]);

        $totalFees = (float) $request->total_fees;
        $dueFees = (float) $request->due_fees;
        $revenueFees = $totalFees - $dueFees;

        if ($revenueFees < 0) {
            return back()->withErrors([
                'due_fees' => 'Deposit fee total fee se zyada nahi ho sakti.'
            ])->withInput();
        }

        // Handle Student Image
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_img.' . $request->image->extension();
            $request->image->move(public_path('uploads/enquiry/images'), $imageName);
        }

        // Handle Documents
        $docsNames = [];
        if ($request->hasFile('docs')) {
            foreach ($request->file('docs') as $doc) {
                $docName = time() . '_' . uniqid() . '.' . $doc->extension();
                $doc->move(public_path('uploads/enquiry/docs'), $docName);
                $docsNames[] = $docName;
            }
        }

        // Handle Parent Signature
        $parentSignatureName = null;
        if ($request->hasFile('parent_signature')) {
            $parentSignatureName = time() . '_parent_sig.' . $request->parent_signature->extension();
            $request->parent_signature->move(public_path('uploads/enquiry/signatures'), $parentSignatureName);
        }

        // Handle Center Head Signature
        $centerHeadSignatureName = null;
        if ($request->hasFile('center_head_signature')) {
            $centerHeadSignatureName = time() . '_center_sig.' . $request->center_head_signature->extension();
            $request->center_head_signature->move(public_path('uploads/enquiry/signatures'), $centerHeadSignatureName);
        }

        $enquiry = Enquiry::create([
            'name'                  => $request->name,
            'father_name'           => $request->father_name,
            'mother_name'           => $request->mother_name,
            'dob'                   => $request->dob,
            'category'              => $request->category,
            'gender'                => $request->gender,
            'marital_status'        => $request->marital_status,
            'address'               => $request->address,
            'email'                 => $request->email,
            'phone_number'          => $request->phone_number,
            'aadhar_number'         => $request->aadhar_number,
            'qualification'         => $request->qualification,
            'pin_code'              => $request->pin_code,
            'course_name'           => $request->course_name,
            'total_fees'            => $totalFees,
            'due_fees'              => $dueFees,
            'revenue_fees'          => $revenueFees,
            'admission_date'        => $request->admission_date ?? date('Y-m-d'),
            'book_issue'            => $request->book_issue ?? 'Pending',
            'image'                 => $imageName,
            'docs'                  => !empty($docsNames) ? json_encode($docsNames) : null,
            'parent_signature'      => $parentSignatureName,
            'center_head_signature' => $centerHeadSignatureName,
            'batch_start_time'      => $request->batch_start_time,
            'batch_end_time'        => $request->batch_end_time,
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
            'name'                  => 'required|string|max:255',
            'father_name'           => 'nullable|string|max:255',
            'mother_name'           => 'nullable|string|max:255',
            'dob'                   => 'nullable|date',
            'category'              => 'nullable|string|max:50',
            'gender'                => 'nullable|string|max:10',
            'marital_status'        => 'nullable|string|max:10',
            'address'               => 'nullable|string',
            'email'                 => 'nullable|email|max:255',
            'phone_number'          => 'required|string|max:20',
            'aadhar_number'         => 'nullable|string|max:20',
            'qualification'         => 'nullable|string|max:255',
            'pin_code'              => 'nullable|string|max:10',
            'course_name'           => 'required|string|max:255',
            'total_fees'            => 'required|numeric|min:0',
            'due_fees'              => 'required|numeric|min:0',
            'revenue_fees'          => 'required|numeric|min:0',
            'admission_date'        => 'nullable|date',
            'book_issue'            => 'nullable|string|max:50',
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'docs.*'                => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
            'parent_signature'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'center_head_signature' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'batch_start_time'      => 'nullable',
            'batch_end_time'        => 'nullable',
        ]);

        $totalFees = (float) $request->total_fees;
        $dueFees = (float) $request->due_fees;
        $revenueFees = $totalFees - $dueFees;

        if ($revenueFees < 0) {
            return back()->withErrors([
                'due_fees' => 'Deposit fee total fee se zyada nahi ho sakti.'
            ])->withInput();
        }

        // Update Student Image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($enquiry->image && file_exists(public_path('uploads/enquiry/images/' . $enquiry->image))) {
                unlink(public_path('uploads/enquiry/images/' . $enquiry->image));
            }
            $imageName = time() . '_img.' . $request->image->extension();
            $request->image->move(public_path('uploads/enquiry/images'), $imageName);
            $enquiry->image = $imageName;
        }

        // Update Parent Signature
        if ($request->hasFile('parent_signature')) {
            if ($enquiry->parent_signature && file_exists(public_path('uploads/enquiry/signatures/' . $enquiry->parent_signature))) {
                unlink(public_path('uploads/enquiry/signatures/' . $enquiry->parent_signature));
            }
            $parentSignatureName = time() . '_parent_sig.' . $request->parent_signature->extension();
            $request->parent_signature->move(public_path('uploads/enquiry/signatures'), $parentSignatureName);
            $enquiry->parent_signature = $parentSignatureName;
        }

        // Update Center Head Signature
        if ($request->hasFile('center_head_signature')) {
            if ($enquiry->center_head_signature && file_exists(public_path('uploads/enquiry/signatures/' . $enquiry->center_head_signature))) {
                unlink(public_path('uploads/enquiry/signatures/' . $enquiry->center_head_signature));
            }
            $centerHeadSignatureName = time() . '_center_sig.' . $request->center_head_signature->extension();
            $request->center_head_signature->move(public_path('uploads/enquiry/signatures'), $centerHeadSignatureName);
            $enquiry->center_head_signature = $centerHeadSignatureName;
        }

        // Merge old + new docs
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
            'name'                  => $request->name,
            'father_name'           => $request->father_name,
            'mother_name'           => $request->mother_name,
            'dob'                   => $request->dob,
            'category'              => $request->category,
            'gender'                => $request->gender,
            'marital_status'        => $request->marital_status,
            'address'               => $request->address,
            'email'                 => $request->email,
            'phone_number'          => $request->phone_number,
            'aadhar_number'         => $request->aadhar_number,
            'qualification'         => $request->qualification,
            'pin_code'              => $request->pin_code,
            'course_name'           => $request->course_name,
            'total_fees'            => $totalFees,
            'due_fees'              => $dueFees,
            'revenue_fees'          => $revenueFees,
            'admission_date'        => $request->admission_date,
            'book_issue'            => $request->book_issue,
            'docs'                  => json_encode($existingDocs),
            'batch_start_time'      => $request->batch_start_time,
            'batch_end_time'        => $request->batch_end_time,
            'image'                 => $enquiry->image,
            'parent_signature'      => $enquiry->parent_signature,
            'center_head_signature' => $enquiry->center_head_signature,
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

        // Delete associated files
        if ($enquiry->image && file_exists(public_path('uploads/enquiry/images/' . $enquiry->image))) {
            unlink(public_path('uploads/enquiry/images/' . $enquiry->image));
        }

        if ($enquiry->parent_signature && file_exists(public_path('uploads/enquiry/signatures/' . $enquiry->parent_signature))) {
            unlink(public_path('uploads/enquiry/signatures/' . $enquiry->parent_signature));
        }

        if ($enquiry->center_head_signature && file_exists(public_path('uploads/enquiry/signatures/' . $enquiry->center_head_signature))) {
            unlink(public_path('uploads/enquiry/signatures/' . $enquiry->center_head_signature));
        }

        // Delete documents
        $docs = is_array($enquiry->docs) ? $enquiry->docs : json_decode($enquiry->docs ?? '[]', true);
        if (!empty($docs)) {
            foreach ($docs as $doc) {
                if (file_exists(public_path('uploads/enquiry/docs/' . $doc))) {
                    unlink(public_path('uploads/enquiry/docs/' . $doc));
                }
            }
        }

        $enquiry->delete();

        return redirect()
            ->route('superadmin.enquiry.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}
