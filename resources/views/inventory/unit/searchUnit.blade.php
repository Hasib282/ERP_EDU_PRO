<div class="row">
    <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed"role="grid"
            aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL:</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Unit Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Status</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Engine version: activate to sort column ascending">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inv_unit as $key => $item)
                    <tr class="odd">
                        <td class="dtr-control sorting_1" tabindex="0">{{ $inv_unit->firstItem() + $key }}</td>
                        <td>{{ $item->unit_name }}</td>
                        <td>
                            @if ($item->status == 1)
                                <a href="{{ route('status', ['table_name' => 'Inv_Unit', 'id' => $item->id, 'status' => $item->status]) }}"
                                    class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>Active</a>
                            @else
                                <a href="{{ route('status', ['table_name' => 'Inv_Unit', 'id' => $item->id, 'status' => $item->status]) }}"
                                    class="btn btn-danger btn-sm">Inactive</a>
                            @endif
                        </td>
                        <td style="display: flex; gap:5px;">
                            <button class="btn btn-info btn-sm open-modal editUnitModal" data-modal-id="editUnitModal"
                                data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                            <button class="btn btn-danger btn-sm deleteUnit" data-id="{{ $item->id }}"
                                id="delete"><i class="fas fa-trash"></i>Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th rowspan="1" colspan="1">SL:</th>
                    <th rowspan="1" colspan="1">Unit Name</th>
                    <th rowspan="1" colspan="1">Status</th>
                    <th rowspan="1" colspan="1" style="display: none;">Action</th>
                </tr>
            </tfoot>
        </table>
        <div class="center search-paginate">
            {!! $inv_unit->links() !!}
        </div>
    </div>
</div>
