@extends('portal')

@section('content')
    <div class="container">
        <h3>Editando Integrantes {{$dados->name}}</h3>
        <a href="{{ route('portal.diary.user.index',['id' => $diaryId]) }}" class="btn btn-default">Voltar</a>
        <br/>
        <br/>

        @include('errors._check')

        <?php $idUser = $dados->user_condominium_id; ?>

        {!! Form::model($dados, ['route'=>['portal.diary.user.update', 'diary_id'=> $diaryId, 'id' => $dados->id]]) !!}

        @include('portal.diary.user._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection