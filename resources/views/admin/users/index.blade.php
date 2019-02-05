@extends('admin.app')

@section('title', 'Усі користувачі')

@section('content_header')
    <h1>Усі користувачі</h1>
@stop

@section('content')
    <hr>
    <a href="{{ route('download_all_users') }}" class="btn btn-success">Експорт усіх користувачів</a>
    <hr>
    <table class="table" id="dataTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Прізвище</th>
            <th scope="col">Телефон</th>
            <th scope="col">Дата реєстрації</th>
            <th scope="col">Профіль промодеровано</th>
            <th scope="col">Модерувати</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->mobile_phone }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->is_profile_moderated == 1 ? 'Так' : 'Ні'}}</td>
                <td>
                    <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                       class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop

@section('js')
    <script>
        $('#dataTable').DataTable();
    </script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection