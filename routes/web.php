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
use App\Http\Controllers\CustomerController;
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

	Route::get('settings/UserMaster',[UserController::class, 'index'])->name('users');
    Route::get('settings/create_user/{role}',[UserController::class, 'create_user'])->name('create_user');
    Route::post('save_user',[UserController::class , 'store'])->name('save_user');


    Route::get('materials',[MaterialController::class,'index'])->name('materials');
    Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');
    Route::post('create_material',[MaterialController::class,'create'])->name('create_material');
    Route::get('view_products/{id}',[MaterialController::class,'view'])->name('view_products');
    Route::get('delete_product/{id}',[MaterialController::class,'destroy'])->name('delete_product');
    Route::get('edit_product/{id}',[MaterialController::class,'edit'])->name('edit_product');
    Route::post('update_product',[MaterialController::class,'update'])->name('update_product');
    Route::get('export-material/{filter}',[MaterialController::class,'export'])->name('export-materials');
    Route::get('uoms',[MaterialController::class,'action'])->name('uoms');

	/*Route::get('PCN',[PcnController::class,'index'])->name('PCN');
    Route::get('create_pcn',[PcnController::class,'create_pcn'])->name('create_pcn');
    Route::get('view_pcn',[PcnController::class,'view_pcn'])->name('view_pcn');
    Route::get('autocomplete',[PcnController::class,'action'])->name('autocomplete');
    Route::post('save_pcn',[PcnController::class,'store'])->name('save_pcn');
    Route::get('edit_pcn/{id}',[PcnController::class,'edit'])->name('edit_pcn');
    Route::post('update_pcn',[PcnController::class,'update'])->name('update_pcn');*/


    Route::get('tickets',[TicketController::class, 'index'])->name('tickets');
	Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');
    Route::get('employee-details',[AttendanceController::class,'employeedetails'])->name('employee-details');

    Route::get('employee-history',[AttendanceController::class,'employeehistory'])->name('employee-history');



    Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');

    Route::get('settings/Material-master',[CategoryController::class, 'index'])->name('materials_master');
    Route::post('create_category',[CategoryController::class, 'create'])->name('create-category');
    Route::get('delete_category/{id}',[CategoryController::class, 'destroy'])->name('delete_category');
    Route::post('update-category',[CategoryController::class, 'update'])->name('update-category');
    Route::get('export',[CategoryController::class , 'export'])->name('export-categories');

    Route::get('superadmins',[UserController::class, 'view_superadmins'])->name('superadmin');
    Route::get('managers',[UserController::class, 'view_managers'])->name('manager');
    Route::get('supervisors',[UserController::class, 'view_supervisors'])->name('supervisors');
    Route::get('procurement',[UserController::class, 'view_procurement'])->name('procurement');
    Route::get('finance',[UserController::class, 'view_finance'])->name('finance');
    Route::get('export-users/{role}',[UserController::class , 'export'])->name('export-users');

   
    Route::get('create_customer' ,[CustomerController::class,'create'])->name('create_customer');
    Route::post('save_customer' ,[CustomerController::class,'store'])->name('save_customer');
    Route::get('view_customers' ,[CustomerController::class,'index'])->name('view_customers');
    Route::get('edit_customer/{id}' ,[CustomerController::class,'edit'])->name('edit_customer');
    Route::post('update_customer' ,[CustomerController::class,'update'])->name('update_customer');
    Route::post('delete_customer/{id}' ,[CustomerController::class,'destroy'])->name('delete_customer');

    Route::post('delete_address' ,[CustomerController::class,'delete_address'])->name('delete_address');
    Route::get('delete_customer//{id}' ,[CustomerController::class,'delete_customer'])->name('delete_customer');


    Route::get('settings',[SettingController::class,'index'])->name('settings');
	});

Route::middleware('role:manager')->group(function () {
	Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('manager_home');
	Route::get('employee',[EmployeeController::class,'index'])->name('employee_list');
  /*Route::get('indent_list',[IntendController::class,'index'])->name('indent_list');
    Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
    Route::get('export-indents/{indent_no}',[IntendController::class,'export'])->name('export-indents');*/

	Route::get('tickets_list',[TicketController::class, 'index'])->name('tickets_list');
	Route::get('attendance_list',[AttendanceController::class,'index'])->name('attendance_list');
    Route::get('PettyCash',[PettycashController::class,'index'])->name('petty_cash');

	});


Route::middleware('role:procurement')->group(function () {
	Route::get('/procurement_home', [ProcurementHomeController::class, 'index'])->name('procurement_home');

	/*Route::get('indents',[IntendController::class,'index'])->name('intends');
    Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
	Route::get('edit_intends/{id}',[IntendController::class,'edit'])->name('edit_intends');
    Route::post('update_quantity',[IntendController::class,'update_dispatches'])->name('update_quantity');
    Route::get('export-indents/{indent_no}',[IntendController::class,'export'])->name('export-indents');*/

	Route::get('ticketslist',[TicketController::class, 'index'])->name('ticketslist');


	});

//Route::get('supervisors/{id}',[UserController::class,'view_users'])->name('supervisors');
    Route::get('PCN',[PcnController::class,'index'])->name('PCN');
    Route::get('create_pcn',[PcnController::class,'create_pcn'])->name('create_pcn');
    Route::get('view_pcn',[PcnController::class,'view_pcn'])->name('view_pcn');
    Route::get('autocomplete',[PcnController::class,'action'])->name('autocomplete');
    Route::post('save_pcn',[PcnController::class,'store'])->name('save_pcn');
    Route::get('edit_pcn/{id}',[PcnController::class,'edit'])->name('edit_pcn');
    Route::post('update_pcn',[PcnController::class,'update'])->name('update_pcn');
    Route::get('export-pcn',[PcnController::class,'export'])->name('export-pcn');


    Route::get('indents',[IntendController::class,'index'])->name('intends');
    Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
    Route::get('edit_intends/{id}',[IntendController::class,'edit'])->name('edit_intends');
    Route::post('update_quantity',[IntendController::class,'update_dispatches'])->name('update_quantity');
    Route::get('export-indents/{indent_no}',[IntendController::class,'export'])->name('export-indents');






