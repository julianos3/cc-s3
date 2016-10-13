@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Resposta do Forum</h3>
        <a href="{{ route('portal.forum.response.index', ['forumId' => $forumId]) }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        <?php
            $userCondominiumId = $dados->user_condominium_id;
            $responseId = $dados->response_id;
        ?>
        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.forum.response.update', $dados->id]]) !!}

        @include('portal.forum.response._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection