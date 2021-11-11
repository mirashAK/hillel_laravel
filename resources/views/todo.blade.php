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
        <div id="app">
            <example-component></example-component>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <form class="form-horizontal">
                <fieldset>
                    <legend>Add new</legend>
                    <div class="form-group">
                        <label class="col-md-2" for="new-title">Title:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="new-title" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-md-2" for="new-description">Description:</label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="2" id="new-description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <a class="btn btn-primary btn-block" href="#" role="button">Add</a>
                </fieldset>
            </form>
            <br/>
            <form>
                <fieldset>
                    <legend>List of todo`s:</legend>

                    <div class="flex-group bg-warning">
                        <div class="flex-control">
                            <input type="checkbox">
                        </div>
                        <div class="flex-text todo-padding css-tooltip">
                            <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                            <span class="css-tooltip-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                        </div>
                        <div class="flex-control">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>

                    <div class="flex-group bg-success">
                        <div class="flex-control">
                            <input type="checkbox" checked>
                        </div>
                        <div class="flex-text todo-padding css-tooltip">
                            <p class="text text-striped">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                            <span class="css-tooltip-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                        </div>
                        <div class="flex-control">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                    <hr/>
                    <button class="btn btn-danger btn-block">Delete checked</button>
                </fieldset>
            </form>

        </div>
        <div class="col-md-4"></div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
