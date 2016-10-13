@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Unidade Tipo</h3>
        <a href="{{ route('portal.unit.type.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.unit.type.store']) !!}

        @include('portal.unit.type._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection