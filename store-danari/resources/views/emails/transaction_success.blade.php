<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Successful</title>
</head>

<body>
    <h1>Transaction Successful</h1>
    <p>Dear {{ $transaction->user->name }},</p>
    <p>Your transaction with ID: {{ $transaction->code }} has been successfully processed.</p>
    <p>Thank you for your purchase!</p>
    <p>Best regards,</p>
    <p>Your Company</p>
</body>

</html>
