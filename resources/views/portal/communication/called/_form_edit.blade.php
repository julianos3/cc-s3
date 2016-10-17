<div class="row">
    <div class="col-md-12">
        <label for="assunto"><strong>Assunto</strong></label>
        <p class="form-control-static">{{ $dados['subject'] }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="codigo"><strong>Código</strong></label>
        <p class="form-control-static">Nº: {{ $dados['id'] }}</p>
    </div>
    <div class="col-md-4">
        <label for="codigo"><strong>Tipo</strong></label>
        <p class="form-control-static">{{ $dados['calledCategory']['name'] }}</p>
    </div>
    <div class="col-md-4">
        <label for="assunto"><strong>Criado Por</strong></label>
        <p class="form-control-static">{{ $dados['usersCondominium']['user']['name'] }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="assunto"><strong>Data de Abertura</strong></label>
        <p class="form-control-static">{{ date('d/m/Y h:i', strtotime($dados['created_at'])) }}</p>
    </div>
</div>
<hr>
@if($dados['calledHistoric'])
    <h4>Andamento:</h4>
    @foreach($dados['calledHistoric']  as $row)
        <div class="row">
            <div class="col-md-12">
                CRIADO EM {{ date('d/m/Y h:i', strtotime($row['created_at'])) }}
                POR {{ $row['usersCondominium']['user']['name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $row['description'] }}<br />
                ----------------------------------------------------------------------------------------------------
            </div>
        </div>

    @endforeach
    <hr>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="called_category_id">Categoria:</label>
            <select class="form-control" required="required" id="called_category_id" name="called_category_id">
                <option value="">Selecione</option>
                @foreach($calledCategory as $row)
                    <option value="{{ $row->id }}" @if(isset($dados['called_category_id']) && $dados['called_category_id'] == $row['id']) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="called_status_id">Status:</label>
            <select class="form-control" required="required" id="called_status_id" name="called_status_id">
                <option value="">Selecione</option>
                @foreach($calledStatus as $row)
                    <option value="{{ $row->id }}" @if(isset($dados['called_status_id']) && $dados['called_status_id'] == $row['id']) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description_historic', 'Descrição:') !!}
            {!! Form::textarea('description_historic', null, ['class'=>'form-control', 'required' => 'required']) !!}
            <span class="help-block">Informação será adicionada no andamento do chamado.</span>
        </div>
    </div>
</div>