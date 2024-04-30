<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MenuController extends Controller
{
    public function index(){
        $data = DB::table('access_mobiles')
                ->select('access_mobiles.menu_id','menus.name','access_mobiles.branch_id','access_mobiles.status')
                ->leftJoin('menus','menus.id','access_mobiles.menu_id')
                ->where('access_mobiles.branch_id',Auth::user()->branch_id)->get();
        return response()->json($data, Response::HTTP_OK);
    }
}