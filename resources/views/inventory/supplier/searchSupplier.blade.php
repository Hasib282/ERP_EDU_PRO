<table class="show-table">
    <caption class="caption">Supplier Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Supplier Name</th>
            <th>Supplier Email</th>
            <th>Supplier Contact</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_supplier as $key => $item)
            <tr>
                <td>{{ $inv_supplier->firstItem() + $key }}
                </td>
                <td>{{ $item->sup_name }}</td>
                <td>{{ $item->sup_email }}</td>
                <td>{{ $item->sup_contact }}</td>
                <td>{{ $item->UserName->name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Supplier_Info" data-status="{{$item->status}}" data-target=".supplier">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Supplier_Info" data-status="{{$item->status}}" data-target=".supplier">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editSupplierModal" data-modal-id="editSupplierModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteSupplier" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Supplier Name</th>
            <th>Supplier Email</th>
            <th>Supplier Contact</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center search-paginate">
    {!! $inv_supplier->links() !!}
</div>
