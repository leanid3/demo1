<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Показать все записи
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Card::where('user_id', auth()->user()->id);

        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('date')) {
            $query->where('created_at', $request->input('date'));
        }

        //получаем все записи
        $cards = $query->paginate(10) ?? [];

        //показываем все записи
        return view('cards.index', ['title' => 'Мои карточки', 'cards' => $cards]);
    }


    /**
     * Страница создания записи
     * @param \App\Http\Requests\StoreCardRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        //показываем форму создания
        return view('cards.create', ['title' => 'Создание карточки']);
    }

    /**
     * Создание записи
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //валидация данных
        $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        try {
            //создание записи   
            auth()->user()->cards()->create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }


        //редирект после создания
        return redirect()->route('cards.index')->with('success', 'Запись успешно создана');
    }

    /**
     * Показать запись
     * @param \App\Models\Card $card
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Card $card)
    {
        //показываем запись
        return view('cards.show', ['title' => 'Карточка', 'card' => $card]);
    }

    /**
     * Редактирование записи
     * @param \App\Models\Card $card
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Card $card)
    {
        //показываем форму редактирования
        return view('cards.edit', ['title' => 'Редактирование карточки', 'card' => $card]);
    }

    /**
     * Обновление данных записи
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Card $card)
    {
        //валидация данных
        $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'rejection_reason' => 'nullable|string|max:255',
        ]);
        //обновление данных
        $card->update($request->all());

        //редирект после обновления
        return redirect()->route('cards.index')->with('success', 'Запись успешно обновлена');
    }

    /**
     * Удаление записи
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Card $card)
    {

        //удаление данных
        $card->delete();

        //редирект после удаления
        return redirect()->route('cards.index')->with('success', 'Запись успешно удалена');
    }
}
