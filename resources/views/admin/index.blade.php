@extends('layouts.app')

@section('content')
<!-- выбор действия -->
<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-center align-items-center">
    <div class="justify-content-center align-items-center">
        <ul class="navbar-nav md-col-12">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/cards') ? 'active' : '' }}" href="{{ route('admin.cards') }}">Карточки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Пользователи</a>
            </li>
        </ul>
    </div>
</nav>
@endsection

