<table class="show-table">
    <caption class="caption">Store Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Store Name</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_store as $key => $item)
            <tr>
                <td>{{ $inv_store->firstItem() + $key }}</td>
                <td>{{ $item->store_name }}</td>
                <td>{{ $item->Location->division }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Store" data-status="{{$item->status}}" data-target=".store">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Store" data-status="{{$item->status}}" data-target=".store">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editStoreModal" data-modal-id="editStoreModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteStore" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Store Name</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center search-paginate">
    {!! $inv_store->links() !!}
</div>
