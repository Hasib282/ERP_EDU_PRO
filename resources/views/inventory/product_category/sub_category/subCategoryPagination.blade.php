<table class="show-table">
    <caption class="caption">Product Sub Category Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Sub Category Name</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sub_category as $key => $item)
            <tr>
                <td>{{ $sub_category->firstItem() + $key }}</td>
                <td>{{ $item->sub_category_name }}</td>
                <td>{{ $item->CategoryName->product_category_name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product_Sub_Category" data-status="{{$item->status}}" data-target=".sub-category">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product_Sub_Category" data-status="{{$item->status}}" data-target=".sub-category">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editProductSubCategoryModal"
                        data-modal-id="editProductSubCategoryModal" data-id="{{ $item->id }}"><i
                            class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteProductSubCategory" data-id="{{ $item->id }}"
                        id="delete"><i class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Sub Category Name</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center paginate" id="paginate">
    {!! $sub_category->links() !!}
</div>
