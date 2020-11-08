<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService {

    public function addSucursal ( $sale, $request ) {
        $sale->sucursal()->attach( $request->sucursal );
    }

    public function updateSucursal ( $sale, $request ) {
        $sale->sucursal()->detach(); 
        $this->addSucursal( $sale, $request );
    }

    public function addUser ( $sale ) {
        $sale->user()->attach( auth()->user()->id );
    }

}