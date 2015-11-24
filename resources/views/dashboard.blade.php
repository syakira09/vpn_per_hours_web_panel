<html>
<head>
    <meta charset="UTF-8">
    <title>VPN hourly</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('')}}/css/materialize.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('')}}/js/bin/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<nav>
    <div class="nav-wrapper  green darken-1">
        <a href="#!" class="brand-logo"><img src="images/lock.png"></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ URL::to('dashboard')}}">VPN Servers</a></li>
            <li><a href="{{ URL::to('vpnusers')}}">VPN Users</a></li>
            <li><a href="#!">Credit</a></li>
            <li><a href="#!">My account</a></li>
            <li><a href="{{ URL::to('logout')}}">Log out</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ URL::to('dashboard')}}">VPN Servers</a></li>
            <li><a href="{{ URL::to('vpnusers')}}">VPN Users</a></li>
            <li><a href="#!">Credit</a></li>
            <li><a href="#!">My account</a></li>
            <li><a href="{{ URL::to('logout')}}">Log out</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script>
    $( document ).ready(function(){
        $('select').material_select();
    })

</script>
</body>
</html>