@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Unidade Tipo {{$data->name}}</h3>
        <a href="{{ route('portal.unit.type.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($data, ['route'=>['portal.unit.type.update', $data->id]]) !!}

        @include('portal.unit.type._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection