<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <small class="lh-1">PAF Reuqest</small>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Company ID</small></th>
                            <th><small>Employee name</small></th>
                            <th><small>Contract Change</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(paf, index) in paf_info">
                            <td><small>{{paf.company_id}}</small></td>
                            <td><small>{{paf.name}}</small></td>
                            <td><small>{{paf.nk_employment_status}}</small></td>
                            <td><small>{{paf.sub_status}}</small></td>
                            <td><h6><button class="btn btn-sm btn-link" @click="getContract(index)">View</button></h6></td>
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

                                <a class="nav-item nav-link" id="nav-hr-tab" data-toggle="tab" href="#nav-hr" role="tab" aria-controls="nav-compe" aria-selected="false">HR Evaluation</a>

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
                                                    <select :disabled="!showa" v-model="form.employment_status" @change="esReset" id="Employment Status" class="custom-select">
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
                                                        @confirm="edformat"
                                                        :disabled="!showa">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-if="form.employment_status == 'reh' || form.employment_status == 'sfr' || form.employment_status == 'ren' ">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_change"><small class="text-primary">Change Contract Status</small></label>
                                                    <select :disabled="!showa" v-model="form.cont_change" id="Contract" class="custom-select">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
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
                                                        @confirm="ceformat"
                                                        :disabled="!showa">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-else-if="form.employment_status == 'eop'">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="cont_change"><small class="text-primary">Change Contract Status</small></label>
                                                    <select :disabled="!showa" v-model="form.cont_change" name="cont_change" id="Contract" class="custom-select">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
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
                                                        @confirm="reformat"
                                                        :disabled="!showa">
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
                                                        @confirm="reformat"
                                                        :disabled="!showa">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
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
                                                        @confirm="csformat"
                                                        :disabled="!showa">
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input :disabled="!showa" v-model="form.remarks" class="form-control" type="text" placeholder="Remarks">
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
                                                    <small v-text="form.current_job_description"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.job_description" id="Job" class="custom-select">
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
                                                    <small v-text="form.current_department"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.department" id="Department" class="custom-select">
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
                                                    <small v-text="form.current_team"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.team" id="Team" class="custom-select">
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
                                                    <small v-text="form.current_reporting_to"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.reporting_to" id="Report to" class="custom-select">
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
                                                    <small v-text="form.current_project"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.project" id="Project" class="custom-select">
                                                        <option value="" selected>--Select--</option>
                                                        <option v-for="(pj, index) in mpro" :value="mpro[index].id">{{mpro[index].project_title}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row alert alert-info">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="Annex A"><small class="text-primary">Annex A Remarks</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small class="text-primary">HR remarks:</small>
                                                    <small v-text="form.a"></small>
                                                    <br>
                                                    <small class="text-primary">Executive remarks:</small>
                                                    <small v-text="form.ea"></small>
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
                                                    <small v-text="form.current_company"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select :disabled="!showa" v-model="form.company" id="Company" class="custom-select">
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
                                                    <input :disabled="!showa" v-model="form.schedule_type" class="form-control" type="text" placeholder="Schedule">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row alert alert-info">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="Annex B"><small class="text-primary">Annex B Remarks</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small class="text-primary">HR remarks:</small>
                                                    <small v-text="form.b"></small>
                                                    <br>
                                                    <small class="text-primary">Executive remarks:</small>
                                                    <small v-text="form.eb"></small>
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
                                                    <small  class="text-primary ml-2">Job Grade</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.current_job_grade"></small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input :disabled="!showa" v-model="form.job_grade" class="form-control" type="text" placeholder="Job Grade">
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
                                                    <input :disabled="!showa" v-model="form.probationary_rate" class="form-control" type="text" placeholder="0.00 php">
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
                                                    <input :disabled="!showa" v-model="form.gross_salary" class="form-control" type="text" placeholder="0.00 php">
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
                                                    <input :disabled="!showa" v-model="form.basic_salary" class="form-control" type="text" placeholder="0.00 php">
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
                                                    <input :disabled="!showa" v-model="form.other_bonus_allowance" class="form-control" type="text" placeholder="Bonus/Allowance">
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
                                                    <input :disabled="!showa" v-model="form.other_benefits" class="form-control" type="text" placeholder="Benefits">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row alert alert-info">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="Date Effective"><small class="text-primary">Annex C Remarks</small></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small class="text-primary">HR remarks:</small>
                                                    <small v-text="form.c"></small>
                                                    <br>
                                                    <small class="text-primary">Executive remarks:</small>
                                                    <small v-text="form.ec"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-hr" role="tabpanel" aria-labelledby="nav-hr-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Behavioural Assessment</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.beh"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Proficiency Test</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.pro"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Overall Recommendation</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.ove"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">Performance Evaluation</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.per"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <small class="text-primary ml-2">HR Remarks</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <small v-text="form.rem"></small>
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

                        <div v-if="showa" class="modal-footer">
                                <button type="submit" @click="dec = 1" class="btn btn-primary">Resubmit to HR</button>
                                <button type="submit" @click="dec = 2" class="btn btn-danger">Close/Cancel request</button>
                        </div>
                        <div v-else class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-primary">close</button>
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
        props: ['employees', 'list', 'cchange', 'substatus', 'mjob', 'mdept', 'mpro', 'memp', 'mtea', 'msta', 'mcomp'],

        components: {'date-picker': Datepicker},

        data: function () {
            return {
                csrf: '',
                dec: '',
                showa: '',
                isError: false,

                paf_info: [],

                error_msg: [],



                form: new Form({
                    index: '',
                    emp_id: '',
                    paf_id: '',
                    emp_name: '',
                    employment_status: '',
                    cont_change: '',
                    status: '',
                    comp_id: '',
                    remarks: '',
                    proposed_effective_date: '',
                    contract_start: '',
                    contract_end: '',
                    resignation_date: '',

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

                    current_job_description: '',
                    current_department: '',
                    current_team: '',
                    current_reporting_to: '',
                    current_project: '',

                    current_company: '',
                    current_schedule_type: '', 
                    
                    current_job_grade: '',
                    current_probationary_rate: '',
                    current_gross_salary: '',
                    current_basic_salary: '',
                    current_other_bonus_allowance: '', 
                    current_other_benefits: '',
                    
                    beh: '',
                    pro: '',
                    ove: '',
                    per: '',
                    rem: '',
                    
                    a: '',
                    b: '',
                    c: '',
                    
                    ea: '',
                    eb: '',
                    ec: '',
                    
                    status: '',
                    substatus: '',
                })
            }
        },

        created: function () {
            this.list.map((lis) => {
                this.employees.map((emp) => {
                    if(lis.employee_company_id == emp.id){
                        this.paf_info.push({ 
                            basic_id: emp.id,
                            paf_id: lis.id,
                            company_id: emp.company_id,
                            name: emp.last_name +', '+ emp.first_name +' '+ emp.middle_name,
                            employment_status: lis.master_key_employment_status,
                            cont_change: lis.master_key_change_of_contract,
                            nk_employment_status: lis.master_key_employment_status,
                            sub_status: lis.master_id_sub_request_status,
                            show: lis.master_id_sub_request_status,
                            remarks: lis.remarks,
                            date_effective: lis.date_effective,
                            contract_start: lis.contract_start,
                            contract_end: lis.contract_end,
                            resigned_date: lis.resigned_date,
                        });
                    }
                });
            });

            for(let x = 0; x < this.paf_info.length; x++){   
                this.cchange.map((ccc) => {
                    if(this.paf_info[x].employment_status == ccc.key){
                        this.paf_info[x].nk_employment_status = ccc.change_type;
                    }
                });
                this.substatus.map((sss) => {
                    if(this.paf_info[x].sub_status == sss.id){
                        this.paf_info[x].sub_status = sss.sub_request_status;
                    }
                });
            }
        },

        mounted: function () {
            this.DTB = $('#empSched-list').DataTable({
                iDisplayLength: 4,
                bLengthChange: false,
                order: [ 0, 'desc' ],
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
            dateformat(d){
                if(d){
                    return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
                }else{
                    return null;
                }
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
                this.form.emp_id = this.paf_info[index].basic_id;
                this.form.paf_id = this.paf_info[index].paf_id;
                this.reqContract(this.form.paf_id);
                this.form.emp_name = this.paf_info[index].name;
                this.form.employment_status = this.paf_info[index].employment_status;
                this.form.cont_change = this.paf_info[index].cont_change;
                this.form.comp_id = this.paf_info[index].company_id;
                this.form.proposed_effective_date = this.paf_info[index].date_effective;
                this.form.con_start = this.paf_info[index].contract_start;
                this.form.con_end = this.paf_info[index].contract_end;
                this.form.res_date = this.paf_info[index].resigned_date;
                this.form.remarks = this.paf_info[index].remarks;
                this.form.index = index;
                this.form.contract_start = this.paf_info[index].contract_start; 
                this.form.contract_end = this.paf_info[index].contract_end;
                this.form.resignation_date = this.paf_info[index].resigned_date;
                this.showa = this.paf_info[index].show == '3' ? true : false;

                $("#Modal").modal('show');

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
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    if(this.dec == 1){
                        this.form.status = 1;
                        this.form.substatus = 1; 
                        toast.text("Request successfuly sent to HR.").goAway(5000);
                    }else if(this.dec == 2){
                        this.form.status = 2;
                        this.form.substatus = 7;
                        toast.text("Request successfuly canceled.").goAway(5000);
                    }
                    this.getSubStat(this.form.index);
                    $("#Modal").modal('hide');
                    this.form.patch('/paf/request/list/show/store/'+this.form.paf_id);
                    this.resetForm();
                }
            },

            resetForm(){
                this.form.index = '';
                this.form.emp_id = '';
                this.form.paf_id = '';
                this.form.emp_name = '';
                this.form.employment_status = '';
                this.form.cont_change = '';
                this.form.status = '';
                this.form.comp_id = '';
                this.form.remarks = '';
                this.form.proposed_effective_date = '';
                this.form.contract_start = '';
                this.form.contract_end = '';
                this.form.resignation_date = '';

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
            },

            esReset(){
                this.form.cont_change = '';
                this.form.contract_start = '';
                this.form.contract_end = '';
                this.form.resignation_date = '';
            },

            getSubStat(index){
                this.paf_info[index].show = this.form.substatus;
                this.paf_info[index].sub_status = this.form.substatus;
                this.substatus.map((sss) => {
                    if(this.paf_info[index].sub_status == sss.id){
                        this.paf_info[index].sub_status = sss.sub_request_status;
                    }
                });
            },

            reqContract(id){
                axios.get('/paf/request/list/show/'+id)
                    .then(response => {
                        this.form.job_description = response.data.data.job_description;
                        this.form.department = response.data.data.department;
                        this.form.team = response.data.data.team;
                        this.form.reporting_to = response.data.data.reporting_to;
                        this.form.project = response.data.data.project;
                        
                        this.form.company = response.data.data.company;
                        this.form.schedule_type = response.data.data.schedule_type;
                        
                        this.form.job_grade = response.data.data.job_grade;
                        this.form.probationary_rate = response.data.data.probationary_rate;
                        this.form.gross_salary = response.data.data.gross_salary;
                        this.form.basic_salary = response.data.data.basic_salary;
                        this.form.other_bonus_allowance = response.data.data.other_bonus_allowance;
                        this.form.other_benefits = response.data.data.other_benefits;

                        this.form.current_job_description = response.data.data.current_job_description;
                        this.form.current_department = response.data.data.current_department;
                        this.form.current_team = response.data.data.current_team;
                        this.form.current_reporting_to = response.data.data.current_reporting_to;
                        this.form.current_project = response.data.data.current_project;
                        
                        this.form.current_company = response.data.data.current_company;
                        this.form.current_schedule_type = response.data.data.current_schedule_type; 
                        
                        this.form.current_job_grade = response.data.data.current_job_grade;
                        this.form.current_probationary_rate = response.data.data.current_probationary_rate;
                        this.form.current_gross_salary = response.data.data.current_gross_salary;
                        this.form.current_basic_salary = response.data.data.current_basic_salary;
                        this.form.current_other_bonus_allowance = response.data.data.current_other_bonus_allowance;
                        this.form.current_other_benefits = response.data.data.current_other_benefits;
                        
                        this.form.beh = response.data.data.beh;
                        this.form.pro = response.data.data.pro;
                        this.form.ove = response.data.data.ove;
                        this.form.per = response.data.data.per;
                        this.form.rem = response.data.data.rem;

                        this.form.a = response.data.data.a;
                        this.form.b = response.data.data.b;
                        this.form.c = response.data.data.c;
                        this.form.ea = response.data.data.ea;
                        this.form.eb = response.data.data.eb;
                        this.form.ec = response.data.data.ec;
                        
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },      
        }
    }
</script>
