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
                <a href="/requests/{{ $request->id }}/edit/?status=0" @if(0 == $request->status) style="font-weight: bold; font-size: 1.2em;" @endif>Скрыто</a><br>
                <a href="/requests/{{ $request->id }}/edit/?status=1" @if(1 == $request->status) style="font-weight: bold; font-size: 1.2em;" @endif>На рассмотрении</a><br>
                <a href="/requests/{{ $request->id }}/edit/?status=2" @if(2 == $request->status) style="font-weight: bold; font-size: 1.2em;" @endif>Осведомлены</a><br>
                <a href="/requests/{{ $request->id }}/edit/?status=3" @if(3 == $request->status) style="font-weight: bold; font-size: 1.2em;" @endif>В работе</a>
            </td>
            <td>{{ $request->id }}</td>
            <td>{{ $request->subject }}</td>
            <td>{{ $request->description }}</td>
            <td>{{ $request->address }}</td>

            <td>{{ $request->name }}</td>
            <td>{{ $request->phone }}</td>
            <td>
                <a href="{{ $request->photo }}" target="_blank"><img src="{{ $request->photo }}" style="width: 100px";></a>
            </td>
        </tr>
    @endforeach
</table>