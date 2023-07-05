<?php

namespace App\Exports;

use App\Models\Travel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class TravelExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Travel::all();
    // }

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        return view('pages.contents.travel.export-excel', [
            'travels' => Travel::where('created_by', Auth::user()->creatorId())->whereBetween('created_at', [$this->request->start_date, $this->request->end_date])->get()
        ]);
    }
}
