<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SaleService $service)
    {
        $sucursals = auth()->user()->sucursals;
        
        $sucursals_ids = $sucursals->pluck('id');

        $sales = DB::table('sales')
                    ->join('sales_sucursals', 'sales.id', '=', 'sales_sucursals.sale_id' )
                    ->whereIn('sales_sucursals.sucursal_id', $sucursals_ids )
                    ->select('sales.*')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $salesToday = $service->calcDailySales($sales);
        
        return view('home', [
            'sucursals' => $sucursals,
            'salesToday' => $salesToday
        ]);
    }
}
