@props([
    'action',
    'method' => 'POST',
    'comment' => null,
    'cards' => null
])

<form method="{{ $method }}" action="{{ $action }}" class="form-comment">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <x-form.input
        name="content"
        label="Текст комментария"
        :value="$comment?->content"
        required
    />
    <x-form.select
        name="card_id"
        label="Карточка"
        :options="$cards"
        :value="$comment?->card_id"
        empty_option="Выберите карточку"
        rd
    />

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ $comment ? 'Обновить' : 'Создать' }}
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