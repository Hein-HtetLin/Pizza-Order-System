<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;

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

// Route::get('loginPage', function () {
//     return view('login');
// });

// Route::get('registerPage', function () {
//     return view('register');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect("/", 'loginPage');
    Route::get("loginPage",[AuthController::class,'login'])->name('auth#login');

    Route::get("registerPage",[AuthController::class,'register'])->name('auth#register');
});
Route::middleware(['user_auth'])->group(function(){
    Route::redirect("/", 'loginPage');
    Route::get("loginPage",[AuthController::class,'login'])->name('auth#login');

    Route::get("registerPage",[AuthController::class,'register'])->name('auth#register');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        // dashboard
    Route::get('dashboard',[AuthController::class,'auth'])->name('auth#dashboard');

    // Admin
    Route::middleware(['admin_auth'])->group(function(){


        // dashboard
        Route::prefix('admin')->group(function(){
            Route::get('profile',[AuthController::class,'profile'])->name('admin#profile');
            Route::get('list',[AuthController::class,'list'])->name('admin#list');
            Route::get('mail',[AuthController::class,'mail'])->name('admin#mail');
            Route::get('changeRole',[AuthController::class,'changeRole']);
            Route::get('userList',[AuthController::class,'userList'])->name('admin#userList');
            Route::get('changePwd',[AuthController::class,'changePwdPage'])->name('admin#changePwdPage');
            Route::post('changePwd',[AuthController::class,'changePwd'])->name('admin#changePwd');
            Route::get('edit',[AuthController::class,'editPage'])->name('admin#editPage');
            Route::post('edit/{id}',[AuthController::class,'edit'])->name('admin#edit');
        });
        // Category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            // Route::post('search',[CategoryController::class,'search'])->name('category#search');
        });

        // product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
        });

        // order
        Route::prefix('adminOrder')->group(function(){
            Route::get('detail/{orderCode}',[OrderController::class,'detail'])->name('order#detail');
            Route::get('list',[OrderController::class,'order'])->name('order#list');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('orderChange#status');
            // Route::get('order/sort',[OrderController::class,'orderSort'])->name('order#sort');

        });
    });

    // user Route

    Route::middleware(['user_auth'])->group(function(){
        Route::prefix('user')->group(function(){
            Route::get('home',[UserController::class,'home'])->name('user#home');
            Route::get('product/detail/{id}',[UserController::class,'productDetail'])->name('user#productDetail');


            // profile
            Route::get('profile',[UserController::class,'profile'])->name('user#profile');
            Route::get('changePwd',[UserController::class,'changePage'])->name('pwd#changePage');
            Route::post('changePwd',[UserController::class,'changePwd'])->name('pwd#changePwd');
            Route::get('edit',[UserController::class,'edit'])->name('user#edit');
            Route::post('edit/{id}',[UserController::class,'update'])->name('user#update');

            // Ajax route
            Route::get('sort',[AjaxController::class,'sorting']);
            Route::get('addCart',[AjaxController::class,'addCart']);
            Route::get('order',[AjaxController::class,'order']);
            Route::get('cart/delete',[AjaxController::class,'cartDelete']);
            Route::get('create/mail',[AjaxController::class,'mail']);
            Route::get('product/view',[AjaxController::class,'view']);


            // cart
            Route::get('cartList',[CartController::class,'list'])->name('user#cartList');
            // order
            Route::get('order/list',[CartController::class,'orderList'])->name('user#orderList');
            Route::get('order/mail',[CartController::class,'mail'])->name('user#mail');
        });

    });

});
