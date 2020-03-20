<ul class="list-group">
    @foreach($products as $product)
        <li class="list-group-item"><span class="badge">{{$product->pivot->quantity}}</span>{{$product->name}}</li>
    @endforeach
</ul>
