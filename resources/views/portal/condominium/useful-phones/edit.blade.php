@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Telefone Útil {{$dados->name}}</h3>
        <a href="{{ route('portal.condominium.useful-phones.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.condominium.useful-phones.update', $dados->id]]) !!}

        @include('portal.condominium.useful-phones._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection