Заказ № {{$order->id}} завершен!

<ul>
    @foreach($order->products as $product)
        <li>{{$product->name}} ({{$product->pivot->quantity}} шт.)</li>
    @endforeach
</ul>
<p>
    <b>Стоимость:</b> {{$order->getSumOrder()}}
</p>
