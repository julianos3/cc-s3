@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Achados e Perdidos {{$dados->name}}</h3>
        <a href="{{ route('portal.lost-and-found.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        <?php $userCondominiumId = $dados->user_condominium_id; ?>

        {!! Form::model($dados, ['route'=>['portal.lost-and-found.update', $dados->id]]) !!}

        @include('portal.lost-and-found._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection