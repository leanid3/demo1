@props(['route', 'role'])

@php
$filters = [
    [
        'name' => 'title',
        'label' => 'Название',
        'type' => 'text',
        'placeholder' => 'Введите название',
        'sortable' => true
    ],
    [
        'name' => 'author',
        'label' => 'Автор',
        'type' => 'text',
        'placeholder' => 'Введите имя автора',
        'sortable' => true
    ],
    [
        'name' => 'type',
        'label' => 'Тип',
        'type' => 'select',
        'empty_option' => 'Все типы',
        'options' => [
            'share' => 'Готов поделиться',
            'private' => 'Хочу в библиотеку'
        ],
        'sortable' => true
    ],
    [
        'name' => 'status',
        'label' => 'Статус',
        'type' => 'select',
        'empty_option' => 'Все статусы',
        'options' => [
            'approved' => 'Одобрено',
            'rejected' => 'Отклонено',
            'pending' => 'На рассмотрении'
        ],
        'sortable' => true
    ],
    [
        'name' => 'created_at',
        'label' => 'Дата создания',
        'type' => 'date',
        'sortable' => true
    ]
];
@endphp

<x-filter :route="$route" :role="$role" :filters="$filters" /> 