@extends('welcome')

{{--Секция для вывода всех заказов--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('success'))
                    @if(session()->get('success'))
                        <div class="alert alert-success">Ваш заказ успешно отменен!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа к данному заказу!</div>
                    @endif
                @endif
                    @if(session()->has('completed'))
                        @if(session()->get('completed'))
                            <div class="alert alert-success">Ваш заказ успешно подтвержден!</div>
                        @else
                            <div class="alert alert-danger">Вы не имеете доступа к данному заказу!</div>
                        @endif
                    @endif
                @if(Auth::user()->role == 'user')
                    <h2>Мои заказы</h2>
                @else
                    <h2>Заказы</h2>
                @endif
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @forelse($orders as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order_{{ $key }}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <div class="p-1">Номер заказа: {{$item->id}}</div>
                                    @if($item->status == 'Отмененный')
                                        <div class="bg-danger text-white ml-1 p-1 rounded-2"> Статус: {{$item->status}}</div>
                                    @elseif($item->status == 'Подтвержденный')
                                        <div class="bg-success text-white ml-1 p-1 rounded-2"> Статус: {{$item->status}}</div>
                                    @else
                                        <div class="bg-primary text-white ml-1 p-1 rounded-2"> Статус: {{$item->status}}</div>
                                    @endif
                                </button>
                            </h2>
                            <div id="order_{{ $key }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название товара</th>
                                            <th scope="col">Стоимость товара</th>
                                            <th scope="col">Количество</th>
                                            <th scope="col">Общая сумма</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $summa = 0; ?>
                                        @foreach($item->items as $subkey => $product)
                                            <?php $summa += ($product->count*$product->price); ?>
                                            <tr>
                                                <th scope="row">{{$subkey}}</th>
                                                <td>{{$product->product->name}}</td>
                                                <td>{{number_format($product->price, 2, ',', ' ')}}</td>
                                                <td>{{$product->count}}</td>
                                                <td>{{number_format(($product->count*$product->price), 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="5">Общая стоимость за весь заказ: {{number_format($summa, 2, ',', ' ')}}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <ul class="list-group">
                                        <li class="list-group-item">Номер заказа: {{$item->id}}</li>
                                        <li class="list-group-item">Статус заказа: {{$item->status}}</li>
                                        <li class="list-group-item">Дата заказа: {{$item->created_at}}</li>
                                        <li class="list-group-item">Дата изменения: {{$item->updated_at}}</li>
                                        <li class="list-group-item">Адрес доставки: {{$item->address}}</li>
                                    </ul>
                                    @if($item->status == 'Новый')
                                        <p class="small">Вы можете отменить заказ, если данный заказ является новым!</p>
                                        <a href="{{route('order.cancel', ['order' => $item->id])}}" class="btn btn-danger mb-1">Отменить заказ</a>
                                        @if(Auth::user()->role == 'Администратор')
                                            <a href="{{route('completed', ['order' => $item->id])}}" class="btn btn-success mb-1">Заказ завершен</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">Вы не сделали не одного заказа!</div>
                    @endforelse
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
