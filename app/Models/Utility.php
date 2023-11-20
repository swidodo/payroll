<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Arrays;
use PDF;

class Utility extends Model
{
    use HasFactory;

    protected $table = 'settings';



    public static function settings()
    {
        $data = DB::table('settings');
        if (Auth::check()) {
            $data = $data->where('created_by', '=', Auth::user()->creatorId())->get();
            if (count($data) == 0) {
                $data = DB::table('settings')->where('created_by', '=', 1)->get();
            }
        } else {
            $data->where('created_by', '=', 1);
            $data = $data->get();
        }



        $settings = [
            "site_currency" => "USD",
            "site_currency_symbol" => "$",
            "site_currency_symbol_position" => "pre",
            "site_date_format" => "M j, Y",
            "site_time_format" => "g:i A",
            "company_name" => "",
            "company_address" => "",
            "company_city" => "",
            "company_state" => "",
            "company_zipcode" => "",
            "company_country" => "",
            "company_telephone" => "",
            "company_email" => "",
            "company_email_from_name" => "",
            "invoice_prefix" => "#INVO",
            "journal_prefix" => "#JUR",
            "invoice_color" => "ffffff",
            "proposal_prefix" => "#PROP",
            "proposal_color" => "ffffff",
            "bill_prefix" => "#BILL",
            "bill_color" => "ffffff",
            "customer_prefix" => "#CUST",
            "vender_prefix" => "#VEND",
            "footer_title" => "",
            "footer_notes" => "",
            "invoice_template" => "template1",
            "bill_template" => "template1",
            "proposal_template" => "template1",
            "registration_number" => "",
            "vat_number" => "",
            "default_language" => "en",
            'employee_create' => '1',
            'payment_reminder' => '1',
            "enable_stripe" => "",
            "enable_paypal" => "",
            "paypal_mode" => "",
            "paypal_client_id" => "",
            "paypal_secret_key" => "",
            "stripe_key" => "",
            "stripe_secret" => "",
            "decimal_number" => "2",
            "tax_type" => "",
            "shipping_display" => "on",
            "journal_prefix" => "#JUR",
            "display_landing_page" => "on",
            "employee_prefix" => "#EMP00",
            'create_user' => '1',
            'award_create' => '1',
            'lead_assign' => '1',
            'deal_assign' => '1',
            'proposal_send' => '1',
            'customer_invoice_send' => '1',
            'bill_payment' => '1',
            'invoice_payment' => '1',
            'bill_resend' => '1',
            'employee_resignation' => '1',
            'resignation_send' => '1',
            'employee_trip' => '1',
            'trip_send' => '1',
            'employee_promotion' => '1',
            'promotion_send' => '1',
            'employee_complaints' => '1',
            'employee_warning' => '1',
            'warning_send' => '1',
            'create_contract' => '1',
            'employee_termination' => '1',
            'termination_send' => '1',
            'leave_status' => '1',
            'employee_transfer' => '1',
            'transfer_send' => '1',
            "bug_prefix" => "#ISSUE",
            'payroll_create' => '1',
            'payslip_send' => '1',
            'title_text' => '',
            'footer_text' => '',
            "company_start_time" => "09:00",
            "company_end_time" => "18:00",
            'gdpr_cookie' => 'off',
            "interval_time" => "",
            "zoom_apikey" => "",
            "zoom_apisecret" => "",
            "slack_webhook" => "",
            "telegram_accestoken" => "",
            "telegram_chatid" => "",
            "enable_signup" => "on",
            'cookie_text' => 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.',
            "company_logo_light" => "logo-light.png",
            "company_logo_dark" =>  "logo-dark.png",
            "company_favicon" => "favicon.png",
            "cust_theme_bg" => "on",
            "cust_darklayout" => "off",
            "color" => "",
            "SITE_RTL" => "off",
            "purchase_prefix" => "#PUR",
            "purchase_color" => "ffffff",
            "purchase_template" => "template1",
            "pos_prefix" => "#POS",

            "storage_setting" => "local",
            "local_storage_validation" => "",
            "local_storage_max_upload_size" => "",
            "s3_key" => "",
            "s3_secret" => "",
            "s3_region" => "",
            "s3_bucket" => "",
            "s3_url"    => "",
            "s3_endpoint" => "",
            "s3_max_upload_size" => "",
            "s3_storage_validation" => "",
            "wasabi_key" => "",
            "wasabi_secret" => "",
            "wasabi_region" => "",
            "wasabi_bucket" => "",
            "wasabi_url" => "",
            "wasabi_root" => "",
            "wasabi_max_upload_size" => "",
            "wasabi_storage_validation" => "",

            "purchase_logo" => "",
            "proposal_logo" => "",
            "invoice_logo" => "",
            "contract_prefix" => "#CON",



        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function createEmployee($user_id, $created_by, array $request = [])
    {
        $user = User::where('id', $user_id)->first();
        $holidays = CompanyHoliday::where('created_by', Auth::user()->creatorId())->get()->toArray();
        $dayoffs = Dayoff::where('created_by', Auth::user()->creatorId())->get()->toArray();
        $dateNow     = Carbon::now()->format('Y-m-d');
        $dateOneYear = Carbon::now()->addYear()->format('Y-m-d');
        $employee = Employee::create(
            [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'employee_id' => User::employeeIdFormat($request['branch_id'], self::employeeNumber($created_by)),
                'created_by' => $created_by,
                'branch_id' => $request['branch_id'],
                'company_doj' => $request['doj'],
                'company_doe' =>  $request['doe'],
                'employee_type' => $request['employee_type']
            ]
        );
        $dateJoin = Carbon::parse($employee->company_doj);
        $dateEnd  = Carbon::parse($employee->company_doe);

        $diff = $dateJoin->diffInDays($dateEnd);

        $count = 0;
        for ($i = 0; $i <= $diff; $i++) {
            ShiftSchedule::create([
                'employee_id'       => $employee->id,
                'schedule_date'     => $dateJoin,
                'shift_id'          => 1,
                'status'            => 'Approved',
                'created_by'        => $created_by,
                'is_dayoff'         => false,
                'dayoff_type'       => null,
                'description'       => null,
            ]);
            $dateJoin->addDay(1);
        }

        foreach ($holidays as $key => $value) {
            ShiftSchedule::updateShift($value['company_holiday_date'], 'Y-m-d', 'Company Holiday', 'Company Holiday');
        }

        foreach ($dayoffs as $key => $value) {
            ShiftSchedule::updateShift($value['date'], 'l', 'Dayoff', 'Dayoff');
        }
    }

    public static function updateEmployee($user_id, $created_by, array $data)
    {
        $employee = Employee::where('user_id', $user_id)->first();
        $doe = $employee->company_doe;

        //contract extended 
        if (strtotime($doe) < strtotime($data['doe'])) {
            $diff = Carbon::parse($data['doe'])->diffInDays($doe);
            $dateEnd  = Carbon::parse($doe)->addDay(1);
            for ($i = 0; $i < $diff; $i++) {
                ShiftSchedule::create([
                    'employee_id'       => $employee->id,
                    'schedule_date'     => $dateEnd,
                    'shift_id'          => 1,
                    'status'            => 'Approved',
                    'created_by'        => $created_by,
                    'is_dayoff'         => false,
                    'dayoff_type'       => null,
                    'description'       => null,
                ]);
                $dateEnd->addDay(1);
            }

            //total leave
            $diff = Carbon::parse($data['doe'])->diffInMonths($doe);
            if (!is_null($employee->total_leave_remaining) && !is_null($employee->leave_type)) {
                $total_leave = $employee->total_leave + $diff;
                $data['total_leave'] = $total_leave;
                $data['total_leave_remaining'] = $employee->total_leave_remaining + $diff;
            } else {
                $total_leave = $employee->total_leave + $diff;
                $data['total_leave'] = $total_leave;
            }
        }
        //contract shortened
        else {
            $diff = Carbon::parse($doe)->diffInDays($data['doe']);
            $dateEndReq  = Carbon::parse($data['doe'])->addDay(1);
            for ($i = 0; $i < $diff; $i++) {
                $shift = ShiftSchedule::where('schedule_date', $dateEndReq)->first();
                $shift->delete();
                $dateEndReq->addDay(1);
            }

            //total leave
            $diff = Carbon::parse($doe)->diffInMonths($data['doe']);
            if (!is_null($employee->total_leave_remaining) && !is_null($employee->leave_type)) {
                $total_leave = $employee->total_leave - $diff;
                $data['total_leave'] = $total_leave;
                $data['total_leave_remaining'] = $employee->total_leave_remaining - $diff;
            } else {
                $total_leave = $employee->total_leave - $diff;
                $data['total_leave'] = $total_leave;
            }
        }

        $data['company_doe'] = $data['doe'];
        $employee->update($data);
    }

    public static function insertToRequest($model, $by, $type)
    {
        $allReq = AllRequest::latest()->first();

        if (is_null($allReq)) {
            $allReq = 1;
        } else {
            $allReq = $allReq->id + 1;
        }

        AllRequest::create([
            'request_id'    => $model->id,
            'request_no'    => $allReq,
            'request_for'   => $model->employee->name,
            'request_by'    => $by->name,
            'request_type'  => $type,
            'req_date'      => date("Y-m-d"),
            'created_by'    => $model->created_by,
            'status'        => $model->status,
        ]);
    }

    public static function employeeNumber($created_by)
    {
        $latest = Employee::where('created_by', $created_by)->latest()->first();

        if (!$latest) {
            return 1;
        }

        return $latest->id + 1;
    }

    public static function get_file($path)
    {
        $settings = Utility::getStorageSetting();

        try {
            if ($settings['storage_setting'] == 'wasabi') {
                config(
                    [
                        'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                        'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                        'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                        'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                        'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                    ]
                );
            } elseif ($settings['storage_setting'] == 's3') {
                config(
                    [
                        'filesystems.disks.s3.key' => $settings['s3_key'],
                        'filesystems.disks.s3.secret' => $settings['s3_secret'],
                        'filesystems.disks.s3.region' => $settings['s3_region'],
                        'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                        'filesystems.disks.s3.use_path_style_endpoint' => false,
                    ]
                );
            }

            return Storage::disk($settings['storage_setting'])->url($path);
        } catch (\Throwable $th) {
            return '';
        }
    }

    public static function getStorageSetting()
    {
        $data = DB::table('settings');
        $data = $data->where('created_by', '=', 1);
        $data     = $data->get();
        $settings = [
            "storage_setting" => "",
            "local_storage_validation" => "",
            "local_storage_max_upload_size" => "",
            "s3_key" => "",
            "s3_secret" => "",
            "s3_region" => "",
            "s3_bucket" => "",
            "s3_url"    => "",
            "s3_endpoint" => "",
            "s3_max_upload_size" => "",
            "s3_storage_validation" => "",
            "wasabi_key" => "",
            "wasabi_secret" => "",
            "wasabi_region" => "",
            "wasabi_bucket" => "",
            "wasabi_url" => "",
            "wasabi_root" => "",
            "wasabi_max_upload_size" => "",
            "wasabi_storage_validation" => "",
        ];
        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }
        return $settings;
    }


    //only employee edit storage setting upload_coustom_file function
    public static function upload_coustom_file($request, $key_name, $name, $path, $data_key, $custom_validation = [])
    {

        try {
            $settings = Utility::getStorageSetting();


            if (!empty($settings['storage_setting'])) {

                if ($settings['storage_setting'] == 'wasabi') {

                    config(
                        [
                            'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                            'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                            'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                            'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                            'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                        ]
                    );

                    $max_size = !empty($settings['wasabi_max_upload_size']) ? $settings['wasabi_max_upload_size'] : '5048';
                    $mimes =  !empty($settings['wasabi_storage_validation']) ? $settings['wasabi_storage_validation'] : '';
                } else if ($settings['storage_setting'] == 's3') {
                    config(
                        [
                            'filesystems.disks.s3.key' => $settings['s3_key'],
                            'filesystems.disks.s3.secret' => $settings['s3_secret'],
                            'filesystems.disks.s3.region' => $settings['s3_region'],
                            'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                            'filesystems.disks.s3.use_path_style_endpoint' => false,
                        ]
                    );
                    $max_size = !empty($settings['s3_max_upload_size']) ? $settings['s3_max_upload_size'] : '5048';
                    $mimes =  !empty($settings['s3_storage_validation']) ? $settings['s3_storage_validation'] : '';
                } else {
                    $max_size = !empty($settings['local_storage_max_upload_size']) ? $settings['local_storage_max_upload_size'] : '5048';

                    $mimes =  !empty($settings['local_storage_validation']) ? $settings['local_storage_validation'] : '';
                }

                $file = $request->$key_name;

                if (count($custom_validation) > 0) {
                    $validation = $custom_validation;
                } else {

                    $validation = [
                        'mimes:' . $mimes,
                        'max:' . $max_size,
                    ];
                }

                $validator = Validator::make($request->all(), [
                    $name => $validation
                ]);

                if ($validator->fails()) {
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                } else {

                    $name = $name;

                    if ($settings['storage_setting'] == 'local') {

                        Storage::disk('public')->putFileAs(
                            $path,
                            $request->file($key_name)[$data_key],
                            $name
                        );


                        $path = $name;
                    } else if ($settings['storage_setting'] == 'wasabi') {

                        $path = Storage::disk('wasabi')->putFileAs(
                            $path,
                            $file,
                            $name
                        );

                        // $path = $path.$name;

                    } else if ($settings['storage_setting'] == 's3') {

                        $path = Storage::disk('s3')->putFileAs(
                            $path,
                            $file,
                            $name
                        );
                        // $path = $path.$name;
                        // dd($path);
                    }

                    $res = [
                        'flag' => 1,
                        'msg'  => 'success',
                        'url'  => $path
                    ];
                    return $res;
                }
            } else {
                $res = [
                    'flag' => 0,
                    'msg' => __('Please set proper configuration for storage.'),
                ];
                return $res;
            }
        } catch (\Exception $e) {
            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }
    }

    public static function getValByName($key)
    {
        $setting = Utility::settings();
        if (!isset($setting[$key]) || empty($setting[$key])) {
            $setting[$key] = '';
        }

        $shiftReguler = ShiftType::where('name', 'Reguler')
            ->where('created_by', Auth::user()->creatorId())
            ->first();

        if ($key == 'company_start_time') {
            return $shiftReguler->start_time;
        } elseif ($key == 'company_end_time') {
            return $shiftReguler->end_time;
        } elseif ($key == 'company_break_in_time') {
            $breakStart = $shiftReguler->break_time()->first();
            return is_null($breakStart) ? '00:00' : $breakStart->start_time;
        } elseif ($key == 'company_break_end_time') {
            $breakEnd = $shiftReguler->break_time()->first();
            return is_null($breakEnd) ? '00:00' : $breakEnd->end_time;
        }
    }

    public static function getFileType($path)
    {

        $image_extensions = ['jpg', 'jpeg', 'png'];
        $file_document_extensions = ['pdf'];
        $info = pathinfo($path);
        $fileType = $info['extension'];

        if (in_array($fileType, $image_extensions)) {
            return 'image';
        } elseif (in_array($fileType, $file_document_extensions)) {
            return 'file';
        } else {
            return 'invalid extension';
        }
    }

    public static function employeePayslipDetail($employeeId)
    {
        $employee        = Employee::find($employeeId);
        $now = Carbon::now();
        $startDate = Carbon::now(); //returns current day
        $firstDay = $startDate->firstOfMonth()->format('Y-m-d');
        $lastDay = $startDate->lastOfMonth()->format('Y-m-d');

        $earning['salary']      = $employee->salary;
        $earning['allowance']   = AllowanceFinance::where('employee_id', $employeeId)->get();
        $totalAllowance = 0;
        foreach ($earning['allowance'] as $allowance) {
            $totalAllowances  = $allowance->amount;
            $totalAllowance += $totalAllowances;
        }

        $earning['basic_salary']   = Payroll::where('employee_id', $employeeId)->get();

        // $earning['reimburst']   = Reimburst::where('employee_id', $employeeId)->whereYear('created_at', '=', $now->year)
        //     ->whereMonth('created_at', '=', $now->month)->get();
        $earning['reimburst']   = Reimburst::where('employee_id', $employeeId)->get();
        $totalReimburst = 0;
        foreach ($earning['reimburst'] as $reimburst) {
            $totalReimbursts  = $reimburst->amount;
            $totalReimburst += $totalReimbursts;
        }

        $earning['overTime'] = Overtime::where('employee_id', $employeeId)->where('status', 'Approved')->whereBetween('created_at', [$firstDay, $lastDay])->get();
        $totalOvertimeAmountFee = 0;
        foreach ($earning['overTime'] as $overTime) {
            $totalCashInAdvances  = $overTime->amount_fee;
            $totalOvertimeAmountFee += floor($totalCashInAdvances);
        }

        // $deduction['cash_in_advance']   = Cash::where('employee_id', $employeeId)->whereYear('created_at', '=', $now->year)
        //     ->whereMonth('created_at', '=', $now->month)->get();
        $deduction['cash_in_advance']   = Cash::where('employee_id', $employeeId)->where('status', '!=', 'paid off')->get();
        $totalCashInAdvance = 0;
        foreach ($deduction['cash_in_advance'] as $cash_in_advance) {
            $totalCashInAdvances  = $cash_in_advance->amount / $cash_in_advance['installment'];
            $totalCashInAdvance += $totalCashInAdvances;
        }

        $deduction['denda']   = AttendanceEmployee::where('employee_id', $employeeId)->where('denda', '!=', null)->orWhere('denda', '>', 0)->whereBetween('date', [$firstDay, $lastDay])->get();
        $totalDenda = 0;
        foreach ($deduction['denda'] as $denda) {
            $totalDendas  = $denda->denda;
            $totalDenda += $totalDendas;
        }

        $bpjs_tk = Utility::where('name', 'bpjs_tk')->first();
        $bpjs_tk_val = null;
        $totalBpjsTkAmount = 0;
        if (!is_null($bpjs_tk)) {
            $bpjs_tk_val = json_decode($bpjs_tk->value, true);
            $deduction['bpjs_kesehatan']   = $bpjs_tk_val;
            if ($deduction['bpjs_kesehatan']['type'] == 'Fixed') {
                $totalVal  = $deduction['bpjs_kesehatan']['value'];
            } else {
                $totalVal  = (int)$deduction['bpjs_kesehatan']['value'] * $employee->salary / 100;
            }

            if ($employee->salary > $deduction['bpjs_kesehatan']['maximum_salary']) {
                $totalVal = 1200000;
            }
            $totalBpjsTkAmount += $totalVal;
        }

        //PPH21
        // $pph21 = Utility::where('name', 'pph21')->first();
        // $pph21_val = null;
        // $totalPph21Amount = 0;
        // $countPayslip =  count($employee->payslips);

        // if (!is_null($pph21)) {
        //     $pph21_val = json_decode($pph21->value, true);
        //     $deduction['pph21'] = $pph21_val;
        //     $annualGrossIncome = $employee->salary * 12;

        //     if ($annualGrossIncome <= $pph21_val[0]['income']) {
        //         $totalPph21Amount = $annualGrossIncome * $pph21_val[0]['percentage'] / 100;
        //     } elseif (isset($pph21_val[1]['income'])) {
        //         if ($annualGrossIncome > $pph21_val[0]['income'] && $annualGrossIncome <= $pph21_val[1]['income']) {
        //             $totalPph21Amount = $annualGrossIncome * $pph21_val[0]['percentage'] / 100;
        //         }
        //     } elseif (isset($pph21_val[2]['income'])) {
        //         if ($annualGrossIncome > $pph21_val[1]['income'] && $annualGrossIncome <= $pph21_val[2]['income']) {
        //             $totalPph21Amount = $annualGrossIncome * $pph21_val[0]['percentage'] / 100;
        //         }
        //     } elseif (isset($pph21_val[3]['income'])) {
        //         if ($annualGrossIncome > $pph21_val[2]['income'] && $annualGrossIncome <= $pph21_val[3]['income']) {
        //             $totalPph21Amount = $annualGrossIncome * $pph21_val[0]['percentage'] / 100;
        //         }
        //     } elseif (isset($pph21_val[4]['income'])) {
        //         if ($annualGrossIncome > $pph21_val[4]['income']) {
        //             $totalPph21Amount = $annualGrossIncome * $pph21_val[0]['percentage'] / 100;
        //         }
        //     } else {
        //         toast('PPH21 setting is not correct yet.', 'warning');
        //     }
        //     $totalPph21Amount = $totalPph21Amount > 0 ? $totalPph21Amount / 12 : 0; // per month / 12, Future updates should have monthly checks
        // }


        $deduction['loan']   = Loan::where('employee_id', $employeeId)->where('status', '!=', 'paid off')->get();
        $totalLoan = 0;
        foreach ($deduction['loan'] as $loan) {
            $totalReimbursts  = $loan->amount / $loan['installment'];
            $totalLoan += $totalReimbursts;
        }

        $set_bpjstk = SetBpjsTK::where('employee_id', $employeeId)->get();
        $totalJhtAmount = 0;
        $totalJpAmount = 0;
        $pension = 0;

        foreach ($set_bpjstk as $key => $value) {
            $decodeDataBpjstk = json_decode($value->bpjstk_name, true);
            foreach ($decodeDataBpjstk as $key => $value) {
                if ($value == 'JHT') {
                    $jht = Utility::where('name', 'jht')->first();
                    $jht_val = null;
                    if (!is_null($jht)) {
                        $jht_val = json_decode($jht->value, true);
                        $deduction['jht']   = $jht_val;
                        $totalVal  = 2 * $employee->salary / 100;
                        $totalJhtAmount += $totalVal;
                    }
                } elseif ($value == 'JP') {
                    // iuran untuk jaminan pensiun tiap bulan, 2% perusahaan 1% employee
                    $jp = Utility::where('name', 'jp')->first();
                    $jp_val = null;
                    if (!is_null($jp)) {
                        $jp_val = json_decode($jp->value, true);
                        $deduction['jp']   = $jp_val;
                        $totalVal  = 1 * $employee->salary / 100;

                        //if employee salary much than limit value
                        if ($employee->status == 'pension' && $employee->salary > $jp_val['maximum_limit_value']) {
                            $earning['pension'] = $jp_val['maximum_limit_value'];
                            $pension = $jp_val['maximum_limit_value'];
                        }

                        $totalJpAmount += $totalVal;
                    }
                }
            }
        }

        $set_ptkp = SetPTKP::where('employee_id', $employeeId)->get();
        $is_paid_by_employee_themselve = Utility::where('name', 'is_paid_by_employee_themselve')->first();
        $positionAllowance = 5 / 100;
        $bruto_employe_salary_per_year = $employee->salary * 12;
        $total_amount_ptkp = 0;
        $deduction['totalPph21Amount'] = 0;

        if ($is_paid_by_employee_themselve->value == false) {
            foreach ($set_ptkp as $key => $value) {
                $pph_payable_per_year = 0;
                $decodeDataPTKP = json_decode($value->ptkp_name, true);

                if (count($decodeDataPTKP) > 0) {
                    foreach ($decodeDataPTKP as $key => $value) {
                        $ptkp_amount   = PTKP::where('status_name', $value)->first()->ptkp_amount;

                        if ((int)$ptkp_amount > 0 || (int)$ptkp_amount != 0) {
                            $costPosition  = $positionAllowance * $bruto_employe_salary_per_year;
                            $netto         = $bruto_employe_salary_per_year - $costPosition;
                            $taxable_income = $netto - $ptkp_amount;

                            if ($taxable_income != 0 || $taxable_income > 0) {
                                $pph_payable_per_year =  self::income_tax_rate($taxable_income);
                                $total_amount_ptkp += $pph_payable_per_year > 0 ? $pph_payable_per_year / 12 : 0; // per month / 12, Future updates should have monthly checks
                            }
                        }
                    }
                }
            }
        }

        $deduction['total_amount_ptkp'] = $total_amount_ptkp;

        //total bpjstk
        $totalBpjsTk = $totalJhtAmount + $totalJpAmount;
        $deduction['totalBpjsTk'] = $totalBpjsTk;
        $deduction['totalPph21Amount'] = $total_amount_ptkp;

        $payslip['earning']        = $earning;
        $payslip['totalEarning']   = is_null($employee->salary) ? 0 : $employee->salary  + $totalAllowance + $totalReimburst + $totalOvertimeAmountFee + $pension;
        $payslip['deduction']      = $deduction;
        $payslip['totalDeduction'] = $totalCashInAdvance + $totalBpjsTkAmount + $totalDenda + $totalLoan + $totalBpjsTk + $total_amount_ptkp;

        return $payslip;
    }

    public static function nationalHoliday()
    {
        $nationalDaysFetch = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);


        return $nationalDaysFetch;
    }

    public static function getLevelAndApprover($levelApprove, $approvals)
    {
        $level = null;
        $approver = [];

        if (!is_null($levelApprove)) {
            for ($i = 0; $i < count($approvals); $i++) {
                if ($approvals[$i]->level == $levelApprove->level && $approvals[$i]->status != 'Rejected' && $approvals[$i]->status != 'Approved') {

                    $level = $approvals[$i]->level;
                    if ($i > 0) {
                        if ($approvals[$i - 1]->status != 'Approved' || $approvals[$i - 1]->status == 'Rejected') {
                            $level = null;
                        }
                    }
                }
            }
            $approver = $approvals->map(function ($val) {
                $name = null;
                if ($val->status == 'Approved') {
                    if ($val->is_approver_company) {
                        $name = Auth::user()->ownerDetails()->name;
                    } else {
                        $employee = Employee::find($val->approver_id);
                        $name = $employee->name . ' (' . $employee->user->getRoleNames()[0] . ')';
                    }
                    return [
                        'approver' => $name
                    ];
                }
            });
        } else {
            $level = null;
        }

        return [
            'level' => $level,
            'approver' => $approver,
        ];
    }

    public static function mergedPTKP($decodeDataPTKP)
    {
        $moduleMerged = $decodeDataPTKP;
        $split = explode('_', $decodeDataPTKP);
        if (count($split) > 1) {
            $moduleMerged = strtoupper($split[0] . $split[1]);
        }

        return $moduleMerged;
    }

    public static function income_tax_rate($taxable_income)
    {
        $pph21 = Utility::where('name', 'pph21')->first();
        $pph_payable = 0;
        if (!is_null($pph21)) {
            $pph21_val = json_decode($pph21->value, true);

            if ($taxable_income <= $pph21_val[0]['income']) {
                $percentage = $pph21_val[0]['percentage'] / 100;

                $pph_payable    = $taxable_income * $percentage;
                // array_push($percentage, $pph21_val[0]['percentage']);
            } elseif (isset($pph21_val[1]['income'])) {
                if ($taxable_income > $pph21_val[0]['income'] && $taxable_income <= $pph21_val[1]['income']) {
                    $resultFirstStatement = $pph21_val[0]['percentage'] / 100 * $pph21_val[0]['income'];
                    $resultSecStatement = $pph21_val[1]['percentage'] / 100 * ($taxable_income - $pph21_val[0]['income']);
                    $pph_payable = $resultFirstStatement + $resultSecStatement;
                }
            } elseif (isset($pph21_val[2]['income'])) {
                if ($taxable_income > $pph21_val[1]['income'] && $taxable_income <= $pph21_val[2]['income']) {
                    $resultFirstStatement = $pph21_val[0]['percentage'] / 100 * $pph21_val[0]['income'];
                    $resultSecStatement = $pph21_val[1]['percentage'] / 100 * $pph21_val[1]['income'];
                    $resultThirdStatement = $pph21_val[2]['percentage'] / 100 * ($taxable_income - $pph21_val[1]['income']);
                    $pph_payable = $resultFirstStatement + $resultSecStatement + $resultThirdStatement;
                    // $percentage = $pph21_val[0]['percentage'];
                    // array_push($percentage, $pph21_val[1]['percentage'], $pph21_val[2]['percentage']);
                }
            } elseif (isset($pph21_val[3]['income'])) {
                if ($taxable_income > $pph21_val[2]['income'] && $taxable_income <= $pph21_val[3]['income']) {
                    $resultFirstStatement = $pph21_val[0]['percentage'] / 100 * $pph21_val[0]['income'];
                    $resultSecStatement = $pph21_val[1]['percentage'] / 100 * $pph21_val[1]['income'];
                    $resultThirdStatement = $pph21_val[2]['percentage'] / 100 * $pph21_val[2]['income'];
                    $resultFourthStatement = $pph21_val[3]['percentage'] / 100 * ($taxable_income - $pph21_val[2]['income']);
                    $pph_payable = $resultFirstStatement + $resultSecStatement + $resultThirdStatement + $resultFourthStatement;
                    // $percentage = $pph21_val[0]['percentage'];
                    // array_push($percentage, $pph21_val[2]['percentage'], $pph21_val[3]['percentage']);
                }
            } elseif (isset($pph21_val[4]['income'])) {
                if ($taxable_income > $pph21_val[4]['income']) {
                    $resultFirstStatement = $pph21_val[0]['percentage'] / 100 * $pph21_val[0]['income'];
                    $resultSecStatement = $pph21_val[1]['percentage'] / 100 * $pph21_val[1]['income'];
                    $resultThirdStatement = $pph21_val[2]['percentage'] / 100 * $pph21_val[2]['income'];
                    $resultFourthStatement = $pph21_val[3]['percentage'] / 100 * $pph21_val[3]['income'];
                    $resultFifthStatement = $pph21_val[4]['percentage'] / 100 * ($taxable_income - $pph21_val[3]['income']);
                    $pph_payable = $resultFirstStatement + $resultSecStatement + $resultThirdStatement + $resultFourthStatement + $resultFifthStatement;
                    // $percentage = $pph21_val[0]['percentage'];
                    // array_push($percentage, $pph21_val[2]['percentage'], $pph21_val[4]['percentage']);
                }
            }
        }
        return $pph_payable;
    }

    public static function generatePayslip($employee, $type)
    {
        try {
            DB::beginTransaction();

            $paySlip = PaySlip::where('created_by', Auth::user()->creatorId())->where('salary_month', date('Y-m'))->first();
            $date_now = Carbon::now();

            //check ptkp
            $set_ptkp = SetPTKP::where('employee_id', $employee->id)->get();
            foreach ($set_ptkp as $key => $value) {
                $decodeDataPTKP = json_decode($value->ptkp_name, true);
                if (count($decodeDataPTKP) > 0) {
                    foreach ($decodeDataPTKP as $key => $value) {
                        $ptkp_amount   = PTKP::where('status_name', $value)->first()->ptkp_amount;
                        if ($ptkp_amount < 1 || $ptkp_amount == 0) {
                            toast('There are PTKP that do not match the employee data!', 'warning');
                            return redirect()->route('payslips.index');
                        }
                    }
                }
            }

            // if (!is_null($paySlip)) {
            //     toast('Payslip for this month has been made.', 'warning');
            //     return redirect()->route('payslips.index');
            // }

            if ($employee->salary < 0 || is_null($employee->salary)) {
                toast('Please set employee salary.', 'warning');
                return redirect()->route('payslips.index');
            }

            $payslipDetail = Utility::employeePayslipDetail($employee->id);

            $now = Carbon::now();
            $formate_month_year = $now->firstOfMonth()->format('Y-m');

            if ($employee->status != 'active') {
                $lastEmpPaySlip = PaySlip::where('created_by', Auth::user()->creatorId())->where('employee_id', $employee->id)->where('salary_month', $employee->out_date)->first();

                if (is_null($lastEmpPaySlip)) {
                    $formate_month_year = $employee->out_date;
                } else {
                    return response()->download(storage_path('app/public/' . $lastEmpPaySlip->pdf_filename));
                }
            }


            $payslipEmployee                       = new PaySlip();
            $payslipEmployee->employee_id          = $employee->id;
            $payslipEmployee->net_payble           = $payslipDetail['totalEarning'] - $payslipDetail['totalDeduction'];
            $payslipEmployee->salary_month         = $formate_month_year;
            $payslipEmployee->status               = 1;
            $payslipEmployee->basic_salary         = json_encode($payslipDetail['earning']['basic_salary']);
            $payslipEmployee->salary               = $employee->salary;
            $payslipEmployee->allowance            = json_encode($payslipDetail['earning']['allowance']);
            $payslipEmployee->reimburst            = json_encode($payslipDetail['earning']['reimburst']);
            $payslipEmployee->cash_in_advance      = json_encode($payslipDetail['deduction']['cash_in_advance']);
            $payslipEmployee->denda                = json_encode($payslipDetail['deduction']['denda']);
            $payslipEmployee->loan                 = json_encode($payslipDetail['deduction']['loan']);
            $payslipEmployee->bpjs_kesehatan       = isset($payslipDetail['deduction']['bpjs_kesehatan']) ? json_encode($payslipDetail['deduction']['bpjs_kesehatan']) : null;
            $payslipEmployee->pph21                = isset($payslipDetail['deduction']['pph21']) ? json_encode($payslipDetail['deduction']['pph21']) : null;
            $payslipEmployee->overtime             = json_encode($payslipDetail['earning']['overTime']);
            $payslipEmployee->created_by           = Auth::user()->creatorId();
            //earning
            $payslipAllowance = json_decode($payslipEmployee->allowance, true);
            $payslipReimburst = json_decode($payslipEmployee->reimburst, true);
            $payslipOvertime = json_decode($payslipEmployee->overtime, true);
            $payslipBasicSalary = json_decode($payslipEmployee->basic_salary, true);
            $pension = isset($payslipDetail['earning']['pension']) ? $payslipDetail['earning']['pension'] : 0;

            //deduction
            $payslipCashInAdvance = json_decode($payslipEmployee->cash_in_advance, true);
            $payslipLoan = json_decode($payslipEmployee->loan, true);
            $payslipDenda = json_decode($payslipEmployee->denda, true);
            $payslipBpjsK = json_decode($payslipEmployee->bpjs_kesehatan, true);
            $payslipPph21 = $payslipDetail['deduction']['totalPph21Amount'];
            $payslipBpjsTk = $payslipDetail['deduction']['totalBpjsTk'];

            $start_date = $date_now->startOfMonth()->toDateString();
            $end_date   = $date_now->endOfMonth()->toDateString();

            //attendance summary
            $scheduleWorkDay    = ShiftSchedule::where('employee_id', $employee->id)
                ->whereBetween('schedule_date', [$start_date, $end_date])
                ->where('is_dayoff', false)
                ->get()
                ->count();
            $dayoffs    = ShiftSchedule::where('employee_id', $employee->id)
                ->whereBetween('schedule_date', [$start_date, $end_date])
                ->where('is_dayoff', true)->where('dayoff_type', 'Dayoff')
                ->get()
                ->count();
            $actualWorkDay      = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', 'Present')
                ->where('clock_in', '!=', '00:00:00')
                ->where('clock_out', '!=', '00:00:00')
                ->get()
                ->count();
            $attendanceSts     = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', '!=', 'Present')
                ->where('status', '!=', 'Leave')
                ->where('status', '!=', 'Permit')
                ->where('status', '!=', 'Sick With Letter')
                ->get()
                ->count();
            $attendanceSds     = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', 'Sick With Letter')
                ->get()
                ->count();
            $attendanceIzn     = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', 'Permit')
                ->get()
                ->count();
            $attendanceCt     = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', 'Leave')
                ->get()
                ->count();
            $nationalHolidays    = ShiftSchedule::where('employee_id', $employee->id)
                ->whereBetween('schedule_date', [$start_date, $end_date])
                ->where('is_dayoff', true)->where('dayoff_type', 'National Holiday')
                ->get()
                ->count();
            $companyHolidays    = ShiftSchedule::where('employee_id', $employee->id)
                ->whereBetween('schedule_date', [$start_date, $end_date])
                ->where('is_dayoff', true)
                ->where('dayoff_type', 'Company Holiday')
                ->get()->count();
            $shiftSchedules    = ShiftSchedule::where('employee_id', $employee->id)
                ->whereBetween('schedule_date', [$start_date, $end_date])
                ->where('is_dayoff', false)
                ->get();
            $employeeAtt        = AttendanceEmployee::where('employee_id', $employee->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->get();

            $attendanceSummary = [
                'actual_work_day'   => $actualWorkDay,
                'schedule_work_day' => $scheduleWorkDay,
                'dayoff'            => $dayoffs,
                'national_holiday'  => $nationalHolidays,
                'company_holiday'  => $companyHolidays,
            ];

            $timeOffCodes = [
                'H' => $actualWorkDay,
                'STS' => $attendanceSts,
                'SDS' => $attendanceSds,
                'IZN' => $attendanceIzn,
                'CT' => $attendanceCt,
            ];

            $checklists = ChecklistAttendanceSummary::where('created_by', Auth::user()->creatorId())->get();

            $pdf = PDF::setOption([
                'isRemoteEnabled' => true,
                'debugPng' => true,
                'isHtml5ParserEnabled' => true,
            ])->loadView('pages.contents.payroll.payslip.pdf', compact('pension', 'payslipEmployee', 'employee', 'payslipAllowance', 'payslipReimburst', 'payslipOvertime', 'payslipBasicSalary', 'payslipCashInAdvance', 'payslipDenda', 'payslipBpjsK', 'payslipDetail', 'payslipPph21', 'payslipLoan', 'payslipBpjsTk', 'attendanceSummary', 'timeOffCodes', 'checklists'));

            $pdfToStorage = Storage::disk('public')->put('Payslip '  . $employee->name . ' ' . $payslipEmployee->salary_month . '.pdf', $pdf->output());
            if ($pdfToStorage) {
                $payslipEmployee->pdf_filename           = 'Payslip ' . $employee->name . ' ' . $payslipEmployee->salary_month . '.pdf';
            }

            //increment number of installment loan & cash
            if (count($payslipLoan) > 0) {
                foreach ($payslipLoan as $key => $value) {
                    $loan = Loan::find($value['id']);
                    if (!is_null($loan) && $loan->number_of_installment < $loan->installment) {
                        $loan->number_of_installment += 1;
                        $loan->save();
                    } else {
                        $loan->status = 'paid off';
                        $loan->save();
                    }
                }
            }

            if (count($payslipCashInAdvance) > 0) {
                foreach ($payslipCashInAdvance as $key => $value) {
                    $cash = Cash::find($value['id']);
                    if (!is_null($cash) && $cash->number_of_installment < $cash->installment) {
                        $cash->number_of_installment += 1;
                        $cash->save();
                    } else {
                        $cash->status = 'paid off';
                        $cash->save();
                    }
                }
            }

            $payslipEmployee->save();
            if ($type == 'download') {
                DB::commit();

                return $pdf->download('Payslip ' . $payslipEmployee->salary_month . '.pdf');
            }

            DB::commit();

            // $dompdf = new Dompdf();
            // $dompdf->loadHtml(ob_get_clean());
            // $dompdf->render();
            // return $dompdf->stream("pages.contents.payroll.payslip.pdf", compact('pension', 'payslipEmployee', 'employee', 'payslipAllowance', 'payslipReimburst', 'payslipOvertime', 'payslipBasicSalary', 'payslipCashInAdvance', 'payslipDenda', 'payslipBpjsK', 'payslipDetail', 'payslipPph21', 'payslipLoan', 'payslipBpjsTk', 'attendanceSummary', 'timeOffCodes', 'checklists'));

            return $pdf->stream('Payslip ' . $payslipEmployee->salary_month . '.pdf');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e);
        }
    }

    public static function filterChart($request)
    {
        // dd($request);
        $dateTo = Carbon::parse(DateTime::createFromFormat('M Y', $request['dateTo'])->format('Y-m-d'));
        $dateInitialYear = Carbon::parse(DateTime::createFromFormat('M Y', $request['dateFrom'])->format('Y-m-d'));
        $branch = Branch::find($request['branch_id']);

        $months = [];
        if (isset($request['chart_type'])) {
            if ($request['chart_type'] == 'attendance') {
                for ($i = 0; $i <= $dateTo->diffInMonths($dateInitialYear); $i++) {
                    $month = Carbon::createFromDate($dateTo->format('Y'), $i + 1, 1);

                    $onTime  = AttendanceEmployee::select('id')
                        ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                        ->where('attendance_employees.status', 'Present')
                        ->where('attendance_employees.late', '00:00:00')
                        ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('attendance_employees.date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $totalLate  = AttendanceEmployee::select('id')
                        ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                        ->where('attendance_employees.status', 'Present')
                        ->where('attendance_employees.late', '!=', '00:00:00')
                        ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('attendance_employees.date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $totalAlpha  = AttendanceEmployee::select('id')
                        ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                        ->where('attendance_employees.status', '!=', 'Present')
                        ->where('attendance_employees.status', '!=', 'Leave')
                        ->where('attendance_employees.status', '!=', 'Permit')
                        ->where('attendance_employees.status', '!=', 'Sick With Letter')
                        ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('attendance_employees.date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $totalLeave  = AttendanceEmployee::select('id')
                        ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                        ->where('attendance_employees.status', 'Leave')
                        ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('attendance_employees.date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $totalSick  = AttendanceEmployee::select('id')
                        ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                        ->where('attendance_employees.status', 'Sick With Letter')
                        ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('attendance_employees.date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);


                    if (is_null($branch)) {
                        $onTime  = $onTime->count();
                        $totalLate  = $totalLate->count();
                        $totalAlpha  = $totalAlpha->count();
                        $totalLeave  = $totalLeave->count();
                        $totalSick  = $totalSick->count();
                    } else {
                        $onTime  = $onTime->where('employees.branch_id', $branch->id)->count();
                        $totalLate  = $totalLate->where('employees.branch_id', $branch->id)->count();
                        $totalAlpha  = $totalAlpha->where('employees.branch_id', $branch->id)->count();
                        $totalLeave  = $totalLeave->where('employees.branch_id', $branch->id)->count();
                        $totalSick  = $totalSick->where('employees.branch_id', $branch->id)->count();
                    }

                    $months[$i]['month'] = $month->format('M');
                    if (isset($request['yKeysArr'])) {
                        $yKeys = $request['yKeysArr'];



                        if (in_array('onTime', $yKeys)) {
                            $months[$i]['onTime'] = $onTime;
                        }
                        if (in_array('totalLate', $yKeys)) {
                            $months[$i]['totalLate'] = $totalLate;
                        }
                        if (in_array('alpha', $yKeys)) {
                            $months[$i]['alpha'] = $totalAlpha;
                        }
                        if (in_array('leave', $yKeys)) {
                            $months[$i]['leave'] = $totalLeave;
                        }
                        if (in_array('sick', $yKeys)) {
                            $months[$i]['sick'] = $totalSick;
                        }
                    }
                }
            } elseif ($request['chart_type'] == 'employee_status') {
                for ($i = 0; $i <= $dateTo->diffInMonths($dateInitialYear); $i++) {
                    $month = Carbon::createFromDate($dateTo->format('Y'), $i + 1, 1);

                    $newEmployee  = Employee::select('*')
                        ->where('employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('employees.company_doj', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $outEmployee  = Employee::select('*')
                        ->where('employees.is_active', '=', false)
                        ->where('employees.created_by', '=', Auth::user()->creatorId())
                        ->whereBetween('employees.out_date', [$month->firstOfMonth()->format('Y-m-d'), $month->lastOfMonth()->format('Y-m-d')]);
                    $jobholder  = Employee::select('*')
                        ->where('employees.created_by', '=', Auth::user()->creatorId())
                        ->where('employees.is_active', '=', true)
                        ->where('employees.employee_type', '=', 'jobholder')
                        ->where('employees.company_doj', '<=', now()->format('Y-m-d'))
                        ->where('employees.company_doe', '>=', now()->format('Y-m-d'));
                    $contract  = Employee::select('*')
                        ->where('employees.created_by', '=', Auth::user()->creatorId())
                        ->where('employees.is_active', '=', true)
                        ->where('employees.employee_type', '!=', 'jobholder')
                        ->where('employees.company_doj', '<=', now()->format('Y-m-d'))
                        ->where('employees.company_doe', '>=', now()->format('Y-m-d'));
                    $freelance  = Employee::select('*')
                        ->where('employees.created_by', '=', Auth::user()->creatorId())
                        ->where('employees.is_active', '=', true)
                        ->where('employees.employee_type', '=', 'freelancers')
                        ->where('employees.company_doj', '<=', now()->format('Y-m-d'))
                        ->where('employees.company_doe', '>=', now()->format('Y-m-d'));

                    if (is_null($branch)) {
                        $newEmployee  = $newEmployee->count();
                        $outEmployee  = $outEmployee->count();
                        $jobholder  = $jobholder->count();
                        $contract  = $contract->count();
                        $freelance  = $freelance->count();
                    } else {
                        $newEmployee  = $newEmployee->where('employees.branch_id', $branch->id)->count();
                        $outEmployee  = $outEmployee->where('employees.branch_id', $branch->id)->count();
                        $jobholder  = $jobholder->where('employees.branch_id', $branch->id)->count();
                        $contract  = $contract->where('employees.branch_id', $branch->id)->count();
                        $freelance  = $freelance->where('employees.branch_id', $branch->id)->count();
                    }

                    $months[$i]['month'] = $month->format('M');
                    if (isset($request['yKeysArr'])) {
                        $yKeys = $request['yKeysArr'];

                        if (in_array('newEmployee', $yKeys)) {
                            $months[$i]['newEmployee'] = $newEmployee;
                        }
                        if (in_array('outEmployee', $yKeys)) {
                            $months[$i]['outEmployee'] = $outEmployee;
                        }
                        if (in_array('jobholder', $yKeys)) {
                            $months[$i]['jobholder'] = $jobholder;
                        }
                        if (in_array('contract', $yKeys)) {
                            $months[$i]['contract'] = $contract;
                        }
                        if (in_array('freelance', $yKeys)) {
                            $months[$i]['freelance'] = $freelance;
                        }
                    }
                }
            }
        }
        return $months;
    }
}
