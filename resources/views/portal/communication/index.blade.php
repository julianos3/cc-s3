@extends('portal')

@section('content')
    <div class="container">
        <h3>Comunicados</h3>
        <a href="{{ route('portal.communication.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Condominio</th>
                <th>Usuário</th>
                <th>Data de Exibição</th>
                <th>Enviado por E-mail?</th>
                <th>Todos os Usuários?</th>
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
                        <td>{{ $row->date_display}}</td>
                        <td>@if ($row->send_mail === 'y') Sim @else Não @endif</td>
                        <td>@if ($row->all_user === 'y') Sim @else Não @endif</td>
                        <td>
                            @if ($row->all_user === 'n')
                            <a href="{{route('portal.communication.group.index',['communicationId' => $row->id])}}" title="" class="btn btn-default btn-sm">Grupos</a>
                            @endif
                            <a href="{{route('portal.communication.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.communication.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection