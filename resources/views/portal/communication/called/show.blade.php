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
        <label for="assunto"><strong>Público?</strong></label>
        <p class="form-control-static">@if($dados['visible'] == 'y') Sim @else Não @endif</p>
    </div>
    <div class="col-md-4">
        <label for="assunto"><strong>Data de Abertura</strong></label>
        <p class="form-control-static">{{ date('d/m/Y h:i', strtotime($dados['created_at'])) }}</p>
    </div>
    @if($dados['called_status_id'] != 1)
    <?php
    $dateEncerramento = end($dados['calledHistoric']);
    $createdAt = '';
    foreach($dateEncerramento  as $date){
        $createdAt = $date->created_at;
    }
    ?>
    <div class="col-md-4">
        <label for="assunto"><strong>Data de Encerramento</strong></label>
        <p class="form-control-static">{{ date('d/m/Y h:i', strtotime($createdAt)) }}</p>
    </div>
    @endif
</div>
@if(!$dados['calledHistoric']->isEmpty())
    <hr>
    <h4>Andamento</h4>
    <?php
        $total = $dados['calledHistoric']->count();
        $cont = 0;
    ?>
    @foreach($dados['calledHistoric']  as $row)
        <?php $cont++; ?>
        <div class="row">
            <div class="col-md-12">
                <strong>CRIADO EM</strong> {{ date('d/m/Y h:i', strtotime($row['created_at'])) }}
                <strong>POR</strong> {{ $row['usersCondominium']['user']['name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $row['description'] }}<br />
                @if($total > $cont)
                ----------------------------------------------------------------------------------------------------
                @endif
            </div>
        </div>
    @endforeach
    <hr>
@endif