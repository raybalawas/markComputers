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
            background: #f0f0f0;
        }

        .card {
            width: 250px;
            height: 400px;
            border: 2px solid #1e3a8a;
            border-radius: 12px;
            overflow: visible;
            margin: 30px auto 0;
            position: relative;
        }

        /* Rope hole */
        .card::before {
            content: "";
            width: 20px;
            height: 20px;
            background: white;
            border: 2px solid #999;
            border-radius: 50%;
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Container to align card to left and prevent page break */
        .container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            width: 280px;
            min-height: auto;
            height: auto;
            border: 2px solid #1e3a8a;
            border-radius: 12px;
            overflow: hidden;
            margin: 0;
            position: relative;
            background: white;
            /* Page break prevention */
            page-break-inside: avoid;
            break-inside: avoid;
            page-break-after: avoid;
            page-break-before: avoid;
        }

        .header {
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 12px 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            line-height: 1.3;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 10px;
        }

        .body {
            padding: 12px;
            overflow: hidden;
        }

        .student-img {
            width: 70px;
            height: 80px;
            border: 1px solid #ccc;
            float: right;
            object-fit: cover;
            margin-left: 10px;
            margin-bottom: 10px;
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 8px;
            line-height: 1.4;
            font-size: 11px;
        }

        .info-label {
            font-weight: bold;
            min-width: 65px;
            flex-shrink: 0;
        }

        .info-value {
            flex: 1;
            word-break: break-word;
        }

        .course-box {
            margin-top: 12px;
            background: #e0ecff;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            border-radius: 6px;
            color: #1e40af;
            word-wrap: break-word;
        }

        .signature {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 1px dashed #ccc;
            font-size: 10px;
            text-align: center;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Print styles - NO PAGE BREAK */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .container {
                padding: 0;
                margin: 0;
                display: block;
            }

            .card {
                page-break-inside: avoid;
                break-inside: avoid;
                page-break-after: avoid;
                page-break-before: avoid;
                margin: 0;
                box-shadow: none;
            }

            /* Force no page break inside card */
            .card * {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }

        /* Ensure no page break on any screen */
        @page {
            size: auto;
            margin: 0mm;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>MARK Comp Org.</h1>
                <p>M: 9602982229 | 8949479924</p>
            </div>

            <div class="body">
                <div class="clearfix">
                    @if ($enquiry->image && file_exists(public_path('uploads/enquiry/images/' . $enquiry->image)))
                    <img src="{{ public_path('uploads/enquiry/images/' . $enquiry->image) }}" class="student-img">
                    @endif

                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $enquiry->name }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">F Name:</span>
                        <span class="info-value">{{ $enquiry->father_name }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $enquiry->phone_number }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Batch:</span>
                        <span class="info-value">
                            @if($enquiry->batch_start_time && $enquiry->batch_end_time)
                            {{ date('h:i A', strtotime($enquiry->batch_start_time)) }} - {{ date('h:i A', strtotime($enquiry->batch_end_time)) }}
                            @else
                            __:__ __ - __:__ __
                            @endif
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Book Issue:</span>
                        <span class="info-value">{{ $enquiry->book_issue ?? 'Pending' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Total Fee:</span>
                        <span class="info-value">₹{{ number_format($enquiry->total_fees, 2) }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Remaining:</span>
                        <span class="info-value">₹{{ number_format($enquiry->revenue_fees, 2) }}</span>
                    </div>
                </div>

                <div class="course-box">
                    {{ $enquiry->course_name }}
                </div>

                <div class="signature">
                    Signature.................
                </div>
            </div>
        </div>
    </div>
</body>

</html>