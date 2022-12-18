<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'loginPost']);

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'registerPost']);

Route::get('catalog', [CatalogController::class, 'catalog'])->name('catalog');

Route::get('about', [ProductController::class, 'index'])->name('about');

Route::get('find', [UserController::class, 'find'])->name('find');

Route::get('product/{product}', [ProductController::class, 'show'])->name('show');

Route::middleware('auth')->group(function (){
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware('RoleMiddleware')->group(function (){
        Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
            Route::resource('/product', ProductController::class);
            Route::resource('/catalog', CatalogController::class);
        });
        Route::get('/completed/{order}', [OrderController::class, 'completed'])->name('completed');
    });
    Route::group(['prefix'=> '/order', 'as' => 'order.'], function (){
        Route::get('/basket', [OrderController::class, 'basket'])->name('basket');
        Route::post('/basket', [OrderController::class, 'basketPost']);
        Route::get('/addBasket', [OrderController::class, 'addBasket'])->name('addBasket');
        Route::post('/createOrder', [OrderController::class, 'createOrder'])->name('createOrder');
        Route::get('/all/{myOrder?}', [OrderController::class, 'orders'])->name('all');
        Route::get('/cancel/{order}', [OrderController::class, 'cancel'])->name('cancel');
    });
});
