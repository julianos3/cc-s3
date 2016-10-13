<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date', 'Data realização:') !!}
            {!! Form::text('date', null, ['class'=>'form-control', 'required' => 'required', 'data-plugin' => 'formatter', 'data-pattern' => '[[99]]/[[99]]/[[9999]]', 'data-plugin' => 'datepicker', 'placeholder' => '00/00/0000']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="provider_id">Fornecedor:</label>
            <select class="form-control" required="required" id="provider_id" name="provider_id">
                <option value="">Selecione</option>
                @foreach($providers as $provider)
                <option value="{{ $provider->id }}" @if(isset($dados['provider_id']) && $dados['provider_id'] == $provider['id']) selected @endif>{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Observação') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'rows' => 4]) !!}
        </div>
    </div>
</div>
<input type="hidden" name="maintenance_id" value="" id="maintenanceId" />