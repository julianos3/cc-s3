@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Usuário Unidade</h3>
        <a href="{{ route('portal.unit.user.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        <?php $userCondominiumId = 0; ?>

        @include('errors._check')

        {!! Form::open(['route'=>'portal.unit.user.store']) !!}

        @include('portal.unit.user._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection