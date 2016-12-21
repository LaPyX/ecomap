<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="token" name="token" value="{{csrf_token()}}">

        <title>Экологическая карта</title>

        <link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>

        <script>
            window.Laravel = '<?php echo json_encode([ 'csrfToken' => csrf_token() ]); ?>';
        </script>
        <script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard,package.regions&lang=ru-RU" type="text/javascript"></script>
        <script src="https://use.fontawesome.com/1e1e181846.js"></script>
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
