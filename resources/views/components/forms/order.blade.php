@props([
    'action',
    'method' => 'POST',
    'order' => null,
    'cards' => null
])

<form method="{{ $method }}" action="{{ $action }}" class="form-order">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <x-form.select
        name="card_id"
        label="Карточка"
        :options="$cards"
        :value="$order?->card_id"
        empty_option="Выберите карточку"
        required
    />

    <x-form.radio
        name="status"
        label="Статус заявки"
        :value="$order?->status ?? 'pending'"
        :options="[
            'pending' => 'Ожидает',
            'approved' => 'Одобрено',
            'rejected' => 'Отклонено'
        ]"
        required
    />

    <x-form.input
        name="message"
        label="Сообщение"
        :value="$order?->message"
        placeholder="Введите сообщение для владельца карточки"
    />

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ $order ? 'Обновить' : 'Создать' }}
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