<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Информация по номерам, объявления avito olx, кто звонил">
    <meta name="google-site-verification" content="VV9bmebiiRr7gowflQmVPAl7AtC3WqIOazPBETWc-3k"/>
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-material-design.min.css" rel="stylesheet">
    <link href="/css/ripples.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ env('APP_URL') }}">
                    Информация по номерам
                </a>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/material.min.js"></script>
@include('metrika')
<div style="color: rgba(0,0,0,0.4); font-size: x-small">098e29b339e6485db77c733599e2005b</div>
</body>
</html>