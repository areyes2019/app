<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\cnnxn_categorie;
use App\Models\cnnxn_Article;
use App\Http\Requests\CategoriesRequest;
class StoreController extends Controller
{
    public function shop()
    {
        //mostramos categorias single
        $single = cnnxn_categorie::where('main',0)->where('is_parent',0)->get();
        $parent = cnnxn_categorie::where('is_parent',1)->get();
        return view('shop',['single'=>$single,'parent'=>$parent]);
    }

    public function shop_item()
    {
        return view('article');
    }

    public function categories($slug)
    {

        //econtramos el id
        $query = cnnxn_categorie::where('slug',$slug)->get();
        $id = $query[0]->idCategorie;
        $title = $query[0]->name;

        //sacamos los artículos
        $items = cnnxn_Article::where('categorie',$id)->get();
        return view('store.categories',['title'=>$title,'articles'=>$items]);    
    }

    public function expert()
    {
        return view('store.expert');
    }
}
