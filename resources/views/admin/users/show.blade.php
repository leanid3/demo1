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
                                            <th>login</th>
                                            <th>name</th>
                                            <th>phone</th>
                                            <th>email</th>
                                            <th>role</th>
                                            <th>created_at</th>
                                            <th>updated_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cards as $card)
                                            <tr>
                                                <td>{{ $card->id }}</td>
                                                <td>{{ $card->title }}</td>
                                                <td> <a class="text-decoration-none text-dark hover:text-blue-500" href="{{ route('admin.users.view', $card->user) }}">{{ $card->author }}</a></td>
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
                        <!-- Модальное окно для удаления карточки -->
                        <x-modal-delete :card-table="$card" :role="'admin'"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

