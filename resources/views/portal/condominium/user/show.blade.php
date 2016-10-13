@extends('portal')

@section('content')

    <div class="page animsition page-profile">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.condominium.index') }}">Condomínio</a></li>
                <li><a href="{{ route('portal.condominium.user.index') }}">Integrantes</a></li>
                <li class="active">Perfil</li>
            </ol>
            <div class="page-header-actions">
                <a href="{{ route('portal.condominium.user.index') }}"
                   class="btn btn-sm btn-icon btn-dark waves-effect waves-light waves-round" data-toggle="tooltip"
                   data-original-title="Voltar">
                    <i class="icon wb-arrow-left" aria-hidden="true"></i>
                    Voltar
                </a>
            </div>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="widget widget-shadow text-center">
                        <div class="widget-header">
                            <div class="widget-header-content">
                                @if($dados->user->imagem)
                                    <a class="avatar avatar-lg" href="javascript:void(0)">
                                        <img src="{{ route('portal.condominium.user.image', ['id' => $dados->user->id, 'image' => $dados->user->imagem]) }}"
                                             alt="...">
                                    </a>
                                @else
                                    <a class="avatar avatar-lg" href="javascript:void(0)">
                                        <img src="../../../global/portraits/5.jpg" alt="...">
                                    </a>
                                @endif
                                <h4 class="profile-user">{{$dados->user->name}}</h4>
                                <p class="profile-job">{{$dados->userRoleCondominium->name}}</p>
                                <p>
                                    E-mail: {{$dados->user->email}}<br/>
                                    @if($dados->user->phone)
                                        Telefone: {{$dados->user->phone}}<br/>
                                    @endif
                                    @if($dados->user->cell_phone)
                                        Celular: {{$dados->user->cell_phone}}<br/>
                                    @endif
                                </p>
                                <div class="profile-social">
                                    <a class="icon bd-twitter" href="javascript:void(0)"></a>
                                    <a class="icon bd-facebook" href="javascript:void(0)"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body container-fluid">
                            <div class="article-content">
                                @if($dados->user->description);
                                <section>
                                    <h4 id="section-1">Sobre mim:</h4>
                                    <p>{{ $dados->user->description }}</p>
                                </section>
                                @endif
                                @if($usersUnit->toArray())
                                <section>
                                    <h4 id="section-2">Unidades:</h4>
                                    <p>
                                        <?php
                                        $cont = 0;
                                        foreach ($usersUnit as $unit) {
                                            $cont++;
                                            if ($cont > 1) {
                                                echo '<br />';
                                            }
                                            echo $unit->unit->name . ' - ' . $unit->unit->block->name;
                                        }
                                        ?>
                                    </p>
                                </section>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection