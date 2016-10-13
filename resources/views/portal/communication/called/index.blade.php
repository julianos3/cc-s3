@extends('portal')

@section('content')
    <div class="container">
        <h3>Chamado</h3>
        <a href="{{ route('portal.communication.called.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Condomínio</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Visivel</th>
                <th class="col-sm-3">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->usersCondominium->user->name }}</td>
                        <td>{{ $row->condominium->name }}</td>
                        <td>{{ $row->calledCategory->name }}</td>
                        <td>{{ $row->calledStatus->name }}</td>
                        <td>@if ($row->visible === 'y') Sim @else Não @endif</td>
                        <td>
                            <a href="{{route('portal.communication.called.historic.index',['id'=>$row->id])}}" title="" class="btn btn-info btn-sm">Histórico</a>
                            <a href="{{route('portal.communication.called.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.communication.called.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection