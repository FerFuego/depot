<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();

        return view('sales.index', [
            'sales' => $sales
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
}
