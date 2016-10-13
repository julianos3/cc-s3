@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Bloco {{$dados->name}}</h3>
        <a href="{{ route('portal.block.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.block.update', $dados->id]]) !!}

        @include('portal.block._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection