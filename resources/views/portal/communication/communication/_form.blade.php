<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('title', 'Título:') !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'required' => 'required']) !!}
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
<div class="row">
    <div class="col-md-12">
        <div class="form-group form-material">
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="condominiumAll" name="destination" checked="" required="required">
                <label for="condominiumAll">Enviar comunicado para TODOS os integrantes do condomínio</label>
            </div>
            <br />
            <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="group" name="destination"  required="required">
                <label for="group">Enviar comunicado para GRUPOS</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date_display', 'Data limite de exibição:') !!}
            {!! Form::text('date_display', null, ['class'=>'form-control', 'required' => 'required', 'data-plugin' => 'formatter', 'data-pattern' => '[[99]]/[[99]]/[[9999]]', 'data-plugin' => 'datepicker', 'placeholder' => '00/00/0000']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="checkbox-custom checkbox-primary"><br />
            <input type="checkbox" id="inputUnchecked" checked="">
            <label for="inputUnchecked">Enviar o comunicado por e-mail para os destinatários.</label>
        </div>
    </div>
</div>