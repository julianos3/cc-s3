<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Condominio', 'Condominio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>