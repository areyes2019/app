<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\cnnxn_categorie;
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

    public function categories()
    {

        return view('categories.index');    
    }

    public function expert()
    {
        return view('store.expert');
    }
}
