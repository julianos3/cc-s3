@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Chamado</h3>
        <a href="{{ route('portal.called.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        <?php
        $userCondominiumId = 0;
        ?>

        {!! Form::open(['route'=>'portal.called.store']) !!}

        @include('portal.called._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection