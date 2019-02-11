@extends('admin.app')

@section('title', 'Усі ФидБеки')

@section('content_header')
    @include('partials.alerts')
    <h1>Усі ФидБеки</h1>
@stop

@section('content')
    <hr>

    <table class="table" id="dataTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Email</th>
            <th scope="col">Телефон</th>
            <th scope="col">Редагувати</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $feedbacks as $feedback )
            <tr>
                <th scope="row">{{ $feedback->id }}</th>
                <td>{{ $feedback->name }}</td>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->mobile_phone }}</td>
                <td>
                    <a href="{{ route('feedbacks.edit', ['id' => $feedback->id]) }}"
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