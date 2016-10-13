@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Forum</h3>
        <a href="{{ route('portal.forum.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        <?php $userCondominiumId = 0; ?>

        {!! Form::open(['route'=>'portal.forum.store']) !!}

        @include('portal.forum._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection