<?php

namespace App\Services;

use DateTime;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingService {

    /**
     * Verify if is valid date
     * @return string
     */
    public function checkDate ($request) {
        $today = Carbon::now()->format('Y-m-d');
        $date = Carbon::create($request->day);
        
        if($date->format('l') == 'Sunday' || $date->format('l') == 'Saturday')
            return 'Fin de Semana no hay deposito';

        if ($date->format('Y-m-d') == $today) {
            return 'today';
        } else {
            if ($date->lte($today))
                return 'La fecha seleccionada ya quedo en la historia';
        }

        return 'good';
    }

    /**
     * Verify if the date is between datetime
     * @return boolean
     */
    public function checkTime () {
        $time_open = env('TIME_OPEN', '09:00:00');
        $time_close = env('TIME_CLOSE', '18:00:00');
        $now = Carbon::now();
        $control_start = Carbon::parse($time_open);
        $control_end = Carbon::parse($time_close);
        
        // la peticion es mas temprano q la apertura
        if ( $control_start->gt($now) )
            return Carbon::now()->isoFormat("l $time_open");
        
        // la peticion esta dentro del rango de horarios
        if ( $now->gt($control_start) && $now->lt($control_end))
            return Carbon::now();

        // otra opcion no es valida
        return false;
    }

    /**
     * Check if there are any places left
     * @return boolean
     */
    public function checkPlaces($request) {
        // ver cuanto tiempo queda desde el ultimo registro hasta el final del dia
        // luego compararlo con el tiempo de descargas
        $time_close = env('TIME_CLOSE', '18:00:00');
        $last_booking = $this->getLastBooking($request);
        $incoming_minutes = $this->calcTimePallets($request);

        if ($last_booking->isEmpty())
            return true;

        $incoming_time = new DateTime($last_booking[0]->end);
        $incoming_time->modify("+$incoming_minutes minutes");
        $incoming_time = $incoming_time->format('H:i:s');

        $incoming_time = Carbon::now()->isoFormat("l $incoming_time");
        $time_close = Carbon::now()->isoFormat("l $time_close");
        
        if ($incoming_time <= $time_close )
            return true;

        return false;
    }

    /**
     * Calc minutes for pallets
     * @return int minutes 
     */
    public function calcTimePallets ($request) {
        return $request->pallets * env('TIME_PALLETS', 15);
    }

    /**
     * Calc End of Work Booking
     * @return object
     */
    public function calcEndOfWork ($request, $day) {
        $minutes = $this->calcTimePallets($request);
        $date = new DateTime($day);
        return $date->modify("+$minutes minutes");
    }

    /**
     * Get last Booking
     * @return object
     */
    public function getLastBooking ($request) {
        return Booking::where('day', $request->day)->orderby('id','DESC')->take(1)->get();
    }

    public function calcEndOfTimes ($start, $lapse) {
        $date = new DateTime($start);
        return $date->modify("+$lapse minutes");
    }

    /**
     * Store empty space into bookings
     */
    public function storeEmptyTime ($request) {

        $last_booking = $this->getLastBooking($request);
        
        if ($last_booking->isEmpty()) {
            $start = Carbon::now()->format('Y-m-d H:i:s');
        } else {
            $start = $last_booking[0]->end;
        }

        $params['day'] = $request->day;
        $params['time'] = '15';
        $params['start'] = $start;
        $params['end'] = $this->calcEndOfTimes($params['start'], $params['time']);

        Booking::create($params);
    }
}