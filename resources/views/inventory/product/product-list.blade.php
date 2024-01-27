<table class="show-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category </th>
            <th>SubCategory </th>
            <th>Manufacturer</th>
            <th>Size</th>
            <th>MRP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inv_product as $key => $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->CategoryName->product_category_name }}</td>
                <td>{{ $item->SubCategory->sub_category_name }}</td>
                <td>{{ $item->ManufacturerName->manufacturer_name }}</td>
                <td>{{ $item->size }}{{ $item->UnitName->unit_name }}</td>
                <td>{{ $item->mrp }}Tk.</td>
                <td>{{ $item->cp }}Tk.</td>
            </tr>
        @endforeach
    </tbody>
</table>