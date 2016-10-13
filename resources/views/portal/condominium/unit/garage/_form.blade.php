<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="unit_id">Unidade vinculada a garagem</label>
            <select class="form-control" name="unit_id" id="unit_id">
                <option value="">Selecione</option>
                @foreach($unit as $row)
                    <option value="{{ $row->id }}" @if($row->id == $unitId) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'rows' => '5']) !!}
        </div>
    </div>
</div>