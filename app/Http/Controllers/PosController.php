<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Stock;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_customer_order;
use App\Models\cnnxn_customer_order_detail;
use App\Models\cnnxn_production;
use App\Models\users;
//use Illuminate\Support\Facades\Mail;
use Mail;
use App\Mail\general;


class PosController extends Controller
{
    public function index()
    {
        return view('pos.index');
    }
    public function sale($slug)
    {
       $query = cnnxn_customer_order::where('slug',$slug)->get();
       $id = $query[0]->idOrder;
       return view('pos.sale')->with(['slug'=>$slug,'id'=>$id]);
    }
    public function show()
    {
        $query = cnnxn_Article::where('re_order','>',0)->get();
        return $query;
    }
    public function add_sale(Request $request)
    {
        //crear los datos temporales

        $query = new cnnxn_customer_order;
        $query->slug = $request->slug;
        $query->name = $request->name;
        $query->mobile = $request->mobile;
        $query->delivery_cost = 0;
        $query->amount = 0;
        $query->advance_payment = 0;
        $query->total = 0;
        $query->save();
    }
    public function add_slug(Request $request)
    {
        $query = new cnnxn_customer_order;

        $query->slug = $request->slug;
        $query->name = "general";
        $query->save();
    }
    
    public function order_data($id)
    {
        $query = cnnxn_customer_order::where('slug',$id)->get();
        return $query;
    }
    public function update(Request $request, $id,$slug)
    {
        if ($id == 1) {
            $query = cnnxn_customer_order::where('slug',$slug)->update([
                'name'=>$request->name,
                'mobile'=>$request->mobile,
            ]);
        }elseif($id==2){

            //revisamos si el articulos que viene ya esta dentro del pedido

            $has_item = cnnxn_customer_order_detail::where('idOrder_customer',$slug)->where('article',$request->article)->count();
            $article = cnnxn_Article::where('idArticle',$request->article)->get();

            if ($has_item > 0) {

                $find_item = cnnxn_customer_order_detail::where('article',$request->article)
                                ->where('idOrder_customer', $slug)
                                ->update([
                    'quantity'=> $request->qty,
                    'total'=>$article[0]->price * $request->qty
                ]);
            }else{
                $query = new cnnxn_customer_order_detail;
                $query->quantity = $request->qty;
                $query->article = $request->article;
                $query->idOrder_customer = $request->id;
                $query->name = $article[0]->name;
                $query->unit = $article[0]->price;
                $query->total = $article[0]->price * $request->qty;
                $query->color = 'default';
                $query->save();

            }

            //aki sacamos los totales
            $query_sum = cnnxn_customer_order_detail::where('idOrder_customer',$slug)->sum('total');

            $advance = $query_sum / 2;
            $total = $query_sum-$advance;  
            
            //aki actualizamos los totales
            $order_data = cnnxn_customer_order::where('idOrder',$slug)->update([
                'amount'=> $query_sum,
                'advance_payment'=>$advance,
                'total' => $total
            ]);
            

            
           
        }



    }
    public function show_details($id)
    {
        $query = cnnxn_customer_order_detail::where('idOrder_customer',$id)->get();
        return $query;
    }
    public function delete_line($id, $slug)
    {
        $query = cnnxn_customer_order_detail::where('idDetail_order',$id)->delete();

        $query_count = cnnxn_customer_order_detail::where('idOrder_customer',$slug)->get()->count();
        if ($query_count == 0) {
            $order_data = cnnxn_customer_order::where('idOrder',$slug)->update([
                'amount'=> 0,
                'advance_payment'=>0,
                'total' => 0
            ]);
        }else{

            //actualizar los totales

            //este es el nuevo total 
            $update_totals = cnnxn_customer_order_detail::where('idOrder_customer',$slug)->sum('total');

            //sacamos el anticipo
            $advance = $update_totals / 2;

            //nuevo total
            $total = $update_totals - $advance;


            //aki actualizamos los totales
            $order_data = cnnxn_customer_order::where('idOrder',$slug)->update([
                'amount'=> $update_totals,
                'advance_payment'=>$advance,
                'total' => $total
            ]);
        }



    }
    public function img(Request $request)
    {


        //obtenemos la imagen 
        /*$request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);*/

        //guardar los datos de elaboración
        $query = cnnxn_customer_order_detail::where('idDetail_order',$request->id_line)->get();
        $query_article = cnnxn_Article::where('idArticle',$query[0]->article)->get();


        if ($request->rubber == true) {
            $rubber = $query_article[0]->rubber;
        }else{
            $rubber = 0;
        }

        if ($request->draw == true) {
            $draw = $query_article[0]->design;
        }else{
            $draw = 0;
        }

        if ($files = $request->file('image')) {
            
            $name = $files->getClientOriginalName();
            $files->storeAs('public/prepress',$name);

            $insert = cnnxn_customer_order_detail::where('idDetail_order',$request->id_line)->update([
                'color'=> $name,
                'notes'=> $request->art_notes,
                'draw'=> $draw,
                'rubber'=> $rubber,

            ]);


            if ($insert) {
                return true;
            }
        }

    }
    public function add_advance(Request $request)
    {
        $query = cnnxn_customer_order::where('idOrder', $request->id)->update([
            'advance_payment'=>$request->payment
        ]);

        $query_sum = cnnxn_customer_order::where('idOrder',$request->id)->get();
        $amount = $query_sum[0]->amount;
        $rest = $amount - $request->payment;
        $query_update = cnnxn_customer_order::where('idOrder',$request->id)->update([
            'total'=> $rest    
        ]);        
    }

    public function shipping(Request $request)
    {
        $query = cnnxn_customer_order::where('idOrder',$request->id)->update([
            'delivery_type'=>$request->type,
            'delivery_cost'=>$request->cost
        ]);
    }
    public function shipping_type(Request $request)
    {
        $query = cnnxn_customer_order::where('idOrder',$request->id)->update([
            'delivery_type'=>1,
            'delivery_cost'=>0
        ]);
    }
    public function add_address(Request $request)
    {
        //return $request;

        $query = cnnxn_customer_order::where('idOrder',$request->id)->update([
            'street'=>$request->street,
            'zone'=>$request->zone, 
            'receiber'=>$request->receiber,
            'details'=>$request->dir,
            'delivery_day'=>$request->date,
            'delivery_time'=>$request->time,
        ]);
        //return $query;
    }
    public function send(Request $request)
    {
        $query_order = cnnxn_customer_order::where('idOrder',$request->id)->get();
        $query_lines = cnnxn_customer_order_detail::where('idOrder_customer',$request->id)->get();
        $query_article = cnnxn_Article::where("idArticle",$query_lines[0]->article)->get();

        $draw = $query_lines[0]->draw;
        $rubber = $query_lines[0]->rubber;

        $data =[
            'rubber'=>$rubber,
            'draw'=>$draw
        ];

        
        if ($rubber > 0 && $draw > 0) {
            $text = "Goma y Diseño";
        }elseif($rubber > 0 && $draw == 0){
            $text = "Solo goma";
        }elseif($rubber == 0 && $draw > 0){
            $text = "Solo Diseño";
        }

        if ($query_order[0]->street == null) {
            $delivery = "Ocurre";
        }else{
            $delivery = $query_order[0]->street."No ".$query_order[0]->number." Col ".$query_order[0]->zone.", ".$query_order[0]->details;
        }
        //Aqui generamos la orden

        $order = new cnnxn_production;
        $order->idOrder = $query_order[0]->idOrder;
        $order->status = 1;
        $order->slug = 0;
        $order->save();

        $order_find = cnnxn_production::where('idOrder',$request->id)->get();

        $file = storage_path('app/public/prepress/'.$query_lines[0]->color);

        //aqui envaimos
        $data["email"] = "test@gmail.com";
        $data["order"] = $order_find[0]->idJob;
        $data["body"]  = "This is test mail with pdf attachment";
        $data["file"]  = $file;
        $data["type"] = $text; 
        $data["description"] = $query_lines[0]->name; 
        $data["model"] = $query_article[0]->model; 
        $data["notes"] = $query_lines[0]->notes; 
        $data["delivery"] = $delivery; 
        
        Mail::to('reyesabdias@gmail.com')->send(new general($data));
        


    }


}
