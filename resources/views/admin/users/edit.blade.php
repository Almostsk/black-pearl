@extends('admin.app')

@section('title', 'Редагування користувача №' . $user->id)

@section('content_header')
    <h1>Користувач {{ $user->name . ' ' . $user->surname }}</h1>
@stop

@section('content')

@stop

@section('js')

@endsection