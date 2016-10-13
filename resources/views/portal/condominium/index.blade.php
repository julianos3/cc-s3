@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-content">
            <h2>Condomínio</h2>
            <a href="{{ route('portal.condominium.create') }}" class="btn btn-default">Cadastrar</a>
            <br />
            <br />

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Finalidade</th>
                    <th>Ativo</th>
                    <th class="col-sm-2">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->finality->name }}</td>
                        <td>@if ($row->active === 'y') Sim @else Não @endif</td>
                        <td>
                            <a href="{{route('portal.condominium.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.condominium.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection