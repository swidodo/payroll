<?php

use App\Http\Controllers\ReimburstmentOptionController;
use App\Http\Controllers\AttendanceEmployeeController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
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
use App\Http\Controllers\Rekap_pph21Controller;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SetPTKPController;
use App\Http\Controllers\BpjsController;
use App\Http\Controllers\Master_max_limit_bpjsController;
use App\Http\Controllers\DeductionBpjs;
use App\Http\Controllers\Allowance_otherController;
use App\Http\Controllers\PtkpController;
use App\Http\Controllers\GroupPositionController;
use App\Http\Controllers\PositionController;
// rotate
use App\Http\Controllers\RotateController;
use App\Http\Controllers\CompanyController;
// request && approval
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ThrController;

// report
use App\Http\Controllers\HRM\EmployeeReportController;
use App\Http\Controllers\Report\ReportRecapAttendanceController;
use App\Http\Controllers\Report\RekapPayrollController;

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
        Route::get('setup-aplication',[RolesController::class,'setup_app'])->name('setup-app');
        Route::post('create-permission',[RolesController::class,'add_permission'])->name('create-permission');
        Route::post('open-permission',[RolesController::class,'open_permission'])->name('open-permission');
        // ** setup company **//
        Route::get('setup-company',[CompanyController::class,'index'])->name('setup-company');
        Route::post('get-data',[CompanyController::class,'get_data'])->name('get-data');
        Route::post('store-company',[CompanyController::class,'store'])->name('get-company');
        Route::post('edit-company',[CompanyController::class,'edit'])->name('edit-company');
        Route::post('update-company',[CompanyController::class,'update'])->name('update-company');
        Route::post('destroy-company',[CompanyController::class,'destroy'])->name('destroy-company');
        
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
        // other allowance
        Route::get('allowance-other',[Allowance_otherController::class,'index'])->name('allowance-other');
        Route::post('get-allowance-other',[Allowance_otherController::class,'get_data'])->name('get-allowance-other');
        Route::post('store-allowance-other',[Allowance_otherController::class,'store'])->name('store-allowance-other');
        Route::post('edit-allowance-other',[Allowance_otherController::class,'edit'])->name('edit-allowance-other');
        Route::post('update-allowance-other',[Allowance_otherController::class,'update'])->name('update-allowance-other');
        Route::post('delete-allowance-other',[Allowance_otherController::class,'destroy'])->name('delete-allowance-other');

        // leave type
        Route::post('create-leave-type', [LeaveTypeController::class,'store'])->name('create-leave-type');

        //Finance
        Route::resource('reimburst', ReimburstController::class);
        Route::resource('cash', CashController::class);
        Route::resource('allowances', AllowanceController::class);

        // loans
        Route::resource('loans', LoanController::class);
        Route::post('get-list-installment',[LoanController::class,'get_data_installment'])
                ->name('get-list-installment');
        Route::post('get-list-loan',[LoanController::class,'get_data_castReceipt'])
                ->name('get-list-loan');
        Route::post('update-loan-installment',[LoanController::class,'update'])
                ->name('update-loan-installment');
        Route::post('update-loan',[LoanController::class,'update'])
                ->name('update-loan');
        Route::post('delete-loan',[LoanController::class,'destroy'])
                ->name('delete-loan');
        Route::post('delete-installment',[LoanController::class,'destroy'])
                ->name('delete-installment');


        Route::get('loan_cash_receipt',[LoanController::class,'installment'])->name('loan_cash_receipt');
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
        Route::get('ptkp', [PtkpController::class, 'index'])
                ->name('setting.ptkp.index');
        Route::post('get-ptkp', [PtkpController::class, 'get_data'])
                ->name('get-ptkp');
        Route::post('edit-ptkp', [PtkpController::class, 'edit'])
                ->name('edit-ptkp');
        Route::post('update-ptkp', [PtkpController::class, 'update'])
                ->name('update-ptkp'); 
        Route::post('save-ptkp', [PtkpController::class, 'store'])
                ->name('save-ptkp');
        Route::resource('set-ptkp', SetPTKPController::class);

        // rekap pph21 new
        Route::get('get-rekap-pph',[Rekap_pph21Controller::class,'index'])->name('get-rekap-pph');
        Route::post('data-rekap-pph',[Rekap_pph21Controller::class,'get_pph21'])->name('data-rekap-pph');
        Route::get('rekap-pph-pdf',[Rekap_pph21Controller::class,'cetak_pdf'])->name('rekap-pph-pdf');
        Route::get('rekap-pph-excel',[Rekap_pph21Controller::class,'ExportExcel'])->name('rekap-pph-excel');
        

        // payroll new
        Route::post('get-data-payroll',[PayrollController::class,'get_data'])->name('get-data-payroll');
        Route::post('payroll-addNew',[PayrollController::class,'store'])->name('payroll-addNew');
        Route::post('edit-data-payroll',[PayrollController::class,'edit'])->name('edit-data-payroll');
        Route::post('update-data-payroll',[PayrollController::class,'update'])->name('update-data-payroll');
        Route::post('delete-data-payroll',[PayrollController::class,'destroy'])->name('delete-data-payroll');
        // payslip new
        Route::get('salary-payroll',[PayrollController::class,'data_payroll_final'])->name('salary-payroll');
        Route::get('run-payroll',[PayrollController::class,'run_payroll'])->name('run-payroll');
        Route::post('get_run_payroll',[PayrollController::class,'get_run_payroll'])->name('get_run_payroll'); 
        Route::post('generate_run_payroll',[PayrollController::class,'generate_run_payroll'])->name('generate_run_payroll'); 
        Route::post('payroll-final',[PayrollController::class,'get_payroll_final'])->name('payroll-final');
        Route::get('generate_slip_payroll/{id}',[PayrollController::class,'generate_slip_payroll'])->name('generate_slip_payroll');
        Route::post('get-slip',[PayrollController::class,'get_slip'])->name('get-slip');

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
        Route::resource('history-leave', HistoryLeaveController::class);
        Route::post('data-history-leaves',[HistoryLeaveController::class,'get_data'])->name('data-history-leaves');
        Route::post('filter-leave-history',[HistoryLeaveController::class,'get_data_filter_employee'])->name('filter-leave-history');
        Route::get('get-leaves',[LeaveController::class,'get_leave'])->name('get-leaves');

        Route::resource('overtimes', OvertimeController::class);
        Route::post('get-list-overtime', [OvertimeController::class,'get_data'])->name('get-list-overtime');
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::post('time-management-report/export-pdf', [TimeManagementReportController::class, 'exportPdf'])->name('time-management.export');
        Route::resource('request-shift-schedule', ReqShiftScheduleController::class);
        Route::resource('shift-schedule', ShiftScheduleController::class);
        Route::resource('attendance', AttendanceEmployeeController::class);
        Route::post('data-attendance-employee', [AttendanceEmployeeController::class,'get_data'])->name('data-attendance-employee');
        Route::post('getList-employee-attendance', [AttendanceEmployeeController::class,'get_list_employee'])->name('getList-employee-attendance');
        Route::post('update-employee-attendance', [AttendanceEmployeeController::class,'update'])->name('update-employee-attendance');
        Route::post('get-employee-adjustment', [AttendanceEmployeeController::class,'get_employee_adustment'])->name('get-employee-adjustment');
        Route::post('ajdusment-attendance', [AttendanceEmployeeController::class,'ajdustment'])->name('ajdusment-attendance');
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
        Route::resource('departement', DepartementController::class);
        Route::get('get-data-departements',[DepartementController::class,'GetDataDepartements'])->name('departement.get-data-departements');
        Route::get('add-departement',[DepartementController::class,'create'])->name('add-departement');
        Route::post('store-departement',[DepartementController::class,'store'])->name('store-departement');
        Route::post('edit-departement',[DepartementController::class,'edit'])->name('edit-departement');
        Route::post('update-departement',[DepartementController::class,'update'])->name('update-departement');
        Route::post('destroy-departement',[DepartementController::class,'destroy'])->name('destroy-departement');
        /** departement */
        // group position
        Route::get('group-position', [GroupPositionController::class,'index'])->name('group-position');
        Route::post('get-group-position', [GroupPositionController::class,'get_data'])->name('get-group-position');
        Route::get('add-group-position', [GroupPositionController::class,'create'])->name('add-group-position');
        Route::post('get-option', [GroupPositionController::class,'get_option'])->name('get-option');
        Route::post('store-group-position', [GroupPositionController::class,'store'])->name('store-group-position');
        Route::post('edit-group-position', [GroupPositionController::class,'edit'])->name('edit-group-position');
        Route::post('update-group-position', [GroupPositionController::class,'update'])->name('update-group-position');
        Route::post('destroy-group-position', [GroupPositionController::class,'destroy'])->name('destroy-group-position');
        // position
        Route::get('position',[PositionController::class,'index'])->name('position');
        Route::post('get-position',[PositionController::class,'get_data'])->name('get-position');
        Route::get('add-position',[PositionController::class,'create'])->name('add-position');
        Route::post('store-position',[PositionController::class,'store'])->name('store-position');
        Route::post('edit-position',[PositionController::class,'edit'])->name('edit-position');
        Route::post('update-position',[PositionController::class,'update'])->name('update-position');
        Route::post('destroy-position',[PositionController::class,'destroy'])->name('destroy-position');
        // Reporting
        Route::get('reporting-attandance-view',[ReportRecapAttendanceController::class,'index'])->name('reporting-attandance');
        Route::get('get-reporting-attandance',[ReportRecapAttendanceController::class,'get_report_attadance'])->name('get-reporting-attandance');
        Route::get('reporting-attandance-excel',[ReportRecapAttendanceController::class,'attandanceExportExcel'])->name('reporting-attandance-excel');
        Route::get('reporting-attandance-pdf',[ReportRecapAttendanceController::class,'attandancePrintPdf'])->name('reporting-attandance-pdf');

        // Master bpjs
        Route::get('master-bpjs',[BpjsController::class,'index'])->name('master-bpjs');
        Route::post('get-master-bpjs',[BpjsController::class,'get_data'])->name('get-master-bpjs');
        Route::post('store-master-bpjs',[BpjsController::class,'store'])->name('store-master-bpjs');
        Route::post('edit-master-bpjs',[BpjsController::class,'edit'])->name('edit-master-bpjs');
        Route::post('update-mater-bpjs',[BpjsController::class,'update'])->name('update-mater-bpjs');
        Route::post('delete-master-bpjs',[BpjsController::class,'destroy'])->name('delete-master-bpjs');
        // Master limit bpjs
        Route::get('master-limit-bpjs',[Master_max_limit_bpjsController::class,'index'])->name('master-limit-bpjs');
        Route::post('get-master-limit-bpjs',[Master_max_limit_bpjsController::class,'get_data'])->name('get-master-limit-bpjs');
        Route::post('store-master-limit-bpjs',[Master_max_limit_bpjsController::class,'store'])->name('store-master-limit-bpjs');
        Route::post('edit-master-limit-bpjs',[Master_max_limit_bpjsController::class,'edit'])->name('edit-master-limit-bpjs');
        Route::post('update-master-limit-bpjs',[Master_max_limit_bpjsController::class,'update'])->name('update-master-limit-bpjs');
        Route::post('delete-master-limit-bpjs',[Master_max_limit_bpjsController::class,'destroy'])->name('delete-master-limit-bpjs');
        // deduction bpjs
        Route::get('get-data-bpjs',[DeductionBpjs::class,'index'])->name('get-data-bpjs');
        Route::post('data-bpjs-value',[DeductionBpjs::class,'get_data'])->name('data-bpjs-value');
        // THR
        Route::get('thr',[ThrController::class,'index'])->name('thr');
        // Rekap
        Route::get('rekap-attandance',[ReportRecapAttendanceController::class,'rekap_attendance'])->name('rekap-attandance');
        Route::post('get-rekap-attendance',[ReportRecapAttendanceController::class,'get_rekap_attendance'])->name('get-rekap-attendance');
        Route::get('rekap-attendance-pdf',[ReportRecapAttendanceController::class,'cetak_rekap_attendance_pdf'])->name('rekap-attendance-pdf');
        Route::get('rekap-attendance-excel',[ReportRecapAttendanceController::class,'ExportExcel'])->name('rekap-attendance-excel');
        Route::get('rekap-payroll',[RekapPayrollController::class,'index'])->name('rekap-payroll');
        Route::post('get-rekap-payroll',[RekapPayrollController::class,'get_rekap_payroll'])->name('get-rekap-payroll');
        Route::get('rekap-payroll-pdf',[RekapPayrollController::class,'cetak_pdf'])->name('rekap-payroll-pdf');
        Route::get('rekap-payroll-excel',[RekapPayrollController::class,'ExportExcel'])->name('rekap-payroll-excel');
        // request
        Route::get('request-employee',[RequestController::class,'index'])->name('request-employee');
        Route::post('get-request',[RequestController::class,'get_data'])->name('get-request');
        Route::get('add-request-employee',[RequestController::class,'create'])->name('add-request');
        Route::post('store-request',[RequestController::class,'store'])->name('store-request');
        Route::post('get-day-type',[RequestController::class,'get_daytype'])->name('get-day-type');
        Route::post('get-leave-type',[RequestController::class,'get_leavetype'])->name('get-leave-type');
        Route::post('get-approve-leave',[RequestController::class,'approve_leave'])->name('get-approve-leave');
        Route::post('get-approve-overtime',[RequestController::class,'approve_overtime'])->name('get-approve-overtime');
        Route::post('get-approve-timesheet',[RequestController::class,'approve_timesheet'])->name('get-approve-timesheet');
        Route::post('get-approve-attendance',[RequestController::class,'approve_attendance'])->name('get-approve-attendance');
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
