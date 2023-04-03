<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerHomeController;
use App\Http\Controllers\ProcurementHomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PcnController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PettycashController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IntendController;
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
	// return view('welcome');
    return redirect(route('login'));    
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:admin');

Route::middleware('role:admin')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('users_list',[UserController::class, 'index'])->name('users');
    Route::get('material_list',[MaterialController::class, 'index'])->name('materials');
    Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');
	Route::get('PCN',[PcnController::class,'index'])->name('PCN');
	Route::get('tickets',[TicketController::class, 'index'])->name('tickets');
	Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');
    Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');
    
	});

Route::middleware('role:manager')->group(function () {
	Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('manager_home');
	Route::get('employee',[EmployeeController::class,'index'])->name('employee_list'); 	
	Route::get('intend_list',[IntendController::class,'index'])->name('intend_list');
    Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
	Route::get('tickets_list',[TicketController::class, 'index'])->name('tickets_list');
	Route::get('attendance_list',[AttendanceController::class,'index'])->name('attendance_list');
    Route::get('PettyCash',[PettycashController::class,'index'])->name('petty_cash');
    
	});


Route::middleware('role:procurement')->group(function () {
	Route::get('/procurement_home', [ProcurementHomeController::class, 'index'])->name('procurement_home');
	Route::get('intends',[IntendController::class,'index'])->name('intends');
	Route::get('update_intends/{id}',[IntendController::class,'edit'])->name('update_intends');
	Route::get('ticketslist',[TicketController::class, 'index'])->name('ticketslist');
	

	});





