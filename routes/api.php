<?php

use illuminate\Support\Facades\Routes;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public router
Route::post('/login', [AuthController::class, 'login']);

//protected router
Route::middleware('auth:sanctum')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
});
