<?php

namespace App\Http\Controllers;

use App\Models\CompanyHoliday;
use App\Models\ShiftSchedule;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyHolidayController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage company holiday')) {
            $holidays = CompanyHoliday::where('created_by', Auth::user()->creatorId())
                ->get()
                ->map(function ($item) {
                    return [
                        'title'     => $item->desc,
                        'start'     => $item->company_holiday_date,
                        'className' =>  'bg-danger'
                    ];
                });

            // return view('pages.contents.company-holiday.index', compact('holidays'));
            return view('pages.contents.company-holiday.calendar', compact('holidays'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create company holiday')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_holiday_date' => 'required',
                    'description' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                ShiftSchedule::updateShift($request->company_holiday_date, 'Y-m-d', 'Company Holiday', 'Company Holiday');

                CompanyHoliday::create([
                    'company_holiday_date'   => $request->company_holiday_date,
                    'desc'                   => $request->description,
                    'created_by'             => Auth::user()->creatorId()
                ]);

                DB::commit();
                toast('Successfully create company holiday.', 'success');
                return redirect()->route('company-holiday.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.' . $e, 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->can('edit company holiday')) {
            $dayoff = CompanyHoliday::find($id);

            return response()->json($dayoff);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('create company holiday')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_holiday_date' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                $comHoliday = CompanyHoliday::find($id);
                DB::beginTransaction();

                ShiftSchedule::updateShift($request->company_holiday_date, 'Y-m-d', 'Company Holiday', 'Company Holiday');

                $comHoliday->company_holiday_date = $request->company_holiday_date;
                $comHoliday->save();

                DB::commit();
                toast('Successfully update company holiday.', 'success');
                return redirect()->route('company-holiday.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $comHoliday = CompanyHoliday::find($id);
        if (Auth::user()->can('delete company holiday')) {
            if ($comHoliday->created_by == Auth::user()->creatorId()) {
                ShiftSchedule::destroyHoliday($comHoliday->company_holiday_date, 'Y-m-d');
                $comHoliday->delete();

                toast('Company Holiday successfully deleted.', 'success');
                return redirect()->route('company-holiday.index');
            } else {
                toast('Permission denied.', 'error');
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function importExcel()
    {
        $file_extension = request()->file('file-excel')->extension();
        if ('csv' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ('xls' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ('xlsx' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            toast('Format tidak sesuai', 'error');
            return redirect()->back();
        }

        $spreadsheet = $reader->load(request()->file('file-excel'));
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheetData as $key => $value) {
            try {
                if (is_integer($value[0]) && $date = DateTime::createFromFormat('d/m/Y', $value[1])) {
                    DB::beginTransaction();
                    $compHol = CompanyHoliday::where('company_holiday_date', $date->format('Y-m-d'))->where('created_by', Auth::user()->creatorId())->first();
                    if (is_null($compHol)) {
                        ShiftSchedule::updateShiftImport($date->format('Y-m-d'), 'Y-m-d', 'Company Holiday', $value[2]);

                        CompanyHoliday::create([
                            'company_holiday_date'   => $date->format('Y-m-d'),
                            'desc'                   => $value[2],
                            'created_by'             => Auth::user()->creatorId()
                        ]);
                    }
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something wrong went Import Company Holiday', 'error');
                return redirect()->back();
            }
        }

        toast('Successfully Import Company Holiday', 'success');
        return redirect()->back();
    }
}
