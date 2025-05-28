<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Filter;
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


        $filter = new Filter(Card::query());

        // Получаем все записи
        $filter->filter($request);
        
        // Сортировка
        $allowedSortFields = ['id', 'title', 'author', 'type', 'status', 'created_at'];
        $filter->sort($request, $allowedSortFields);
        
        $cards = $filter->getQuery()->paginate(10)->withQueryString();

        return view('admin.cards.index', [
            'title' => 'Карточки',
            'cards' => $cards,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
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
        $filter = new Filter(User::query());

        // фильтрация
        $filter->filter($request);
        
        // Сортировка
        $allowedSortFields = ['id', 'name', 'email', 'role', 'status', 'created_at'];
        $filter->sort($request, $allowedSortFields);
        
        // Получаем все записи с пагинацией
        $users = $filter->getQuery()->paginate(10)->withQueryString();

        // Показываем все записи
        return view('admin.users.index', [
            'title' => 'Пользователи',
            'users' => $users,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
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