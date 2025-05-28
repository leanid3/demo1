@props([
    'action',
    'method' => 'POST',
    'card' => null
])

<form method="{{ $method }}" action="{{ $action }}" class="form-card">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <x-form.input
        name="author"
        label="Автор"
        :value="$card?->author"
        required
    />

    <x-form.input
        name="title"
        label="Название"
        :value="$card?->title"
        required
    />

    <x-form.radio
        name="type"
        label="Тип карточки"
        :value="$card?->type ?? 'share'"
        :options="[
            'share' => 'Готов поделиться',
            'wish' => 'Хочу в свою библиотеку'
        ]"
        required
    />

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ $card ? 'Обновить' : 'Создать' }}
        </button>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">Отмена</a>
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