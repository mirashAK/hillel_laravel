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
        <script type="text/javascript">
            const BASE_URL = "{{ url('/') }}";
        </script>
    </head>
    <body>
        <h1 class="text-center">ToDo`s</h1>
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
                    <a id="add-todo" class="btn btn-primary btn-block" href="#" role="button">Add</a>
                </fieldset>
            </form>
            <br/>
            <form>
                <fieldset id="todos-container">
                    <legend>List of todo`s:</legend>

<!--                    <div class="todo-container flex-group bg-warning">
                        <div class="flex-control">
                            <input class="check-todo" type="checkbox" />
                        </div>
                        <div class="flex-text todo-padding css-tooltip">
                            <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                            <span class="css-tooltip-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                        </div>
                        <div class="flex-control">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>

                    <div class="todo-container flex-group bg-success">
                        <div class="flex-control">
                            <input class="check-todo" type="checkbox" checked />
                        </div>
                        <div class="flex-text todo-padding css-tooltip">
                            <p class="text text-striped">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                            <span class="css-tooltip-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                        </div>
                        <div class="flex-control">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>-->

                </fieldset>
                <hr/>
                <button class="btn btn-danger btn-block">Delete checked</button>
            </form>

        </div>
        <div class="col-md-4"></div>


        <script type="text/javascript">

            const getToDos = ()=>{
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `${BASE_URL}/api/todos`, true); // true == async
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = ()=>{
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        const toDosArray = JSON.parse(xhr.responseText);
                        const containerEl = document.getElementById('todos-container');
                        toDosArray.forEach((todo)=>{
                            const newToDoEl = createElementFromHTML(todo);
                            newToDoEl.querySelector('.check-todo').addEventListener('change', function(event){
                                handleChangeEvent.call(this);
                            });
                            newToDoEl.querySelector('button.close').addEventListener('click', function(event){
                                handleDeleteEvent.call(this);
                            })
                            containerEl.appendChild(newToDoEl);
                        })
                    }
                };
                xhr.send();
            }


            const sendCheckToDo = (params)=>{
                const xhr = new XMLHttpRequest();
                xhr.open("PUT", `${BASE_URL}/api/todos/${params.id}`, true); // true == async
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = ()=>{
                    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        console.log(`request done`);
                    }
                }
                xhr.send(JSON.stringify(params));
            }

            const sendNewToDo = (params, callback)=>{
                const xhr = new XMLHttpRequest();
                xhr.open("POST", `${BASE_URL}/api/todos`, true); // true == async
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = ()=>{
                    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 201) {
                        const toDo = JSON.parse(xhr.responseText);
                        if (callback) callback(toDo);
                    }
                }
                xhr.send(JSON.stringify(params));
            }

            function createNewTodo() {
                const titleEl = document.getElementById('new-title');
                const descEl = document.getElementById('new-description');

                const params = {
                    title: titleEl.value,
                    description: descEl.value,
                    checked: false,
                }

                sendNewToDo(params, createNewTodoElement);

                titleEl.value = '';
                descEl.value = '';
            }

            const deleteToDo = (params)=>{
                const xhr = new XMLHttpRequest();
                xhr.open("DELETE", `${BASE_URL}/api/todos/${params.id}`, true); // true == async
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = ()=>{
                    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        document.getElementById(params.id).remove();
                    }
                }
                xhr.send(JSON.stringify(params));
            }

            function createNewTodoElement(params) {
                const newToDoEl = createElementFromHTML(params);
                newToDoEl.querySelector('.check-todo').addEventListener('change', function(event){
                    handleChangeEvent.call(this);
                })

                newToDoEl.querySelector('button.close').addEventListener('click', function(event){
                    handleDeleteEvent.call(this);
                })

                const containerEl = document.getElementById('todos-container');
                containerEl.appendChild(newToDoEl);
            }

            function handleDeleteEvent() {
                const params = {
                    id: this.dataset.id
                };
                deleteToDo(params);
            }

            function createElementFromHTML(params) {

                const div = document.createElement('div');
                const htmlString =
                `<div id="${params.id ? params.id : ''}" class="todo-container flex-group ${params.checked ? 'bg-success' : 'bg-warning'}">
                    <div class="flex-control">
                        <input class="check-todo" type="checkbox" data-id="${params.id ? params.id : ''}" ${params.checked ? 'checked' : ''}/>
                    </div>
                    <div class="flex-text todo-padding css-tooltip">
                        <p class="text ${params.checked ? 'text-striped' : ''}">${params.title}</p>
                        <span class="css-tooltip-text">${params.description}</span>
                    </div>
                    <div class="flex-control">
                        <button type="button" data-id="${params.id ? params.id : ''}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>`;
                div.innerHTML = htmlString.trim();

                return div;
            }

            function handleChangeEvent() {
                console.log(`this.checked: `, this.checked);
                const parent = this.closest('.todo-container');
                const text = parent.querySelector('.text');
                if (this.checked) {
                    parent.classList.remove('bg-warning');
                    parent.classList.add('bg-success');
                    text.classList.add('text-striped');
                } else {
                    parent.classList.remove('bg-success');
                    parent.classList.add('bg-warning');
                    text.classList.remove('text-striped');
                }
                //2012-11-04 14:51:06
                let date = new Date().toISOString();
                date = date.replace(/T/, ' ').replace(/\..+/, '');

                const params = {
                    id: this.dataset.id,
                    checked: this.checked,
                    checked_at: this.checked ? date : null
                }

                sendCheckToDo(params);
            }

            console.log(`DOMContentLoaded: Before`);
            document.addEventListener('DOMContentLoaded', function(){ // Аналог $(document).ready(function(){
                getToDos();
//                 const checkboxes = document.querySelectorAll('.check-todo');
//                 checkboxes.forEach(function (checkbox, checkboxIdx){
//                     console.log(`checkbox: `, checkboxIdx, checkbox);
//                     checkbox.addEventListener('change', function(event){
//                         handleChangeEvent.call(this);
//                     })
//                 })
                const addButton = document.getElementById('add-todo');
                addButton.addEventListener('click', function(event){
                    event.preventDefault();
                    console.log(`addButton.click: ` );
                    createNewTodo();
                })
            });
        </script>

    </body>
</html>
