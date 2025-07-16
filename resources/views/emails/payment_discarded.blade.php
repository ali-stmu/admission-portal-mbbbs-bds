<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment Discarded</title>
</head>

<body>
    <p>Dear Applicant,</p>

    <p>Your application (App ID: {{ $appId }}) for {{ $program }} program has been reviewed, but the payment
        was **discarded** by the Admission Office.</p>

    <p><strong>Reason:</strong> {{ $remarks }}</p>

    <p>You can now edit your application and upload a corrected payment proof or rectify any issues mentioned above.</p>

    <p>Regards,<br>
        Admission Office</p>
</body>

</html>
