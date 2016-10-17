@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Condominio</h3>
        <a href="{{ route('portal.block.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.block.store']) !!}

        @include('portal.block._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection