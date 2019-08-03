<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BCAS</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <div id="app"></div>
        <div id='v-login'>
            <nav class="navbar navbar-expand-lg text-white" id='login-nav'>
                <h2><a class="navbar-brand" href="{{route('login-navigate')}}"><b>BRMS</b></a></h2>
            </nav>
            <div id="login-navigator" class="d-flex justify-content-center  align-items-center">
                <div class="bg-danger mx-2 d-flex justify-content-center  align-items-center"><a href="/admin">Admin</a></div>
                {{-- <div class="bg-danger mx-2 d-flex justify-content-center  align-items-center"><a href="/lecturer">Lecturer</a></div> --}}
                <div class="bg-danger mx-2 d-flex justify-content-center  align-items-center"><a href="/operator">Operator</a></div>
            </div>
            <footer id='footer' class="text-white">
                <p class="my-0 ">© British College of Applied Studies All Rights Reserved.</p>
            </footer>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
