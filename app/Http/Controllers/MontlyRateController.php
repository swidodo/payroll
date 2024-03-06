<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MontlyRateRelative;
use App\Models\MonthlyRateAbsolute;

class MontlyRateController extends Controller
{
    public function index(){
        $data['rate'] = MonthlyRateAbsolute::orderBy('start_value','ASC')->get();
        return view('pages.contents.tarif_pph21.index',$data);
    }
    public function categoryA(){
        $data['category_a'] = MontlyRateRelative::where('category','A')->orderBy('start_value','ASC')->get();
        return view('pages.contents.tarif_pph21.category-a',$data);
    }
    public function categoryB(){
        $data['category_b'] = MontlyRateRelative::where('category','B')->orderBy('start_value','ASC')->get();
        return view('pages.contents.tarif_pph21.category-b',$data);
    }
    public function categoryC(){
        $data['category_c'] = MontlyRateRelative::where('category','C')->orderBy('start_value','ASC')->get();
        return view('pages.contents.tarif_pph21.category-c',$data);
    }
    public function daily_rate(){
        $data['category_harian'] = MontlyRateRelative::where('category','H')->orderBy('end_value','ASC')->get();
        return view('pages.contents.tarif_pph21.category-harian',$data);
    }
    public function edit(Request $request){
        $data = MontlyRateRelative::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function update(Request $request){
        try {
            $data = [
                'start_value'   => $request->start_value,
                'end_value'     => $request->end_value,
                'tarif'         => $request->tarif
            ];
            MontlyRateRelative::where('id',$request->id)->update($data);
            $res = [
                'status'    => 'success',
                'msg'       => 'Data successfuly updated.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status'    => 'success',
                'msg'       => 'Data successfuly updated.'
            ];
            return response()->json($res);
        }
    }
    public function edit_rate_absolute_employee(Request $request){
        $data = MonthlyRateAbsolute::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function update_rate_absolute_employee(Request $request){
        try {
            $data = [
                'start_value'   => $request->start_value,
                'end_value'     => $request->end_value,
                'tarif'         => $request->tarif
            ];
            MonthlyRateAbsolute::where('id',$request->id)->update($data);
            $res = [
                'status'    => 'success',
                'msg'       => 'Data successfuly updated.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status'    => 'success',
                'msg'       => 'Data successfuly updated.'
            ];
            return response()->json($res);
        }
    }
}
