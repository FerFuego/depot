<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Services\OfferService;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id', 'desc')->get();

        return view('offers.index',[
            'offers' => $offers
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

        return view('offers.create',[
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request, OfferService $service)
    {
        $params = $request->all();

        if ( $request->file ) {
            $params['file'] = $service->uploadFile($request);
        }

        $offer = Offer::create($params);

        $service->addSucursal($offer, $request);

        session()->flash('success', 'Oferta Creada Correctamente!');

        return redirect('/offers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('offers.show', [
            'offer' => $offer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $sucursals = Sucursal::orderBy('id', 'asc')->get();

        return view('offers.edit', [
            'offer' => $offer,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer, OfferService $service)
    {
        $params = $request->all();

        if ( $request->file ) {
            $params['file'] = $service->uploadFile($request);
        }

        $offer->fill($params)->update();

        $service->updateSucursal($offer, $request);

        session()->flash('success', 'Oferta Actualizada Correctamente!');

        return redirect('/offers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->sucursals()->detach();
        $offer->delete();

        session()->flash('success','Oferta Eliminada Correctamente!');

        return redirect('/offers');
    }

    public function download($id)
    {
        $offer = Offer::findOrFail($id);

        $data = [
            'title' => $offer->title,
            'details' => $offer->details,
            'file'  => $offer->file
        ];
    
        $pdf = \PDF::loadView('offers.print', $data);
    
        return $pdf->download('banner.pdf');
    }
}
