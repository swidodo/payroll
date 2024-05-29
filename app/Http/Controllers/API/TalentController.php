<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TalentController extends Controller
{
    public function index(){
        try{
            $cekUser = ProjectUser::where('user_id',Auth::user()->id)->get();
            if(count($cekUser) > 0){
                $project = [];
                foreach ($cekUser as $proj){
                    array_push($project, $proj->project_id);
                }
                if(count($project) > 0){
                    $data = Project::whereIn('id',$project)
                            ->orderBy('start_date','DESC')
                            ->get();
                }else{
                    return response()->json([
                        'status' => Response::HTTP_OK,
                        'message' => "You don't have project.",
                    ], Response::HTTP_OK);
                }
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'result' => $data,
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => "You don't have project.",
                ], Response::HTTP_OK);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }   
}
