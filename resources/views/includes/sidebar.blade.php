<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                <ul class="list-inline-item list-unstyled links">
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="{{route('dashboard')}}"><i class="la la-dashboardfinance {{(request()->routeIs('/')) ? 'active' : ''}}"></i> <span> Dashboard</span>
                            {{-- <span class="menu-arrow"></span> --}}
                       </a>
                        {{-- <ul style="display: none;">
                            <li><a  href="">Admin Dashboards</a></li>
                            <li><a  href="employee-dashboard.html">Employee Dashboard</a></li>
                        </ul> --}}
                    </li>
                </ul>
            </nav>
            <ul class="sidebar-vertical">
                {{-- <li class="menu-title">
                    <span>Main</span>
                </li> --}}
                <li class=" {{(request()->routeIs('dashboard')) ? 'active' : ''}}">
                    <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span>
                        {{-- <span class="menu-arrow"></span> --}}
                   </a>

                </li>
                @canany(['manage employee', 'view employee', 'edit employee', 'delete employee', 'manage employee profile', 'show employee profile'])
                <li class="submenu">
                    <a href="#"><i class="la la-clock"></i> <span>Employee</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}">
                            <a class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}" href="{{route('employees.index')}}"><i class="la la-users"></i> <span>Employees</span>
                            </a>
                        </li>
                        @canany(['view rotation','create rotation','edit rotation','delete rotation'])
                        <li class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}">
                            <a class=" {{(request()->routeIs('rotation*')) ? 'active' : ''}}" href="{{route('rotation-employee')}}"><i class="la la-users"></i> <span>Rotation</span>
                            </a>
                        </li>
                        @endcanany
                    </ul>
                </li>
                @endcanany

                @canany(['manage on duty', 'create on duty', 'view history leave', 'manage leave', 'create leave', 'manage overtime', 'create overtime', 'manage request shift schedule', 'create request shift schedule', 'manage attendance', 'create attendance', 'manage timesheet', 'create timesheet', 'show shift schedule', 'manage dayoff', 'create dayoff',  'show employee request', 'manage company holiday', 'create company holiday'])
                    <li class="submenu">
                        <a href="#"><i class="la la-clock"></i> <span> Time Management</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @canany(['manage attendance', 'create attendance', 'edit attendance', 'delete attendance'])
                                <li class="submenu ">
                                    <a style="padding: 9px 10px 9px 44px" href="#"> <span> Attendance</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        @canany(['manage attendance'])
                                            <li class="{{(request()->routeIs('attendance*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('attendance*')) ? 'active' : ''}}" href="{{ route('attendance.index') }}">Attendance List</a></li>
                                        @endcanany
                                        <!-- @canany(['create attendance'])
                                            <li class="{{(request()->routeIs('bulk-attendance*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('bulk-attendance*')) ? 'active' : ''}}" href="{{ route('bulk-attendance.index') }}">Bulk Attendance</a></li>
                                        @endcanany -->
                                    </ul>
                                </li>
                            @endcanany
                            
                            @canany(['manage dayoff', 'create dayoff'])
                                <li class="{{(request()->routeIs('dayoff*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('dayoff*')) ? 'active' : ''}}" href="{{ route('dayoff.index') }}">Time Off</a></li>
                            @endcanany

                            @canany(['manage leave', 'create leave', 'edit leave', 'delete leave'])
                                <li class="{{(request()->routeIs('leaves*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('leaves*')) ? 'active' : ''}}" href="{{ route('leaves.index') }}">Leave</a></li>
                            @endcanany
<!-- 
                            @canany(['view history leave'])
                                <li class="{{(request()->routeIs('history-leave*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('history-leave*')) ? 'active' : ''}}" href="{{ route('history-leave.index') }}">Histroy Leave</a></li>
                            @endcanany -->

                            @canany(['manage overtime', 'create overtime', 'edit overtime', 'delete overtime'])
                                <li class="{{(request()->routeIs('overtimes*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('overtimes*')) ? 'active' : ''}}" href="{{ route('overtimes.index') }}">Overtime</a></li>
                            @endcanany

                           <!--  @canany(['manage request shift schedule', 'create request shift schedule', 'edit request shift schedule', 'delete request shift schedule'])
                                <li class="{{(request()->routeIs('request-shift-schedule*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('request-shift-schedule*')) ? 'active' : ''}}" href="{{ route('request-shift-schedule.index') }}">Request Schedule</a></li>
                            @endcanany -->

                             @canany(['manage request shift schedule', 'create request shift schedule', 'edit request shift schedule', 'delete request shift schedule'])
                                <li class="{{(request()->routeIs('shift-schedule*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('shift-schedule*')) ? 'active' : ''}}" href="{{ route('shift-schedule.index') }}">Shift Schedule</a></li>
                            @endcanany

                            @canany(['manage timesheet', 'create timesheet', 'edit timesheet', 'delete timesheet'])
                                <li class="{{(request()->routeIs('timesheets*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('timesheets*')) ? 'active' : ''}}" href="{{ route('timesheets.index') }}">Time Sheet</a></li>
                            @endcanany

                            <!-- @canany(['show employee request'])
                                <li class=" {{(request()->routeIs('employee.request')) ? 'active' : ''}}">
                                    <a class="{{(request()->routeIs('employee.request*')) ? 'active' : ''}}" href="{{route('employee.request')}}"> Employee Request
                                </a>
                                </li>
                            @endcanany -->

                            <!-- @canany(['manage on duty', 'create on duty', 'edit on duty', 'delete on duty'])
                                <li class="{{(request()->routeIs('travels*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('travels*')) ? 'active' : ''}}" href="{{ route('travels.index') }}">On Duty</a></li>
                            @endcanany -->

                            

                            @canany(['manage company holiday', 'create company holiday'])
                                <li class="{{(request()->routeIs('company-holiday*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('company-holiday*')) ? 'active' : ''}}" href="{{ route('company-holiday.index') }}">Calender</a></li>
                            @endcanany

                             @canany(['manage request', 'create request', 'edit request'])
                                <li class="{{(request()->routeIs('request-employee*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('request-employee*')) ? 'active' : ''}}" href="{{ route('request-employee') }}">Request</a></li>
                            @endcanany 

                        </ul>
                    </li>
                @endcanany

                @canany(['manage performance review', 'create performance review', 'edit performance review', 'delete performance review', 'manage project', 'create project'])
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> HR Management</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @canany(['manage performance review', 'create performance review', 'edit performance review', 'delete performance review'])
                                <li class="{{(request()->routeIs('performance-review*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('performance-review*')) ? 'active' : ''}}" href="{{ route('performance-review.index') }}">KPI</a></li>
                            @endcanany
                            @canany(['manage project', 'create project'])
                                <li class=" {{(request()->routeIs('projects*')) ? 'active' : ''}}">
                                    <a class=" {{(request()->routeIs('projects*')) ? 'active' : ''}}" href="{{route('projects.index')}}">Talent
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['manage reimburst', 'create reimburst', 'manage cash advance', 'create cash advance', 'manage loan', 'create loan', 'manage allowance', 'create allowance'])
                    <li class="submenu">
                        <a href="#"><i class="la la-usd"></i> <span> Finance</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @canany(['manage payroll', 'create payroll'])
                                <li class="{{(request()->routeIs('payroll*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payroll*')) ? 'active' : ''}}" href="{{ route('payroll.index') }}">Payroll</a></li>
                            @endcanany
                            @canany(['manage reimburst', 'create reimburst'])
                                <li class="{{(request()->routeIs('reimburst*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('reimburst*')) ? 'active' : ''}}" href="{{ route('reimburst.index') }}"> Reimburse</a></li>
                            @endcanany
                            @canany(['manage allowance', 'create allowance'])
                            <li class=" {{(request()->routeIs('allowance-other')) ? 'active' : ''}}">
                                <a class=" {{(request()->routeIs('allowance-other')) ? 'active' : ''}}" href="{{route('allowance-other')}}"> Allowance
                                </a>
                            </li>
                            @endcanany
                            @canany(['manage thr', 'create thr'])
                            <li class=" {{(request()->routeIs('thr')) ? 'active' : ''}}">
                                <a class=" {{(request()->routeIs('thr')) ? 'active' : ''}}" href="{{route('thr')}}"> THR
                                </a>
                            </li>
                            @endcanany
                            @canany(['manage loan', 'create loan'])
                            <li class="submenu" >
                                <a style="padding: 9px 10px 9px 44px" href="#"> <span> Deduction</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    @canany(['manage loan', 'create loan'])
                                        <li class="{{(request()->routeIs('loans*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('loans*')) ? 'active' : ''}}" href="{{route('loans.index')}}">Loan</a></li>
                                    @endcanany
                                    @canany(['manage loan', 'create loan'])
                                        <li class="{{(request()->routeIs('loans*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('loans*')) ? 'active' : ''}}" href="{{route('loan_cash_receipt')}}">Installment</a></li>
                                    @endcanany

                                </ul>
                            </li>
                             @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['manage payroll', 'create payroll', 'manage denda', 'create denda', 'manage payslip', 'generate payslip'])
                <li class="submenu">
                    <a href="#"><i class="la la-book"></i> <span> Payroll</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                       <!--  @canany(['manage payslip', 'generate payslip'])
                            <li class="{{(request()->routeIs('payslips*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payslips*')) ? 'active' : ''}}" href="{{ route('payslips.index') }}">Payslip</a></li>
                        @endcanany -->
                        @canany(['manage payroll'])
                            <li class="{{(request()->routeIs('run-payroll')) ? 'active' : ''}}"><a class="{{(request()->routeIs('run-payroll')) ? 'active' : ''}}" href="{{ route('run-payroll') }}">Run payroll</a></li>
                        @endcanany
                        @canany(['manage payslip', 'generate payslip'])
                            <li class="{{(request()->routeIs('salary-payroll')) ? 'active' : ''}}"><a class="{{(request()->routeIs('salary-payroll')) ? 'active' : ''}}" href="{{ route('salary-payroll') }}">Pay Slip</a></li>
                        @endcanany


                    </ul>
                </li>
            @endcanany
                @canany(['manage user',
                        // 'create user',
                        // 'manage role',
                        // 'create role',
                        // 'manage level approval',
                        // 'edit level approval',
                        // 'manage denda',
                        // 'create denda',
                        // 'edit denda',
                        // 'delete denda',
                        // 'manage bpjs kesehatan',
                        // 'create bpjs kesehatan',
                        // 'edit bpjs kesehatan',
                        // 'delete bpjs kesehatan',
                        // 'manage pph21',
                        // 'edit pph21',
                        // 'manage jht',
                        // 'create jht',
                        // 'manage jkk',
                        // 'create jkk',
                        // 'manage jkm',
                        // 'create jkm',
                        //  'manage jp',
                        //  'create jp',
                        //  'manage payslip code pin',
                        //  'manage payslip checklist attendance summary',
                        //  'manage allowance option',
                        //  'create allowance option',
                        //  'manage leave type',
                        //  'manage reimbursement option',
                        //  'manage branch',
                        //  'manage loan option',
                         'manage payslip type'])
                    <li class="submenu">
                        <a href="#"><i class="la la-file"></i> <span>Report</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                        @canany(['manage attendance', 'show attendance'])
                            <li class="{{(request()->routeIs('reporting-attandance')) ? 'active' : ''}}"><a class="{{(request()->routeIs('reporting-attandance')) ? 'active' : ''}}" href="{{ route('reporting-attandance') }}">Report Attandance</a></li>
                            <li class="{{(request()->routeIs('rekap-attandance')) ? 'active' : ''}}"><a class="{{(request()->routeIs('rekap-attandance')) ? 'active' : ''}}" href="{{ route('rekap-attandance') }}">Rekap Attandance</a></li>
                        @endcanany
                        @canany(['manage payroll'])
                            <li class="{{(request()->routeIs('rekap-payroll')) ? 'active' : ''}}"><a class="{{(request()->routeIs('rekap-payroll')) ? 'active' : ''}}" href="{{ route('rekap-payroll') }}">Rekap Payroll</a></li>
                        @endcanany
                         @canany(['manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan'])
                            <li class="{{(request()->routeIs('get-data-bpjs*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('get-data-bpjs*')) ? 'active' : ''}}" href="{{ route('get-data-bpjs') }}">BPJS</a></li>
                        @endcanany
                        @canany(['manage pph21', 'create pph21', 'edit pph21', 'delete pph21'])
                            <li class="{{(request()->routeIs('get-rekap-pph')) ? 'active' : ''}}"><a class="{{(request()->routeIs('get-rekap-pph')) ? 'active' : ''}}" href="{{ route('get-rekap-pph') }}">PPH21</a></li>
                        @endcanany

                        </ul>
                    </li>
                @endcanany

                @canany(['manage user', 'create user', 'manage role', 'create role', 'manage level approval', 'edit level approval', 'manage denda', 'create denda', 'edit denda', 'delete denda', 'manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan', 'manage pph21', 'edit pph21', 'manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp', 'manage payslip code pin', 'manage payslip checklist attendance summary', 'manage allowance option', 'create allowance option', 'manage leave type', 'manage reimbursement option', 'manage branch', 'manage loan option', 'manage payslip type'])
                    <li class="submenu">
                        <a href="#"><i class="la la-cog"></i> <span> Setting</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            @canany(['manage role', 'create role'])
                                <li class="{{(request()->routeIs('setup-app')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setup-app')) ? 'active' : ''}}" href="{{ route('setup-app') }}">Setup App</a></li>
                            @endcanany 
                            @canany(['manage user', 'create user'])
                                <li class="{{(request()->routeIs('users*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('users*')) ? 'active' : ''}}" href="{{ route('users.index') }}">Users</a></li>
                            @endcanany

                            @canany(['manage role', 'create role'])
                                <li class="{{(request()->routeIs('roles*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('roles*')) ? 'active' : ''}}" href="{{route('roles.index')}}">Roles</a></li>
                            @endcanany

                            <!-- @canany(['manage level approval', 'edit level approval'])
                                <li class="{{(request()->routeIs('level-approvals*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('level-approvals*')) ? 'active' : ''}}" href="{{ route('level-approvals.index') }}">Set Level Approval </a></li>
                            @endcanany -->

                            @canany(['manage denda', 'create denda', 'edit denda', 'delete denda', 'manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan', 'manage pph21', 'edit pph21', 'manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp', 'manage payslip code pin', 'manage payslip checklist attendance summary'])
                                <li class="submenu" >
                                    <a style="padding: 9px 10px 9px 50px" href="#"> <span>Payroll</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">

                                        @canany(['manage payslip checklist attendance summary', 'edit payslip checklist attendance summary'])
                                            <li class="{{(request()->routeIs('checklist-attendance-summary*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('checklist-attendance-summary*')) ? 'active' : ''}}" href="{{ route('checklist-attendance-summary.index') }}">Checklist Attendance Summary</a></li>
                                        @endcanany

                                       <!--  @canany(['manage payslip code pin', 'edit payslip code pin'])
                                            <li class="{{(request()->routeIs('payslip-code-pin*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payslip-code-pin*')) ? 'active' : ''}}" href="{{ route('payslip-code-pin.index') }}">Payslip Code PIN</a></li>
                                        @endcanany -->
                                        <!-- denda sementara di hidden -->
                                       <!--  @canany(['manage denda', 'create denda', 'edit denda', 'delete denda'])
                                            <li class="{{(request()->routeIs('denda*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('denda*')) ? 'active' : ''}}" href="{{ route('denda.index') }}">Deduction</a></li>
                                        @endcanany -->

                                        @canany(['manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp'])
                                        <li class="submenu" >
                                            <a style="padding: 9px 10px 9px 44px" href="#"> <span> BPJS </span> <span class="menu-arrow"></span></a>
                                            <ul style="display: none;">

                                                @canany(['manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp'])
                                                    <li class=" {{(request()->routeIs('master-bpjs*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('master-bpjs*')) ? 'active' : ''}}" href="{{route('master-bpjs')}}"> BPJS
                                                        </a>
                                                    </li>
                                                @endcanany
                                                @canany(['manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp'])
                                                    <li class=" {{(request()->routeIs('master-limit-bpjs*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('master-limit-bpjs*')) ? 'active' : ''}}" href="{{route('master-limit-bpjs')}}"> Maximum Value
                                                        </a>
                                                    </li>
                                                @endcanany
                                            </ul>
                                        </li>
                                        @endcanany

                                        <li class="submenu" >
                                            <a style="padding: 9px 10px 9px 44px" href="#"> <span> PPH21 </span> <span class="menu-arrow"></span></a>
                                            <ul style="display: none;">
                                                @canany(['manage ptkp', 'edit ptkp'])
                                                    <li class=" {{(request()->routeIs('setting.ptkp*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('setting.ptkp*')) ? 'active' : ''}}" href="{{route('setting.ptkp.index')}}"> PTKP
                                                        </a>
                                                    </li>
                                                @endcanany
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @endcanany

                            @canany(['manage allowance option', 'create allowance option', 'manage leave type', 'manage reimbursement option', 'manage branch', 'manage loan option', 'manage payslip type'])
                                <li class="submenu" >
                                <a style="padding: 9px 10px 9px 50px" href="#"> <span> Master Data</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;padding: px 10px 9px 50px">
                                    @canany(['manage branch', 'create branch', 'edit branch', 'delete branch'])
                                        <li class=" {{(request()->routeIs('branches*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('branches*')) ? 'active' : ''}}" href="{{route('branches.index')}}"></i> <span> Branch</span>
                                            </a>
                                        </li>
                                    @endcanany
                                    @canany(['manage department', 'create department', 'edit department', 'delete department'])
                                        <li class=" {{(request()->routeIs('departement*')) ? 'active' : ''}}">
                                            <a class=" {{(request()->routeIs('departement*')) ? 'active' : ''}}" href="{{route('departement.index')}}"><span>Department</span></a>
                                        </li>
                                    @endcanany
                                    @canany(['manage group position', 'create group position', 'edit group position', 'delete group position'])
                                    <li class=" {{(request()->routeIs('group-position*')) ? 'active' : ''}}">
                                        <a class=" {{(request()->routeIs('group-position*')) ? 'active' : ''}}" href="{{route('group-position')}}"><span>Group Position</span></a>
                                    </li>
                                    @endcanany
                                     @canany(['manage position', 'create position', 'edit position', 'delete position'])
                                    <li class=" {{(request()->routeIs('position*')) ? 'active' : ''}}">
                                        <a class=" {{(request()->routeIs('position*')) ? 'active' : ''}}" href="{{route('position')}}"><span>Position</span></a>
                                    </li>
                                    @endcanany
                                    @canany(['manage shift type', 'create shift type', 'edit shift type', 'delete shift type'])
                                        <li class=" {{(request()->routeIs('shift-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('shift-type*')) ? 'active' : ''}}" href="{{route('shift-type.index')}}"></i> <span> Schedule Type</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage allowance option', 'create allowance option', 'edit allowance option', 'delete allowance option'])
                                        <li class=" {{(request()->routeIs('allowance-option*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('allowance-option*')) ? 'active' : ''}}" href="{{route('allowance-option.index')}}"></i> <span> Allowance Option</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage leave type', 'create leave type', 'edit leave type', 'delete leave type'])
                                        <li class=" {{(request()->routeIs('leave-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('leave-type*')) ? 'active' : ''}}" href="{{route('leave-type.index')}}"></i> <span> Leave Type</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage reimbursement option', 'create reimbursement option', 'edit reimbursement option', 'delete reimbursement option'])
                                        <li class=" {{(request()->routeIs('reimbursement-option*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('reimbursement-option*')) ? 'active' : ''}}" href="{{route('reimbursement-option.index')}}"></i> <span> Reimburse Option</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage loan option', 'create loan option', 'edit loan option', 'delete loan option'])
                                        <li class=" {{(request()->routeIs('loan-option*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('loan-option*')) ? 'active' : ''}}" href="{{route('loan-option.index')}}"></i> <span> Cash in Advance</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage payslip type', 'create payslip type', 'edit payslip type', 'delete payslip type'])
                                        <li class=" {{(request()->routeIs('payslip-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('payslip-type*')) ? 'active' : ''}}" href="{{route('payslip-type.index')}}"></i> <span> Payslip Type</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage overtime type', 'create overtime type', 'edit overtime type', 'delete overtime type'])
                                        <li class=" {{(request()->routeIs('overtime-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('overtime-type*')) ? 'active' : ''}}" href="{{route('overtime-type.index')}}"></i> <span> Overtime Type</span>
                                            </a>
                                        </li>
                                    @endcanany

                                    @canany(['manage day type', 'create day type', 'edit day type', 'delete day type'])
                                        <li class=" {{(request()->routeIs('day-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('day-type*')) ? 'active' : ''}}" href="{{route('day-type.index')}}"></i> <span> Day Type</span>
                                            </a>
                                        </li>
                                    @endcanany
                                </ul>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
            </ul>
        </div>
    </div>
</div>
