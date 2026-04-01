@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="page-header">
            <h3>Add Course</h3>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
        </div>

        @if ($errors->any())
            <div class="alert-danger">
                <!-- <strong>Please fix these errors:</strong> -->
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Category ID</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category ID</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Course Name</label>
                <select name="course_name" class="form-control">
                    <option value="">Select Course</option>
                    <option value="DCA" {{ old('course_name') == 'DCA' ? 'selected' : '' }}>DCA</option>
                    <option value="ADCA" {{ old('course_name') == 'ADCA' ? 'selected' : '' }}>ADCA</option>
                    <option value="PGDCA" {{ old('course_name') == 'PGDCA' ? 'selected' : '' }}>PGDCA</option>
                    <option value="Tally" {{ old('course_name') == 'Tally' ? 'selected' : '' }}>Tally</option>
                    <option value="CCC" {{ old('course_name') == 'CCC' ? 'selected' : '' }}>CCC</option>
                    <option value="Basic Computer" {{ old('course_name') == 'Basic Computer' ? 'selected' : '' }}>Basic Computer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Course</button>
        </form>
    </div>
@endsection