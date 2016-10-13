@extends('portal')

@section('content')
    <div class="container">
        <h3>Nova Categoria de Chamados</h3>
        <a href="{{ route('portal.called.category.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.called.category.store']) !!}

        @include('portal.called.category._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection