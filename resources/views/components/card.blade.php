@props(['card'])
<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $card->title }}</h5>
        <p class="card-text text-center">{{ $card->author }}</p>
        <p
            class="card-text text-center @if ($card->type == 'share') text-success @else text-danger @endif">
            {{ $card->type }}
        </p>
        <p
            class="card-text text-center @if ($card->status == 'approved') text-success @else text-danger @endif">
            {{ $card->status }}
        </p>
        <p class="card-text text-center @if ($card->rejection_reason) text-danger @endif">
            {{ $card->rejection_reason }}
        </p>
        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
            <a href="{{ route('cards.show', $card->id) }}" class="btn btn-primary">view</a>
            <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-warning">edit</a>
            <button id="deleteModalBtn{{ $card->id }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $card->id }}">
                delete
            </button>
        </div>
    </div>
</div>

<!-- Модальное окно для удаления карточки -->
<x-modal-delete :card="$card" :role="auth()->user()->role" />