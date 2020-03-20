@extends('layout')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>Брянск</h1>
            <p>{{$weather->getDescription()}}</p>
            <p>Температура: {{$weather->getTemperature()}} ℃</p>
            <p>Ветер: {{$weather->getWindSpeed()}} <span class="wind-direction" style='--rotation: {{$weather->getWindDirection()}}deg;'>&rarr;</span></p>
            <p>Облачность: {{$weather->getClouds()}}</p>
            <p>Сервис: <a href="https://openweathermap.org/city/571476" target="_blank">openweathermap.org</a></p>
        </div>
    </div>
@endsection
