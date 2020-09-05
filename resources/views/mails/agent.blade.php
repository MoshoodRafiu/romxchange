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
<p>You have been invited to Acexworld as an agent.</p>
<p>Please check for your details below and login.</p>
<p>Email: {{ $email_data['email'] }}</p>
<p>Password: {{ $email_data['password'] }}</p>

<p><a href="{{ url('/login') }}">Click Here</a> to login to your account</p>

<p>Regards,</p>
<p>AcexWorld</p>

<p>If you’re having trouble clicking the "Click here" link, copy and paste the URL below into your web browser: </p>
<a href="{{ url('/login') }}">{{ url('/login') }}</a>
</body>
</html>

