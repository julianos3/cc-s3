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
            <option value="{{ $row->id }}"
                    @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::label('Data', 'Data e Hora:') !!}
    {!! Form::text('date', null, ['class'=>'form-control', 'placeholder' => '99/99/9999 99:99:99']) !!}
</div>

<div class="form-group">
    {!! Form::label('descrição', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Encontrado?', 'Encontrado?') !!}
    {!! Form::select('found', ['n' => 'Não','y' => 'Sim'], null, ['class'=>'form-control']) !!}
</div>