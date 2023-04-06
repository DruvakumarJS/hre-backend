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
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
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

Route::get("logout",[HomeController::class,"destroy"])->name("logout");

Route::middleware('role:admin')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('users_list',[UserController::class, 'index'])->name('users');

    Route::get('materials',[MaterialController::class,'index'])->name('materials');
    Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');
    Route::post('create_material',[MaterialController::class,'create'])->name('create_material');
    Route::get('view_products/{id}',[MaterialController::class,'edit'])->name('view_products');
    Route::get('delete_product/{id}',[MaterialController::class,'destroy'])->name('delete_product');

	Route::get('PCN',[PcnController::class,'index'])->name('PCN');
	Route::get('tickets',[TicketController::class, 'index'])->name('tickets');
	Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');
    Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');

    Route::get('material_master',[CategoryController::class, 'index'])->name('materials_master');
    Route::post('create_category',[CategoryController::class, 'create'])->name('create-category');
    Route::get('delete_category/{id}',[CategoryController::class, 'destroy'])->name('delete_category');
    Route::post('update-category',[CategoryController::class, 'update'])->name('update-category');

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
Route::get('settings',[SettingController::class,'index'])->name('settings');
Route::get('add-supervisor',[SettingController::class,'add_supervisor_form'])->name('add_supervisor');







