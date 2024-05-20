<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
</head>

<body>
    <h1>Reset Password</h1>

    <p>{{ $data['email'] }}</p>
    <a href="{{ $data['url'] }}">Click the link to reset Password</a>

</body>

</html>
