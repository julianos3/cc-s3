@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Bloco Nomemclatura</h3>
        <a href="{{ route('portal.block.nomemclature.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.block.nomemclature.store']) !!}

        @include('portal.block.nomemclature._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection