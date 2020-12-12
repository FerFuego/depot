<?php

namespace App\Observers;

use App\Models\TodoList;
use App\Models\Notification;
use Illuminate\Http\Request;

class TodoListObserver
{
    /**
     * Handle the todo list "created" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function created(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the todo list "updated" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function updated(TodoList $todoList)
    {
        $notification = Notification::create([
            'type'      => 'Tarea',
            'title'     => 'Tarea ' . $todoList->state,
            'detail'    => $todoList->name,
            'state'     => 0,
            'user_id'       => auth()->user()->id,
            'sucursal_id'   => $todoList->sucursal[0]->id
        ]);
    }

    /**
     * Handle the todo list "deleted" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function deleted(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the todo list "restored" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function restored(TodoList $todoList)
    {
        //
    }

    /**
     * Handle the todo list "force deleted" event.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return void
     */
    public function forceDeleted(TodoList $todoList)
    {
        //
    }
}
