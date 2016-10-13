@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Usuário {{$dados->name}}</h3>
        <a href="{{ route('portal.user.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.user.update', $dados->id]]) !!}

        @include('portal.user._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection