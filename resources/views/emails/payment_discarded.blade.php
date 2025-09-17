<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment Discarded</title>
</head>

<body>
    <p>Dear Applicant,</p>

    <p>Your application (App ID: {{ $appId }}) for {{ $program }} program has been reviewed, but the payment
        was **discarded** by the Admission Office. </p>

    <p><strong>Reason:</strong> {{ $remarks }} due to missing or unclear payment proof</p>

    <p>Kindly send your payment proof directly to mbbsadmissions2023.scm@stmu.edu.pk before 3rd September 2025.</p>

    <p>Regards,<br>
        Admission Office</p>
</body>

</html>
