<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserMoreController;
use App\Http\Middleware\AdminMiddelware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//маршруты для авторизованных пользователей
Route::middleware('auth')->group(function () {
    Route::resource('cards', CardController::class);
    Route::get('/cards/archive', [UserMoreController::class, 'archive'])->name('cards.archive');
});
Auth::routes();

//маршруты для администраторов
Route::middleware('auth', AdminMiddelware::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/cards', [AdminController::class, 'cards'])->name('admin.cards');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/cards/{card}', [AdminController::class, 'cards'])->name('admin.cards.view');
    Route::get('/admin/users/{user}', [AdminController::class, 'users'])->name('admin.users.view');
    Route::get('/admin/users/card/{user}', [AdminController::class, 'userViewCard'])->name('admin.users.view.card');
    Route::delete('/admin/cards/{card}', [AdminController::class, 'cardsDelete'])->name('admin.cards.delete');
    Route::delete('/admin/users/{user}', [AdminController::class, 'usersDelete'])->name('admin.users.delete');
    Route::post('/admin/cards/{card}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/cards/{card}/reject', [AdminController::class, 'reject'])->name('admin.reject');
});
