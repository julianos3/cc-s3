<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Email', 'E-mail:') !!}
    {!! Form::text('email', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Sexo', 'Sexo:') !!}
    {!! Form::select('sex', ['m' => 'Masculino','f' => 'Feminino'], null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Nível', 'Nível:') !!}
    {!! Form::select('user_role_id', $role, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Senha', 'senha:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>