<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService {

    public function calcDailySales ( $sales ) {
        $total['sales'] = 0;
        $total['clients'] = 0;

        if ($sales) :
            foreach($sales as $key => $sale) :
                if ( $sale->created_at >= Carbon::today() ) :
                    $total['sales'] += $sale->amount;
                    $total['clients'] += $sale->clients;
                endif;
            endforeach;
        endif;

        return $total;
    }

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

    public function calcTotalSales ($sales) {
        $total = 0;
        foreach ($sales as $sale) {
            $total += $sale->amount;
        }
        return $total;
    }

    public function calcTotalClients ($sales) {
        $total = 0;
        foreach ($sales as $sale) {
            $total += $sale->clients;
        }
        return $total;
    }

}