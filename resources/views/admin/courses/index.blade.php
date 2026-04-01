@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="page-header">
            <h3>Courses</h3>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Add Course</a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Course Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->category_id }}</td>
                        <td>{{ $course->category->name ?? '-' }}</td>
                        <td>{{ $course->course_name }}</td>
                        <td>
                            @if($course->status == 1)
                                <span class="badge-active">Active</span>
                            @else
                                <span class="badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $course->created_at ? $course->created_at->format('d-m-Y h:i A') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection