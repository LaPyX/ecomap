@extends('admin.base')

@section('content')
    <h1>Создать отделение</h1>

    <form action="{{ route('admin.departments.store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="" class="col-sm-3">Регион</label>
            <div class="col-sm-9">
                <select name="region_name" class="form-control">
                    @foreach($regions as $region)
                    <option>{{ $region }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Название</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Описание</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="description" rows="5"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Контактные данные</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="contacts" rows="5"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-lg" value="Создать отделение">
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary btn-lg" >Отмена</a>
            </div>
        </div>
    </form>
@endsection