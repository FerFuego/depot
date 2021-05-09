<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_year = Carbon::now()->format('Y');
        $current_month = Carbon::now()->format('m');
        $start = strtotime("$current_year-$current_month-01");
        $bookings = Booking::orderBy('id', 'asc')->get();

        return view('bookings.index', [
            'bookings' => $bookings,
            'start' => $start,
            'index' => 0,
            'year' => $current_year,
            'month' => $current_month,
            'startpos' => 0,
            'continue2' => 1,
        ]);
    }

    public function create() {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BookingService $service)
    {
        // chek if is a valid date
        $status = $service->checkDate($request);

        if ($status !== 'good' && $status !== 'today') {
            session()->flash('error', $status);
            return view('suppliers', [
                'result' => ''
            ]);
        }

        // check if there are availble places
        if (!$service->checkPlaces($request)) {
            session()->flash('error', 'No hay lugares disponibles en este dia');
            return view('suppliers', [
                'result' => ''
            ]);
        }
       
        // get all times of the request day
        $bookings = $service->getLastBooking($request);

        // get params
        $params = $request->all();

        if ($status == 'today') {

            $current_time = $service->checkTime();

            if (!$current_time) {
                session()->flash('error', 'Horario no disponible');
                return view('suppliers', [
                    'result' => ''
                ]);
            }

            //agrega 15 min si el ultimo registro ya paso o es igual a ahora
            if ( !$bookings || $current_time->lte(Carbon::parse(@$bookings[0]->end)) ) {
                $service->storeEmptyTime($request);
                $bookings = $service->getLastBooking($request);
            }

            $params['day'] = Carbon::now()->format('Y-m-d');
            $params['time'] = $service->calcTimePallets($request);
            $params['start'] = $bookings[0]->end;
            $params['end'] = $service->calcEndOfTimes($params['start'], $params['time']);
    
            $booking = Booking::create($params);

        } else {
    
            // check if no exist bookings
            if ($bookings->isEmpty()) {
                $params['time'] = $service->calcTimePallets($request);
                $params['start'] = $params['day'] .' '. env('TIME_OPEN', '09:00:00');
                $params['end'] = $service->calcEndOfWork($request, $params['start']);
                // insert first turn
                $booking = Booking::create($params);
            } else {
                $params['day'] = $request->day;
                $params['time'] = $service->calcTimePallets($request);
                $params['start'] = $bookings[0]->end;
                $params['end'] = $service->calcEndOfTimes($params['start'], $params['time']);
        
                $booking = Booking::create($params);
            }
        }

        // insert empty time
        $service->storeEmptyTime($request);

        if ($request->email) {
            \Mail::to($request->email)->send(new \App\Mail\SupplierNotification($booking));
        }
        
        session()->flash('success', 'Reserva cargada correctamente');
        
        $previous = url()->previous();
        $previous = explode('/', $previous);

        if (end($previous) == 'proveedores') {
            return view('suppliers')->with('result', $booking);
        } else {
            return redirect()->back()->with('result', $booking);
        }
    }

    public function filter(Request $request) 
    {
        $current_month = $request->month ? $request->month : Carbon::now()->format('m');
        $current_year = $request->year ? $request->year : Carbon::now()->format('Y');
        $start = strtotime("$current_year-$current_month-01");
        $bookings = Booking::orderBy('id', 'asc')->get();

        return view('bookings.index', [
            'bookings' => $bookings,
            'start' => $start,
            'index' => 0,
            'startpos' => 0,
            'continue2' => 1,
            'year' => $current_year,
            'month' => $current_month,
        ]);

    }

    public function state(Request $request) {
        $booking = Booking::findOrFail($request->id);
        $booking->state = $request->state;
        $booking->update();
        return $booking;
    }
}
