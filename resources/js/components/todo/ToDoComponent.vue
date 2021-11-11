<template>
<section>
<ul class="nav nav-tabs">
  <li role="presentation" v-bind:class="{'active': $route.name == 'todo'}"><router-link to="/todo">All</router-link></li>
  <li role="presentation" v-bind:class="{'active': $route.name == 'checked'}"><router-link to="/todo/checked">Checked</router-link></li>
  <li role="presentation" v-bind:class="{'active': $route.name == 'unchecked'}"><router-link to="/todo/unchecked">Unchecked</router-link></li>
</ul>
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
            <section v-for="todo in filterdedTodos" :key="todo.id">
                <div class="flex-group" v-bind:class="[ todo.checked ? 'bg-success' : 'bg-warning']">
                    <div class="flex-control">
                        <input type="checkbox" v-model="todo.checked">
                    </div>
                    <div class="flex-text todo-padding css-tooltip">
                        <p class="text" v-bind:class="{'text-striped': todo.checked}">{{todo.title}}</p>
                        <span class="css-tooltip-text">
                            Description: {{todo.description}}<br/>
                            CheckedAt: {{todo.checked_at ? todo.checked_at : 'Never'}}
                        </span>
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

    import { mapGetters, mapActions, mapMutations } from 'vuex';

    export default {
        mounted() {
            console.log('Component mounted.');
            console.log(`this.$store.state.todos: `, this.$store.state.todos);
            console.log(`this.$store.getters.getTodos: `, this.$store.getters.getTodos);
            console.log(`this.getTodos: `, this.getTodos);

            this.loadTodos();
        },
        data() {
            return {
            }
        },
        computed: {
            ...mapGetters([
                'getTodos',
                'getFilterdedTodos',
                'newTodo',
            ]),
            filterdedTodos: {
                get() {
                    return this.getFilterdedTodos(this.$route.name);
                }
            },
        },
        methods: {
            ...mapActions([
                'loadTodos',
                'addTodo',
                'setTodoChecked',
                'delTodo',
                'delChecked'
            ]),
        },
        watch: {
            'filterdedTodos': {
                deep: true,
                handler(newVal, oldVal) {
                    if(newVal.length && oldVal.length) {
                        const checked = newVal.filter((todo)=>{
                            return (todo.checked && !todo.checked_at) || (!todo.checked && todo.checked_at);
                        })
                        if (checked.length) {
                            this.setTodoChecked(checked[0]);
                        }
                    }
                }
            }
        }
    }
</script>
