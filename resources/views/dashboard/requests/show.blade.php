@extends('dashboard.base')

@section('content')
    <h1>Просмотр обращения</h1>

    <table class="table">
        <tr>
            <td width="180">#</td>
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
            <td>
                @if (is_array($request->photo))
                    @foreach($request->photo as $ph)
                        <a href="{{ $ph }}" rel="gallery" class="fancybox" target="_blank"><img src="{{ $ph }}" style="width: 100px";></a>
                    @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td>Статус</td>
            <td>
                @if(1 == $request->status)
                    На модерации
                @endif
                @if(1 == $request->status)
                    На рассмотрении
                @endif
                @if(2 == $request->status)
                    В работе
                @endif
                @if(3 == $request->status)
                    Проблема решена
                @endif
            </td>
        </tr>
        <tr>
            <td>Комментарий</td>
            <td>
                {{ $request->comment }}
            </td>
        </tr>
    </table>
@endsection