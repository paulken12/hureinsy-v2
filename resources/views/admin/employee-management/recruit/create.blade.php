@extends('layouts.dashboard')

@section('content')

    {{--<contract-form--}}
    {{--:company_id="{{$company_id}}"--}}
    {{--:roles="{{$roles}}"--}}
    {{--:role_name="{{$users->roles->pluck('name')}}"--}}
    {{--:admins="{{$admins}}"--}}
    {{--:users="{{$users}}"--}}
    {{--:jobs="{{$jobs}}"--}}
    {{--:projects="{{$projects}}"--}}
    {{--></contract-form>--}}
    <div class="bd bgc-white">
        <form method="POST" id="signup-form" class="signup-form" action="{{route('store.recruit')}}">
            {{csrf_field()}}
            <div>
                <h3 title="test"></h3>
                <fieldset>
                    <h4 class="m-0"><i class="ti-info-alt size-ti"></i>&nbsp;&nbsp;Basic Information</h4>
                    <hr>
                    <div class="form-row m-0">
                        <div class="col">
                            <label class="sr-only" for="company_id">Company ID</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                </div>
                                <input type="text" class="form-control" id="company_id"
                                       value="{{$company_id}}" readonly>
                            </div>
                        </div>

                        <div class="col-8">
                            <label class="sr-only" for="report_to">Report to</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Reporting to</small>
                                    </div>
                                </div>
                                <select name="report_to" id="report_to" class="form-control">
                                    @foreach ($emp as $info)
                                        @foreach ($admins as $admin)
                                            @if($info->user->roles->pluck('name')->first() === $admin->name)
                                                <option value="{{$info->user->id}}">{{$info->last_name.' '.$info->first_name ." - ". $admin->display_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row m-0">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="first_name">First name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                       title="First name" required placeholder="First name">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="middle_name">Middle name</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control"
                                       title="Middle name" required placeholder="Middle name">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="last_name">Last name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                       title="Last name" required placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <div class="form-row m-0">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="ti-email"></i></div>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Email" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="sr-only" for="role_key">Role</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="ti-eye"></i></div>
                                    </div>
                                    <select name="role_key" id="role_key" class="form-control">
                                        <option value="employee" readonly="">-Select Role-</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="ben_sss">SSS NO.</label>
                                <input type="text"
                                       id="ben_sss"
                                       name="ben_sss"
                                       class="form-control"
                                       title="SSS NO."
                                       placeholder="SSS NO.">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="ben_pag_ibig">PAGIBIG</label>
                                <input type="text"
                                       id="ben_pag_ibig"
                                       name="ben_pag_ibig"
                                       class="form-control"
                                       title="PAGIBIG"
                                       placeholder="PAGIBIG">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="ben_philhealth">PHILHEALTH</label>
                                <input type="text"
                                       id="ben_philhealth"
                                       name="ben_philhealth"
                                       class="form-control"
                                       title="PHILHEALTH"
                                       placeholder="PHILHEALTH">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label class="sr-only" for="ben_tin">TIN</label>
                                <input type="text"
                                       id="ben_tin"
                                       name="ben_tin"
                                       class="form-control"
                                       title="TIN"
                                       placeholder="TIN">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="sr-only" for="payroll_account">Payroll Account</label>
                                <input type="text"
                                       id="payroll_account"
                                       name="payroll_account"
                                       class="form-control"
                                       title="Payroll Account"
                                       placeholder="Payroll Account">
                            </div>
                        </div>
                    </div>

                    <hr>

                </fieldset>

                <h3></h3>
                <fieldset>
                    <h4 class="m-0"><i class="ti-write size-ti"></i>&nbsp;&nbsp;Job Description
                        <small><strong>| Annex A</strong></small>
                    </h4>
                    <hr>

                    <div class="form-row">
                        <div class="col-sm-12">
                            <label class="sr-only" for="job_description">Job Description</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Job Description</small>
                                    </div>
                                </div>
                                <select name="job_description" id="job_description" class="form-control">
                                    @foreach ($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->job_title ." - ". $job->job_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12">
                            <label class="sr-only" for="project_assignment">Project Assignment</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Project Assignment</small>
                                    </div>
                                </div>
                                <select name="project_assignment" id="project_assignment" class="form-control">
                                    @foreach ($projects as $project)
                                        <option value="{{$project->id}}">{{$project->project_title ." - ". $project->project_desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm">
                            <label class="sr-only" for="department">Department</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Department</small>
                                    </div>
                                </div>
                                <select name="department" id="department" class="form-control">
                                    @foreach ($depts as $dept)
                                        <option value="{{$dept->key}}">{{$dept->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="sr-only" for="team">Team</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Team</small>
                                    </div>
                                </div>
                                <select name="team" id="team" class="form-control">
                                    @foreach ($teams as $team)
                                        <option value="{{$team->key}}">{{$team->sub_con}} - {{$team->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="sr-only" for="job_date_effective">Date Effective</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Date Effective</small>
                                    </div>
                                </div>
                                <input type="text" id="job_date_effective" name="job_date_effective" class="form-control"
                                   title="Date Effective" placeholder="Date Effective" data-provide="datepicker"
                                   value="{{date('Y-m-d')}}"
                                   data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>


                    {{--<div class="assign-container">--}}
                    {{--<div class="assign" id="assign-visitors">--}}
                    {{--<input type="checkbox" id="assign-visitors-indicator"/>--}}
                    {{--<div class="headerss">--}}
                    {{--<label class="indicator" for="assign-visitors-indicator">--}}
                    {{--<svg class="open" width="18" height="27">--}}
                    {{--<line x1="1.5" y1="12" x2="2" y2="25" stroke-linecap="round"--}}
                    {{--style="stroke: #2196f3; stroke-width: 3;"></line>--}}
                    {{--<line x1="9" y1="7" x2="9" y2="25" stroke-linecap="round"--}}
                    {{--style="stroke: #2196f3; stroke-width: 3;"></line>--}}
                    {{--<line x1="16.5" y1="2" x2="16.5" y2="25" stroke-linecap="round"--}}
                    {{--style="stroke: #2196f3; stroke-width: 3;"></line>--}}
                    {{--</svg>--}}
                    {{--<svg class="close" width="15" height="25">--}}
                    {{--<line x1="1.5" y1="13.5" x2="15" y2="0"--}}
                    {{--style="stroke: #2196f3; stroke-width: 3"></line>--}}
                    {{--<line x1="1.5" y1="11.5" x2="15" y2="25"--}}
                    {{--style="stroke: #2196f3; stroke-width: 3"></line>--}}
                    {{--</svg>--}}
                    {{--</label>--}}
                    {{--<div class="content">--}}
                    {{--<div class="data">--}}
                    {{--<div class="top">--}}
                    {{--<p class="title float-left">Project Assignment </p>--}}
                    {{--</div>--}}
                    {{--<div class="graph">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium--}}
                    {{--aperiam culpa debitis deleniti error illo, natus, nisi nobis nostrum--}}
                    {{--odit porro, quas qui quibusdam ratione sequi totam ut vel vitae?--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="container-fluid">--}}
                    {{--<div class="form-group">--}}
                    {{--<label class="sr-only" for="job_title">Job Title</label>--}}
                    {{--<input type="text" id="job_title" name="job_title" class="form-control"--}}
                    {{--title="Job Title"--}}
                    {{--placeholder="Job Title">--}}
                    {{--</div>--}}


                    {{--</div>--}}
                    {{--<div class="float"></div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="date_effective">Date Effective</label>--}}
                    {{--<input type="text" id="date_effective" name="date_effective" class="form-control"--}}
                    {{--title="Date Effective">--}}
                    {{--</div>--}}


                    {{--<div class="form-group">--}}
                    {{--<label for="job_title">Job Title</label>--}}
                    {{--<input type="text" id="job_title" name="job_title" class="form-control" title="Job Title">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="department">Department</label>--}}
                    {{--<input type="text" id="department" name="department" class="form-control"--}}
                    {{--title="Department">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="team">Team</label>--}}
                    {{--<input type="text" id="team" name="team" class="form-control" title="Team">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="project_assign">Project Assignment</label>--}}
                    {{--<input type="text" id="project_assign" name="project_assign" class="form-control"--}}
                    {{--title="Project Assignment">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="job_desc">Job Description</label>--}}
                    {{--<input type="text" id="job_desc" name="job_desc" class="form-control"--}}
                    {{--title="Job Description">--}}
                    {{--</div>--}}


                </fieldset>


                <h3></h3>
                <fieldset>
                <h4 class="m-0"><i class="ti-alarm-clock size-ti"></i>&nbsp;&nbsp;Schedule
                <small><strong>| Annex B</strong></small>
                </h4>
                <hr>
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label class="sr-only" for="schedule_type">Schedule Type</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Schedule Type</small>
                                    </div>
                                </div>
                                <input type="text" id="schedule_type" name="schedule_type" class="form-control"
                                       title="Schedule Type" placeholder="Schedule Type">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm">
                            <label class="sr-only" for="work_location">Work Location</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Work Location</small>
                                    </div>
                                </div>
                                <select name="work_location" id="work_location" class="form-control">
                                    @foreach ($companies as $company)
                                        <option value="{{$company->key}}">{{$company->name}} - {{$company->address}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="sr-only" for="schedule_date_effective">Date Effective</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Date Effective</small>
                                    </div>
                                </div>
                                <input type="text" id="schedule_date_effective" name="schedule_date_effective" class="form-control"
                                   title="Date Effective" placeholder="Date Effective" data-provide="datepicker"
                                   value="{{date('Y-m-d')}}"
                                   data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h3></h3>
                <fieldset>
                <h4 class="m-0"><i class="ti-envelope size-ti"></i>&nbsp;&nbsp;Benefit
                <small><strong>| Annex C</strong></small>
                </h4>
                <hr>
                <p class="desc">Coming soon</p>
                </fieldset>

                <h3></h3>
                <fieldset>
                    <h4 class="m-0"><i class="ti-paper size-ti"></i>&nbsp;&nbsp;Contract
                        <small><strong>| Dates</strong></small>
                    </h4>
                    <hr>

                    <div class="form-row">
                        <div class="col-sm-12">
                            <label class="sr-only" for="employment_status">Employment Status</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <small>Employment Status</small>
                                    </div>
                                </div>
                                <select name="employment_status" id="employment_status" class="form-control">
                                    @foreach ($statuses as $status)
                                        <option value="{{$status->key}}">{{$status->employee_status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="contract_start">Contract Start</label>
                                <input type="text" id="contract_start" name="contract_start" class="form-control"
                                       title="Contract Start" placeholder="Contract Start" data-provide="datepicker"
                                       value="{{date('Y-m-d')}}"
                                       data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="contract_end">Contract End</label>
                                <input type="text" id="contract_end" name="contract_end" class="form-control"
                                       title="Contract End" placeholder="Contract End" data-provide="datepicker"
                                       data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>

                </fieldset>
            </div>
        </form>
    </div>
@endsection
