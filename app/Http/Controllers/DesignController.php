<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AddArt;
use App\Models\cnnxn_customer_order;
use App\Models\cnnxn_customer_order_detail;
use Mail;
use App\Mail\alert;

class DesignController extends Controller
{
    public function index($slug)
    {   
        //buscamos el pedido
        $pedido = cnnxn_customer_order::where('slug', $slug)->get();
        //buscamos los detalles del pedido
        $detalles = cnnxn_customer_order_detail::where('idOrder_customer',$pedido[0]->idOrder)->get();
        // Buscamos las imagenes de cada detalle 

        $data = [
            'pedido'=>$pedido,
            'detalle'=>$detalles        
        ];   
        return view('production.index')->with('data',$data);
    }

    public function img(Request $request)
    {

        

        if ($files = $request->file('image')) {
            
            $file = $files->getClientOriginalName();
            $name = str_replace(' ','_',$file);
            //$files->storeAs('prepress',$name,'public');

            $path = public_path('orders');
            $files->move($path, $name);
            
            
            $insert = new AddArt;

            $insert->url = $name;
            $insert->details = $request->art_notes;
            $insert->idLine = $request->id_line;

            $insert->save();

        }





    }
    public function show($id)
    {
        $query = AddArt::where('idLine',$id)->get();
        return $query;
    }
    public function img_design(Request $request)
    {
        if ($files = $request->file('image')) {
            $file = $files->getClientOriginalName();
            $name = str_replace(' ','_',$file);
            //$files->storeAs('prepress',$name,'public');

            $path = public_path('orders');
            $files->move($path, $name);
            
            
            $insert =cnnxn_customer_order::where('idOrder', $request->id)->update([
                'art_img' => $name
            ]);

            //enviamos un correo

            $mailable = cnnxn_customer_order::where('idOrder',$request->id)->get();
            $file = public_path('/orders/'.$mailable[0]->art_img);
            
            $data['id']=$mailable[0]->idOrder;
            $data['file']=$file;

            Mail::to('ventas@sellopronto.com.mx')->send(new alert($data));

        } 
    }
}
