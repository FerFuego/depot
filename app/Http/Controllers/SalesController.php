<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Sucursal;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( SaleService $service )
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
        $sucursals = Sucursal::orderBy('id', 'asc')->get();
        $salesToday = $service->calcDailySales($sales);
        $totalSales = $service->calcTotalSales($sales);
        $totalClients = $service->calcTotalClients($sales);
        $days = Sale::select('created_at')
                    ->orderBy('created_at', 'desc')
                    ->groupBy(DB::raw('Date(created_at)'))
                    ->get();

        return view('sales.index', [
            'days' => $days,
            'sales' => $sales,
            'sucursals' => $sucursals,
            'salesToday' => $salesToday,
            'request' => [],
            'totalSales' => $totalSales,
            'totalClients' => $totalClients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursals = auth()->user()->sucursals;
        
        return view('sales.create', [
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SaleService $service)
    {
        $sale = Sale::create($request->except('sucursal'));
        
        $service->addSucursal($sale, $request);

        $service->addUser($sale);

        session()->flash('success','Venta Creada Correctamente!');

        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $sucursals = auth()->user()->sucursals;

        return view('sales.edit', [
            'sale' => $sale,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale, SaleService $service)
    {
        $sale->fill( $request->except('sucursal') )->update();
        
        $service->updateSucursal($sale, $request);

        session()->flash('success','Venta Actualizada Correctamente!');

        $sucursals = auth()->user()->sucursals;

        return view('sales.edit', [
            'sale' => $sale,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->sucursal()->detach();
        $sale->user()->detach();
        $sale->delete();

        session()->flash('success','Venta Eliminada Correctamente!');

        return redirect('/sales');
    }


    public function filter(Request $request, SaleService $service) {

        $sucursals = Sucursal::orderBy('id', 'asc')->get();
        $days = Sale::select('created_at')
                    ->orderBy('created_at', 'desc')
                    ->groupBy(DB::raw('Date(created_at)'))
                    ->get();

        $query = Sale::query();
        $query->when( isset($request->turn), function ($q) use ($request){
            $q->where('turn', $request->turn);
        });
        $query->when( isset($request->day), function ($q) use ($request){
            $q->whereDate('created_at', $request->day);
        });
        $query->when( isset($request->sucursal), function ($q) use ($request){
            $q->join('sales_sucursals', function ($q) use ($request){
                $q->on('sale_id', '=', 'id');
                $q->where('sucursal_id', '=', $request->sucursal);
            });
        });
        $query->orderBy('created_at', 'desc');
        $sales = $query->get();

        $salesToday = $service->calcDailySales($sales);
        $totalSales = $service->calcTotalSales($sales);
        $totalClients = $service->calcTotalClients($sales);

        return view('sales.index', [
            'sales' => $sales,
            'days'  => $days,
            'sucursals' => $sucursals,
            'salesToday' => $salesToday,
            'request'   => $request->all(),
            'totalSales' => $totalSales,
            'totalClients' => $totalClients
        ]);
    } 
}
