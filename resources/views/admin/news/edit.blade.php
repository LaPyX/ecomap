@extends('admin.base')

@section('content')
    <h1>Редактировать сотрудника</h1>

    <form action="{{ route('admin.news.update', ['news' => $item->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put" />

        <div class="form-group row">
            <label for="" class="col-sm-3">Название</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="{{ old('name', $item->name) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Текст</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="text" rows="5">{{ old('text', $item->text) }}</textarea>
            </div>
        </div>


        <div class="form-group row">
            <label for="" class="col-sm-3">Статус</label>
            <div class="col-sm-9">
                <select name="status" class="form-control">
                    <option value="0">Черновик</option>
                    <option value="1" @if(1 == $item->status) selected="selected" @endif>Опубликовано</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-lg" value="Редактировать новость">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg" >Отмена</a>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-9 col-sm-offset-3" style="margin-top: 1em;">
            <form action="{{ route('admin.news.destroy', ['news' => $item->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />

                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены?');">
            </form>
        </div>
    </div>
@endsection