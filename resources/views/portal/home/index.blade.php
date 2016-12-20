@extends('portal')

@section('content')

    <div class="page animsition">
        <div class="page-content">
            <div class="panel">
                home do sistema
                <div class="row">
                    <div class="col-md-12">
                        CHAMADAS DA HOME<br />
                        - Usuários para aprovação no sistema<br />
                        - Agenda<br />
                        - Próximas manutenções preventivas<br />
                        - Contratos próximos a vencer<br />
                        - Ultimos chamados<br />
                        - Ultimas do forum]<br />
                        - Ultimas comunicados<br />
                        - Mural de recados<br />
                        - assembleia
                        -
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        ITENS QUE FALTA<br />
                        - Alterar senha, colocar link no submenu do topo<br />
                        - Assinatura<br />
                        - Cielo - 4002.5472
                    </div>
                </div>
            </div>
            <!-- End Panel -->
            {{session()->get('image')}}
        </div>
    </div>

@endsection