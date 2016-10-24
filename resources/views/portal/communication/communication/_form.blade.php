<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name', 'Título:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Comunicado:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>

<h4>Destinatários</h4>
@if($paginaAlterar)
<div class="row">
    <div class="col-md-12">
        @if($dados['all_user'] == 's')
            <label for="destination">Enviado a todos os integrantes do condomínio</label>
        @else
            <label for="destination"><strong>Enviado a todos os integrantes dos grupos:</strong></label><br />
            @foreach($groupCommunication as $row)
                {!! $row->groupCondominium->name."<br />" !!}
            @endforeach
            <br />
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="send_mail">Comunicados enviados por e-mails!</label>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="form-group form-material">
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="condominiumAll" name="destination" value="all_user" checked="" required="required">
                <label for="condominiumAll">Enviar comunicado para TODOS os integrantes do condomínio</label>
            </div>
            <br/>
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="group" name="destination" value="group" required="required">
                <label for="group">Enviar comunicado para GRUPOS</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="groups">Grupos:</label>
            <select data-plugin="selectpicker" class="form-control" name="groups[]" multiple data-selected-text-format="count > 3">
                @foreach($groupCondominium as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date_display', 'Data limite de exibição:') !!}
            {!! Form::text('date_display', null, ['class'=>'form-control', 'required' => 'required', 'data-plugin' => 'formatter', 'data-pattern' => '[[99]]/[[99]]/[[9999]]', 'data-plugin' => 'datepicker', 'placeholder' => '00/00/0000']) !!}
        </div>
    </div>
    @if(!$paginaAlterar)
    <div class="col-md-6">
        <div class="checkbox-custom checkbox-primary"><br/>
            <input type="checkbox" id="send_mail" name="send_mail" value="y" checked="">
            <label for="send_mail">Enviar o comunicado por e-mail para os destinatários.</label>
        </div>
    </div>
    @endif
</div>