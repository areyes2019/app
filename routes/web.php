<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\WoocommerceController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [StoreController::class, 'shop'])->name('shop');
Route::get('/shop_item/{id}/{data}', [StoreController::class, 'shop_item'])->name('shop_item');
Route::get('/description', [StoreController::class, 'shop_item'])->name('shop_item');
Route::get('/expert', [StoreController::class, 'expert'])->name('expert');
Route::get('/store_categorie/{slug}', [StoreController::class, 'categories'])->name('store_categorie');


Route::get('/shipping', [StoreController::class, 'shipping']);
Route::get('/purchase', [StoreController::class, 'purchase']);
Route::get('admin', function () {
    if (Auth()->user()) {
        return redirect(route('home'));
    }else{
        return view('auth/login');
    }
});

//ruta temporal para agregar el public
/*Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});*/


Route::group(['middleware'=>'auth'],function(){
    /*Usuarios*/

    /*Pagina principal*/
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


    
    //modulo de articulos
    Route::get('list',[ArticlesController::class,'list'])->name('list');
    Route::post('excel',[ArticlesController::class,'excel'])->name('excel');
    Route::get('articles',[ArticlesController::class,'index'])->name('articles');
    Route::resources(['articles'=>ArticlesController::class]);
    Route::post('/article_img',[ArticlesController::class,'img'])->name('article_img');

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
    Route::post('/update_child/{id}',[ShopController::class,'update_child'])->name('update_child');
    Route::get('/show_categorie/{id}',[ShopController::class,'show_categorie'])->name('show_categorie');
    Route::get('/is_parent/',[ShopController::class,'is_parent'])->name('is_parent');    
    
    Route::get('/sum_value',[ArticlesController::class,'sum_value'])->name('sum_value');
    

    Route::get('quotations',[QuotationsController::class,'index'])->name('quotation');
    
    Route::get('/quotation_generate/',[QuotationController::class,'store'])->name('quotations');
    Route::get('/quotation_delete/{id}',[QuotationController::class,'destroy'])->name('quotation_delete');
    Route::get('/quotation_line/',[QuotationController::class,'line'])->name('quotation_line');
    
    Route::get('quotations_show',[QuotationController::class,'show'])->name('quotations_show');
    Route::get('/quotations_new/{id}',[QuotationController::class,'store'])->name('quotations_new');
    Route::get('/quotation_page/{id}',[QuotationController::class,'page'])->name('quotation_page');
    Route::get('/articles_show/',[QuotationController::class,'show_articles'])->name('articles_show');
    Route::get('/quotation/{id}',[QuotationController::class,'show_quotation'])->name('show_quotation');
    Route::get('/quotation_customer/{id}',[QuotationController::class,'show_customer'])->name('quotation_customer');
    Route::post('/change_status/{id}',[QuotationController::class,'change_status'])->name('change_status');
    Route::post('/quotations_add_line/',[QuotationController::class,'add_line'])->name('quotations_add_line'); //agrega cada linea de articulos
    Route::get('/quotations_show_lines/{id}',[QuotationController::class,'show_lines'])->name('show_lines'); //esta url nos muestra cada linea de la cotización
    Route::post('/delete_discount/',[QuotationController::class,'delete_discount'])->name('delete_discount'); //esta url elimina los descuentos
    Route::get('/show_totals/{id}',[QuotationController::class,'show_totals'])->name('show_totals');
    Route::post('/add_quantity/{line}',[QuotationController::class,'add_quantity'])->name('add_quantity');
    Route::post('/delete_line/',[QuotationController::class,'delete_line'])->name('delete_line');
    Route::post('/tax_add',[QuotationController::class,'tax_free'])->name('tax_free');
    Route::post('/add_discount',[QuotationController::class,'add_discount'])->name('add_discount');
    Route::get('/get_quotation_pdf/{id_qt}/{try}', [QuotationController::class,'get_pdf'])->name('get_quotation_pdf');
    Route::get('/get_tk_pdf/{id_qt}/{try}', [QuotationController::class,'get_tk'])->name('get_tk_pdf');
    Route::post('/add_payment/',[QuotationController::class,'add_payment'])->name('add_payment');
    Route::post('/total_payment/',[QuotationController::class,'total_payment'])->name('total_payment');

    //bancos
    //Route::get('/inventory/',[InventoryController::class,'index'])->name('inventory');

    //pedidos a proveedor
    Route::get('/orders/',[OrdersController::class,'index'])->name('orders');
    Route::get('/order_page/{id}',[OrdersController::class,'orders_page'])->name('orders_page');
    Route::post('/order_new/',[OrdersController::class,'store'])->name('orders_new');
    Route::get('/articles_show_providers/{id}',[OrdersController::class,'show_articles'])->name('articles_show_providers');
    Route::post('/order_add_line/',[OrdersController::class,'add_line'])->name('add_line');
    Route::get('/order_show_line/{id}',[OrdersController::class,'show_line'])->name('show_line');
    Route::get('/order_totals/{id}',[OrdersController::class,'order_totals'])->name('order_totals');
    Route::get('/order_pdf/{supplier}/{order}',[OrdersController::class,'pdf'])->name('order_pdf');
   
    Route::post('/delete_order_line/',[OrdersController::class,'delete_order_line']);
    Route::post('/add_quantity_order/',[OrdersController::class,'add_quantity_order']);
    Route::get('/orders_show/',[OrdersController::class,'orders_show'])->name('orders_show');
    Route::post('/send_to_design/',[PosController::class,'send_to_design'])->name('send_to_design');

    //configuracion
    Route::get('/config/',[ConfigController::class,'index'])->name('config');
    Route::post('/main_upload',[ConfigController::class,'main_img'])->name('main_upload');
    Route::post('/profit',[ConfigController::class,'profit']);
    Route::post('/profit_global',[ConfigController::class,'profit_global']);

    //modulo de contabilidad
    Route::get('/accounting/',[AccountingController::class,'index'])->name('accounting');
    Route::post('/add_accounting/',[AccountingController::class,'add_accounting'])->name('add_accounting');
    Route::post('/add_spent/',[AccountingController::class,'add_spent'])->name('add_spent');
    Route::get('/show_spent/',[AccountingController::class,'show_spent'])->name('show_spent');
    Route::post('/add_credit/',[AccountingController::class,'add_credit'])->name('add_credit');

    //inventarios
    Route::get('/stock/',[StockController::class,'index'])->name('stock');
    Route::post('/search_stock/',[StockController::class,'search_stock'])->name('search_stock');
    Route::get('/select_stock/',[StockController::class,'select_stock'])->name('select_stock');
    Route::post('/update_stock/',[StockController::class,'update_stock'])->name('update_stock');
    Route::post('/delete_stock_line/',[StockController::class,'delete_stock_line'])->name('delete_stock_line');
    Route::get('/show_stock/',[StockController::class,'show_stock'])->name('show_stock');
    Route::post('/take_out_stock/',[StockController::class,'take'])->name('take_out_stock');
    Route::post('/take_up_stock/',[StockController::class,'take_up'])->name('take_up_stock');
    
    /*MODULO POS*/
    

    Route::get('/sale/',[PosController::class,'index'])->name('sale');
    Route::get('/sale_list/',[PosController::class,'sale_list'])->name('sale_list');
    Route::get('/pos/{slug}',[PosController::class,'sale'])->name('pos');
    Route::post('/add_sale_slug/',[PosController::class,'add_slug'])->name('add_sale_slug');

    /*Aqui agregamos la venta o la cotizacion*/
    Route::post('/add_sale/',[PosController::class,'add_sale'])->name('add_sale');
    Route::get('/articles_list/',[PosController::class,'show'])->name('articles_list');
    Route::get('/get_order_data/{id}',[PosController::class,'order_data'])->name('get_order_data');
    Route::post('/update_sale_name/{id}',[PosController::class,'update_name'])->name('update_sale_name');
    Route::get('/orders_delete/{slug}',[PosController::class,'orders_delete'])->name('orders_delete');

    /*Agregar un producto independiente a la cotización */
    Route::post('/add_single/',[PosController::class,'add_single'])->name('add_single');
    
    Route::get('/show_details/{id}',[PosController::class,'show_details'])->name('show_details');
    Route::post('/delete_line_order/',[PosController::class,'delete_line'])->name('delete_line_order');
    Route::get('/get_totals/{id}',[PosController::class,'totals'])->name('get_totals');
    Route::post('/detail_img',[PosController::class,'img'])->name('detail_img');
    Route::post('/add_payment_order',[PosController::class,'add_advance'])->name('add_advance');
    Route::post('/shipping_pos',[PosController::class,'shipping'])->name('shipping_pos');
    Route::post('/shipping_type',[PosController::class,'shipping_type'])->name('shipping_type');
    Route::post('/add_address',[PosController::class,'add_address'])->name('add_address');
    Route::post('/add_qty',[PosController::class,'add_qty'])->name('add_qty');
    Route::get('ticket_purchase',[PosController::class,'ticket'])->name('ticket_purchase');
    Route::post('/change_tax',[PosController::class,'change_tax'])->name('change_tax');
    Route::post('/save_customer_pos',[PosController::class,'save_customer_pos'])->name('save_customer_pos');
    Route::post('/add_pay_pos',[PosController::class,'add_pay_pos'])->name('add_pay_pos');
    Route::post('/total_pos',[PosController::class,'total_pos'])->name('total_pos');
    Route::post('/shipping_data',[PosController::class,'shipping_data'])->name('shipping_data');
    Route::get('/get_sales/{id}',[PosController::class,'get_sales'])->name('get_sales');
    Route::get('/show_order/{id}',[PosController::class,'show_order'])->name('show_order');
    //Mostrar usuario en el form pos
    Route::get('/users_pos', [PosController::class, 'show_user'])->name('users_pos');
    Route::post('/send_to_production/',[PosController::class,'send'])->name('send_to_production');
    Route::post('/img_shop/',[PosController::class,'add_img_shop'])->name('img_shop');
    
    /*Ordenes de trabajo*/
    Route::post('/add_job/',[ProductionController::class,'add'])->name('add_job');
    Route::get('/order_list/{id}',[ProductionController::class,'order'])->name('order_list');
    





});

