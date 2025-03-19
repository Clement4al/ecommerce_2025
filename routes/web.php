<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;


Route::get('/',[HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::get('/view_category',[AdminController::class, 'view_category'])->middleware('auth');

Route::post('/add_category',[AdminController::class, 'add_category'])->middleware('auth');
Route::get('/delete_category/{id}',[AdminController::class, 'delete_category'])->middleware('auth');

Route::get('/view_product',[AdminController::class, 'view_product'])->middleware('auth');
Route::post('/add_product', [AdminController::class, 'add_product'])->middleware('auth');

Route::get('/show_product', [AdminController::class, 'show_product'])->middleware('auth');
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product'])->middleware('auth');

Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->middleware('auth');


Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->middleware('auth');

Route::get('/order', [AdminController::class, 'order'])->middleware('auth');

Route::get('/delivered/{id}', [AdminController::class, 'delivered'])->middleware('auth');

Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware('auth');

Route::get('/send_email/{id}', [AdminController::class, 'send_email'])->middleware('auth');

Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email'])->middleware('auth');

Route::get('/search', [SearchController::class, 'searchdata']);






Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [homeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [homeController::class, 'remove_cart']);

Route::get('/cash_order', [homeController::class, 'cash_order']);

Route::get('/stripe/{totalprice}', [homeController::class, 'stripe']);

Route::post('/stripe/{totalprice}',  [homeController::class, 'stripePost'])->name('stripe.post');

Route::get('/show_order', [homeController::class, 'show_order']);

Route::get('/cancel_order/{id}', [homeController::class, 'cancel_order']);
//comment
Route::post('/add_comment', [homeController::class, 'add_comment']);
//reply
Route::post('/add_reply', [homeController::class, 'add_reply']);

Route::get('/product_search', [homeController::class, 'product_search']);

Route::get('/products', [homeController::class, 'products']);

Route::get('/search_product', [homeController::class, 'search_product']);
