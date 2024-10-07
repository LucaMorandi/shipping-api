<?php

use App\Http\Controllers\Shipping\ShippingServiceController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
  Route::group(['middleware' => 'throttle:30,1'], function() {
    Route::post('/sanctum/token', [UserController::class, 'createApiToken']);
  });

  Route::group(['middleware' => ['throttle:100,1', 'auth:sanctum']], function () {
    Route::group(['middleware' => ['abilities:view:shipping-services']], function () {
      Route::get('/shipping/services', [ShippingServiceController::class, 'index']);
    });
  });
});
