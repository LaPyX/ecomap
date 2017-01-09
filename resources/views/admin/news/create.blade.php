@extends('admin.base')

@section('content')
    <h1>Создать новость</h1>

    <form action="{{ route('admin.news.store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="" class="col-sm-3">Название</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Текст</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="text" rows="5"></textarea>
            </div>
        </div>


        <div class="form-group row">
            <label for="" class="col-sm-3">Статус</label>
            <div class="col-sm-9">
                <select name="status" class="form-control">
                    <option value="0">Черновик</option>
                    <option value="1">Опубликовано</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-lg" value="Создать новость">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg" >Отмена</a>
            </div>
        </div>
    </form>
@endsection