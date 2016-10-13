@extends('portal')

@section('content')
    <div class="container">
        <h3>Finalidade</h3>
        <a href="{{ route('portal.condominium.finality.create') }}" class="btn btn-default">Cadastrar</a>
        <br />
        <br />
        @include('errors._check')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ativo</th>
                <th class="col-sm-2">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>@if ($row->active === 'y') Sim @else Não @endif</td>
                        <td>
                            <a href="{{route('portal.condominium.finality.edit',['id'=>$row->id])}}" title="" class="btn btn-default btn-sm">Editar</a>
                            <a href="{{route('portal.condominium.finality.destroy',['id'=>$row->id])}}" title="" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection