<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cep', 'CEP:') !!}
    {!! Form::text('zip_code', null, ['class'=>'form-control', 'placeholder' => '99999-99']) !!}
</div>

<div class="form-group">
    {!! Form::label('endereco', 'Endereço:') !!}
    {!! Form::text('address', null, ['class'=>'form-control', 'placeholder' => 'Rua, Av..']) !!}
</div>

<div class="form-group">
    {!! Form::label('numero', 'Número:') !!}
    {!! Form::text('number', null, ['class'=>'form-control', 'placeholder' => '99']) !!}
</div>

<div class="form-group">
    {!! Form::label('bairro', 'Bairro:') !!}
    {!! Form::text('district', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('complemento', 'Complemento:') !!}
    {!! Form::text('complement', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cnpj', 'CNPJ:') !!}
    {!! Form::text('cnpj', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Finalidade', 'Finalidade:') !!}
    {!! Form::select('finality_id', $finality, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ativo', 'Ativo:') !!}
    {!! Form::select('active', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>