<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .card-front {
            width: 900px;
            border: 2px solid #6b1f1f;
            padding: 15px;
            color: #6b1f1f;
        }

        .student-card {
            display: inline-block;
            background: #6b1f1f;
            color: #fff;
            padding: 8px 25px;
            font-weight: bold;
            font-size: 22px;
        }

        .header {
            width: 100%;
            margin-top: 10px;
        }

        .left {
            float: left;
            width: 60%;
        }

        .right {
            float: right;
            width: 30%;
            text-align: center;
        }

        .institute {
            font-size: 42px;
            font-weight: bold;
        }

        .mobile {
            font-size: 22px;
            font-weight: bold;
            line-height: 35px;
        }

        .enroll {
            border: 2px solid #6b1f1f;
            margin-top: 10px;
        }

        .enroll-title {
            border-bottom: 2px solid #6b1f1f;
            font-size: 22px;
            font-weight: bold;
            padding: 5px;
        }

        .clear {
            clear: both;
        }

        .course {
            margin-top: 20px;
            font-size: 22px;
        }

        .photo-section {
            margin-top: 15px;
        }

        .photo-box {
            float: left;
            width: 180px;
            height: 220px;
            border: 2px solid #6b1f1f;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
        }

        .details {
            margin-left: 220px;
            font-size: 24px;
            line-height: 55px;
        }

        .dotted {
            border-bottom: 2px dotted #6b1f1f;
            display: inline-block;
            min-width: 350px;
        }

        .row2 .dotted {
            min-width: 180px;
        }

        .signature {
            float: right;
            width: 250px;
            border: 2px solid #6b1f1f;
            text-align: center;
            padding: 12px;
            margin-top: 10px;
            font-size: 24px;
        }
    </style>
    <style>
        .card-back {
            width: 900px;
            border: 2px solid #6b1f1f;
            padding: 15px;
            color: #6b1f1f;
        }

        .back-header {
            width: 100%;
            margin-bottom: 20px;
        }

        .back-left {
            float: left;
            font-size: 42px;
            font-weight: bold;
        }

        .fee-structure {
            float: right;
            background: #6b1f1f;
            color: #fff;
            padding: 10px 30px;
            font-size: 24px;
            font-weight: bold;
        }

        .fee-table {
            width: 48%;
            float: left;
            border-collapse: collapse;
        }

        .fee-table.right {
            float: right;
        }

        .fee-table th {
            background: #6b1f1f;
            color: #fff;
        }

        .fee-table th,
        .fee-table td {
            border: 2px solid #6b1f1f;
            text-align: center;
            padding: 10px;
            height: 45px;
        }
    </style>

</head>

<body>

    <div class="card-front">

        <div class="student-card">
            STUDENT ID CARD
        </div>

        <div class="header">

            <div class="left">
                <div class="institute">
                    मार्क कम्प्यूटर शिक्षण संस्थान
                </div>
            </div>

            <div class="right">

                <div class="mobile">
                    M. 9602982229<br>
                    8949479924
                </div>

                <div class="enroll">
                    <div class="enroll-title">
                        Enroll No.
                    </div>

                    {{ $enquiry->id }}
                </div>

            </div>

        </div>

        <div class="clear"></div>

        <div class="course">
            <b>Course</b>
            <span class="dotted">
                {{ $enquiry->course_name }}
            </span>
        </div>

        <div class="photo-section">

            <div class="photo-box">

                @if($enquiry->image)
                <img src="{{ public_path('uploads/enquiry/images/'.$enquiry->image) }}">
                @endif

            </div>

            <div class="details">

                <div>
                    <b>Date :</b>
                    <span class="dotted">
                        {{ date('d-m-Y') }}
                    </span>
                </div>

                <div>
                    <b>Name</b>
                    <span class="dotted">
                        {{ $enquiry->name }}
                    </span>
                </div>

                <div>
                    <b>Father's Name</b>
                    <span class="dotted">
                        {{ $enquiry->father_name ?? '' }}
                    </span>
                </div>

                <div class="row2">
                    <b>Total Fees</b>
                    <span class="dotted">
                        ₹{{ $enquiry->total_fees }}
                    </span>

                    <b> Time </b>

                    <span class="dotted">
                        {{ $enquiry->batch_time ?? '' }}
                    </span>
                </div>

                <div>
                    <b>Books Issue</b>

                    <span class="dotted">
                        {{ $enquiry->books_issue ?? '' }}
                    </span>
                </div>

            </div>

        </div>

        <div class="clear"></div>

        <div class="signature">
            Signature
        </div>

        <div class="clear"></div>

    </div>


    <div style="page-break-before:always;"></div>


    <div class="card-back">

        <div class="back-header">

            <div class="back-left">
                मार्क कम्प्यूटर शिक्षण संस्थान
            </div>

            <div class="fee-structure">
                Fee Structure
            </div>

        </div>

        <div style="clear:both"></div>

        <table class="fee-table">

            <tr>
                <th>Month</th>
                <th>Fee</th>
                <th>Date</th>
                <th>Sign.</th>
            </tr>

            <tr>
                <td>Jan</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Feb</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Mar</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Apr</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>May</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Jun</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </table>

        <table class="fee-table right">

            <tr>
                <th>Month</th>
                <th>Fee</th>
                <th>Date</th>
                <th>Sign.</th>
            </tr>

            <tr>
                <td>Jul</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Aug</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Sep</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Oct</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Nov</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Dec</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </table>

        <div style="clear:both"></div>

    </div>
</body>

</html>