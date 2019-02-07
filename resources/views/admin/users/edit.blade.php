@extends('admin.app')

@section('title', 'Редагування користувача №' . $user->id)

@section('content_header')
    <h1>Користувач {{ $user->name . ' ' . $user->surname }}</h1>
@stop

@section('content')
    {!! Form::open(['route' => ['users.update', 'id' => $user->id], 'method' => 'PUT']) !!}

    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $user->name, ['class' => 'form-control']) }}

    {{ Form::label('surname', 'Surname') }}
    {{ Form::text('surname', $user->surname, ['class' => 'form-control']) }}

    {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', $statuses, $user->status_id, ['class' => 'form-control']) }}

    {{ Form::label('mobile_phone', 'Mobile phone') }}
    {{ Form::text('mobile_phone', $user->mobile_phone, ['class' => 'form-control']) }}

    {{ Form::label('about_me', 'About me') }}
    {{ Form::textarea('about_me', $user->about_me, ['class' => 'form-control']) }}

    <hr>
    {{ Form::submit('Save changes', ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
@stop

@section('js')

@endsection