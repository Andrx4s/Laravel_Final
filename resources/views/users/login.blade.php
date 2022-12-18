@extends('welcome')

@section('title', 'Страница авторизации')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-8">
                @guest
                <h2>Авторизация</h2>
                <form method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputLogin" class="form-label">Логин</label>
                        <input class="form-control @error('login') is-invalid @enderror" name="login" type="text" id="inputLogin" aria-describedby="InvalidInputLogin" value="{{old('login')}}">
                        @error('login')<div id="InvalidInputLogin" class="form-text">{{$message}}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Пароль</label>
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="inputPassword" aria-describedby="InvalidInputPassword">
                        @error('password')<div id="InvalidInputPassword" class="form-text">{{$message}}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Авторизоваться</button>
                </form>
            </div>
            @endguest
            @auth
                <div class="container">Вы уже авторизированы</div>
            @endauth
            <div class="col"></div>
        </div>
    </div>
@endsection
