<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\ShiftSchedule;
use App\Models\User;
use App\Models\Utility;
use Exception;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        dd($data);
        $user       = Auth::user();
        $roles      = Role::where('created_by', '=', $user->creatorId())->where('name', '!=', 'client')->get();
        $branches   = Branch::where('created_by', Auth::user()->creatorId())->get();
        if (Auth::user()->can('manage user')) {
            if (Auth::user()->type == 'super admin') {
                $users = User::where('created_by', '=', $user->creatorId())->where('type', '=', 'company')->get();
            } else {
                $users = User::where('created_by', '=', $user->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'super admin')->orWhere('type', '=', null)->get();
            }
            return view('pages.contents.users management.users.index', compact('users', 'roles', 'branches'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user  = Auth::user();
        // if(Auth::user()->can('create user'))
        // {
        //     return view('');
        // }
        // else
        // {
        //     return redirect()->back();
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create user')) {
            // $default_language = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            if (Auth::user()->type == 'super admin') {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:120',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:8',
                    // 'doj' => 'required|date',
                    // 'doe' => 'required|date',
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
                    'branch_id'    => 'required|not_in:0',
                    'role'      => 'required|not_in:0',
                    'employee_type'      => 'required|not_in:0',
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

                    $role_r                = Role::findById($request->role);
                    // $psw                   = $request->password;
                    $request['password']   = Hash::make($request->password);
                    $request['type']       = $role_r->name;
                    $request['lang']       = !empty($default_language) ? $default_language->value : 'en';
                    $request['created_by'] = Auth::user()->creatorId();
                    $user = User::create($request->except('branch_id'));
                    $user->assignRole($role_r);

                    if ($request['type'] != 'client') {
                        Utility::createEmployee($user->id, Auth::user()->creatorId(), $request->all());
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    dd($e);

                    toast('Something went wrong.', 'error');
                    return redirect()->back();
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
            toast('User successfully created.', 'success');
            return redirect()->route('users.index');
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
    public function edit($id)
    {
        $user = User::with(['roles', 'employee'])->where('id', $id)->first();

        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit user')) {
            if (Auth::user()->type == 'super admin') {
                $user = User::findOrFail($id);
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
                $user = User::findOrFail($id);
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
                    Utility::updateEmployee($user->id, Auth::user()->creatorId(), $request->all());
                    $roles[] = $role->name;
                    $user->syncRoles($roles);
                    DB::commit();
                    toast('User successfully updated.', 'success');
                    return redirect()->route('users.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    dd($e);
                    toast('Something went wrong.', 'error');
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete user')) {
            $user = User::find($id);
            if ($user) {
                if (Auth::user()->type == 'super admin') {
                    if ($user->delete_status == 0) {
                        $user->delete_status = 1;
                    } else {
                        $user->delete_status = 0;
                    }
                    $user->save();
                }
                if (Auth::user()->type == 'company') {
                    // $employee = Employee::where(['user_id' => $user->id])->delete();
                    // if($employee){
                    //     $delete_user = User::where(['id' => $user->id])->delete();
                    //     if($delete_user){
                    //         return redirect()->route('users.index')->with('success', __('User successfully deleted .'));
                    //     }else{
                    //         return redirect()->back()->with('error', __('Something is wrong.'));
                    //     }
                    // }else{
                    //     return redirect()->back()->with('error', __('Something is wrong.'));
                    // }

                    $employee = Employee::where(['user_id' => $user->id])->first();

                    ShiftSchedule::where('employee_id', $employee->id)->update(['is_active' => false]);

                    $employee->delete();
                    if ($employee) {
                        $delete_user = User::where(['id' => $user->id])->delete();
                        if ($delete_user) {
                            return redirect()->route('users.index')->with('success', 'User successfully deleted.');
                        } else {
                            return redirect()->back()->with('error', 'Something is wrong.');
                        }
                    }
                }

                toast('User successfully deleted.', 'success');
                return redirect()->route('users.index');
            } else {
                return redirect()->back()->with('error', 'Something is wrong.');
            }
        } else {
            return redirect()->back();
        }
    }
}
