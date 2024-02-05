@foreach ($current_transaction as $key => $item)
    <tr>
        <td>{{ $current_transaction->firstItem() + $key }}</td>
        <td>{{ $item->supplier_id }}</td>
        <td>{{ $item->product_id }}</td>
        <td>{{ $item->receive_qty }}</td>
        <td>{{ $item->cp }}</td>
        <td>{{ $item->tot_cp }}</td>
        <td>{{ $item->discount }}</td>
        <td style="display: flex;gap:5px;">
            <button class="btn btn-danger btn-sm deleteReceive" data-id="{{ $item->id }}" id="delete"><i
                    class="fas fa-trash"></i></button>
        </td>
    </tr>
@endforeach
