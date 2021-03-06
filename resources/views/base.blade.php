<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value="{{csrf_token()}}">

    <title>Экологическая карта</title>

    <link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
    @yield('content')

    <script src="https://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
    <script src="https://use.fontawesome.com/1e1e181846.js"></script>
    <script>
        window.Laravel = '<?php echo json_encode([ 'csrfToken' => csrf_token() ]); ?>';
    </script>

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