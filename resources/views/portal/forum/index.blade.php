@extends('portal')

@section('content')
    <div class="container">
        <h3>Forum</h3>
        <a href="{{ route('portal.forum.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Condominio</th>
                <th>Usuário</th>
                <th>Notíficação</th>
                <th class="col-sm-3">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->condominium->name }}</td>
                        <td>{{ $row->usersCondominium->user->name }}</td>
                        <td>@if ($row->notification === 'y') Sim @else Não @endif</td>
                        <td>
                            <a href="{{route('portal.forum.response.index',['id'=>$row->id])}}" title="" class="btn btn-info btn-sm">Respostas</a>
                            <a href="{{route('portal.forum.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.forum.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection