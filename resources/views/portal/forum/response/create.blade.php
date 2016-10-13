@extends('portal')

@section('content')
    <div class="container">
        <h3>Nova Resposta Forum</h3>
        <a href="{{ route('portal.forum.response.index', ['forumId' => $forumId]) }}" class="btn btn-default">Voltar</a>
        <br />
        <br />
        <?php
            $userCondominiumId = 0;
            $responseId = 0;
        ?>
        @include('errors._check')

        {!! Form::open(['route'=>'portal.forum.response.store']) !!}

        @include('portal.forum.response._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection