<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\LogEmployeeResume;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class EmployeeResume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee-resume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check employee birthday and contract end';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $companies =  User::where('type', 'company')->get();

        foreach ($companies as $k => $v) {
            $employees =  Employee::where('created_by', $v->creatorId())
                ->get();

            $employeeBranchContractWillEnd = [];
            foreach ($employees as $key => $value) {
                $employeeContractEnd = Carbon::createFromDate($value->company_doe);
                $submonth = $employeeContractEnd->subMonth();

                if (now()->format('Y-m-d') == $submonth->format('Y-m-d')) {
                    array_push($employeeBranchContractWillEnd, $value->branch_id);
                }

                $dob = Carbon::createFromDate($value->dob)->subDay();
                if (now()->format('m-d') == $dob->format('m-d')) {
                    LogEmployeeResume::create([
                        'branch_id' => $value->branch_id,
                        'date'      => now(),
                        'activity'  => $value->name . ' will have a birthday on ' . $dob->addDay()->format('D jS F'),
                        'created_by' => $value->user->creatorId()
                    ]);
                }
            }

            if (count($employeeBranchContractWillEnd) > 0) {
                $sameVal = array_count_values($employeeBranchContractWillEnd);
                foreach ($sameVal as $key => $value) {
                    LogEmployeeResume::create([
                        'branch_id' => $key,
                        'date'      => now(),
                        'activity'  => $value . ' Employee contract will end in the next month',
                        'created_by' => $v->creatorId()
                    ]);
                }
            }
        }
    }
}
