<?php

namespace App\Http\Controllers;

use App\Models\cnnxn_quotation;
use App\Models\cnnxn_Article;
use App\Models\Contact;
use Illuminate\Http\Request;

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

}
