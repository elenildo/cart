<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <title>Loja Virtual @yield('page_title')</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper light-blue row">
                <a href="{{ route('homepage') }}" class="brand-logo col offset-11">Loja Virtual</a>
                <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    @if (Auth::guest())
                    <li><a href="{{ url('/login')}}">Entrar</a></li>
                    <li><a href="{{ url('/register')}}">Cadastrar-se</a></li>
                    @else
                    <li><a href="#" class="dropdown-button" data-activates="dropdown-user">Olá, {{ Auth::user()->name}}! 
                        <i class="material-icons right">arrow-drop-down</i></a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>