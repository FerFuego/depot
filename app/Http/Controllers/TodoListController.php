<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoLists = TodoList::orderBy('created_at', 'desc')->paginate();

        return view('todolists.index', [
            'todoLists' => $todoLists
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $todoList)
    {
        $todoList = TodoList::find($request->task_id);
        $todoList->fill($request->only('state', 'is_complete'))->update();
        
        return response()->json( $request->all() ); 
    }

}
