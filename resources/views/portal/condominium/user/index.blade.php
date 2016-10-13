@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li class="active">Integrantes</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body">
                    <form class="page-search-form" role="search" style="display:none;">
                        <div class="input-search input-search-dark">
                            <i class="input-search-icon md-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" id="inputSearch" name="search"
                                   placeholder="Buscar Usuários">
                            <button type="button" class="input-search-close icon md-close" aria-label="Close"></button>
                        </div>
                    </form>

                    @include('success._check')
                    @include('errors._check')
                    @include('portal.delete')

                    <a href="{{ route('portal.condominium.user.create') }}"
                       data-toggle="tooltip"
                       data-original-title="Cadastrar"
                       class="btn btn-primary waves-effect waves-light">
                        <i class="icon wb-plus" aria-hidden="true"></i>
                        Cadastrar
                    </a>

                    <div class="nav-tabs-horizontal">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li class="active" role="presentation">
                                <a data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">
                                    Todos
                                </a>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <span class="caret"></span>Contacts </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a data-toggle="tab" href="#all_contacts"
                                                               aria-controls="all_contacts"
                                                               role="tab">Todos</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane animation-fade active" id="all_contacts" role="tabpanel">

                                <ul class="list-group">
                                    @foreach($dados as $row)
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="media-left col-md-1">
                                                        <?php
                                                            if($row->user->imagem){
                                                                $imgAvatar = route('portal.condominium.user.image', ['id' => $row->user->id, 'image' => $row->user->imagem]);
                                                            }else{
                                                                $imgAvatar = asset('portal/global/portraits/1.jpg');
                                                            }
                                                        ?>
                                                        <div class="avatar" style="height: 40px; background: url('{{ $imgAvatar }}') top center; background-size: cover;">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h4 class="media-heading">
                                                            {{ $row->user->name }}
                                                            <small>{{ $row->userRoleCondominium->name }}</small>
                                                        </h4>
                                                        @if($row->usersUnit->toArray())
                                                            <p>
                                                                <i class="icon icon-color md-pin" aria-hidden="true"></i>
                                                                <?php
                                                                $cont = 0;
                                                                foreach ($row->usersUnit as $unit) {
                                                                    $cont++;
                                                                    if ($cont > 1) {
                                                                        echo ', ';
                                                                    }
                                                                    echo $unit->unit->name . ' - ' . $unit->unit->block->name;
                                                                }
                                                                ?>
                                                            </p>
                                                        @endif
                                                        <div>
                                                            <a class="text-action" href="enviar para tela de mensagem}">
                                                                <i class="icon icon-color md-email" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="text-action" href="{{ $row->user->phone }}">
                                                                <i class="icon icon-color md-smartphone"
                                                                   aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-right text-center col-md-3">
                                                        <a href="{{ route('portal.condominium.user.show',['id' => $row->id]) }}"
                                                           title="Visualizar"
                                                           class="btn btn-icon bg-success waves-effect waves-light waves-effect waves-light">
                                                            <i class="icon wb-zoom-in" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{ route('portal.condominium.user.edit', ['id' => $row->id]) }}"
                                                           title="Editar"
                                                           class="btn btn-icon bg-warning waves-effect waves-light">
                                                            <i class="icon wb-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <button title="Excluir"
                                                                class="btn btn-icon bg-danger waves-effect waves-light btnDelete"
                                                                data-target="#modalDelete" data-toggle="modal"
                                                                data-route="{{ route('portal.condominium.user.destroy', ['id' => $row->id]) }}">
                                                            <i class="icon wb-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        {!! $dados->setPath('')->appends(Request::except('page'))->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('portal.condominium.user.create') }}" title="Cadastrar"
       class="site-action site-floataction btn-raised btn btn-success btn-floating"
       data-toggle="tooltip"
       data-original-title="Cadastrar">
        <i class="icon md-plus" aria-hidden="true"></i>
    </a>

@endsection