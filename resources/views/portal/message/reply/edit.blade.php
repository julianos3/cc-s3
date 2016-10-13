@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Resposta da Mensagem</h3>
        <a href="{{ route('portal.message.reply.index', ['messageId' => $messageId]) }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        <?php
            $userCondominiumId = $dados->user_condominium_id;
        ?>
        @include('errors._check')

        {!! Form::model($dados, ['route'=>['portal.message.reply.update', 'messageId' => $messageId, 'id' => $dados->id]]) !!}

        @include('portal.message.reply._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection