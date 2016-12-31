@extends('admin.base')

@section('content')
    <h1>Создать сотрудника</h1>

    <form action="{{ route('admin.personal.store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="" class="col-sm-3">ФИО</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Отделение</label>
            <div class="col-sm-9">
                <select name="department_id" class="form-control">
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Должность</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="position" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Контактные данные</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="contacts" rows="5"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Email для автоматических уведомлений</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-lg" value="Создать сотрудника">
                <a href="{{ route('admin.personal.index') }}" class="btn btn-secondary btn-lg" >Отмена</a>
            </div>
        </div>
    </form>
@endsection