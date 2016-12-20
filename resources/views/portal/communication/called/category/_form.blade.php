<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Name', 'Nome: *') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Ativo', 'Ativo: *') !!}
            {!! Form::select('active', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>