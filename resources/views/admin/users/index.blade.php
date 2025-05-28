@extends('layouts.app')

@section('content')
    <!--Сообщение из сессии-->
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session('error'))
        <x-alert type="danger" :message="session('error')" />
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- фильтры -->
            <x-admin.filter-user :route="route('admin.users')" :role="'admin'"/>

            <!-- таблица -->
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Список пользователей</h5>
                        <span class="text-muted">Всего: {{ $users->total() }}</span>
                    </div>
                    <div class="card-body">
                        @if ($users->isEmpty())
                            <div class="alert alert-warning">
                                <p class="mb-0">Пользователей не найдено</p>
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
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                                   class="text-decoration-none text-dark">
                                                    Имя
                                                    @if(request('sort') == 'name')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                                   class="text-decoration-none text-dark">
                                                    Email
                                                    @if(request('sort') == 'email')
                                                        <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'role', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                                   class="text-decoration-none text-dark">
                                                    Роль
                                                    @if(request('sort') == 'role')
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
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->role === 'admin')
                                                        <span class="badge bg-success">Админ</span>
                                                    @else
                                                        <span class="badge bg-primary">Пользователь</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->status === 'active')
                                                        <span class="badge bg-success">Активен</span>
                                                    @elseif($user->status === 'banned')
                                                        <span class="badge bg-danger">Заблокирован</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group gap-2" role="group">
                                                        <a href="{{ route('admin.users.show', $user) }}" 
                                                           class="btn btn-sm btn-info" 
                                                           title="Просмотр">
                                                            <i class="fas fa-eye">просмотр</i>
                                                        </a>
                                                        <form action="{{ route('admin.users.status', $user) }}" 
                                                              method="POST" 
                                                              class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="active">
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-success"
                                                                        title="Разблокировать">
                                                                    <i class="fas fa-check">Разблокировать</i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.users.status', $user) }}" 
                                                                  method="POST" 
                                                                  class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="status" value="banned">
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-danger"
                                                                        title="Заблокировать">
                                                                    <i class="fas fa-times">Заблокировать</i>
                                                                </button>
                                                            </form>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#deleteModal{{ $user->id }}"
                                                                title="Удалить">
                                                            <i class="fas fa-trash">удалить</i>
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
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальные окна для удаления -->
    @foreach($users as $user)
        <x-admin.modal-user-delete :user="$user" :role="'admin'"/>
    @endforeach
@endsection

