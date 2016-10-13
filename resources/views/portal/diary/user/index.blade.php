@extends('portal')

@section('content')
    <div class="container">
        <h3>Lista de Integrantes</h3>
        <a href="{{ route('portal.diary.index') }}" class="btn btn-primary">Voltar</a>
        <br /><br />
        <a href="{{ route('portal.diary.user.create', ['id' => $diaryId]) }}" class="btn btn-default">Cadastrar</a>
        <br/>
        <br/>
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Agenda</th>
                <th class="col-sm-3">Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->usersCondominium->user->name }}</td>
                    <td>{{ $row->diary->reason }}</td>
                    <td>
                        <a href="{{route('portal.diary.user.edit',['diary_id'=>$diaryId,'id'=>$row->id])}}"
                           title="" class="btn btn-default btn-sm">Editar</a>
                        <a href="{{route('portal.diary.user.destroy',['diary_id'=>$diaryId,'id'=>$row->id])}}"
                           title="" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection