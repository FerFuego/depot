<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Todo;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('id', 'asc')->get();

        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursals = Sucursal::all();
        $tasks = Task::all();
        
        return view('todos.create',[
            'tasks' => $tasks,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $sucursal = Sucursal::find($request->sucursal);

        $todo = Todo::create([
            'name' => 'Lista de Tareas - ' . $sucursal->name,
            'days' => implode(',', $request->days )
        ]);

        $todo->sucursal()->attach($sucursal->id);
        
        foreach ($request->tasks as $task) {
            $todo->tasks()->attach($task);
        }

        session()->flash('success', 'Lista de Tareas Creada Correctamente!');

        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todos.show', [
            'todo' => $todo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $sucursals = Sucursal::all();
        $tasks = Task::all();

        return view('todos.edit', [
            'todo' => $todo,
            'tasks' => $tasks,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->tasks()->detach();
        $todo->sucursal()->detach();
        $todo->delete();

        session()->flash('success','Lista de Tarea Eliminada Correctamente!');

        return redirect('/todos');
    }
}
