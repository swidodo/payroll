<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\ShiftSchedule;
use App\Models\User;
use App\Models\Utility;
use App\Models\Company;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

use function GuzzleHttp\Promise\all;

class UsersController extends Controller
{
   
    public function index()
    {
    //    User::where('email','9KR@33')->update(['password'=>'$2y$10$jTaWSvVzivCMRyQKZGzKH.1GxGe/eQIfU9OM.KQ1ayCwzB9KbWwRu']);
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        if (Auth::user()->type == 'superadmin'){
            $data['company'] = Company::all();
            return view('pages.contents.users management.users.index',$data);
        }else if(Auth::user()->type == 'company'){
            if (Auth::user()->can('manage user')) {
                $data['company'] = Company::all();
                $data['branch']  = Branch::all();
                // $data['company'] = Company::where('id',$branch->company_id)->get();
                // $data['branch']  = Branch::where('company_id',$branch->company_id)->get();
                return view('pages.contents.users management.users.index',$data);
            }else{
                return redirect()->back();
            }
        }else{
            if (Auth::user()->can('manage user')) {
                $data['company'] = Company::where('id',$branch->company_id)->get();
                $data['branch']  = Branch::where('id',$branch->id)->get();
                return view('pages.contents.users management.users.index',$data);
            }else{
                return redirect()->back();
            }
        }
    }
    public function get_data(Request $request){
        if (!isset($request->branch_id )){
           $data = User::where('branch_id','=','7999999')->get();
        }else{
            $data = User::where('branch_id',$request->branch_id)->get();
        }
         return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit user','delete user')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit user')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-user" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i>Edit</a>';
                                }
                                if(Auth()->user()->can('delete user')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-user" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                    $btn .= '</div></div>';
                            }
                            return $btn;
                        })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function add_user_data(Request $request){
        if(Auth::user()->type == 'company'){
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['user'] = User::where('id',Auth::user()->id)->first();
            $data['branches']  = Branch::all();
            $data['role'] = Role::all();
            return response()->json($data);
        }else if(Auth::user()->initial == "HO"){
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['user'] = User::where('id',Auth::user()->id)->first();
            $data['branches']  = Branch::where('company_id',$branch->company_id)->get();
             $data['role'] = Role::all();
            $data['role'] = Role::select('roles.*')
                                ->leftJoin('users','users.id','=','roles.created_by')
                                ->leftJoin('branches','branches.id','=','users.branch_id')
                                ->where('branches.company_id',$branch->company_id)->get();
            return response()->json($data);
        }else{
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['user'] = User::where('id',Auth::user()->id)->first();
            $data['branches']  = Branch::where('id',$branch->id)->get();
            $data['role'] = Role::select('roles.*')
                                ->leftJoin('users','users.id','=','roles.created_by')
                                ->leftJoin('branches','branches.id','=','users.branch_id')
                                ->where('branches.id',$branch->branch_id)->get();
            return response()->json($data);
        }
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create user')) {
            // $default_language = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            if (Auth::user()->type == 'super admin') {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:120',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:8',
                    'doj' => 'required|date',
                    'doe' => 'required|date',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    DB::beginTransaction();

                    $user               = new User();
                    $user['name']       = $request->name;
                    $user['email']      = $request->email;
                    $psw                = $request->password;
                    $user['password']   = Hash::make($request->password);
                    $user['type']       = 'company';
                    $user['default_pipeline'] = 1;
                    $user['plan']       = 1;
                    $user['lang']       = !empty($default_language) ? $default_language->value : 'en';
                    $user['created_by'] = Auth::user()->creatorId();
                    // $user['plan']       = Plan::first()->id;

                    $user->save();
                    $role_r = Role::findByName('company');
                    $user->assignRole($role_r->name);

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    toast('Something went wrong.', 'error');
                    return redirect()->back();
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'name'      => 'required|max:120',
                    'email'     => 'required|email|unique:users',
                    'password'  => 'required|min:8',
                    'branch_id' => 'required|not_in:0',
                    'role'      => 'required|not_in:0',
                    'employee_type' => 'required|not_in:0',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    DB::beginTransaction();


                    // $objUser    = Auth::user()->creatorId();
                    // $objUser    = User::find($objUser);
                    // $userr       = User::find(Auth::user()->created_by);

                    // $total_user = $objUser->countUsers();
                    // $plan       = Plan::find($objUser->plan);

                    // if($total_user < $plan->max_users || $plan->max_users == -1)
                    // {
                    //     $role_r                = Role::findById($request->role);
                    //     $psw                   = $request->password;
                    //     $request['password']   = Hash::make($request->password);
                    //     $request['type']       = $role_r->name;
                    //     $request['lang']       = !empty($default_language) ? $default_language->value : 'en';
                    //     $request['created_by'] = Auth::user()->creatorId();
                    //     $user = User::create($request->all());
                    //     $user->assignRole($role_r);
                    //     if($request['type'] != 'client')
                    //       \App\Models\Utility::employeeDetails($user->id,Auth::user()->creatorId());
                    // }
                    // else
                    // {
                    //     return redirect()->back()->with('error', __('Your user limit is over, Please upgrade plan.'));
                    // }
                    $role_r  = Role::findById($request->role);
                    $pass    = Hash::make($request->password);
                    $data = [
                        'name'      => $request->name,
                        'password' => $pass,
                        'type'     => $role_r->name,
                        'lang'     => !empty($default_language) ? $default_language->value : 'en',
                        'created_by'=> Auth::user()->creatorId(),
                        'branch_id' => $request->branch_id,
                        'initial'   => $request->initial,
                        'email'   => $request->email
                    ];
                    $user = User::create($data);
                    $user->assignRole($role_r);

                    if ($request['type'] != 'client') {
                        Utility::createEmployee($user->id, Auth::user()->creatorId(), $request->all());
                    }

                    DB::commit();
                    $res = [
                        'status' =>"success",
                        'msg' =>'Create Data successfully'];
                        return response()->json($res);
                } catch (Exception $e) {
                    DB::rollBack();
                     $res = [
                        'status' =>"error",
                        'msg' =>'Something went wrong.'];
                        return response()->json($res);
                }
            }
            // Send Email
            // $setings = Utility::settings();

            // if($setings['create_user'] == 1) {
            //     $user->password = $psw;
            //     $user->type = $role_r->name;

            //     $userArr = [
            //         'email' => $user->email,
            //         'password' => $user->password,
            //     ];
            //     $resp = Utility::sendEmailTemplate('create_user', [$user->id => $user->email], $userArr);

            //     return redirect()->route('users.index')->with('success', __('User successfully created.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            // }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (Auth::user()->type == "company" && Auth::user()->initial == "HO" ){
            $user = User::where('id',$request->id)->first();
            $data['user'] = $user;
            $data['branches']  = Branch::all();
            $data['role'] = Role::all();
            return response()->json($data);
        }else if(Auth::user()->initial == "HO"){
            $user = User::where('id',$request->id)->first();
            $data['user'] = $user;
            $branch = Branch::where('id',$user->branch_id)->first();
            $data['branches']  = Branch::where('company_id',$branch->company_id)->get();
            $data['role'] = Role::select('roles.*')
                                ->leftJoin('users','users.id','=','roles.created_by')
                                ->leftJoin('branches','branches.id','=','users.branch_id')
                                ->where('branches.company_id',$branch->company_id)->get();
            return response()->json($data);
        }else{
            $user = User::where('id',$request->id)->first();
            $data['user'] = $user;
            $branch = Branch::where('id',$user->branch_id)->first();
            $data['branches']  = Branch::where('id',$branch->id)->get();

            $data['role'] = Role::select('roles.*')
                                ->leftJoin('users','users.id','=','roles.created_by')
                                ->leftJoin('branches','branches.id','=','users.branch_id')
                                ->where('branches.id',$branch->id)->get();
            return response()->json($data);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()->can('edit user')) {
            if (Auth::user()->type == 'super admin') {
                $user = User::findOrFail($request->id);
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                        'email' => 'required|email|unique:users,email',
                    ]
                );

                if ($validator->fails()) {
                    Session::put('edit-show');
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    DB::beginTransaction();
                    //$role = Role::findById($request->role);
                    $role = Role::findByName('company');
                    $input = $request->all();
                    $input['type'] = $role->name;

                    $user->fill($input)->save();
                    // CustomField::saveData($user, $request->customField);
                    $roles[] = $role->name;
                    $user->syncRoles($roles);

                    DB::commit();

                    toast('User successfully updated.', 'success');
                    return redirect()->route('users.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    toast('Something went wrong.', 'error');
                    return redirect()->back();
                }
            } else {
                $user = User::findOrFail($request->id);

                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:120',
                        'email' => 'required|email',
                        'branch_id'    => 'required|not_in:0',
                        'role'      => 'required|not_in:0',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with([
                        'errors'    => $validator->messages(),
                        'edit-show' => true,
                    ]);
                }
                try {
                    DB::beginTransaction();
                    $role          = Role::findById($request->role);
                    $input         = $request->all();
                    $input['type'] = $role->name;
                    $user->fill($input)->save();
                    // Utility::employeeDetailsUpdate($user->id,\Auth::user()->creatorId());
                    // CustomField::saveData($user, $request->customField);
                    // Utility::updateEmployee($user->id, Auth::user()->creatorId(), $request->all());
                    $roles[] = $role->name;
                    $user->syncRoles($roles);
                    DB::commit();
                   $res = [
                        'status' =>"success",
                        'msg' =>'Create Data successfully'];
                        return response()->json($res);
                } catch (Exception $e) {
                    DB::rollBack();
                     $res = [
                        'status' =>"error",
                        'msg' =>'Something went wrong.'];
                        return response()->json($res);
                }
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  id
 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->can('delete user')) {
            $user = User::find($request->id);
            if ($user) {
                if (Auth::user()->type == 'company') {
                    $employee = Employee::where(['user_id' => $user->id])->first();
                    ShiftSchedule::where('employee_id', $employee->id)->update(['is_active' => false]);
                    $employee->delete();
                    if ($employee) {
                        $delete_user = User::where(['id' => $user->id])->delete();
                        if ($delete_user) {
                            $data = [
                                'status' => 'success',
                                'msg'    => 'User successfully deleted.'
                            ];
                            return response()->json($data);
                        } else {
                            $data = [
                                'status' => 'error',
                                'msg'    => 'Something is wrong.'
                            ];
                            return response()->json($data);
                        }
                    }
                }
            } else {
                 $data = [
                        'status' => 'error',
                        'msg'    => 'Something is wrong.'
                    ];
                    return response()->json($data);
            }
        } else {
            return redirect()->back();
        }
    }
    public function change_pass(){
        $data['user'] = User::where('id',Auth::user()->id)->first();
        return view('pages.contents.users management.users.change_password',$data);
    }
    public function change_password_new(Request $request){
        $user = User::find(Auth::user()->id);
        $hasher = app('hash');
        if ($hasher->check($request->pass_old, $user->password)) {
            $passNew = Hash::make($request->pass_new);
            $update = User::where('id',Auth::user()->id)->update(['password' => $passNew]);
            if ($update){
                $res = [
                    'status' => 'success',
                    'msg'    => 'Change Password Successfuly !'
                ];
            }else{
                $res = [
                    'status' => 'error',
                    'msg'    => 'Sameting went wrong !'
                ];
            }
            return response()->json($res);
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'your password old wrong !'
            ];
            return response()->json($res);
        }
    }
}
