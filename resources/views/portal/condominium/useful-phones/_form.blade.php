<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('condominio', 'Condomínio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Ativo', 'Ativo:') !!}
    {!! Form::select('active', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>