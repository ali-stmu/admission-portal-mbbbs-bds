<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Application Summary - {{ $student->application_no }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2e7d32;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #f5f5f5;
            padding: 8px;
            font-weight: bold;
            border-left: 4px solid #2e7d32;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .info-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Application Summary</h1>
        <p>Application No: {{ $student->application_no }}</p>
        <p>Date: {{ now()->format('d M, Y') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Personal Information</div>
        <table class="info-table">
            <tr>
                <td width="30%">Applicant Name</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>CNIC</td>
                <td>{{ $student->cnic }}</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $student->dob->format('d M, Y') }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $student->gender }}</td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td>{{ $student->mobile }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <td>Nationality</td>
                <td>{{ $student->nationality }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Application Details</div>
        <table class="info-table">
            <tr>
                <td width="30%">Term</td>
                <td>{{ $student->term->name }} - {{ $student->term->session }}</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>{{ ucfirst($student->paymentInformation->program) }}</td>
            </tr>
            <tr>
                <td>Application Fee</td>
                <td>Rs. {{ number_format($student->paymentInformation->amount, 2) }}</td>
            </tr>
            <tr>
                <td>Payment Mode</td>
                <td>{{ $student->paymentInformation->payment_mode }}</td>
            </tr>
            <tr>
                <td>Transaction ID</td>
                <td>{{ $student->paymentInformation->transaction_id }}</td>
            </tr>
            @if ($student->testInformation)
                <tr>
                    <td>Test Type</td>
                    <td>{{ strtoupper($student->testInformation->test_type) }}</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <div class="section-title">Academic Records</div>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>School/College</th>
                    <th>Board</th>
                    <th>Year</th>
                    <th>Marks</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->academicRecords as $record)
                    <tr>
                        <td>{{ $record->level }}</td>
                        <td>{{ $record->school_college }}</td>
                        <td>{{ $record->board }}</td>
                        <td>{{ $record->year }}</td>
                        <td>{{ $record->obtained_marks }}/{{ $record->maximum_marks }}</td>
                        <td>{{ $record->percentage }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Contact Information</div>
        <table class="info-table">
            <tr>
                <td width="30%">Father's Name</td>
                <td>{{ $student->father_name }}</td>
            </tr>
            <tr>
                <td>Father's Mobile</td>
                <td>{{ $student->father_mobile }}</td>
            </tr>
            <tr>
                <td>Mailing Address</td>
                <td>
                    {{ $student->mailing_house_no }}, {{ $student->mailing_street }},
                    {{ $student->mailing_sector }}, {{ $student->mailing_city }},
                    {{ $student->mailing_country }}
                </td>
            </tr>
            <tr>
                <td>Permanent Address</td>
                <td>
                    {{ $student->permanent_house_no }}, {{ $student->permanent_street }},
                    {{ $student->permanent_sector }}, {{ $student->permanent_city }},
                    {{ $student->permanent_country }}
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>This is a computer generated document. No signature is required.</p>
        <p>Generated on: {{ now()->format('d M, Y H:i') }}</p>
    </div>
</body>

</html>
