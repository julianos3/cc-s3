<div class="form-group">
    {!! Form::label('reason', 'Motivo/Razão:') !!}
    {!! Form::text('reason', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Data Inicio', 'Data Inicio:') !!}
    {!! Form::input('datetime', 'start_date',  null, ['class'=>'form-control', 'placeholder'=>'99/99/99 99:99:99']) !!}
</div>

<div class="form-group">
    {!! Form::label('Data Fim', 'Data Fim:') !!}
    {!! Form::input('datetime', 'end_date', null, ['class'=>'form-control', 'placeholder'=>'99/99/99 99:99:99']) !!}
</div>

<div class="form-group">
    {!! Form::label('Dia inteiro?', 'Dia inteiro?') !!}
    {!! Form::select('all_day', ['y' => 'Sim','n' => 'Não'], null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Condomínio', 'Condomínio:') !!}
    {!! Form::select('condominium_id', $condominium, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="Block">Usuarios Condominio:</label>
    <select class="form-control" name="user_condominium_id">
        @foreach($userCondominium as $row)
            <option value="{{ $row->id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->user->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="Block">Área de Reserva:</label>
    <select class="form-control" name="reserve_area_id">
        @foreach($reserveAreas as $row)
            <option value="{{ $row->id }}" @if ($row->id === $userCondominiumId) selected @endif>{{ $row->name .' - '.$row->condominium->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    {!! Form::label('Descrição', 'Descrição') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>