@extends('layout')

@section('content')
    <h2>Форма</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="/form" method="POST">
        @csrf
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" required>
        @error('name')<div>{{ $message }}</div>@enderror

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        @error('email')<div>{{ $message }}</div>@enderror

        <button type="submit">Отправить</button>
    </form>
@endsection
