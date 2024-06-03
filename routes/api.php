<?php

use Illuminate\Support\Facades\Route;

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


Route::post('/auth/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
        Route::get('/profile', [App\Http\Controllers\API\AuthController::class, 'profile']);
        Route::post('/change-foto-profile', [App\Http\Controllers\API\AuthController::class, 'change_profile']);
        Route::post('/change-password', [App\Http\Controllers\API\AuthController::class, 'change_password']);
        Route::post('/update-fcm', [App\Http\Controllers\API\AuthController::class, 'update_FCM']);
        Route::post('/delete-fcm', [App\Http\Controllers\API\AuthController::class, 'delete_FCM']);
    });
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', [App\Http\Controllers\API\MenuController::class, 'index']);
    });

    Route::group(['prefix' => 'payslips'], function () {
        Route::get('/', [App\Http\Controllers\API\PayslipController::class, 'index']);
        Route::get('/download/{id}', [App\Http\Controllers\API\PayslipController::class, 'download']);
        Route::post('/{id}', [App\Http\Controllers\API\PayslipController::class, 'detail']);
    });
    // KPI
    Route::group(['prefix' => 'kpi'], function () {
        Route::get('/', [App\Http\Controllers\API\PerfomeController::class, 'index']);
    });
    // talent
    Route::group(['prefix' => 'talent'], function () {
        Route::get('/', [App\Http\Controllers\API\TalentController::class, 'index']);
    });
    // attendance
    Route::group(['prefix' => 'attendances'], function () {
        Route::get('/', [App\Http\Controllers\API\AttendanceController::class, 'index']);
        Route::get('/list', [App\Http\Controllers\API\AttendanceController::class, 'list']);
        Route::get('/{id}', [App\Http\Controllers\API\AttendanceController::class, 'detail']);
        Route::post('/create', [App\Http\Controllers\API\AttendanceController::class, 'create']);
    });
    // daily report
    Route::group(['prefix' => 'daily_reports'], function () {
        Route::post('/', [App\Http\Controllers\API\DailyReportController::class, 'index']);
        Route::post('/store', [App\Http\Controllers\API\DailyReportController::class, 'store']);
        Route::get('/{id}', [App\Http\Controllers\API\DailyReportController::class, 'detail']);
    });
    // announcement
    Route::group(['prefix' => 'announeven'], function () {
        Route::get('/', [App\Http\Controllers\API\AnnouanEvenController::class, 'index']);
        Route::get('/detail', [App\Http\Controllers\API\AnnouanEvenController::class, 'detail']);
        Route::get('/announcement', [App\Http\Controllers\API\AnnouanEvenController::class, 'announcement']);
        Route::get('/event', [App\Http\Controllers\API\AnnouanEvenController::class, 'event']);
    });

    // rotation shift
    Route::group(['prefix' => 'shift'], function () {
        Route::get('/', [App\Http\Controllers\API\ShiftController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\API\ShiftController::class, 'create']);
        Route::post('/check_req_date', [App\Http\Controllers\API\ShiftController::class, 'check_req_date_employee']);
        Route::post('/check_schedule_repalce_employee', [App\Http\Controllers\API\ShiftController::class, 'check_schedule_date_repemployee']);
        Route::get('/repalce_employee', [App\Http\Controllers\API\ShiftController::class, 'get_emp_replace']);
        Route::post('/store', [App\Http\Controllers\API\ShiftController::class, 'store']);
        Route::PUT('/update', [App\Http\Controllers\API\ShiftController::class, 'update']);
        Route::get('/{id}', [App\Http\Controllers\API\ShiftController::class, 'edit']);
        Route::get('/show/{id}', [App\Http\Controllers\API\ShiftController::class, 'detail']);
        Route::delete('/{id}', [App\Http\Controllers\API\ShiftController::class, 'destroy']);
       
    });

    // schedule
    Route::group(['prefix' => 'schedule'], function () {
        Route::get('/', [App\Http\Controllers\API\ScheduleController::class, 'index']);
        Route::get('/init-live-attendance', [App\Http\Controllers\API\ScheduleController::class, 'loadSchedule']);
    });
    // loan
    Route::group(['prefix' =>'loan'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestLoanController::class, 'loan']);
        Route::get('/type_loan',[App\Http\Controllers\API\RequestLoanController::class, 'getLoanType']);
        Route::post('/create',[App\Http\Controllers\API\RequestLoanController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestLoanController::class, 'edit']);
        Route::put('/update',[App\Http\Controllers\API\RequestLoanController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestLoanController::class, 'detail']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestLoanController::class, 'destroy']);
    });
    // cash advance
    Route::group(['prefix' =>'cash_advance'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestLoanController::class, 'cash_advance']);
        Route::get('/type_loan',[App\Http\Controllers\API\RequestLoanController::class, 'getLoanType']);
        Route::post('/create',[App\Http\Controllers\API\RequestLoanController::class, 'store_cash_advance']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestLoanController::class, 'edit_cash_advance']);
        Route::put('/update',[App\Http\Controllers\API\RequestLoanController::class, 'update_cash_advance']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestLoanController::class, 'detail_cash_advance']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestLoanController::class, 'destroy_cash_advance']);
    });
    // reimbursement
    Route::group(['prefix' =>'reimburse'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestReimbursementController::class, 'index']);
        Route::get('/type_reimburse',[App\Http\Controllers\API\RequestReimbursementController::class,'getTypeReimburst']);
        Route::post('/create',[App\Http\Controllers\API\RequestReimbursementController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestReimbursementController::class, 'edit']);
        Route::put('/update',[App\Http\Controllers\API\RequestReimbursementController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestReimbursementController::class, 'detail']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestReimbursementController::class, 'destroy']);
    });
    // leaves
    Route::group(['prefix' =>'leave'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestLeaveController::class, 'leave']);
        Route::get('/type_leave',[App\Http\Controllers\API\RequestLeaveController::class,'getTypeLeave']);
        Route::post('/create',[App\Http\Controllers\API\RequestLeaveController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestLeaveController::class, 'edit']);
        Route::post('/update',[App\Http\Controllers\API\RequestLeaveController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestLeaveController::class, 'show']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestLeaveController::class, 'destroy']);
    });
     // permit/submition
     Route::group(['prefix' =>'submision'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestLeaveController::class, 'submision']);
        Route::get('/type_leave',[App\Http\Controllers\API\RequestLeaveController::class,'getTypeLeave']);
        Route::post('/create',[App\Http\Controllers\API\RequestLeaveController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestLeaveController::class, 'edit']);
        Route::post('/update',[App\Http\Controllers\API\RequestLeaveController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestLeaveController::class, 'show']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestLeaveController::class, 'destroy']);
    });
    // timesheet
    Route::group(['prefix' =>'timesheet'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestTimeSheetController::class, 'index']);
        Route::post('/create',[App\Http\Controllers\API\RequestTimeSheetController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestTimeSheetController::class, 'edit']);
        Route::post('/update',[App\Http\Controllers\API\RequestTimeSheetController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestTimeSheetController::class, 'show']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestTimeSheetController::class, 'destroy']);
    });
     // overtime
     Route::group(['prefix' =>'overtime'], function(){
        Route::post('/',[App\Http\Controllers\API\RequestOvertimeController::class, 'index']);
        Route::get('/day_type',[App\Http\Controllers\API\RequestOvertimeController::class, 'get_dayType']);
        Route::post('/create',[App\Http\Controllers\API\RequestOvertimeController::class, 'store']);
        Route::get('/edit/{id}',[App\Http\Controllers\API\RequestOvertimeController::class, 'edit']);
        Route::post('/update',[App\Http\Controllers\API\RequestOvertimeController::class, 'update']);
        Route::get('/{id}',[App\Http\Controllers\API\RequestOvertimeController::class, 'show']);
        Route::delete('/delete',[App\Http\Controllers\API\RequestOvertimeController::class, 'destroy']);
    });
     Route::group(['prefix' =>'approval'], function(){
        Route::get('/',[App\Http\Controllers\API\ApprovalController::class, 'index']);
        Route::post('/status-approve',[App\Http\Controllers\API\ApprovalController::class, 'ApproveStatus']);
       
    });
});
