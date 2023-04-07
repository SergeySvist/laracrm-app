<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);

Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::get('test', [\App\Http\Controllers\TestController::class, 'run']);
    Route::get('/signout', [AuthController::class, 'signout']);



    Route::group(['prefix' => 'categories'], function (){
        Route::get('/{category}', [CategoryController::class, 'get']);
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'create']);
        Route::patch('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'projects'], function (){
        Route::get('/{project}', [ProjectController::class, 'get']);
        //Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'create']);
        Route::delete('/{project}', [ProjectController::class, 'delete']);
        Route::patch('/{project}', [ProjectController::class, 'patch']);

        Route::get('/{project}/download', [ProjectController::class, 'download']);

    });

});

