<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Official Business requests</h5>

                        </div>
                        <div class="peer">
                            <h6><a href="" data-toggle="modal" data-target="#Modal">File an OB</a></h6>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Date requested</small></th>
                            <th><small>Leave start</small></th>
                            <th><small>Leave end</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(lf, index) in LF">
                            <td>{{lf.date_requested}}</td>
                            <td>{{lf.leave_start}}</td>
                            <td>{{lf.leave_end}}</td>
                            <td>{{lf.status}}</td>
                            <td><button :data-date="lf.date_requested" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal info -->
            <div class="modal fade " id="Info" tabindex="-1" role="dialog" aria-labelledby="Info" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="OB">Requested Leave form( {{imodal.status}} )</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Date requested</small>
                                    <p>{{imodal.date_requested}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Leave start</small>
                                    <p>{{imodal.leave_start}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Leave end</small>
                                    <p>{{imodal.leave_end}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Location</small>
                                    <p>{{imodal.i_location}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Reason</small>
                                    <p>{{imodal.i_reason}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Time in at office?</small>
                                    <p v-if="imodal.i_office_in === '0'">No</p>
                                    <p v-else>Yes</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Time Out at office?</small>
                                    <p v-if="imodal.i_office_out === '0'">No</p>
                                    <p v-else>Yes</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Supervisor remarks</small>
                                    <p>{{imodal.i_remarks}}</p>
                                </div>
                            </div>
                        </div>
                        <div v-if="imodal.i_status != 'For authorization'" class="modal-footer">
                            <button v-if="imodal.i_confirmed == '0'" type="submit" @click="updateData(imodal.i_id)" data-dismiss="modal" class="btn btn-primary">I accept</button>
                            <button v-else data-dismiss="modal" class="btn btn-primary">close</button>
                        </div>
                        <div v-else class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-primary">close</button>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Modal -->
        <form action="/forms/ob/store" METHOD="POST" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="OB">Request OB</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="leave_type"><small class="text-primary">Leave Type</small></label>
                                        <select v-model="form.leave_type" @change="disDate" id="Leave Type" class="custom-select">
                                            <option :value="''" selected hidden>--Select--</option>
                                            <option v-for="(lt, index) in leave" :value="lt.key" >{{ lt.type }}</option>
                                        </select>
                                        <br>
                                        <small class="text-danger" v-text="error_msg.e_type"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="reason"><small class="text-primary">Reason</small></label>
                                        <input type="text" class="form-control" v-model="form.reason" title="Reason" placeholder="Reason">
                                        <small class="text-danger" v-text="error_msg.e_reason"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Work Hours per Day"><small class="text-primary">Work hours per day</small></label>
                                        <input type="number" class="form-control" v-model="form.whd" title="Working hours" placeholder="Working hours" step="any" @keyup="compute" @keydown="compute">
                                        <small class="text-danger" v-text="error_msg.e_whd"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Rest days per week"><small class="text-primary">Rest days per week</small></label>
                                        <input type="text" class="form-control" v-mask="'#'" v-model="form.rdw" title="Rest day" @keyup="selectShift" @keydown="selectShift" @keydown.delete="form.total_days = ''" placeholder="Rest days">
                                        <small class="text-danger" v-text="error_msg.e_rdw"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="SIL"><small class="text-primary">Use SIL points</small></label>
                                        <input type="number" class="form-control" :disabled="!form.whd" @keyup="compute" @keydown="compute"  v-model="form.sil" title="SIL pts" placeholder="SIL pts">
                                        <small class="text-danger" v-text="error_msg.e_sil"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="day"><small class="text-primary">Current SIL pts: </small></label>
                                        <small v-text="csil"></small>
                                        <br>
                                        <label for="night"><small class="text-primary">Available SIL pts left: </small></label>
                                        <small v-text="lsil"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Leave Start"><small class="text-primary">Leave Start</small></label>
                                        <br>
                                        <date-picker 
                                            v-model="form.leave_start" 
                                            lang="en" type="date" 
                                            date-format="MMMM Do, YYYY" 
                                            format="MMMM Do, YYYY" 
                                            placeholder="Date"
                                            confirm
                                            :not-before="disstart"
                                            :editable="false"
                                            :clearable="false"
                                            @confirm="format_start">
                                        </date-picker>
                                        <br>
                                        <small class="text-danger" v-text="error_msg.e_leave_start"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Leave End"><small class="text-primary">Leave End</small></label>
                                        <br>
                                        <date-picker 
                                            v-model="form.leave_end" 
                                            lang="en" type="date" 
                                            date-format="MMMM Do, YYYY" 
                                            format="MMMM Do, YYYY" 
                                            placeholder="Date"
                                            confirm
                                            :not-before="disend"
                                            :editable="false"
                                            :clearable="false"
                                            @confirm="format_end">
                                        </date-picker>
                                        <br>
                                        <small class="text-danger" v-text="error_msg.e_leave_end"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <span v-show="form.leave_start && form.leave_end">
                                            <small class="text-primary">Shift starts at: </small>
                                            <input type="radio" id="day" value="day" v-model="form.shift" @change="selectShift">
                                            <label for="day"><small class="text-primary"> Day</small></label>
                                            <input type="radio" id="night" value="night" v-model="form.shift" @change="selectShift">
                                            <label for="night"><small class="text-primary"> Night</small></label>
                                        </span>
                                        <br>
                                        <label for="SIL"><small class="text-primary">Total days of absense: </small></label>
                                        <small v-show="form.shift" v-text="form.total_days"></small>
                                        <br>
                                        <small class="text-danger" v-text="error_msg.e_total_days"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Request Form</button>
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
        props: ['list', 'leave', 'sil', 'emp'],

        components: {'date-picker': Datepicker},

        data: function () {
            return {
                csrf: '',
                ct: 1,
                csil: '',
                lsil: '',

                disstart: moment().subtract(3, 'days'), 
                disend: moment().subtract(3, 'days'), 

                errors: [],
                error_msg: {
                    e_type: '',
                    e_leave_start: '',
                    e_leave_end: '',
                    e_reason: '',
                    e_whd: '',
                    e_rdw: '',
                    e_total_days: '',
                    e_sil: '',
                    e_shift: '',
                },

                LF: [],
                LFB: [],
                DTB: '',

                time_in: [],
                time_out: [],

                imodal: {
                },

                form: new Form({
                    leave_type: '',
                    leave_start: '',
                    leave_end: '',
                    reason: '',
                    whd: '',
                    rdw: '',
                    sil: '',
                    total_days: '',
                    shift: '',
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.LF.push({
                    id: lis.id,
                    type: lis.leave_type,
                    validator: lis.validated_by,
                    authorizer: lis.approved_by,
                    reason: lis.reason,
                    leave_start: lis.date_start,
                    leave_end: lis.date_end,
                    total_leaves: lis.total_leaves,
                    status: lis.status,
                    date_requested: lis.created_at,
                });
                this.LFB.push({
                    id: lis.id,
                    type: lis.leave_type,
                    validator: lis.validated_by,
                    authorizer: lis.approved_by,
                    reason: lis.reason,
                    leave_start: lis.date_start,
                    leave_end: lis.date_end,
                    total_leaves: lis.total_leaves,
                    status: lis.status,
                    date_requested: lis.created_at,
                });
            });

            this.sil.map((s) => {
                if(this.emp == s.emp_id){
                    this.csil = this.convert(parseFloat(s.add) + parseFloat(s.man));
                    this.lsil = this.csil;
                }   
            });
        },

        mounted: function () {
            this.DTB = $('#empSched-list').DataTable({
                iDisplayLength: 4,
                aLengthMenu: [],
            });
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            this.requestInfo();
        },

        methods: {
            convert(c){
                if(c){
                    var quo = c/8;
                    return Number(quo).toFixed(1);
                }else{
                    return 0;
                }
            },

            compute(){
                this.lsil = this.convert(parseFloat(this.csil * 8) - parseFloat(this.form.sil * this.form.whd));
            },

            requestInfo(){
                var arr = this.OBB;
                $('#empSched-list tbody').on('click', 'button', function(e){
                    var target = e.target;
                    for(let x = 0; x < arr.length; x++){
                        if(arr[x].date === $(target).data('date')){
                            this.imodal = {
                                i_id: arr[x].id,
                                i_date: moment($(target).data('date'), 'YYYY-MM-DD').format('MMMM Do, YYYY'),
                                i_time_in: arr[x].time_in,
                                i_time_out: arr[x].time_out,
                                i_location: arr[x].location,
                                i_reason: arr[x].reason,
                                i_office_in: arr[x].o_in,
                                i_office_out: arr[x].o_out,
                                i_status: arr[x].status,
                                i_remarks: arr[x].remarks,
                                i_confirmed: arr[x].confirmed,
                            };
                        }
                    }
                }.bind(this));
            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            datediff(){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            format_start(d){
                this.disend = this.form.leave_start;
                if(this.form.leave_start >= this.form.leave_end){
                    this.form.leave_end = '';
                }
                this.selectShift();
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            format_end(d){
                this.selectShift();
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            selectShift(){
                if(this.form.shift == 'day'){
                    this.form.total_days = (moment(this.form.leave_end).diff(moment(this.form.leave_start), 'days')) + 1;
                }else{
                    this.form.total_days = (moment(this.form.leave_end).diff(moment(this.form.leave_start), 'days'));
                }
                if(this.form.total_days >= 7){
                    var a =  Math.floor(this.form.total_days/7);
                    this.form.total_days = ((this.form.total_days) - (a*this.form.rdw));
                }
            },

            disDate(){
                this.form.leave_start = '';
                this.form.leave_end = '';
                if(this.form.leave_type == 'mla' || this.form.leave_type == 'mlb' || this.form.leave_type == 'blb' || this.form.leave_type == 'vla'){
                    this.disstart = moment().add(2, 'weeks');
                }else{
                    this.disstart = moment().subtract(3, 'days');
                }
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_type = ''; 
                this.error_msg.e_leave_start = '';
                this.error_msg.e_leave_end = '';
                this.error_msg.e_reason = '';
                this.error_msg.e_whd = '';
                this.error_msg.e_rdw = '';
                this.error_msg.e_total_days = '';
                this.error_msg.e_sil = '';
                this.error_msg.e_shift = '';

                if(!this.form.leave_type){
                    this.errors.push('0');
                    this.error_msg.e_type = 'You must select a type of leave.';
                }
                if(!this.form.leave_start){
                    this.errors.push('0');
                    this.error_msg.e_leave_start ='Pick a date.';
                }
                if(!this.form.leave_end){
                    this.errors.push('0');
                    this.error_msg.e_leave_end ='Pick a date.';
                }
                if(!this.form.reason){
                    this.errors.push('0');
                    this.error_msg.e_reason = 'Reason is required.';
                }   
                if(!this.form.whd){
                    this.errors.push('0');
                    this.error_msg.e_whd = 'Work hours is required.';
                }else if(this.form.whd >= 13 || this.form.whd <= 7){
                    this.errors.push('0');
                    this.error_msg.e_whd = 'Work hours must be only between 8-12 hours.';
                }else if((Number(this.form.whd).toFixed(1) % 0.5) != 0){
                    this.errors.push('0');
                    this.error_msg.e_whd = 'Must have an intervals of 0.5.';
                }
                if(!this.form.rdw){
                    this.errors.push('0');
                    this.error_msg.e_rdw = 'Rest days is required.';
                }else if(this.form.rdw >= 4 || this.form.rdw <= 0){
                    this.errors.push('0');
                    this.error_msg.e_rdw = 'Rest days must be only between 1-3 days.';
                }
                if(this.lsil < 0){
                    this.errors.push('0');
                    this.error_msg.e_sil = 'Your sil left must be atleast 0 or more.';
                }
                if(this.form.total_days <= 0){
                    this.errors.push('0');
                    this.error_msg.e_total_days = 'Total days must not be 0 or below.';
                }
                if(!this.form.shift){
                    this.errors.push('0');
                    this.error_msg.e_shift = 'Select shift.';
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/leave/store');
                    //this.pushLeave();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested OB form.").goAway(5000);
                }
            },

            pushLeave(){
                for(var x = 0; x < this.form.ob_id.length; x++){
                    this.OBB.push({
                        date: this.form.ob_date[x],
                        location: this.form.ob_location[x],
                        time_in: this.timeformat(this.form.ob_time_in[x]),
                        time_out: this.timeformat(this.form.ob_time_out[x]),
                        reason: this.form.ob_reason[x],
                        status: "For authorization",
                        o_in: this.form.ti_checked[x],
                        o_out: this.form.to_checked[x],
                    });
                    this.DTB.row.add([
                            this.dateformat(this.form.ob_date[x]),
                            this.timeformat(this.form.ob_time_in[x]),
                            this.timeformat(this.form.ob_time_out[x]),
                            "For authorization", 
                            "<button data-date="+ this.form.ob_date[x] +" class='btn btn-link' data-toggle='modal' data-target='#Info'>more...</button>", 
                        ]).draw(false);
                    this.DisDays.push(this.form.ob_date[x]);
                }
                this.time_in = [];
                this.time_out = [];
                this.form.ob_date = [];
                this.form.ob_location = [];
                this.form.ob_time_in = [];
                this.form.ob_time_out = [];
                this.form.ob_reason = [];
                this.form.ti_checked = [];
                this.form.to_checked = [];
            },

            updateData(index){
                this.form.patch('/forms/ob/update/' + index);
                for(let x = 0; x < this.OBB.length; x++){
                    if(this.OBB[x].id == index){
                        this.OBB[x].confirmed = 1;
                        this.imodal.i_confirmed = 1;
                        break;
                    }
                }
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });
                toast.text("Form confirmed.").goAway(5000);
            },
        }
    }
</script>
