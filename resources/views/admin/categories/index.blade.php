@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="page-header">
            <h3>Course Categories</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Add Category</a>
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
                    <th>Course Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if($category->status == 1)
                                <span class="badge-active">Active</span>
                            @else
                                <span class="badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $category->created_at ? $category->created_at->format('d-m-Y h:i A') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection