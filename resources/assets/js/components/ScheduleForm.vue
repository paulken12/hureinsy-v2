<template>
    <div>    
        <div class="bd bgc-white">
            <form action="/employee/attendance/store" METHOD="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5>Scheduler</h5>
                        </div>

                        <div class="peer">
                            <label class="sr-only" for="employee">Employee</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="ti-user"></i></div>
                                </div>
                                <select v-model="form.in_employee_id" id="employee" class="form-control" @change="check_in">
                                    <option value="">-- Select employee --</option>
                                    <option v-for="(emp, index) in form.employee_id" :value="form.employee_id[index]">{{ form.employee_name[index] }}</option>
                                </select>
                                <small class="text-danger"
                                       v-if="form.errors.has('in_employee_id')"
                                       v-text="form.errors.get('in_employee_id')"></small>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layers">
                    <div class="row p-0 m- w-100">
                        <div class="col bdT p-0">
                            <div class="layer w-100 fxg-1 p-30">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="shift">Employee Shift</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="ti-time"></i></div>
                                                </div>
                                                <select v-model="form.in_shift" id="shift" class="form-control" @change="check_shift">
                                                    <option value="">-- Select Shift --</option>
                                                    <option v-for="(shi, index) in form.shift_id" :value="form.shift_id[index]">
                                                        <p v-text="form.shift_name[index]"></p>
                                                        <p v-text="formatt(form.shift_time_in[index])"></p> to
                                                        <p v-text="formatt(form.shift_time_out[index])"></p>
                                                    </option>
                                                </select>
                                                <small class="text-danger"
                                                       v-if="form.errors.has('in_shift')"
                                                       v-text="form.errors.get('in_shift')"></small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <datepicker v-model="form.in_start"
                                                                    :format="customFormatter"
                                                                    :bootstrap-styling="true"
                                                                    :calendar-button="true"
                                                                    calendar-button-icon="ti-calendar"
                                                                    value-type="format"
                                                                    placeholder="Date"
                                                                    style="color:black;"
                                                                    @closed="check_date">
                                                        </datepicker>
                                                        <small class="text-danger"
                                                               v-if="form.errors.has('in_start')"
                                                               v-text="form.errors.get('in_start')"></small>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <datepicker v-model="form.in_end"
                                                                    :format="customFormatter"
                                                                    :bootstrap-styling="true"
                                                                    :calendar-button="true"
                                                                    calendar-button-icon="ti-calendar"
                                                                    value-type="format"
                                                                    placeholder="Date"
                                                                    style="color:black;"
                                                                    @closed="check_date">
                                                        </datepicker>
                                                        <small class="text-danger"
                                                               v-if="form.errors.has('in_end')"
                                                               v-text="form.errors.get('in_end')"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="text-danger" v-text="err_mes2"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">   
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="start_date">Week Start</label>
                                                        <p v-text="week_start"/>
                                                        <small class="text-danger"
                                                               v-if="form.errors.has('in_week_start')"
                                                               v-text="form.errors.get('in_week_start')"></small>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="end_date">Days per Week</label>
                                                        <input type="text" v-model="form.in_days_per_week" title="Days per week" class="form-control" @change="check_shift" v-mask="'#'" placeholder="Days per week"/>
                                                        <small class="text-danger"
                                                               v-if="form.errors.has('in_days_per_week')"
                                                               v-text="form.errors.get('in_days_per_week')"></small>
                                                        <small class="text-danger" v-text="err_mes1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ta-r bdT w-100 p-20">
                                    <button type="submit" class="btn btn-info" :disabled="isDisabled">Set Schedule</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    import Datepicker from 'vuejs-datepicker';

    export default {

        props: ['employees', 'shifts'],
        components: {Datepicker},

        data: function () {
            return {

                csrf: '',

                fail: true,

                week_start: '',

                err_mes1: '',
                err_mes2: '',

                in_employee_id_troo: true,
                in_shift_troo: true,
                in_days_per_week_troo: true,
                in_start_troo: true,
                in_end_troo: true,

                form: new Form({
                    employee_id:[],
                    employee_name:[],
                    
                    shift_id:[],
                    shift_name:[],
                    shift_time_in: [],
                    shift_time_out:[],

                    shift_week:['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    
                    in_employee_id: '',

                    in_shift: '',
                    in_days_per_week: '',
                    in_week_start: '',
                    in_total_hours: '',

                    in_start: '',
                    in_end: '',

                })

            }
        },


        created: function () {
            this.employees.map((emp) => {
                this.form.employee_id.push(emp.id);
                this.form.employee_name.push(emp.company_id +' - '+ emp.last_name +', '+ emp.first_name);
            });

            this.shifts.map((shi) => {
                this.form.shift_id.push(shi.id);
                this.form.shift_name.push(shi.display_name);
                this.form.shift_time_in.push(shi.time_in);
                this.form.shift_time_out.push(shi.time_out);
            });
        },

        mounted: function () {
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        },

        computed: {
            isDisabled(){
                return this.in_employee_id_troo || this.in_shift_troo || this.in_days_per_week_troo || this.in_start_troo || this.in_end_troo;
            },
        },

        methods: {

            formatt(time){
                return moment(time, 'HH:mm:ss').format('hh:mm A');
            },

            setWeek(dow){
                for(var a = 0; a < this.form.shift_week.length; a++){
                    if(this.form.shift_week[a] === dow){
                        this.form.in_week_start = dow;
                        this.week_start = moment(this.form.in_start).format('dddd');
                    }
                }

            },

            getTotalHours(time_in, time_out){
                time_in = moment.duration(time_in);
                time_out = moment.duration(time_out);
                var diff = time_out.subtract(time_in);
                var hr = diff.hours(); // return hours
                if(hr <= 0){
                    hr = hr +24;
                }
                var min = diff.minutes(); // return minutes
                if(min <= 0){
                    min = min +60;
                }
                var dy = this.form.in_days_per_week;

                var min = ((min * dy)%60);
                var hmin =  Math.floor((min * dy)/60);
                var hr = hr * dy

                this.form.in_total_hours = Math.abs(hr + hmin) +'.'+ Math.abs(min);

                if(this.form.in_total_hours < 45 || this.form.in_total_hours > 48){
                    this.in_shift_troo = true;
                    this.in_days_per_week_troo = true;
                    this.err_mes1 = 'total must be no more than or less 48 hours per week. total hours: '+ this.form.in_total_hours;
                }else{
                    this.in_shift_troo = false;
                    this.in_days_per_week_troo = false;
                    this.err_mes1 = '';
                }
            },


            clearput(){
                this.form.in_employee_id = '';
                this.form.in_shift = '';
                this.form.in_days_per_week = '';
                this.form.in_week_start = '';
                this.form.in_total_hours = '';
                this.form.in_start = '';
                this.form.in_end = '';
            },

            onSubmit() {
                this.form.in_start = moment(this.form.in_start).format('YYYY-MM-DD');
                this.form.in_end = moment(this.form.in_end).format('YYYY-MM-DD');

                this.form.post('/employee/attendance/store')
                    .then(response => console.log('bump'))
                    .catch(error => this.form.errors.record(error.response.data.errors));

                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });
                toast.text("Schedule added.").goAway(5000);

                this.clearput();
                this.in_employee_id_troo = true;
                this.in_shift_troo = true;
                this.in_days_per_week_troo = true;
                this.in_start_troo = true;
                this.in_end_troo = true;
            },
            
            check_shift(){
                if(this.form.in_shift && this.form.in_days_per_week){
                    for(var a = 0; a < this.shifts.length; a++){
                        if(this.shifts[a].id === this.form.in_shift){
                            var time_in = this.shifts[a].time_in;
                            var time_out = this.shifts[a].time_out;
                            this.getTotalHours(time_in, time_out);
                        }
                    }
                }else{
                    this.in_shift_troo = true;
                    this.in_days_per_week_troo = true;
                }
            },

            check_date(){
                if(this.form.in_start){
                    var dow = moment(this.form.in_start).format('ddd');
                    this.setWeek(dow);
                }
                if(this.form.in_start && this.form.in_end){   
                    if(moment(this.form.in_start).format('YYYY-MM-DD') >= moment(this.form.in_end).format('YYYY-MM-DD')){
                        this.err_mes2 = "Date start must not be later than the end date, or having the same dates.";
                        this.in_start_troo = true;
                        this.in_end_troo = true;
                    }else{
                        this.err_mes2 = "";
                        this.in_start_troo = false;
                        this.in_end_troo = false;
                    }
                }else{
                    this.in_start_troo = false;
                    this.inend_troo = false;
                }
            },

            check_in(){
                if(this.form.in_employee_id){
                    this.in_employee_id_troo = false;
                }else{
                    this.in_employee_id_troo = true;
                }
            },

            customFormatter(date){
                return moment(date).format('MMMM Do');
            }
        }
    }
</script>
