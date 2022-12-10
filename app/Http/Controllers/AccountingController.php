<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_quotation;
use App\Models\cnnxn_quotation_detail;
use App\Models\cnnxn_Accounting;
use App\Models\cnnxn_expense;

class AccountingController extends Controller
{
    public function index()
    {
        return view('accounting.index');
    }
    public function add_accounting(Request $request)
    {       
        $cost = cnnxn_quotation_detail::where('idQuotation',$request->id)->sum('total_cost');
        $rubber = cnnxn_quotation_detail::where('idQuotation',$request->id)->sum('total_rubber');
        $amount = cnnxn_quotation_detail::where('idQuotation',$request->id)->sum('total');
        $tax = $amount / 100 * 16;
        $total = $amount + $tax;
        $production_cost = $cost + $rubber;

        if ($request->type==1) {
            $add = new cnnxn_Accounting;
            $add->quotation = $request->id;
            $add->amount = $total;
            $add->production_cost = $cost;
            $add->profit = $total - $cost;
            $add->type = 1;
            $add->save();
        }elseif($request->type==2){
            $add = new cnnxn_Accounting;
            $add->quotation = $request->id;
            $add->amount = $total;
            $add->production_cost = $production_cost;
            $add->profit = $total - $production_cost;
            $add->type = 2;
            $add->save();   
        }
        return true;
    }
    public function add_spent(Request $request)
    {
        $query = new cnnxn_expense;
        $query->type = $request->type;
        $query->description = $request->description;
        $query->reference = $request->reference;
        $query->amount = $request->amount;
        $query->save();
        return redirect('accounting');
    }
}
