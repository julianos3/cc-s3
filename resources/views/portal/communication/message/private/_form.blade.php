<div class="row">
    <div class="col-md-12">
        <div class="form-group form-material">
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" class="communicationDestination" id="condominiumAll" name="destination" value="all_user" checked="" required="required">
                <label for="condominiumAll">Enviar comunicado para TODOS os integrantes do condomínio</label>
            </div>
            <br/>
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" class="communicationDestination" id="users" name="destination" value="users" required="required">
                <label for="users">Enviar comunicado para integrantes INDIVIDUAIS</label>
            </div>
            <br/>
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" class="communicationDestination" id="group" name="destination" value="group" required="required">
                <label for="group">Enviar comunicado para GRUPOS</label>
            </div>
        </div>
    </div>
</div>
<div class="row groupsCommunication none">
    <div class="col-md-12">
        <div class="form-group">
            <label for="groups">Grupos:</label>
            <select data-plugin="selectpicker" class="form-control selectGroup" name="groups[]" multiple data-selected-text-format="count > 3">
                @foreach($groupCondominium as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row usersCommunication none">
    <div class="col-md-12">
        <div class="form-group">
            <label for="groups">Integrantes:</label>
            <select data-plugin="selectpicker" class="form-control selectUsers" name="users[]" multiple data-selected-text-format="count > 3">
                @foreach($usersCondominium as $row)
                    <option value="{{ $row->id }}">{{ $row->user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('subject', 'Assunto:') !!}
            {!! Form::text('subject', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('message', 'Mensagem:') !!}
            {!! Form::textarea('message', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>