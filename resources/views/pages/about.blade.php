@extends('welcome')

@section('title', 'Страница о нас')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12">
                <h3>Мир Цветов</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis dolor facere odit qui
                    quibusdam, tempora ut. Dolores et iste praesentium, quia soluta ullam voluptate.</p>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($products as $product)
                        <div class="carousel-item active">
                            <img src="/public/storage/{{$product->photo}}" class="d-block w-100 h-50" alt="{{$product->name}}">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
