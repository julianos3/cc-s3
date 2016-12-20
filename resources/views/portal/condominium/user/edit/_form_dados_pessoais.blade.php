<div class="control-group">
    <div class="controls">
        {!! Form::file('imagem') !!}
        <p class="errors">{!!$errors->first('imagem')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>
    @if($dados['imagem'])
    <a href="{{ route('portal.condominium.user.image', ['id' => $dados->id, 'imagem' => $dados['imagem']]) }}" target="_blank">Visualizar Imagem</a>
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Name', 'Nome: *') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Email', 'E-mail: *') !!}
            {!! Form::text('email', null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="user_role_condominium">Tipo de relação com o condoḿinio: *</label>
            <select class="form-control" name="user_role_condominium" id="user_role_condominium" required="required">
                <option value="">Selecione</option>
                @foreach($role as $row)
                    <option value="{{ $row->id }}" @if($row->id == $userRoleCondominium && isset($userRoleCondominium)) selected @endif>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Sobre mim:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', 'Telefone:') !!}
            {!! Form::text('phone', null, ['class'=>'form-control', 'data-plugin' => 'formatter', 'data-pattern' => '([[99]]) [[99999]]-[[9999]]', 'placeholder' => '(99) 99999-9999']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cell_phone', 'Celular: *') !!}
            {!! Form::text('cell_phone', null, ['class'=>'form-control', 'data-plugin' => 'formatter', 'data-pattern' => '([[99]]) [[99999]]-[[9999]]', 'placeholder' => '(99) 99999-9999', 'required' => 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('birth', 'Data de Nascimento: *') !!}
            {!! Form::text('birth', null, ['class'=>'form-control', 'data-plugin' => 'formatter', 'data-pattern' => '[[99]]/[[99]]/[[9999]]', 'placeholder' => '99/99/9999', 'requried' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cpf', 'CPF:') !!}
            {!! Form::text('cpf', null, ['class'=>'form-control', 'data-plugin' => 'formatter', 'data-pattern' => '[[999]].[[999]].[[999]]-[[99]]', 'placeholder' => '999.999.999-99']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('marital_status', 'Estado Cívil: *') !!}
            {!! Form::select('marital_status', ['Solteiro' => 'Solteiro','Casado' => 'Casado'], null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('Sexo', 'Sexo: *') !!}
            {!! Form::select('sex', ['m' => 'Masculino','f' => 'Feminino'], null, ['class'=>'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>

<hr/>
<h4>Escolaridade</h4>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('formation', 'Formação:') !!}
            {!! Form::text('formation', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('institution', 'Instituição:') !!}
            {!! Form::text('institution', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('conclusion', 'Conclusão:') !!}
            {!! Form::text('conclusion', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<hr/>
<h4>Profissional</h4>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('profession', 'Profissão:') !!}
            {!! Form::text('profession', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('company', 'Empresa:') !!}
            {!! Form::text('company', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<hr/>
<h4>Minhas redes</h4>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('facebook', 'Facebook:') !!}
            {!! Form::text('facebook', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('twitter', 'Twitter:') !!}
            {!! Form::text('twitter', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('linkedin', 'LinkedIn:') !!}
            {!! Form::text('linkedin', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('google_plus', 'Google Plus:') !!}
            {!! Form::text('google_plus', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('instagram', 'Instagram:') !!}
            {!! Form::text('instagram', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('snapchat', 'Snapchat:') !!}
            {!! Form::text('snapchat', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('site', 'Website ou blog:') !!}
            {!! Form::text('site', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<input type="hidden" value="{{$dados->user_role_id}}" name="user_role_id" />
