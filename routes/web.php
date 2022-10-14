<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\WoocommerceController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop_item', [ShopController::class, 'shop_item'])->name('shop_item');
Route::get('/description', [ShopController::class, 'shop_item'])->name('shop_item');
Route::get('/expert', [ShopController::class, 'expert'])->name('expert');
Route::get('admin', function () {
    if (Auth()->user()) {
        return redirect(route('home'));
    }else{
        return view('auth/login');
    }
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/contacts_page/{id}', [ContactsController::class, 'page'])->name('contacts_page');
    Route::get('/contacts_list/{id}', [ContactsController::class, 'list'])->name('contacts_list');
    Route::get('/contact_form',[ContactsController::class,'create'])->name('contact_form');
    Route::get('/delete_contact/{id}',[ContactsController::class,'destroy'])->name('delete_contact');
    Route::get('/contact_show/{id}',[ContactsController::class,'contact_show'])->name('contact_show');
    Route::post('/contact_update/{id}',[ContactsController::class,'contact_update'])->name('contact_update');
    Route::resources([
        '/contact/'=> ContactsController::class,
    ]);

    Route::get('woocommerce',[WoocommerceController::class,'index'])->name('woocommerce');
    Route::get('woocommerce_list',[WoocommerceController::class,'get_list'])->name('woocommerce_list');
    Route::post('add_woocommerce',[WoocommerceController::class,'add'])->name('add_woocommerce');
    Route::get('store/{id}/{slug}',[WoocommerceController::class,'store'])->name('store');
    Route::get('woo_articles/{id}',[WoocommerceController::class,'woo_articles'])->name('woo_articles');
    Route::get('store_id/{id}',[WoocommerceController::class,'store_id'])->name('store_id');
    Route::get('woo_articles_list/{id}',[WoocommerceController::class,'woo_articles_list'])->name('woo_articles_list');
    Route::get('woo_article/{id}/',[WoocommerceController::class,'woo_article'])->name('woo_article');
    Route::get('woo_get_article/{id}/{store}',[WoocommerceController::class,'woo_get_article'])->name('woo_get_article');
    Route::get('list',[ArticlesController::class,'list'])->name('list');
    Route::post('excel',[ArticlesController::class,'excel'])->name('excel');
    Route::resources([
        'articles'=>ArticlesController::class
    ]);


    Route::get('/cataloges',[ArticlesController::class,'cataloges'])->name('cataloges');
    Route::post('/add_cataloge',[ArticlesController::class,'add_cataloge'])->name('add_cataloge');
    Route::get('/show_cataloges',[ArticlesController::class,'show_cataloges'])->name('show_cataloges');
    Route::get('/delete_cataloge/{id}',[ArticlesController::class,'delete_cataloge'])->name('delete_cataloge');
    Route::post('/add_family',[ArticlesController::class,'add_family'])->name('add_family');
    Route::get('/get_family',[ArticlesController::class,'get_family'])->name('get_family');
    Route::get('/get_cataloge/{id}',[ArticlesController::class,'get_cataloge'])->name('get_cataloge');

    //rutas de la tienda
    Route::get('/categories',[ShopController::class,'categories'])->name('categories');
    Route::get('/categories_list',[ShopController::class,'categories_list'])->name('categories_list');
    Route::get('/get_categories',[ShopController::class,'get_categories'])->name('get_categories');
    Route::post('/add_categorie',[ShopController::class,'add_categorie'])->name('add_categorie');
    Route::get('/delete_categorie/{id}',[ShopController::class,'delete_categorie'])->name('delete_categorie');
    Route::post('/update_categorie/{id}',[ShopController::class,'update_categorie'])->name('update_categorie');
    Route::get('/show_categorie/{id}',[ShopController::class,'show_categorie'])->name('show_categorie');
    Route::get('/is_parent/',[ShopController::class,'is_parent'])->name('is_parent');    
    
    Route::get('/sum_value',[ArticlesController::class,'sum_value'])->name('sum_value');
    

    Route::get('quotations',[QuotationsController::class,'index'])->name('quotation');
    
    Route::get('/quotation_generate/',[QuotationController::class,'store'])->name('quotations');
    Route::get('/quotation_delete/',[QuotationController::class,'destroy'])->name('quotation_delete');
    Route::get('/quotation_line/',[QuotationController::class,'line'])->name('quotation_line');
    
    Route::get('quotations_show',[QuotationController::class,'show'])->name('quotations_show');
    Route::post('/quotations_new/',[QuotationController::class,'store'])->name('quotations_new');
    Route::get('/quotation_page/{id}',[QuotationController::class,'page'])->name('quotation_page');
    Route::get('/articles_show/',[QuotationController::class,'show_articles'])->name('articles_show');
    Route::get('/quotation/{id}',[QuotationController::class,'show_quotation'])->name('show_quotation');
    Route::get('/quotation_customer/{id}',[QuotationController::class,'show_customer'])->name('quotation_customer');
    Route::post('/change_status/{id}',[QuotationController::class,'change_status'])->name('change_status');
    Route::post('/quotations_add_line/',[QuotationController::class,'add_line'])->name('quotations_add_line');
    Route::get('/quotations_show_lines/{id}',[QuotationController::class,'show_lines'])->name('show_lines');
    Route::get('/show_totals/{id}',[QuotationController::class,'show_totals'])->name('show_totals');
    Route::post('/add_quantity/{line}',[QuotationController::class,'add_quantity'])->name('add_quantity');
    Route::post('/delete_line/{id}',[QuotationController::class,'delete_line'])->name('delete_line');
    Route::post('/tax_add',[QuotationController::class,'tax_free'])->name('tax_free');
    Route::post('/add_discount',[QuotationController::class,'add_discount'])->name('add_discount');
    Route::get('/get_quotation_pdf/{id}/{id_qt}/{try}', [QuotationController::class,'get_pdf'])->name('get_quotation_pdf');
});

