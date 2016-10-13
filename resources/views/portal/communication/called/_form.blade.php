<div class="form-group">
    {!! Form::label('Assunto', 'Assunto:') !!}
    {!! Form::text('subject', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Condominio', 'Condominio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Categoria', 'Categoria:') !!}
    {!! Form::select('called_category_id', $calledCategory, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Status', 'Status:') !!}
    {!! Form::select('called_status_id', $calledStatus, null, ['class'=>'form-control']) !!}
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
    {!! Form::label('descrição', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Visivel', 'Visivel:') !!}
    {!! Form::select('visible', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>