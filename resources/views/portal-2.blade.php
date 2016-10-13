<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Central Condo</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuários<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/user') }}">Usuários</a>
                        <li><a href="{{ url('/portal/user/role') }}">Níveis</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Condominios<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/condominium') }}">Condominios</a>
                        <li><a href="{{ url('/portal/condominium/finality') }}">Finalidade</a></li>
                        <li><a href="{{ url('/portal/condominium/role') }}">Níveis</a></li>
                        <li><a href="{{ url('/portal/condominium/user') }}">Usuários</a></li>
                        <li><a href="{{ url('/portal/condominium/group') }}">Grupos de Ingrantes</a></li>
                        <li><a href="{{ url('/portal/condominium/useful-phones') }}">Telefones Úteis</a></li>
                        <li><a href="{{ url('/portal/condominium/security-cam') }}">Câmeras de Segurança</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Unidades<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/unit') }}">Unidades</a>
                        <li><a href="{{ url('/portal/unit/type') }}">Tipos</a></li>
                        <li><a href="{{ url('/portal/unit/user') }}">Usuários</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blocos<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/block') }}">Blocos</a>
                        <li><a href="{{ url('/portal/block/nomemclature') }}">Nomemclaturas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/diary') }}">Agenda</a>
                        <li><a href="{{ url('/portal/diary/reserve-areas') }}">Áreas de Reserva</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fornecedores<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/provider') }}">Fornecedores</a>
                        <li><a href="{{ url('/portal/provider/category') }}">Categoria</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Chamados<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/portal/called') }}">Chamados</a>
                        <li><a href="{{ url('/portal/called/category') }}">Categoria</a></li>
                        <li><a href="{{ url('/portal/called/status') }}">Status</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/portal/forum') }}">Forum</a></li>
                <li><a href="{{ url('/portal/message') }}">Mensagens</a></li>
                <li><a href="{{ url('/portal/communication') }}">Comunicados</a></li>
                <li><a href="{{ url('/portal/lost-and-found') }}">Achados e Perdidos</a></li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/vendor/artesaos/cidades/js/scripts.js"></script>

@yield('post-script')
</body>
</html>
