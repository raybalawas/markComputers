@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="page-header">
            <h3>Add Category</h3>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
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

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Category Name</label>
                <select name="name" class="form-control">
                    <option value="">Select Category</option>
                    <option value="Basic" {{ old('course') == 'Basic' ? 'selected' : '' }}>Basic</option>
                    <option value="UG" {{ old('course') == 'UG' ? 'selected' : '' }}>UG</option>
                    <option value="PG" {{ old('course') == 'PG' ? 'selected' : '' }}>PG</option>
                    <option value="Diploma" {{ old('course') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Category</button>
        </form>
    </div>
@endsection