<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">{{ $config['title'] }}</h4>
</div>
{!! Form::model($dados, ['route'=>['portal.condominium.group.update', $dados->id]]) !!}
<div class="modal-body">
    @include('portal.condominium.group._form')
</div>
<div class="modal-footer text-right">
    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
    {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
</div>
{!! Form::close() !!}
