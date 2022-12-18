@extends('welcome')

@section('title', 'Страница товара')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                @if(isset($product))
                    <h1>Редактирование {{$product->name}}</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Товар успешно отредактирован!</div>
                    @endif
                @else
                    <h1>Создание нового товара</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Товар успешно создан!</div>
                    @endif
                @endif
                <form method="POST" action="{{(isset($product) ? route('admin.product.update', ['product' => $product->id]) : route('admin.product.store'))}}" enctype="multipart/form-data">
                    @csrf
                    @isset($product)
                        <input type="hidden" name="_method" value="PUT">
                    @endisset
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Наименование товара:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Наименование" aria-describedby="invalidInputName" value="{{old('name')}}">
                        @error('name') <div id="invalidInputName" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputMade" class="form-label">Где создан:</label>
                        <input type="text" name="made" class="form-control @error('made') is-invalid @enderror" id="inputMade" placeholder="Россия" aria-describedby="invalidInputMade" value="{{old('made')}}">
                        @error('made') <div id="invalidInputMade" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Цена:</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="inputPrice" placeholder="Пример: 198.93" aria-describedby="invalidInputPrice" value="{{old('price')}}">
                        @error('price') <div id="invalidInputPrice" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputFile" class="form-label">Выберите изображение для товара:</label>
                        <input name="photo" class="form-control @error('photo') is-invalid @enderror" type="file" id="inputFile" aria-describedby="invalidInputFile">
                        @error('photo') <div id="invalidInputFile" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputCount" class="form-label">Количество:</label>
                        <input type="text" name="count" class="form-control @error('count') is-invalid @enderror" id="inputCount" placeholder="5" aria-describedby="invalidInputCount" value="{{old('count')}}">
                        @error('count') <div id="invalidInputCount" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputColor" class="form-label">Цвет:</label>
                        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="inputColor" placeholder="Красный" aria-describedby="invalidInputColor" value="{{old('color')}}">
                        @error('color') <div id="invalidInputColor" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputCatalog_id" class="form-label">Категория:</label>
                        <select id="inputCatalog_id" name="catalog_id" class="form-select @error('catalog_id') is-invalid @enderror" aria-describedby="invalidInputCatalog_id">
                            @foreach($catalogs as $catalog)
                                <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                            @endforeach
                        </select>
                        @error('catalog_id') <div id="invalidInputCatalog_id" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($product))
                            Отредактировать товар
                        @else
                            Создать новый товар
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
