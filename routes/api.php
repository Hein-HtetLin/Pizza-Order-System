<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Read
Route::get('/category',[ApiController::class,'getCategory']);
Route::get('/category/{id}',[ApiController::class,'detailCategory']);

// create
Route::post('/category/create',[ApiController::class,'createCategory']);
Route::post('/contact/create',[ApiController::class,'createContact']);

// update
Route::post('/category/update/{id}',[ApiController::class,'updateCategory']);

// Delete
Route::get('/category/delete/{id}',[ApiController::class,'deleteCategory']);

// API

/***
 * Category list
 * localhost:8000/api/category (GET)
 *
 * Category
 * localhost:8000/api/category/{id} (GET)
 *
 * Category Create
 * localhost:8000/api/category/create (POST)
 * body  => {
 *  "categoryName": ""
 * }
 *
 * Contact Create
 * localhost:8000/api/contact/create (POST)
 * body  => {
 *  "name": "",
 *  "email": "",
 *  "message": "",
 *  "orderCode": ""
 * }
 *
 * Category Delete
 * localhost:8000/api/category/delete/{id} (GET)
 *
 * Category Update
 * localhost:8000/api/category/update/{id} (POST)
 *
 * body  => {
 *  "categoryName":""
 * }
 *



**/


