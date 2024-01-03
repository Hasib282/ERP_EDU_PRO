<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
    <div class="row">
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed"role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL:</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Division</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">District</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">City</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Area</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Road No</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inv_location as $key => $item)
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">{{ $inv_location->firstItem() + $key }}</td>
                            <td>{{ $item->division }}</td>
                            <td>{{ $item->district_name }}</td>
                            <td>{{ $item->city_name }}</td>
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
                                    <a href="{{ route('status', ['table_name' => 'Inv_Location', 'id' => $item->id, 'status' => $item->status]) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>Active</a>
                                @else
                                    <a href="{{ route('status', ['table_name' => 'Inv_Location', 'id' => $item->id, 'status' => $item->status]) }}" class="btn btn-danger btn-sm">Inactive</a>
                                @endif
                            </td>
                            <td style="display: flex;gap:5px;">
                                <button class="btn btn-info btn-sm open-modal editLocationModal" data-modal-id="editLocationModal" data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                                <button class="btn btn-danger btn-sm deleteLocation" data-id="{{ $item->id }}" id="delete"><i class="fas fa-trash"></i>Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">SL:</th>
                        <th rowspan="1" colspan="1">Division</th>
                        <th rowspan="1" colspan="1">District</th>
                        <th rowspan="1" colspan="1">City</th>
                        <th rowspan="1" colspan="1">Area</th>
                        <th rowspan="1" colspan="1">Road No</th>
                        <th rowspan="1" colspan="1">Status</th>
                        <th rowspan="1" colspan="1">Action</th>
                    </tr>
                </tfoot>
            </table>

            <div class="center paginate">
                {!! $inv_location->links() !!}
            </div>
        </div>
    </div>
</div>
