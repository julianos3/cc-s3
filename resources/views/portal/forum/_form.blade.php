<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Condominio', 'Condominio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="Block">Usuarios Condominio:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('Descrição', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Notificação', 'Notificação:') !!}
    {!! Form::select('notification', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>