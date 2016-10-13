@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li class="active">Cadastrar</li>
            </ol>
        </div>
        <div class="page-content container-fluid">
            <div class="panel">
                <div class="panel-body">
                    <div role="alert" class="alert dark alert-info alert-icon alert-dismissible">
                        <i class="icon md-notifications" aria-hidden="true"></i>
                        <h4>Atenção</h4>
                        <p>
                            Informe o endereço do seu condomínio para se comunicar.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <!-- Steps -->
                                    <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
                                        <div class="step col-md-6 current" data-target="#addressCondominium" role="tab">
                                            <span class="step-number">1</span>
                                            <div class="step-desc">
                                                <span class="step-title">Localizar</span>
                                                <p>Endereço do seu condomínio</p>
                                            </div>
                                        </div>
                                        <div class="step col-md-6" data-target="#info" role="tab">
                                            <span class="step-number">2</span>
                                            <div class="step-desc">
                                                <span class="step-title">Verificação</span>
                                                <p>Verificação de cadastro do condomínio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wizard-content">
                                        <div class="wizard-pane active" id="" role="tabpanel">
                                            <form id="" method="post" action="{{ route('portal.condominium.update') }}">
                                                {!! csrf_field() !!}
                                                @include('errors._check')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="cep">CEP</label>
                                                            <input type="text" class="form-control" data-plugin="formatter" data-pattern="[[99999]]-[[999]]" placeholder="99999-999" id="cep" name="zip_code" value="{{ $dados['zip_code'] }}" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" id="btnCep" target="_blank"
                                                               class="btn btn-icon btn-warning waves-effect waves-light waves-round" data-toggle="tooltip"
                                                               data-original-title="Não sei meu CEP">
                                                                <i class="icon wb-search" aria-hidden="true"></i>
                                                                Não sei meu CEP
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="address">Logradouro</label>
                                                            <input type="text" class="form-control" id="address" name="address" value="{{ $dados['address'] }}" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="number">Número</label>
                                                            <input type="text" class="form-control" id="number" name="number" value="{{ $dados['number'] }}" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="district">Bairro</label>
                                                            <input type="text" class="form-control" id="district" name="district" value={{ $dados['destrict'] }} required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="uf">Estado</label>
                                                            <select class="form-control" name="state_id" id="uf" required="required">
                                                                <option value="">Selecione</option>
                                                                @foreach($state as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="city">Cidade</label>
                                                            <select class="form-control" name="city_id" id="city" required="required">
                                                                <option value="">Selecione</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" class="btn btn-success"
                                                                data-toggle="tooltip"
                                                                data-original-title="Concluir cadastro">
                                                            <i class="icon wb-check" aria-hidden="true"></i>
                                                            Avançar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection