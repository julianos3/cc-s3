@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Bloco {{$dados->name}}</h3>
        <a href="{{ route('portal.forum.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        <?php $userCondominiumId = $dados->user_condominium_id; ?>

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.forum.update', $dados->id]]) !!}

        @include('portal.forum._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection