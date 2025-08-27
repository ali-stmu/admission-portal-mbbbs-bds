<!DOCTYPE html>
<html>

<head>
    <title>Challan</title>
    <style>
        @page {
            size: landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial;
        }

        .container {
            width: 100%;
            padding: 0;
            display: flex;
            flex-wrap: nowrap;
            page-break-inside: avoid;
        }

        .row {
            display: flex;
            width: 100%;
            page-break-inside: avoid;
        }

        .col-md-4 {
            width: 33.33%;
            float: left;
            padding: 0 2px;
            box-sizing: border-box;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .col-md-4 table {
            width: 100%;
            font-size: 9.5px;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
        }

        .col-md-4 td {
            border: 1px solid black;
            padding: 1px;
            word-wrap: break-word;
            overflow: hidden;
            page-break-inside: avoid;
        }

        .col-md-4 td.bank-logo,
        .col-md-4 td.university-logo {
            border-bottom: 1px solid #000;
        }

        .custom-box {
            display: inline-block;
            width: 7px;
            height: 7px;
            border: 0.5px solid #000;
            margin-left: 3px;
            vertical-align: middle;
        }

        hr {
            border-top: 1px solid #000;
            margin: 2px 0;
        }

        .currency-symbol {
            font-weight: bold;
        }

        .foreign-note {
            font-size: 8px;
            color: #666;
            text-align: center;
            margin-top: 3px;
        }

        /* Force each column to stay together */
        .col-md-4 {
            page-break-inside: avoid;
            break-inside: avoid-column;
        }

        /* Ensure tables don't break across pages */
        table {
            page-break-inside: avoid;
        }

        /* Adjust cell heights to prevent overflow */
        td {
            height: 12px;
            min-height: 12px;
            max-height: 12px;
            overflow: hidden;
        }

        /* Specific adjustments for content cells */
        .content-cell {
            height: auto;
            min-height: 12px;
            max-height: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Department Copy -->
            <div class="col-md-4">
                <table>
                    <tr>
                        <td class="bank-logo"><img style="max-width: 60px; height: auto;" src="{{ $data['uniLogo'] }}"
                                alt="Uni Logo">
                        </td>
                        <td colspan="2" class="university-logo" style="text-align: center;">Specialized Fee Challan Form
                            Shifa Tameer-e-Millat University
                            {{ $data['collegeName'] }}
                            (Deposit Slip Dept. Copy)</td>
                        @if ($data['isInternational'])
                            <td class="bank-logo"><img style="max-width: 60px; height: auto;" src="{{ asset('assets/img/2560px-Al_Baraka_logo.png') }}"
                                    alt="Bank Logo"></td>
                            @else
                            
                            <td class="bank-logo"><img style="max-width: 60px; height: auto; margin-left:5px" src="{{ asset('assets/img/hbl-logo.png') }}"
                                    alt="Bank Logo"></td>
                        @endif
                    </tr>
                    <tr>
                        <td><b>Ch./Receipt/Slip No:</b></td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Issue Date: </td>
                        <td> {{ $data['date'] }}</td>
                        <td>Due Date:</td>
                        <td>{{ $data['dueDate'] }} </td>
                    </tr>
                    <tr>
                        <td>Credit to: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['AccountTitle'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Collection Account#: </td>
                        <td colspan="3"> <b>{{ $data['bankAccountNumber'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Instrument Type: </td>
                        <td colspan="3">Cash<span class="custom-box"></span> PO/DD<span class="custom-box"></span>
                            Any other<span class="custom-box"></span></td>
                    </tr>
                    <tr>
                        <td>Instrument No: </td>
                        <td></td>
                        <td colspan="2">Date:</td>
                    </tr>
                    <tr>
                        <td>Drawn on Bank / Branch:</td>
                        <td></td>
                        <td colspan="2">Amount <span class="currency-symbol">{{ $data['currency'] }}</span>
                            {{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>In Words</td>
                        <td colspan="3" class="content-cell">{{ $data['amountInWords'] }}</td>
                    </tr>
                    @if ($data['isInternational'] && isset($data['bankDetails']['swiftCode']))
                        <tr>
                            <td>SWIFT Code:</td>
                            <td colspan="3">{{ $data['bankDetails']['swiftCode'] }}</td>
                        </tr>
                        <tr>
                            <td>IBAN:</td>
                            <td colspan="3" class="content-cell">{{ $data['bankDetails']['iban'] }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Depositors CNIC:
                            Depositors Signature: :</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center;">Official Stamp</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Bank's Teller </td>
                        <td></td>
                        <td></td>
                        <td>Bank's Officer</td>
                    </tr>
                    <tr>
                        <td>Registration No:</td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['studentName'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Program: </td>
                        <td class="content-cell" style="font-size: 6px;"> <b>{{ $data['programName'] }}</b></td>
                        <td>Semester/Year: </td>
                        <td> <b>{{ $data['pyear'] }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Particulars </td>
                        <td>Amount ({{ $data['currency'] }})</td>
                        <td>Total ({{ $data['currency'] }})</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tution Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Admission Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Hostel Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Application Fee </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Examination Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Prospectus Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Medical Checkup Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Registration Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Other (Specify) </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Late Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Remarks </td>
                        <td colspan="2" class="content-cell">
                            @if (isset($data['foreignNote']))
                                {{ $data['foreignNote'] }}
                            @else
                                None
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 8px;">
                            Please deposit this challan to any branch of the bank within the due date.
                            <br />
                            After the due date, an additional fine will be charged as per the university policy.
                            <br />
                            Keep the deposit slip safe as proof of payment.
                            <br />
                            This is a computer-generated document and does not require any signature.
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Student Copy -->
            <div class="col-md-4">
                <table>
                    <tr>
                        <td class="bank-logo"><img style="max-width: 60px; height: auto;" src="{{ $data['uniLogo'] }}"
                                alt="Bank Logo"></td>
                        <td colspan="2" class="university-logo" style="text-align: center;">Specialized Fee Challan
                            Form
                            Shifa Tameer-e-Millat University
                            {{ $data['collegeName'] }}
                            (Deposit Slip Student Copy)</td>
                        @if ($data['isInternational'])
                            <td class="bank-logo"><img style="max-width: 60px; height: auto;" src="{{ asset('assets/img/2560px-Al_Baraka_logo.png') }}"
                                    alt="Bank Logo"></td>
                            @else
                            <td class="bank-logo"><img style="max-width: 60px; height: auto; margin-left:5px" src="{{ asset('assets/img/hbl-logo.png') }}"
                                    alt="Bank Logo"></td>
                        @endif
                    </tr>
                    <tr>
                        <td> <b>Ch./Receipt/Slip No:</b></td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Issue Date: </td>
                        <td> {{ $data['date'] }}</td>
                        <td>Due Date:</td>
                        <td>{{ $data['dueDate'] }} </td>
                    </tr>
                    <tr>
                        <td>Credit to: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['AccountTitle'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Collection Account#: </td>
                        <td colspan="3"> <b>{{ $data['bankAccountNumber'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Instrument Type: </td>
                        <td colspan="3">Cash<span class="custom-box"></span> PO/DD<span class="custom-box"></span>
                            Any other<span class="custom-box"></span></td>
                    </tr>
                    <tr>
                        <td>Instrument No: </td>
                        <td></td>
                        <td colspan="2">Date:</td>
                    </tr>
                    <tr>
                        <td>Drawn on Bank / Branch:</td>
                        <td></td>
                        <td colspan="2">Amount <span class="currency-symbol">{{ $data['currency'] }}</span>
                            {{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>In Words</td>
                        <td colspan="3" class="content-cell">{{ $data['amountInWords'] }}</td>
                    </tr>
                    @if ($data['isInternational'] && isset($data['bankDetails']['swiftCode']))
                        <tr>
                            <td>SWIFT Code:</td>
                            <td colspan="3">{{ $data['bankDetails']['swiftCode'] }}</td>
                        </tr>
                        <tr>
                            <td>IBAN:</td>
                            <td colspan="3" class="content-cell">{{ $data['bankDetails']['iban'] }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Depositors CNIC:
                            Depositors Signature: :</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center;">Official Stamp</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Bank's Teller </td>
                        <td></td>
                        <td></td>
                        <td>Bank's Officer</td>
                    </tr>
                    <tr>
                        <td>Registration No:</td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['studentName'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Program: </td>
                        <td class="content-cell" style="font-size: 6px;"> <b>{{ $data['programName'] }}</b></td>
                        <td>Semester/Year: </td>
                        <td> <b>{{ $data['pyear'] }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Particulars </td>
                        <td>Amount ({{ $data['currency'] }})</td>
                        <td>Total ({{ $data['currency'] }})</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tution Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Admission Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Hostel Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Application Fee </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Examination Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Prospectus Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Medical Checkup Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Registration Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Other (Specify) </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Late Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Remarks </td>
                        <td colspan="2" class="content-cell">
                            @if (isset($data['foreignNote']))
                                {{ $data['foreignNote'] }}
                            @else
                                None
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 8px;">
                            Please deposit this challan to any branch of the bank within the due date.
                            <br />
                            After the due date, an additional fine will be charged as per the university policy.
                            <br />
                            Keep the deposit slip safe as proof of payment.
                            <br />
                            This is a computer-generated document and does not require any signature.
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Bank Copy -->
            <div class="col-md-4">
                <table>
                    <tr>
                        <td class="bank-logo"><img style="max-width: 60px; height: auto;"
                                src="{{ $data['uniLogo'] }}" alt="Bank Logo"></td>
                        <td colspan="2" class="university-logo" style="text-align: center;">Specialized Fee
                            Challan Form
                            Shifa Tameer-e-Millat University
                            {{ $data['collegeName'] }}
                            (Deposit Slip Bank Copy)</td>
                        @if ($data['isInternational'])
                            <td class="bank-logo"><img style="max-width: 60px; height: auto;" src="{{ asset('assets/img/2560px-Al_Baraka_logo.png') }}"
                                    alt="Bank Logo"></td>
                            @else
                            <td class="bank-logo"><img style="max-width: 60px; height: auto; margin-left:5px" src="{{ asset('assets/img/hbl-logo.png') }}"
                                    alt="Bank Logo"></td>
                        @endif
                    </tr>
                    <tr>
                        <td> <b>Ch./Receipt/Slip No:</b></td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Issue Date: </td>
                        <td> {{ $data['date'] }}</td>
                        <td>Due Date:</td>
                        <td>{{ $data['dueDate'] }} </td>
                    </tr>
                    <tr>
                        <td>Credit to: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['AccountTitle'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Collection Account#: </td>
                        <td colspan="3"> <b>{{ $data['bankAccountNumber'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Instrument Type: </td>
                        <td colspan="3">Cash<span class="custom-box"></span> PO/DD<span class="custom-box"></span>
                            Any other<span class="custom-box"></span></td>
                    </tr>
                    <tr>
                        <td>Instrument No: </td>
                        <td></td>
                        <td colspan="2">Date:</td>
                    </tr>
                    <tr>
                        <td>Drawn on Bank / Branch:</td>
                        <td></td>
                        <td colspan="2">Amount <span class="currency-symbol">{{ $data['currency'] }}</span>
                            {{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>In Words</td>
                        <td colspan="3" class="content-cell">{{ $data['amountInWords'] }}</td>
                    </tr>
                    @if ($data['isInternational'] && isset($data['bankDetails']['swiftCode']))
                        <tr>
                            <td>SWIFT Code:</td>
                            <td colspan="3">{{ $data['bankDetails']['swiftCode'] }}</td>
                        </tr>
                        <tr>
                            <td>IBAN:</td>
                            <td colspan="3" class="content-cell">{{ $data['bankDetails']['iban'] }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Depositors CNIC:
                            Depositors Signature: :</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center;">Official Stamp</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Bank's Teller </td>
                        <td></td>
                        <td></td>
                        <td>Bank's Officer</td>
                    </tr>
                    <tr>
                        <td>Registration No:</td>
                        <td colspan="3" style="text-align: left; border-right: 1px solid #000;">
                            <b>{{ $data['voucherID'] }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name: </td>
                        <td colspan="3" class="content-cell"> <b>{{ $data['studentName'] }}</b></td>
                    </tr>
                    <tr>
                        <td>Program: </td>
                        <td class="content-cell" style="font-size: 6px;"> <b>{{ $data['programName'] }}</b></td>
                        <td>Semester/Year: </td>
                        <td> <b>{{ $data['pyear'] }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Particulars </td>
                        <td>Amount ({{ $data['currency'] }})</td>
                        <td>Total ({{ $data['currency'] }})</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tution Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Admission Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Hostel Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Application Fee </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Examination Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Prospectus Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Medical Checkup Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Registration Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Other (Specify) </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Late Fee </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total </td>
                        <td>{{ $data['totalAmount'] }}</td>
                        <td>{{ $data['totalAmount'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Remarks </td>
                        <td colspan="2" class="content-cell">
                            @if (isset($data['foreignNote']))
                                {{ $data['foreignNote'] }}
                            @else
                                None
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center; font-size: 8px;">
                            Please deposit this challan to any branch of the bank within the due date.
                            <br />
                            After the due date, an additional fine will be charged as per the university policy.
                            <br />
                            Keep the deposit slip safe as proof of payment.
                            <br />
                            This is a computer-generated document and does not require any signature.
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
