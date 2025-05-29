@props([
    'action',
    'method' => 'POST',
    'course' => null
])

<form method="{{ $method }}" action="{{ $action }}" class="form-course">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <x-form.input
        name="title"
        label="Название курса"
        :value="$course?->title"
        required
    />

    <x-form.input
        name="description"
        label="Описание"
        :value="$course?->description"
        placeholder="Введите описание курса"
        required
    />

    <x-form.input
        name="duration"
        label="Длительность (часы)"
        type="number"
        :value="$course?->duration"
        required
    />

    <x-form.select
        name="level"
        label="Уровень сложности"
        :value="$course?->level"
        :options="[
            'beginner' => 'Начальный',
            'intermediate' => 'Средний',
            'advanced' => 'Продвинутый'
        ]"
        required
    />

    <x-form.radio
        name="status"
        label="Статус курса"
        :value="$course?->status ?? 'draft'"
        :options="[
            'draft' => 'Черновик',
            'published' => 'Опубликован',
            'archived' => 'В архиве'
        ]"
        required
    />

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ $course ? 'Обновить' : 'Создать' }}
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
    </div>
</form>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 