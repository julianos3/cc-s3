@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li><a href="{{ route('portal.condominium.user.index') }}">Integrantes</a></li>
                <li class="active">Unidades</li>
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

                    <div class="example-wrap margin-lg-0">
                        <div class="nav-tabs-horizontal">
                            <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                                <li>
                                    <a href="{{ route('portal.condominium.user.edit', ['id'=> $dados->id]) }}">
                                        Dados Pessoais
                                    </a>
                                </li>
                                <li class="active" role="presentation">
                                    <a href="{{ route('portal.condominium.user.unit', ['id'=> $dados->id]) }}"
                                       data-toggle="tab" href="#tabUnit" aria-controls="exampleTabsLineTwo" role="tab">
                                        Unidades
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content padding-top-20">
                                <div class="tab-pane active" id="tabUnit" role="tabpanel">
                                    @include('portal.condominium.user.edit._form_unit')


                                    <hr/>
                                    <h4>Minhas Unidades</h4>

                                    <div class="row lisUnit">
                                        @if(!$units->isEmpty())
                                            <div class="col-md-12">
                                                <table class="tablesaw table-striped table-bordered table-hover"
                                                       data-tablesaw-mode="swipe"
                                                       data-tablesaw-sortable data-tablesaw-minimap>
                                                    <thead>
                                                    <tr>
                                                        <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                                            data-tablesaw-priority="persist">Unidade
                                                        </th>
                                                        <th data-tablesaw-sortable-col data-tablesaw-priority="3">Andar</th>
                                                        <th data-tablesaw-sortable-col data-tablesaw-priority="2">Bloco</th>
                                                        <th data-tablesaw-sortable-col data-tablesaw-priority="1">Tipo</th>
                                                        <th class="text-center col-md-2">
                                                            Ação
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($units  as $row)
                                                        <tr>
                                                            <td>{{ $row->unit->name }}</td>
                                                            <td>{{ $row->unit->floor }}</td>
                                                            <td>{{ $row->unit->block->name }}</td>
                                                            <td>{{ $row->unit->unitType->name }}</td>
                                                            <td class="text-center">
                                                                <button title="Excluir"
                                                                        class="btn btn-icon bg-danger waves-effect waves-light btnDelete"
                                                                        data-target="#modalDelete" data-toggle="modal"
                                                                        data-route="{{ route('portal.condominium.unit.user.destroy', ['id' => $row->id]) }}">
                                                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <h4 class="page-title">
                                                    <br/>
                                                    Nenhuma unidade vinculada.
                                                </h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection