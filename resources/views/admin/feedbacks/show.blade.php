@extends('admin.app')

@section('title', 'Фидбек користувача ' . $feedback->name)

@section('content_header')
    <h1>Користувач {{ $feedback->name }}</h1>
@stop

@section('content')
    <div class="col-md-8">
        <h3>Опрацьований</h3>

        <div>{{ $feedback->active == 0 ? 'Так' : 'Нi' }}</div>
        <h3>Ім'я</h3>
        <div>{{ $feedback->name }}</div>
        <h3>Email</h3>
        <div>{{ $feedback->email }}</div>
        <h3>Телефон</h3>
        <div>{{ $feedback->mobile_phone }}</div>
        <h3>Повідомлення</h3>
        <div>{{ $feedback->message }}</div>


    </div>
    <div class="col-md-4"><hr>
        <a href="{{ route('deactivate', ['id' => $feedback->id]) }}" class="btn btn-success btn-lg"> Переглянуто</a>
    </div>
@stop
