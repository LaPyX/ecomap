@extends('dashboard.base')

@section('content')
    <h1>Обращения</h1>

    <table class="table">
        <thead>
        <td width="50">#</td>
        <td width="100">Файлы</td>
        <td>Тема</td>
        <td width="170">Статус</td>
        </thead>
        @forelse($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>
                    <a href="{{ $request->photo }}" target="_blank" class="fancybox"><img src="{{ $request->photo }}" style="width: 100px";></a>
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
        @empty
            <tr>
                <td colspan="4">
                    У вас нет созданных обращений.
                </td>
            </tr>
        @endforelse
    </table>
@endsection