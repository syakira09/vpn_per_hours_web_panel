<html>
    <head>
        <meta charset="UTF-8">
        <title>VPN hourly</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('')}}/css/materialize.css">
    </head>

    <body>

        <nav>
            <div class="nav-wrapper  green darken-1">
                <a href="#!" class="brand-logo"><img src="images/lock.png"></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#!">Prcing</a></li>
                    <li><a href="#!">Features</a></li>
                    <li><a href="#!">Help</a></li>
                    <li><a href="{{ URL::to('login')}}">Log In</a></li>
                    <li><a href="{{ URL::to('register')}}">Sign up</a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="#!">Prcing</a></li>
                    <li><a href="#!">Features</a></li>
                    <li><a href="#!">Help</a></li>
                    <li><a href="{{ URL::to('login')}}">Log In</a></li>
                    <li><a href="{{ URL::to('register')}}">Sign up</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="{{ URL::to('')}}/js/bin/materialize.js"></script>
        <script>
            $( document ).ready(function(){
                $(".button-collapse").sideNav();
            })

        </script>
    </body>
</html>
