<div class="modal fade modal-success" id="modalComment" aria-hidden="true" aria-labelledby="modalComment"
     role="dialog" tabindex="-1">'
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            {!! Form::open(['route'=>'portal.communication.message.public.reply.store']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Comentar</h4>
                </div>
                <div class="modal-body text-center">

                    @include('portal.communication.message.public._comment_form')
                    <input type="hidden" name="message_id" id="messageId" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                    {!! Form::button('Salvar', ['type' => 'submit', 'class'=>'btn btn-raised btn-primary waves-effect waves-light']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>