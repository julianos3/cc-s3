@extends('portal')

@section('content')
    <div class="container">
        <h3>Chamado Histórico</h3>
        <a href="{{ route('portal.called.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Chamado</th>
                <th>Usuário</th>
                <th>Status</th>
                <th>Descrição</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->called->subject }}</td>
                        <td>{{ $row->usersCondominium->user->name }}</td>
                        <td>{{ $row->calledStatus->name }}</td>
                        <td>{{ $row->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection