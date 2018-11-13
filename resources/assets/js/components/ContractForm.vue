<template>
    <div>
        <div class="bd bgc-white">
            <div id="signup-form" class="signup-form" >
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
                                            readonly v-model="company_id">
                                </div>
                            </div>
                            <!--<div class="col-8">-->
                                <!--<label class="sr-only" for="report_to">Report to</label>-->
                                <!--<div class="input-group mb-2">-->
                                    <!--<div class="input-group-prepend">-->
                                        <!--<div class="input-group-text">-->
                                            <!--<small>Reporting to</small>-->
                                        <!--</div>-->
                                    <!--</div>-->

                                    <!--&lt;!&ndash;<select id="report_to"&ndash;&gt;-->
                                            <!--&lt;!&ndash;v-model="form.master_blood_key"&ndash;&gt;-->
                                            <!--&lt;!&ndash;class="form-control">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<option disabled value="">Report to</option>&ndash;&gt;-->
                                        <!--&lt;!&ndash;<option v-for="bloodType in blood" v-bind:value="bloodType.key">&ndash;&gt;-->
                                            <!--&lt;!&ndash;{{bloodType.blood_type}}&ndash;&gt;-->
                                        <!--&lt;!&ndash;</option>&ndash;&gt;-->
                                    <!--&lt;!&ndash;</select>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<select name="report_to" id="report_to" class="form-control">&ndash;&gt;-->
                                        <!--&lt;!&ndash;@foreach ($users as $user)&ndash;&gt;-->
                                        <!--&lt;!&ndash;@foreach ($admins as $admin)&ndash;&gt;-->
                                        <!--&lt;!&ndash;@if($user->roles->pluck('name')->first() === $admin->name)&ndash;&gt;-->
                                        <!--&lt;!&ndash;<option value="{{$user->id}}">{{$user->name ." - ". $admin->display_name}}</option>&ndash;&gt;-->
                                        <!--&lt;!&ndash;@endif&ndash;&gt;-->
                                        <!--&lt;!&ndash;@endforeach&ndash;&gt;-->
                                        <!--&lt;!&ndash;@endforeach&ndash;&gt;-->
                                    <!--&lt;!&ndash;</select>&ndash;&gt;-->
                                <!--</div>-->
                            <!--</div>-->
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
                                    <!--<label class="sr-only" for="role_key">Role</label>-->
                                    <!--<div class="input-group mb-2">-->
                                        <!--<div class="input-group-prepend">-->
                                            <!--<div class="input-group-text"><i class="ti-eye"></i></div>-->
                                        <!--</div>-->
                                        <!--<select name="role_key" id="role_key" class="form-control">-->
                                            <!--<option value="employee" readonly="">-Select Role-</option>-->
                                            <!--@foreach ($roles as $role)-->
                                            <!--<option value="{{$role->name}}">{{$role->display_name}}</option>-->
                                            <!--@endforeach-->
                                        <!--</select>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="sr-only" for="ben_sss">SSS NO.</label>
                                    <input type="text" id="ben_sss" name="ben_sss" class="form-control" title="SSS NO."
                                           placeholder="SSS NO.">
                                </div>


                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="sr-only" for="ben_pag_ibig">PAGIBIG</label>
                                    <input type="text" id="ben_pag_ibig" name="ben_pag_ibig" class="form-control"
                                           title="PAGIBIG"
                                           placeholder="PAGIBIG">
                                </div>


                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="sr-only" for="ben_philhealth">PHILHEALTH</label>
                                    <input type="text" id="ben_philhealth" name="ben_philhealth" class="form-control"
                                           title="PHILHEALTH" placeholder="PHILHEALTH">
                                </div>


                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="sr-only" for="ben_tin">TIN</label>
                                    <input type="text" id="ben_tin" name="ben_tin" class="form-control" title="TIN"
                                           placeholder="TIN">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="payroll_account">Payroll Account</label>
                                    <input type="text" id="payroll_account" name="payroll_account" class="form-control"
                                           title="Payroll Account" placeholder="Payroll Account">
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <!--<h3></h3>-->
                    <!--<fieldset>-->
                        <!--<h4 class="m-0"><i class="ti-write size-ti"></i>&nbsp;&nbsp;Job Description-->
                            <!--<small><strong>| Annex A</strong></small>-->
                        <!--</h4>-->
                        <!--<hr>-->

                        <!--<div class="form-row">-->
                            <!--<div class="col-sm-12">-->
                                <!--<label class="sr-only" for="job_description">Job Description</label>-->
                                <!--<div class="input-group mb-2">-->
                                    <!--<div class="input-group-prepend">-->
                                        <!--<div class="input-group-text">-->
                                            <!--<small>Job Description</small>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<select name="job_description" id="job_description" class="form-control">-->
                                        <!--@foreach ($jobs as $job)-->
                                        <!--<option value="{{$job->id}}">{{$job->job_title ." - ". $job->job_description}}</option>-->
                                        <!--@endforeach-->
                                    <!--</select>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->

                        <!--<div class="form-row">-->
                            <!--<div class="col-sm-12">-->
                                <!--<label class="sr-only" for="project_assignment">Project Assignment</label>-->
                                <!--<div class="input-group mb-2">-->
                                    <!--<div class="input-group-prepend">-->
                                        <!--<div class="input-group-text">-->
                                            <!--<small>Project Assignment</small>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<select name="project_assignment" id="project_assignment" class="form-control">-->
                                        <!--@foreach ($projects as $project)-->
                                        <!--<option value="{{$project->id}}">{{$project->project_title ." - ". $project->project_desc}}</option>-->
                                        <!--@endforeach-->
                                    <!--</select>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->



                    <!--</fieldset>-->

                    <!--<h3></h3>-->
                    <!--<fieldset>-->
                        <!--<h4 class="m-0"><i class="ti-alarm-clock size-ti"></i>&nbsp;&nbsp;Schedule-->
                            <!--<small><strong>| Annex B</strong></small>-->
                        <!--</h4>-->
                        <!--<hr>-->
                        <!--<p class="desc">annex b</p>-->
                    <!--</fieldset>-->

                    <!--<h3></h3>-->
                    <!--<fieldset>-->
                        <!--<h4 class="m-0"><i class="ti-envelope size-ti"></i>&nbsp;&nbsp;Benefit-->
                            <!--<small><strong>| Annex C</strong></small>-->
                        <!--</h4>-->
                        <!--<hr>-->
                        <!--<p class="desc">annex c</p>-->
                    <!--</fieldset>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: [
            'company_id',
            'roles',
            'admins',
            'users',
            'jobs',
            'projects',
        ],

        data: function () {
            return {

                role_name: [],
                form : new Form({

                })
            }
        },

        created: function () {
            this.pass();
        },
        methods: {
            pass(){
                this.users.map((user) => {
                    this.role_name.push(user.roles);
                });
            },

            onChange(){
                return this.$emit('emit-basic',this.$data);
            },

            onSubmit(){
                this.form.post('/store/recruit');
            }

        },

    }
</script>
