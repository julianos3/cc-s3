@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Bloco Nomemclatura {{$data->name}}</h3>
        <a href="{{ route('portal.block.nomemclature.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($data, ['route'=>['portal.block.nomemclature.update', $data->id]]) !!}

        @include('portal.block.nomemclature._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection