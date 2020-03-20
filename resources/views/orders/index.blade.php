@extends('layout')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Заказы</div>
        <div class="panel-body">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#expired" aria-controls="expired" role="tab" data-toggle="tab">Просроченные</a></li>
                    <li role="presentation"><a href="#current" aria-controls="current" role="tab" data-toggle="tab">Текущие</a></li>
                    <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Новые</a></li>
                    <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">Выполненные</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="expired">
                        @component('orders.components.orders', ['orders' => $expiredOrders])
                        @endcomponent
                    </div>
                    <div role="tabpanel" class="tab-pane" id="current">
                        @component('orders.components.orders', ['orders' => $currentOrders])
                        @endcomponent
                    </div>
                    <div role="tabpanel" class="tab-pane" id="new">
                        @component('orders.components.orders', ['orders' => $newOrders])
                        @endcomponent
                    </div>
                    <div role="tabpanel" class="tab-pane" id="completed">
                        @component('orders.components.orders', ['orders' => $completedOrders])
                        @endcomponent
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
