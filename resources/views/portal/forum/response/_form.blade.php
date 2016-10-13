<div class="form-group">
    <label for="Block">Citação:</label>
    <select class="form-control" name="response_id">
        <option value=""></option>
        @foreach($response as $row)
            <option value="{{ $row->id }}" @if ($row->id === $responseId) selected @endif>{{ $row->description }}</option>
        @endforeach
    </select>
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
    {!! Form::label('Resposta', 'Resposta:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<input type="hidden" name="forum_id" value="<?php echo $forumId; ?>" />