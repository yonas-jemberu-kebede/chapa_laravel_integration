<?php

use App\Http\Controllers\ChapaController;
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

Route::get('/', function () {
    return view('welcome');
});
// The route that the button calls to initialize payment

Route::post('pay',[ChapaController::class,'initialize'])->name('pay');

// The callback url after a payment
Route::get('callback/{reference}',[ChapaController::class,'callback'])->name('callback');