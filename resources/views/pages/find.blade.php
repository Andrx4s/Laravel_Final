@extends('welcome')

@section('title', 'Где нас найти?')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12">
                <h2>Где нас найти?</h2>
                <div class="card mt-3" style="width: 100%;">
                    <img src="/public/storage/map.jpg" class="card-img-top w-75 h-75 m-auto" alt="map">
                    <div class="card-body">
                        <p class="card-text">Ул Пушкина дом 23</p>
                        <a href="tel:89507347417" class="link-info card-text">8950734717</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
