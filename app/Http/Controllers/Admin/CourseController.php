<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Course::create([
            'category_id' => $request->category_id,
            'course_name' => $request->course_name,
            'status' => $request->status,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course added successfully');
    }
}