<link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/app.css">

<p>
    <a href="/">Вернуться на сайт</a>
</p>

<table class="table">
    <thead>
       <td>#</td>
       <td>Статус</td>
       <td>Тема</td>
       <td>Сообщение</td>
       <td>Адрес</td>
       <td>Заявитель</td>
       <td>Телефон</td>
       <td>Фото</td>
    </thead>
    @foreach($requests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>
                @php
                    switch ($request->status) {
                        case 0:
                            echo 'На модерации';
                            break;
                        case 1:
                            echo 'На рассмотрении';
                            break;
                        case 2:
                            echo 'В работе';
                            break;
                        case 3:
                            echo 'Проблема решена';
                            break;
                    }
                @endphp
            </td>
            <td><a href="{{ route('requests.edit', ['request' => $request->id]) }}">{{ $request->subject }}</a></td>
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