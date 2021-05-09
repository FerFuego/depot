<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class OfferService {

    public function uploadFile(Request $request) {

        $fileName = time() . '_' . $request->file->getClientOriginalName();

        $request->file->move( public_path('uploads'), $fileName );

        return $fileName;
    }

    public function addSucursal ( $offer, $request ) {
        if ($request->sucursal[0] == 'todas') {
            $sucursals = $this->getAllSucursals();
            foreach ( $sucursals as $sucursal ) {
                $offer->sucursals()->attach( $sucursal );
            } 
        } else {
            foreach ( $request->sucursal as $sucursal ) {
                $offer->sucursals()->attach( $sucursal );
            } 
        }
    }

    public function updateSucursal ( $offer, $request ) {
        $offer->sucursals()->detach(); 
        $this->addSucursal( $offer, $request );
    }

    public function getAllSucursals () {
        return Sucursal::orderBy('id', 'asc')->get();
    }

}