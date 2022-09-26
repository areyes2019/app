<?php

namespace App\Http\Controllers;

use App\Models\cnnxn_quotation;
use App\Models\cnnxn_Article;
use App\Models\Contact;
use App\Models\cnnxn_quotation_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
class QuotationController extends Controller
{
  public function index()
  {
  	return view('quotations.index');
  }
  public function show()
  {
    $posts = cnnxn_quotation::join('cnnxn_contacts', 'cnnxn_contacts.idContact', '=', 'cnnxn_quotations.idCustomer')->get();
    return $posts;
  } 
  public function store(Request $request)
   {
     $query = cnnxn_quotation::create($request->All());
     if ($query) {
       return true;
     }
   }
   
    public function page($id){
       
        //aqui enviamos los datos de la cotizacion
        $query = cnnxn_quotation::where('slug',$id)->get();
        foreach ($query as $data) {
            $id = $data->idQt;
            $slug = $data->slug;
            $customer = $data->idCustomer;
        }
            return view('quotations.page')
                    ->with('id', $id)
                    ->with('slug',$slug)
                    ->with('customer',$customer);

    }

    public function show_articles()
    {
        $query = cnnxn_Article::all();
        return $query;
       
    }

    public function show_quotation($id)
    {
        $query = cnnxn_quotation::where('slug',$id)->get();
        return $query;
    }
    public function show_customer($id)
    {
      $query = Contact::where('type',1)->where('idContact',$id)->get();
      return $query;
    }
    public function change_status(Request $request, $id)
    {
       $query = cnnxn_quotation::where('slug',$id)->update([
          'status'=>$request->status
       ]);
       if ($query) {
         return true;
       }
    }
    public function add_line(Request $request)
    {
      
        //primero vemos si ya esta agregado
        $unique = cnnxn_quotation_detail::where('article',$request->article)
          ->where('idQuotation',$request->id)
          ->count();
        if ($unique > 0) {
          return 1;
        }else{
          $query = cnnxn_Article::where('idArticle',$request->article)->get();
          $price = $query[0]->price;
          $add = new cnnxn_quotation_detail;
          $add->quantity = $request->quantity;
          $add->article = $request->article;
          $add->unit_price = $price;
          $add->total = $price * $request->quantity;
          $add->idQuotation = $request->id;
          $add->save();

          $query_sum = cnnxn_quotation_detail::where('idQuotation',$request->id)->sum('total'); //sacamos el valor parcial
          
          $tax_value = $query_sum /1.16; //sacamos el precio sin iva;
          $tax = $query_sum-$tax_value;
          
          $gran_total = $tax_value + $tax; // sumamos todo
          //agregamos el iva
          cnnxn_quotation::where('idQt',$request->id)->update([
              'tax'=>$tax,
              'total'=>$gran_total
          ]);
        }
     


    }
    public function show_lines($id)
    {
        $data = cnnxn_quotation_detail::where('idQuotation',$id)->join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_quotation_details.article')->get();

        return $data;
    }

    public function show_totals($id)
    {
      $sub_total = cnnxn_quotation_detail::where('idQuotation',$id)->sum('total');
      $summary = cnnxn_quotation::where('idQt',$id)->get();

      $data = [
        'sub_total'=>$sub_total,
        'summary'=>$summary
      ];

      return $data;
    }
    public function add_quantity(Request $request, $line)
    {
      $id_qt = $request->id; //obtemos el id de la cotizacion
      
      $unit_price_query = cnnxn_quotation_detail::where('id',$line)->get();
      
      $unit_price = $unit_price_query[0]->unit_price;
      $new_price = $unit_price * $request ->quantity;
      $new_price;

      $query = cnnxn_quotation_detail::where('id',$line)->update([
        'quantity'=>$request->quantity,
        'total'=>$new_price
      ]);

      //sacamos el total de la cotizacion nuevamente

      $total = cnnxn_quotation_detail::where('idQuotation',$id_qt)->sum('total');
      $tax = $total /100 * 16; //sacamos el iva
      $grand_total = $total + $tax;

      $update_total = cnnxn_quotation::where('idQt',$id_qt)->update([
        'tax' => $tax,
        'total' => $grand_total,
      ]);


    }
    public function delete_line(Request $request,$id)
    {
      $query = cnnxn_quotation_detail::where('id',$id)->delete();

      $id_qt = $request->id_qt; //obtemos el id de la cotizacion
      
      //sacamos el total de la cotizacion nuevamente

      $total = cnnxn_quotation_detail::where('idQuotation',$id_qt)->sum('total');
      $tax = $total /100 * 16; //sacamos el iva
      $grand_total = $total + $tax;

      $update_total = cnnxn_quotation::where('idQt',$id_qt)->update([
        'tax' => $tax,
        'total' => $grand_total,
      ]);


    }
    public function tax_free(Request $request)
    {
      
      $id = $request->id;
      $tax = $request->tax;
      $query = cnnxn_quotation::where('idQt',$id)->update([
        'with_tax'=> $request->tax,
      ]);

      if ($tax == 0) {
        $query_price = cnnxn_quotation_detail::where('idQuotation',$id)->get();
        foreach ($query_price as $key) {
            $price = cnnxn_Article::where('idArticle',$key->article)->get();
            $number = cnnxn_Article::where('idArticle',$key->article)->count();
            
            foreach ($price as $key_price) {
              for ($i=0; $i <$number ; $i++) { 
                cnnxn_quotation_detail::where('id',$id[$i])->update([
                  'unit_price'=> $key_price->price[$i]
                ]);
              }
            }
        }
      }else{
        
      }

            

    }
    public function add_discount(Request $request)
    {
      if ($request->type == 1) {
        $query = cnnxn_quotation::where('slug',$request->slug)->update([
            'money_discount'=> $request->discount
        ]);
      }elseif($request->type==2){
        $query = cnnxn_quotation::where('slug',$request->slug)->update([
            'percent_discount'=> $request->discount
        ]);
      }

      if ($query) {
        return true;
      }
    }
    public function get_pdf($id, $id_qt,$try)
    {
        //este es el cliente
        $customer =  $id;
        //estos son los datos de la cotización
        $quotation = $id_qt;

        //aqui obtenemos todos los datos del cliente
        $customer_query     = Contact::where('idContact',$customer)->get();
        
        //aqui todos los datos de la cotización
        $quotation_query    = cnnxn_quotation::where('idQt', $quotation)->get();          
        //aqui los detalles de la cotización
        $detail_query = cnnxn_quotation_detail::where('idQuotation',$quotation)
                        ->join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_quotation_details.article')
                        ->get();
        
        
        //este es el gran total
        $quotation_total = cnnxn_quotation_detail::where('idQuotation', $quotation)->sum('total');
        //este es el descuento en dinero
        $money = $quotation_query[0]->money_discount;
        $discount = number_format($money,2); 
        //este es el descuento en porcenteje
        $percent  = $quotation_query[0]->percent_discount;

        if ($quotation_query[0]->with_tax == 1) {
          //monto sin iva
          $among_tax = $quotation_total / 1.16;
          $amount = number_format($among_tax,2);
          
          //porcentaje pasado a dinero
          $percent_to = $among_tax /100 * $percent;
          $percent_to_money = number_format($percent_to,2);
          
          //suma de descuentos 
          $discount_sum = $money + $percent_to;
          //aplicados a la sub-total
          $discount_result = $among_tax - $discount_sum;

          //aplicamos el iva 
          $tax_value = $discount_result / 100*16;
          $tax = number_format($tax_value,2); //este es el iva que vamos a mostrar
          $total = number_format($discount_result+$tax_value,2);
        }elseif($quotation_query[0]->with_tax==0){
          //monto total
          $amount = number_format($quotation_total,2);
          
          //porcentaje pasado a dinero
          $percent_to = $quotation_total /100 * $percent;
          $percent_to_money = number_format($percent_to,2);
          
          //suma de descuentos 
          $discount_sum = $money + $percent_to;
          //aplicados a la sub-total
          $discount_result = $quotation_total - $discount_sum;

          //aplicamos el iva 
          $tax_value = 0;
          $tax = number_format($tax_value,2); //este es el iva que vamos a mostrar
          $total = number_format($discount_result+$tax_value,2);
        }
        
        $data = [

            'sub_total'     =>$amount, //aparece en el resumen
            'discount'      =>$discount, //descuento en dinero
            'percent'       =>$percent, //cantidad en porcentaje
            'money'         =>$percent_to_money,  //porcentaja padado a dinero
            'tax'           =>$tax,  //impustesto
            'total'         =>$total, // gran total
        ];
        
        $mega_pack=[
            'quotation' => $quotation_query,
            'customer'  => $customer_query,
            'detail'    => $detail_query,
            'totals'    => $data
        ];
        
        $file_name = str_replace(' ','_',$customer_query[0]->company_name);
        $pdf = PDF::loadView('quotations.pdf',$mega_pack);
        if ($try == "down") {
            return $pdf->download('QT-'.$id_qt.'-'.$file_name.'.pdf');
        }elseif ($try = "send") {
            $file=$pdf->output();
            $file_id = 'QT-'.$id_qt.'-'.$file_name.'.pdf';
            $mailable = new SendQuotation($file, $file_id);
            Mail::to($customer_query[0]->email)->send($mailable);
        }
        
    }

}
