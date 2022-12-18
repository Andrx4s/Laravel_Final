@extends('welcome')

@section('title', 'Страница регистрации')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-8">
                @guest
                <h2>Регистрация</h2>
                <form action="{{route('register')}}" method="POST">
                    @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Имя</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" id="inputName" aria-describedby="InvalidInputName" value="{{old('name')}}">
                    @error('name')<div id="InvalidInputName" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputSurname" class="form-label">Фамилия</label>
                    <input class="form-control @error('surname') is-invalid @enderror" name="surname" type="text" id="inputSurname" aria-describedby="InvalidInputSurname" value="{{old('surname')}}">
                    @error('surname')<div id="InvalidInputSurname" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputPatronymic" class="form-label">Отчество</label>
                    <input class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" type="text" id="inputPatronymic" aria-describedby="InvalidInputPatronymic" value="{{old('patronymic')}}">
                    @error('patronymic')<div id="InvalidInputPatronymic" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputLogin" class="form-label">Логин</label>
                    <input class="form-control @error('login') is-invalid @enderror" name="login" type="text" id="inputLogin" aria-describedby="InvalidInputLogin" value="{{old('login')}}">
                    @error('login')<div id="InvalidInputLogin" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Электронная почта</label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="inputEmail" aria-describedby="InvalidInputEmail" value="{{old('email')}}">
                    @error('email')<div id="InvalidInputEmail" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Пароль</label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="inputPassword" aria-describedby="InvalidInputPassword">
                    @error('password')<div id="InvalidInputPassword" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="inputPasswordConfirmation" class="form-label">Повторите пароль</label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password_confirmation" type="password" id="inputPasswordConfirmation" aria-describedby="InvalidInputPasswordConfirmation">
                    @error('password')<div id="InvalidInputPasswordConfirmation" class="form-text">{{$message}}</div>@enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('rules') is-invalid @enderror" id="form-radio-1" type="radio" name="rules" aria-describedby="InvalidInputRules">
                    <label class="form-check-label" for="form-radio-1">Согласие с правилами регистрации</label>
                    @error('rules')<div id="InvalidInputRules" class="form-text">{{$message}}</div>@enderror
                </div>
                    <button type="submit" class="btn btn-primary">Регистрация</button>
                </form>
                @endguest
                @auth
                    <div class="container">Вы уже авторизированы</div>
                @endauth
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
