<?php

use App\Http\Controllers\User\SeoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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





Route::group([ 'middleware' => ['locale.set']], function () {
    Auth::routes();
//    Route::get('/mail', function (){
//        return view('mail.offer');
//    })->where('any','.*');
    Route::get('{any?}', SeoController::class)->where('any','.*');

//    Route::get('{any?}', function (){
//        return view('layouts.app');
//    })->where('any','.*');

});
