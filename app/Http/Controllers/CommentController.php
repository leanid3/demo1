<?php

namespace App\Http\Controllers;

use App\Http\Services\Filter;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::query();
        $filter = new Filter($comments);
        $filter->filter($request);
        $comments = $filter->getQuery()->paginate(10);
        return view('comments.index', [
            'title' => 'Комментарии',
            'comments' => $comments,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comments.create', [
            'title' => 'Создать комментарий',
            'courses' => Course::all(),
            'orders' => Order::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'order_id' => 'required|exists:orders,id',
        ],
        [
            'comment.required' => 'Комментарий обязателен',
            'comment.string' => 'Комментарий должен быть строкой',
            'comment.max' => 'Комментарий должен быть не более 255 символов',
            'course_id.required' => 'Курс обязателен',
            'course_id.exists' => 'Курс не найден',
            'order_id.required' => 'Заказ обязателен',
            'order_id.exists' => 'Заказ не найден',
        ]);

        auth()->user()->comments()->create($request->all());
        return redirect()->route('comments.index')->with('success', 'Комментарий успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', [
            'title' => 'Комментарий',
            'comment' => $comment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'title' => 'Редактировать комментарий',
            'comment' => $comment,
            'courses' => Course::all(),
            'orders' => Order::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'order_id' => 'required|exists:orders,id',
        ],
        [
            'comment.required' => 'Комментарий обязателен',
            'comment.string' => 'Комментарий должен быть строкой',
            'comment.max' => 'Комментарий должен быть не более 255 символов',
            'course_id.required' => 'Курс обязателен',
            'course_id.exists' => 'Курс не найден',
            'order_id.required' => 'Заказ обязателен',
            'order_id.exists' => 'Заказ не найден',
        ]);

        $comment->update($request->all());
        return redirect()->route('comments.index')->with('success', 'Комментарий успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Комментарий успешно удален');
    }


    protected function getCommentByCourse(Request $request, Course $course)
    {
        $comments = Comment::where('course_id', $course->id)->get();
        return view('comments.index', [
            'title' => 'Комментарии',
            'comments' => $comments,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }

    protected function getCommentByOrder(Request $request, Order $order)
    {
        $comments = Comment::where('order_id', $order->id)->get();
        return view('comments.index', [
            'title' => 'Комментарии',
            'comments' => $comments,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }

    protected function getCommentByUser(Request $request, User $user)
    {
        $comments = Comment::where('user_id', $user->id)->get();
        return view('comments.index', [
            'title' => 'Комментарии',
            'comments' => $comments,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }
}
