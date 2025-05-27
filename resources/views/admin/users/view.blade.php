@extends('layouts.app')

@section('content')
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- Информация о пользователе -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Информация о пользователе</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Логин:</strong> {{ $user->login }}</p>
                                <p><strong>Имя:</strong> {{ $user->name }}</p>
                                <p><strong>Телефон:</strong> {{ $user->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Роль:</strong> {{ $user->role }}</p>
                                <p><strong>Дата регистрации:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Карточки пользователя -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Карточки пользователя</h5>
                    </div>
                    <div class="card-body">
                        @if ($user->cards->isEmpty())
                            <div class="alert alert-warning">
                                <p>У пользователя нет карточек</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Статус</th>
                                            <th>Дата создания</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->cards as $card)
                                            <tr>
                                                <td>{{ $card->id }}</td>
                                                <td>{{ $card->title }}</td>
                                                <td>{{ $card->status }}</td>
                                                <td>{{ $card->created_at->format('d.m.Y H:i') }}</td>
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
                                                            Удалить
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальные окна для удаления карточек -->
    @foreach ($user->cards as $card)
        <x-modal-delete :card-table="$card" :role="'admin'"/>
    @endforeach
@endsection 