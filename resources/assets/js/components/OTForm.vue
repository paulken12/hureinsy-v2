<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Over Time requests</h5>

                        </div>
                        <div class="peer">
                            <h6><a href="" data-toggle="modal" data-target="#Modal">File an Over Time</a></h6>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Date</small></th>
                            <th><small>OT type</small></th>
                            <th><small>Regular shift time</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ot, index) in OT">
                            <td>{{OT[index].date}}</td>
                            <td>{{OT[index].type}}</td>
                            <td>{{OT[index].regular_time}}</td>
                            <td>{{OT[index].status}}</td>
                            <td><button :data-date="OTB[index].date" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
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
                            <h5 class="modal-title" id="OT">Requested Over Time( {{imodal.i_status}} )</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Date</small>
                                    <p>{{imodal.i_date}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">OT type</small>
                                    <p>{{imodal.i_type}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Regular time</small>
                                    <p>{{imodal.i_regular_time}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">OT start</small>
                                    <p>{{imodal.i_ot_start}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">OT end</small>
                                    <p>{{imodal.i_ot_end}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Total hours</small>
                                    <p>{{imodal.i_hours}}</p>
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
        <form action="/forms/ot/store" METHOD="POST" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="OT">Request Over Time</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                             <div v-for="(ot,index) in form.ot_id" class="container-fluid p-0 m-0">
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.ot_date[index]" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do" 
                                                        format="MMMM Do" 
                                                        placeholder="Date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        :disabled-days="DisDays"
                                                        @confirm="dateSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_date[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="time_start[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="OT start"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeInSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_time_start[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="time_end[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="OT end"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeOutSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_time_end[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" id="regularshift" class="form-control"
                                                   v-model="form.ot_regular_time[index]"
                                                   title="Regular Shift" placeholder="Regular Shift">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="text" id="reason" class="form-control"
                                                   v-model="form.ot_reason[index]"
                                                   title="Reason" placeholder="Reason">
                                            <small v-text="error_msg.e_reason[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <select v-model="form.ot_type[index]" class="form-control">
                                                <option disabled value="">Select OT type</option>
                                                <option value="Holiday">Holiday</option>
                                                <option value="Ordinary">Ordinary</option>
                                                <option value="Rest day">Rest day</option>
                                            </select>
                                            <small v-text="error_msg.e_type[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a v-show="form.ot_hidden[index]" class="btn btn-danger btn-sm float-right " @click="removeOT(index, ot)"><i class="ti-eraser" style="color: white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.ot_id.length < 5" class="container-fluid text-center">
                                <a class="btn btn-light " @click="addOT">Add Over Time</a>
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
    //import Datepicker from 'vuejs-datepicker';
    import Timepicker from 'vue2-datepicker';
    
    export default {
        props: ['list'],

        components: {/*'date-picker': Datepicker, */'time-picker': Timepicker},

        data: function () {
            return {
                csrf: '',
                ct: 1,

                DisDays: [], 

                errors: [],
                error_msg: {
                    e_date: [''],
                    e_time_start: [''],
                    e_time_end: [''],
                    e_type: [''],
                    e_regular_time: [''],
                    e_reason: [''],
                },

                OT: [],
                OTB: [],
                DTB: '',

                time_start: [],
                time_end: [],

                imodal: {
                },

                form: new Form({
                    ot_hidden: [false],
                    ot_id: [1],
                    ot_date: [],
                    ot_start: [],
                    ot_end: [],
                    ot_regular_time: [''],
                    ot_type: [''],
                    ot_reason: [''],
                    ot_total: [],
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.OT.push({
                    date: this.dateformat(lis.date),
                    ot_start: this.timeformat(lis.ot_start),
                    ot_end: this.timeformat(lis.ot_end),
                    regular_time: lis.regular_time,
                    type: lis.type,
                    reason: lis.reason,
                    status: lis.status,
                });
                this.OTB.push({
                    id: lis.id,
                    date: lis.date,
                    ot_start: this.timeformat(lis.ot_start),
                    ot_end: this.timeformat(lis.ot_end),
                    regular_time: lis.regular_time,
                    type: lis.type,
                    hours: lis.hours,
                    reason: lis.reason,
                    remarks: lis.remarks,
                    status: lis.status,
                    confirmed: lis.confirmed,
                });
                if(lis.status !== 'Unauthorized'){
                    this.DisDays.push(lis.date);
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
            requestInfo(){
                var arr = this.OTB;
                $('#empSched-list tbody').on('click', 'button', function(e){
                    var target = e.target;
                    for(let x = 0; x < arr.length; x++){
                        if(arr[x].date === $(target).data('date')){
                            this.imodal = {
                                i_id: arr[x].id,
                                i_date: moment($(target).data('date'), 'YYYY-MM-DD').format('MMMM Do, YYYY'),
                                i_ot_start: arr[x].ot_start,
                                i_ot_end: arr[x].ot_end,
                                i_regular_time: arr[x].regular_time,
                                i_type: arr[x].type,
                                i_hours: arr[x].hours,
                                i_reason: arr[x].reason,
                                i_status: arr[x].status,
                                i_remarks: arr[x].remarks,
                                i_confirmed: arr[x].confirmed,
                            };
                        }
                    }
                }.bind(this));
            },

            timeformat(t){
                return moment(t, 'HH:mm:ss').format('hh:mma');
            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            dateSelect(index){
                var w = moment(this.form.ot_date[index], 'YYYY-MM-DD').format('YYYY-MM-DD');
                var x = this.DisDays.indexOf(w);
                this.form.ot_date[index] = w;
                
                if(x > -1){
                    this.DisDays.splice(x, 1);
                }        
                this.DisDays.push(this.form.ot_date[index]);

            },

            timeInSelect(index){
                this.form.ot_start[index] = moment(this.time_start[index], 'HH:mm:ss').format('HH:mm');
            },

            timeOutSelect(index){
                this.form.ot_end[index] = moment(this.time_end[index], 'HH:mm:ss').format('HH:mm');
            },


            addOT(){
                this.ct = this.ct+1;
                this.time_start.push();
                this.time_end.push();
                this.form.ot_id.push(this.ct);
                this.form.ot_date.push('');
                this.form.ot_start.push('');
                this.form.ot_end.push('');
                this.form.ot_regular_time.push('');
                this.form.ot_type.push('');
                this.form.ot_reason.push('');
                this.form.ot_hidden.push(true);
                this.error_msg.e_date.push('');
                this.error_msg.e_time_start.push('');
                this.error_msg.e_time_end.push('');
                this.error_msg.e_type.push('');
                this.error_msg.e_regular_time.push('');
                this.error_msg.e_reason.push('');
            },

            removeOT(index, ot){
                this.time_start.splice(index, 1);
                this.time_end.splice(index, 1);
                this.form.ot_id.splice(index, 1);
                this.form.ot_date.splice(index, 1);
                this.form.ot_start.splice(index, 1);
                this.form.ot_end.splice(index, 1);
                this.form.ot_regular_time.splice(index, 1);
                this.form.ot_type.splice(index, 1);
                this.form.ot_reason.splice(index, 1);
                this.form.ot_hidden.splice(index, 1);
                this.error_msg.e_date.splice(index, 1);
                this.error_msg.e_time_start.splice(index, 1);
                this.error_msg.e_time_end.splice(index, 1);
                this.error_msg.e_type.splice(index, 1);
                this.error_msg.e_regular_time.splice(index, 1);
                this.error_msg.e_reason.splice(index, 1);
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_date = ['']; 
                this.error_msg.e_time_start = [''];
                this.error_msg.e_time_end = [''];
                this.error_msg.e_type = [''];
                this.error_msg.e_regular_time = [''];
                this.error_msg.e_reason = [''];

                for(let x = 0; x < this.form.ot_id.length; x++){
                    if(!this.form.ot_date[x]){
                        this.errors.push('Date is required');
                        this.error_msg.e_date[x] = 'Date is required';
                    }
                    if(!this.form.ot_start[x]){
                        this.errors.push('Time start is required');
                        this.error_msg.e_time_start[x] ='OT start is required';
                    }
                    if(!this.form.ot_end[x]){
                        this.errors.push('Time end is required');
                        this.error_msg.e_time_end[x] = 'OT end is required';
                    }   
                    if(!this.form.ot_type[x]){
                        this.errors.push('OT type is required');
                        this.error_msg.e_type[x] = 'OT type  is required';
                    }
                    if(!this.form.ot_reason[x]){
                        this.errors.push('Reason is required');
                        this.error_msg.e_reason[x] = 'Reason is required';
                    }
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/ot/store');
                    this.pushOT();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested Over Time form.").goAway(5000);
                }
            },

            pushOT(){
                for(var x = 0; x < this.form.ot_id.length; x++){
                    this.OTB.push({
                        date: this.form.ot_date[x],
                        ot_start: this.timeformat(this.form.ot_start[x]),
                        ot_end: this.timeformat(this.form.ot_end[x]),
                        type: this.form.ot_type[x],
                        hours: moment(this.form.ot_end, 'HH:mm').diff(moment(this.form.ot_start, 'HH:mm'), 'hours'),
                        regular_time: this.form.ot_regular_time[x],
                        reason: this.form.ot_reason[x],
                        status: "For authorization",
                    });
                    this.DTB.row.add([
                            this.dateformat(this.form.ot_date[x]),
                            this.form.ot_type[x],
                            this.form.ot_regular_time[x],
                            "For authorization", 
                            "<button data-date="+ this.form.ot_date[x] +" class='btn btn-link' data-toggle='modal' data-target='#Info'>more...</button>", 
                        ]).draw(false);
                    this.DisDays.push(this.form.ot_date[x]);
                }
                this.time_start = [];
                this.time_end = [];
                this.form.ot_date = [];
                this.form.ot_start = [];
                this.form.ot_end = [];
                this.form.ot_type = [];
                this.form.ot_regular_time = [];
                this.form.ot_reason = [];
            },

            updateData(index){
                this.form.patch('/forms/ot/update/' + index);
                for(let x = 0; x < this.OTB.length; x++){
                    if(this.OTB[x].id == index){
                        this.OTB[x].confirmed = 1;
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
