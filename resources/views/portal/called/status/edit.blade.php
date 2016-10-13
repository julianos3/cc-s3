@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Status de Chamados {{$dados->name}}</h3>
        <a href="{{ route('portal.called.status.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.called.status.update', $dados->id]]) !!}

        @include('portal.called.status._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection