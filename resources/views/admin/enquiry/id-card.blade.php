<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ID Card</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 250px;
            height: 400px;
            border: 2px solid #1e3a8a;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto;
        }

        .header {
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 15px 10px;
        }

        .header h1 {
            margin: 0 0 0 0;
            font-size: 22px;
            line-height: 30px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        .body {
            padding: 12px;
        }

        .student-img {
            width: 70px;
            height: 80px;
            border: 1px solid #ccc;
            float: right;
            object-fit: cover;
        }

        .info {
            font-size: 13px;
            line-height: 22px;
        }

        .course-box {
            margin-top: 12px;
            background: #e0ecff;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 6px;
            color: #1e40af;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <h1>MARK</h1>
            <p>Phone: 9876543210 | Bansur</p>
            {{-- <p>Student Identity Card</p> --}}
        </div>

        <div class="body">
            @if ($enquiry->image)
                <img src="{{ public_path('uploads/enquiry/images/' . $enquiry->image) }}" class="student-img">
            @endif

            <div class="info">
                <strong>Name:</strong> {{ $enquiry->name }}<br>
                <strong>Phone:</strong> {{ $enquiry->phone_number }}<br>
                <strong>Total Fee:</strong> ₹{{ $enquiry->total_fees }}<br>
                {{-- <strong>Deposit:</strong> ₹{{ $enquiry->due_fees }}<br> --}}
                <strong>Remaining:</strong> ₹{{ $enquiry->revenue_fees }}<br>
                <strong>Batch:</strong> 10:00 AM - 11:00 AM
            </div>

            <div class="course-box">
                {{ $enquiry->course_name }}
            </div>
        </div>
    </div>
</body>

</html>
