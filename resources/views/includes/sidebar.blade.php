<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                <ul class="list-inline-item list-unstyled links">
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="{{route('dashboard')}}"><i class="la la-dashboard {{(request()->routeIs('/')) ? 'active' : ''}}"></i> <span> Dashboard</span>
                            {{-- <span class="menu-arrow"></span> --}}
                       </a>
                        {{-- <ul style="display: none;">
                            <li><a  href="">Admin Dashboards</a></li>
                            <li><a  href="employee-dashboard.html">Employee Dashboard</a></li>
                        </ul> --}}
                    </li>
                    {{-- <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="chat.html">Chat</a></li>
                            <li class="submenu">
                                <a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="voice-call.html">Voice Call</a></li>
                                    <li><a href="video-call.html">Video Call</a></li>
                                    <li><a href="outgoing-call.html">Outgoing Call</a></li>
                                    <li><a href="incoming-call.html">Incoming Call</a></li>
                                </ul>
                            </li>
                            <li><a href="events.html">Calendar</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="inbox.html">Email</a></li>
                            <li><a href="file-manager.html">File Manager</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Employees</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="employees.html">All Employees</a></li>
                            <li><a href="holidays.html">Holidays</a></li>
                            <li><a href="leaves.html">Leaves (Admin) <span class="badge rounded-pill bg-primary float-end">1</span></a></li>
                            <li><a href="leaves-employee.html">Leaves (Employee)</a></li>
                            <li><a href="leave-settings.html">Leave Settings</a></li>
                            <li><a href="attendance.html">Attendance (Admin)</a></li>
                            <li><a href="attendance-employee.html">Attendance (Employee)</a></li>
                            <li><a href="departments.html">Departments</a></li>
                            <li><a href="designations.html">Designations</a></li>
                            <li><a href="timesheet.html">Timesheet</a></li>
                            <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                            <li><a href="overtime.html">Overtime</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="clients.html"><i class="la la-users"></i> <span>Clients</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="projects.html">Projects</a></li>
                            <li><a href="tasks.html">Tasks</a></li>
                            <li><a href="task-board.html">Task Board</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="leads.html"><i class="la la-user-secret"></i> <span>Leads</span></a>
                    </li>
                    <li>
                        <a href="tickets.html"><i class="la la-ticket"></i> <span>Tickets</span></a>
                    </li>
                    <li class="menu-title">
                        <span>HR</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="estimates.html">Estimates</a></li>
                            <li><a href="invoices.html">Invoices</a></li>
                            <li><a href="payments.html">Payments</a></li>
                            <li><a href="expenses.html">Expenses</a></li>
                            <li><a href="provident-fund.html">Provident Fund</a></li>
                            <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                    </li>
                </ul>
                <button class="viewmoremenu">More Menu</button>
                <ul class="hidden-links hidden">
                    <li class="submenu">
                        <a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="categories.html">Categories</a></li>
                            <li><a href="budgets.html">Budgets</a></li>
                            <li><a href="budget-expenses.html">Budget Expenses</a></li>
                            <li><a href="budget-revenues.html">Budget Revenues</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="salary.html"> Employee Salary </a></li>
                            <li><a href="salary-view.html"> Payslip </a></li>
                            <li><a href="payroll-items.html"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="policies.html"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="expense-reports.html"> Expense Report </a></li>
                            <li><a href="invoice-reports.html"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="project-reports.html"> Project Report </a></li>
                            <li><a href="task-reports.html"> Task Report </a></li>
                            <li><a href="user-reports.html"> User Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="leave-reports.html"> Leave Report </a></li>
                            <li><a href="daily-reports.html"> Daily Report </a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Performance</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-graduation-cap"></i> <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="performance-indicator.html"> Performance Indicator </a></li>
                            <li><a href="performance.html"> Performance Review </a></li>
                            <li><a href="performance-appraisal.html"> Performance Appraisal </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="goal-tracking.html"> Goal List </a></li>
                            <li><a href="goal-type.html"> Goal Type </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-edit"></i> <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="training.html"> Training List </a></li>
                            <li><a href="trainers.html"> Trainers</a></li>
                            <li><a href="training-type.html"> Training Type </a></li>
                        </ul>
                    </li>
                    <li><a href="promotion.html"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
                    <li><a href="resignation.html"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
                    <li><a href="termination.html"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
                    <li class="menu-title">
                        <span>Administration</span>
                    </li>
                    <li>
                        <a href="assets.html"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-briefcase"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="user-dashboard.html"> User Dasboard </a></li>
                            <li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
                            <li><a href="jobs.html"> Manage Jobs </a></li>
                            <li><a href="manage-resumes.html"> Manage Resumes </a></li>
                            <li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
                            <li><a href="interview-questions.html"> Interview Questions </a></li>
                            <li><a href="offer_approvals.html"> Offer Approvals </a></li>
                            <li><a href="experiance-level.html"> Experience Level </a></li>
                            <li><a href="candidates.html"> Candidates List </a></li>
                            <li><a href="schedule-timing.html"> Schedule timing </a></li>
                            <li><a href="apptitude-result.html"> Aptitude Results </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="knowledgebase.html"><i class="la la-question"></i> <span>Knowledgebase</span></a>
                    </li>
                    <li>
                        <a href="activities.html"><i class="la la-bell"></i> <span>Activities</span></a>
                    </li>
                    <li>
                        <a href="users.html"><i class="la la-user-plus"></i> <span>Users</span></a>
                    </li>
                    <li>
                        <a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
                    </li>
                    <li class="menu-title">
                        <span>Pages</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                            <li><a href="client-profile.html"> Client Profile </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-key"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="index.html"> Login </a></li>
                            <li><a href="register.html"> Register </a></li>
                            <li><a href="forgot-password.html"> Forgot Password </a></li>
                            <li><a href="otp.html"> OTP </a></li>
                            <li><a href="lock-screen.html"> Lock Screen </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-exclamation-triangle"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="error-404.html">404 Error </a></li>
                            <li><a href="error-500.html">500 Error </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-hand-o-up"></i> <span> Subscriptions </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="subscriptions.html"> Subscriptions (Admin) </a></li>
                            <li><a href="subscriptions-company.html"> Subscriptions (Company) </a></li>
                            <li><a href="subscribed-companies.html"> Subscribed Companies</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-columns"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="search.html"> Search </a></li>
                            <li><a href="faq.html"> FAQ </a></li>
                            <li><a href="terms.html"> Terms </a></li>
                            <li><a href="privacy-policy.html"> Privacy Policy </a></li>
                            <li><a href="blank-page.html"> Blank Page </a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>UI Interface</span>
                    </li>
                    <li>
                        <a href="components.html"><i class="la la-puzzle-piece"></i> <span>Components</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-object-group"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                            <li><a href="form-input-groups.html">Input Groups </a></li>
                            <li><a href="form-horizontal.html">Horizontal Form </a></li>
                            <li><a href="form-vertical.html"> Vertical Form </a></li>
                            <li><a href="form-mask.html"> Form Mask </a></li>
                            <li><a href="form-validation.html"> Form Validation </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="tables-basic.html">Basic Tables </a></li>
                            <li><a href="data-tables.html">Data Table </a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Extras</span>
                    </li>
                    <li>
                        <a href="#"><i class="la la-file-text"></i> <span>Documentation</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="la la-info"></i> <span>Change Log</span> <span class="badge badge-primary ms-auto">v3.4</span></a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="la la-share-alt"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="submenu">
                                <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"> <span>Level 1</span></a>
                            </li>
                        </ul>
                    </li> --}}
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
                    <li class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}">
                        <a class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}" href="{{route('employees.index')}}"><i class="la la-users"></i> <span>Employees</span>
                        </a>
                    </li>
                @endcanany

                @canany(['manage employee', 'view employee', 'edit employee', 'delete employee', 'manage employee profile', 'show employee profile'])
                    <li class=" {{(request()->routeIs('employees*')) ? 'active' : ''}}">
                        <a class=" {{(request()->routeIs('rotation*')) ? 'active' : ''}}" href="{{route('rotation-employee')}}"><i class="la la-users"></i> <span>Rotation Employees</span>
                        </a>
                    </li>
                @endcanany


                @canany(['manage on duty', 'create on duty', 'view history leave', 'manage leave', 'create leave', 'manage overtime', 'create overtime', 'manage request shift schedule', 'create request shift schedule', 'manage attendance', 'create attendance', 'manage timesheet', 'create timesheet', 'show shift schedule', 'manage dayoff', 'create dayoff',  'show employee request', 'manage company holiday', 'create company holiday'])
                    <li class="submenu">
                        <a href="#"><i class="la la-clock"></i> <span> Time Management</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @canany(['manage leave', 'create leave', 'edit leave', 'delete leave'])
                                <li class="{{(request()->routeIs('leaves*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('leaves*')) ? 'active' : ''}}" href="{{ route('leaves.index') }}">Leave</a></li>
                            @endcanany

                            @canany(['view history leave'])
                                <li class="{{(request()->routeIs('history-leave*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('history-leave*')) ? 'active' : ''}}" href="{{ route('history-leave.index') }}">Histroy Leave</a></li>
                            @endcanany

                            @canany(['manage overtime', 'create overtime', 'edit overtime', 'delete overtime'])
                                <li class="{{(request()->routeIs('overtimes*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('overtimes*')) ? 'active' : ''}}" href="{{ route('overtimes.index') }}">Overtime</a></li>
                            @endcanany

                            @canany(['manage request shift schedule', 'create request shift schedule', 'edit request shift schedule', 'delete request shift schedule'])
                                <li class="{{(request()->routeIs('request-shift-schedule*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('request-shift-schedule*')) ? 'active' : ''}}" href="{{ route('request-shift-schedule.index') }}">Request Shift Schedule</a></li>
                            @endcanany

                            @canany(['show shift schedule'])
                                <li class="{{(request()->routeIs('shift-schedule*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('shift-schedule*')) ? 'active' : ''}}" href="{{ route('shift-schedule.index') }}">Shift Schedule</a></li>
                            @endcanany

                            @canany(['manage timesheet', 'create timesheet', 'edit timesheet', 'delete timesheet'])
                                <li class="{{(request()->routeIs('timesheets*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('timesheets*')) ? 'active' : ''}}" href="{{ route('timesheets.index') }}">Timesheet</a></li>
                            @endcanany

                            @canany(['show employee request'])
                                <li class=" {{(request()->routeIs('employee.request')) ? 'active' : ''}}">
                                    <a class="{{(request()->routeIs('employee.request*')) ? 'active' : ''}}" href="{{route('employee.request')}}"> Employee Request
                                </a>
                                </li>
                            @endcanany

                            @canany(['manage on duty', 'create on duty', 'edit on duty', 'delete on duty'])
                                <li class="{{(request()->routeIs('travels*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('travels*')) ? 'active' : ''}}" href="{{ route('travels.index') }}">On Duty</a></li>
                            @endcanany

                            @canany(['manage dayoff', 'create dayoff'])
                                <li class="{{(request()->routeIs('dayoff*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('dayoff*')) ? 'active' : ''}}" href="{{ route('dayoff.index') }}">Dayoff</a></li>
                            @endcanany

                            @canany(['manage company holiday', 'create company holiday'])
                                <li class="{{(request()->routeIs('company-holiday*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('company-holiday*')) ? 'active' : ''}}" href="{{ route('company-holiday.index') }}">Company Holiday</a></li>
                            @endcanany

                            @canany(['manage attendance', 'create attendance', 'edit attendance', 'delete attendance'])
                                <li class="submenu ">
                                    <a style="padding: 9px 10px 9px 44px" href="#"> <span> Attendance</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        @canany(['manage attendance'])
                                            <li class="{{(request()->routeIs('attendance*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('attendance*')) ? 'active' : ''}}" href="{{ route('attendance.index') }}">Attendance List</a></li>
                                        @endcanany
                                        @canany(['create attendance'])
                                            <li class="{{(request()->routeIs('bulk-attendance*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('bulk-attendance*')) ? 'active' : ''}}" href="{{ route('bulk-attendance.index') }}">Bulk Attendance</a></li>
                                        @endcanany
                                    </ul>
                                </li>
                            @endcanany


                        </ul>
                    </li>
                @endcanany



                @canany(['manage performance review', 'create performance review', 'edit performance review', 'delete performance review', 'manage project', 'create project'])
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> HR Management</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            @canany(['manage performance review', 'create performance review', 'edit performance review', 'delete performance review'])
                                <li class="submenu {{(request()->routeIs('performance-review*')) ? 'active' : ''}}" >
                                    <a style="padding: 9px 10px 9px 50px" href="#"> <span> Performance Setup</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">

                                        @canany(['manage performance review', 'create performance review', 'edit performance review', 'delete performance review'])
                                            <li class="{{(request()->routeIs('performance-review*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('performance-review*')) ? 'active' : ''}}" href="{{ route('performance-review.index') }}">Performance Review</a></li>
                                        @endcanany

                                    </ul>
                                </li>
                            @endcanany

                            @canany(['manage project', 'create project'])
                                <li class=" {{(request()->routeIs('projects*')) ? 'active' : ''}}">
                                    <a class=" {{(request()->routeIs('projects*')) ? 'active' : ''}}" href="{{route('projects.index')}}">Projects
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany


                @canany(['manage payroll', 'create payroll', 'manage denda', 'create denda', 'manage payslip', 'generate payslip'])
                    <li class="submenu">
                        <a href="#"><i class="la la-book"></i> <span> Payroll</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            @canany(['manage payroll', 'create payroll'])
                                <li class="{{(request()->routeIs('payroll*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payroll*')) ? 'active' : ''}}" href="{{ route('payroll.index') }}">List Payroll</a></li>
                            @endcanany

                            @canany(['manage payslip', 'generate payslip'])
                                <li class="{{(request()->routeIs('payslips*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payslips*')) ? 'active' : ''}}" href="{{ route('payslips.index') }}">Payslip</a></li>
                            @endcanany


                        </ul>
                    </li>
                @endcanany

                @canany(['manage reimburst', 'create reimburst', 'manage cash advance', 'create cash advance', 'manage loan', 'create loan', 'manage allowance', 'create allowance'])
                    <li class="submenu">
                        <a href="#"><i class="la la-usd"></i> <span> Finance</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @canany(['manage reimburst', 'create reimburst'])
                                <li class="{{(request()->routeIs('reimburst*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('reimburst*')) ? 'active' : ''}}" href="{{ route('reimburst.index') }}"> Reimburst</a></li>
                            @endcanany

                            @canany(['manage cash advance', 'create cash advance'])
                                <li class="{{(request()->routeIs('cash*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('cash*')) ? 'active' : ''}}" href="{{route('cash.index')}}"> Cash Advance</a></li>
                            @endcanany

                            @canany(['manage loan', 'create loan'])
                                <li class="{{(request()->routeIs('loans*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('loans*')) ? 'active' : ''}}" href="{{route('loans.index')}}"> Loan</a></li>
                            @endcanany

                            @canany(['manage allowance', 'create allowance'])
                            <li class=" {{(request()->routeIs('allowances*')) ? 'active' : ''}}">
                                <a class=" {{(request()->routeIs('allowances*')) ? 'active' : ''}}" href="{{route('allowances.index')}}"> Allowance
                                </a>
                            </li>
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
                        <a href="#"><i class="la la-file"></i> <span>Reporting</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                        @canany(['manage user', 'create user'])
                            <li class="{{(request()->routeIs('reporting-attandance')) ? 'active' : ''}}"><a class="{{(request()->routeIs('reporting-attandance')) ? 'active' : ''}}" href="{{ route('reporting-attandance') }}">Reporting Attandance</a></li>
                        @endcanany

                        </ul>
                    </li>
                @endcanany

                @canany(['manage user', 'create user', 'manage role', 'create role', 'manage level approval', 'edit level approval', 'manage denda', 'create denda', 'edit denda', 'delete denda', 'manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan', 'manage pph21', 'edit pph21', 'manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp', 'manage payslip code pin', 'manage payslip checklist attendance summary', 'manage allowance option', 'create allowance option', 'manage leave type', 'manage reimbursement option', 'manage branch', 'manage loan option', 'manage payslip type'])
                    <li class="submenu">
                        <a href="#"><i class="la la-cog"></i> <span> Setting</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            @canany(['manage user', 'create user'])
                                <li class="{{(request()->routeIs('users*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('users*')) ? 'active' : ''}}" href="{{ route('users.index') }}">Users</a></li>
                            @endcanany

                            @canany(['manage role', 'create role'])
                                <li class="{{(request()->routeIs('roles*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('roles*')) ? 'active' : ''}}" href="{{route('roles.index')}}">Roles</a></li>
                            @endcanany

                            @canany(['manage level approval', 'edit level approval'])
                                <li class="{{(request()->routeIs('level-approvals*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('level-approvals*')) ? 'active' : ''}}" href="{{ route('level-approvals.index') }}">Set Level Approval </a></li>
                            @endcanany

                            @canany(['manage denda', 'create denda', 'edit denda', 'delete denda', 'manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan', 'manage pph21', 'edit pph21', 'manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp', 'manage payslip code pin', 'manage payslip checklist attendance summary'])
                                <li class="submenu" >
                                    <a style="padding: 9px 10px 9px 50px" href="#"> <span> Setting Payroll</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">

                                        @canany(['manage payslip checklist attendance summary', 'edit payslip checklist attendance summary'])
                                            <li class="{{(request()->routeIs('checklist-attendance-summary*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('checklist-attendance-summary*')) ? 'active' : ''}}" href="{{ route('checklist-attendance-summary.index') }}">Checklist Attendance Summary</a></li>
                                        @endcanany

                                        @canany(['manage payslip code pin', 'edit payslip code pin'])
                                            <li class="{{(request()->routeIs('payslip-code-pin*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('payslip-code-pin*')) ? 'active' : ''}}" href="{{ route('payslip-code-pin.index') }}">Payslip Code PIN</a></li>
                                        @endcanany

                                        @canany(['manage denda', 'create denda', 'edit denda', 'delete denda'])
                                            <li class="{{(request()->routeIs('denda*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('denda*')) ? 'active' : ''}}" href="{{ route('denda.index') }}">Deduction</a></li>
                                        @endcanany

                                        @canany(['manage bpjs kesehatan', 'create bpjs kesehatan', 'edit bpjs kesehatan', 'delete bpjs kesehatan'])
                                            <li class="{{(request()->routeIs('setting.bpjs-tk*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.bpjs-tk*')) ? 'active' : ''}}" href="{{ route('setting.bpjs-tk.index') }}">BPJS Kesehatan</a></li>
                                        @endcanany



                                        @canany(['manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp'])
                                        <li class="submenu" >
                                            <a style="padding: 9px 10px 9px 44px" href="#"> <span> BPJS TK </span> <span class="menu-arrow"></span></a>
                                            <ul style="display: none;">

                                                @canany(['manage jht', 'create jht', 'manage jkk', 'create jkk', 'manage jkm', 'create jkm', 'manage jp', 'create jp'])
                                                    <li class=" {{(request()->routeIs('set-bpjstk*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('set-bpjstk*')) ? 'active' : ''}}" href="{{route('set-bpjstk.index')}}"> Set BPJS TK
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @canany(['manage jht', 'create jht', 'edit jht', 'delete jht'])
                                                    <li class="{{(request()->routeIs('setting.jht*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.jht*')) ? 'active' : ''}}" href="{{ route('setting.jht.index') }}">Jaminan Hari Tua (JHT)</a></li>
                                                @endcanany

                                            @canany(['manage jkk', 'create jkk', 'edit jkk', 'delete jkk'])
                                                <li class="{{(request()->routeIs('setting.jkk*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.jkk*')) ? 'active' : ''}}" href="{{ route('setting.jkk.index') }}">Jaminan Kecelakaan Kerja (JKK)</a></li>
                                            @endcanany


                                            @canany(['manage jkm', 'create jkm', 'edit jkm', 'delete jkm'])
                                                <li class="{{(request()->routeIs('setting.jkm*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.jkm*')) ? 'active' : ''}}" href="{{ route('setting.jkm.index') }}">Jaminan Kematian (JKM)</a></li>
                                            @endcanany

                                            @canany(['manage jp', 'create jp', 'edit jp', 'delete jp'])
                                                <li class="{{(request()->routeIs('setting.jp*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.jp*')) ? 'active' : ''}}" href="{{ route('setting.jp.index') }}">Jaminan Pensiun (JP)</a></li>
                                            @endcanany

                                            </ul>
                                        </li>
                                        @endcanany

                                        <li class="submenu" >
                                            <a style="padding: 9px 10px 9px 44px" href="#"> <span> PPH21 </span> <span class="menu-arrow"></span></a>
                                            <ul style="display: none;">

                                                @canany(['manage set ptkp', 'create set ptkp', 'edit set ptkp', 'delete set ptkp'])
                                                    <li class=" {{(request()->routeIs('set-ptkp*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('set-ptkp*')) ? 'active' : ''}}" href="{{route('set-ptkp.index')}}"> Set PTKP
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @canany(['manage ptkp', 'edit ptkp'])
                                                    <li class=" {{(request()->routeIs('setting.ptkp*')) ? 'active' : ''}}">
                                                        <a class=" {{(request()->routeIs('setting.ptkp*')) ? 'active' : ''}}" href="{{route('setting.ptkp.index')}}"> PTKP
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @canany(['manage pph21', 'create pph21', 'edit pph21', 'delete pph21'])
                                                    <li class="{{(request()->routeIs('setting.pph21*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting.pph21*')) ? 'active' : ''}}" href="{{ route('setting.pph21.index') }}">PPH21</a></li>
                                                @endcanany
                                            </ul>
                                        </li>

                                        {{-- @canany(['manage setting payroll overtime', 'create setting payroll overtime', 'edit setting payroll overtime', 'delete setting payroll overtime'])
                                            <li class="{{(request()->routeIs('setting-payroll-overtime*')) ? 'active' : ''}}"><a class="{{(request()->routeIs('setting-payroll-overtime*')) ? 'active' : ''}}" href="{{ route('setting-payroll-overtime.index') }}">Overtime</a></li>
                                        @endcanany --}}

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

                                    @canany(['manage shift type', 'create shift type', 'edit shift type', 'delete shift type'])
                                        <li class=" {{(request()->routeIs('shift-type*')) ? 'active' : ''}}">
                                            <a  class="{{(request()->routeIs('shift-type*')) ? 'active' : ''}}" href="{{route('shift-type.index')}}"></i> <span> Shift Type</span>
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
                                            <a  class="{{(request()->routeIs('reimbursement-option*')) ? 'active' : ''}}" href="{{route('reimbursement-option.index')}}"></i> <span> Reimbursement Option</span>
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
