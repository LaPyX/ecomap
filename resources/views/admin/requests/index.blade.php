@extends('admin.base')

@section('content')
    <h1>Обращения</h1>

    <table class="table">
        <thead>
        <td width="50">#</td>
        <td width="100">Файлы</td>
        <td>Тема</td>
        <td>Заявитель</td>
        <td width="170">Статус</td>
        </thead>
        @foreach($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>
                    <a href="{{ $request->photo }}" target="_blank"><img src="{{ $request->photo }}" style="width: 100px";></a>
                </td>
                <td>
                    <a href="{{ route('admin.requests.edit', ['request' => $request->id]) }}">{{ $request->subject }}</a>
                </td>
                <td>{{ $request->name }}</td>
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
            </tr>
        @endforeach
    </table>
@endsection