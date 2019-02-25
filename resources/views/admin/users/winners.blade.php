@extends('admin.app')

@section('title', 'Переможці перлини')

@section('content_header')
    @include('partials.alerts')
    <h1>Переможці перлини</h1>
@stop

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <a href="{{ route('winner.identify') }}" class="btn btn-success btn-lg btn-block">Определить победителя</a>
    </div>
    <hr>
    <hr>
    <hr>
    <hr>
    <table class="table" id="dataTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Прізвище</th>
            <th scope="col">Телефон</th>
            <th scope="col">Дата реєстрації</th>
            <th scope="col">Статус</th>
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
                <td>{{ $user->status->name }}</td>
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