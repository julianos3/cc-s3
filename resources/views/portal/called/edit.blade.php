@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Chamado {{$dados->name}}</h3>
        <a href="{{ route('portal.called.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        <?php
        $userCondominiumId = $dados->user_condominium_id;
        ?>

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.called.update', $dados->id]]) !!}

        @include('portal.called._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection