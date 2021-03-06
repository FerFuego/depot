<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'details',
        'file',
        'time_start',
        'time_end'
    ];

    protected $with = ['sucursals'];

    /**
     * Relationship
     */
    public function sucursals () {
        return $this->belongsToMany(Sucursal::class, 'sucursals_offers');
    }
}
