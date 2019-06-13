<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Temporary Change of Shift requests</h5>

                        </div>
                        <div class="peer">
                            <h6><a href="" data-toggle="modal" data-target="#Modal">File a Change of Shift</a></h6>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Shift date</small></th>
                            <th><small>Shift time in</small></th>
                            <th><small>Shift time out</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cs, index) in CS">
                            <td>{{CS[index].date}}</td>
                            <td>{{CS[index].time_in}}</td>
                            <td>{{CS[index].time_out}}</td>
                            <td>{{CS[index].status}}</td>
                            <td><button :data-date="CSB[index].date" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
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
                            <h5 class="modal-title" id="CS">Requested Change of Shift( {{imodal.i_status}} )</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">Shift date</small>
                                    <p>{{imodal.i_date}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Shift time in</small>
                                    <p>{{imodal.i_time_in}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">Shift time out</small>
                                    <p>{{imodal.i_time_out}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small class="text-primary">New date</small>
                                    <p>{{imodal.i_new_date}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">New time in</small>
                                    <p>{{imodal.i_new_time_in}}</p>
                                </div>
                                <div class="col">
                                    <small class="text-primary">New time out</small>
                                    <p>{{imodal.i_new_time_out}}</p>
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
        <form action="/forms/cs/store" METHOD="POST" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cs">Request Change of Shift</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                             <div v-for="(cs,index) in form.cs_id" class="container-fluid p-0 m-0">
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.cs_date[index]" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do" 
                                                        format="MMMM Do" 
                                                        placeholder="Shift date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false">
                                            </time-picker>
                                            <br>
                                            <small v-text="error_msg.e_date[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="time_in[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="Shift time in"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeInSelect(index)">
                                            </time-picker>
                                            <br>
                                            <small v-text="error_msg.e_time_in[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="time_out[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="Shift time out"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="timeOutSelect(index)">
                                            </time-picker>
                                            <br>
                                            <small v-text="error_msg.e_time_out[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.cs_new_date[index]" 
                                                        lang="en" type="date" 
                                                        date-format="MMMM Do" 
                                                        format="MMMM Do" 
                                                        placeholder="New date"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        :disabled-days="DisDays"
                                                        @confirm="dateSelect(index)">
                                            </time-picker>
                                            <br>
                                            <small v-text="error_msg.e_new_date[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="new_time_in[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="New time in"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="newTimeInSelect(index)">
                                            </time-picker>
                                            <br>
                                            <small v-text="error_msg.e_new_time_in[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="new_time_out[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="New time out"
                                                        confirm
                                                        :editable="false"
                                                        :clearable="false"
                                                        @confirm="newTimeOutSelect(index)">
                                            </time-picker>
                                            <small v-text="error_msg.e_new_time_out[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="text" id="reason" class="form-control"
                                                   v-model="form.cs_reason[index]"
                                                   title="Reason" placeholder="Reason">
                                            <small v-text="error_msg.e_reason[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a v-show="form.cs_hidden[index]" class="btn btn-danger btn-sm float-right " @click="removeCS(index, cs)"><i class="ti-eraser" style="color: white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.cs_id.length < 5" class="container-fluid text-center">
                                <a class="btn btn-light " @click="addCS">Add Change of Shift</a>
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
                    e_new_date: [''],
                    e_new_time_in: [''],
                    e_new_time_out: [''],
                    e_reason: [''],
                },

                CS: [],
                CSB: [],
                DTB: '',

                time_in: [],
                time_out: [],
                new_time_in: [],
                new_time_out: [],

                imodal: {
                },

                form: new Form({
                    cs_hidden: [false],
                    cs_id: [1],
                    cs_date: [],
                    cs_time_in: [],
                    cs_time_out: [],
                    cs_new_date: [],
                    cs_new_time_in: [],
                    cs_new_time_out: [],
                    cs_reason: [''],
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.CS.push({
                    date: this.dateformat(lis.date),
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    new_date: this.dateformat(lis.new_date),
                    new_time_in: this.timeformat(lis.new_time_in),
                    new_time_out: this.timeformat(lis.new_time_out),
                    reason: lis.reason,
                    status: lis.status,
                });
                this.CSB.push({
                    id: lis.id,
                    date: this.dateformat2(lis.date),
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    new_date: lis.new_date,
                    new_time_in: this.timeformat(lis.new_time_in),
                    new_time_out: this.timeformat(lis.new_time_out),
                    reason: lis.reason,
                    remarks: lis.remarks,
                    status: lis.status,
                    confirmed: lis.confirmed,
                });
                if(lis.status !== 'Unauthorized'){
                    this.DisDays.push(lis.new_date);
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
                var arr = this.CSB;
                $('#empSched-list tbody').on('click', 'button', function(e){
                    var target = e.target;
                    for(let x = 0; x < arr.length; x++){
                        if(arr[x].date === $(target).data('date')){
                            this.imodal = {
                                i_id: arr[x].id,
                                i_date: moment($(target).data('date'), 'YYYY-MM-DD').format('MMMM Do, YYYY'),
                                i_time_in: arr[x].time_in,
                                i_time_out: arr[x].time_out,
                                i_new_date: arr[x].new_date,
                                i_new_time_in: arr[x].new_time_in,
                                i_new_time_out: arr[x].new_time_out,
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

            dateformat2(d){
                return moment(d, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            dateSelect(index){
                var w = moment(this.form.cs_new_date[index], 'YYYY-MM-DD').format('YYYY-MM-DD');
                var x = this.DisDays.indexOf(w);
                this.form.cs_new_date[index] = w;
                
                if(x > -1){
                    this.DisDays.splice(x, 1);
                }        
                this.DisDays.push(this.form.cs_new_date[index]);

            },

            timeInSelect(index){
                this.form.cs_time_in[index] = moment(this.time_in[index], 'HH:mm:ss').format('HH:mm');
            },

            timeOutSelect(index){
                this.form.cs_time_out[index] = moment(this.time_out[index], 'HH:mm:ss').format('HH:mm');
            },

            newTimeInSelect(index){
                this.form.cs_new_time_in[index] = moment(this.new_time_in[index], 'HH:mm:ss').format('HH:mm');
            },

            newTimeOutSelect(index){
                this.form.cs_new_time_out[index] = moment(this.new_time_out[index], 'HH:mm:ss').format('HH:mm');
            },


            addCS(){
                this.ct = this.ct+1;
                this.time_in.push();
                this.time_out.push();
                this.new_time_in.push();
                this.new_time_out.push();
                this.form.cs_id.push(this.ct);
                this.form.cs_date.push('');
                this.form.cs_time_in.push('');
                this.form.cs_time_out.push('');
                this.form.cs_new_date.push('');
                this.form.cs_new_time_in.push('');
                this.form.cs_new_time_out.push('');
                this.form.cs_reason.push('');
                this.form.cs_hidden.push(true);
                this.error_msg.e_date.push('');
                this.error_msg.e_time_in.push('');
                this.error_msg.e_time_out.push('');
                this.error_msg.e_new_date.push('');
                this.error_msg.e_new_time_in.push('');
                this.error_msg.e_new_time_out.push('');
                this.error_msg.e_reason.push('');
            },

            removeCS(index, cs){
                this.time_in.splice(index, 1);
                this.time_out.splice(index, 1);
                this.new_time_in.splice(index, 1);
                this.new_time_out.splice(index, 1);
                this.form.cs_id.splice(index, 1);
                this.form.cs_date.splice(index, 1);
                this.form.cs_time_in.splice(index, 1);
                this.form.cs_time_out.splice(index, 1);
                this.form.cs_new_date.splice(index, 1);
                this.form.cs_new_time_in.splice(index, 1);
                this.form.cs_new_time_out.splice(index, 1);
                this.form.cs_reason.splice(index, 1);
                this.form.cs_hidden.splice(index, 1);
                this.error_msg.e_date.splice(index, 1);
                this.error_msg.e_time_in.splice(index, 1);
                this.error_msg.e_time_out.splice(index, 1);
                this.error_msg.e_new_date.splice(index, 1);
                this.error_msg.e_new_time_in.splice(index, 1);
                this.error_msg.e_new_time_out.splice(index, 1);
                this.error_msg.e_reason.splice(index, 1);
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_date = ['']; 
                this.error_msg.e_time_in = [''];
                this.error_msg.e_time_out = [''];
                this.error_msg.e_new_date = ['']; 
                this.error_msg.e_new_time_in = [''];
                this.error_msg.e_new_time_out = [''];
                this.error_msg.e_reason = [''];

                for(let x = 0; x < this.form.cs_id.length; x++){
                    if(!this.form.cs_date[x]){
                        this.errors.push('Date is required');
                        this.error_msg.e_date[x] = 'Date is required';
                    }
                    if(!this.form.cs_time_in[x]){
                        this.errors.push('Time in is required');
                        this.error_msg.e_time_in[x] = 'Time in is required';
                    }   
                    if(!this.form.cs_time_out[x]){
                        this.errors.push('Time out is required');
                        this.error_msg.e_time_out[x] = 'Time out is required';
                    }
                    if(!this.form.cs_new_date[x]){
                        this.errors.push('New date is required');
                        this.error_msg.e_new_date[x] = 'Date is required';
                    }
                    if(!this.form.cs_new_time_in[x]){
                        this.errors.push('Time in is required');
                        this.error_msg.e_new_time_in[x] = 'Time in is required';
                    }   
                    if(!this.form.cs_new_time_out[x]){
                        this.errors.push('Time out is required');
                        this.error_msg.e_new_time_out[x] = 'Time out is required';
                    }
                    if(!this.form.cs_reason[x]){
                        this.errors.push('Reason is required');
                        this.error_msg.e_reason[x] = 'Reason is required';
                    }
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/cs/store');
                    this.pushCS();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested Temporary Change of Shift form.").goAway(5000);
                }
            },

            pushCS(){
                for(var x = 0; x < this.form.cs_id.length; x++){
                    this.CSB.push({
                        date: this.dateformat2(this.form.cs_date[x]),
                        time_in: this.timeformat(this.form.cs_time_in[x]),
                        time_out: this.timeformat(this.form.cs_time_out[x]),
                        new_date: this.form.cs_new_date[x],
                        new_time_in: this.timeformat(this.form.cs_new_time_in[x]),
                        new_time_out: this.timeformat(this.form.cs_new_time_out[x]),
                        reason: this.form.cs_reason[x],
                        status: "For authorization",
                    });
                    this.DTB.row.add([
                            this.dateformat(this.form.cs_date[x]),
                            this.timeformat(this.form.cs_time_in[x]),
                            this.timeformat(this.form.cs_time_out[x]),
                            "For authorization", 
                            "<button data-date="+ this.dateformat2(this.form.cs_date[x]) +" class='btn btn-link' data-toggle='modal' data-target='#Info'>more...</button>", 
                        ]).draw(false);
                    this.DisDays.push(this.form.cs_new_date[x]);
                }
                this.time_in = [];
                this.time_out = [];
                this.new_time_in = [];
                this.new_time_out = [];
                this.form.cs_date = [];
                this.form.cs_time_in = [];
                this.form.cs_time_out = [];
                this.form.cs_new_date = [];
                this.form.cs_new_time_in = [];
                this.form.cs_new_time_out = [];
                this.form.cs_reason = [];
            },

            updateData(index){
                this.form.patch('/forms/cs/update/' + index);
                for(let x = 0; x < this.CSB.length; x++){
                    if(this.CSB[x].id == index){
                        this.csB[x].confirmed = 1;
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
