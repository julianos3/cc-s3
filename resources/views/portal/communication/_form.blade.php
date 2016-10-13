<div class="form-group">
    {!! Form::label('Titulo', 'Titulo:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Condominio', 'Condominio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="Block">Usuarios Condominio Que vai enviar a mensagem:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->id }}"
                    @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('Todos os usuários?', 'Todos os usuários?') !!}
    {!! Form::select('all_user', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Grupos', 'Grupos:') !!}
    {!! Form::select('group[]', $groupCondominium, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Mensagem', 'Mensagem:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Data final de exbiição', 'Data final de exbiição:') !!}
    {!! Form::text('date_display', null, ['class'=>'form-control', 'placeholder'=> '99/99/9999']) !!}
</div>

<div class="form-group">
    {!! Form::label('Notificar por e-mail', 'Notificar por e-mail:') !!}
    {!! Form::select('send_mail', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>