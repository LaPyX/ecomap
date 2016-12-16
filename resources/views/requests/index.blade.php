<link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/app.css">

<table class="table">
    <thead>
       <td>#</td>
       <td>Тема</td>
       <td>Сообщение</td>
       <td>Адрес</td>
       <td>Заявитель</td>
       <td>Телефон</td>
       <td>Фото</td>
    </thead>
    @foreach($requests as $request)
        <tr>
            <td>
                <a href="#">Подтвердить</a>
            </td>
            <td>{{ $request->id }}</td>
            <td>{{ $request->subject }}</td>
            <td>{{ $request->description }}</td>
            <td>{{ $request->address }}</td>

            <td>{{ $request->name }}</td>
            <td>{{ $request->phone }}</td>
            <td>{{ $request->photo }}</td>
        </tr>
    @endforeach
</table>