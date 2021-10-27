<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ToDoController;

Route::get('todos', [ToDoController::class, 'index']); //'ToDoController@index');
Route::get('todos/{id}', [ToDoController::class, 'show']);
Route::post('todos', [ToDoController::class, 'store']);
Route::put('todos/{id}', [ToDoController::class, 'update']);
Route::delete('todos/{id}', [ToDoController::class, 'delete']);
