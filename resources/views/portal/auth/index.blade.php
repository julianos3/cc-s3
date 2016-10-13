@extends('portal-auth')

@section('content')


    <body class="page-login-v2 layout-full page-dark">
    <!--[if lt IE 8]>
    <p class="browserupgrade">
        Você esta usando um navegador <strong>desatualizado.</strong> Por favor,
        <a href="http://browsehappy.com/">atualize seu navegador</a> para melhorar a sua experiência.
    </p>
    <![endif]-->
    <div class="page animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
            <div class="page-brand-info">
                <div class="brand">
                    <img class="brand-img" src="{!! 'assets/images/logo@2x.png' !!}" alt="...">
                    <h2 class="brand-text font-size-40">Remark</h2>
                </div>
                <p class="font-size-20">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.]
                </p>
            </div>
            <div class="page-login-main">
                <div class="brand visible-xs">
                    <img class="brand-img" src="{!! 'assets/images/logo-blue@2x.png' !!}" alt="...">
                    <h3 class="brand-text font-size-40">Central Condo</h3>
                </div>
                <h3 class="font-size-24">Login</h3>
                <form method="post" action="">
                    <div class="form-group">
                        <label class="sr-only" for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="inputPassword">Senha</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
                            <input type="checkbox" id="remember" name="checkbox">
                            <label for="inputCheckbox">Lembrar senha</label>
                        </div>
                        <a class="pull-right" href="">Esqueceu a senha?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <p>Não tem uma conta? <a href="{!! 'portal.auth.register' !!}">Assine aqui</a></p>
                <footer class="page-copyright">
                    <p>© 2016. Todos os direitos reservados.</p>
                    <div class="social">
                        <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
                            <i class="icon bd-twitter" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
                            <i class="icon bd-facebook" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
                            <i class="icon bd-google-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </div>

@endsection