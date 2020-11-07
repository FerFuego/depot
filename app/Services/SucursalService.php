<?php

namespace App\Services;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalService {

    public function addGerents( $sucursal, $request ) {
        foreach ($request->gerents as $user) {
            $sucursal->users()->attach($user);
        }
    }

    public function updateGerents ( $sucursal, $request ) {

        $sucursal->users()->detach(); 

        $this->addGerents($sucursal, $request);
    }

}