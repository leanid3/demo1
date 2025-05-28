<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Панель администратора
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.index', ['title' => 'Панель администратора'])
        ->with('message', 'Добро пожаловать в панель администратора');
    }

    /**
     * Одобрить карточку
     * @param Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Card $card)
    {
        $card->update(['status' => 'approved', 'rejection_reason' => null]);
        return redirect()->route('admin.cards')->with('success', 'Карточка одобрена');
    }

    /**
     * Отклонить карточку
     * @param Card $card    
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Card $card, Request $request)
    {
        $card->update(['status' => 'rejected', 'rejection_reason' => $request->input('rejection_reason')]);
        return redirect()->route('admin.cards')->with('success', 'Карточка отклонена');
    }

    /**
     * Страница с карточками    
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function cards(Request $request)
    {
        $query = Card::query();

        // Фильтрация
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        // Сортировка
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        // Проверяем, что поле сортировки допустимо
        $allowedSortFields = ['id', 'title', 'author', 'type', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        // Получаем все записи с пагинацией
        $cards = $query->paginate(10)->withQueryString();

        return view('admin.cards.index', [
            'title' => 'Карточки',
            'cards' => $cards,
            'currentSort' => $sortField,
            'currentDirection' => $sortDirection
        ]);
    }

    /**     
     * удалить карточку
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cardsDelete(Card $card)
    {
        $card->delete();
        return redirect()->route('admin.cards')->with('success', 'Карточка удалена');
    }



    /**
     * Страница с пользователями
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function usersView(Request $request)
    {
        $query = User::query();

        // Фильтрация
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
    
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        // Сортировка
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        // Проверяем, что поле сортировки допустимо
        $allowedSortFields = ['id', 'name', 'email', 'role', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        // Получаем все записи с пагинацией
        $users = $query->paginate(10)->withQueryString();

        // Показываем все записи
        return view('admin.users.index', [
            'title' => 'Пользователи',
            'users' => $users,
            'currentSort' => $sortField,
            'currentDirection' => $sortDirection
        ]);
    }


    /**
     * посмотреть карточки пользователя
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function userViewCard(User $user)
    {
        $cards = Card::where('user_id', $user->id)->get();
        return view('admin.users.viewCard', compact('cards'), ['title' => 'Карточки пользователя']);
    }

    
    /**
     * удалить пользователя
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function usersDelete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Пользователь удален');
    }

    /**
     * изменить статус пользователя
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function usersStatus(User $user, Request $request)
    {
        $user->update(['status' => $request->input('status')]);
        return redirect()->route('admin.users')->with('success', 'Статус пользователя изменен');
    }

}