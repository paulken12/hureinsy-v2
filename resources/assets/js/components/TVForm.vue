<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Time Validation requests</h5>

                        </div>
                        <div class="peer">
                            <h6><a href="" data-toggle="modal" data-target="#Modal">File a Time Validation</a></h6>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" style="width:100%">
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
                        <tr v-for="(tv, index) in TV">
                            <td>{{TV[index].date}}</td>
                            <td><span v-if="TV[index].time_in !== 'Invalid date'">{{TV[index].time_in}}</span>
                                <span v-else>No time</span>
                            </td>
                            <td><span v-if="TV[index].time_out !== 'Invalid date'">{{TV[index].time_out}}</span>
                                <span v-else>No time</span>
                            </td>
                            <td>{{TV[index].status}}</td>
                            <td><button :data-date="TVB[index].date" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
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
                            <h5 class="modal-title" id="TV">Requested Time Validation( {{imodal.i_status}} )</h5>
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
                                    <small class="text-primary">Ailibi/Proof presented</small>
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
        <form action="/forms/tv/store" METHOD="POST" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TV">Request Time Validation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                             <div v-for="(tv,index) in form.tv_id" class="container-fluid p-0 m-0">
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.tv_date[index]" 
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
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="text" id="reason" class="form-control"
                                                   v-model="form.tv_reason[index]"
                                                   title="Alibi/Proof presented" placeholder="Alibi/Proof presented">
                                            <small v-text="error_msg.e_reason[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a v-show="form.tv_hidden[index]" class="btn btn-danger btn-sm float-right " @click="removeTV(index, tv)"><i class="ti-eraser" style="color: white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.tv_id.length < 5" class="container-fluid text-center">
                                <a class="btn btn-light " @click="addTV">Add Time Validation</a>
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
                    e_reason: [''],
                },

                TV: [],
                TVB: [],
                DTB: '',

                time_in: [],
                time_out: [],

                imodal: {
                },

                form: new Form({
                    tv_hidden: [false],
                    tv_id: [1],
                    tv_date: [],
                    tv_time_in: [''],
                    tv_time_out: [''],
                    tv_reason: [''],
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.TV.push({
                    date: this.dateformat(lis.date),
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    reason: lis.reason,
                    status: lis.status,
                });
                this.TVB.push({
                    id: lis.id,
                    date: lis.date,
                    time_in: this.timeformat(lis.time_in),
                    time_out: this.timeformat(lis.time_out),
                    reason: lis.reason,
                    status: lis.status,
                    remarks: lis.remarks,
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
                var arr = this.TVB;
                $('#empSched-list tbody').on('click', 'button', function(e){
                    var target = e.target;
                    for(let x = 0; x < arr.length; x++){
                        if(arr[x].date === $(target).data('date')){
                            this.imodal = {
                                i_id: arr[x].id,
                                i_date: moment($(target).data('date'), 'YYYY-MM-DD').format('MMMM Do, YYYY'),
                                i_time_in: arr[x].time_in,
                                i_time_out: arr[x].time_out,
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
                if(t){
                    return moment(t, 'HH:mm:ss').format('hh:mma');
                }else{
                    return 'No time'
                }

            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            dateSelect(index){
                var w = moment(this.form.tv_date[index], 'YYYY-MM-DD').format('YYYY-MM-DD');
                var x = this.DisDays.indexOf(w);
                this.form.tv_date[index] = w;
                
                if(x > -1){
                    this.DisDays.splice(x, 1);
                }        
                this.DisDays.push(this.form.tv_date[index]);

            },

            timeInSelect(index){
                this.form.tv_time_in[index] = moment(this.time_in[index], 'HH:mm:ss').format('HH:mm');
            },

            timeOutSelect(index){
                this.form.tv_time_out[index] = moment(this.time_out[index], 'HH:mm:ss').format('HH:mm');
            },


            addTV(){
                this.ct = this.ct+1;
                this.time_in.push();
                this.time_out.push();
                this.form.tv_id.push(this.ct);
                this.form.tv_date.push('');
                this.form.tv_time_in.push('');
                this.form.tv_time_out.push('');
                this.form.tv_reason.push('');
                this.form.tv_hidden.push(true);
                this.error_msg.e_date.push('');
                this.error_msg.e_time_in.push('');
                this.error_msg.e_time_out.push('');
                this.error_msg.e_reason.push('');
            },

            removeTV(index, tv){
                this.time_in.splice(index, 1);
                this.time_out.splice(index, 1);
                this.form.tv_id.splice(index, 1);
                this.form.tv_date.splice(index, 1);
                this.form.tv_time_in.splice(index, 1);
                this.form.tv_time_out.splice(index, 1);
                this.form.tv_reason.splice(index, 1);
                this.form.tv_hidden.splice(index, 1);
                this.error_msg.e_date.splice(index, 1);
                this.error_msg.e_time_in.splice(index, 1);
                this.error_msg.e_time_out.splice(index, 1);
                this.error_msg.e_reason.splice(index, 1);
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_date = ['']; 
                this.error_msg.e_time_in = [''];
                this.error_msg.e_time_out = [''];
                this.error_msg.e_reason = [''];

                for(let x = 0; x < this.form.tv_id.length; x++){
                    if(!this.form.tv_date[x]){
                        this.errors.push('Date is required');
                        this.error_msg.e_date[x] = 'Date is required';
                    }
                    if(!this.form.tv_reason[x]){
                        this.errors.push('Reason is required');
                        this.error_msg.e_reason[x] = 'Reason is required';
                    }
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/tv/store');
                    this.pushTV();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested Time Validation form.").goAway(5000);
                }
            },

            pushTV(){
                for(var x = 0; x < this.form.tv_id.length; x++){
                    this.TVB.push({
                        date: this.form.tv_date[x],
                        time_in: this.timeformat(this.form.tv_time_in[x]),
                        time_out: this.timeformat(this.form.tv_time_out[x]),
                        reason: this.form.tv_reason[x],
                        status: "For authorization",
                    });
                    this.DTB.row.add([
                            this.dateformat(this.form.tv_date[x]),
                            this.timeformat(this.form.tv_time_in[x]),
                            this.timeformat(this.form.tv_time_out[x]),
                            "For authorization", 
                            "<button data-date="+ this.form.tv_date[x] +" class='btn btn-link' data-toggle='modal' data-target='#Info'>more...</button>", 
                        ]).draw(false);
                    this.DisDays.push(this.form.tv_date[x]);
                }
                this.time_in = [];
                this.time_out = [];
                this.form.tv_date = [];
                this.form.tv_time_in = [''];
                this.form.tv_time_out = [''];
                this.form.tv_reason = [];
            },

            updateData(index){
                this.form.patch('/forms/tv/update/' + index);
                for(let x = 0; x < this.TVB.length; x++){
                    if(this.TVB[x].id == index){
                        this.TVB[x].confirmed = 1;
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
