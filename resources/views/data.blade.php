@extends('layout')

@section('content')
    <h2>Данные</h2>

    <table>
        <tr>
            <th>Имя</th>
            <th>Email</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
            </tr>
        @endforeach
    </table>
@endsection
