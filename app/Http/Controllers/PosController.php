<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Stock;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_customer_order;
use App\Models\cnnxn_customer_order_detail;
use App\Models\cnnxn_production;
use App\Models\AddArt;
use App\Models\Contact;
use App\Models\User;
//use Illuminate\Support\Facades\Mail;
use Mail;
use PDF;
use App\Mail\general;
use App\Mail\todesign;


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
        

        //Encontramos el articulo
        $article = cnnxn_Article::where('idArticle', $request->article)->get();
        //Emcontramos el numero de cotizacion
        $quotation = cnnxn_customer_order::where('slug',$request->idQt)->get();
        $id = $quotation[0]->idOrder;
        
        //verificamos que no este duplicado

        $unique = cnnxn_customer_order_detail::where('idOrder_customer', $id)->where('article',$article[0]->idArticle)->count();

        if ($unique == 0) {
            
            //Agregamos los datos a la linea
            $insert = new cnnxn_customer_order_detail;
            $insert->quantity = $request->quantity;
            $insert->article = $request->article;
            $insert->model = $article[0]->model;
            $insert->name = $article[0]->name;
            $insert->draw = $article[0]->design;
            $insert->rubber = $article[0]->rubber;
            $insert->unit = $article[0]->price;
            $insert->total = $article[0]->price;
            $insert->idOrder_customer = $quotation[0]->idOrder;
            $insert->save();
            if ($insert) {
                return 0;
            }
        }else{
            return 1;
        }
    }
    public function add_single(Request $request)
    {
        $slug = cnnxn_customer_order::where('slug',$request->id)->get();

        $query = new cnnxn_customer_order_detail;
        
        $sum = $request->unit * $request->quantity;

        $query->quantity = $request->quantity;
        $query->name = $request->name;
        $query->unit = $request->unit;
        $query->total = $sum;
        $query->article = 0;
        $query->model = "General";
        $query->color = 0;
        $query->idOrder_customer = $slug[0]->idOrder;
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
    public function update_name(Request $request, $id)
    {
        //buscar al cliente
        $query = Contact::where('idContact',$request->id)->get();
        $name = $query[0]->name;
        $mobile = $query[0]->mobile;
        //actualizar la orden

        $order = cnnxn_customer_order::where('slug',$id)->update([
            'name'=>$name,
            'mobile'=>$mobile,
            'idCustomer'=>$query[0]->idContact
        ]);

    }
    public function show_details($id)
    {
        $search = cnnxn_customer_order::where('slug',$id)->get();
        $ide = $search[0]->idOrder;
        $query = cnnxn_customer_order_detail::where('idOrder_customer',$ide)->get();
        return $query;
    }
    public function delete_line(Request $request)
    {
       
        $delete = cnnxn_customer_order_detail::where('idDetail_order',$request->id_line)->delete();

        $slug = cnnxn_customer_order::where('slug',$request->id_qt)->get();        
        
        $total = cnnxn_customer_order_detail::where('idOrder_customer',$slug[0]->idOrder)->sum('total');

        $has_tax = $total / 1.16;
        $tax = $total - $has_tax; 
        $with_tax = $total + $tax;
        $advance = $total / 2;
        $update_total = cnnxn_customer_order::where('slug',$request->id_qt)->update([
            'amount'=> $has_tax,
            'tax'=> $tax,
            'advance_payment'=> $advance,
            'total'=> $total
        ]);



    }
    public function add_qty(Request $request)
    {
        //tenemos que encontrar el articulo
        $article = cnnxn_customer_order_detail::where('idDetail_order',$request->id)->get();
        
        $total = $article[0]->unit * $request->qty;

        $query = cnnxn_customer_order_detail::where('idDetail_order',$request->id)->update([
            'quantity'=>$request->qty,
            'total'=>$total
        ]);

        //actualizamos el total de la tabla general
        $has_tax = $total / 1.16;
        $tax = $total - $has_tax; 
        $with_tax = $total + $tax;
        $update_total = cnnxn_customer_order::where('slug',$request->slug)->update([
            'amount'=> $has_tax,
            'tax'=> $tax,
            'total'=> $total
        ]);


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

        $file = asset('storage/prepress/'.$query_lines[0]->color);

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
        
        Mail::to('emilianosej@gmail.com')->send(new general($data));
        


    }
    public function sale_list()
    {
       $query = cnnxn_customer_order::paginate(5);
       return response()->json($query);
    }
    public function ticket()
    {
        return view('pos.ticket');
    }
    public function totals($id)
    {
        $query = cnnxn_customer_order_detail::where('idOrder_customer',$id)->sum('total');
        $query_main = cnnxn_customer_order::where('idOrder',$id)->get();

        $envio = $query_main[0]->delivery_cost;

        $sin_iva = $query /1.16; //$94.00
        //$format = number_format($sin_iva,2);
        $iva = $query - $sin_iva; // $16.00
        $total = $sin_iva + $iva; //$100.00
        $anticipo = $query_main[0]->advance_payment;
        $saldo = $total - $anticipo;
        $saldo_total = $saldo + $envio;

        $total_sin_iva = $query-$anticipo;
        $gran_total_no_iva = $total_sin_iva + $envio;

        if ($query_main[0]->tax_type == 1) {
            
            $insert = cnnxn_customer_order::where('idOrder',$id)->update([
                'amount'=> $sin_iva,
                'tax'=> $iva,
                'total_sum'=> $total,
                'total'=>$saldo,
                'grand_total'=>$saldo_total,
            ]);

        }else{
            $insert = cnnxn_customer_order::where('idOrder',$id)->update([
                'amount'=> $query,
                'tax'=> 0,
                'total_sum'=> $query,
                'total'=>$total_sin_iva,
                'grand_total'=>$gran_total_no_iva,
            ]);             
        }
        
        $new_data = cnnxn_customer_order::where('idOrder',$id)->get();
        return $new_data;
    }
    public function change_tax(Request $request)
    {
        
        $query = cnnxn_customer_order::where('slug',$request->id)->update([
            'tax_type'=> $request->value,
        ]);
    }
    public function save_customer_pos(Request $request)
    {
        //agregar el nombre a la tabla clientes
        $insert = new Contact;
        $insert->type = 1;
        $insert->name = $request->name;
        $insert->mobile = $request->mobile;
        $insert->save();

        //sacamose el dato
        $customer = Contact::where('name',$request->name)->get();
        //guardar el nombre en la orden
        $add = cnnxn_customer_order::where('slug',$request->id)->update([
            'idCustomer'=>$customer[0]->idContact,
            'name'=> $request->name,
            'mobile'=> $request->mobile
        ]);


    }
    public function add_pay_pos(Request $request)
    {
        $pay = cnnxn_customer_order::where('slug',$request->id)->get();
        $advance = $pay[0]->advance_payment;
        if ($advance > 0) {
            return 1;
        }else{
            $query = cnnxn_customer_order::where('slug',$request->id)->update([
                'advance_payment'=>$request->pay
            ]);   

        }
        

    }
    public function total_pos(Request $request)
    {
        $query = cnnxn_customer_order::where('slug',$request->id)->get();
        $total = $query[0]->advance_payment + $request->pay;
        $insert = cnnxn_customer_order::where('slug', $request->id)->update([
            'advance_payment'=>$total
        ]);
    }
    public function shipping_data(Request $request)
    {
        $insert = cnnxn_customer_order::where('slug',$request->id)->update([
            'street'=>$request->street,
            'zone'=>$request->zone,
            'receiber'=>$request->recipients,
            'delivery_time'=>$request->hour,
            'delivery_day'=>$request->date,
            'details'=>$request->city,
        ]);
    }
    public function get_sales($id)
    {
        
        $one = 1;
        $two = 2;
        $three = 3;
        $four = 4;
        switch ($id) {
            case 1:
                $query = cnnxn_customer_order::where('status',1)->get();
                return $query;
                break;
            case 2:
                $query = cnnxn_customer_order::where('status',2)->get();
                return $query;
                break;
            case 3:
                $query = cnnxn_customer_order::where('status',3)->get();
                return $query;
                break;
            case 4:
                $query = cnnxn_customer_order::where('status',4)->get();
                return $query;
                break;
        }
    }
    public function show_user()
    {
        $query = User::all();
        return $query;
    }
    //este envia a diseño
    public function send_to_design(Request $request)
    {
        //actualizamos los datos
        $query = cnnxn_customer_order::where('slug',$request->id)->update([
            'art_by'=>$request->user,
            'instructions'=>$request->instructions,
            'status'=>2,
            'art_img'=>2

        ]);

        //obtenemos el usuario
        $user_query = cnnxn_customer_order::where('slug',$request->id)->get();
        $user = User::where('id',$user_query[0]->art_by)->get();
        
        
        //obtenemos los datos del pedido
        $order = cnnxn_customer_order::where('slug',$request->id)->get();
        //obtenemos los detalles del pedido
    
        $detail = cnnxn_customer_order_detail::where('idOrder_customer',$order[0]->idOrder)->join('cnnxn_articles', 'cnnxn_customer_order_details.article', '=', 'cnnxn_articles.idArticle')->get();
       
        $files = cnnxn_customer_order_detail::where('idOrder_customer',$order[0]->idOrder)->get('color');
        
        $project_cost = cnnxn_customer_order_detail::where('idOrder_customer',$order[0]->idOrder)->join('cnnxn_customer_orders','cnnxn_customer_order_details.idOrder_customer','=','cnnxn_customer_orders.idOrder')->where('art_by',$user[0]->id)->sum('draw');

        $mega_pack = [
            'id'=>$order[0]->idOrder,
            'date'=>$order[0]->created_at,
            'user'=> $user,
            'cost' => $project_cost,
            'datos'=> $detail,
        ];

        $pdf = PDF::loadView('orders.pdf',$mega_pack);
        $file=$pdf->output();

        
        //aqui envaimos
        $data["id_order"] = $order[0]->idOrder;
        $data["file"]  = $file;        
        $data["slug"]  = $order[0]->slug;        
        
        Mail::to($user[0]->email,$user[0]->name)->send(new general($data));

        /*$url = "/storage/prepress/".$mail->color;
        
        $file = storage_path('app/public/prepress/'.$query_lines[0]->color);
        $mail = new todesign($master,$url);
        Mail::to($user[0]->email)->send($mail);*/


    }

    //este envia a produccion
    public function add_img_shop(Request $request)
    {
        
        $files = $request->file('image');        
        $name = $files->getClientOriginalName();
        //$files->storeAs('public/prepress',$name);

        $path = public_path('public\img\designs');
        $files->move($path, $name);
        
        $insert = cnnxn_customer_order::where('slug',$request->slug)->update([
            'art_img'=> $name,
            'instructions'=> $request->order_notes,
            'status'=> 3,
            'rubber_by'=>$request->user

        ]);

        //sacamos al usuario
        $user = User::where('id',$request->user)->get();
        $idOrder = cnnxn_customer_order::where('slug',$request->slug)->get();
        $data['file']=$files;
        $data['id']=$idOrder[0]->idOrder;
        $data['email']=$user[0]->email;
        $data['name']=$name;
        $data['instructions']=$request->order_notes;
        $data['title']="Solicitud de elaboracion #".$idOrder[0]->idOrder;
        
        Mail::to($user[0]->email,$user[0]->name)->send(new todesign($data));

        
        

        //enviar al corre



    }
    public function orders_delete($slug)
    {
        //primero encontramos todas la lineas que son de esta cotización
        $order = cnnxn_customer_order::where('slug',$slug)->get();
        $lines = cnnxn_customer_order_detail::where('idOrder_customer',$order[0]->idOrder)->delete();
        $delte = cnnxn_customer_order::where('slug',$slug)->delete();

    }
   
    


}
