<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <center>
        <div>
            <div>
                <span style="font-weight: bold">Student Name:</span>
                <span style="margin-left: 10px;">{{ $bill->billable->full_name }}</span>
            </div>
            <div>
                <span style="font-weight: bold">Student Class:</span>
                <span style="margin-left: 10px;">{{ $bill->billable->class->name }}</span>
            </div>
            <div>
                <span style="font-weight: bold">Bill Code:</span>
                <span style="margin-left: 10px;">{{ $bill->bill_code }}</span>
            </div>
            <div>
                <span style="font-weight: bold">Total Amount:</span>
                <span style="margin-left: 10px;">{{ $bill->amount }}</span>
            </div>
            @if($bill->type)
                <div>
                    <span style="font-weight: bold">Type:</span>
                    <span style="margin-left: 10px;">{{ $bill->type }}</span>
                </div>
            @endif
            <div>
                <hr style="width: 40%">
            </div>
            @foreach($payments as $payment)
                <div>
                    <span style="font-weight: bold">Amount Paid:</span>
                    <span style="margin-left: 10px;">{{ $payment->amount_paid }}</span>
                </div>
                <div>
                    <span style="font-weight: bold">Paid By:</span>
                    <span style="margin-left: 10px;">{{ $payment->payer_name }}</span>
                </div>
                @if($payment->payer_mobile_number)
                    <div>
                        <span style="font-weight: bold">Payer Mobile Number:</span>
                        <span style="margin-left: 10px;">{{ $payment->payer_mobile_number }}</span>
                    </div>
                @endif
                <div>
                    <span style="font-weight: bold">Received By:</span>
                    <span style="margin-left: 10px;">{{ $payment->addedBy->name }}</span>
                </div>
                <div>
                    <span style="font-weight: bold">Date:</span>
                    <span style="margin-left: 10px;">{{ $payment->created_at }}</span>
                </div>
                <div>
                    <hr style="width: 40%">
                </div>
            @endforeach
        </div>
    </center>
</body>
</html>
