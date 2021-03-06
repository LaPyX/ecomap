@extends('admin.base')

@section('content')
    <h1>Добавить видео</h1>

    <form action="{{ route($baseRoute . 'store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="" class="col-sm-3">Название</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Код для вставки c YouTube</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="text" rows="5"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-lg" value="Добавить видео">
                <a href="{{ route($baseRoute . 'index') }}" class="btn btn-secondary btn-lg" >Отмена</a>
            </div>
        </div>
    </form>
@endsection