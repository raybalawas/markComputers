@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="page-header">
            <h3>Enquiries</h3>
            <a href="{{ route('enquiry.create') }}" class="btn btn-primary">+ Add Enquiry</a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <!-- <th>Total Fees</th> -->
                    <!-- <th>Due Fees</th> -->
                    <th>Remaining Fee</th>
                    <th>Image</th>
                    <th>Actions</th>
                    <!-- <th>Docs</th> -->
                    <!-- <th>Created At</th> -->
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>{{ $enquiry->id }}</td>
                        <td>{{ $enquiry->name }}</td>
                        <td>{{ $enquiry->email ?? '-' }}</td>
                        <td>{{ $enquiry->phone_number }}</td>
                        <td>{{ $enquiry->course_name ?? '-' }}</td>
                        <!-- <td>{{ $enquiry->total_fees }}</td> -->
                        <!-- <td>{{ $enquiry->due_fees }}</td> -->
                        <td>{{ $enquiry->revenue_fees }}</td>
                        <td>
                            @if($enquiry->image)
                                <!-- <img href="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}" target="_blank">View Image</img> -->
                                <img src="{{ asset('uploads/enquiry/images/' . $enquiry->image) }}" alt="Image" style="width: 80px; height: auto;" >
                            @else
                                -
                            @endif
                        </td>
                        <!-- <td>
                            @if($enquiry->docs)
                                <a href="{{ asset('uploads/enquiry/docs/' . $enquiry->docs) }}" target="_blank">View Docs</a>
                            @else
                                -
                            @endif
                        </td> -->
                        <!-- <td>{{ $enquiry->created_at ? $enquiry->created_at->format('d-m-Y h:i A') : '-' }}</td> -->
                         <td>
                            <a href="" class="btn btn-sm btn-primary">Edit</a>
                            <form action="" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                         </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">No enquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection