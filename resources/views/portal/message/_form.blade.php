<div class="form-group">
    {!! Form::label('Assunto', 'Assunto:') !!}
    {!! Form::text('subject', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Condominio', 'Condominio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="Block">Usuarios Condominio Que vai enviar a mensagem:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="Block">Usuarios Condominio Que vai receber a mensagem:</label>
    <select class="form-control" name="users[]">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->id }}">{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('Mensagem', 'Mensagem:') !!}
    {!! Form::textarea('message', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Publica', 'Pública:') !!}
    {!! Form::select('public', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Tipo', 'Tipo:') !!}
    {!! Form::select('type', ['s' => 'Enviar','r' => 'Receber'], null, ['class'=>'form-control']) !!}
</div>