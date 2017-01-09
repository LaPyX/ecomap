@extends('admin.base')

@section('content')
    <h1>Редактировать сотрудника</h1>

    <form action="{{ route('admin.personal.update', ['personal' => $personal->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put" />

        <div class="form-group row">
            <label for="" class="col-sm-3">ФИО</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="{{ old('name', $personal->name) }}" required>
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
                <input type="text" class="form-control" name="position" value="{{ old('position', $personal->position) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Контактные данные</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="contacts" rows="5">{{ old('contacts', $personal->contacts) }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3">Email для автоматических уведомлений</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" value="{{ old('email', $personal->email) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-primary" value="Редактировать сотрудника">
                <a href="{{ route('admin.personal.index') }}" class="btn btn-secondary" >Отмена</a>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-9 col-sm-offset-3" style="margin-top: 1em;">
            <form action="{{ route('admin.personal.destroy', ['request' => $personal->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />

                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены?');">
            </form>
        </div>
    </div>
@endsection