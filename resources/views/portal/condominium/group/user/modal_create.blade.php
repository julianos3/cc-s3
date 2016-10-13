<div class="modal fade modal-success" id="modalGroupUser" aria-hidden="true" aria-labelledby="modalGroupUser"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            {!! Form::open(['route'=>'portal.condominium.group.user.store']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Adicionar Integrante</h4>
            </div>
            <div class="modal-body">
                @include('portal.condominium.group.user._form')
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>