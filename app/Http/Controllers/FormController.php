<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index() {
        return view('welcome'); // Главная страница
    }

    public function showForm() {
        return view('form'); // Страница с формой
    }

    public function submitForm(Request $request) {
        $validatedData = $request->validate([ // Встроенный метод проверят валидацию по заданным параметрам
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $filename = 'data_' . uniqid() . '.json'; // Создает уникальный id для каждой заполненной формы
        Storage::put('public/' . $filename, json_encode($validatedData)); // Создает файл json в директории public/

        return redirect('/form')->with('success', 'Данные успешно сохранены!'); // Перенаправляет, передавая строку в переменной success, чтоб ее вывести
    }

    public function showData() {
        $files = Storage::files('public');
        $data = array_map(function($file) { // Применяет операцию ко всем файлам в files
            return json_decode(Storage::get($file), true);
        }, $files);

        return view('data', ['data' => $data]); // Страница с таблицей данных
    }
}
