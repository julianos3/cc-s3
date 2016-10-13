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
                    <img class="brand-img" src="{{ asset('portal/assets/images/logo@2x.png') }}" width="500"
                         alt="Central Condo">
                </div>
                <p class="font-size-20">
                    A gestão do seu condomínio na palma da sua mão
                </p>
            </div>
            <div class="page-login-main">
                <div class="brand visible-xs">
                    <img class="brand-img" src="{{ asset('portal/assets/images/logo.png') }}" alt="Central Condo">
                    <h3 class="brand-text font-size-40">Central Condo</h3>
                </div>
                <h3 class="font-size-24">Cadastro</h3>
                <p>Preencha as informações abaixo para iniciar seu cadastro.</p>

                @include('errors._check')

                {!! Form::open(['route'=>'auth.register', 'role' => 'form', 'autocomplete' => 'off']) !!}

                @include('auth._form_register')

                <div class="form-group">
                    {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-primary btn-block']) !!}
                </div>

                {!! Form::close() !!}

                <p>Já possui uma conta? Por favor faça seu <a href="{{ route('auth.login') }}">Login</a></p>

                <footer class="page-copyright">
                    <p>© 2016. {{ trans('validation.attributes.all-right-reserved') }}</p>
                    <div class="social">
                        <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
                            <i class="icon bd-twitter" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
                            <i class="icon bd-facebook" aria-hidden="true"></i>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!--
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('validation.attributes.register') }}</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
                                    @endforeach
            </ul>
        </div>
    @endif

            <form class="form-horizontal" role="form" method="POST" action="/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ trans('validation.attributes.name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ trans('validation.attributes.confirmpassword') }}</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('validation.attributes.register') }}
            </button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
-->
@endsection