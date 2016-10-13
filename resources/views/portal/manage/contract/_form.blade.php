<div class="form-group">
    {!! Form::label('Name', 'Serviço:') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('start_date', 'Data início:') !!}
            {!! Form::text('start_date', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('end_date', 'Data Fim:') !!}
            {!! Form::text('end_date', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="provider_id">Fornecedor:</label>
            <select class="form-control" required="required" id="provider_id" name="provider_id">
                <option value="">Selecione</option>
                @foreach($provider as $provider)
                    <option value="{{ $provider->id }}" @if(isset($dados['provider_id']) && $dados['provider_id'] == $provider->id) selected @endif>{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('contract_status_id', 'Status:') !!}
            {!! Form::select('contract_status_id', $status, null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Descrição') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

{!! Form::file('files[]', array('multiple'=>true)) !!}