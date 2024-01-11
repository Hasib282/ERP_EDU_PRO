<table class="show-table">
    <caption class="caption">Unit Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Unit Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_unit as $key => $item)
            <tr>
                <td>{{ $inv_unit->firstItem() + $key }}</td>
                <td>{{ $item->unit_name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Unit" data-status="{{$item->status}}" data-target=".unit">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Unit" data-status="{{$item->status}}" data-target=".unit">Inactive</button>
                    @endif
                </td>
                <td style="display: flex; gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editUnitModal" data-modal-id="editUnitModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteUnit" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Unit Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center paginate">
    {{ $inv_unit->links() }}
</div>
