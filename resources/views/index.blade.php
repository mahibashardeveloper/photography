<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photography</title>
    <link rel="shortcut icon" href="{{asset('/images/logo.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <script>
        window.core = {
            @if(auth()->check())
            UserInfo: {!! auth()->user() !!},
            @else
            UserInfo: null
            @endif
        }
    </script>
</body>
@vite('resources/js/app.js')
</html>
