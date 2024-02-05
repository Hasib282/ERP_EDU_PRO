<table class="show-table">
    <caption class="caption">Temporary Transection Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Train Id</th>
            <th>Supplier</th>
            <th>Product</th>
            <th>Receive Qty</th>
            <th>Cp</th>
            <th>Mrp</th>
            <th>Discount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_transaction_temp as $key => $item)
            <tr>
                <td>{{ $inv_transaction_temp->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->supplier_id }}</td>
                <td>{{ $item->product_id }}</td>
                <td>{{ $item->receive_qty }}</td>
                <td>{{ $item->cp }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->discount }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTempReceiveTransactionModal" data-modal-id="editTempReceiveTransactionModal"
                        data-transaction="{{ $item->tran_id }}" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm deleteTempTransaction" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Train Id</th>
            <th>Supplier</th>
            <th>Product</th>
            <th>Receive Qty</th>
            <th>Cp</th>
            <th>Mrp</th>
            <th>Discount</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center paginate" id="paginate">
    {!! $inv_transaction_temp->links() !!}
</div>