<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerHomeController;
use App\Http\Controllers\ProcurementHomeController;
use App\Http\Controllers\SupervisorHomeController;
use App\Http\Controllers\FinanceHomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PcnController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PettycashController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IntendController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketConversationController;
use App\Http\Controllers\PettyCashDetailController;
use App\Http\Controllers\RestoreController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\YearendfreezeController;
use App\Http\Controllers\HistogramController;
use App\Http\Controllers\VendorDepartmentController;

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

/*Route::middleware('role:admin')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	Route::get('settings/UserMaster',[UserController::class, 'index'])->name('users');
    Route::get('settings/create_user/{role}',[UserController::class, 'create_user'])->name('create_user');
    Route::post('save_user',[UserController::class , 'store'])->name('save_user');
    Route::get('edit_user/{id}',[UserController::class , 'edit'])->name('edit_user');
    Route::post('update_user',[UserController::class , 'update'])->name('update_user');
    Route::get('delete_user/{id}',[UserController::class , 'destroy'])->name('delete_user');
    //Route::get('delete_user/{id}',[UserController::class , 'destroy'])->name('back');


    Route::get('materials',[MaterialController::class,'index'])->name('materials');
    Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');
    Route::post('create_material',[MaterialController::class,'create'])->name('create_material');
    Route::get('view_products/{id}',[MaterialController::class,'view'])->name('view_products');
    Route::get('delete_product/{id}',[MaterialController::class,'destroy'])->name('delete_product');
    Route::get('edit_product/{id}',[MaterialController::class,'edit'])->name('edit_product');
    Route::post('update_product',[MaterialController::class,'update'])->name('update_product');
    Route::get('export-material/{filter}',[MaterialController::class,'export'])->name('export-materials');
    Route::get('uoms',[MaterialController::class,'action'])->name('uoms');

    Route::get('settings/Material-master',[CategoryController::class, 'index'])->name('materials_master');
    Route::post('create_category',[CategoryController::class, 'create'])->name('create-category');
    Route::get('delete_category/{id}',[CategoryController::class, 'destroy'])->name('delete_category');
    Route::post('update-category',[CategoryController::class, 'update'])->name('update-category');
    Route::get('export',[CategoryController::class , 'export'])->name('export-categories');

    Route::get('superadmins',[UserController::class, 'view_superadmins'])->name('admin');
    Route::get('managers',[UserController::class, 'view_managers'])->name('manager');
    Route::get('supervisors',[UserController::class, 'view_supervisors'])->name('supervisor');
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
	});*/

/*Route::middleware('role:manager')->group(function () {
	Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('manager_home');
	Route::get('employee',[EmployeeController::class,'index'])->name('employee_list');
  
	Route::get('attendance_list',[AttendanceController::class,'index'])->name('attendance_list');
    Route::get('PettyCash',[PettycashController::class,'index'])->name('petty_cash');

	});*/


/*Route::middleware('role:procurement')->group(function () {
	Route::get('/procurement_home', [ProcurementHomeController::class, 'index'])->name('procurement_home');

	});
Route::middleware('role:supervisor')->group(function () {
   
    });*/


Route::get('/home', [HomeController::class, 'index'])->name('home');    

/*Route::get('/finance_home', [FinanceHomeController::class, 'index'])->name('finance_home');
 Route::get('/supervisor_home', [SupervisorHomeController::class, 'index'])->name('supervisor_home');

 Route::get('/manager_home', [ManagerHomeController::class, 'index'])->name('manager_home');
    Route::get('employee',[EmployeeController::class,'index'])->name('employee_list');

 Route::get('/procurement_home', [ProcurementHomeController::class, 'index'])->name('procurement_home');
   
  */

//Route::get('supervisors/{id}',[UserController::class,'view_users'])->name('supervisors');
    Route::get('PCN',[PcnController::class,'index'])->name('PCN');
    Route::get('create_pcn',[PcnController::class,'create_pcn'])->name('create_pcn');
    Route::get('view_pcn',[PcnController::class,'view_pcn'])->name('view_pcn');
    Route::get('autocomplete',[PcnController::class,'action'])->name('autocomplete');
    Route::get('autocomplete_pcn',[PcnController::class,'autocomplete_pcn'])->name('autocomplete_pcn');
    Route::post('save_pcn',[PcnController::class,'store'])->name('save_pcn');
    Route::get('edit_pcn/{id}',[PcnController::class,'edit'])->name('edit_pcn');
    Route::post('update_pcn',[PcnController::class,'update'])->name('update_pcn');
    Route::post('search_pcn', [PcnController::class,'search'])->name('search_pcn');
    Route::post('search_pcn_details', [PcnController::class,'search_pcn_details'])->name('search_pcn_details');


    Route::get('indents',[IntendController::class,'index'])->name('intends');
    Route::get('indent_details/{id}',[IntendController::class,'show'])->name('indent_details');
    Route::get('edit_intends/{id}',[IntendController::class,'edit'])->name('edit_intends');
    Route::post('update_quantity',[IntendController::class,'update_dispatches'])->name('update_quantity');
    Route::get('export-indents/{indent_no}',[IntendController::class,'export'])->name('export-indents');
    
    Route::get('filter_indents/{filter}',[IntendController::class,'filter_indents'])->name('filter_indents');
    Route::get('create_indent',[IntendController::class,'create'])->name('create_indent');
    Route::get('products',[IntendController::class,'action'])->name('products');
    Route::post('save_indent',[IntendController::class,'store'])->name('save_indent');
    Route::get('grn',[IntendController::class,'grn'])->name('grn');
    Route::post('update-grn', [IntendController::class,'update_grn'])->name('update-grn');
    Route::post('edit_quantity', [IntendController::class,'edit_grn'])->name('edit_quantity');
    Route::post('search_indent', [IntendController::class,'search'])->name('search_indent');
    Route::post('search_grn', [IntendController::class,'search_grn'])->name('search_grn');
    Route::get('update_indent_status/{id}', [IntendController::class,'update_indent_status'])->name('update_indent_status');
    Route::post('filter_materials', [IntendController::class,'filter_materials'])->name('filter_materials');
    Route::post('trigger-settlement', [IntendController::class,'trigger_settlement'])->name('trigger_settlement');
    Route::post('settle-indent', [IntendController::class,'settle_indent'])->name('settle_indent');

    Route::get('send_email',[HomeController::class,'send_email'])->name('send_email');
    Route::get('generate-pdf', [HomeController::class, 'generatePDF'])->name('pdf');

    Route::get('tickets',[TicketController::class, 'index'])->name('tickets');
    Route::get('generate_ticket',[TicketController::class,'create'])->name('generate-ticket');
    Route::post('save_ticket',[TicketController::class,'store'])->name('save-ticket');
    Route::get('edit_ticket/{id}',[TicketController::class,'edit'])->name('edit-ticket');
    Route::post('update_ticket',[TicketController::class,'update'])->name('update-ticket');
    Route::post('filter',[TicketController::class, 'filter'])->name('filter');
    Route::get('ticket_details/{id}',[TicketController::class,''])->name('ticket-details');
    Route::get('ticket_details/{id}',[TicketConversationController::class,'index'])->name('ticket-details');
    Route::post('reply_conversation',[TicketConversationController::class,'store'])->name('reply_conversation');
    Route::post('modify_ticket',[TicketController::class,'modify_ticket'])->name('modify_ticket');
    Route::get('download_ticket/{id}',[TicketController::class,'download_ticket'])->name('download_ticket');
    Route::get('download_conversation_ticket/{id}',[TicketConversationController::class,'download_conversation_ticket'])->name('download_conversation_ticket');
    Route::post('search_ticket',[TicketController::class,'search'])->name('search_ticket');
    Route::get('department_master',[TicketController::class,'departments'])->name('department_master');
    Route::post('create-department',[TicketController::class,'create_department'])->name('create_department');
    Route::put('update-department/{id}',[TicketController::class,'update_department'])->name('update_department');
    Route::get('delete-department/{id}',[TicketController::class,'delete_department'])->name('delete_department');
    Route::get('delete-delete_ticket/{id}',[TicketController::class,'delete_ticket'])->name('delete_ticket');



    Route::get('attendance',[AttendanceController::class,'index'])->name('attendance');
    Route::get('employee-details',[AttendanceController::class,'employeedetails'])->name('employee-details');
    Route::get('employee-history/{id}',[AttendanceController::class,'employeehistory'])->name('employee-history')
    ;
    Route::post('search-attendance',[AttendanceController::class,'get_attendance_by_date'])->name('get_attendance_by_date')
    ;
    Route::post('search_attendance_by_date',[AttendanceController::class,'search_attendance_by_date'])->name('search_attendance_by_date')
    ;

    Route::post('add_attendance',[AttendanceController::class,'store'])->name('add_attendance');
    Route::post('attendance',[AttendanceController::class,'fetch_data'])->name('fetch_attendance');
    
    Route::post('update_attendance',[AttendanceController::class,'update'])->name('update_attendance');
    Route::post('search_employee',[AttendanceController::class,'search'])->name('search_employee');
    Route::post('search_attendance',[AttendanceController::class,'search_attendance'])->name('search_attendance');
    Route::post('search_user_attendance',[AttendanceController::class,'search_user_attendance'])->name('search_user_attendance');

 //petty cash
     Route::get('autocomplete_employee',[PettycashController::class,'action'])->name('autocomplete_employee');
    Route::get('pettycash',[PettycashController::class,'index'])->name('pettycash');
    Route::get('create_new',[PettycashController::class,'create'])->name('create_new');
    Route::get('pettycash_info/{id}',[PettycashController::class,'show'])->name('pettycash_info');
    Route::post('save_petty_cash',[PettycashController::class,'store'])->name('save_petty_cash');
    Route::get('edit_pettycash/{id}',[PettycashController::class,'edit'])->name('edit_pettycash');
    Route::post('update_pettycash/{id}',[PettycashController::class,'update'])->name('update_pettycash');
    Route::get('pettycash_delete/{id}',[PettycashController::class,'destroy'])->name('delete_pettycash');
    Route::get('pettycash_details/{id}',[PettyCashDetailController::class,'index'])->name('details_pettycash');
    Route::get('pettycash_expenses',[PettyCashDetailController::class,'create'])->name('pettycash_expenses');
    Route::post('upload_bills',[PettyCashDetailController::class,'store'])->name('upload_bills');
    Route::get('update_bill_status',[PettyCashDetailController::class,'update'])->name('update_bill_status');
    Route::get('delete_expense/{id}',[PettyCashDetailController::class,'destroy'])->name('delete_expense');
    Route::get('view-summary/{id}',[PettycashController::class,'summary'])->name('view_summary');
    Route::post('summary',[PettyCashDetailController::class,'fetch_summary'])->name('fetch_summary');
    Route::get('download_bills/{id}',[PettyCashDetailController::class,'download_bills'])->name('download_bills');
    Route::post('search_pettycash',[PettycashController::class,'search'])->name('search_pettycash');
    Route::get('pettycash_approval_reminder/{id}',[PettyCashDetailController::class,'reminder'])->name('pettycash_approval_reminder');
    Route::post('search_bill',[PettyCashDetailController::class,'search_bill'])->name('search_bills');
    Route::post('revert_bill_status',[PettyCashDetailController::class,'revert_bill_status'])->name('revert_bill_status');


   

    Route::get('settings/UserMaster',[UserController::class, 'index'])->name('users');
    Route::get('settings/create_user/{role}',[UserController::class, 'create_user'])->name('create_user');
    Route::post('save_user',[UserController::class , 'store'])->name('save_user');
    Route::get('edit_user/{id}',[UserController::class , 'edit'])->name('edit_user');
    Route::post('update_user/{id}',[UserController::class , 'update'])->name('update_user');
    Route::get('delete_user/{id}',[UserController::class , 'destroy'])->name('delete_user');
    Route::get('force_logout/{id}',[UserController::class , 'force_logout'])->name('force_logout');

    Route::get('settings/RoleMaster',[UserController::class, 'teams'])->name('roles');
    Route::get('settings/RoleMaster/view-users/{roleid}',[UserController::class, 'view_users'])->name('view_users');
    Route::post('promote',[UserController::class , 'promote'])->name('promote');


    Route::get('materials',[MaterialController::class,'index'])->name('materials');
    Route::get('add_product/{id}',[MaterialController::class,'show'])->name('add_product');
    Route::post('create_material',[MaterialController::class,'create'])->name('create_material');
    Route::get('view_products/{id}',[MaterialController::class,'view'])->name('view_products');
    Route::get('delete_product/{id}',[MaterialController::class,'destroy'])->name('delete_product');
    Route::get('edit_product/{id}',[MaterialController::class,'edit'])->name('edit_product');
    Route::post('update_product',[MaterialController::class,'update'])->name('update_product');
    Route::get('uoms',[MaterialController::class,'action'])->name('uoms');
    Route::post('search_material', [MaterialController::class,'search'])->name('search_material');
    Route::post('search_product', [MaterialController::class,'search_product'])->name('search_product');

    Route::get('settings/Material-master',[CategoryController::class, 'index'])->name('materials_master');
    Route::post('create_category',[CategoryController::class, 'create'])->name('create-category');
    Route::get('delete_category/{id}',[CategoryController::class, 'destroy'])->name('delete_category');
    Route::post('update-category',[CategoryController::class, 'update'])->name('update-category');
    Route::post('search-category',[CategoryController::class, 'search'])->name('search_category');
    

    Route::get('superadmins',[UserController::class, 'view_superadmins'])->name('admin');
    Route::get('managers',[UserController::class, 'view_managers'])->name('manager');
    Route::get('supervisors',[UserController::class, 'view_supervisors'])->name('supervisor');
    Route::get('procurement',[UserController::class, 'view_procurement'])->name('procurement');
    Route::get('finance',[UserController::class, 'view_finance'])->name('finance');
   
    Route::get('create_customer' ,[CustomerController::class,'create'])->name('create_customer');
    Route::post('save_customer' ,[CustomerController::class,'store'])->name('save_customer');
    Route::get('view_customers' ,[CustomerController::class,'index'])->name('view_customers');
    Route::get('edit_customer/{id}' ,[CustomerController::class,'edit'])->name('edit_customer');
    Route::post('update_customer' ,[CustomerController::class,'update'])->name('update_customer');
    Route::post('delete_customer/{id}' ,[CustomerController::class,'destroy'])->name('delete_customer');
    Route::post('delete_address' ,[CustomerController::class,'delete_address'])->name('delete_address');
    Route::get('delete_customer//{id}' ,[CustomerController::class,'delete_customer'])->name('delete_customer');
    Route::post('search_customer', [CustomerController::class,'search'])->name('search_customer');


    Route::get('settings',[SettingController::class,'index'])->name('settings');

    // Restore and Rescycle
    Route::get('import',[RestoreController::class,'index'])->name('import');

    Route::get('restore_recycle/customer',[RestoreController::class,'customer_list'])->name('restore-customers');
    Route::get('restore_customer/{id}',[RestoreController::class,'restore_customer'])->name('restore_customer');
    Route::get('trash_customer/{id}',[RestoreController::class,'trash_customer'])->name('trash_customer');

    Route::get('restore_recycle/user',[RestoreController::class,'users_list'])->name('restore-users');
    Route::get('restore_user/{id}',[RestoreController::class,'restore_user'])->name('restore_user');
    Route::get('trash_user/{id}',[RestoreController::class,'trash_user'])->name('trash_user');

    Route::get('restore_recycle/category',[RestoreController::class,'category_list'])->name('restore-category');
    Route::get('restore_category/{id}',[RestoreController::class,'restore_category'])->name('restore_category');
    Route::get('trash_category/{id}',[RestoreController::class,'trash_category'])->name('trash_category');

    Route::get('restore_recycle/material',[RestoreController::class,'material_list'])->name('restore-material');
    Route::get('restore_materialr/{id}',[RestoreController::class,'restore_material'])->name('restore_material');
    Route::get('trash_material/{id}',[RestoreController::class,'trash_material'])->name('trash_material');

    Route::post('import_user',[ImportController::class,'importuser'])->name('import_user');
    Route::post('import_customer',[ImportController::class,'importcustomer'])->name('import_customer');
    Route::post('import_category',[ImportController::class,'importcategory'])->name('import_category');
    Route::post('import_material',[ImportController::class,'importmaterial'])->name('import_material');

    Route::post('export_customer',[ExportController::class,'customer'])->name('export_customer');
    Route::post('export-pcn',[ExportController::class,'pcn'])->name('export-pcn');
    Route::get('export_indent/{id}',[ExportController::class,'indent'])->name('export_indent');
    Route::post('download_multiple_indents',[ExportController::class,'download_multiple_indents'])->name('download_multiple_indents');
    Route::post('export_tickets',[ExportController::class,'ticket'])->name('export_tickets');
    Route::get('export_pettycash',[ExportController::class,'pettycash'])->name('export_pettycash');
    Route::post('export_attendance',[ExportController::class,'attendance'])->name('export_attendance');
    Route::get('download_attendance',[ExportController::class,'month_report'])->name('download_monthly_attendance');
    Route::get('export-users/{role}',[ExportController::class , 'users'])->name('export-users');
    Route::get('export',[ExportController::class , 'category'])->name('export-categories');
    Route::post('export-material',[ExportController::class,'material'])->name('export-materials');
    Route::post('export_summary',[ExportController::class,'summary'])->name('export_summary');
    Route::post('export_vendors',[ExportController::class,'vendors'])->name('export_vendors');

    Route::get('show-notification/{id}',[NotificationController::class,'index'])->name('notification');
    Route::get('view-notification',[NotificationController::class,'show'])->name('view_notification');

    Route::get('my-vault',[VaultController::class,'index'])->name('vault_master');
    Route::post('save_document',[VaultController::class,'store'])->name('save_document');
    Route::post('update-doc',[VaultController::class,'update'])->name('update-doc');
    Route::get('delete_doc/{id}',[VaultController::class,'destroy'])->name('delete_doc');

    Route::get('view_vault',[VaultController::class,'view_vault'])->name('view_vault');
    Route::post('save_files',[VaultController::class,'create'])->name('save_files');
    Route::get('view_vault/{folder}',[VaultController::class,'sub_directory1'])->name('sub_directory');
    Route::post('save_sub_directory_files',[VaultController::class,'save_sub_directory_files'])->name('save_sub_directory_files');
    Route::get('view_vault/{folder}/{sub_folder}',[VaultController::class,'sub_sub_directory'])->name('sub_sub_directory');
    Route::post('save_sub_sub_directory_files',[VaultController::class,'save_sub_sub_directory_files'])->name('save_sub_sub_directory_files');

    Route::get('view_vault/{f1}/{f2}/{f3}',[VaultController::class,'level3'])->name('level3');
    Route::post('save_level3_files',[VaultController::class,'save_level3_files'])->name('save_level3_files');

    Route::get('view_vault/{f1}/{f2}/{f3}/{f4}',[VaultController::class,'level4'])->name('level4');
    Route::post('save_level4_files',[VaultController::class,'save_level4_files'])->name('save_level4_files');

    Route::get('view_vault/{f1}/{f2}/{f3}/{f4}/{f5}',[VaultController::class,'level5'])->name('level5');
    Route::post('save_level5_files',[VaultController::class,'save_level5_files'])->name('save_level5_files');

    Route::post('testimages',[PettyCashDetailController::class,'test'])->name('testimages');

    Route::get('year-end-closure',[YearendfreezeController::class,'index'])->name('year_end_closure');
    Route::post('save_acc_closure_date',[YearendfreezeController::class,'store'])->name('save_acc_closure_date');
    Route::put('update_acc_closure_date/{id}',[YearendfreezeController::class,'update'])->name('update_acc_closure_date');
    Route::get('disable-freeze-date/{id}',[YearendfreezeController::class,'disable'])->name('disable_freezedate');
    Route::get('enable-freeze-date/{id}',[YearendfreezeController::class,'enable'])->name('enable_freezedate');

    Route::get('histogram_list',[HistogramController::class,'index'])->name('histogram');
    Route::get('new-histogram',[HistogramController::class,'create'])->name('new_histogram');
    Route::post('save-histogram',[HistogramController::class,'store'])->name('save_histogram');
    Route::get('view-histogram-form/{id}',[HistogramController::class,'edit'])->name('view_form');
    Route::post('update-histogram',[HistogramController::class,'update'])->name('update_histogram');
    Route::get('update-histogram-form/{id}',[HistogramController::class,'update_form'])->name('update_form');
    Route::get('view_history/{id}',[HistogramController::class,'view_history'])->name('view_history');
    Route::post('update-histogram-details',[HistogramController::class,'update_histogram_details'])->name('update_histogram_details');
    Route::post('search-pending-forms',[HistogramController::class,'search_pending_forms'])->name('search_pending_forms');
    Route::get('delete-history/{id}/{histogram_id}',[HistogramController::class,'delete_history'])->name('delete_history');
    Route::post('search-histogram',[HistogramController::class,'search'])->name('search_histogram');
    Route::get('edit-my-histogram-form/{id}',[HistogramController::class,'edit_myform'])->name('edit_my_form');
    Route::post('edit-my-histogram-form',[HistogramController::class,'update_myform'])->name('update_my_form');
    Route::get('get_pcn_data', [HistogramController::class,'get_pcn_data'])->name('get_pcn_data');
    Route::get('delete_histogram/{id}', [HistogramController::class,'destroy'])->name('delete_histogram');

    Route::get('vendor_departmnts',[VendorDepartmentController::class,'vendor_headings'])->name('vendor_headings');
    Route::post('save-heading',[VendorDepartmentController::class,'save_heading'])->name('create_headings');
    Route::post('update-heading',[VendorDepartmentController::class,'update_heading'])->name('update_heading');
    Route::get('delete-heading/{id}',[VendorDepartmentController::class,'delete_heading'])->name('delete_heading');
 
    Route::get('vendor_master',[VendorDepartmentController::class,'index'])->name('vendor_master');
    Route::get('add-vendor',[VendorDepartmentController::class,'create'])->name('add_vendor');
    Route::post('save-vendor',[VendorDepartmentController::class,'store'])->name('save_vendor');
    Route::get('edit-vendor/{id}',[VendorDepartmentController::class,'edit'])->name('edit_vendor');
    Route::post('update-vendor',[VendorDepartmentController::class,'update'])->name('update_vendor');
    Route::post('search-vendor',[VendorDepartmentController::class,'search'])->name('search_vendor');
    Route::get('autocomplete_vendor',[VendorDepartmentController::class,'autocomplete_vendor'])->name('autocomplete_vendor');
    Route::get('delete-vendor/{id}',[VendorDepartmentController::class,'destroy'])->name('delete_vendor');
    Route::post('search-vendor-department',[VendorDepartmentController::class,'search_vendor_headings'])->name('search_vendor_headings');

    Route::get('Foot-Print',[HomeController::class,'footprint'])->name('footprint');
    Route::post('search-footprint',[HomeController::class,'search_footprint'])->name('search_footprint');







