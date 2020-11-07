<?php

namespace App\Traits;

use App\Models\Sucursal;

trait HasSucursals {

    public function sucursals () {
        return $this->belongsToMany(Sucursal::class, 'users_sucursals');
    }

    public function hasSucursal($sucursal) {
        //Cutom Control of middleware
        if ( $this->sucursals->contains('slug', $sucursal) ) {
            return true;
        }

        return false;
    }
}