@extends('portal')

@section('content')
    <div class="container">
        <h3>Agenda</h3>
        <a href="{{ route('portal.diary.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Condomínio</th>
                <th>Usuário</th>
                <th>Área de Reserva</th>
                <th>Razão</th>
                <th>Data Inicio</th>
                <th>Data Fim</th>
                <th class="col-sm-s">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->condominium->name }}</td>
                        <td>{{ $row->userCondominium->user->name }}</td>
                        <td>{{ $row->reserveArea->name }}</td>
                        <td>{{ $row->reason }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($row->start_date)) }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($row->end_date)) }}</td>
                        <td>
                            <a href="{{route('portal.diary.user.index',['id'=>$row->id])}}" title="" class="btn btn-info btn-sm">Integrantes</a>
                            <a href="{{route('portal.diary.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.diary.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection