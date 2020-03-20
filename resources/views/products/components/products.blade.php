<table class="table table-striped table-hover">
    <thead>
    <tr><th>ID</th><th>Наименование</th><th>Поставщик</th><th>Цена</th></tr>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr product-id="{{$product->id}}">
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->vendor->name}}</td>
        <td><input type="decimal" class="productPrice" value="{{$product->price}}"></td>
    </tr>
    @endforeach
    </tbody>
</table>
