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

            //sacamos todos los costos
            $total = $article[0]->cost;
            $insert = new cnnxn_Stock;
            //insertamos la cantidad
            $insert->quantity = $request->qty;
            //insertamos el articulo
            $insert->article = $request->article;
            //insertamos el total
            $insert->total_cost = $total * $request->qty;
            //aqui cambiamos los valores
            $insert->total_price = $article[0]->price;
            $insert->profit = $article[0]->price - $total;
            $insert->save();
        }else{

            $query = cnnxn_Article::where('idArticle',$request->article)->get();

            $total = $query[0]->cost;
            $tota_cost = $total * $request->qty;

            $total_price = $query[0]->price * $request->qty;

            //incrementamos la cantidad
            $article = cnnxn_Stock::where('article',$request->article)->increment('quantity', $request->qty);
            
            //incrementamos el costo total
            $cost = cnnxn_Stock::where('article',$request->article)->increment('total_cost',$total_cost);
            
            //incrementamos el precio total
            $price = cnnxn_Stock::where('article',$request->article)->increment('total_price',$total_price);
           
            //sacamos el beneficio

            $benefit = cnnxn_Stock::where('article',$request->article)->get();

            $update = cnnxn_Stock::where('article',$request->article)->update([
                'profit'=> $benefit[0]->total_price - $benefit[0]->total_cost
            ]);
           
        }
    }
    public function take(Request $request)
    {
        $id = $request->id;
        $qty = $request->take;
        $query = cnnxn_Stock::where('idStock',$id)->get();

        if ($query[0]->quantity < $qty) {
            return 0;
        }else{

            //sacamos el articulo

            $article = cnnxn_Article::where('idArticle',$query[0]->article)->get();

            //sacamos las cantidades

            $total_cost = $article[0]->cost * $qty;
            $total_price =$article[0]->price * $qty;

            //aumnetamos la cantida de items
            $less = cnnxn_Stock::where('idStock',$id)->decrement('quantity',$qty);

            //agregamos el total de costo
            $cost = cnnxn_Stock::where('idStock',$id)->decrement('total_cost',$total_cost);

            //agregams el total de precio
            $cost = cnnxn_Stock::where('idStock',$id)->decrement('total_price',$total_price);

            //actualizamos el beneficio
            $actual = cnnxn_Stock::where('idStock',$id)->get();

            $profit = cnnxn_Stock::where('idStock',$id)->update([
                'profit'=>$actual[0]->total_price - $actual[0]->total_cost 
            ]);

        }

    }
    public function take_up(Request $request)
    {
        $id = $request->id;
        $qty = $request->take;
        $query = cnnxn_Stock::where('idStock',$id)->get();

        //sacamos el articulo

        $article = cnnxn_Article::where('idArticle',$query[0]->article)->get();

        //sacamos las cantidades

        $total_cost = $article[0]->cost * $qty;
        $total_price =$article[0]->price * $qty;

        //aumnetamos la cantida de items
        $less = cnnxn_Stock::where('idStock',$id)->increment('quantity',$qty);

        //agregamos el total de costo
        $cost = cnnxn_Stock::where('idStock',$id)->increment('total_cost',$total_cost);

        //agregams el total de precio
        $cost = cnnxn_Stock::where('idStock',$id)->increment('total_price',$total_price);

        //actualizamos el beneficio
        $actual = cnnxn_Stock::where('idStock',$id)->get();

        $profit = cnnxn_Stock::where('idStock',$id)->update([
            'profit'=>$actual[0]->total_price - $actual[0]->total_cost 
        ]);

    
    }
    public function show_stock()
    {
        //cosulta total para la tabla
        $query = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->get();

        //consulta de valor total del inventario
        $total_value = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->sum('total_price');

        //consulta del lo invertido
        $investment = cnnxn_Stock::join('cnnxn_articles','cnnxn_articles.idArticle','=','cnnxn_stock.article')->sum('total_cost');

        //consulta de beneficio
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
