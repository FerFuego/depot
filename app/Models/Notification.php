<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'detail',
        'state',
        'user_id',
        'sucursal_id'
    ];

    protected $with = ['user', 'sucursal'];

    /**
     * Relationships
     * @return collection
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function sucursal () {
        return $this->belongsTo(Sucursal::class);
    }
}
