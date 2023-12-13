<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\cnnxn_Article;
use App\Models\cnnxn_Cataloge;
use App\Models\Contact;
use App\Models\cnnxn_Family;
use App\Models\cnnxn_config;
use App\Http\Requests\ArticleRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ArticlesImport;
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$query = cnnxn_config::all();
        //$percent=  $query[0]->percent;
        return view('articles.index'); //->with('percent',$percent);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = new cnnxn_Article;
        $query->name = $request->name;
        $query->model = $request->model;
        $query->cost = $request->cost;
        $query->price = $request->price;
        $query->design = 0;
        $query->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excel(Request $request)
    {
        $file=$request->file;   
        $query = Excel::import(new ArticlesImport, $file);
        if ($query) {
            return true;
        }
    }
    public function show($id)
    {
        $query = cnnxn_Article::where('idArticle',$id)->get();
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //el valor original de la goma
        $query = cnnxn_Article::where('idArticle',$request->id)->update([
            'name'      => $request->name,
            'model'     => $request->model,
            'cost'      => $request->cost,
            'rubber'    => $request->rubber,
            'design'    => $request->design,
            'price'     => $request->price,

        ]); 

        if ($query) {
            return true;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = cnnxn_Article::where('idArticle',$id)->delete();
        return $query;
    }
    public function cataloges()
    {
        return view('articles.cataloges');
    }
    public function add_cataloge(Request $request)
    {

        /*$validated = $request->validate([
            'cataloge_name'=>'required',
            'discount'=>'numeric',
            'idProvider'=>'required',
        ],[
            'cataloge_name.required' => 'El nombre del catalogo  es obligatorio',
            'discount.numeric' => 'El descuento solo debe llevar valores numéricos',
            'supplier.required' => 'Es obligatorio agregar un proveedor',
        ]
        );*/

        $query = cnnxn_Cataloge::create($request->all());
        if ($query) {
            return true;
        }

    }
    public function show_cataloges()
    {
        $query = Contact::join('cnnxn_cataloges','cnnxn_cataloges.idProvider', "=", 'cnnxn_contacts.idContact')->get();
        /*$query = cnnxn_Cataloge::join('cnnxn_contacts', 'cnnxn_cataloges.idProvider','=','cnnxn_contacts.idContact')->get();*/
        return $query;
    }
    public function delete_cataloge($id)
    {
        //elimina los articulos de catalogo
        $delete_items = cnnxn_Article::where('cataloge',$id)->count();
        if ($delete_items>0) {
            $delete_articles = cnnxn_Article::where('cataloge',$id)->delete();
            $delete_cataloge = cnnxn_Cataloge::where('idCataloge',$id)->delete();
        }else{
            $delete_only_cataloge = cnnxn_Cataloge::where('idCataloge',$id)->delete();
        }

        return true;

        //elimina los datos del catalogo
    }
    public function add_family(Request $request)
    {
        $validated = $request->validate([
            'family_name'=>'required'
        ],[
            'family_name.required'=>'El campo Nombre no puede ir vacío',
        ]);
        cnnxn_Family::create($validated);
        return true;
    }
    public function get_family()
    {
        $query = cnnxn_Family::all();
        return $query;
    }

    public function list()
    {
        
        $query = cnnxn_Article::all();
        return $query;

        /*$query = cnnxn_Article::join('cnnxn_family','cnnxn_family.idFamily','=','cnnxn_articles.family')->get();
        return $query;*/
    }
    public function get_cataloge($id)
    {
        $query = cnnxn_Cataloge::where('idProvider',$id)->get();
        return $query;
    }
    public function sum_value()
    {
        $value = 10;
        cnnxn_Article::query()->increment('price', $value);

    }
    public function img(Request $request)
    {

        //obtenemos la imagen 
        /*$request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);*/

        if ($files = $request->file('image')) {
            

            $name = $files->getClientOriginalName();
            $files->storeAs('public/cataloge',$name);

            $insert = cnnxn_Article::where('idArticle',$request->id_article)->update([
                'img_url'=> $name
            ]);


            if ($insert) {
                return true;
            }
        }


    }
    public function update_popular($id)
    {
        $query = cnnxn_Article::where('idArticle',$id)->get();

        if ($query[0]->popular == 0) {
            $query = cnnxn_Article::where('idArticle',$id)->update([
                'popular'=>1,
            ]);
        }else{
            $query = cnnxn_Article::where('idArticle',$id)->update([
                'popular'=>0,
            ]);
        }
    }
   

    

}
