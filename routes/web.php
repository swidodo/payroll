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
// deduction other
use App\Http\Controllers\DeductionOtherController;
use App\Http\Controllers\DeductionadminController;
//template payroll
use App\Http\Controllers\template\Template_v1Controller;
use App\Http\Controllers\template\Template_v2Controller;
use App\Http\Controllers\template\Template_v3Controller;
use App\Http\Controllers\template\Template_v4Controller;
use App\Http\Controllers\template\Template_v5Controller;
use App\Http\Controllers\template\Template_v6Controller;
use App\Http\Controllers\template\Template_v7Controller;
use App\Http\Controllers\template\Template_v8Controller;
use App\Http\Controllers\template\Template_v9Controller;
use App\Http\Controllers\template\Template_v10Controller;
use App\Http\Controllers\template\Template_v11Controller;
use App\Http\Controllers\template\Template_v12Controller;
use App\Http\Controllers\template\Template_v13Controller;
use App\Http\Controllers\template\Template_v14Controller;
use App\Http\Controllers\template\Template_v16Controller;
use App\Http\Controllers\template\Template_v17Controller;
use App\Http\Controllers\template\Template_v18Controller;
use App\Http\Controllers\template\Template_v19BoronganController;
use App\Http\Controllers\template\Template_v23Controller;
use App\Http\Controllers\template\Template_v24Controller;
use App\Http\Controllers\template\Template_v25Controller;
// report
use App\Http\Controllers\HRM\EmployeeReportController;
use App\Http\Controllers\Report\ReportRecapAttendanceController;
use App\Http\Controllers\Report\RekapPayrollController;
use App\Http\Controllers\Report\RekapDailyReportController;
use App\Http\Controllers\DailyReportController;
// unisment
use App\Http\Controllers\InformationController;
use App\Http\Controllers\EvenController;

// access branch
use App\Http\Controllers\AccessBranchController;
use App\Http\Controllers\AccessTemplateController;
// access mobile
use App\Http\Controllers\AccessMobileController;

// montly-rate pph21
use App\Http\Controllers\MontlyRateController;
use App\Http\Controllers\ApprovalController;


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
        Route::post('get_report_timesheet',[DashboardController::class,'get_report_timesheet'])->name('get_report_timesheet');
        Route::post('get_report_birtday',[DashboardController::class,'get_birtday'])->name('get_report_birtday');
        
        // user
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::post('get-data-user', [UsersController::class,'get_data'])->name('get-data-user');
        Route::post('add-user-data', [UsersController::class,'add_user_data'])->name('add-user-data');
        Route::post('store-user', [UsersController::class,'store'])->name('store-user');
        Route::post('edit-user', [UsersController::class,'edit'])->name('edit-user');
        Route::post('update-user', [UsersController::class,'update'])->name('update-user');
        Route::post('destroy-user', [UsersController::class,'destroy'])->name('update-user');
        Route::get('change_password',[UsersController::class,'change_pass'])->name('change_password');
        Route::post('change-password-new',[UsersController::class,'change_password_new'])->name('change-password-new');
        Route::post('change_store',[UsersController::class,'change_store'])->name('change_store');
        // role
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
        Route::get('create_employee',[EmployeeController::class,'create_employee'])->name('add-employee');
        Route::post('save-create-employee',[EmployeeController::class,'save_create_employee'])->name('save-create-employee');
        Route::post('get-data-employees',[EmployeeController::class,'GetDataEmployees'])->name('employees.get-data-employees');
        Route::post('contract-store',[EmployeeController::class,'Store_LogContract'])->name('contract-store');
        Route::post('edit-log_contract',[EmployeeController::class,'edit_Store_LogContract'])->name('edit-log_contract');
        Route::post('update-contract',[EmployeeController::class,'update_Store_LogContract'])->name('update-contract');
        Route::post('delete-contract',[EmployeeController::class,'destroy_Store_LogContract'])->name('delete-contract');

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
        Route::post('get-data-allowance-option', [AllowanceOptionController::class,'get_data'])->name('get-data-allowance-option');
        Route::post('delete-allowance-option', [AllowanceOptionController::class,'destroy'])->name('delete-allowance-option');
        
        // montly rate table ter pph21
        Route::get('ter-monthly-rate', [MontlyRateController::class,'index'])->name('ter-monthly-rate');
        Route::post('edit-data-rate', [MontlyRateController::class,'edit_rate_absolute_employee'])->name('edit-data-rate');
        Route::post('update-data-ter-absolute', [MontlyRateController::class,'update_rate_absolute_employee'])->name('update-data-ter-absolute');
        Route::get('ter-categoryA-monthly-rate', [MontlyRateController::class,'categoryA'])->name('ter-categoryA-monthly-rate');
        Route::get('ter-categoryB-monthly-rate', [MontlyRateController::class,'categoryB'])->name('ter-categoryB-monthly-rate');
        Route::get('ter-categoryC-monthly-rate', [MontlyRateController::class,'categoryC'])->name('ter-categoryC-monthly-rate');
        Route::get('ter-category-daily-rate', [MontlyRateController::class,'daily_rate'])->name('ter-category-daily-rate');
        Route::post('edit-data-ter', [MontlyRateController::class,'edit'])->name('edit-data-ter');
        Route::post('update-data-ter', [MontlyRateController::class,'update'])->name('update-data-ter');

        // other allowance
        Route::get('allowance-other',[Allowance_otherController::class,'index'])->name('allowance-other');
        Route::post('get-allowance-other',[Allowance_otherController::class,'get_data'])->name('get-allowance-other');
        Route::post('store-allowance-other',[Allowance_otherController::class,'store'])->name('store-allowance-other');
        Route::post('edit-allowance-other',[Allowance_otherController::class,'edit'])->name('edit-allowance-other');
        Route::post('update-allowance-other',[Allowance_otherController::class,'update'])->name('update-allowance-other');
        Route::post('delete-allowance-other',[Allowance_otherController::class,'destroy'])->name('delete-allowance-other');
        Route::post('get-allow-emp',[Allowance_otherController::class,'get_employee'])->name('');

        // leave type
        Route::post('create-leave-type', [LeaveTypeController::class,'store'])->name('create-leave-type');

        //Finance
        Route::resource('reimburst', ReimburstController::class);
        Route::post('get-data-reimburse', [ReimburstController::class,'get_data'])->name('get-data-reimburse');
        Route::post('store-reimbursment', [ReimburstController::class,'store'])->name('store-reimbursment');
        Route::post('add-data-reimburse', [ReimburstController::class,'get_data_employee'])->name('add-data-reimburse');
        Route::post('edit-data-reimburse', [ReimburstController::class,'edit'])->name('edit-data-reimburse');
        Route::post('update-reimbursment', [ReimburstController::class,'update'])->name('update-reimbursment');
        Route::post('destroy-reimburse', [ReimburstController::class,'destroy'])->name('destroy-reimburse');
        Route::resource('cash', CashController::class);
        Route::resource('allowances', AllowanceController::class);

        // loans
        Route::resource('loans', LoanController::class);
        Route::post('get-list-installment',[LoanController::class,'get_data_installment'])
                ->name('get-list-installment');
        Route::post('get-list-loan',[LoanController::class,'get_data_castReceipt'])
                ->name('get-list-loan');
        Route::post('get-emp-loan',[LoanController::class,'get_employee'])->name('get-emp-loan');
        Route::post('update-loan-installment',[LoanController::class,'update'])
                ->name('update-loan-installment');
        Route::post('update-loan',[LoanController::class,'update'])
                ->name('update-loan');
        Route::post('delete-loan',[LoanController::class,'destroy'])
                ->name('delete-loan');
        Route::post('delete-installment',[LoanController::class,'destroy'])
                ->name('delete-installment');


        Route::get('loan_cash_receipt',[LoanController::class,'installment'])->name('loan_cash_receipt');
        // Route::get('set-bpjstk', [PayrollController::class, 'indexSetBpjsTk'])->name('set-bpjstk.index');
        // Route::get('set-bpjstk/{id}/edit', [PayrollController::class, 'editSetBpjsTk'])
        //         ->name('set-bpjstk.edit');
        // Route::put('set-bpjstk/{id}/update', [PayrollController::class, 'updateSetBpjsTk'])
        //         ->name('set-bpjstk.update');
        // Route::post('set-bpjstk', [PayrollController::class, 'storeSetBpjsTk'])
        //         ->name('set-bpjstk.store');
        // Route::delete('set-bpjstk/{id}/destroy', [PayrollController::class, 'destroySetBpjsTk'])
                // ->name('set-bpjstk.destroy');

        // Payroll
        Route::resource('payroll', PayrollController::class);
        Route::resource('payslips', PaySlipController::class);
        // Route::post('/payslips/generate-slip/{employee}', [PaySlipController::class, 'downloadSlip'])
        //         ->name('payslips.generate-slip');
        // Route::post('/payslips/show-slip/{employee}', [PaySlipController::class, 'showSlip'])
        //         ->name('payslips.show-slip');
        // Route::get('/payslips/download-pdf/{payslipEmployee}', [PaySlipController::class, 'downloadPDF'])
        //         ->name('payslips.downloadPDF');
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
        Route::post('get-data-setpayroll',[PayrollController::class,'get_data_setpayroll'])->name('get-data-setpayroll');
        Route::post('get-data-payroll',[PayrollController::class,'get_data'])->name('get-data-payroll');
        Route::post('payroll-addNew',[PayrollController::class,'store'])->name('payroll-addNew');
        Route::post('edit-data-payroll',[PayrollController::class,'edit'])->name('edit-data-payroll');
        Route::post('update-data-payroll',[PayrollController::class,'update'])->name('update-data-payroll');
        Route::post('delete-data-payroll',[PayrollController::class,'destroy'])->name('delete-data-payroll');
        Route::get('export-payroll-pdf',[PayrollController::class,'ExportPayrollPdf'])->name('export-payroll-pdf');
        
        // payslip new
        Route::get('salary-payroll',[PayrollController::class,'data_payroll_final'])->name('salary-payroll');
        Route::get('run-payroll',[PayrollController::class,'run_payroll'])->name('run-payroll');
        Route::post('get_run_payroll',[PayrollController::class,'get_run_payroll'])->name('get_run_payroll'); 
        Route::post('generate_run_payroll',[PayrollController::class,'generate_run_payroll'])->name('generate_run_payroll'); 
        Route::post('payroll-final',[PayrollController::class,'get_payroll_final'])->name('payroll-final');
        Route::get('generate_slip_payroll/{id}',[PayrollController::class,'generate_slip_payroll'])->name('generate_slip_payroll');
        Route::post('get-slip',[PayrollController::class,'get_slip'])->name('get-slip');
        Route::get('get-list-bpjs',[PayrollController::class,'list_bpjs'])->name('get-list-bpjs');

        // template import payroll
        Route::post('import-payroll',[PayrollController::class,'import_run_payroll'])->name('import-payroll');
        Route::post('import-payroll-v1',[Template_v1Controller::class,'index'])->name('import-payroll-v1');
        Route::post('import-payroll-v2',[Template_v2Controller::class,'index'])->name('import-payroll-v2');
        Route::post('import-payroll-v3',[Template_v3Controller::class,'index'])->name('import-payroll-v3');
        Route::post('import-payroll-v4',[Template_v4Controller::class,'index'])->name('import-payroll-v4');
        Route::post('import-payroll-v5',[Template_v5Controller::class,'index'])->name('import-payroll-v5');
        Route::post('import-payroll-v6',[Template_v6Controller::class,'index'])->name('import-payroll-v6');
        Route::post('import-payroll-v7',[Template_v7Controller::class,'index'])->name('import-payroll-v7');
        Route::post('import-payroll-v8',[Template_v8Controller::class,'index'])->name('import-payroll-v8');
        Route::post('import-payroll-v9',[Template_v9Controller::class,'index'])->name('import-payroll-v9');
        Route::post('import-payroll-v10',[Template_v10Controller::class,'index'])->name('import-payroll-v10');
        Route::post('import-payroll-v11',[Template_v11Controller::class,'index'])->name('import-payroll-v11');
        Route::post('import-payroll-v12',[Template_v12Controller::class,'index'])->name('import-payroll-v12');
        Route::post('import-payroll-v13',[Template_v13Controller::class,'index'])->name('import-payroll-v13');
        Route::post('import-payroll-v14',[Template_v14Controller::class,'index'])->name('import-payroll-v14');
        Route::post('import-payroll-v16',[Template_v16Controller::class,'index'])->name('import-payroll-v16');
        Route::post('import-payroll-v17',[Template_v17Controller::class,'index'])->name('import-payroll-v17');
        Route::post('import-payroll-v18',[Template_v18Controller::class,'index'])->name('import-payroll-v18');
        Route::post('import-payroll-v19',[Template_v19BoronganController::class,'index'])->name('import-payroll-v19');
        Route::post('import-payroll-v23',[Template_v23Controller::class,'index'])->name('import-payroll-v23');
        Route::post('import-payroll-v24',[Template_v24Controller::class,'index'])->name('import-payroll-v24');
        Route::post('import-payroll-v25',[Template_v25Controller::class,'index'])->name('import-payroll-v25');
        
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
        // deduction other
        Route::get('deduction-other', [DeductionOtherController::class, 'index'])->name('deduction-other');
        Route::post('get-deduction-other', [DeductionOtherController::class, 'get_data'])->name('get-deduction-other');
        Route::post('store-deduction-other', [DeductionOtherController::class, 'store'])->name('store-deduction-other');
        Route::post('get-employee-deduction-other', [DeductionOtherController::class, 'create'])->name('get-employee-deduction-other');
        Route::post('edit-deduction-other', [DeductionOtherController::class, 'edit'])->name('edit-deduction-other');
        Route::post('update-deduction-other', [DeductionOtherController::class, 'update'])->name('update-deduction-other');
        Route::post('delete-deduction-other', [DeductionOtherController::class, 'destroy'])->name('delete-deduction-other');
        // deduction fixed
        Route::get('deduction-admin', [DeductionadminController::class, 'index'])->name('deduction-admin');
        Route::post('get-deduction-admin', [DeductionadminController::class, 'get_data'])->name('get-deduction-admin');
        Route::post('store-deduction-admin', [DeductionadminController::class, 'store'])->name('store-deduction-admin');
        Route::post('edit-deduction-admin', [DeductionadminController::class, 'edit'])->name('edit-deduction-admin');
        Route::post('update-deduction-admin', [DeductionadminController::class, 'update'])->name('update-deduction-admin');
        Route::post('delete-deduction-admin', [DeductionadminController::class, 'destroy'])->name('delete-deduction-admin');
        
        // Attendance
        // Route::post('import-excel-attendance', [AttendanceEmployeeController::class, 'importExcel'])->name('import.excel.attendace');
        Route::post('import-excel-attendance', [AttendanceEmployeeController::class, 'importExcel'])->name('import-excel-attendance');
        Route::post('delete-attendance', [AttendanceEmployeeController::class, 'destroy'])->name('delete-attendance');
        Route::get('location-attendance-maps/{id}', [AttendanceEmployeeController::class, 'view_maps'])->name('location-attendance-maps');

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
        Route::post('get-dept-posit',[EmployeeController::class,'get_department_position_ByBranch'])->name('get-dept-posit');

        // report Employee
        Route::post('import-employee-excel', [EmployeeController::class, 'import_data'])->name('import-employee-excel');
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
        Route::get('chart-employee_department', [EmployeeReportController::class, 'employee_department']);
        Route::get('chart-report-employee', [EmployeeReportController::class, 'report_totalemployee']);
        Route::get('chart-report-employee-year', [EmployeeReportController::class, 'report_employee_in_year']);
        // report
        Route::get('remainder-contract',[EmployeeReportController::class,'report_contract'])->name('remainder-contract');
        Route::post('get-report-contract',[EmployeeReportController::class,'get_turnover_report'])->name('get-report-contract');
        Route::get('report-turnover',[EmployeeReportController::class,'rekap_turnover'])->name('report-turnover');
        Route::post('get-rekap-turnover',[EmployeeReportController::class,'get_data_rekap'])->name('get-rekap-turnover');


        // HR Management
        Route::resource('performance-review', PerformanceReviewController::class);
        Route::resource('travels', TravelController::class);
        Route::resource('timesheets', TimesheetController::class);
        Route::post('timesheets-start-time', [TimesheetController::class, 'recordTime'])->name('timesheets.record-time');
        Route::post('filter-branch-timesheets', [TimesheetController::class, 'filter_branch'])->name('filter-branch-timesheets');
        Route::post('get-emp-timesheet', [TimesheetController::class, 'get_employee_byBranch'])->name('get-emp-timesheet');
        Route::post('delete-timesheet', [TimesheetController::class, 'destroy'])->name('delete-timesheet');

        // Time management
        Route::resource('leaves', LeaveController::class);
        Route::resource('history-leave', HistoryLeaveController::class);
        Route::post('data-history-leaves',[HistoryLeaveController::class,'get_data'])->name('data-history-leaves');
        Route::post('filter-leave-history',[HistoryLeaveController::class,'get_data_filter_employee'])->name('filter-leave-history');
        Route::post('get-leaves',[LeaveController::class,'get_leave'])->name('get-leaves');
        Route::post('add-request-leave',[LeaveController::class,'request_manage_leave'])->name('add-request-leave');
        Route::post('store-leave',[LeaveController::class,'store'])->name('store-leave');
        Route::post('edit-leave',[LeaveController::class,'edit'])->name('edit-leave');
        Route::post('update-leave',[LeaveController::class,'update'])->name('update-leave');
        Route::post('delete-leave',[LeaveController::class,'destroy'])->name('delete-leave');
        Route::post('get-total-leave',[LeaveController::class,'get_total_leave'])->name('get-total-leave');

        Route::resource('overtimes', OvertimeController::class);
        Route::post('get-list-overtime', [OvertimeController::class,'get_data'])->name('get-list-overtime');
        Route::post('get-overtime-employee', [OvertimeController::class,'get_employee'])->name('get-overtime-employee');
        Route::post('edit-overtime', [OvertimeController::class,'edit'])->name('edit-overtime');
        Route::post('update-overtime', [OvertimeController::class,'update'])->name('update-overtime');
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::resource('time-management-report', TimeManagementReportController::class);
        Route::post('time-management-report/export-pdf', [TimeManagementReportController::class, 'exportPdf'])->name('time-management.export');
        Route::resource('request-shift-schedule', ReqShiftScheduleController::class);
        Route::resource('shift-schedule', ShiftScheduleController::class);
        Route::post('upload-schedule',[ShiftScheduleController::class,'importSchedule'])->name('upload-schedule');
        
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
        Route::get('attendance-user', [AttendanceEmployeeController::class, 'attendance_user'])->name('attendance-list');
        Route::post('search-attendance', [AttendanceEmployeeController::class, 'attendance_search'])->name('search-attendance');
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
        Route::post('get-rotation-employee',[RotateController::class,'get_data_rotate'])->name('get-rotation-employee');
        Route::post('get-branch-select',[RotateController::class,'get_branch'])->name('get-branch-select');
        Route::post('save-data-rotation',[RotateController::class,'save_rotation'])->name('save-data-rotation');
        Route::post('edit-data-rotation',[RotateController::class,'edit'])->name('edit-data-rotation');
        Route::post('update-data-rotation',[RotateController::class,'update'])->name('update-data-rotation');

        /** departement */
        Route::resource('departement', DepartementController::class);
        Route::post('get-data-departements',[DepartementController::class,'GetDataDepartements'])->name('departement.get-data-departements');
        Route::get('add-departement',[DepartementController::class,'create'])->name('add-departement');
        Route::post('store-departement',[DepartementController::class,'store'])->name('store-departement');
        Route::post('edit-departement',[DepartementController::class,'edit'])->name('edit-departement');
        Route::post('update-departement',[DepartementController::class,'update'])->name('update-departement');
        Route::post('destroy-departement',[DepartementController::class,'destroy'])->name('destroy-departement');
        Route::post('import-department',[DepartementController::class,'importExcelDepartment'])->name('import-department');
        
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
        Route::post('import-position',[PositionController::class,'importExcelPosition'])->name('import-position');
        
        // Reporting
        Route::get('reporting-attandance-view',[ReportRecapAttendanceController::class,'index'])->name('reporting-attandance');
        Route::get('get-reporting-attandance',[ReportRecapAttendanceController::class,'get_report_attadance'])->name('get-reporting-attandance');
        Route::get('reporting-attandance-excel',[ReportRecapAttendanceController::class,'attandanceExportExcel'])->name('reporting-attandance-excel');
        Route::get('reporting-attandance-pdf',[ReportRecapAttendanceController::class,'attandancePrintPdf'])->name('reporting-attandance-pdf');
        Route::get('rekap_monthly_att',[AttendanceEmployeeController::class,'rekap_cutoff_montnly'])->name('rekap_monthly_att');
        Route::post('rekap_monthly_filter',[AttendanceEmployeeController::class,'rekap_cutoff_montnly'])->name('rekap_monthly_filter');
        Route::post('get_data_monthly',[AttendanceEmployeeController::class,'get_data_monthly'])->name('get_data_monthly');
        // daily report
        Route::get('daily-report',[DailyReportController::class,'index'])->name('daily-report');
        Route::post('get-daily-report',[DailyReportController::class,'get_data'])->name('get-daily-report');
        Route::post('get-daily-report',[DailyReportController::class,'get_data'])->name('get-daily-report');
        Route::get('maps',[DailyReportController::class,'view_maps'])->name('maps');
        Route::post('branch-depart',[DailyReportController::class,'get_depart'])->name('branch-depart');
        Route::post('get-emp-depart',[DailyReportController::class,'get_employee'])->name('get-emp-depart');
        Route::post('export-report-daily',[RekapDailyReportController::class,'ExportExcel'])->name('export-report-daily');

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
        Route::post('get-thr',[ThrController::class,'get_data'])->name('get-thr');
        Route::post('generate-thr',[ThrController::class,'generate_store'])->name('generate-thr');
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
        // my profile
        Route::get('get-my-profile',[EmployeeController::class,'my_profile'])->name('get-my-profile');
        Route::post('change-profile',[EmployeeController::class,'change_profile'])->name('change-profile');
        // access branch
        Route::get('access-branch',[AccessBranchController::class,'index'])->name('access-branch');
        Route::get('create-access-branch',[AccessBranchController::class,'create'])->name('create-access-branch');
        Route::post('get-access-branch',[AccessBranchController::class,'get_data'])->name('get-access-branch');
        Route::post('setup-access-branch',[AccessBranchController::class,'get_employee'])->name('setup-access-branch');
        Route::post('store-access-branch',[AccessBranchController::class,'store'])->name('store-access-branch');
        Route::get('edit-access-branch/{id}',[AccessBranchController::class,'edit'])->name('edit-access-branch');
        Route::post('edit-access-branch/update-access-branch',[AccessBranchController::class,'update'])->name('update-access-branch');
        Route::post('delete-access-branch',[AccessBranchController::class,'destroy'])->name('delete-access-branch');
        // access template
        Route::get('access-template',[AccessTemplateController::class,'index'])->name('access-template');
        Route::post('get-access-template',[AccessTemplateController::class,'get_data'])->name('get-access-template');
        Route::post('get-branch-company',[AccessTemplateController::class,'get_branch'])->name('get-branch-company');
        Route::get('create-access-template',[AccessTemplateController::class,'create'])->name('create-access-template');
        Route::post('store-template',[AccessTemplateController::class,'store'])->name('store-template');
        Route::get('edit-access-template/{id}',[AccessTemplateController::class,'edit'])->name('edit-access-template');
        Route::post('edit-access-template/update-template',[AccessTemplateController::class,'update'])->name('update-template');
        Route::post('get-template-branch',[AccessTemplateController::class,'get_template_branch'])->name('get-template-branch');
        // access mobile
        Route::get('access-mobile',[AccessMobileController::class,'index'])->name('access-mobile');
        Route::post('get-access-mobile',[AccessMobileController::class,'get_data'])->name('get-access-mobile');
        Route::post('store-menu',[AccessMobileController::class,'store_menu'])->name('store-menu');
        Route::post('get-company-branch',[AccessMobileController::class,'get_branch'])->name('get-company-branch');
        Route::post('get-company-filter',[AccessMobileController::class,'get_branch_filter'])->name('get-company-filter');
        Route::post('store-access-menu',[AccessMobileController::class,'store_accessMenu'])->name('store-access-menu');
        Route::get('create-access-mobile',[AccessMobileController::class,'create'])->name('create-access-mobile');
        Route::get('edit-access-mobile/{id}',[AccessMobileController::class,'edit'])->name('edit-access-mobile');
        Route::post('edit-access-mobile/update-access-menu',[AccessMobileController::class,'update'])->name('update-access-menu');
        Route::post('delete-access-mobile',[AccessMobileController::class,'destroy'])->name('delete-access-mobile');
        // announcement
        Route::get('get-announcement',[InformationController::class,'index'])->name('get-announcement');
        Route::post('get-data-announcement',[InformationController::class,'get_data'])->name('get-data-announcement');
        Route::get('create-announcement',[InformationController::class,'create'])->name('create-announcement');
        Route::post('save-announcement',[InformationController::class,'store'])->name('save-announcement');
        Route::get('edit-announcement/{id}',[InformationController::class,'edit']);
        Route::post('update-announcement',[InformationController::class,'update'])->name('update-announcement');
        Route::post('destroy-announcement',[InformationController::class,'destroy'])->name('destroy-announcement');
        Route::post('publish-announcement',[InformationController::class,'publish'])->name('publish-announcement');
        Route::post('get-notif',[InformationController::class,'get_notif'])->name('get-notif');
        Route::post('clear-notif',[InformationController::class,'clear_notif'])->name('clear-notif');
        Route::get('list-inbox',[InformationController::class,'list_notif'])->name('list-inbox');
        Route::get('/view-inbox/{id}',[InformationController::class,'view_notif'])->name('view-inbox');
        Route::get('payslip-user',[PaySlipController::class,'payslip_user'])->name('payslip-user');
        // even
        Route::get('get-even',[EvenController::class,'index'])->name('get-even');
        Route::post('get-data',[EvenController::class,'get_data'])->name('get-data');
        Route::get('create-even',[EvenController::class,'create'])->name('create-even');
        Route::post('save-even',[EvenController::class,'store'])->name('save-even');
        Route::get('edit-even/{id}',[EvenController::class,'edit']);
        Route::post('update-even',[EvenController::class,'update'])->name('update-even');
        Route::post('destroy-even',[EvenController::class,'destroy'])->name('destroy-even');
        Route::post('publish-even',[EvenController::class,'publish'])->name('publish-even');
        // Route::post('get-notif',[EvenController::class,'get_notif'])->name('get-notif');
        // Route::post('clear-notif',[EvenController::class,'clear_notif'])->name('clear-notif');
        // Route::get('list-inbox',[EvenController::class,'list_notif'])->name('list-inbox');
        // Route::get('/view-inbox/{id}',[EvenController::class,'view_notif'])->name('view-inbox');
        // Route::get('payslip-user',[PaySlipController::class,'payslip_user'])->name('payslip-user');
        // approval
        Route::get('level-approval',[ApprovalController::class,'index'])->name('level-approval');
        Route::post('get-data-level',[ApprovalController::class,'get_data']);
        Route::post('get-depart',[ApprovalController::class,'create_data']);
        Route::post('get-employee-dept',[ApprovalController::class,'get_data_emp']);
        Route::post('store-approval',[ApprovalController::class,'store']);
        Route::post('edit-approval',[ApprovalController::class,'edit']);
        Route::post('update-approval',[ApprovalController::class,'update']);
        Route::post('delete-approval',[ApprovalController::class,'destroy']);
        Route::post('action-need',[ApprovalController::class,'list_approval']);

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
