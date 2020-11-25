<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'schedule'
    ];

    protected $with = ['sales', 'todo_lists'];

    /**
     * Relationships
     * @return collection
     */
    public function users () {
        return $this->belongsToMany(User::class, 'users_sucursals');
    }

    public function sales () {
        return $this->belongsToMany(Sale::class, 'sales_sucursals');
    }

    public function todo_lists () {
        return $this->belongsToMany(TodoList::class, 'sucursals_todo_lists');
    }
}
