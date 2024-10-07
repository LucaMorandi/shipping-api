<?php

use App\Http\Controllers\Shipping\ShippingServiceController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', [UserController::class, 'createApiToken']);

Route::group(['middleware' => ['auth:sanctum', 'abilities:view:shipping-services']], function () {
  Route::get('/shipping/services', [ShippingServiceController::class, 'index']);
});
