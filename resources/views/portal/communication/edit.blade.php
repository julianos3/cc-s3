@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Comunicado {{$dados->name}}</h3>
        <a href="{{ route('portal.communication.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        <?php $userCondominiumId = $dados->user_condominium_id; ?>

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.communication.update', $dados->id]]) !!}

        @include('portal.communication._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection