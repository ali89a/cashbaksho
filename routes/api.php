<?php

use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\User\AuthController as UserAuthController;
use Illuminate\Support\Facades\Route;

//admin routes
Route::group(['prefix' => 'v1/admin','as'=>'admin.'],function (){
    Route::post('login',[AdminAuthController::class,'login'])->name('login');

    Route::group(['middleware' => ['auth:admin-api','scope:admin']],function (){
        Route::post('logout',[AdminAuthController::class,'logout'])->name('logout');
        Route::get('admins',[AdminAuthController::class,'getAllAdmins'])->name('get.admins');
        Route::get('my-info',[AdminAuthController::class,'getLoggedUserDetails'])->name('get.myInfo');
    });
});

//user shop routes
Route::group(['prefix' => 'v1/shop','as'=>'shop.'],function (){
    Route::post('register',[UserAuthController::class,'register'])->name('register');
    Route::post('login',[UserAuthController::class,'login'])->name('login');
    Route::post('logout',[UserAuthController::class,'logout'])->name('logout');

    Route::group(['middleware' => ['auth:user-api','scope:user']],function (){
        Route::post('logout',[UserAuthController::class,'logout'])->name('logout');
//        Route::get('users',[UserAuthController::class,'getAllUsers'])->name('get.users');
        Route::get('my-info',[UserAuthController::class,'getLoggedUserDetails'])->name('get.myInfo');
        Route::apiResource('customer',CustomerController::class);
        Route::apiResource('supplier',SupplierController::class);
        Route::apiResource('purchase',PurchaseController::class);
        Route::apiResource('sale',SaleController::class);
        Route::apiResource('expense',ExpenseController::class);
        Route::apiResource('transaction',TransactionController::class);
    });
});


