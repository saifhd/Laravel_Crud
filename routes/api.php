<?php

use App\Http\Controllers\API\V1\Auth\AuthenticationController;
use App\Http\Controllers\API\V1\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1'],function(){
    Route::post('/register',[AuthenticationController::class,'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);

    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/logout',[AuthenticationController::class,'logout']);

        Route::get('/users/profile',[UsersController::class,'index']);
    });
});
