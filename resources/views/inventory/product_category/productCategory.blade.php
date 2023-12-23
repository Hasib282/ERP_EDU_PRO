@extends('admin.layouts/layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="card">
        <div class="card-header">
            <div class="title">
                <h3 class="card-title"><a href="{{ route('add.productCatagory') }}"><button class="add">Add Product Category</button></a></h3>
            </div>
            <div class="create-new">
                
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
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Product Category Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($inv_product_category as $key => $item)
                    <tr class="odd">
      
                      <td class="dtr-control sorting_1" tabindex="0">{{ $key+1 }}</td>
                      <td>{{ $item->product_category_name }}</td>
                      <td>
                        @if($item->status==1)
                            <a href="{{ route('status',['table_name' => 'Inv_Product_Category', 'id' => $item->id, 'status' => $item->status] ) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>Active</a>
                        @else
                            <a href="{{ route('status',['table_name' => 'Inv_Product_Category', 'id' => $item->id, 'status' => $item->status]) }}" class="btn btn-danger btn-sm">Inactive</a>
                        @endif
                      </td>
                      <td style="display: flex;gap:5px;">
      
                        <a href="{{ route('edit.productCatagory',$item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
        
                        <form action="{{ route('delete.productCatagory',$item->id) }}" method="post">
                          @csrf
                          @method('Delete')
                          <button class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>Delete</button>
                        </form>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>

    
@endsection



