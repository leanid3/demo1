@extends('layouts.app')

@section('content')
    <!--Сообщение из сессии-->
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- фильтры -->
            <x-filter-card :route="route('admin.cards')" :role="'admin'"/>

            <!-- таблица -->
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Список карточек</h5>
                    </div>
                    <div class="card-body">
                        @if ($cards->isEmpty())
                            <div class="alert alert-warning">
                                <p>Карточек нет</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Автор</th>
                                            <th>Тип</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cards as $card)
                                            <tr>
                                                <td>{{ $card->id }}</td>
                                                <td>{{ $card->title }}</td>
                                                <td> <a class="text-decoration-none text-dark hover:text-blue-500" href="{{ route('admin.users.view', $card->user) }}">{{ $card->author }}</a></td>
                                                <td>
                                                    @if($card->type === 'share')
                                                        <span class="badge bg-success">Готов поделиться</span>
                                                    @else
                                                        <span class="badge bg-primary">Хочу в библиотеку</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($card->status === 'approved')
                                                        <span class="badge bg-success">Одобрено</span>
                                                    @elseif($card->status === 'rejected')
                                                        <span class="badge bg-danger">Отклонено</span>
                                                    @else
                                                        <span class="badge bg-warning">На рассмотрении</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group gap-2" role="group">
                                                        <a href="{{ route('admin.cards.view', $card) }}" class="btn btn-sm btn-info">Просмотр</a>
                                                        @if($card->status === 'pending')
                                                            <form action="{{ route('admin.approve', $card) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success">Одобрить</button>
                                                            </form>
                                                            <form action="{{ route('admin.reject', $card) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                                                            </form>
                                                        @endif
                                                        <button id="deleteModalBtn{{ $card->id }}" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $card->id }}">
                                                            delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- пагинация -->
                            <div class="mt-4">
                                {{ $cards->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для удаления карточки -->
    <x-modal-delete :card-table="$card" :role="'admin'"/>

@endsection

