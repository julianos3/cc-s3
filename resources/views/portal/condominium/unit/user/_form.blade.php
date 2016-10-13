<div class="form-group">
    <label for="Block">Usuarios Condominio:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($userCondominium as $row)
            <option value="{{ $row->id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('unidade', 'Unidade:') !!}
    {!! Form::select('unit_id', $unit, null, ['class'=>'form-control']) !!}
</div>