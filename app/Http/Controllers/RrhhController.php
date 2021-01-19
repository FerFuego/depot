<?php

namespace App\Http\Controllers;

use App\Models\RRhh;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Services\RRhhService;
use App\Http\Requests\RRhhRequest;

class RRhhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rrhhs = RRhh::orderBy('id', 'desc')->get();

        return view('rrhh.index',[
            'rrhhs' => $rrhhs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursals = Sucursal::orderBy('id', 'asc')->get();

        return view('rrhh.create', [
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RRhhRequest $request, RRhhService $service)
    {
        $rrhh = RRhh::create($request->all());

        $service->addSucursal($rrhh, $request);

        session()->flash('success', 'RRHH Creada Correctamente!');

        return redirect('/rrhhs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RRhh  $rrhh
     * @return \Illuminate\Http\Response
     */
    public function show(RRhh $rrhh)
    {
        return view('rrhh.show', [
            'rrhh' => $rrhh
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RRhh  $rrhh
     * @return \Illuminate\Http\Response
     */
    public function edit(RRhh $rrhh)
    {
        $sucursals = Sucursal::orderBy('id', 'asc')->get();

        return view('rrhh.edit', [
            'rrhh' => $rrhh,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RRhh  $rrhh
     * @return \Illuminate\Http\Response
     */
    public function update(RRhhRequest $request, RRhh $rrhh, RRhhService $service)
    {
        $rrhh->fill($request->all())->update();

        $service->updateSucursal($rrhh, $request);

        session()->flash('success', 'RRHH Actualizada Correctamente!');

        return redirect('/rrhhs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RRhh  $rrhh
     * @return \Illuminate\Http\Response
     */
    public function destroy(RRhh $rrhh)
    {
        $rrhh->sucursals()->detach();
        $rrhh->delete();

        session()->flash('success','RRHH Eliminada Correctamente!');

        return redirect('/rrhhs');
    }
}
