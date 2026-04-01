<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->get();
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
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone_number'=> 'required|string|max:20',
            'course_name' => 'required|string|max:255',
            'total_fees'  => 'required|numeric|min:0',
            'due_fees'    => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'docs.*'      => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $totalFees = (float) $request->total_fees;
        $dueFees = (float) $request->due_fees;
        $revenueFees = $totalFees - $dueFees;

        if ($revenueFees < 0) {
            return back()->withErrors([
                'due_fees' => 'Deposite fee total fee se zyada nahi ho sakti.'
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
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'course_name'  => $request->course_name,
            'total_fees'   => $totalFees,
            'due_fees'     => $dueFees,
            'revenue_fees' => $revenueFees,
            'image'        => $imageName,
            'docs'         => !empty($docsNames) ? json_encode($docsNames) : null,
        ]);

        if ($request->action === 'save_download') {
            return redirect()->route('enquiry.idcard', $enquiry->id);
        }

        return redirect()->route('enquiry.index')->with('success', 'Enquiry added successfully.');
    }

    public function downloadIdCard($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $pdf = Pdf::loadView('admin.enquiry.id-card', compact('enquiry'))
            ->setPaper([0, 0, 242, 153], 'landscape');

        return $pdf->download('id-card-' . $enquiry->name . '.pdf');
    }
}