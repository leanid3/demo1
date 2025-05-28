<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Получить запрос
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        return $this->query;
    }
    /**
     * Фильтрация записей
     * @param \Illuminate\Http\Request $request
     * @param bool $adminOff
     * @return void
     */
    public function filter(Request $request, $adminOff = false): void
    {
        $query = $this->query;

        //проверка на роль пользователя
        if (auth()->user()->role !== 'admin' || $adminOff) {
            $query->where('user_id', auth()->user()->id);
        }

        // Фильтрация записей
        foreach ($request->all() as $key => $value) {

            //черный список
            $blackList = ['sort', 'direction', 'page', 'per_page'];
            if (in_array($key, $blackList)) {
                continue;
            }
            if ($value) {
                switch (gettype($value)) {
                    case 'string':
                        $query->where($key, 'like', '%' . $value . '%');
                        break;
                    case 'array':
                        $query->whereIn($key, $value);
                        break;
                    case 'integer':
                        $query->where($key, $value);
                        break;
                    case 'boolean':
                        $query->where($key, $value);
                        break;
                    case 'float':
                        $query->where($key, $value);
                        break;
                    case 'object':
                        $query->where($key, $value);
                        break;
                    case 'date':
                        $query->whereDate($key, $value);
                        break;
                }

            }
        }
        // $res = $this->query->paginate(10);
        // dd($request->all(),$res);
        $this->query = $query;
    }

    /**
     * Применение сортировки к запросу
     * 
     * @param Request $request
     * @param array $allowedFields массив допустимых полей для сортировки
     * @param string $defaultField поле по умолчанию для сортировки
     * @param string $defaultDirection направление сортировки по умолчанию
     * @return void
     */
    public function sort(Request $request, array $allowedFields = [], string $defaultField = 'created_at', string $defaultDirection = 'desc')
    {
        $sortField = $request->input('sort', $defaultField);
        $sortDirection = $request->input('direction', $defaultDirection);

        // Проверка поля сортировки
        if (!empty($allowedFields) && !in_array($sortField, $allowedFields)) {
            $sortField = $defaultField;
        }

        // Проверка направления сортировки
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = $defaultDirection;
        }

        $this->query->orderBy($sortField, $sortDirection);
    }

}

