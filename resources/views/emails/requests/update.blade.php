<p>Здравствуйте, {{ $user->name }}!</p>

<p>
    На сайте "Интерактивная карта незаконных свалок" изменился статус обращения "{{ $request->subject }}".<br>
    Новый статус: <strong>{{ $status }}</strong>.
</p>

@if ($comment)
<p>
    Комментарий администратора:
</p>

<p>
    <i>&laquo;{{ $comment }}&raquo;</i>
</p>
@endif
