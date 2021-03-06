<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    $version = config('app.version');
    return response()->json($version);
});


// Route::middleware('guest')->group(function () {
    Route::post('/auth', 'AuthController@authenticate');
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/auth', 'AuthController@singOut');
    Route::apiResource('/users', 'UserController');

    Route::prefix('/equipments')->group(function () {
        Route::apiResource('/categories', 'CategoryController');
        Route::apiResource('/brands', 'BrandController');
        Route::apiResource('/models', 'ModelController');
    });

    Route::apiResource('/customers', 'CustomerController');
    Route::apiResource('/suppliers', 'SupplierController');

    Route::apiResource('/orders', 'OrderController')->except('update');

    Route::patch('/orders/{order}/quote', 'QuoteOrderController@update');
    Route::patch('/orders/{order}/create', 'MakeOrderController@update');
    Route::patch('/orders/{order}/approve', 'ApproveOrderController@update');
    Route::patch('/orders/{order}/disapprove', 'DisapproveOrderController@update');
    Route::patch('/orders/{order}/finish', 'FinishOrderController@update');
    Route::patch('/orders/{order}/delivery', 'DeliveryOrderController@update');
    Route::patch('/orders/{order}/cancel', 'QuoteOrderController@update');

    Route::apiResource('/orders/{order}/informations', 'InformationController')->except(['update', 'read']);
    Route::apiResource('/orders/{order}/items', 'ItemController')->except(['read']);
});
