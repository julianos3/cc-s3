@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Área de Reserva {{$dados->name}}</h3>
        <a href="{{ route('portal.diary.reserve-areas.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.diary.reserve-areas.update', $dados->id]]) !!}

        @include('portal.diary.reserve-areas._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection