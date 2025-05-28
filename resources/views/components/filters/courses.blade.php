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
        'name' => 'description',
        'label' => 'Описание',
        'type' => 'text',
        'placeholder' => 'Введите описание',
        'sortable' => true
    ],
    [
        'name' => 'price',
        'label' => 'Цена',
        'type' => 'number',
        'placeholder' => 'Введите цену',
        'sortable' => true
    ],
    [
        'name' => 'status',
        'label' => 'Статус',
        'type' => 'select',
        'empty_option' => 'Все статусы',
        'options' => [
            'published' => 'Опубликовано',
            'unpublished' => 'Не опубликовано',
            'draft' => 'Черновик'
        ],
        'sortable' => true
    ],
    [
        'name' => 'created_at',
        'label' => 'Дата создания',
        'type' => 'date',
        'placeholder' => 'Введите дату создания',
        'sortable' => true
    ]
];
@endphp

<x-filter :route="$route" :role="$role" :filters="$filters" /> 