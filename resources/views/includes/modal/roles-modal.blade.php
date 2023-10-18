<!-- Add User Modal -->
<div id="add_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Role</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter Role Name" name="name">

                                @if ($errors->has('name'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-staff-tab" data-bs-toggle="pill" data-bs-target="#pills-staff" href="#staff" role="tab" aria-controls="pills-staff" aria-selected="true">Staff</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="pills-crm-tab" data-bs-toggle="pill" href="#crm" role="tab" aria-controls="pills-profile" aria-selected="false">CRM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-project-tab" data-bs-toggle="pill" href="#project" role="tab" aria-controls="pills-contact" aria-selected="false">Project</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-hrmpermission-tab" data-bs-toggle="pill" data-bs-target="#pills-hrmpermission" href="#pills-hrmpermission" role="tab" aria-controls="pills-hrmpermission" aria-selected="false">HRM</a>
                                </li>
                                {{--<li class="nav-item">
                                    <a class="nav-link" id="pills-account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="pills-contact" aria-selected="false">Account</a>
                                </li> --}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
                                    @php
                                        // $modules=['user','role','client','product & service','constant unit','constant tax','constant category','company settings'];
                                        $modules=['user','role', 'employee request'];
                                        //    if(Auth::user()->type == 'company'){
                                        //        $modules[] = 'permission';
                                        //    }
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">Assign General Permission to Roles</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input" name="staff_checkall_edit"  id="staff_checkall_edit" >
                                                        </th>
                                                        <th>Module </th>
                                                        <th>Permissions </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck staff_checkall"  data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}" ></td>
                                                            <td><label class="ischeck staff_checkall" data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                    <label class="custom-control-label" for="permission{{$key}}" >
                                                                                        View
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Add
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Move
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Manage
                                                                                </label>
                                                                            </div>

                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                    <label class="custom-control-label" for="permission{{$key}}" >
                                                                                        Create
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                    @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                    <label class="custom-control-label" for="permission{{$key}}" >
                                                                                        Edit
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                    <label class="custom-control-label" for="permission{{$key}}" >
                                                                                        Delete
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheck staff_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                    <label class="custom-control-label" for="permission{{$key}}" >
                                                                                        Show
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    {{--
                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif--}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 {{-- <div class="tab-pane fade" id="crm" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    @php
                                        $modules=['lead','pipeline','lead stage','source','label','deal','stage','task','form builder','form response','contract','contract type'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign CRM related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    @php
                                        $modules=['project dashboard','project','milestone','grant chart','project stage','timesheet','expense','project task','activity','CRM activity','project task stage','bug report','bug status'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign Project related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input align-middle custom_align_middle" name="project_checkall"  id="project_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input align-middle ischeck project_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck project_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input  isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="tab-pane fade" id="pills-hrmpermission" role="tabpanel" aria-labelledby="pills-hrmpermission-tab">
                                    @php
                                        $modules=['attendance', 'leave', 'overtime', 'request shift schedule', 'shift schedule', 'reimbursement option', 'branch', 'leave type', 'performance review', 'loan option', 'denda', 'bpjs kesehatan', 'allowance option', 'payslip', 'payslip type', 'day type', 'overtime type', 'shift type', 'on duty', 'timesheet', 'payroll', 'payslip code pin','rotation'];
                                        // $modules=['hrm dashboard','employee','employee profile','department','designation','branch','document type','document','payslip type','allowance','commission','allowance option','loan option','deduction option','loan','saturation deduction','other payment','overtime','set salary','pay slip','company policy','appraisal','goal tracking','goal type','indicator','event','meeting','training','trainer','training type','award','award type','resignation','travel','promotion','complaint','warning','termination','termination type','job application','job application note','job onBoard','job category','job','job stage','custom question','interview schedule','estimation','holiday','transfer','announcement','leave','leave type','attendance','rotation'];
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{'Assign HRM related Permission to Roles'}}
                                                </h6>

                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input align-middle custom_align_middle" name="hrm_checkall"  id="hrm_checkall" >
                                                        </th>
                                                        <th>{{'Module'}} </th>
                                                        <th>{{'Permissions'}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input align-middle ischeck hrm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck hrm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">

                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    View
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    add
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Manage
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('generate '.$module,(array) $permissions))
                                                                        @if($key = array_search('generate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Generate
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Create
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Edit
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Delete
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    View
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    {{-- @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    @php
                                        $modules=['account dashboard','proposal','invoice','bill','revenue','payment','proposal product','invoice product','bill product','goal','cr note','debit note','bank account','bank transfer','transaction','customer','vender','constant custom field','assets','chart of account','journal entry','report'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign Account related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input custom_align_middle" name="account_checkall"  id="account_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="table-responsive m-t-15">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>Module Permission</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Delete</th>
                                    <th class="text-center">Import</th>
                                    <th class="text-center">Export</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Employee</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Holidays</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Leaves</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Events</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

<!-- Edit User Modal -->
<div id="edit_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form-role" action="" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter Role Name" name="name" id="role-name">

                                @if ($errors->has('name'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-staffs-tab" data-bs-toggle="pill" data-bs-target="#pills-staffs" href="#staff" role="tab" aria-controls="pills-staffs" aria-selected="true">Staff</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="pills-crm-tab" data-bs-toggle="pill" href="#crm" role="tab" aria-controls="pills-profile" aria-selected="false">CRM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-project-tab" data-bs-toggle="pill" href="#project" role="tab" aria-controls="pills-contact" aria-selected="false">Project</a>
                                </li>--}}
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-hrmpermission-tab" data-bs-toggle="pill" data-bs-target="#pills-hrmpermissions" href="#pills-hrmpermission" role="tab" aria-controls="pills-hrmpermission" aria-selected="false">HRM</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="pills-account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="pills-contact" aria-selected="false">Account</a>
                                </li>  --}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-staffs" role="tabpanel" aria-labelledby="pills-staffs-tab">
                                    @php
                                        // $modules=['user','role','client','product & service','constant unit','constant tax','constant category','company settings'];
                                        $modules=['user','role', 'employee request'];
                                        //    if(Auth::user()->type == 'company'){
                                        //        $modules[] = 'permission';
                                        //    }
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">Assign General Permission to Roles</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input" name="staff_checkall_edit"  id="staff_checkall_edit" >
                                                        </th>
                                                        <th>Module </th>
                                                        <th>Permissions </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck staff_checkall_edit"  data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}" ></td>
                                                            <td><label class="ischeck staff_checkall_edit" data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                    <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                        View
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Add
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Move
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Manage
                                                                                </label>
                                                                            </div>

                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                    <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                        Create
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                    @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                    <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                        Edit
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                    <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                        Delete
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                                    <input class="form-check-input isscheckedit staff_checkall_edit isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                    <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                        Show
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    {{--
                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall_edit isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif--}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 {{-- <div class="tab-pane fade" id="crm" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    @php
                                        $modules=['lead','pipeline','lead stage','source','label','deal','stage','task','form builder','form response','contract','contract type'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign CRM related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                {{--
                                <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    @php
                                        $modules=['project dashboard','project','milestone','grant chart','project stage','timesheet','expense','project task','activity','CRM activity','project task stage','bug report','bug status'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign Project related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input align-middle custom_align_middle" name="project_checkall"  id="project_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input align-middle ischeck project_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck project_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input  isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck project_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="tab-pane fade" id="pills-hrmpermissions" role="tabpanel" aria-labelledby="pills-hrmpermissions-tab">
                                    @php
                                        $modules=['attendance', 'leave', 'overtime', 'request shift schedule', 'shift schedule', 'reimbursement option', 'branch', 'leave type', 'performance review', 'loan option', 'denda', 'bpjs kesehatan', 'allowance option', 'payslip', 'payslip type', 'day type', 'overtime type', 'shift type', 'on duty', 'timesheet', 'payroll', 'payslip code pin','rotation','request'];
                                        // $modules=['hrm dashboard','employee','employee profile','department','designation','branch','document type','document','payslip type','allowance','commission','allowance option','loan option','deduction option','loan','saturation deduction','other payment','overtime','set salary','pay slip','company policy','appraisal','goal tracking','goal type','indicator','event','meeting','training','trainer','training type','award','award type','resignation','travel','promotion','complaint','warning','termination','termination type','job application','job application note','job onBoard','job category','job','job stage','custom question','interview schedule','estimation','holiday','transfer','announcement','leave','leave type','attendance'];
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{'Assign HRM related Permission to Roles'}}
                                                </h6>

                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input align-middle custom_align_middle" name="hrm_checkall"  id="hrm_checkall" >
                                                        </th>
                                                        <th>{{'Module'}} </th>
                                                        <th>{{'Permissions'}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input align-middle ischeck hrm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck hrm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">

                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    View
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    add
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Manage
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('generate '.$module,(array) $permissions))
                                                                        @if($key = array_search('generate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheck hrm_checkall isscheck_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}" >
                                                                                    Generate
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))

                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Create
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Edit
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    Delete
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                <input class="form-check-input isscheckedit hrm_checkall isscheckedit_{{str_replace(' ', '',  str_replace('&', '', $module))}}" type="checkbox" name="permissions[]" value="{{$key}}" id="permission{{$key}}edit">

                                                                                <label class="custom-control-label" for="permission{{$key}}edit" >
                                                                                    View
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    {{-- @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    @php
                                        $modules=['account dashboard','proposal','invoice','bill','revenue','payment','proposal product','invoice product','bill product','goal','credit note','debit note','bank account','bank transfer','transaction','customer','vender','constant custom field','assets','chart of account','journal entry','report'];
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!empty($permissions))
                                                <h6 class="my-3">{{__('Assign Account related Permission to Roles')}}</h6>
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="form-check-input custom_align_middle" name="account_checkall"  id="account_checkall" >
                                                        </th>
                                                        <th>{{__('Module')}} </th>
                                                        <th>{{__('Permissions')}} </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($modules as $module)
                                                        <tr>
                                                            <td><input type="checkbox" class="form-check-input ischeck"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                                            <td><label class="ischeck" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                                            <td>
                                                                <div class="row ">
                                                                    @if(in_array('view '.$module,(array) $permissions))
                                                                        @if($key = array_search('view '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('add '.$module,(array) $permissions))
                                                                        @if($key = array_search('add '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('move '.$module,(array) $permissions))
                                                                        @if($key = array_search('move '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                                        @if($key = array_search('manage '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('create '.$module,(array) $permissions))
                                                                        @if($key = array_search('create '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                                        @if($key = array_search('edit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('show '.$module,(array) $permissions))
                                                                        @if($key = array_search('show '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                    @if(in_array('send '.$module,(array) $permissions))
                                                                        @if($key = array_search('send '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income '.$module,(array) $permissions))
                                                                        @if($key = array_search('income '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                                        @if($key = array_search('tax '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                                        @if($key = array_search('bill '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="table-responsive m-t-15">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>Module Permission</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Delete</th>
                                    <th class="text-center">Import</th>
                                    <th class="text-center">Export</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Employee</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Holidays</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Leaves</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Events</td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <input checked="" type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit User Modal -->

 <!-- Delete User Modal -->
 <div class="modal custom-modal fade" id="delete_role" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Role</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form action="" id="role-delete-form" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete User Modal -->
