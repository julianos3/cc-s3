@extends('portal')

@section('content')
    <div class="container">
        <h3>Novo Status de Chamados</h3>
        <a href="{{ route('portal.called.status.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        {!! Form::open(['route'=>'portal.called.status.store']) !!}

        @include('portal.called.status._form')

        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection