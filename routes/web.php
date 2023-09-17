<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController ;
use App\Http\Controllers\companyController ;
use App\Http\Controllers\OrderController ;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\UserController;


/* Route::get('/user', [UserController::class, 'index']);
 */

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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/' ,[App\Http\Controllers\HomeController::class ,'adminPage'])->name('admin');

    Route::group(
        ['prefix' => 'category'],



        function () {
Route::get('/', [CategoryController::class, 'index'])->name('category');
    Route::get('/add_category', [CategoryController::class, 'create'])->name('add_category');
    Route::post('/insert_category',[CategoryController::class, 'store'])->name('insert_category');
    Route::get('/edit_category/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::put('/update_category/{id}',[CategoryController::class, 'update'])->name('update_category');
    Route::get('/delete_category/{id}', [CategoryController::class, 'destroy'])-> name('delete_category');

});
Route::prefix('product')->group(function () {


    Route::get('/', [ProductsController::class, 'index'])->name('product');
    Route::get('/add_product', [ProductsController::class, 'create'])->name('add_product');
    Route::post('/insert_product',[ProductsController::class, 'store'])->name('insert_product');
    Route::get('/edit_product/{id}', [ProductsController::class, 'edit'])->name('edit_product');
    Route::put('/update_product/{id}',[ProductsController::class, 'update'])->name('update_product');
    Route::get('/delete_product/{id}', [ProductsController::class, 'destroy'])-> name('delete_product');
    Route::any('/filters', [ProductsController::class, 'filters'])-> name('filterproduct');
    Route::put('/changeProductStatus/{id}', [ProductsController::class, 'changeStatus'])->name('changeProductStatus');

});
route::prefix('user')->group(function(){
     route::get('/',[UserController::class,'show'])->name('showusers');
});
Route::prefix('company')->group(function () {


    Route::get('/', [CompanyController::class, 'index'])->name('company');
    Route::get('/add_company', [companyController::class, 'create'])->name('add_company');
    Route::post('/insert_company',[companyController::class, 'store'])->name('insert_company');
    Route::get('/edit_company/{id}', [companyController::class, 'edit'])->name('edit_company');
    Route::put('/update_company/{id}',[companyController::class, 'update'])->name('update_company');
    Route::get('/delete_company/{id}', [companyController::class, 'destroy'])-> name('delete_company');

});
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/order_details/{id}', [OrderController::class, 'OrderDetails'])->name('order_details');
Route::post('/changeStatus', [OrderController::class, 'changeStatus'])->name('OrderStatus');
Route::get('/delivered_Orders', [OrderController::class, 'deliveredOrders'])->name('deliveredOrders');
Route::post('/searchOrder', [OrderController::class, 'Order_search'])->name('SearchOrder');



});




Route::PUT('/add_to_cart/{id}',[OrderController::class, 'addToOrederlist'])->name('add_to_cart');
Route::any('/Search', [HomeController::class, 'Search'])->name('Search');
Route::any('/filter', [FilterController::class, 'filter'])->name('filter');
route::get('shopping_Cart',[OrderController::class, 'ShoppingCart'])->name('shopping_Cart');
route::get('delete_pro_orders/{id}',[OrderController::class, 'destroy'])->name('delete_pro_orders');
Route::post('adding_order', [OrderController::class, 'AddingOrder'])->name('adding_order');
Route::get('My_orders', [OrderController::class, 'MyOrders'])->name('My_orders');



Auth::routes();

App::setLocale('ar');Route::get('/order_details/{id}', [OrderController::class, 'OrderDetails'])->name('order_details');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


