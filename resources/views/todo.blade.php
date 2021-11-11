<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .todo-padding {
                padding-top: 10px;
            }
            .text-striped {
                text-decoration: line-through;
            }
            /* Tooltip container */
            .css-tooltip {
                position: relative;
            }

            /* Tooltip text */
            .css-tooltip .css-tooltip-text {
                visibility: hidden;
                background-color: #337ab7;
                color: #fff;
                text-align: center;
                padding: 5px;
                border-radius: 6px;

                /* Position the tooltip text - see examples below! */
                position: absolute;
                z-index: 1;
            }

            /* Show the tooltip text when you mouse over the tooltip container */
            .css-tooltip:hover .css-tooltip-text {
                visibility: visible;
                top: 90%;
                left: 10%;
            }

            .flex-group {
                display: flex;
                flex-direction: row;
                align-items: center;
                padding-left: 15px;
            }
            .flex-control {
                width: 5%;
            }
            .flex-control .close {
                float: none;
            }
            .flex-text {
                width: 90%;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center">ToDo`s</h1>
        <div class="col-md-4"></div>
        <div class="col-md-4" id="app">
            <router-view></router-view>
        </div>
        <div class="col-md-4"></div>

        <script type="text/javascript">
            const BASE_URL = "{{ url('/') }}";
        </script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
