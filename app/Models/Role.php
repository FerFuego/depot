<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $with = ['permissions'];

    public function permissions () {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
}
