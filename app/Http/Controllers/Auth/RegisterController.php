<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * Отображение представления для регистрации.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('auth.register');
    }

    /**
     * Обработка входящего запроса на регистрацию.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:255', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'regex:/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/', 'string', 'max:255', 'unique:users'],
        ], [
            'name.regex' => 'Имя должно содержать только кириллические буквы и пробелы.',
            'name.min' => 'Имя должно быть не менее 6 символов.',
            'phone.regex' => 'Телефон должен быть в формате +7 (XXX) XXX-XX-XX.',
            'login.unique' => 'Логин уже занят.',
            'phone.unique' => 'Телефон уже занят.',
            'email.unique' => 'Email уже занят.',
            'password.confirmed' => 'Пароли не сопадают.',
            'password.min' => 'Пароль должен быть не менее 8 символов.',
        ]);

        User::create([
            'name' => $request->name,
            'login' => $request->login,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success_register', 'Вы успешно зарегистрировались');
    }

}
