@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.manage.index') }}">Administrar</a></li>
                <li><a href="{{ route('portal.manage.maintenance.index') }}">Manutenções Preventivas</a></li>
                <li class="active">Alterar</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.manage.maintenance.index') }}"
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

                    {!! Form::model($dados, ['route'=>['portal.manage.maintenance.update', $dados->id], 'files' => true]) !!}

                    @include('portal.manage.maintenance._form')

                    <div class="form-group text-right">
                        {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection