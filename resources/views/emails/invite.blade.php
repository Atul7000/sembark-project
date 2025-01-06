<!DOCTYPE html>
<html>
<head>
    <title>You're Invited!</title>
</head>
<body>
    <p>Hello,</p>
    <p>You have been invited to join our platform. Click the link below to accept the invitation:</p>
    <p><a href="{{ url('/signup?token=' . $invitation['token']) }}">Accept Invitation</a></p>
    <p>This link will expire in 30 minutes.</p>
    <p>Thank you!</p>
</body>
</html>
