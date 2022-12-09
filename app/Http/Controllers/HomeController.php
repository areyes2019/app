<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Accounting;
use App\Models\cnnxn_quotation_detail;

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
    public function index()
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $fecha = $meses[date('n')-1];

        $month = date("m");
        $year = date('Y');
        $total = cnnxn_Accounting::whereMonth('created_at',$month)->sum('amount');
        $profit = cnnxn_Accounting::whereMonth('created_at',$month)->sum('profit');
        $quantity = cnnxn_quotation_detail::whereMonth('created_at',$month)->sum('quantity');
        return view('home')
            ->with('sales',$total)
            ->with('profit',$profit)
            ->with('sold',$quantity)
            ->with('mes',$fecha)
            ->with('year',$year);
    }
}
