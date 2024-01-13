<table class="show-table">
    <caption class="caption">Product Category Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_product_category as $key => $item)
            <tr>
                <td>{{ $inv_product_category->firstItem() + $key }}
                </td>
                <td>{{ $item->product_category_name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product_Category" data-status="{{$item->status}}" data-target=".category">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product_Category" data-status="{{$item->status}}" data-target=".category">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editProductCategoryModal" data-modal-id="editProductCategoryModal" data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteProductCategory" data-id="{{ $item->id }}" id="delete"><i class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center paginate" id="paginate">
    {!! $inv_product_category->links() !!}
</div>
