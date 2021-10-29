<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ToDo;

class ToDoController extends Controller
{
    public function index()
    {
        return ToDo::all();
    }

    public function show($id)
    {
        return ToDo::find($id);
    }

    public function store(Request $request)
    {
        return ToDo::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = ToDo::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = ToDo::findOrFail($id);
        $article->delete();

        return 204;
    }

    public function render_view()
    {
        return view('todo');
    }
}
