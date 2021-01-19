<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRhh extends Model
{
    use HasFactory;

    protected $table = 'rrhhs';

    protected $fillable = [
        'title',
        'details'
    ];

    protected $with = ['sucursals'];

    /**
     * Relationship
     */
    public function sucursals () {
        return $this->belongsToMany(Sucursal::class, 'sucursals_rrhhs', 'rrhh_id', 'sucursal_id');
    }
}
