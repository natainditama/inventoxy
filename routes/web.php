<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WardrobeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PICController;
use App\Http\Controllers\ShootingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
  if (Auth::check()) return redirect()->route('wardrobe.index');
  else return redirect()->route('login');
})->name('home');
Route::get('/login', AuthController::class . '@login')->name('login');
Route::get('/signup', AuthController::class . '@signup')->name('signup');
Route::post('/login', AuthController::class . '@loginProcces')->name('loginPost');
Route::post('/signup', AuthController::class . '@signupProcces')->name('signupPost');
Route::middleware(['auth:web'])->group(function () {
  Route::post('wardrobe/filter', WardrobeController::class . '@filter')->name('wardrobe.filter');
  Route::post('wardrobe/detail', WardrobeController::class . '@detail')->name('wardrobe.detail');
  Route::post('wardrobe/jenis', WardrobeController::class . '@jenis')->name('wardrobe.jenis');
  Route::resource('wardrobe', WardrobeController::class);
  Route::resource('equipment', EquipmentController::class);
  Route::resource('pic', PICController::class);
  Route::resource('shooting', ShootingController::class);
  Route::get('/ajaxWardrobe', 'WardrobeController@ajaxShow')->name('wardrobe.ajaxShow');
});
