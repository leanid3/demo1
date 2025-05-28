<!-- фильтры -->
@props(['route','role'])
<div class="col-12 col-md-3 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Фильтры и сортировка</h5>
        </div>
        <div class="card-body">
            <form action="{{ $route }}" method="get">
                <!-- по имени -->
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                </div>
                <!-- по email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}">
                </div>
                <!-- по роли -->
                <div class="mb-3">
                    <label for="role" class="form-label">Роль</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">Выберите роль</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Админ</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Пользователь</option>
                    </select>
                </div>

                <!-- по статусу -->
                @if($role === 'admin')
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Выберите статус</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Активен</option>
                        <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Заблокирован</option>
                    </select>
                </div>
                @endif

                <!-- по дате -->
                <div class="mb-3">
                    <label for="created_at" class="form-label">Дата</label>
                    <input type="date" class="form-control" id="created_at" name="created_at" value="{{ request('created_at') }}">
                </div>

                <!-- Сортировка -->
                <div class="mb-3">
                    <label for="sort" class="form-label">Сортировать по</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Дате создания</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Имени</option>
                        <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="role" {{ request('sort') == 'role' ? 'selected' : '' }}>Роли</option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Статусу</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="direction" class="form-label">Направление сортировки</label>
                    <select class="form-select" id="direction" name="direction">
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    </select>
                </div>

                <!-- кнопки -->
                <div class="mb-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ $route }}" class="btn btn-secondary">Сбросить</a>
                </div>
            </form>
        </div>
    </div>
</div>