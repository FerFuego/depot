<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'days'
    ];

    /**
     * Relationships
     * @return collection
     */
    public function tasks () {
        return $this->belongsToMany(Task::class, 'tasks_todos');
    }

    public function sucursal() {
        return $this->belongsToMany(Sucursal::class, 'sucursals_todos');
    }
}
