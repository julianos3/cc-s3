<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Email', 'E-mail:') !!}
    {!! Form::text('email', null, ['class'=>'form-control']) !!}
    <p class="help-block alert alert-info">
        É muito importante informar um e-mail válido, pois através dele é que o
        integrante irá acessar o Central Condo, além de ser avisado sobre os acontecimentos
        do condomínio.
    </p>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Sexo', 'Sexo:') !!}
            {!! Form::select('sex', ['m' => 'Masculino','f' => 'Feminino'], null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', 'Telefone:') !!}
            {!! Form::text('phone', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<hr>
<h4 class="title">Informe abaixo caso o integrante possua alguma unidade do condomínio</h4>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="block_id">Bloco</label>
            <select class="form-control" name="block_id" id="block_id">
                <option value="">Selecione</option>
                @foreach($block as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="unit_id">Unidade</label>
            <select class="form-control" name="unit_id" id="unit_id">
                <option value="">Selecione</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="user_unit_role">Tipo de vinculo com a Unidade</label>
            <select class="form-control" name="user_unit_role" id="user_unit_role" required="required">
                <option value="">Selecione</option>
                @foreach($userRole as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
