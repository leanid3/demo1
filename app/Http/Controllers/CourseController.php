<?php

namespace App\Http\Controllers;

use App\Http\Services\Filter;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::query();
        $filter = new Filter($courses);
        $filter->filter($request);
        $allowedSortFields = ['id', 'title', 'description', 'price', 'status', 'created_at'];
        $filter->sort($request, $allowedSortFields);
        $courses = $filter->getQuery()->paginate(10);
        return view('courses.index', [
            'title' => 'Курсы',
            'courses' => $courses,
            'currentSort' => $request->input('sort', 'created_at'),
            'currentDirection' => $request->input('direction', 'desc')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create', [
            'title' => 'Создать курс'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ], [
            'title.required' => 'Название курса обязательно',
            'description.required' => 'Описание курса обязательно',
            'price.required' => 'Цена курса обязательна',
            'status.required' => 'Статус курса обязателен',
        ]);

        auth()->user()->courses()->create($request->all());
        return redirect()->route('courses.index')->with('success', 'Курс успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', [
            'title' => 'Курс',
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', [
            'title' => 'Редактировать курс',
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ], [
            'title.required' => 'Название курса обязательно',
            'description.required' => 'Описание курса обязательно',
            'price.required' => 'Цена курса обязательна',
            'status.required' => 'Статус курса обязателен',
        ]);
        
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Курс успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Курс успешно удален');
    }
}
