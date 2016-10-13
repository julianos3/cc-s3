@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.manage.index') }}">Administrar</a></li>
                <li><a href="{{ route('portal.manage.reserve-areas.index') }}">Recurso Comum</a></li>
                <li class="active">Cadastrar</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.manage.reserve-areas.index') }}"
                   class="btn btn-sm btn-icon btn-dark waves-effect waves-light waves-round" data-toggle="tooltip"
                   data-original-title="Voltar">
                    <i class="icon wb-arrow-left" aria-hidden="true"></i>
                    Voltar
                </a>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body">
                    @include('success._check')
                    @include('errors._check')

                    <?php $block_id = 0; ?>

                    {!! Form::open(['route'=>'portal.manage.reserve-areas.store']) !!}

                    @include('portal.manage.reserve-areas._form')

                    <div class="form-group text-right">
                        {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection