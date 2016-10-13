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