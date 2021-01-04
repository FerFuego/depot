<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rrhh extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'details'
    ];

    /**
     * Relationship
     */
    public function sucursal () {
        return $this->belongsToMany(Sucursal::class, 'sales_sucursals');
    }
}
