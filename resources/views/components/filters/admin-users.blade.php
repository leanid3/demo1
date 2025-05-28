@props(['route', 'role'])

@php
$filters = [
    [
        'name' => 'name',
        'label' => 'Имя',
        'type' => 'text',
        'placeholder' => 'Введите имя',
        'sortable' => true
    ],
    [
        'name' => 'email',
        'label' => 'Email',
        'type' => 'text',
        'placeholder' => 'Введите email',
        'sortable' => true
    ],
    [
        'name' => 'role',
        'label' => 'Роль',
        'type' => 'select',
        'empty_option' => 'Выберите роль',
        'options' => [
            'admin' => 'Админ',
            'user' => 'Пользователь'
        ],
        'sortable' => true
    ]
];

// Добавляем фильтр статуса только для админа
if ($role === 'admin') {
    $filters[] = [
        'name' => 'status',
        'label' => 'Статус',
        'type' => 'select',
        'empty_option' => 'Выберите статус',
        'options' => [
            'active' => 'Активен',
            'banned' => 'Заблокирован'
        ],
        'sortable' => true
    ];
}

// Добавляем фильтр по дате
$filters[] = [
    'name' => 'created_at',
    'label' => 'Дата создания',
    'type' => 'date',
    'sortable' => true
];
@endphp

<x-filter :route="$route" :role="$role" :filters="$filters" />
