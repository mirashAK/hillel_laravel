<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', [Controller::class, 'render_view']);

//Route::get('/todo', [Controller::class, 'render_todo']);
Route::get('/todo/{name?}', [Controller::class, 'render_todo'])->where('name', '[A-Za-z]+');

// Route::get('/todo/?{name}', function(){
//     return redirect('render_todo');
// })->where('name', '[A-Za-z]+');
