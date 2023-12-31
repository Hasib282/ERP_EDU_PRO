@extends('admin.layouts/layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="card">
        <div class="card-header">
            <div class="title">
                <button class="open-modal add" modal-id="addUnitModal">Add Unit</button>
            </div>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed"role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL:</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Unit Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Unit Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inv_unit as $key => $item)
                                    <tr class="odd">
                        
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $key+1 }}</td>
                                        <td>{{ $item->unit_name }}</td>
                                        <td>
                                            @if($item->status==1)
                                                <a href="{{ route('status',['table_name' => 'Inv_Unit', 'id' => $item->id, 'status' => $item->status] ) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>Active</a>
                                            @else
                                                <a href="{{ route('status',['table_name' => 'Inv_Unit', 'id' => $item->id, 'status' => $item->status]) }}" class="btn btn-danger btn-sm">Inactive</a>
                                            @endif
                                        </td>
                                        <td style="display: flex;gap:5px;">
                                            <button class="btn btn-info btn-sm open-modal editUnitModal" modal-id="editUnitModal" data-id="{{ $item->id }}" data-unitname="{{ $item->unit_name }}"  data-status="{{ $item->status }}"><i class="fas fa-edit"></i>Edit</button>
                                            {{-- <a href="{{ route('edit.units',$item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Edit</a> --}}
                                            <button class="btn btn-danger btn-sm deleteUnit" data-id="{{ $item->id }}" id="delete"><i class="fas fa-trash"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th rowspan="1" colspan="1">SL:</th>
                                <th rowspan="1" colspan="1">Unit Name</th>
                                <th rowspan="1" colspan="1">Unit Status</th>
                                <th rowspan="1" colspan="1" style="display: none;">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @include('inventory.unit.addUnitModal')

    @include('inventory.unit.editUnitModal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    

    
@endsection

@section('script')
      <script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection



{{-- ajax part start from here --}}
@section('ajax')
<script>
    $(document).ready(function(){
        //Add Unit part ajax start
        $(document).on('click','#addUnit',function(e){
            e.preventDefault();
            let unitName = $('#unitName').val();
            $.ajax({
                url:"{{ route('insert.units') }}",
                method:'post',
                data:{unitName:unitName},
                success:function(res){
                    if(res.status == "success"){
                        $('#addUnitModal').hide();
                        $('#AddUnitForm')[0].reset();
                        $('.table').load(location.href+" .table");
                    }
                },
                error:function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function(key, value){
                        $('#' + key + "_error").text(value);
                    })
                }
            });
        });

        

        //Edit Unit Part Ajax Start
        $(document).on('click','.editUnitModal',function(){
            let id = $(this).data('id');
            let fetchDetailsUrl = "{{ route('edit.units', ['id' => ':id']) }}".replace(':id', id);
            $.ajax({
                url: fetchDetailsUrl,
                method:'get',
                success:function(res){
                    $('#updateUnitId').val(res.inv_unit.id);
                    $('#updateUnitName').val(res.inv_unit.unit_name);

                    // Create options dynamically based on the status value
                    $('#updateStatus').html(`<option value="1" ${res.inv_unit.status === 1 ? 'selected' : ''}>Active</option>
                                             <option value="0" ${res.inv_unit.status === 0 ? 'selected' : ''}>Inactive</option>`);
                },
                error:function(err) {
                    console.log(err);
                }
            });
        });

        //update unit part Ajax start
        $(document).on('click','#updateUnit',function(e){
            e.preventDefault();
            let id = $('#updateUnitId').val();
            let unitName = $('#updateUnitName').val();
            let status = $('#updateStatus').val();
            $.ajax({
                url:"{{ route('update.units', ['id' => ':id']) }}".replace(':id', id),
                method:'Put',
                data:{unitName:unitName,status:status},
                success:function(res){
                    if(res.status == "success"){
                        $('#editUnitModal').hide();
                        $('#EditUnitForm')[0].reset();
                        $('.table').load(location.href+" .table")
                    }
                },
                error:function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function(key, value){
                        $('#update_' + key + "_error").text(value);
                    })
                }
            });
        });





        //delete unit part Ajax start
        $(document).on('click','.deleteUnit',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            if(confirm('Are You Sure to Delete This Unit ??')){
                $.ajax({
                url:"{{ route('delete.units', ['id' => ':id']) }}".replace(':id', id),
                method:'Delete',
                success:function(res){
                    if(res.status == "success"){
                        $('.table').load(location.href+" .table");
                    }
                }
            });
            }
        });
    });
</script>
@endsection


