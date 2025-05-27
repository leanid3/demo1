@props(['card-table'])
<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $cardTable->title }}</h5>
        <p class="card-text text-center">{{ $cardTable->author }}</p>
        <p
            class="card-text text-center @if ($cardTable->type == 'share') text-success @else text-danger @endif">
            {{ $cardTable->type }}
        </p>
        <p
            class="card-text text-center @if ($cardTable->status == 'approved') text-success @else text-danger @endif">
            {{ $cardTable->status }}
        </p>
        <p class="card-text text-center @if ($cardTable->rejection_reason) text-danger @endif">
            {{ $cardTable->rejection_reason }}
        </p>
        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
            <a href="{{ route('cards.show', $cardTable->id) }}" class="btn btn-primary">view</a>
            <a href="{{ route('cards.edit', $cardTable->id) }}" class="btn btn-warning">edit</a>
            <button id="deleteModalBtn{{ $cardTable->id }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cardTable->id }}">
                delete
            </button>
        </div>
    </div>
</div>

<!-- Модальное окно для удаления карточки -->
<x-modal-delete :card-table="$cardTable" />
