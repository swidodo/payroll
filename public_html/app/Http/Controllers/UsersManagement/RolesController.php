<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage role')) {
            if (Auth::user()->can('create role')) {
                $user = Auth::user();

                if ($user->type == 'super admin') {
                    $permissions = Permission::all()->pluck('name', 'id')->toArray();
                } else {
                    $permissions = new Collection();

                    foreach ($user->roles as $role) {
                        $permissions = $permissions->merge($role->permissions);
                    }
                    $permissions = $permissions->pluck('name', 'id')->toArray();
                }

                // return view('role.create', ['permissions' => $permissions]);
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }

            $roles = Role::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.users management.roles.index', compact('roles', 'permissions'));
        } else {
            toast('Permission denied.', 'error');
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
        if (Auth::user()->can('create role')) {
            $user = Auth::user();
            if ($user->type == 'super admin') {
                $permissions = Permission::all()->pluck('name', 'id')->toArray();
            } else {
                $permissions = new Collection();

                foreach ($user->roles as $role) {
                    $permissions = $permissions->merge($role->permissions);
                }
                $permissions = $permissions->pluck('name', 'id')->toArray();
            }

            return view('role.create', ['permissions' => $permissions]);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->can('create role')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:100|unique:roles,name,NULL,id,created_by,' . Auth::user()->creatorId(),
                    'permissions' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            try {
                DB::beginTransaction();
                $name             = $request['name'];
                $role             = new Role();
                $role->name       = $name;
                $role->created_by = Auth::user()->creatorId();
                $permissions      = $request['permissions'];
                $role->save();

                foreach ($permissions as $permission) {
                    $p = Permission::where('id', '=', $permission)->firstOrFail();
                    $role->givePermissionTo($p);
                }

                DB::commit();
                toast('Role successfully created.', 'success');
                return redirect()->route('roles.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Failure occurred.', 'error');
                return redirect()->back();
            }
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
    public function edit(Role $role)
    {
        if (Auth::user()->can('edit role')) {
            $user = Auth::user();
            if ($user->type == 'super admin') {
                $permissions = Permission::all()->pluck('name', 'id')->toArray();
            } else {
                $permissions = $role->permissions->pluck('name', 'id')->toArray();
            }

            return response()->json([
                'role'         => $role,
                'permissions'  => $permissions,
            ]);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (Auth::user()->can('edit role')) {
            // $validator = Validator::make(
            //     $request->all(),
            //     [
            //         'name' => 'required|max:100|unique:roles,name,' . $role['id'] . ',id,created_by,' . Auth::user()->creatorId(),
            //         'permissions' => 'required',
            //     ]
            // );

            // if ($validator->fails()) {

            //     return redirect()->back()->with([
            //         'errors'    => $validator->messages(),
            //         'edit-show' => true,
            //     ]);
            // }

            // dd($request->all());

            try {
                DB::beginTransaction();
                $role->users()->update(['type' => $request->name]);
                $input       = $request->except(['permissions']);
                $permissions = $request['permissions'];
                $role->fill($input)->save();


                $p_all = Permission::all();

                foreach ($p_all as $p) {
                    $role->revokePermissionTo($p);
                }

                # code...
                if (!is_null($permissions)) {
                    foreach ($permissions as $permission) {
                        $p = Permission::where('id', '=', $permission)->firstOrFail();
                        $role->givePermissionTo($p);
                    }
                }

                DB::commit();

                toast('Role successfully updated.', 'success');
                return redirect()->route('roles.index');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                toast('Failure occurred.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (Auth::user()->can('delete role')) {
            $role->users()->update(['type' => null]);
            $role->delete();

            toast('Role successfully deleted.', 'success');
            return redirect()->route('roles.index');
        } else {
            toast('Permission denied.', 'error');

            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
