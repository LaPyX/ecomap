<link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/app.css">

<form action="{{ route('requests.update', ['request' => $request->id]) }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="_method" value="put" />

<table class="table">
    <tr>
        <td>#</td>
        <td>{{ $request->id }}</td>
    </tr>
    <tr>
        <td>Тема</td>
        <td>{{ $request->subject }}</td>
    </tr>
    <tr>
        <td>Сообщение</td>
        <td>{{ $request->description }}</td>
    </tr>
    <tr>
        <td>Адрес</td>
        <td>{{ $request->address }}</td>
    </tr>
    <tr>
        <td>Заявитель</td>
        <td>{{ $request->name }}</td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td>{{ $request->phone }}</td>
    </tr>
    <tr>
        <td>Фото</td>
        <td><a href="{{ $request->photo }}" target="_blank"><img src="{{ $request->photo }}" style="width: 100px";></a></td>
    </tr>
    <tr>
        <td>Статус</td>
        <td>
            <select name="status">
                <option value="0">На модерации</option>
                <option value="1" @if(1 == $request->status) selected="selected" @endif>На рассмотрении</option>
                <option value="2" @if(2 == $request->status) selected="selected" @endif>В работе</option>
                <option value="3" @if(3 == $request->status) selected="selected" @endif>Проблема решена</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Комментарий</td>
        <td>
            <textarea name="comment">{{ $request->comment }}</textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Сохранить">
            <a href="/requests" class="btn btn-secondary">Отмена</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <form action="{{ route('requests.destroy', ['request' => $request->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />

                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены?');">
            </form>
        </td>
    </tr>
</table>

</form>