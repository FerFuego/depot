<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'todo_lists';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'state',
        'is_complete'
    ];

    /**
     * Relationships
     * @return collection
     */
    public function sucursal() {
        return $this->belongsToMany(Sucursal::class, 'sucursals_todo_lists');
    }
}
