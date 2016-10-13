@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li><a href="{{ route('portal.condominium.security-cam.index') }}">Câmeras de Segurança</a></li>
                <li class="active">{{ $config['title'] }}</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.condominium.security-cam.index') }}"
                   class="btn btn-sm btn-icon btn-dark waves-effect waves-light waves-round" data-toggle="tooltip"
                   data-original-title="Voltar">
                    <i class="icon wb-arrow-left" aria-hidden="true"></i>
                    Voltar
                </a>
            </div>
        </div>

        <div class="page-content container-fluid">
        @if(!$dados->isEmpty())
            @foreach($dados  as $row)
            <div class="col-lg-4 col-sm-6">
                <div class="widget widget-shadow" id="widgetLineareaOne">
                    <div class="widget-content">
                        <div class="padding-20 padding-top-10">
                            <h4>{{ $row->name }}</h4>
                            <iframe width="100%" height="" src="{{ $row->url }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-title">
                        <br />
                        Nenhuma câmera encontrada.
                    </h4>
                </div>
            </div>
        @endif
        </div>
    </div>

@endsection