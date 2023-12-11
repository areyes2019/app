<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AddArt;
use App\Models\cnnxn_customer_order;
use App\Models\cnnxn_customer_order_detail;

class DesignController extends Controller
{
    public function index($slug)
    {   
        //buscamos el pedido
        $pedido = cnnxn_customer_order::where('slug', $slug)->get();
        //buscamos los detalles del pedido
        $detalles = cnnxn_customer_order_detail::where('idOrder_customer',$pedido[0]->idOrder)->get();
        // Buscamos las imagenes de cada detalle

        return $detalles;

        /*foreach ($detalles as $img) {
            return $img = AddArt::where('idLine', $img->url)->get();   
        }*/

        //return view('production.index');
    }

    public function img(Request $request)
    {

        

        if ($files = $request->file('image')) {
            
            $name = $files->getClientOriginalName();
            //$files->storeAs('prepress',$name,'public');

            $path = public_path('designs');
            $files->move($path, $name);
            
            
            $insert = new AddArt;

            $insert->url = $name;
            $insert->details = $request->art_notes;
            $insert->idLine = $request->id_line;

            $insert->save();

            //agregamos el 1 al campo diseño de la tabla cnnxn_customer_order

            $insert_id = cnnxn_customer_order::where('slug', $request->slug)->update([
                'art_img'=> 1,
            ]);
        }





    }
    public function show($id)
    {
        $query = AddArt::where('idLine',$id)->get();
        return $query;
    }
}
