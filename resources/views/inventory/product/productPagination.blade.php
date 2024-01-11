<table class="show-table">
    <caption class="caption">Product Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Product Name</th>
            <th>Category </th>
            <th>Sub Category </th>
            <th>Manufacturer</th>
            <th>Size</th>
            <th>MRP</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_product as $key => $item)
            <tr>
                <td>{{ $inv_product->firstItem() + $key }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->CategoryName->product_category_name }}</td>
                <td>{{ $item->SubCategory->sub_category_name }}</td>
                <td>{{ $item->ManufacturerName->manufacturer_name }}</td>
                <td>{{ $item->size }}{{ $item->UnitName->unit_name }}</td>
                <td>{{ $item->mrp }}Tk.</td>
                <td>{{ $item->UserName->name }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product" data-status="{{$item->status}}" data-target=".product">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Product" data-status="{{$item->status}}" data-target=".product">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editProductModal" data-modal-id="editProductModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteProduct" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Product Name</th>
            <th>Category </th>
            <th>Sub Category </th>
            <th>Manufacturer</th>
            <th>Size</th>
            <th>MRP</th>
            <th>Inserted By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="center paginate">
    {!! $inv_product->links() !!}
</div>
