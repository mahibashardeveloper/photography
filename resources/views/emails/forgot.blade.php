<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Test</title>
    <link rel="shortcut icon" href="{{asset('/images/logo.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
</head>
<body>
<div class="text-center">.
    <div>Hello, <strong>{{$userInfo->name}}</strong></div>
    <h5>Your Reset code is:</h5>
    <h1>{{$userInfo->reset_code}}</h1>
</div>
</body>
</html>
