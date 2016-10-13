@extends('portal')

@section('content')
    <div class="container">
        <h3>Usuário</h3>
        <a href="{{ route('portal.user.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th class="col-sm-2">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>@if ($row->sex === 'm') Masculino @else Feminino @endif</td>
                        <td>
                            <a href="{{route('portal.user.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.user.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection