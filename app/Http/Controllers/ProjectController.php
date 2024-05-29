<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        
        if (Auth::user()->can('manage project')) {
            // if (Auth::user()->type != 'company') {
            //     // $user     = Auth::user();
            //     // $employee = Employee::where('user_id', '=', $user->id)->get();
            //     // $leaves  = Leave::where('employee_id', '=', $user->employee->id)->get();
            //     // $leaveType = LeaveType::where('created_by', '=', Auth::user()->creatorId())->get();
            //     $users   = User::where('created_by', '=', Auth::user()->creatorId())->where('type', '!=', 'client')->get();


            //     return view('pages.contents.projects.index', compact('users'));
            // } else {
                // $leaves = Leave::where('created_by', '=', Auth::user()->creatorId())->get();
                // $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                // $leaveType = LeaveType::where('created_by', '=', Auth::user()->creatorId())->get();
                $users   = User::where('created_by', '=', Auth::user()->creatorId())->where('type', '!=', 'client')->get();
                $projects = Project::where('created_by', Auth::user()->creatorId())->get();

                return view('pages.contents.projects.index', compact('users', 'projects'));
            // }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create project')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'project_name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            try {
                DB::beginTransaction();

                $project = new Project();
                $project->project_name = $request->project_name;
                $project->start_date = date("Y-m-d H:i:s", strtotime($request->start_date));
                $project->end_date = date("Y-m-d H:i:s", strtotime($request->end_date));

                if ($request->hasFile('project_image')) {
                    $imageName = time() . '.' . $request->project_image->extension();
                    $request->file('project_image')->storeAs('public', $imageName);
                    $pathFile = 'storage/' . $imageName ?? null;
                    $project->project_image = $pathFile;
                }

                $project->client = $request->client_name;
                $project->budget = !empty($request->budget) ? $request->budget : 0;
                $project->description = $request->description;
                $project->status = $request->status;
                $project->estimated_hrs = $request->estimated_hrs;
                $project->created_by = Auth::user()->creatorId();
                $project->save();

                ProjectUser::create(
                    [
                        'project_id' => $project->id,
                        'user_id' => Auth::user()->id,
                    ]
                );

                ProjectUser::create(
                    [
                        'project_id' => $project->id,
                        'user_id' => $request->user_id,
                    ]
                );

                // if ($request->user_id) {
                //     foreach ($request->user as $key => $value) {
                //         ProjectUser::create(
                //             [
                //                 'project_id' => $project->id,
                //                 'user_id' => $value,
                //             ]
                //         );
                //     }
                // }

                DB::commit();
                toast('Project successfully created.', 'success');
                return redirect()->route('projects.index');
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
        $project = Project::find($id);
        if (Auth::user()->can('edit project')) {
            if ($project->created_by == Auth::user()->creatorId()) {

                return response()->json($project);
                // return view('projects.edit', compact('project', 'employees', 'projecttypes'));
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit leave')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'project_name' => 'required',
                ]
            );


            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $project    =  Project::find($id);

                $project->project_name = $request->project_name;
                $project->start_date = date("Y-m-d H:i:s", strtotime($request->start_date));
                $project->end_date = date("Y-m-d H:i:s", strtotime($request->end_date));

                if ($request->hasFile('project_image')) {
                    if ($project->project_image != null) {
                        $fileNameAttReject = explode('/', $project->project_image);
                        if (Storage::exists('public/' . $fileNameAttReject[1])) {
                            Storage::delete('public/' . $fileNameAttReject[1]);
                        }
                    }

                    $imageName = time() . '.' . $request->project_image->extension();
                    $request->file('project_image')->storeAs('public', $imageName);
                    $pathFile = 'storage/' . $imageName ?? null;
                    $project->project_image = $pathFile;
                }

                $project->client = $request->client_name;
                $project->budget = !empty($request->budget) ? $request->budget : 0;
                $project->description = $request->description;
                $project->status = $request->status;
                $project->estimated_hrs = $request->estimated_hrs;
                $project->save();

                DB::commit();
                toast('Project successfully updated.', 'success');
                return redirect()->route('projects.index');
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
        $project = Project::find($id);
        if (Auth::user()->can('delete project')) {
            if ($project->created_by == Auth::user()->creatorId()) {
                if ($project->project_image != null) {
                    $fileNameAttReject = explode('/', $project->project_image);
                    if (Storage::exists('public/' . $fileNameAttReject[1])) {
                        Storage::delete('public/' . $fileNameAttReject[1]);
                    }
                }

                $project->delete();

                toast('Projects successfully deleted.', 'success');
                return redirect()->route('projects.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function inviteProjectUserMember(Request $request)
    {
        $authuser = Auth::user();

        // Make entry in project_user tbl
        ProjectUser::create(
            [
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'invited_by' => $authuser->id,
            ]
        );

        // Make entry in activity_log tbl
        // ActivityLog::create(
        //     [
        //         'user_id' => $authuser->id,
        //         'project_id' => $request->project_id,
        //         'log_type' => 'Invite User',
        //         'remark' => json_encode(['title' => $authuser->name]),
        //     ]
        // );

        return json_encode(
            [
                'code' => 200,
                'status' => 'Success',
                'success' => __('User invited successfully.'),
            ]
        );
    }
}
