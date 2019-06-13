<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Early Timeout requests</h5>

                        </div>
                        <div class="peer">
                            <h6><a href="" data-toggle="modal" data-target="#Modal">File an Early Timeout</a></h6>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Date</small></th>
                            <th><small>Shift time out</small></th>
                            <th><small>New time out</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(et, index) in ET">
                            <td>{{ET[index].date}}</td>
                            <td>{{ET[index].time_out}}</td>
                            <td>{{ET[index].new_time_out}}</td>
                            <td>{{ET[index].status}}</td>
                            <td><button :data-date="ETB[index].date" class="btn btn-link" data-toggle="modal" data-target="#Info">more...</button></td>
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
                            <h5 class="modal-title" id="ET">Requested Early Timeout( {{imodal.i_status}} )</h5>
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
                                    <small class="text-primary">Shift time out</small>
                                    <p>{{imodal.i_time_out}}</p>
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
        <form action="/forms/et/store" METHOD="POST" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="modal fade " id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" :aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ET">Request Early Timeout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form">
                             <div v-for="(et,index) in form.et_id" class="container-fluid p-0 m-0">
                                <div class="form-row">
                                    <span v-text="" hidden></span>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <time-picker 
                                                        v-model="form.et_date[index]" 
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
                                                        v-model="time_out[index]" 
                                                        lang="en" type="time" 
                                                        format="hh:mma" 
                                                        placeholder="Shift time out"
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
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="text" id="reason" class="form-control"
                                                   v-model="form.et_reason[index]"
                                                   title="Reason" placeholder="Reason">
                                            <small v-text="error_msg.e_reason[index]" class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a v-show="form.et_hidden[index]" class="btn btn-danger btn-sm float-right " @click="removeET(index, et)"><i class="ti-eraser" style="color: white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.et_id.length < 5" class="container-fluid text-center">
                                <a class="btn btn-light " @click="addET">Add Early Timeout</a>
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
                    e_time_out: [''],
                    e_new_time_out: [''],
                    e_reason: [''],
                },

                ET: [],
                ETB: [],
                DTB: '',

                time_out: [],
                new_time_out: [],

                imodal: {
                },

                form: new Form({
                    et_hidden: [false],
                    et_id: [1],
                    et_date: [],
                    et_time_out: [],
                    et_new_time_out: [],
                    et_location: [''],
                    et_reason: [''],
                })
            }
        },


        created: function () {
            this.list.map((lis) => {
                this.ET.push({
                    date: this.dateformat(lis.date),
                    time_out: this.timeformat(lis.time_out),
                    new_time_out: this.timeformat(lis.new_time_out),
                    reason: lis.reason,
                    status: lis.status,
                });
                this.ETB.push({
                    id: lis.id,
                    date: lis.date,
                    time_out: this.timeformat(lis.time_out),
                    new_time_out: this.timeformat(lis.new_time_out),
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
                var arr = this.ETB;
                $('#empSched-list tbody').on('click', 'button', function(e){
                    var target = e.target;
                    for(let x = 0; x < arr.length; x++){
                        if(arr[x].date === $(target).data('date')){
                            this.imodal = {
                                i_id: arr[x].id,
                                i_date: moment($(target).data('date'), 'YYYY-MM-DD').format('MMMM Do, YYYY'),
                                i_time_out: arr[x].time_out,
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

            dateSelect(index){
                var w = moment(this.form.et_date[index], 'YYYY-MM-DD').format('YYYY-MM-DD');
                var x = this.DisDays.indexOf(w);
                this.form.et_date[index] = w;
                
                if(x > -1){
                    this.DisDays.splice(x, 1);
                }        
                this.DisDays.push(this.form.et_date[index]);

            },

            timeOutSelect(index){
                this.form.et_time_out[index] = moment(this.time_out[index], 'HH:mm:ss').format('HH:mm');
            },

            newTimeOutSelect(index){
                this.form.et_new_time_out[index] = moment(this.new_time_out[index], 'HH:mm:ss').format('HH:mm');
            },


            addET(){
                this.ct = this.ct+1;
                this.time_out.push();
                this.new_time_out.push();
                this.form.et_id.push(this.ct);
                this.form.et_date.push('');
                this.form.et_time_out.push('');
                this.form.et_new_time_out.push('');
                this.form.et_reason.push('');
                this.form.et_hidden.push(true);
                this.error_msg.e_date.push('');
                this.error_msg.e_time_out.push('');
                this.error_msg.e_new_time_out.push('');
                this.error_msg.e_reason.push('');
            },

            removeET(index, et){
                this.time_out.splice(index, 1);
                this.new_time_out.splice(index, 1);
                this.form.et_id.splice(index, 1);
                this.form.et_date.splice(index, 1);
                this.form.et_time_out.splice(index, 1);
                this.form.et_new_time_out.splice(index, 1);
                this.form.et_reason.splice(index, 1);
                this.form.et_hidden.splice(index, 1);
                this.error_msg.e_date.splice(index, 1);
                this.error_msg.e_time_out.splice(index, 1);
                this.error_msg.e_new_time_out.splice(index, 1);
                this.error_msg.e_reason.splice(index, 1);
            },

            checkForms(){
                this.errors = [];
                this.error_msg.e_date = ['']; 
                this.error_msg.e_time_out = [''];
                this.error_msg.e_new_time_out = [''];
                this.error_msg.e_reason = [''];

                for(let x = 0; x < this.form.et_id.length; x++){
                    if(!this.form.et_date[x]){
                        this.errors.push('Date is required');
                        this.error_msg.e_date[x] = 'Date is required';
                    }
                    if(!this.form.et_time_out[x]){
                        this.errors.push('Current time out is required');
                        this.error_msg.e_time_out[x] = 'Shift time out is required';
                    }   
                    if(!this.form.et_new_time_out[x]){
                        this.errors.push('New time out is required');
                        this.error_msg.e_new_time_out[x] = 'New time out is required';
                    }
                    if(!this.form.et_reason[x]){
                        this.errors.push('Reason is required');
                        this.error_msg.e_reason[x] = 'Reason is required';
                    }
                }
            },

            submit(){
                this.checkForms();
                if(!this.errors.length){
                    $("#Modal").modal('hide');
                    this.form.post('/forms/et/store');
                    this.pushET();
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Requested Early Timeout form.").goAway(5000);
                }
            },

            pushET(){
                for(var x = 0; x < this.form.et_id.length; x++){
                    this.ETB.push({
                        date: this.form.et_date[x],
                        time_out: this.timeformat(this.form.et_time_out[x]),
                        new_time_out: this.timeformat(this.form.et_new_time_out[x]),
                        reason: this.form.et_reason[x],
                        status: "For authorization",
                    });
                    this.DTB.row.add([
                            this.dateformat(this.form.et_date[x]),
                            this.timeformat(this.form.et_time_out[x]),
                            this.timeformat(this.form.et_new_time_out[x]),
                            "For authorization", 
                            "<button data-date="+ this.form.et_date[x] +" class='btn btn-link' data-toggle='modal' data-target='#Info'>more...</button>", 
                        ]).draw(false);
                    this.DisDays.push(this.form.et_date[x]);
                }
                this.time_out = [];
                this.new_time_out = [];
                this.form.et_date = [];
                this.form.et_time_out = [];
                this.form.et_new_time_out = [];
                this.form.et_reason = [];
            },

            updateData(index){
                this.form.patch('/forms/et/update/' + index);
                for(let x = 0; x < this.ETB.length; x++){
                    if(this.ETB[x].id == index){
                        this.ETB[x].confirmed = 1;
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
