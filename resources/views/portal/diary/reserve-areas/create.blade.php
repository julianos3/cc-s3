@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Área de Reserva</h3>
        <a href="{{ route('portal.diary.reserve-areas.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.diary.reserve-areas.store']) !!}

        @include('portal.diary.reserve-areas._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection