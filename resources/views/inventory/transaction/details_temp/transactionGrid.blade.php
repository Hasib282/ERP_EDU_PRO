<table class="show-table">
    <caption class="caption">Temporary Transection Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Train Id</th>
            <th>Supplier</th>
            <th>Client</th>
            <th>SL</th>
            <th>Product</th>
            <th>Receive Qty</th>
            <th>Cp</th>
            <th>Mrp</th>
            <th>Discount</th>
            <th>Profit</th>
            <th>Receive Id</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($current_transaction as $key => $item)
            <tr>
                <td>{{ $current_transaction->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->supplier_id }}</td>
                <td>{{ $item->client_id }}</td>
                <td>{{ $item->sl }}</td>
                <td>{{ $item->product_id }}</td>
                <td>{{ $item->receive_qty }}</td>
                <td>{{ $item->cp }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->profit }}</td>
                <td>{{ $item->receive_id }}</td>
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
</table>

