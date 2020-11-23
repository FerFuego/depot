<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Http\Request;

class CommandService {
    
    public function diaryTasks () {

        $date = Carbon::now()->locale('es');
        $day = $date->isoFormat('dddd');

        $todos = Todo::where('days', 'like', '%' . $day . '%')->get();

        foreach ($todos as $todo) {

            foreach ($todo->tasks as $task) {

                $todolist = TodoList::create([
                    'name' => $task->title,
                    'description' => $task->description,
                    'is_complete' => 0
                ]);
                
                foreach ($todo->sucursal as $sucursal) {
    
                    $todolist->sucursal()->attach($sucursal->id);
                }
            }
        }
    }
}