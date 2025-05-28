<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminMiddelware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\HomeController;

Route::get('/', function () {
    return view('main');
});

//маршруты для авторизованных пользователей
Route::middleware('auth')->group(function () {
    Route::get('/profile', [HomeController::class, 'index'])->name('profile');
    Route::resource('cards', CardController::class);
    Route::get('/archive', [CardController::class, 'archive'])->name('cards.archive');

    
  
    // комментарии к курсам
    Route::get('/comments/course/{course}', [CommentController::class, 'getCommentByCourse'])->name('comments.course');
    // комментарии к заявкам
    Route::get('/comments/order/{order}', [CommentController::class, 'getCommentByOrder'])->name('comments.order'); 
    // комментарии к пользователям
    Route::get('/comments/user/{user}', [CommentController::class, 'getCommentByUser'])->name('comments.user');

    // курсы
    Route::resource('courses', CourseController::class);
    // заявки
    Route::resource('orders', OrderController::class);
    // комментарии к заявкам
    Route::resource('comments', CommentController::class);

});

// Регистрация и авторизация
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//маршруты для администраторов
Route::middleware('auth', AdminMiddelware::class)->group(function () {
   //главная страница администратора
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
   
    // карточки
    Route::get('/admin/cards', [AdminController::class, 'cards'])->name('admin.cards');
    Route::get('/admin/cards/{card}', [AdminController::class, 'cards'])->name('admin.cards.show');
    Route::delete('/admin/cards/{card}', [AdminController::class, 'cardsDelete'])->name('admin.cards.delete');
    Route::post('/admin/cards/{card}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    Route::post('/admin/cards/{card}/approve', [AdminController::class, 'approve'])->name('admin.approve');
   
    // пользователи
    Route::get('/admin/users', [AdminController::class, 'usersView'])->name('admin.users');
    Route::get('/admin/users/{user}', [AdminController::class, 'users'])->name('admin.users.show');
    Route::delete('/admin/users/{user}', [AdminController::class, 'usersDelete'])->name('admin.users.delete');
    Route::get('/admin/users/card/{user}', [AdminController::class, 'userViewCard'])->name('admin.users.card.show');
    Route::post('/admin/users/{user}/status', [AdminController::class, 'usersStatus'])->name('admin.users.status');
    

});

