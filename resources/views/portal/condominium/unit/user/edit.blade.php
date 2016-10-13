@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Usuário Unidade {{$dados->name}}</h3>
        <a href="{{ route('portal.unit.user.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        <?php $userCondominiumId = $dados->user_condominium_id;?>

        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.unit.user.update', $dados->id]]) !!}

        @include('portal.unit.user._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection