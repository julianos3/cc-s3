@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.communication.index') }}">Comunicação</a></li>
                <li><a href="{{ route('portal.communication.communication.index') }}">Chamados</a></li>
                <li class="active">Visualizar</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.communication.communication.index') }}"
                   class="btn btn-sm btn-icon btn-dark waves-effect waves-light waves-round" data-toggle="tooltip"
                   data-original-title="Voltar">
                    <i class="icon wb-arrow-left" aria-hidden="true"></i>
                    Voltar
                </a>
            </div>
        </div>
        <div class="page-content container-fluid">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="codigo"><strong>Código</strong></label>
                            <p class="form-control-static">Nº: {{ $dados->id}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo"><strong>Criado Por</strong></label>
                            <p class="form-control-static">{{ $dados->usersCondominium->user->name.' | '.$dados->usersCondominium->userRoleCondominium->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo"><strong>Data Criado</strong></label>
                            <p class="form-control-static">{{ date('d/m/Y', strtotime($dados->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="codigo"><strong>Visivel até</strong></label>
                            <p class="form-control-static">{{ date('d/m/Y', strtotime($dados->date_display)) }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo"><strong>Enviado por e-mail?</strong></label>
                            <p class="form-control-static">@if($dados->send_mail == 's') Sim @else Não @endif</p>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo"><strong>Todos os usuários?</strong></label>
                            <p class="form-control-static">@if($dados->all_user == 's') Sim @else Somente Grupos @endif</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="codigo"><strong>Título</strong></label>
                            <p class="form-control-static">{{ $dados->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="codigo"><strong>Descrição</strong></label>
                            <p class="form-control-static">{{ $dados->description }}</p>
                        </div>
                    </div>
                    @if($dados->all_user == 'n')
                    <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="tablesaw table-striped table-bordered table-hover"
                                       data-tablesaw-mode="swipe"
                                       data-tablesaw-sortable data-tablesaw-minimap>
                                    <thead>
                                        <tr>
                                            <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                                data-tablesaw-priority="persist">Grupos
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($communicationGroup  as $row)
                                        <tr>
                                            <td>{{ $row->groupCondominium->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if(!$usersCommunication->isEmpty())
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="tablesaw table-striped table-bordered table-hover"
                                   data-tablesaw-mode="swipe"
                                   data-tablesaw-sortable data-tablesaw-minimap>
                                <thead>
                                <tr>
                                    <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                        data-tablesaw-priority="persist">Integrantes
                                    </th>
                                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">E-mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usersCommunication  as $row)
                                    <tr>
                                        <td>{{ $row->usersCondominium->user->name }}</td>
                                        <td>{{ $row->usersCondominium->user->email }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection