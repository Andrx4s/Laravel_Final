<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/assets/css/theme.css">
    <script src="/public/assets/js/bootstrap.bundle.js"></script>
    <title>@yield('title', 'Главная страница')</title>
</head>
<body>
<!-- Light navbar: Dark links against light background -->
<header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a href="#" class="navbar-brand me-2 me-xl-4">
            Мир цветов
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        @auth
            <a href="{{route('logout')}}" class="btn btn-primary btn-sm ms-2 order-lg-3">Выход</a>
        @endauth
        @guest
            <a href="{{route('register')}}" class="btn btn-primary btn-sm ms-2 order-lg-3">Регистрация</a>
            <a href="{{route('login')}}" class="btn btn-primary btn-sm ms-2 order-lg-3">Вход</a>
            <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
                @endguest
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="{{route('about')}}" class="nav-link">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('catalog')}}" class="nav-link">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('find')}}" class="nav-link">Где нас найти?</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('order.all')}}">Мои заказы</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('order.basket')}}" class="nav-link">Корзина</a>
                        </li>
                        @if(Auth::user()->role == 'Администратор')
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">Админ-панель</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{route('order.all', ['myOrder' => 'admin'])}}">Просмотр заказов</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-item dropdown-toggle">Продукты</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{route('admin.product.create')}}" class="dropdown-item">Добавление
                                                    продукта</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-item dropdown-toggle">Категории</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{route('admin.catalog.create')}}" class="dropdown-item">Добавление
                                                    категории</a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.catalog.index')}}" class="dropdown-item">Категории</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">Another action</a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
    </div>
</header>
@yield('content')
</body>
</html>
