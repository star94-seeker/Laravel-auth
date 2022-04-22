<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('add', [HomeController::class, 'addEditForm'])->name('add');
Route::get('edit/{id?}', [HomeController::class, 'addEditForm'])->name('edit');
Route::post('leadStore', [HomeController::class, 'store'])->name('leadStore');
Route::get('view/{id?}', [HomeController::class, 'view'])->name('view');
Route::get('delete/{id?}', [HomeController::class, 'delete'])->name('delete');