<?php

use App\Http\Controllers\ReimburstmentOptionController;
use App\Http\Controllers\AttendanceEmployeeController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DayTypeController;
use App\Http\Controllers\HRM\EmployeeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LoanOptionController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimeTypeController;
use App\Http\Controllers\PayslipTypeController;
use App\Http\Controllers\ReqShiftScheduleController;
use App\Http\Controllers\ShiftScheduleController;
use App\Http\Controllers\ShiftTypeController;
use App\Http\Controllers\TimeManagementReportController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\UsersManagement\RolesController;
use App\Http\Controllers\UsersManagement\UsersController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AllowanceOptionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ReimburstController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\ChecklistAttendanceSummaryController;
use App\Http\Controllers\CompanyHolidayController;
use App\Http\Controllers\DayoffController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\HistoryLeaveController;
use App\Http\Controllers\LevelApprovalController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PayslipCodePinController;
use App\Http\Controllers\PaySlipController;
use App\Http\Controllers\PPH21Controller;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SetPTKPController;
// rotate
use App\Http\Controllers\RotateController;
use App\Http\Controllers\CompanyController;
// report
use App\Http\Controllers\HRM\EmployeeReportController;
use App\Http\Controllers\Report\ReportRecapAttendanceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthenticationController::class, 'loginView'])
        ->name('login.view')
        ->middleware('checkUserIfLogin');

Route::post('/login', [AuthenticationController::class, 'login'])
        ->name('login');

Route::post('/logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [DashboardController::class, 'index'])
                ->name('dashboard');
        Route::post('/chart/filter-attendance', [DashboardController::class, 'filterChartAttendance'])
                ->name('dashboard.filter-chart-attendance');
        Route::post('/chart/filter-branch', [DashboardController::class, 'filterByBranch'])
                ->name('dashboard.filter-branch');
        Route::get('/chart/filter-timesheet-schedules', [DashboardController::class, 'timesheetFilterByBranch'])
                ->name('dashboard.filter-timesheet-schedules');
        Route::get('/chart/filter-employee-resume', [DashboardController::class, 'employeeResumeFilterByBranch'])
                ->name('dashboard.filter-employee-resume');


        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);

        /** route employees */
        Route::resource('employees', EmployeeController::class);
        Route::get('get-data-employees',[EmployeeController::class,'GetDataEmployees'])->name('employees.get-data-employees');
        /** end route employees */

        // HRM Config Master Data
        Route::resource('branches', BranchController::class);
        Route::resource('leave-type', LeaveTypeController::class);
        Route::resource('reimbursement-option', ReimburstmentOptionController::class);
        Route::resource('loan-option', LoanOptionController::class);
        Route::resource('payslip-type', PayslipTypeController::class);
        Route::resource('overtime-type', OvertimeTypeController::class);
        Route::resource('day-type', DayTypeController::class);
        Route::resource('shift-type', ShiftTypeController::class);
        Route::resource('allowance-option', AllowanceOptionController::class);

        //Finance
        Route::resource('reimburst', ReimburstController::class);
        Route::resource('cash', CashController::class);
        Route::resource('allowances', AllowanceController::class);
        Route::resource('loans', LoanController::class);
        Route::get('set-bpjstk', [PayrollController::class, 'indexSetBpjsTk'])
                ->name('set-bpjstk.index');
        Route::get('set-bpjstk/{id}/edit', [PayrollController::class, 'editSetBpjsTk'])
                ->name('set-bpjstk.edit');
        Route::put('set-bpjstk/{id}/update', [PayrollController::class, 'updateSetBpjsTk'])
                ->name('set-bpjstk.update');
        Route::post('set-bpjstk', [PayrollController::class, 'storeSetBpjsTk'])
                ->name('set-bpjstk.store');
        Route::delete('set-bpjstk/{id}/destroy', [PayrollController::class, 'destroySetBpjsTk'])
                ->name('set-bpjstk.destroy');

        // Payroll
        Route::resource('payroll', PayrollController::class);
        Route::resource('payslips', PaySlipController::class);
        Route::post('/payslips/generate-slip/{employee}', [PaySlipController::class, 'downloadSlip'])
                ->name('payslips.generate-slip');
        Route::post('/payslips/show-slip/{employee}', [PaySlipController::class, 'showSlip'])
                ->name('payslips.show-slip');
        Route::get('/payslips/download-pdf/{payslipEmployee}', [PaySlipController::class, 'downloadPDF'])
                ->name('payslips.downloadPDF');
        Route::resource('denda', FineController::class);
        Route::get('/setting/pph21/ptkp', [PPH21Controller::class, 'indexPTKP'])
                ->name('setting.ptkp.index');
        Route::post('/setting/pph21/ptkp', [PPH21Controller::class, 'storeAndUpdatePTKP'])
                ->name('setting.ptkp.post');
        Route::resource('set-ptkp', SetPTKPController::class);

        // Payroll Setting
        Route::get('/setting/bpjs-tk', [PayrollController::class, 'indexBpjsTk'])
                ->name('setting.bpjs-tk.index');
        Route::post('/setting/bpjs-tk', [PayrollController::class, 'storeBpjsTk'])
                ->name('setting.bpjs-tk.post');
        Route::get('/setting/pph21', [PayrollController::class, 'indexPph21'])
                ->name('setting.pph21.index');
        Route::post('/setting/pph21', [PayrollController::class, 'storePph21'])
                ->name('setting.pph21.post');
        Route::get('/setting/jht', [PayrollController::class, 'indexJht'])
                ->name('setting.jht.index');
        Route::post('/setting/jht', [PayrollController::class, 'storeJht'])
                ->name('setting.jht.post');
        Route::get('/setting/jkk', [PayrollController::class, 'indexJkk'])
                ->name('setting.jkk.index');
        Route::post('/setting/jkk', [PayrollController::class, 'storeJkk'])
                ->name('setting.jkk.post');
        Route::get('/setting/jkm', [PayrollController::class, 'indexJkm'])
                ->name('setting.jkm.index');
        Route::post('/setting/jkm', [PayrollController::class, 'storeJkm'])
                ->name('setting.jkm.post');
        Route::get('/setting/jp', [PayrollController::class, 'indexJp'])
                ->name('setting.jp.index');
        Route::post('/setting/jp', [PayrollController::class, 'storeJp'])
                ->name('setting.jp.post');
        Route::resource('payslip-code-pin', PayslipCodePinController::class);
        Route::resource('checklist-attendance-summary', ChecklistAttendanceSummaryController::class);

        // import
        Route::post('import-excel-attendance', [AttendanceEmployeeController::class, 'importExcel'])->name('import.excel.attendace');

        // Employees
        Route::get('/employee/education/{employeeEducation}', [EmployeeController::class, 'employeeEducations'])
                ->name('employee.education');

        Route::post('/employee/education/{education}', [EmployeeController::class, 'deleteEducation'])
                ->name('employee.education.delete');

        Route::get('/employee/experience/{employeeExperience}', [EmployeeController::class, 'employeeExperiences'])
                ->name('employee.experience');

        Route::post('/employee/experience/delete/{experience}', [EmployeeController::class, 'deleteExperience'])
                ->name('employee.experience.delete');

        Route::get('/employee/family/{employeeFamily}', [EmployeeController::class, 'employeeFamily'])
                ->name('employee.family');

        Route::post('/employee/family/delete/{family}', [EmployeeController::class, 'deleteFamily'])
                ->name('employee.family.delete');

        Route::get('/employee/medical/{employeeMedical}', [EmployeeController::class, 'employeeMedical'])
                ->name('employee.family');

        Route::post('/employee/medical/delete/{medical}', [EmployeeController::class, 'deleteMedical'])
                ->name('employee.family.delete');

        // report Employee
        Route::post('import-employee-excel', [EmployeeController::class, 'import_data'])->name('excel-employee.import');
        Route::post('Report-employee-excel', [EmployeeReportController::class, 'exportExcel'])->name('excel-employee.export');
        Route::get('chart-employee-status', [EmployeeReportController::class, 'employee_status']);
        Route::get('chart-employee-job-level', [EmployeeReportController::class, 'employee_jobLevel']);
        Route::get('chart-employee-education', [EmployeeReportController::class, 'employee_education']);
        Route::get('chart-employee-gender', [EmployeeReportController::class, 'employee_gender']);
        Route::get('chart-employee-age_average', [EmployeeReportController::class, 'employee_age_average']);
        Route::get('chart-employee_active_staff', [EmployeeReportController::class, 'employee_active_staff']);
        Route::get('chart-employee_jobLevel', [EmployeeReportController::class, 'employee_jobLevel']);
        Route::get('chart-employee_lenght_of_service', [EmployeeReportController::class, 'employee_lenght_of_service']);
        Route::get('chart-employee_monthly_turnover', [EmployeeReportController::class, 'monthly_turnover']);
        Route::get('chart-employee_religion', [EmployeeReportController::class, 'employee_religion']);


        // HR Management
        Route::resource('performance-review', PerformanceReviewController::class);
        Route::resource('travels', TravelController::class);
        Route::resource('timesheets', TimesheetController::class);
        Route::post('timesheets-start-time', [TimesheetController::class, 'recordTime'])->name('timesheets.record-time');

        // Time management
        Route::resource('leaves', LeaveController::class);
        Route::get('get-leaves', [LeaveController::class,'get_leave']);
        Route::resource('history-leave', HistoryLeaveController::class);
        Route::post('data-history-leaves',[HistoryLeaveController::class,'get_data'])->name('data-history-leaves');
        Route::resource('overtimes', OvertimeController::class);
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::post('time-management-report/export-pdf', [TimeManagementReportController::class, 'exportPdf'])->name('time-management.export');
        Route::resource('request-shift-schedule', ReqShiftScheduleController::class);
        Route::resource('shift-schedule', ShiftScheduleController::class);
        Route::resource('attendance', AttendanceEmployeeController::class);
        Route::get('bulk-attendance', [AttendanceEmployeeController::class, 'bulkAttendance'])->name('bulk-attendance.index');
        Route::post('bulk-attendance', [AttendanceEmployeeController::class, 'bulkAttendanceData'])->name('bulk-attendance.index');
        Route::post('clock-in-out', [AttendanceEmployeeController::class, 'clockStore'])->name('clock_store');
        Route::post('break-in-out', [AttendanceEmployeeController::class, 'breakStore'])->name('break_store');
        Route::resource('dayoff', DayoffController::class);
        Route::resource('company-holiday', CompanyHolidayController::class);
        Route::resource('level-approvals', LevelApprovalController::class);
        Route::post('company-holiday/import', [CompanyHolidayController::class, 'importExcel'])->name('import.excel.company-holiday');

        //Project
        Route::resource('projects', ProjectController::class);

        //Employee Request
        Route::get('employee-request', [EmployeeController::class, 'employeeRequest'])
                ->name('employee.request');
        Route::get('employee-request/{id}', [EmployeeController::class, 'dataRequest'])
                ->name('employee.request.data');
        Route::post('employee-request/approve', [EmployeeController::class, 'approveRequest'])
                ->name('employee.request.approve');
        Route::post('employee-request/reject/{id}', [EmployeeController::class, 'rejectRequest'])
                ->name('employee.request.reject');

        // Rotation employee
        Route::get('rotation-employee',[RotateController::class,'index'])->name('rotation-employee');
        Route::get('get-rotation-employee',[RotateController::class,'get_data_rotate'])->name('get-rotation-employee');
        Route::get('get-branch-select',[RotateController::class,'get_branch'])->name('get-branch-select');
        Route::post('save-data-rotation',[RotateController::class,'save_rotation'])->name('save-data-rotation');
        Route::post('edit-data-rotation',[RotateController::class,'edit'])->name('edit-data-rotation');
        Route::post('update-data-rotation',[RotateController::class,'update'])->name('update-data-rotation');

        /** departement */
        Route::resource('departements', DepartementController::class);
        /** departement */

        // Reporting
        Route::get('reporting-attandance-view',[ReportRecapAttendanceController::class,'index'])->name('reporting-attandance');
        Route::get('get-reporting-attandance',[ReportRecapAttendanceController::class,'get_report_attadance'])->name('get-reporting-attandance');
        Route::get('reporting-attandance-excel',[ReportRecapAttendanceController::class,'attandanceExportExcel'])->name('reporting-attandance-excel');
        Route::get('reporting-attandance-pdf',[ReportRecapAttendanceController::class,'attandancePrintPdf'])->name('reporting-attandance-pdf');
});

/*Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});*/

Route::fallback(function () {
        abort(404);
});
