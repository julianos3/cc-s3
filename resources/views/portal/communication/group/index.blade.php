@extends('portal')

@section('content')
    <div class="container">
        <h3>Comunicados Grupos</h3>
        <a href="{{ route('portal.communication.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Comunicado</th>
                <th>Grupo</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dados as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->communication->name }}</td>
                        <td>{{ $row->groupCondominium->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection