@extends('portal-auth')

@section('content')
    <body class="page-forgot-password layout-full">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
            href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
         data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
            <h2>Esqueceu sua senha?</h2>
            <p>Insira seu e-mail cadastrado para redefinir sua senha</p>
            <form method="post" role="form">
                <div class="form-group">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Seu E-mail">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Redefinir sua senha</button>
                </div>
            </form>
            <footer class="page-copyright">
                <p>© 2016. Todos os direitos reservados.</p>
                <div class="social">
                    <a href="javascript:void(0)">
                        <i class="icon bd-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon bd-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon bd-dribbble" aria-hidden="true"></i>
                    </a>
                </div>
            </footer>
        </div>
    </div>
@endsection