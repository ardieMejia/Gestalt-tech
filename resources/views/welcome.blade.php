<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href={{route("uploadpage")}}>Upload csv files</a>
                </div>
                <div class="col-md-3">
                    <a href={{route("member")}}>Member Maintenance</a>
                </div>
                <div class="col-md-3">
                    <a href={{route("transaction")}}>Transaction Maintenance</a>
                </div>
            </div>




        </div>
    </body>
</html>
