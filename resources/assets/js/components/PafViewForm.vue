<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <small class="lh-1">PAF request of all employees</small>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Request ID</small></th>
                            <th><small>Employee Name</small></th>
                            <th><small>Contract Change</small></th>
                            <th><small>Paf requested by</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(paf, index) in paf_info">
                            <td><small>{{paf.rq_id}}</small></td>
                            <td><small>{{paf.name}}</small></td>
                            <td><small>{{paf.change_contract}}</small></td>
                            <td><small>{{paf.request_by}}</small></td>
                            <td><small>{{paf.sub_status}}</small></td>
                            <td><h6><button class="btn btn-sm btn-link" @click="getContract(index)">View</button></h6></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
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

                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-empinfo" role="tabpanel" aria-labelledby="nav-empinfo-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name"><small class="text-primary">Name of Employee:</small></label>
                                                <small v-text="form.emp_name"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="raj_id"><small class="text-primary">Employee ID:</small></label>
                                                <small v-text="form.comp_id"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="employment_status"><small class="text-primary">Employment Status:</small></label>
                                                <small v-text="form.change_contract"></small>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Date Effective"><small class="text-primary">Proposed Date Effective:</small></label>
                                                <small v-text="form.proposed_effective_date"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col" v-if="form.con_start">
                                            <div class="form-group">
                                                <label for="employment_status"><small class="text-primary">Contract Start:</small></label>
                                                <small v-text="form.con_start"></small>
                                            </div>
                                        </div>

                                        <div class="col" v-if="form.con_end">
                                            <div class="form-group">
                                                <label for="Date Effective"><small class="text-primary">Contract End:</small></label>
                                                <small v-text="form.con_end"></small>
                                            </div>
                                        </div>

                                        <div class="col" v-if="form.res_date">
                                            <div class="form-group">
                                                <label for="Date Effective"><small class="text-primary">Resignation Date:</small></label>
                                                <small v-text="form.res_date"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Date Effective"><small class="text-primary">Remarks:</small></label>
                                                <small v-text="form.remarks"></small>
                                            </div>
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
                                                <small v-text="getPaf.current_job_description"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.job_description"></small>
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
                                                <small v-text="getPaf.current_department"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.department"></small>
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
                                                <small v-text="getPaf.current_team"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.team"></small>
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
                                                <small v-text="getPaf.current_reporting_to"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.reporting_to"></small>
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
                                                <small v-text="getPaf.current_project"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.project"></small>
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
                                                <small v-text="getPaf.current_company"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.company"></small>
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
                                                <small v-text="getPaf.current_schedule_type"></small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small v-text="getPaf.schedule_type"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-primary">close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    import Datepicker from 'vue2-datepicker';
    
    export default {
        props: ['employees', 'list', 'cchange', 'substatus'],

        components: {'date-picker': Datepicker},

        data: function () {
            return {
                csrf: '',
                showa: '',
                isError: false,

                paf_info: [],
                getPaf: '',

                error_msg: [],

                form: new Form({
                    index: '',
                    emp_id: '',
                    paf_id: '',
                    emp_name: '',
                    change_contract: '',
                    status: '',
                    comp_id: '',
                    remarks: '',
                    con_start: '',
                    con_end: '',
                    res_date: '',
                })
            }
        },

        created: function () {
            this.list.map((lis) => {
                this.employees.map((emp) => {
                    if(lis.employee_company_id == emp.id){
                        this.paf_info.push({ 
                            rq_id: lis.rq_id,
                            paf_id: lis.id,
                            company_id: emp.company_id,
                            name: emp.last_name +', '+ emp.first_name +' '+ emp.middle_name,
                            request_by: lis.requested_by_company_id,
                            change_contract: lis.master_key_employment_status,
                            sub_status: lis.master_id_sub_request_status,
                            show: lis.comfirmation_flag,
                            remarks: lis.remarks,
                            date_effective: this.dateformat(lis.date_effective),
                            contract_start: this.dateformat(lis.contract_start),
                            contract_end: this.dateformat(lis.contract_end),
                            resigned_date: this.dateformat(lis.resigned_date),
                        });
                    }
                });
            });

            for(let x = 0; x < this.paf_info.length; x++){   
                this.cchange.map((ccc) => {
                    if(this.paf_info[x].change_contract == ccc.key){
                        this.paf_info[x].change_contract = ccc.change_type;
                    }
                });
                this.substatus.map((sss) => {
                    if(this.paf_info[x].sub_status == sss.id){
                        this.paf_info[x].sub_status = sss.sub_request_status;
                    }
                });
                this.employees.map((eee) => {
                    if(this.paf_info[x].request_by == eee.id){
                        this.paf_info[x].request_by = eee.last_name +', '+ eee.first_name +' '+ eee.middle_name;
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

        methods: {
            dateformat(d){
                if(d){
                    return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
                }else{
                    return null;
                }
            },

            getContract(index){
                this.form.emp_id = this.paf_info[index].basic_id;
                this.form.paf_id = this.paf_info[index].paf_id;
                this.reqContract(this.form.paf_id);
                this.form.emp_name = this.paf_info[index].name;
                this.form.change_contract = this.paf_info[index].change_contract;
                this.form.proposed_effective_date = this.paf_info[index].date_effective;
                this.form.comp_id = this.paf_info[index].company_id;
                this.form.con_start = this.paf_info[index].contract_start;
                this.form.con_end = this.paf_info[index].contract_end;
                this.form.res_date = this.paf_info[index].resigned_date;
                this.form.remarks = this.paf_info[index].remarks;
                this.form.index = index;
                this.showa = this.paf_info[index].show == '0' ? true : false;

                $("#Modal").modal('show');

            },

            reqContract(id){
                axios.get('/paf/my_request/list/show/'+id)
                    .then(response => {
                        this.getPaf = response.data.data;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
        }
    }
</script>
