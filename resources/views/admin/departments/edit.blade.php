@extends('admin.base')

@section('content')
    <h1>Редактировать отделение</h1>

    <form action="{{ route('admin.departments.update', ['department' => $department->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put" />


        <div class="form-group row">
            <label for="" class="col-sm-3">Регион</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="region_name" value="{{ old('region_name', $department->region_name) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Название</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="{{ old('name', $department->name) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Описание</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="description" rows="5">{{ old('description', $department->description) }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Контактные данные</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="contacts" rows="5">{{ old('contacts', $department->contacts) }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Учётные данные</label>
            <div class="col-sm-9">
                Логин: {{ $department->login }}<br>
                Пароль: {{ $department->password }}<br>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary" value="Редактировать отделение">
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary" >Отмена</a>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-9 col-sm-offset-3" style="margin-top: 1em;">
            <form action="{{ route('admin.departments.destroy', ['request' => $department->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />

                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены?');">
            </form>
        </div>
    </div>
@endsection