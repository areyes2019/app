<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_Stock;
class StockController extends Controller
{
    public function index()
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $month = $meses[date('n')-1];
        $year = date('Y');
        return view('stock.index')
            ->with('month',$month)
            ->with('year',$year);
    }
    public function select_stock()
    {
        $query = cnnxn_Article::all();
        return $query;
    }
    public function search_stock(Request $request)
    {
        if ($request->data== null) {
            return 0;
        }else{
            $data  = cnnxn_Article::where('re_order','>',0)->where('name','like',"%{$request->data}%")->take(10)->get();
            return $data;
        }
    }
    public function update_stock(Request $request)
    {
        

        $find = cnnxn_Stock::where('article',$request->article)->count();
        
        if ($find == 0) {
            //buscamos el articulo
            $article = cnnxn_Article::where('idArticle',$request->article)->get();
            $total = $article[0]->cost * $request->qty;
            $insert = new cnnxn_Stock;
            $insert->quantity = $request->qty;
            $insert->article = $request->article;
            $insert->cost = $article[0]->cost;
            $insert->total = $total;
            $insert->total_value = $article[0]->price * $request->qty;
            $insert->save();
        }else{

            $article = cnnxn_Stock::where('article',$request->article)->increment('quantity', $request->qty);
            $new_sum = cnnxn_Stock::where('article',$request->article)->get();
            $new_data = cnnxn_Article::where('idArticle',$request->article)->get();
            
            //hacer la sumas
            $new_number = $new_sum[0]->cost * $new_sum[0]->quantity;
            $new_price  = $new_data[0]->price * $new_sum[0]->quantity;


            $query = cnnxn_Stock::where('article',$request->article)->update([
                    'total'=>$new_number,
                    'total_value'=>$new_price,
            ]);
        }
    }
    public function take(Request $request)
    {

        $id = $request->id;
        $number = $request->take;
        $query = cnnxn_Stock::where('idStock',$id)->get();

        //esta es la cantidad original
        $quantity = $query[0]->quantity;
        //aqui hacemos la suma
        $new_rest = $quantity - $number;

        //hacemos el update
        $less = cnnxn_Stock::where('idStock',$id)->decrement('quantity',$number);

        //sacamos el articulo
        $article = cnnxn_Article::where('idArticle',$query[0]->article)->get();

        $new_total = $query[0]->cost * $new_rest;
        $new_total_value = $article[0]->price * $new_rest;
        
        

        //actualizamos los demas campos
        $update = cnnxn_Stock::where('idStock',$id)->update([
            'total'=>$new_total,
            'total_value'=>$new_total_value,
        ]);


    }
    public function take_up(Request $request)
    {
        $id = $request->id;
        $number = $request->take;
        $query = cnnxn_Stock::where('idStock',$id)->get();

        //esta es la cantidad original
        $quantity = $query[0]->quantity;
        //aqui hacemos la suma
        $new_rest = $quantity - $number;

        //hacemos el update
        $less = cnnxn_Stock::where('idStock',$id)->increment('quantity',$number);

        //sacamos el articulo
        $article = cnnxn_Article::where('idArticle',$query[0]->article)->get();

        $new_total = $query[0]->cost * $new_rest;
        $new_total_value = $article[0]->price * $new_rest;
        
        

        //actualizamos los demas campos
        $update = cnnxn_Stock::where('idStock',$id)->update([
            'total'=>$new_total,
            'total_value'=>$new_total_value,
        ]);
    }
    public function show_stock()
    {
        //cosulta total para la tabla
        $query = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->get();

        //consulta de valor total
        $total_value = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->sum('total_value');

        //consulta del inversion
        $investment = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->sum('total');

        //profit

        $profit = $total_value - $investment;
        
        //Enviamos los datos
        $data =[
            'table'=> $query,
            'total_value'=>number_format($total_value,2),
            'profit'=>number_format($profit,2),
            'investment'=>number_format($investment,2),
        ];

        return $data;
    }
    public function delete_stock_line(Request $request)
    {
        $query = cnnxn_Stock::where('idStock',$request->stock)->delete();
    }
    
}
