<table class="table table-striped table-hover">
    <thead>
    <tr><th>ID</th><th>Партнер</th><th>Стоимость</th><th>Наименование</th><th>Статус</th></tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    <tr>
        <td><a href="/orders/{{$order->id}}">{{$order->id}}</a></td>
        <td>{{$order->partner->name}}</td>
        <td>{{$order->getSumOrder()}}</td>
        <td>@component('orders.components.order-list', ['products' => $order->products])@endcomponent</td>
        <td>{{$order->getStatus()}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
