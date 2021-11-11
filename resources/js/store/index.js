import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import axios from 'axios';
axios.defaults.baseURL = BASE_URL + '/api/';
//console.log(`axios.defaults: `, axios.defaults);

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

export default
    new Vuex.Store({
        state: {
            mocTodos: [
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
            todos: [],
            newTodo: new Todo(),
        },
        getters: {
            getTodos: state => state.todos,
            getFilterdedTodos: state => status => {
                switch(status) {
                    case 'checked' : {
                        return state.todos.filter((todo)=>todo.checked)
                    } break;
                    case 'unchecked' : {
                        return state.todos.filter((todo)=>!todo.checked)
                    } break;
                    default : {
                        return state.todos;
                    } break;
                };
            },
            newTodo: state => state.newTodo
        },
        actions: {
            addTodo: ({ dispatch, commit, state }) => {
                return axios.post('todos', state.newTodo)
                .then(response => {
                    commit('setNewTodo', response.data);
                    return response;
                })
                .catch(function(error) {
                    console.error(error)
                    return error.response;
                })
            },
            loadTodos: ({ dispatch, commit }) => {
                return axios.get('todos')
                .then((response) => {
                    commit('setTodos', response.data);
                    return response;
                })
                .catch(function(error) {
                    console.error(error)
                    return error.response;
                })
            },
            setTodoChecked: ({ dispatch, commit }, todo) => {
                if (todo.checked) {
                    todo.checked_at = new Date().toISOString()
                        .replace(/T/, ' ').replace(/\..+/, '');
                } else {
                    todo.checked_at = null;
                }
                return axios.put('todos/' + todo.id, todo)
                .then(response => {
                    commit('updTodo', response.data);
                    return response;
                })
                .catch(function(error) {
                    console.error(error)
                    return error.response;
                })
            },
            delTodo ({ dispatch, commit }, todoId) {
                return axios.delete('todos/' + todoId)
                .then(response => {
                    commit('delTodo', todoId);
                    return response;
                })
                .catch(function(error) {
                    console.error(error)
                    return error.response;
                })
            },
            async delChecked ({ dispatch, commit, state }) {
                const toDelete = state.todos.filter((todo)=>todo.checked);
                console.log(`toDelete: `, toDelete);
                for (let todo of toDelete) {
                    await dispatch('delTodo', todo.id);
                }
            }
        },
        mutations: {
            setTodos (state, todos) {
                state.todos = todos.map((todo)=>{
                    return new Todo(todo);
                });
            },
            setNewTodo (state, todo) {
                state.todos.push(new Todo(todo));
                state.newTodo = new Todo();
            },
            updTodo (state, updTodo) {
                state.todos.forEach((todo)=>{
                    if (todo.id == updTodo.id) {
                        todo = new Todo(updTodo);
                    }
                })
            },
            delTodo (state, todoId) {
                state.todos = state.todos.filter((todo)=>{
                    return todo.id !== todoId;
                })
            },
        }
    })
