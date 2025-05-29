<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss'])

</head>

<body>
    <div id="app">
        <!-- хедер -->
        <header class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <!-- логотип -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-book-open me-2"></i>{{ config('app.name', 'Laravel') }}
                </a>

                <!-- кнопка для открытия меню мобильной версии-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <!--ссылки для неавторизованных пользователей -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <!--ссылки для авторизованных пользователей -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cards.index') }}">
                                    <i class="fas fa-address-card me-1"></i>Мои карточки
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    <i class="fas fa-address-card me-1"></i>Мои заявки
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('comments.index') }}">
                                    <i class="fas fa-address-card me-1"></i>Мои комментарии
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('courses.index') }}">
                                    <i class="fas fa-address-card me-1"></i>Мои курсы
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cards.archive') }}">
                                    <i class="fas fa-archive me-1"></i>Архив
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="crudDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-cogs me-1"></i>Управление
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="crudDropdown">
                                    <h6 class="dropdown-header">Карточки</h6>
                                    <a class="dropdown-item" href="{{ route('cards.create') }}" data-bs-toggle="modal" data-bs-target="#cardModal">
                                        <i class="fas fa-plus-circle me-1"></i>Создать карточку
                                    </a>
                                    <a class="dropdown-item" href="{{ route('cards.index') }}">
                                        <i class="fas fa-list me-1"></i>Список карточек
                                    </a>
                                    <a class="dropdown-item" href="{{ route('cards.archive') }}">
                                        <i class="fas fa-archive me-1"></i>Архив
                                    </a>

                                    <h6 class="dropdown-header">Комментарии</h6>
                                    <a class="dropdown-item" href="{{ route('comments.create') }}" data-bs-toggle="modal" data-bs-target="#commentModal">
                                        <i class="fas fa-plus-circle me-1"></i>Создать комментарий
                                    </a>
                                    <a class="dropdown-item" href="{{ route('comments.index') }}">
                                        <i class="fas fa-list me-1"></i>Список комментариев
                                    </a>

                                    <h6 class="dropdown-header">Заявки</h6>
                                    <a class="dropdown-item" href="{{ route('orders.create') }}" data-bs-toggle="modal" data-bs-target="#orderModal">
                                        <i class="fas fa-plus-circle me-1"></i>Создать заявку
                                    </a>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="fas fa-list me-1"></i>Список заявок
                                    </a>

                                    <h6 class="dropdown-header">Курсы</h6>
                                    <a class="dropdown-item" href="{{ route('courses.create') }}" data-bs-toggle="modal" data-bs-target="#courseModal">
                                        <i class="fas fa-plus-circle me-1"></i>Создать курс
                                    </a>
                                    <a class="dropdown-item" href="{{ route('courses.index') }}">
                                        <i class="fas fa-list me-1"></i>Список курсов
                                    </a>

                                    @if(Auth::user()->role === 'admin')
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Администрирование</h6>
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="fas fa-user-shield me-1"></i>Панель администратора
                                        </a>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user me-1"></i>Профиль
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </header>

        <!-- контейнер для контента -->
        <main class="container">
            <!-- кнопка назад -->
            <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary mb-3">Назад</a>
            @if(isset($title))
                <h1 class="text-center mb-5 display-4 fw-bold">{{ $title }}</h1>
            @endif
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </main>

        <!-- Модальные окна -->
        <!-- Модальное окно для карточек -->
        <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cardModalLabel">Создание карточки</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-forms.card :action="route('cards.store')" method="POST" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для комментариев -->
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Создание комментария</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-forms.comment :action="route('comments.store')" method="POST" :cards="isset($cards) ? $cards : []" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для заявок -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Создание заявки</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-forms.order :action="route('orders.store')" method="POST" :cards="isset($cards) ? $cards : []" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для курсов -->
        <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel">Создание курса</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-forms.course :action="route('courses.store')" method="POST" />
                    </div>
                </div>
            </div>
        </div>

        <!-- футер -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-center">
                                    <i class="fas fa-copyright me-1"></i>{{ date('Y') }} {{ config('app.name', 'Laravel') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center">
                                    <i class="fas fa-heart me-1 text-danger"></i>Сделано с любовью
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>