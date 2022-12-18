@extends('welcome')

{{--Секция для вывода одного продукта--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <div class="card mt-2">
                    <div class="card-header">
                        {{$product->name}}
                    </div>
                    <div class="card-body text-center">
                        <img src="/public/storage/{{$product->photo}}" class="img-top w-50 h-50" alt="{{$product->name}}">
                        <p class="card-text">Стоимость товара: {{$product->price}}</p>
                        <p class="card-text">Страна производста: {{$product->made}}</p>
                        <p class="card-text">Страна производста: {{$product->color}}</p>
                        <p class="card-text">Категория: {{$product->catalog->name}}</p>
                        @auth
                            @if(session()->has('basket'))
                                @if(isset(session('basket')[$product->id]))
                                    <a href="{{route('order.basket')}}" class="btn btn-primary" type="button">Перейти в корзину</a>
                                @else
                                    <a href="{{route('order.addBasket', ['productId' => $product->id])}}" class="btn btn-success" type="button">Добавить в корзину</a>
                                @endif
                            @else
                                <a href="{{route('order.addBasket', ['productId' => $product->id])}}" class="btn btn-success" type="button">Добавить в корзину</a>
                            @endif
                        @endauth
                        <a href="{{route('admin.product.edit', ['product' => $product->id])}}" class="btn btn-primary">Редактировать</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить товар {{$product->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы точно хотите удалить товар?<br>
                    {{$product->name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <form action="{{route('admin.product.destroy', ['product' => $product->id])}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger">Да я точно хочу удалить данный товар!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
