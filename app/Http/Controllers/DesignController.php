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

        $query = cnnxn_customer_order::where('slug',$request->slug)->get();

        if ($files = $request->file('image')) {
            
            $file = $files->getClientOriginalName();
            $name = str_replace(' ','_',$file);
            //$files->storeAs('prepress',$name,'public');

            $path = public_path('designs');
            $files->move($path, $name);
            
            
            $insert = new AddArt;

            $insert->url = $name;
            $insert->details = $request->art_notes;
            $insert->idLine = $request->id_line;
            $insert->idOrder = $query[0]->idOrder;

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
    public function delete_img_line($id)
    {
        //primero sacamos el archivo y lo eliminarmos
        $query = AddArt::where('id',$id)->get();
        $file = public_path('designs/'.$query[0]->url);
        
        if (file_exists($file)) {
            unlink($file);
            //luego eliminamos toda la linea
            $delete = AddArt::where('id',$id)->delete();
        }else{
            $delete = AddArt::where('id',$id)->delete();
        }

    }

    public function has_draw($slug)
    {
        $query = cnnxn_customer_order::where('slug', $slug)->get();
        $has_draw = AddArt::where('idOrder',$query[0]->idOrder)->count('url');
        return $has_draw;
    }
}
