<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Fee Slip</title>
    <style>
        /* 👉 FORCE LANDSCAPE & A4 PAGE SETTINGS */
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: white;
        }

        .container {
            width: 100%;
            border: 1px solid #000;
            padding: 12px;
            page-break-inside: avoid;
            /* Ensures it stays on 1 single page */
            box-sizing: border-box;
            background: white;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        /* Standard Tables for DomPDF Stability */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        /* Landscape specific sizes */
        .col-30 {
            width: 30%;
        }

        .col-70 {
            width: 70%;
        }

        .col-25 {
            width: 25%;
        }

        .col-75 {
            width: 75%;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 4px;
            font-weight: bold;
            color: #fff;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-inactive {
            background-color: #dc3545;
        }

        /* Footer using clean Table structure (Avoids DomPDF flex crash) */
        .footer-table td {
            border: none;
            vertical-align: bottom;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 150px;
            padding-top: 4px;
            text-align: center;
            margin-top: 20px;
            display: inline-block;
        }

        .generated-date {
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>MARK Comp Org.</h1>
            <p class="bold">LIBRARY FEE RECEIPT</p>
            <p>9602982229 | 8949479924</p>
        </div>

        <!-- Meta Info: Receipt No and Date -->
        <table>
            <tr>
                <td class="col-50"><strong>Receipt No:</strong> {{ $feeSlip->member_code }}</td>
                <td class="col-50 text-right"><strong>Date:</strong> {{ now()->format('d-m-Y') }}</td>
            </tr>
        </table>

        <!-- Student & Seat Details (Landscape par width zyada hai, isliye 2 columns bhi fit ho jayenge) -->
        <table>
            <tr>
                <th class="col-25">Student Name</th>
                <td class="col-75" colspan="3"><strong>{{ $feeSlip->name }}</strong></td>
            </tr>
            <tr>
                <th class="col-25">Phone</th>
                <td class="col-25">{{ $feeSlip->phone }}</td>
                <th class="col-25">Seat #</th>
                <td class="col-25">{{ $feeSlip->seat ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="col-25">Membership Date</th>
                <td class="col-25">{{ optional($feeSlip->membership_date)->format('d-m-Y') ?? 'N/A' }}</td>
                <th class="col-25">Member Status</th>
                <td class="col-25">
                    <span class="{{ $feeSlip->status }}">
                        {{ ucfirst($feeSlip->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <!-- Fee Breakdown Table (Returned as requested) -->
        <table>
            <thead>
                <tr>
                    <th style="width: 65%;">Particulars</th>
                    <th style="width: 35%;" class="text-right">Amount </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Library Seat Allocation &amp; Membership Fee</td>
                    <td class="text-right">{{ number_format($feeSlip->fee, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-right bold">Total</td>
                    <td class="text-right bold">{{ number_format($feeSlip->fee, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer: Signature & Payment Mode (Avoiding the crash bug) -->
        <table class="footer-table">
            <tr>
                <td style="width: 50%; text-align: left;">
                    <div class="signature-line">Authorized Signatory</div>
                </td>
                <td style="width: 50%; text-align: right; font-size: 12px;">
                    Payment Mode: Cash / Online
                </td>
            </tr>
        </table>

        <div class="generated-date">
            Generated on: {{ now()->format('d-m-Y h:i A') }}
        </div>
    </div>
</body>

</html>