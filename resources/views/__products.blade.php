<table class="table table-bordered table-responsive">
    <tr>
        <th>name</th>
        <th>price</th>
        <th>category</th>
        <th>actions</th>
    </tr>
    @foreach($categories as $category)
        @foreach($category->products as $product)
            <tr>
                <td>{!! $product->name !!}</td>
                <td>{!! $product->price !!}</td>
                <td>{!! $product->category->name !!}</td>
                <td>
                    <a class='btn btn-primary edit' id='{!! $product->id !!}'>edit</a>
                    <a class='btn btn-danger delete' id='{!! $product->id !!}'>delete</a>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
