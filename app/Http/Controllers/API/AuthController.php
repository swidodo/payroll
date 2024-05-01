<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => $validateData->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $email = strtolower($request->email);
        $user = User::whereRaw("LOWER(email) = '" . $email."'")->first();
        if (!$user) {
            $user = User::whereHas('employee', function ($q) use ($email) {
                $q->whereRaw("LOWER(no_employee) = '".$email."'");
            })->first();
            
            if($user){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => [
                        'email' => ['Utk sementara silahkan login menggunakan Email Anda']
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            
        }
        if (!$user) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => [
                    'email' => ['Email/NIP tidak dikenali']
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => [
                    'password' => ['Password salah']
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        Auth::login($user);
        return $this->createNewToken();
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        Auth::user()->tokens()->delete();
        $response = [
            'status' => Response::HTTP_OK,
            'message' => 'Successfully logged out'
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    
    /**
     * change_password
     *
     * @param  mixed $request
     * @return void
     */
    public function change_password(Request $request)
    {
        $User = Auth::user();
        $data = json_decode($request->data);
        if (!Hash::check($data->old_password, $User->password)) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => ['old_password' => ['Password salah']]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        if ($data->new_password != $data->confirm_password) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => ['confirm_password' => ['Password tidak sama']]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (Hash::check($data->new_password, $User->password)) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => ['new_password' => ['Password harus berbeda dgn password lama']]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $User->password = Hash::make($data->new_password);
        $User->save();
        return $this->profile();
    }

    /**
     * profile
     *
     * @return void
     */
    public function profile()
    {
        $user = Auth::user();
        $userData = [
            'name' => $user->name,
            'initials' => $user->initial,
            'email' => $user->email,
            'profile_pic' => $user->avatar,
            'branch' => isset($user->employee->branch) ? $user->employee->branch->name : 'Unknown company'
        ];
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $userData
        ], Response::HTTP_OK);
    }
    public function change_profile(Request $request){
        try{
            $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('branches.id',$request->branch_id)->first();
            $company    =  $dta->branch_name;
            $branch     =  $dta->company_name;
            $tahun      =  date('Y');
            $bulan      =  date('m');
            $tanggal    =  date('d-m-Y');
            $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
            $path       = 'profile/'.$dir.$request->get('foto');
            if (! Storage::exists($path)) {
                Storage::makeDirectory($path,775,true);
            }

            $fileName               = time() . $request->file('foto')->getClientOriginalName();
            $store                  = $request->file('foto')->storeAs($path, $fileName);
            $pathFile_application   = 'storage/app/public/'.$path . $fileName ?? null;
            $base                   = URL::to('/');
            $link_foto              = $base.'/'.$pathFile_application;
            $user = [
                'avatar' => $link_foto
            ];
            User::where('id', Auth::user()->id)->update($user);
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $userData
            ], Response::HTTP_OK);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'mesage' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    protected function createNewToken()
    {
        $user = Auth::user();
        $user->update(['last_login_at' => Carbon::now()]);
        $emp = Employee::select('id','department_id','branch_id','no_employee')
                    ->where('user_id',$user->id)
                    ->first();
        $userData = [
            'name'          => $user->name,
            'initials'      => $user->initial,
            'email'         => $user->email,
            'profile_pic'   => $user->avatar,
            'branch'        => isset($user->employee->branch) ? $user->employee->branch->name : 'Unknown company',
            'branch_id'     => $emp->branch_id,
            'department_id' => $emp->department_id,
            'employee_id'   => $emp->id,
            'employee_no'   => $emp->no_employee

        ];
        $menu = DB::table('v_menu_access_mobile')
                   ->where('branch_id',$user->branch_id)->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => [
                'access_token'  => $user->createToken('auth_token')->plainTextToken,
                'token_type'    => 'Bearer',
                'user'          => $userData,
                'menu'          => $menu
            ]
        ], Response::HTTP_OK);
    }
}
