<table class="show-table">
    <caption class="caption">Location Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Division</th>
            <th>District</th>
            <th>City</th>
            <th>Area</th>
            <th>Road No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_location as $key => $item)
            <tr>
                <td>{{ $inv_location->firstItem() + $key }}</td>
                <td>{{ $item->division }}</td>
                <td>{{ $item->district }}</td>
                <td>{{ $item->city }}</td>
                <td>{{ $item->area }}</td>
                <td>
                    @if ($item->road_no == '' || $item->road_no == null)
                        null
                    @else
                        {{ $item->road_no }}
                    @endif
                </td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Location" data-status="{{$item->status}}" data-target=".location">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Location" data-status="{{$item->status}}" data-target=".location">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editLocationModal" data-modal-id="editLocationModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteLocation" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Division</th>
            <th>District</th>
            <th>City</th>
            <th>Area</th>
            <th>Road No</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center search-paginate">
    {!! $inv_location->links() !!}
</div>
