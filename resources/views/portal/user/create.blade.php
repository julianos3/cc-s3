@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Usuário</h3>
        <a href="{{ route('portal.user.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.user.store']) !!}

        @include('portal.user._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection