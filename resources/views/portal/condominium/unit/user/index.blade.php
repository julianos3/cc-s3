@extends('portal')

@section('content')
    <div class="container">
        <h3>Usuário Unidade</h3>
        <a href="{{ route('portal.unit.user.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>ID Usuário</th>
                <th>ID Nível Usuário</th>
                <th>ID Condominio</th>
                <th class="col-sm-2">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->userCondominium->user->name }}</td>
                        <td>{{ $row->userCondominium->userRoleCondominium->name }}</td>
                        <td>{{ $row->userCondominium->condominium->name }}</td>
                        <td>
                            <a href="{{route('portal.unit.user.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.unit.user.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection