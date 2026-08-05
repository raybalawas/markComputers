<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PG Fee Slip</title>
    <style>
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
            box-sizing: border-box;
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

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
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
        <div class="header">
            <h1>MARK Comp Org.</h1>
            <p class="bold">PG RESIDENT FEE RECEIPT</p>
            <p>9602982229 | 8949479924</p>
        </div>

        <table>
            <tr>
                <td width="50%"><strong>Receipt No:</strong> {{ $resident->resident_code }}</td>
                <td width="50%" class="text-right"><strong>Date:</strong> {{ now()->format('d-m-Y') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th width="25%">Resident Name</th>
                <td width="75%" colspan="3"><strong>{{ $resident->name }}</strong></td>
            </tr>
            <tr>
                <th width="25%">Phone</th>
                <td width="25%">{{ $resident->phone }}</td>
                <th width="25%">Room #</th>
                <td width="25%">{{ $resident->room->room_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th width="25%">Joining Date</th>
                <td width="25%">{{ optional($resident->joining_date)->format('d-m-Y') ?? 'N/A' }}</td>
                <th width="25%">Status</th>
                <td width="25%">
                    <span class="{{ $resident->status }}">{{ ucfirst($resident->status) }}</span>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th style="width: 65%;">Particulars</th>
                    <th style="width: 35%;" class="text-right">Amount </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PG Room Allocation &amp; Registration Fee</td>
                    <td class="text-right">{{ number_format($resident->fee, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-right bold">Total</td>
                    <td class="text-right bold">{{ number_format($resident->fee, 2) }}</td>
                </tr>
            </tbody>
        </table>

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