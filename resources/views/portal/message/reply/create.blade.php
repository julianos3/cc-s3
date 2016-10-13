@extends('portal')

@section('content')
    <div class="container">
        <h3>Nova Resposta Mensagem</h3>
        <a href="{{ route('portal.message.reply.index', ['messageId' => $messageId]) }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        <?php
            $userCondominiumId = 0;
        ?>
        @include('errors._check')

        {!! Form::open(['route'=>'portal.message.reply.store']) !!}

        @include('portal.message.reply._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection