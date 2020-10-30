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
        'schedule',
        'user_id'
    ];

    protected $with = ['user'];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
