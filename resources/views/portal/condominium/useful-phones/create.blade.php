@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Telefone Útil</h3>
        <a href="{{ route('portal.condominium.useful-phones.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.condominium.useful-phones.store']) !!}

        @include('portal.condominium.useful-phones._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection