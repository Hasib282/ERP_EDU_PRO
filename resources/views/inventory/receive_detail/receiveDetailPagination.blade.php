<table class="show-table">
    <caption class="caption">Inventory Receive Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Supplier</th>
            <th>Invoice</th>
            <th>Product</th>
            <th>Batch</th>
            <th>CP</th>
            <th>Discount</th>
            <th>Expiry Date</th>
            <th>Quantity</th>
            <th>MRP</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_receive_details as $key => $item)
            <tr>
                <td>{{ $inv_receive_details->firstItem() + $key }}</td>
                <td>{{ $item->SupplierName->sup_name }}</td>
                <td>{{ $item->invoice_no }}</td>
                <td>{{ $item->ProductName->product_name }}</td>
                <td>{{ $item->batch_no }}</td>
                <td>{{ $item->cp }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->expiry_date }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->UserName->name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Receive_Detail" data-status="{{$item->status}}" data-target=".receive-detail">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Receive_Detail" data-status="{{$item->status}}" data-target=".receive-detail">Inactive</button>
                    @endif
                </td>
                <td style="display: flex; gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editReceiveDetailModal"
                        data-modal-id="editReceiveDetailModal" data-id="{{ $item->id }}"><i
                            class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteReceiveDetail" data-id="{{ $item->id }}"
                        id="delete"><i class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Supplier</th>
            <th>Invoice</th>
            <th>Product</th>
            <th>Batch</th>
            <th>CP</th>
            <th>Discount</th>
            <th>Expiry Date</th>
            <th>Quantity</th>
            <th>MRP</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center paginate">
    {{ $inv_receive_details->links() }}
</div>
