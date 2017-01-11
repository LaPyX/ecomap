@php
    switch ($request->status) {
        case 1:
            $status = 'На рассмотрении';
            break;
        case 2:
            $status = 'В работе';
            break;
        case 3:
            $status = 'Проблема решена';
            break;
    }
@endphp

<p>Здравствуйте, {{ $request->name }}!</p>

<p>
    На сайте "Интерактивная карта незаконных свалок" изменился статус обращения <strong>#{{ $request->id }}</strong>.<br>
    Новый статус: <strong>{{ $status }}</strong>.
</p>

@if ($request->comment)
<p>
    Комментарий администратора:
</p>

<p>
    <i>&laquo;{{ $request->comment }}&raquo;</i>
</p>
@endif
