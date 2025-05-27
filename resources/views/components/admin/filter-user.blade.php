<!-- фильтры -->
@props(['route','role'])
<div class="col-12 col-md-3 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Фильтры</h5>
        </div>
        <div class="card-body">
            <form action="{{ $route }}" method="get">
                <!-- по авторам -->
                <div class="mb-3">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
                <!-- по названию -->
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <!-- по типу -->
                <div class="mb-3">
                    <label for="type" class="form-label">Тип</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Выберите тип</option>
                        <option value="share">Готов поделиться</option>
                        <option value="wish">Хочу в свою библиотеку</option>
                    </select>
                </div>

                <!-- по статусу -->
                @if($role === 'admin')
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Выберите статус</option>
                        <option value="approved">Одобрено</option>
                        <option value="rejected">Отклонено</option>
                    </select>
                </div>
                @endif

                <!-- по дате -->
                <div class="mb-3">
                    <label for="date" class="form-label">Дата</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>

                <!-- кнопка применить -->
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Применить</button>
                </div>
            </form>
        </div>
    </div>
</div>