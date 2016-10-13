<div class="form-group">
    <label for="Block">Usuarios Condominio:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($usersCondominium as $row)
            <option value="{{ $row->id }}" @if (isset($idUser) && $row->id === $idUser) selected @endif>{{ $row->user->name }}</option>
        @endforeach
    </select>
</div>

<input type="hidden" name="group_id" value="<?php echo $groupId; ?>" />