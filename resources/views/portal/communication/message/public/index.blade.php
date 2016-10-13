@extends('portal')

@section('content')
    <div class="page animsition">
        <div class="page-header">
            <h1 class="page-title">{{ $config['title'] }}</h1>
            <ol class="breadcrumb" data-plugin="breadcrumb">
                <li><a href="{{ route('portal.home.index') }}">Home</a></li>
                <li><a href="{{ route('portal.communication.index') }}">Comunicação</a></li>
                <li class="active">Mensagens Públicas</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body">
                    @include('success._check')
                    @include('errors._check')
                    @include('portal.delete')
                    @include('portal.communication.message.public._comment')

                    <a href="{{ route('portal.communication.message.public.create') }}"
                       data-toggle="tooltip"
                       data-original-title="Cadastrar"
                       class="btn btn-primary waves-effect waves-light">
                        <i class="icon wb-plus" aria-hidden="true"></i>
                        Cadastrar
                    </a>
                    @if(!$dados->isEmpty())
                        <ul class="list-group">
                            @foreach($dados  as $row)
                                <li class="list-group-item">
                                    <div class="media media-lg">
                                        <div class="media-left">
                                            <a class="avatar" href="javascript:void(0)">
                                                <img class="img-responsive"
                                                     src="{{ route('portal.condominium.user.image', ['id' => $row->usersCondominium->user->id, 'image' => $row->usersCondominium->user->imagem]) }}"
                                                     alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                {{ $row->subject }}
                                                <span>{{ $row->usersCondominium->user->name }}</span>
                                            </h4>
                                            <small>{{ $row->created_at }}</small>
                                            <div class="media-body">
                                                <p>{{ $row->message }}</p>
                                                <button title="Comentar"
                                                        class="btn btn-icon bg-warning waves-effect waves-light btnComentarMsgPublic"
                                                        data-target="#modalComment" data-toggle="modal"
                                                        data-id="{{ $row->id }}">
                                                    Responder
                                                </button>
                                                <button title="Excluir"
                                                        class="btn btn-icon bg-danger waves-effect waves-light btnDelete"
                                                        data-target="#modalDelete" data-toggle="modal"
                                                        data-route="{{ route('portal.communication.message.public.destroy', ['id' => $row->id]) }}">
                                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            @if($row->messageReply->toArray())
                                                @foreach($row->messageReply as $reply)
                                                    <div class="profile-brief margin-top-10">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a class="avatar" href="javascript:void(0)">
                                                                    <img class="img-responsive"
                                                                         src="{{ route('portal.condominium.user.image', ['id' => $reply->usersCondominium->user->id, 'image' => $reply->usersCondominium->user->imagem]) }}"
                                                                         alt="...">
                                                                </a>
                                                            </div>
                                                            <div class="media-body padding-left-20">
                                                                <h4 class="media-heading">{{ $reply->usersCondominium->user->name }}</h4>
                                                                <small>{{ $reply->created_at }}</small>
                                                                <p>
                                                                    {{ $reply->message }}
                                                                    <a class="btnDelete"
                                                                       data-target="#modalDelete" data-toggle="modal"
                                                                       data-id="{{ $reply->id }}"
                                                                       data-route="{{ route('portal.communication.message.public.reply.destroy', ['id' => $reply->id]) }}"
                                                                       href="javascript:void(0);"
                                                                       title="Excluir">Excluir</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                        <!--
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <a class="avatar" href="javascript:void(0)">
                                        <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Ida Fleming
                                        <span>posted an updated</span>
                                    </h4>
                                    <small>active 14 minutes ago</small>
                                    <div class="profile-brief">“Check if it can be corrected with overflow : hidden”</div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media media-lg">
                                <div class="media-left">
                                    <a class="avatar" href="javascript:void(0)">
                                        <img class="img-responsive" src="../../../global/portraits/5.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Terrance Arnold
                                        <span>posted a new blog</span>
                                    </h4>
                                    <small>active 14 minutes ago</small>
                                    <div class="profile-brief">
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img class="img-responsive" src="../../../global/portraits/5.jpg" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body padding-left-20">
                                                <h4 class="media-heading">Getting Started</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Integer nec odio. Praesent libero. Sed
                                                    cursus ante dapibus diam. Sed nisi. Nulla quis
                                                    sem at nibh elementum imperdiet. Duis sagittis
                                                    ipsum. Praesent mauris.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        -->
                        </ul>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="page-title">
                                    <br/>
                                    Nenhum cadastro realizado.
                                </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('portal.communication.message.public.create') }}" title="Cadastrar"
       data-toggle="tooltip"
       data-original-title="Cadastrar"
       class="site-action site-floataction btn-raised btn btn-success btn-floating">
        <i class="icon md-plus" aria-hidden="true"></i>
    </a>

@endsection