@extends('portal')

@section('content')
    <div class="container">
        <h3>Nova Agenda</h3>
        <a href="{{ route('portal.diary.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        <?php
        $userCondominiumId = 0;
        ?>
        @include('errors._check')

        {!! Form::open(['route'=>'portal.diary.store']) !!}

        @include('portal.diary._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection