<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Services\SucursalService;
use Illuminate\Support\Facades\Gate;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursals = Sucursal::orderBy('id', 'asc')->get();

        return view('sucursals.index', [
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if ( Gate::denies('isSuper') || Gate::denies('isAdmin') ) {
            Abort(403);
        } */

        $users = User::orderBy('name', 'asc')->get();

        return view('sucursals.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SucursalService $service)
    {
        $sucursal = Sucursal::create($request->except('gerents'));

        $service->addGerents( $sucursal, $request );

        session()->flash('success','Sucursal Creada Correctamente!');

        return redirect('/sucursals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        return view('sucursals.show',[
            'sucursal' => $sucursal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        $users = User::orderBy('name', 'asc')->get();

        return view('sucursals.edit', [
            'sucursal' => $sucursal,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal, SucursalService $service)
    {
        $sucursal->fill( $request->except('gerents') )->update();

        $service->updateGerents( $sucursal, $request );

        session()->flash('success','Sucursal Actualizada Correctamente!');

        $users = User::orderBy('name', 'asc')->get();

        return view('sucursals.edit', [
            'sucursal' => $sucursal,
            'users' => $users
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();

        session()->flash('success','Sucursal Eliminada Correctamente!');

        return redirect('/sucursals');
    }
}
