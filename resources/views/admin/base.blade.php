<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value="{{csrf_token()}}">

    <title>Панель управления &mdash; Экологическая карта</title>

    <link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
</head>
<body>
<div>
    <div class="body container">
        <div class="col-sm-3">
            <strong>Управление системой</strong>

            <ul class="navigation">
                <li>
                    <a href="/">Вернуться на сайт</a>
                </li>
                <li>
                    <a href="{{ route('admin.') }}">Статистика</a>
                </li>
                <li>
                    <a href="{{ route('admin.requests.index') }}">Обращения</a>
                </li>
                <li>
                    <i>Структура</i>
                    <ul>
                        @if (! Auth::user()->department_id)
                            <li><a href="{{ route('admin.departments.index') }}">Отделения</a></li>
                        @endif
                        <li><a href="{{ route('admin.personal.index') }}">Сотрудники</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.news.index') }}">Новости</a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}">Текстовые страницы</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">Выйти из системы</a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-sm-9">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://use.fontawesome.com/1e1e181846.js"></script>
<script src="/js/jquery-1.10.1.min.js"></script>
<script src="/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script src="/js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="/js/app.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
</body>
</html>
