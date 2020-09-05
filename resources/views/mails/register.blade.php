<html>
<head>
    <style>
    </style>
</head>
<body>
<div class="header">
    <h1>Acexworld</h1>
</div>
<p>Hello {{ $email_data['display_name'] }},</p>
<p>Welcome to Acexworld</p>
<p>Please verify your email and activate your account.</p>

<p><a href="{{ url('/verify?code='.$email_data['verification_code']) }}">Click Here</a> to verify your account</p>

<p>Regards,</p>
<p>AcexWorld</p>

<p>If you’re having trouble clicking the "Click here" link, copy and paste the URL below into your web browser: </p>
<a href="{{ url('/verify?code='.$email_data['verification_code']) }}">{{ url('/verify?code='.$email_data['verification_code']) }}</a>
</body>
</html>

