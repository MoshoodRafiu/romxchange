<html>
<head>
    <style>
        .header{
            background-color: #212529;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: #fed136;
        }
        p{
            color: #2a2525;
        }
        .ace{
            font-size: 25px;
            color: #fff;
        }
    </style>
</head>
    <body>
        <div class="header">
            <h1>Ace<span class="ace">X</span>world</h1>
        </div>
        <p>Hi {{ \App\User::where('email', $email)->first()->display_name }},</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>

        <p><a href="{{ url('password/reset/'.$token.'?email='.$email) }}">Click Here</a> to reset password</p>
        <p>This password reset link will expire in 60 minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>

        <p>Regards,</p>
        <p>AcexWorld</p>

        <p>If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: </p>
        <a href="{{ url('password/reset/'.$token.'?email='.$email) }}">{{ url('password/reset/'.$token.'?email='.$email) }}</a>
    </body>
</html>
