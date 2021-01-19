<?php

namespace App\Services;

use App\Models\RRhh;
use Illuminate\Http\Request;

class RRhhService {

    public function addSucursal ( $rrhh, $request ) {
        foreach ( $request->sucursal as $sucursal ) {
            $rrhh->sucursals()->attach( $sucursal );
        } 
    }

    public function updateSucursal ( $rrhh, $request ) {
        $rrhh->sucursals()->detach(); 
        $this->addSucursal( $rrhh, $request );
    }

}