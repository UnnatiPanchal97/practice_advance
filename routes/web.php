<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestQueueEmails;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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
Route::get('components', function (){
    return view('master');
  });
Auth::routes();
Route::get('sending-queue-emails', [TestQueueEmails::class,'sendTestEmails']);

Route::group(['middleware' => ['auth']], function() {
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::resource('/home/posts',PostController::class);
  Route::resource('/roles', RoleController::class);
  Route::resource('/users', UserController::class);
});
