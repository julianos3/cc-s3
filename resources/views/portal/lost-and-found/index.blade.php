@extends('portal')

@section('content')
    <div class="container">
        <h3>Achados e Perdidos</h3>
        <a href="{{ route('portal.lost-and-found.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Condomínio</th>
                <th>Usuário</th>
                <th>Entrado?</th>
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
                        <td>@if ($row->found === 'y') Sim @else Não @endif</td>
                        <td>
                            <a href="{{route('portal.lost-and-found.completed',['id'=>$row->id])}}" title="" class="btn btn-primary btn-sm">Resolver</a>
                            <a href="{{route('portal.lost-and-found.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.lost-and-found.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection