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
                            <th><small>Date</small></th>
                            <th><small>Time in</small></th>
                            <th><small>Time out</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ob, index) in OB">
                            <td>{{OB[index].date}}</td>
                            <td>{{OB[index].time_in}}</td>
                            <td>{{OB[index].time_out}}</td>
                            <td>{{OB[index].status}}</td>
                            <td><button :data-date="OBB[index].date" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
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
                            <h5 class="modal-title" id="OB">Requested OB( {{imodal.i_status}} )</h5>
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
                                    <small class="text-primary">Time in</small>
                                    <p>{{imodal.i_time_in}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Time out</small>
                                    <p>{{imodal.i_time_out}}</p>
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
                             <div v-for="(ob,index) in form.ob_id" class="container-fluid p-0 m-0">
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.ob_date[index]" 
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
                                                        v-model="time_in[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="Time in"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeInSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_time_in[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="time_out[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="Time out"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeOutSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_time_out[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="text" id="location" class="form-control"
                                                   v-model="form.ob_location[index]"
                                                   title="Location" placeholder="Location">
                                            <small v-text="error_msg.e_location[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="text" id="reason" class="form-control"
                                                   v-model="form.ob_reason[index]"
                                                   title="Reason" placeholder="Reason">
                                            <small v-text="error_msg.e_reason[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="checkbox" id="ti_yes" v-model="form.ti_checked[index]">
                                            <small>Time in at office?</small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="checkbox" id="to_yes" v-model="form.to_checked[index]"> 
                                            <small>Time out at office?</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a v-show="form.ob_hidden[index]" class="btn btn-danger btn-sm float-right " @click="removeOB(index, ob)"><i class="ti-eraser" style="color: white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.ob_id.length < 5" class="container-fluid text-center">
                                <a class="btn btn-light " @click="addOB">Add OB</a>
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
                    e_time_in: [''],
                    e_time_out: [''],
                    e_location: [''],
                    e_reason: [''],
                },

                OB: [],
                OBB: [],
                DTB: '',

                time_in: [],
                time_out: [],

                imodal: {
                },

                form: new Form({
                    ti_checked: [false],
                    to_checked: [false],

                    ob_hidden: [false],
                    ob_id: [1],
                    ob_date: [],
                    ob_time_in: [],
                    ob_time_out: [],
                    ob_location: [''],
                    ob_reason: [''],
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.OB.push({
                    date: this.dateformat(lis.date),
                    location: lis.location,
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    reason: lis.reason,
                    status: lis.status,
                    o_in: lis.o_in,
                    o_out: lis.o_out,
                });
                this.OBB.push({
                    id: lis.id,
                    date: lis.date,
                    location: lis.location,
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    reason: lis.reason,
                    remarks: lis.remarks,
                    status: lis.status,
                    o_in: lis.o_in,
                    o_out: lis.o_out,
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

            timeformat(t){
                return moment(t, 'HH:mm:ss').format('hh:mma');
            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            dateSelect(index){
                var w = moment(this.form.ob_date[index], 'YYYY-MM-DD').format('YYYY-MM-DD');
                var x = this.DisDays.indexOf(w);
                this.form.ob_date[index] = w;
                
                if(x > -1){
                    this.DisDays.splice(x, 1);
                }        
                this.DisDays.push(this.form.ob_date[index]);

            },

            timeInSelect(index){
                this.form.ob_time_in[index] = moment(this.time_in[index], 'HH:mm:ss').format('HH:mm');
            },

            timeOutSelect(index){
                this.form.ob_time_out[index] = moment(this.time_out[index], 'HH:mm:ss').format('HH:mm');
            },


            addOB(){
                this.ct = this.ct+1;
                this.time_in.push();
                this.time_out.push();
                this.form.ob_id.push(this.ct);
                this.form.ob_date.push('');
                this.form.ob_time_in.push('');
                this.form.ob_time_out.push('');
                this.form.ob_location.push('');
                this.form.ob_reason.push('');
                this.form.ob_hidden.push(true);
                this.form.ti_checked.push(false);
                this.form.to_checked.push(false);
                this.error_msg.e_date.push('');
                this.error_msg.e_time_in.push('');
                this.error_msg.e_time_out.push('');
                this.error_msg.e_location.push('');
                this.error_msg.e_reason.push('');
            },

            removeOB(index, ob){
                this.time_in.splice(index, 1);
                this.time_out.splice(index, 1);
                this.form.ob_id.splice(index, 1);
                this.form.ob_date.splice(index, 1);
                this.form.ob_time_in.splice(index, 1);
                this.form.ob_time_out.splice(index, 1);
                this.form.ob_location.splice(index, 1);
                this.form.ob_reason.splice(index, 1);
                this.form.ob_hidden.splice(index, 1);
                this.form.ti_checked.splice(index, 1);
                this.form.to_checked.splice(index, 1);
                this.error_msg.e_date.splice(index, 1);
                this.error_msg.e_time_in.splice(index, 1);
                this.error_msg.e_time_out.splice(index, 1);
                this.error_msg.e_location.splice(index, 1);
                this.error_msg.e_reason.splice(index, 1);
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_date = ['']; 
                this.error_msg.e_time_in = [''];
                this.error_msg.e_time_out = [''];
                this.error_msg.e_location = [''];
                this.error_msg.e_reason = [''];

                for(let x = 0; x < this.form.ob_id.length; x++){
                    if(!this.form.ob_date[x]){
                        this.errors.push('Date is required');
                        this.error_msg.e_date[x] = 'Date is required';
                    }
                    if(!this.form.ob_location[x]){
                        this.errors.push('Location is required');
                        this.error_msg.e_location[x] ='Location is required';
                    }
                    if(!this.form.ob_time_in[x]){
                        this.errors.push('Time in is required');
                        this.error_msg.e_time_in[x] = 'Time in is required';
                    }   
                    if(!this.form.ob_time_out[x]){
                        this.errors.push('Time out is required');
                        this.error_msg.e_time_out[x] = 'Time out is required';
                    }
                    if(!this.form.ob_reason[x]){
                        this.errors.push('Reason is required');
                        this.error_msg.e_reason[x] = 'Reason is required';
                    }
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/ob/store');
                    this.pushOB();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested OB form.").goAway(5000);
                }
            },

            pushOB(){
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
