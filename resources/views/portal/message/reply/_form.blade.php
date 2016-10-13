<div class="form-group">
    <label for="Block">Usuarios Condominio:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->user_condominium_id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->usersCondominium->user->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('Resposta', 'Resposta:') !!}
    {!! Form::textarea('message', null, ['class'=>'form-control']) !!}
</div>

<input type="hidden" name="message_id" value="<?php echo $messageId; ?>" />