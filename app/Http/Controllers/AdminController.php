<?php

namespace App\Http\Controllers;

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

        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('created_at')) {
            $query->where('created_at', $request->input('created_at'));
        }

        $cards = $query->paginate(10);
        return view('admin.cards.index', compact('cards'));
    }

    /**     
     * удалить карточку
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cardsDelete(Card $card)
    {
        $card->delete();
        return redirect()->route('admin.cards.index')->with('success', 'Карточка удалена');
    }



    /**
     * Страница с пользователями
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function usersView(Request $request)
    {

        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
    
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('created_at')) {
            $query->where('created_at', $request->input('created_at'));
        }


        //получаем все записи
        $users = $query->paginate(2);

        //показываем все записи
        return view('admin.users.index', ['title' => 'Пользователи', 'users' => $users]);
    }


    /**
     * посмотреть карточки пользователя
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function userViewCard(User $user)
    {
        $cards = Card::where('user_id', $user->id)->get();
        return view('admin.users.viewCard', compact('cards'));
    }

    
    /**
     * удалить пользователя
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function usersDelete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален');
    }
}