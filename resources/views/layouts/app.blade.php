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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cards.create') }}">
                                    <i class="fas fa-plus-circle me-1"></i>Создать
                                </a>
                            </li>
                            <!-- ссылка на панель администратора -->
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.index') }}">
                                        <i class="fas fa-user-shield me-1"></i>Панель администратора
                                    </a>
                                </li>
                            @endif
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