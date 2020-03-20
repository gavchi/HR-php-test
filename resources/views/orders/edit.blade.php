@extends('layout')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/orders/">Заказы</a></li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Заказ {{$order->id}}</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Заказ сохранен
            </div>
        @endif
        <div class="panel-body">
            <form action="/orders/{{$order->id}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="email">Email Клиента</label>
                    <input type="email" name="client_email" class="form-control" id="email" placeholder="Email" value="{{$order->client_email}}">
                </div>
                <div class="form-group">
                    <label for="partner">Партнер</label>
                    <select class="form-control" name="partner_id" id="partner">
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}" @if($partner->id === $order->partner->id) selected @endif>{{$partner->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p><b>Продукты</b></p>
                    @component('orders.components.order-list', ['products' => $order->products])@endcomponent
                </div>
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select class="form-control" name="status" id="status">
                        @foreach($order->getAvailableStatuses() as $value => $status)
                            <option value="{{$value}}" @if($value === $order->status) selected @endif>{{__('statuses.' . $status)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p><b>Стоимость:</b> {{$order->getSumOrder()}}</p>
                </div>
                <button type="submit" class="btn btn-default">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
