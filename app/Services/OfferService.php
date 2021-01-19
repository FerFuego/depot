<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferService {

    public function uploadFile(Request $request) {

        $fileName = time() . '_' . $request->file->getClientOriginalName();

        $request->file->move( public_path('uploads'), $fileName );

        return $fileName;
    }

    public function addSucursal ( $offer, $request ) {
        foreach ( $request->sucursal as $sucursal ) {
            $offer->sucursals()->attach( $sucursal );
        } 
    }

    public function updateSucursal ( $offer, $request ) {
        $offer->sucursals()->detach(); 
        $this->addSucursal( $offer, $request );
    }

}