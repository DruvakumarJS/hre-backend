<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\MaterialController;
use App\Http\Controllers\api\IndentController;
use App\Http\Controllers\api\TicketController;
use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\PettycashController;
use App\Http\Controllers\api\AppdataController;
use App\Http\Controllers\api\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getusers',[UserController::class , 'index']);
Route::post('/search-user',[UserController::class , 'search']);
Route::post('/validate-login',[UserController::class,'validate_login']);
Route::post('/get-material-details',[MaterialController::class,'material_data']);
Route::post('/get-material-list',[MaterialController::class,'material_list']);
Route::post('/create-indent',[IndentController::class,'create']);
Route::post('/get-indents',[IndentController::class,'indents']);
Route::post('/get-indent-details',[IndentController::class,'indent_details']);
Route::post('/pcns',[IndentController::class,'pcn_list']);
Route::get('/grn',[IndentController::class,'grn_list']);
Route::post('/update-grn',[IndentController::class,'update_grn']);
Route::post('/create-ticket',[TicketController::class,'create']);
Route::post('/get-tickets',[TicketController::class,'index']);
Route::post('/update-ticket',[TicketController::class,'update']);
Route::post('/update-ticket-status',[TicketController::class,'modify_ticket_status']);

Route::post('/add-conversation',[TicketController::class,'conversation']);
Route::post('/get-conversation',[TicketController::class,'conversation_details']);
Route::post('/get-departments',[IndentController::class,'getdepartments']);
Route::post('/get-employees',[UserController::class,'employees']);

Route::post('/attendance',[AttendanceController::class,'attendance']);
Route::post('/myattendance',[AttendanceController::class,'myattendance']);

Route::post('/get-mypettycash',[PettycashController::class,'mypettycash']);
Route::post('/upload-pettycash_bill',[PettycashController::class,'upload_bill']);
Route::post('/get-pettycash_details',[PettycashController::class,'pettycash_details']);
Route::post('/get-pettycash_summary',[PettycashController::class,'fetch_summary']);


Route::post('/get-app-data',[AppdataController::class,'index']);
Route::post('/vault',[AppdataController::class,'vault']);

Route::post('/my-dashboard-details',[HomeController::class,'mydashboard']);

