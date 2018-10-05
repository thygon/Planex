<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Event Planning</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

     #app{
        height: 100vh;
        position: relative;;
        width: 100%;
        background: #ccc;
        color:#c16d00;
     }
     .info{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
     }
     .info h1,p{
        font-size: 60px;
     }
        
    </style>
</head>
<body>
    <div id="app">
        <div class="info text-center">
            <p>Event Planning</p>
            <h1> Error 404</h1>
            <a class="btn btn-primary" href="{{route('home')}}">Back Home</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
