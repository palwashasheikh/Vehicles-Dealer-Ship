<!-- resources/views/emails/invitation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Invitation</title>
</head>
<body>
    <h1>You are invited!</h1>
    <p>Click the link below to accept the invitation:</p>
    <a href="{{ url('/accept-invitation/' . $invitation->token) }}">Accept Invitation</a>
</body>
</html>
