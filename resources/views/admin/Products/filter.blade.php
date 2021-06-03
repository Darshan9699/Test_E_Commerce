<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Products_Id</th>
        <th>Product_Name </th>
        <th>Products Url(slug) (s)</th>
        <th>Product Details</th>
        <th>Product_pirce</th>
        <th>Product_Description</th>
        <th>featured</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach ($Products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name  }}</td>
            <td>{{ $product->slug  }}</td>
            <td>{{ $product->details }}</td>
            <td>{{ $product->product_pirce }}</td>
            <td>{{ $product->product_description }}</td>
            <td>
                <input type="checkbox" class="toggle-class" data-bootstrap-switch data-on="Avilable" data-off="Not Avilable" data-onstyle="danger" data-offstyle="success" data-id={{ $product->id }} {{ $product->featured ? 'checked' : '' }}>
            </td>
            <td>
                <a href="{{ route('admin.view',[$product->id]) }}" class="btn btn-block btn-success">View</a>
                <a href="{{ route('admin.edit',[$product->id]) }}" class="btn btn-block btn-danger">Edit</a>
                <br>
                <form action="{{ route('admin.destroy', $product->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-block btn-warning" style="margin-top: .5rem" onclick="return confirm('are you sure you want to delete this Products')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Products_Id</th>
        <th>Product_Name </th>
        <th>Products Url(slug) (s)</th>
        <th>Product Details</th>
        <th>Product_pirce</th>
        <th>Product_Description</th>
        <th>featured</th>
        <th>Actions</th>
    </tr>
    </tfoot>
</table>

