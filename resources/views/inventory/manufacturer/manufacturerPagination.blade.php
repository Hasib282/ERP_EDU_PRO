<table class="show-table">
    <caption class="caption">Manufacturer Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Manufacturer Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_manufacturer as $key => $item)
            <tr>
                <td>{{ $inv_manufacturer->firstItem() + $key }}</td>
                <td>{{ $item->manufacturer_name }}</td>
                <td>{{ $item->manufacturer_email }}</td>
                <td>{{ $item->manufacturer_contact }}</td>
                <td>{{ $item->UserName->name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Manufacturer_Info" data-status="{{$item->status}}" data-target=".manufacturer">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Manufacturer_Info" data-status="{{$item->status}}" data-target=".manufacturer">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editManufacturerModal"
                        data-modal-id="editManufacturerModal" data-id="{{ $item->id }}"><i
                            class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteManufacturer" data-id="{{ $item->id }}"
                        id="delete"><i class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Manufacturer Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center paginate">
    {!! $inv_manufacturer->links() !!}
</div>
