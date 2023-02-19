<?php

use App\Http\Controllers\BuildingObjectController;
use App\Http\Controllers\BuildingTypeController;
use App\Http\Controllers\BuildingFloodAreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['role:admin-support|marketing'])->group(function () {
        Route::resources([
            'customer' => CustomerController::class,
        ]);
    });

    Route::middleware(['role:marketing'])->group(function () {
        Route::resources([
            'building-object' => BuildingObjectController::class,
            'building-type' => BuildingTypeController::class,
            'building-flood-area' => BuildingFloodAreaController::class,
            'building' => BuildingController::class
        ]);
    });
});
Route::get('/customer_list', [CustomerController::class, 'customer_list'])->name('customer_list');

Route::get('building/get-building-by-customer-id/{customerId}', [BuildingController::class, 'getBuildingByCustomerId'])->name('building.by-customer-id');
