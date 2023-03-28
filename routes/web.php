<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;

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
    return redirect(route('login'));    
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('material_list',[MaterialController::class, 'index'])->name('materials');
Route::get('ticket_list',[MaterialController::class, 'create'])->name('tickets');