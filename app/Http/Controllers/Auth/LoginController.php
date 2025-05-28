<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\RedirectResponse;


class LoginController extends Controller
{
    /**
     * Отображение представления для входа в систему.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('auth.login');
    }

    /**
     * Обработка входящего запроса на аутентификацию.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'Email обязателен',
            'email.email' => 'Email должен быть валидным',
            'email.exists' => 'Email не найден',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен быть не менее 6 символов',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('profile', absolute: false))->with('success_login', 'Вы успешно авторизовались');
        }
        return redirect()->back()->with('error', 'логин или пароль не верны');
    }

    /**
     * выход из системы
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Вы успешно вышли из системы');
    }
    
}
