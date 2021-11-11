<template>
<section>
    <form class="form-horizontal">
         <fieldset>
            <legend>Add new</legend>
            <div class="form-group">
                <label class="col-md-2" for="new-title">Title:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="new-title" placeholder="Title" v-model="newTodo.title">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-md-2" for="new-description">Description:</label>
                <div class="col-md-10">
                    <textarea class="form-control" rows="2" id="new-description" placeholder="Description" v-model="newTodo.description"></textarea>
                </div>
            </div>
            <a class="btn btn-primary btn-block" href="#" role="button" v-on:click.prevent="addTodo($event)">Add</a>
        </fieldset>
    </form>
    <br/>
    <form>
        <fieldset>
            <legend>List of todo`s:</legend>
            <section v-for="todo in todos" :key="todo.id">
                <div class="flex-group" v-bind:class="[ todo.checked ? 'bg-success' : 'bg-warning']">
                    <div class="flex-control">
                        <input type="checkbox" v-model="todo.checked">
                    </div>
                    <div class="flex-text todo-padding css-tooltip">
                        <p class="text" v-bind:class="{'text-striped': todo.checked}">{{todo.title}}</p>
                        <span class="css-tooltip-text">{{todo.description}}</span>
                    </div>
                    <div class="flex-control">
                        <button type="button" class="close" aria-label="Close" v-on:click.prevent="delTodo(todo.id)"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </section>
            </div>
            <hr/>
            <button class="btn btn-danger btn-block" v-on:click.prevent="delChecked()">Delete checked</button>
        </fieldset>
    </form>
</section>
</template>

<script>

    class Todo {
        constructor (init = {}) {
            this.id = init.id || new Date().getTime();
            this.checked = init.checked || false;
            this.title = init.title || '';
            this.description = init.description || '';
            this.created_at = init.created_at || null;
            this.updated_at = init.updated_at || null;
            this.checked_at = init.checked_at || null;
        }
    }

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                todos: [
                    {
                        id:7,checked:false,
                        created_at:'2021-11-05T18:35:48.000000Z',
                        updated_at:'2021-11-05T18:35:48.000000Z',
                        checked_at:null,
                        title:'Lorem ipsum dolor sit amet',
                        description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco'
                    },{
                        id:8,checked:0,
                        created_at:'2021-11-05T18:35:48.000000Z',
                        updated_at:'2021-11-05T18:35:48.000000Z',
                        checked_at:true,
                        title:'Lorem ipsum dolor sit amet, consectetur',
                        description:'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco'
                    }
                ],
                newTodo: new Todo()
            }
        },
        methods: {
            addTodo(ev) {
                //this.newTodo.title = 'TEST';

                console.log(`newTodo.title: `, this.newTodo );

                this.todos.push(this.newTodo);
                this.newTodo = new Todo();
            },

            delTodo(todoId) {
                this.todos = this.todos.filter((todo)=>{
                    return todo.id !== todoId;
                })
            },

            delChecked() {
                this.todos = this.todos.filter((todo)=>{
                    return todo.checked == false;
                })
            }
        }
    }
</script>
