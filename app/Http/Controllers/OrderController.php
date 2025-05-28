<?php

namespace App\Http\Controllers;

use App\Http\Services\Filter;
use App\Models\Order;
use Request;

class OrderController extends Controller
{

 
    /**
     * Показать все записи
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // фильтрация
        $filter = new Filter(Order::query());
        $filter->filter($request);
        // Сортировка
        $allowedSortFields = ['id', 'course_id', 'date_recording', 'payment_method', 'created_at'];
        $filter->sort($request, $allowedSortFields);
        
        $orders = $filter->getQuery()->paginate(10) ?? [];
        return view('orders.index', [
            'title' => 'Заявки', 
            'orders' => $orders,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }

    /**
     * Страница создания записи
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        return view('orders.create', ['title' => 'Создание заявки']);
    }

    /**
     * Создание записи
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'date_recording' => ['required', 'date', 'after:today', 'unique:orders,date_recording'],
            'payment_method' => ['required', 'in:card,cash'],
        ], [
            'course_id.required' => 'Курс обязателен',
            'course_id.exists' => 'Курс не найден',
            'date_recording.required' => 'Дата записи обязательна',
            'date_recording.date' => 'Дата записи должна быть датой',
            'date_recording.after' => 'Дата записи должна быть в будущем',
            'date_recording.unique' => 'Дата записи уже занята',
            'payment_method.required' => 'Метод оплаты обязателен',
            'payment_method.in' => 'Метод оплаты должен быть card или cash',
        ]);
        auth()->user()->orders()->create($request->all());
        return redirect()->route('orders.index')->with('success', 'Заявка создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', ['title' => 'Просмотр заявки', 'order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', ['title' => 'Редактирование заявки', 'order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'date_recording' => ['required', 'date', 'after:today', 'unique:orders,date_recording'],
            'payment_method' => ['required', 'in:card,cash'],
        ], [
            'course_id.required' => 'Курс обязателен',
            'course_id.exists' => 'Курс не найден',
            'date_recording.required' => 'Дата записи обязательна',
            'date_recording.date' => 'Дата записи должна быть датой',
            'date_recording.after' => 'Дата записи должна быть в будущем',
            'date_recording.unique' => 'Дата записи уже занята',
            'payment_method.required' => 'Метод оплаты обязателен',
            'payment_method.in' => 'Метод оплаты должен быть card или cash',
        ]);
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Заявка обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заявка удалена');
    }

}
