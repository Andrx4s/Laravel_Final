@extends('welcome')

@section('title', 'Страница добавления категории')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                @if(isset($catalog))
                    <h2>Редактирование {{$catalog->name}}</h2>
                @else
                    <h2>Добавление категории</h2>
                @endif
                <form method="post" action="{{(isset($catalog) ? route('admin.catalog.update', ['catalog' => $catalog->id]) : route('admin.catalog.store'))}}" enctype="multipart/form-data">
                    @csrf
                    @isset($catalog)
                        <input type="hidden" name="_method" value="PUT">
                    @endisset
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Наименование категории:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Наименование категории" aria-describedby="invalidInputName" value="{{ old('name') }}">
                        @error('name') <div id="invalidInputName" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($catalog))
                            Отредактировать каткгорию
                        @else
                            Создать новую категорию
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
