<table class="show-table">
    <thead>
        <caption class="caption">Client Details</caption>
        <tr>
            <th>SL:</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Insertd By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_client as $key => $item)
            <tr>
                <td>{{ $inv_client->firstItem() + $key }}</td>
                <td>{{ $item->client_name }}</td>
                <td>{{ $item->client_email }}</td>
                <td>{{ $item->client_contact }}</td>
                <td>{{ $item->client_address }}</td>
                <td>{{ $item->UserName->name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editClientModal" data-modal-id="editClientModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteClient" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Insertd By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center paginate" id="paginate">
    {!! $inv_client->links() !!}
</div>
