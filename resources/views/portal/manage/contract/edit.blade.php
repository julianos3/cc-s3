@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.manage.index') }}">Administrar</a></li>
                <li><a href="{{ route('portal.manage.contracts.index') }}">Contratos</a></li>
                <li class="active">Alterar</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.manage.contracts.index') }}"
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
                    @include('portal.delete')

                    {!! Form::model($dados, ['route'=>['portal.manage.contract.update', $dados->id], 'files' => true]) !!}

                    @include('portal.manage.contract._form')

                    <div class="form-group text-right">
                        {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
                    </div>

                    {!! Form::close() !!}

                    @if(!$files->isEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <table class="tablesaw table-striped table-bordered table-hover"
                                       data-tablesaw-mode="swipe"
                                       data-tablesaw-sortable data-tablesaw-minimap>
                                    <thead>
                                    <tr>
                                        <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                            data-tablesaw-priority="persist">Nome
                                        </th>
                                        <th data-tablesaw-sortable-col data-tablesaw-priority="2">Data Cadastro</th>
                                        <th class="text-center col-md-2">
                                            Ação
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($files  as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ date('d/m/Y h:i', strtotime($row->created_at)) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('portal.manage.contract.file.show',['id' => $row->id]) }}"
                                                   title="Visualizar"
                                                   data-toggle="tooltip"
                                                   data-original-title="Visualizar"
                                                   target="_blank"
                                                   class="btn btn-icon bg-success waves-effect waves-light waves-effect waves-light">
                                                    <i class="icon wb-zoom-in" aria-hidden="true"></i>
                                                </a>
                                                <button title="Excluir"
                                                        class="btn btn-icon bg-danger waves-effect waves-light btnDelete"
                                                        data-target="#modalDelete" data-toggle="modal"
                                                        data-route="{{ route('portal.manage.contract.file.destroy', ['id' => $row->id]) }}">
                                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                                </button>
                                            </td>
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