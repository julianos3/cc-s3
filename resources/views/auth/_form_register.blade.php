<div class="form-group form-material floating">
    {!! Form::text('name', null, ['class'=>'form-control empty', 'id' => 'inputName']) !!}
    {!! Form::label('inputName', 'Name:', ['class' => 'floating-label']) !!}
</div>

<div class="form-group form-material floating">
    {!! Form::text('email', null, ['class'=>'form-control empty', 'id' => 'inputEmail']) !!}
    {!! Form::label('inputEmail', 'Email:', ['class' => 'floating-label']) !!}
</div>

<div class="form-group form-material floating">
    {!! Form::password('password', ['class'=>'form-control empty', 'id' => 'inputPassword']) !!}
    {!! Form::label('inputPassword', 'Password:', ['class' => 'floating-label']) !!}
</div>

<div class="form-group form-material floating">
    {!! Form::password('password_confirmation', ['class'=>'form-control empty', 'id' => 'inputPasswordCheck']) !!}
    {!! Form::label('inputPasswordCheck', 'Retype Password:', ['class' => 'floating-label']) !!}
</div>