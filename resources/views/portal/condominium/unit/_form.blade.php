<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            {!! Form::label('floor', 'Andar:') !!}
            {!! Form::text('floor', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="block_id">Bloco</label>
            <select class="form-control" name="block_id" id="block_id" required="required">
                <option value="">Selecione</option>
                @foreach($block as $row)
                    <option value="{{ $row->id }}"
                            @if(isset($dados['block_id']) && $dados['block_id'] == $row->id) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="unit_type_id">Tipo</label>
            <select class="form-control" name="unit_type_id" id="unit_type_id" required="required">
                <option value="">Selecione</option>
                @foreach($type as $row)
                    <option value="{{ $row->id }}"
                            @if(isset($dados['unit_type_id']) && $dados['unit_type_id'] == $row->id) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>