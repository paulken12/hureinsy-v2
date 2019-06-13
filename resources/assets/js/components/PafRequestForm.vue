<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <small class="lh-1">Search employee for PAF</small>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Company ID</small></th>
                            <th><small>Employee name</small></th>
                            <th><small>Employment Status</small></th>
                            <th><small>Date Joined</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(emp, index) in emp_info">
                            <td><small>{{emp_info[index].company_id}}</small></td>
                            <td><small>{{emp_info[index].name}}</small></td>
                            <td><small>{{emp_info[index].status}}</small></td>
                            <td><small>{{emp_info[index].join_date}}</small></td>
                            <td><h6><button class="btn btn-sm btn-link" @click="getContract(index)">Request PAF</button></h6></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <form METHOD="POST" @submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="OB">Request PAF</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                <a class="nav-item nav-link active" id="nav-empinfo-tab" data-toggle="tab" href="#nav-empinfo" role="tab" aria-controls="nav-empinfo" aria-selected="true">Nature of Action</a>

                                <a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job" aria-selected="false">Annex A</a>

                                <a class="nav-item nav-link" id="nav-sched-tab" data-toggle="tab" href="#nav-sched" role="tab" aria-controls="nav-sched" aria-selected="false">Annex B</a>

                                <a class="nav-item nav-link" id="nav-compe-tab" data-toggle="tab" href="#nav-compe" role="tab" aria-controls="nav-compe" aria-selected="false">Annex C</a>

                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-empinfo" role="tabpanel" aria-labelledby="nav-empinfo-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name"><small class="text-primary">Name of Employee:</small></label>
                                                    <small>{{form.emp_name}}</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="raj_id"><small class="text-primary">Employee ID:</small></label>
                                                    <small>{{form.comp_id}}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="employment_status"><small class="text-primary">Employment Status</small></label>
                                                    <select v-model="form.employment_status" @change="esReset" id="Employment Status" class="custom-select">
                                                        <option value="" selected hidden>--Select--</option>
                                                        <option v-for="(cc, index) in cchange" :value="cchange[index].key" >{{ cchange[index].change_type }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="Date Effective"><small class="text-primary">Proposed Date Effective</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.proposed_effective_date" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="edformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-if="form.employment_status == 'reh' || form.employment_status == 'sfr' || form.employment_status == 'ren' ">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_change"><small class="text-primary">Change Contract Status</small></label>
                                                    <select v-model="form.cont_change" id="Contract" class="custom-select">
                                                        <option value="" selected hidden>--Select--</option>
                                                        <option v-for="(con, index) in msta" v-if="msta[index].key != 'separated'" :value="msta[index].key" >{{ msta[index].employee_status }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_start"><small class="text-primary">Contract Start</small>
                                                    </label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_start" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                            <div class="col" v-if="form.cont_change != 'regular'">
                                                <div class="form-group">
                                                    <label for="cont_end"><small class="text-primary">Contract End</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_end" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="ceformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-else-if="form.employment_status == 'eop'">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_change"><small class="text-primary">Change Contract Status</small></label>
                                                    <select v-model="form.cont_change" name="cont_change" id="Contract" class="custom-select">
                                                        <option value="" selected hidden>--Select--</option>
                                                        <option v-for="(con, index) in msta" :value="msta[index].key" >{{ msta[index].employee_status }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div v-if="form.cont_change != 'separated'" class="col">
                                                <div class="form-group">
                                                    <label for="cont_start"><small class="text-primary">Contract Start</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_start" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>

                                            <div v-if="form.cont_change == 'probationary' || form.cont_change == 'project-based'" class="col">
                                                <div class="form-group">
                                                    <label for="cont_end"><small class="text-primary">Contract End</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_start" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                            <div v-if="form.cont_change == 'separated'" class="col">
                                                <div class="form-group">
                                                    <label for="res_date"><small class="text-primary">Resignation Date</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.resignation_date" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="reformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row" v-else-if="form.employment_status == 'eoc' || form.employment_status == 'snr'">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="res_date"><small class="text-primary">Resignation Date</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.resignation_date" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="reformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-else-if="form.employment_status == 'reg' || form.employment_status == 'ptr'">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_start"><small class="text-primary">Start date</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_start" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-else-if="form.employment_status == 'ttp'">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_start"><small class="text-primary">Contract start</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_start" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_start"><small class="text-primary">Contract end</small></label>
                                                    <br>
                                                    <date-picker 
                                                        v-model="form.contract_end" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do, YYYY" 
                                                        format="MMMM Do, YYYY" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="csformat">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input v-model="form.remarks" class="form-control" type="text" placeholder="Remarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="current"><small class="text-primary">Current</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="proposed"><small class="text-primary">Proposed</small></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Job Title</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_job_description"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.job_description" id="Job" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(jd, index) in mjob" :value="mjob[index].id">{{mjob[index].job_title}} - {{mjob[index].job_description}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Department</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_department"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.department" id="Department" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(dp, index) in mdept" :value="mdept[index].key">{{mdept[index].department}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Team</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_team"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.team" id="Team" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(tm, index) in mtea" :value="mtea[index].id">{{mtea[index].display_name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Reporting To</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_reporting_to"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.reporting_to" id="Report to" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(rt, index) in memp" :value="memp[index].id">{{memp[index].last_name}}, {{memp[index].first_name}} {{memp[index].middle_name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Project</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_project"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.project" id="Project" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(pj, index) in mpro" :value="mpro[index].id">{{mpro[index].project_title}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="nav-sched" role="tabpanel" aria-labelledby="nav-sched-tab">
                                    <div class="card-body">
                                         <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="current"><small class="text-primary">Current</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="proposed"><small class="text-primary">Proposed</small></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Work Location</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.nk_current_company"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select v-model="form.company" id="Company" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(cm, index) in mcomp" :value="mcomp[index].key">{{mcomp[index].name}}, {{mcomp[index].address}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Schedule</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_schedule_type"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.schedule_type" class="form-control" type="text" placeholder="Schedule">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="nav-compe" role="tabpanel" aria-labelledby="nav-compe-tab">
                                    <div class="card-body">
                                         <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="current"><small class="text-primary">Current</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="proposed"><small class="text-primary">Proposed</small></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Job Grade</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_job_grade"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.job_grade" class="form-control" type="text" placeholder="Job Grade">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Probationary Rate</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_probationary_rate"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.probationary_rate" class="form-control" type="text" placeholder="0.00 php">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Gross Salary</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_gross_salary"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.gross_salary" class="form-control" type="text" placeholder="0.00 php">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Basic Salary</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_basic_salary"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.basic_salary" class="form-control" type="text" placeholder="0.00 php">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Bonus/Allowance</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_other_bonus_allowance"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.other_bonus_allowance" class="form-control" type="text" placeholder="Bonus/Allowance">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Benefits</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_other_benefits"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input v-model="form.other_benefits" class="form-control" type="text" placeholder="Benefits">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" v-show="isError">
                                <ul style="list-style: none;">
                                    <li v-for="(err, index) in error_msg"><small v-text="err"></small></li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Request Paf</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    import moment from 'moment';
    import Datepicker from 'vue2-datepicker';
    
    export default {
        props: ['employee', 'annex_a', 'annex_b', 'annex_c', 'mjob', 'mdept', 'mpro', 'memp', 'mtea', 'mcomp', 'msta', 'cchange'],

        components: {'date-picker': Datepicker},

        data: function () {
            return {
                csrf: '',
                isError: false,

                getCon: {},

                emp_info: [],

                error_msg: [],

                form: new Form({
                    emp_id: '',
                    proposed_effective_date: '',
                    employment_status: '',
                    cont_change: '',
                    contract_start: '',
                    contract_end: '',
                    resignation_date: '',
                    remarks: '',

                    job_description: '',
                    department: '',
                    team: '',
                    reporting_to: '',
                    project: '',

                    company: '',
                    schedule_type: '',

                    job_grade: '',
                    probationary_rate: '',
                    gross_salary: '',
                    basic_salary: '',
                    other_bonus_allowance: '',
                    other_benefits: '',

                    nk_current_job_description: '',
                    nk_current_department: '',
                    nk_current_team: '',
                    nk_current_reporting_to: '',
                    nk_current_project: '',

                    current_job_description: '',
                    current_department: '',
                    current_team: '',
                    current_reporting_to: '',
                    current_project: '',

                    nk_current_company: '',

                    current_company: '',
                    current_schedule_type: '',

                    current_job_grade: '',
                    current_probationary_rate: '',
                    current_gross_salary: '',
                    current_basic_salary: '',
                    current_other_bonus_allowance: '',
                    current_other_benefits: '',
                })
            }
        },

        created: function () {
            this.memp.map((emp) => {
                this.emp_info.push({ 
                    basic_id: emp.id,
                    company_id: emp.company_id,
                    name: emp.last_name +', '+ emp.first_name +' '+ emp.middle_name,
                });
            });

            for(let x = 0; x < this.emp_info.length; x++){   
                this.msta.map((sta) => {
                    if(this.employee[x].employment_status == sta.key){
                        this.emp_info[x].status = sta.employee_status;
                    }
                });
                this.employee.map((ctr) => {
                    if(this.emp_info[x].basic_id == ctr.emp_basic_id){
                        this.emp_info[x].contract_start = ctr.contract_start == "0000-00-00" ? "No Contract Start" : this.dateformat(ctr.contract_start);
                        this.emp_info[x].contract_end = ctr.contract_end == "0000-00-00" ? "No Contract End" : this.dateformat(ctr.contract_end);
                        this.emp_info[x].join_date = ctr.join_date == "0000-00-00" ? "No Joined date" : this.dateformat(ctr.join_date);
                    }
                });
            }
        },

        mounted: function () {
            this.DTB = $('#empSched-list').DataTable({
                iDisplayLength: 4,
                bLengthChange: false,
            });
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');           
        },

        computed: {
            checkErr(){
                if(this.error_msg.length){
                    return true;
                }else{
                    return false;
                }
            }
        },

        methods: {
            timeformat(t){
                return moment(t, 'HH:mm:ss').format('hh:mma');
            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            edformat(){
                this.form.proposed_effective_date = moment(this.form.proposed_effective_date, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            csformat(){
                this.form.contract_start = moment(this.form.contract_start, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            ceformat(){
                this.form.contract_end = moment(this.form.contract_end, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            reformat(){
                this.form.resignation_date = moment(this.form.resignation_date, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            getContract(index){
                $("#Modal").modal('show');
                this.resetForm();
                this.form.emp_id = this.emp_info[index].basic_id;
                this.form.emp_name = this.emp_info[index].name;
                this.form.comp_id = this.emp_info[index].company_id;

                this.mjob.map((job) => {
                    if(!this.annex_a[index].job_description_id || this.annex_a[index].job_description_id == "0"){
                        this.form.current_job_description = "";
                        this.form.nk_current_job_description = "No Job Description";
                    }else{                        
                        if(this.annex_a[index].job_description_id == job.id){
                            this.form.current_job_description = job.id;  
                            this.form.nk_current_job_description = job.job_title +' - '+ job.job_description;  
                        }
                    }
                });

                this.mdept.map((dep) => {
                    if(!this.annex_a[index].department_key){
                        this.form.current_department = "";
                        this.form.nk_current_department = "No Department";
                    }else{                        
                        if(this.annex_a[index].department_key == dep.key){
                            this.form.current_department = dep.key;   
                            this.form.nk_current_department = dep.department;   
                        }
                    }
                });

                this.mpro.map((pro) => {
                    if(!this.annex_a[index].project_id || this.annex_a[index].project_id == "0"){
                        this.form.current_project = "";
                        this.form.nk_current_project = "No Project";
                    }else{
                        if(this.annex_a[index].project_id == pro.id){
                            this.form.current_project = pro.id;   
                            this.form.nk_current_project = pro.project_title;   
                        }
                    }
                });

                this.memp.map((rep) => {
                    if(!this.annex_a[index].reporting_to || this.annex_a[index].reporting_to == "0"){
                        this.form.current_reporting_to = '';
                        this.form.nk_current_reporting_to = 'No Reporting To';
                    }else{
                        if(this.annex_a[index].reporting_to == rep.id){
                            this.form.current_reporting_to = rep.id;   
                            this.form.nk_current_reporting_to = rep.last_name +', '+ rep.first_name +' '+ rep.middle_name;   
                        }
                    }
                });

                this.mtea.map((tea) => {
                    if(!this.annex_a[index].reporting_to || this.annex_a[index].reporting_to == "0"){
                        this.form.current_team = '';
                        this.form.nk_current_team = 'No Team';
                    }
                    else{
                        if(this.annex_a[index].team_id == tea.id){
                            this.form.current_team = tea.id;   
                            this.form.nk_current_team = tea.display_name;   
                        }
                    }
                });

                this.mcomp.map((comp) => {
                    if(!this.annex_b[index].work_location_key || this.annex_b[index].work_location_key == "0"){
                        this.form.current_company = '';
                        this.form.nk_current_company = 'No Work Location';
                    }
                    else{
                        if(this.annex_b[index].work_location_key == comp.key){
                            this.form.current_company = comp.key;   
                            this.form.nk_current_company = comp.name;   
                        }
                    }
                });

                this.annex_b.map((sch) => {
                    if(sch.id == this.employee[index].schedule_id){
                        this.form.current_schedule_type = sch.schedule_type ? sch.schedule_type : "No Schedule Type";
                    }
                });

                this.annex_c.map((com) => {
                    if(com.id == this.employee[index].compensation_id){
                        this.form.current_job_grade = com.job_grade ? com.job_grade : "No Job Grade";
                        this.form.current_probationary_rate = com.probationary_rate ? com.probationary_rate : "No Probationary Rate";
                        this.form.current_gross_salary = com.gross_salary ? com.gross_salary : "No Gross Salary";
                        this.form.current_basic_salary = com.basic_salary ? com.basic_salary : "No Basic Salary";
                        this.form.current_other_bonus_allowance = com.other_bonus_allowance ? com.other_bonus_allowance : "No Other Bonus Allowance";
                        this.form.current_other_benefits = com.other_benefits ? com.other_benefits : "No Other Benefits";
                    }
                });
            },

            validate(){
                this.error_msg = [];
                if(!this.form.proposed_effective_date){
                    this.error_msg.push('Date effective is required.');
                }
                if(!this.form.employment_status){
                    this.error_msg.push('Employment status is required.');
                }
                if(!this.form.remarks){
                    this.error_msg.push('Remarks is required.');
                }
                if(this.form.employment_status == 'reh' || this.form.employment_status == 'sfr' || this.form.employment_status == 'ren'){
                    if(!this.form.cont_change){
                        this.error_msg.push('Change of Contract is required');
                    }
                    if(!this.form.contract_start){
                        this.error_msg.push('Contract start is required.');
                    }
                    if(!this.form.contract_end && this.form.cont_change != 'regular'){
                        this.error_msg.push('Contract end is required.');
                    }
                }
                if(this.form.employment_status == 'eop'){
                    if(!this.form.cont_change){
                        this.error_msg.push('Change of Contract is required');
                    }   
                    if(!this.form.contract_start && this.form.cont_change != 'separated'){
                        this.error_msg.push('Contract start is required.');
                    }
                    if(!this.form.contract_end && this.form.cont_change != 'regular' && this.form.cont_change != 'separated'){
                        this.error_msg.push('Contract end is required.');
                    }
                    if(!this.form.resignation_date && this.form.cont_change == 'separated'){
                        this.error_msg.push('Resignation date is required.');
                    }
                }
                if(this.form.employment_status == 'eoc' || this.form.employment_status == 'snr'){
                    if(!this.form.resignation_date && this.form.cont_change == 'separated'){
                        this.error_msg.push('Resignation date is required.');
                    }
                }
                if(this.form.employment_status == 'reg' || this.form.employment_status == 'ptr'){
                    if(!this.form.contract_start){
                        this.error_msg.push('Contract start is required.');
                    }
                }
                if(this.form.employment_status == 'ttp'){
                    if(!this.form.contract_start){
                        this.error_msg.push('Contract start is required.');
                    }
                    if(!this.form.contract_end){
                        this.error_msg.push('Contract end is required.');
                    }
                }
                this.isError = this.checkErr;
            },

            submit(){
                this.validate();
                if(!this.isError){
                    $("#Modal").modal('hide');
                    this.form.post('/paf/search/store');
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("PAF has requested to the HR.").goAway(5000);
                    this.resetForm();
                }
            },

            esReset(){
                this.form.cont_change = '';
                this.form.contract_start = '';
                this.form.contract_end = '';
                this.form.resignation_date = '';
            },

            resetForm(){
                this.form.proposed_effective_date = '';
                this.form.employment_status = '';
                this.form.cont_change = '';
                this.form.contract_start = '';
                this.form.contract_end = '';
                this.form.resignation_date = '';
                this.form.remarks = '';

                this.form.job_description = '';
                this.form.department = '';
                this.form.team = '';
                this.form.reporting_to = '';
                this.form.project = '';

                this.form.company = '';
                this.form.schedule_type = '';

                this.form.job_grade = '';
                this.form.probationary_rate = '';
                this.form.gross_salary = '';
                this.form.basic_salary = '';
                this.form.other_bonus_allowance = '';
                this.form.other_benefits = '';

                this.form.current_job_description = '';
                this.form.current_department = '';
                this.form.current_team = '';
                this.form.current_reporting_to = '';
                this.form.current_project = '';

                this.form.current_company = '';
                this.form.current_schedule_type = '';

                this.form.current_job_grade = '';
                this.form.current_probationary_rate = '';
                this.form.current_gross_salary = '';
                this.form.current_basic_salary = '';
                this.form.current_other_bonus_allowance = '';
                this.form.current_other_benefits = '';
            },
        }
    }
</script>
