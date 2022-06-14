<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');




Route::group(['middleware' => ['auth']], function() {
    Route::any('fetch-states',[UserController::class,'fetchState'])->name('fetch-states');
    Route::any('fetch-cities',[UserController::class,'fetchCity'])->name('fetch-citiess');
        
    Route::get('create',[UserController::class,'create'])->name('create');
    Route::post('store',[UserController::class,'store'])->name('store');
    Route::get('user-list',[UserController::class,'index'])->name('user-list');
    Route::get('show/{user}',[UserController::class,'show'])->name('show');
    Route::get('delete/{user}',[UserController::class,'delete'])->name('delete');
    Route::get('edit/{user}',[UserController::class,'edit'])->name('edit');
    Route::any('update/{user}',[UserController::class,'update'])->name('update');
    
});

