<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма для задания</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>Тут должны быть лого и меню</h1>
        <nav>
            <a href="/">Главная</a>
            <a href="/form">Форма</a>
            <a href="/data">Данные</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <h2>А тут футер сайта</h2>
    </footer>
</body>
</html>
