<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Open Sans:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div class="row">
            <div class="header">
                <div class="container">

                </div>
            </div>
            <div class="body">
                <div class="col-sm-9">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>
                <div class="col-sm-3">
                    Entries list
                </div>
            </div>
            <div class="footer"></div>
        </div>

        <script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
        <script type="text/javascript">
            ymaps.ready(init);
            var myMap;

            function init(){
                myMap = new ymaps.Map ("map", {
                    center: [55.76, 37.64],
                    zoom: 7
                });
            }
        </script>
    </body>
</html>
