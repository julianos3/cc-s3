@extends('portal')

@section('content')
    <div class="container">
        <h3>Finalizar Achados e Perdidos</h3>
        <a href="{{ route('portal.lost-and-found.index') }}" class="btn btn-default">Voltar</a>
        <br />
        <br />

        @include('errors._check')

        <?php $userCondominiumId = 0; ?>

        {!! Form::open(['route'=>'portal.lost-and-found.completed.store']) !!}


        <div class="form-group">
            <label for="Block">Usuarios Condominio:</label>
            <select class="form-control" name="user_condominium_id">
                @foreach($usersCondominium as $row)
                    <option value="{{ $row->id }}">{{ $row->user->name .' - '.$row->condominium->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('descrição', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>
        <input type="hidden" name="lost_and_found_id" value="{!! $lostAndFoundId !!}" />
        <div class="form-group">
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
        </div>


        {!! Form::close() !!}

    </div>


@endsection