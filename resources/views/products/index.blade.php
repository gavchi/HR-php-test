@extends('layout')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Продукты</div>
        <div class="panel-body">
            @component('products.components.products', ['products' => $products])
            @endcomponent
            {{ $products->links() }}
        </div>
    </div>
@endsection
