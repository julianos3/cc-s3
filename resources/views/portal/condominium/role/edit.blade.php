@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Nível {{$data->name}}</h3>
        <a href="{{ route('portal.condominium.role.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($data, ['route'=>['portal.condominium.role.update', $data->id]]) !!}

        @include('portal.condominium.role._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection