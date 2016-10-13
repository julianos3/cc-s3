@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Finalidade {{$data->name}}</h3>
        <a href="{{ route('portal.condominium.finality.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($data, ['route'=>['portal.condominium.finality.update', $data->id]]) !!}

        @include('portal.condominium.finality._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection