@props(['user'])
<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $user->name }}</h5>
        <p class="card-text text-center">{{ $user->email }}</p>
        <p
            class="card-text text-center @if ($user->role == 'admin') text-success @else text-danger @endif">
            {{ $user->role }}
        </p>
        <p
            class="card-text text-center @if ($user->status == 'approved') text-success @else text-danger @endif">
            {{ $user->status }}
        </p>
        <p class="card-text text-center @if ($user->rejection_reason) text-danger @endif">
            {{ $user->rejection_reason }}
        </p>
        <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary">view</a>
            <button id="deleteModalBtn{{ $user->id }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                delete
            </button>
        </div>
    </div>
</div>

<!-- Модальное окно для удаления карточки -->
<x-admin.modal-user-delete :user="$user" :role="auth()->user()->role" />
