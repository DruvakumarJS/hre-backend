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
    return redirect(route('login'));    
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:admin');
Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('manager_home')->middleware('role:manager');
Route::get('/procurement_home', [ProcurementHomeController::class, 'index'])->name('procurement_home')->middleware('role:procurement');


Route::get('users_list',[UserController::class, 'index'])->name('users');

Route::get('material_list',[MaterialController::class, 'index'])->name('materials');

Route::get('ticket_list',[TicketController::class, 'index'])->name('tickets');

Route::get('PCN',[PcnController::class,'index'])->name('PCN');

Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');

Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');

Route::get('PCN',[PcnController::class,'index'])->name('PCN');

Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');

Route::get('intends',[IntendController::class,'index'])->name('intends');
Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
Route::get('update_intends/{id}',[IntendController::class,'edit'])->name('update_intends');




/*Route::middleware('auth:web')->group(function () {

	Route::get("logout",[HomeController::class,"destroy"])->name("logout");

	 Route::middleware(['auth','isadmin'])->group(function () {

	 	Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:admin');
		
		Route::get('users_list',[UserController::class, 'index'])->name('users');

		Route::get('material_list',[MaterialController::class, 'index'])->name('materials');

		Route::get('ticket_list',[TicketController::class, 'index'])->name('tickets');

		Route::get('PCN',[PcnController::class,'index'])->name('PCN');

		Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');

		Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');

		Route::get('PCN',[PcnController::class,'index'])->name('PCN');

		Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');

		Route::get("logout",[HomeController::class,"destroy"])->name("logout");

	});	
 
     Route::middleware(['auth','isadmin'])->group(function () {

     	Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('home')->middleware('role:manager');

     	Route::get("logout",[HomeController::class,"destroy"])->name("logout");

    }); 	

      
});*/

