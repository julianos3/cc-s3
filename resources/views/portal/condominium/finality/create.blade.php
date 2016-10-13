@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Finalidade</h3>
        <a href="{{ route('portal.condominium.finality.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.condominium.finality.store']) !!}

        @include('portal.condominium.finality._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection