<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Assunto', 'Assunto:') !!}
            {!! Form::text('subject', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('descrição', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'required' => 'required']) !!}
            <span class="help-block">Informação será acrescentada no andamento do chamado.</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Visivel', 'Permitir que outros integrantes do condomínio vejam o conteúdo deste chamado:') !!}
            {!! Form::select('visible', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
            <span class="help-block">Ao permitir que outros vejam, pode evitar que sejam criados outros chamados com o mesmo motivo.</span>
        </div>
    </div>
</div>