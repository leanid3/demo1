<!-- фильтры -->
@props(['route','role'])
<div class="col-12 col-md-3 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Фильтры и сортировка</h5>
        </div>
        <div class="card-body">
            <form action="{{ $route }}" method="get">
                @csrf
                <!-- по названию -->
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ request('title') }}" placeholder="Введите название">
                </div>

                <!-- по автору -->
                <div class="mb-3">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ request('author') }}" placeholder="Введите имя автора">
                </div>

                <!-- по типу -->
                <div class="mb-3">
                    <label for="type" class="form-label">Тип</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Все типы</option>
                        <option value="share" {{ request('type') == 'share' ? 'selected' : '' }}>Готов поделиться</option>
                        <option value="private" {{ request('type') == 'private' ? 'selected' : '' }}>Хочу в библиотеку</option>
                    </select>
                </div>

                <!-- по статусу -->
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Все статусы</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Одобрено</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Отклонено</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>На рассмотрении</option>
                    </select>
                </div>

                <!-- по дате -->
                <div class="mb-3">
                    <label for="created_at" class="form-label">Дата создания</label>
                    <input type="date" class="form-control" id="created_at" name="created_at" value="{{ request('created_at') }}">
                </div>

                <!-- Сортировка -->
                <div class="mb-3">
                    <label for="sort" class="form-label">Сортировать по</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Дате создания</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Названию</option>
                        <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Автору</option>
                        <option value="type" {{ request('sort') == 'type' ? 'selected' : '' }}>Типу</option>
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Применить
                    </button>
                    <a href="{{ $route }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Сбросить
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>