<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\VenueTypeController;
use App\Http\Controllers\BookingController;

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
    return view('welcome');
});

Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

Route::get('/admin/settings', [AdminController::class,'settings']);

Route::post('/admin/addvenue', [AdminController::class,'addVenue']);

Route::post('/admin/addvenuetype', [AdminController::class,'addVenueType']);

Route::post('/admin/searchuser', [AdminController::class,'searchUser']);

Route::post('/admin/setpriviledgelevel', [AdminController::class,'setPriviledgeLevel']);

Route::get('/user/login', function () {
    return view("user.login");
});

Route::get('/user/register', function () {
    return view("user.register");
});

Route::post('/user/login', [UserController::class,'login']);

Route::post('/user/register', [UserController::class,'register']);

Route::get('/user/book', [UserController::class,'book']);

Route::get('/user/bookhistory', [UserController::class,'bookhistory']);

Route::get('/user/logout', [UserController::class,'logout']);

Route::post('/venue/create', [VenueController::class,'create']);

Route::post('/venuetype/create', [VenueTypeController::class,'create']);

Route::post('/venue/remove', [VenueController::class,'remove']);

Route::post('/venuetype/remove', [VenueTypeController::class,'remove']);

Route::post('/user/book', [BookingController::class,'create']);