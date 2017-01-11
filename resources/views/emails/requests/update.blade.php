<p>Здравствуйте, {{ $request->name }}!</p>

<p>
    На сайте "Интерактивная карта незаконных свалок" изменился статус обращения #{{ $request->id }}.<br>
    Новый статус: <strong>{{ $request->status }}</strong>.
</p>

@if ($request->comment)
<p>
    Комментарий администратора:
</p>

<p>
    <i>&laquo;{{ $request->comment }}&raquo;</i>
</p>
@endif
