<div class="form-group">
    {!! Form::label('Name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <!-- data-plugin="formatter" data-pattern="[[99999]]-[[999]]" -->
            {!! Form::label('start_date', 'Data início:') !!}
            {!! Form::text('start_date', null, ['class'=>'form-control', 'required' => 'required', 'data-plugin' => 'formatter', 'data-pattern' => '[[99]]/[[99]]/[[9999]]', 'data-plugin' => 'datepicker', 'placeholder' => '00/00/0000']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('periodicity_id', 'Periodicidade:') !!}
            {!! Form::select('periodicity_id', $periodicity, null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Observação') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>