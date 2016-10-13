@extends('portal')

@section('content')
    <div class="container">
        <h3>Resposta de Forum</h3>
        <a href="{{ route('portal.forum.index') }}" class="btn btn-info">Voltar</a>
        <br /><br />
        <a href="{{ route('portal.forum.response.create', ['forumId' => $forumId]) }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Resposta</th>
                <th>Usuário</th>
                <th>Citação</th>
                <th class="col-sm-2">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->usersCondominium->user->name }}</td>
                        <td>{{ $row->response_id }}</td>
                        <td>
                            <a href="{{route('portal.forum.response.edit',['forumId' => $forumId, 'id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.forum.response.destroy',['forumId' => $forumId, 'id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection