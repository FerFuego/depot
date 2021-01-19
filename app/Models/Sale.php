<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'clients',
        'turn'
    ];

    public function sucursal () {
        return $this->belongsToMany(Sucursal::class, 'sales_sucursals');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'users_sales');
    }
}
