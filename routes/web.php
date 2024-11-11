<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController; // Импортировали контроллер


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FormController::class, 'index']); // Главная
Route::get('/form', [FormController::class, 'showForm']); // Форма
Route::post('/form', [FormController::class, 'submitForm']); // Обработка формы
Route::get('/data', [FormController::class, 'showData']); // Страница с таблицей данных

