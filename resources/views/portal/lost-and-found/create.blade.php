@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Achados e Perdidos</h3>
        <a href="{{ route('portal.lost-and-found.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        <?php $userCondominiumId = 0; ?>

        {!! Form::open(['route'=>'portal.lost-and-found.store']) !!}

        @include('portal.lost-and-found._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection