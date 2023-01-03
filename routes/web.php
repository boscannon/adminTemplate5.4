<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::view('/', 'landing');

//登出 前後台共用
Route::post('/logout', [Controllers\AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
  $hello = '';
  if(Auth::guard('admin')->check()){
    $hello = 'Hello admin';
  }else if(Auth::guard('web')->check()){
    $hello = 'Hello web';
  }
  return 'dashboard<br />' . $hello;
})->name('dashboard');
