@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li><a href="{{ route('portal.condominium.user.index') }}">Integrantes</a></li>
                <li class="active">Alterar</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.condominium.user.index') }}"
                   class="btn btn-sm btn-icon btn-dark waves-effect waves-light waves-round"
                   data-toggle="tooltip"
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
                    @include('portal.delete')

                    {!! Form::model($dados, ['route'=> ['portal.condominium.user.update', $dados->id], 'files' => true]) !!}
                    <div class="example-wrap margin-lg-0">
                        <div class="nav-tabs-horizontal">
                            <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" href="javascript:void(0);" aria-controls="tabDadosPessoais" role="tab">
                                        Dados Pessoais
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{ route('portal.condominium.user.unit', ['id'=> $id]) }}" aria-controls="tabUnit" role="tab">
                                        Unidades
                                    </a>
                                </li>
                                <!--
                                <li role="presentation">
                                    <a data-toggle="tab" href="#exampleTabsLineThree" aria-controls="exampleTabsLineThree" role="tab">
                                        Veículos
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#exampleTabsLineFour" aria-controls="exampleTabsLineFour" role="tab">
                                        Animais
                                    </a>
                                </li>
                                -->
                                <li class="dropdown" role="presentation">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <span class="caret"></span>
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="active" role="presentation">
                                            <a data-toggle="tab" href="#exampleTabsLineOne" aria-controls="exampleTabsLineOne" role="tab">
                                                Dados pessoais
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a data-toggle="tab" href="#exampleTabsLineTwo" aria-controls="exampleTabsLineTwo" role="tab">
                                                Unidades
                                            </a>
                                        </li>
                                        <!--
                                        <li role="presentation">
                                            <a data-toggle="tab" href="#exampleTabsLineThree" aria-controls="exampleTabsLineThree" role="tab">
                                                Veículos
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a data-toggle="tab" href="#exampleTabsLineFour" aria-controls="exampleTabsLineFour" role="tab">
                                                Animais
                                            </a>
                                        </li>
                                        -->
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content padding-top-20">
                                <div class="tab-pane active" id="tabDadosPessoais" role="tabpanel">
                                    @include('portal.condominium.user.edit._form_dados_pessoais')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection