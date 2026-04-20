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
        $categories = Category::where('status', 1)->latest()->get();

        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        Course::create([
            'category_id' => $request->category_id,
            'course_name' => $request->course_name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('superadmin.courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::where('status', 1)->latest()->get();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $course = Course::findOrFail($id);

        $course->update([
            'category_id' => $request->category_id,
            'course_name' => $request->course_name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('superadmin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()
            ->route('superadmin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function changeStatus($id)
    {
        $course = Course::findOrFail($id);

        $course->status = $course->status == 1 ? 0 : 1;
        $course->save();

        return redirect()->back()->with('success', 'Course status updated successfully.');
    }
}
