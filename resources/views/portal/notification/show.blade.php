<a data-toggle="dropdown" href="javascript:void(0)" title="Notifications" aria-expanded="false"
   data-animation="scale-up" role="button">
    <i class="icon md-notifications" aria-hidden="true"></i>
    <span class="badge badge-danger up">{{ $totalClick }}</span>
</a>
<ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
    <li class="dropdown-menu-header" role="presentation">
        <h5>NOTIFICAÇÕES</h5>
        @if($notification->toArray())
        <span class="label label-round label-danger">Novas {{ $totalClick }}</span>
        @endif
    </li>
   <li class="list-group" role="presentation">
        <div data-role="container">
            <div data-role="content">
                @if($notification->toArray())
                @foreach($notification as $row)
                <a class="list-group-item" href="{{ $row->route }}" role="menuitem">
                    <div class="media">
                        <div class="media-left padding-right-10">
                            <i class="icon md-order bg-red-600 white icon-circle"
                               aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">{{ $row->name }}</h6>
                            <time class="media-meta" datetime="2016-06-12T20:50:48+08:00">
                                {{ date('d/m/Y H:i', strtotime($row->created_at)) }}
                            </time>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                @endif
            </div>
        </div>
    </li>
    <li class="dropdown-menu-footer" role="presentation">
        <a href="{{ route('portal.notification.index') }}" role="menuitem">
            Todas as notificações
        </a>
    </li>
</ul>