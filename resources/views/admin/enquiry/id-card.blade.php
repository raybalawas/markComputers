<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>I-Card</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 100%;
            height: 100%;
            border: 2px solid #1e3a8a;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .topbar {
            background: #1e3a8a;
            color: #fff;
            text-align: center;
            padding: 8px 10px 6px;
        }

        .topbar h2 {
            margin: 0;
            font-size: 16px;
            line-height: 1.2;
        }

        .topbar p {
            margin: 2px 0 0;
            font-size: 9px;
        }

        .content {
            padding: 10px;
        }

        .row {
            width: 100%;
            display: table;
        }

        .left {
            display: table-cell;
            width: 68%;
            vertical-align: top;
            padding-right: 8px;
        }

        .right {
            display: table-cell;
            width: 32%;
            vertical-align: top;
            text-align: center;
        }

        .photo {
            width: 72px;
            height: 88px;
            border: 1px solid #555;
            margin: 0 auto 8px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-placeholder {
            width: 72px;
            height: 88px;
            border: 1px solid #555;
            line-height: 88px;
            text-align: center;
            font-size: 10px;
            color: #666;
            margin: 0 auto 8px;
        }

        .student-name {
            font-size: 14px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 6px;
        }

        .info {
            font-size: 10px;
            line-height: 1.7;
            color: #111827;
        }

        .label {
            font-weight: bold;
        }

        .course-box {
            margin-top: 6px;
            padding: 5px 6px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 4px;
            font-size: 10px;
            text-align: center;
            font-weight: bold;
            color: #1d4ed8;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f3f4f6;
            border-top: 1px solid #d1d5db;
            padding: 5px 10px;
            font-size: 8px;
            text-align: center;
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="topbar">
            <h2>MARK COMPUTER CENTER</h2>
            <p>Student Identity Card</p>
        </div>

        <div class="content">
            <div class="row">
                <div class="left">
                    <div class="student-name">{{ $enquiry->name }}</div>

                    <div class="info">
                        <div><span class="label">Phone:</span> {{ $enquiry->phone_number }}</div>
                        <div><span class="label">Email:</span> {{ $enquiry->email ?: '-' }}</div>
                        <div><span class="label">Total Fee:</span> Rs. {{ number_format($enquiry->total_fees, 2) }}</div>
                        <div><span class="label">Deposite Fee:</span> Rs. {{ number_format($enquiry->due_fees, 2) }}</div>
                        <div><span class="label">Remaining Fee:</span> Rs. {{ number_format($enquiry->revenue_fees, 2) }}</div>
                    </div>

                    <div class="course-box">
                        Course: {{ $enquiry->course_name }}
                    </div>
                </div>

                <div class="right">
                    @if($enquiry->image)
                        <div class="photo">
                            <img src="{{ public_path('uploads/enquiry/images/' . $enquiry->image) }}" alt="Photo">
                        </div>
                    @else
                        <div class="photo-placeholder">PHOTO</div>
                    @endif

                    <div style="font-size:9px; font-weight:bold;">ID NO: MC{{ str_pad($enquiry->id, 4, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            Mark Computer Center - Authorized Student Card
        </div>
    </div>
</body>
</html>