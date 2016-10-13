@if(!$dados->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <table class="tablesaw table-striped table-bordered table-hover"
                   data-tablesaw-mode="swipe"
                   data-tablesaw-sortable data-tablesaw-minimap>
                <thead>
                <tr>
                    <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                        data-tablesaw-priority="persist">Observação
                    </th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">Data Realizada</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="2">Fornecedor</th>
                    <th class="text-center col-md-3">
                        Ação
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($dados  as $row)
                    <tr>
                        <td>{{ $row->description }}</td>
                        <td>{{ date('d/m/Y', strtotime($row->date)) }}</td>
                        <td>{{ $row->provider->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('portal.manage.maintenance.completed.edit', ['id' => $row->id]) }}"
                               title="Editar"
                               data-toggle="tooltip"
                               data-original-title="Editar"
                               class="btn btn-icon bg-warning waves-effect waves-light">
                                <i class="icon wb-edit" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-title text-center">
                Nenhum registro realizado.
            </h4>
        </div>
    </div>
@endif