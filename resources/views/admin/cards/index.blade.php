@extends('layouts.app')

@section('content')
    <!--Сообщение из сессии-->
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- фильтры -->
            <x-filters.admin-cards :route="route('admin.cards')" :role="'admin'" />

            <!-- таблица -->
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Список карточек</h5>
                        <span class="text-muted">Всего: {{ $cards->total() }}</span>
                    </div>
                    <div class="card-body">
                        @if ($cards->isEmpty())
                            <div class="alert alert-warning">
                                <p class="mb-0">Карточек не найдено</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                                    class="text-decoration-none text-dark">
                                                    ID
                                                    @if(request('sort') == 'id')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                                    class="text-decoration-none text-dark">
                                                    Название
                                                    @if(request('sort') == 'title')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'author', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                                    class="text-decoration-none text-dark">
                                                    Автор
                                                    @if(request('sort') == 'author')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'type', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                                    class="text-decoration-none text-dark">
                                                    Тип
                                                    @if(request('sort') == 'type')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                                    class="text-decoration-none text-dark">
                                                    Статус
                                                    @if(request('sort') == 'status')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cards as $card)
                                            <tr>
                                                <td>{{ $card->id }}</td>
                                                <td>{{ $card->title }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $card->user) }}"
                                                        class="text-decoration-none text-dark hover:text-blue-500">
                                                        {{ $card->author }}
                                                    </a>
                                                </td>
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
                                                        <a href="{{ route('cards.show', $card) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Просмотр
                                                        </a>
                                                        @if($card->status !== 'approved' && $card->status !== 'rejected')
                                                            <form action="{{ route('admin.approve', $card) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success">
                                                                    <i class="fas fa-check"></i> Одобрить
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.reject', $card) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-times"></i> Отклонить
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $card->id }}">
                                                            <i class="fas fa-trash"></i> Удалить
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

    @foreach($cards as $card)
        <x-modal-delete :card="$card" :role="'admin'" />
    @endforeach
@endsection