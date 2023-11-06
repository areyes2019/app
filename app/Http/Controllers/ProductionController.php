<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_customer_order;
use App\Models\cnnxn_customer_order_detail;
use App\Models\cnnxn_production;

class ProductionController extends Controller
{
    public function page($id)
    {
        $query = 
    }

    public function add(Request $request)
    {
        $query = cnnxn_production::where('slug',$request->slug)->update([
            'idOrder'=>$request->id_order,
            'status'=>$request->status,
        ]);
    }
    public function order($id)
    {
        $query = cnnxn_customer_order::where('idOrder',$id)->get();
        $details = cnnxn_customer_order_detail::where('idOrder_customer',$id)->get();
        $id_order = cnnxn_production::where('idOrder',$id)->get();
        $data=[
            'general' => $query,
            'details' => $details,
            'id'=>$id_order
        ];

        return $data;
    }
}
