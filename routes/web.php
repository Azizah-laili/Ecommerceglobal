<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* 11.buat route createnya , setelah ini ke terminal dan ketik php artisan storage:link dan selesai*/
Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');

/* 4.buat route untuk view index/show all data dan selesai*/
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');


/* 3.buat route untuk view show_product , lanjut ke index untuk mengarahkan ke show product*/
Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('show_product');


/* 4.buat route untuk view edit/uploud , lanjut ke show_product untuk mengarahkan ke edit atau update*/
Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('edit_product');
Route::patch('/product/{product}/update', [ProductController::class, 'update_product'])->name('update_product');

/* 02 buat route delete lanjut ke index untuk membuat button */
Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');




/* 05 buat route add to cart*/
Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');

/* 04 buat route show to cart, done*/
Route::get('/cart',  [CartController::class, 'show_cart'])->name('show_cart');

/* 02 buat route uupdate cart, lanjut ke view show_carts*/
Route::patch('/cart/{cart}',  [CartController::class, 'update_cart'])->name('update_cart');

/* 02 buat route delete cart lanjut ke index untuk membuat button */
Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');

/* 03 buat route checkout lanjut ke show cart untuk membuat button */
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
