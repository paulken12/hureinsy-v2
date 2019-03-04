<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="row p-0 m- w-100">
                    <div class="col bdT p-0">
                        <div class="layer w-100 fxg-1 p-30">
                            <label for="empSched-list"><small><strong>Schedule for {{date_start}} to {{date_end}}</strong></small></label>
                            <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th><small>Date</small></th>
                                        <th><small>Time in</small></th>
                                        <th><small>Required in</small></th>
                                        <th><small>Late</small></th>
                                        <th><small>Time out</small></th>
                                        <th><small>Required out</small></th>
                                        <th><small>Undertime</small></th>
                                        <th><small>Total Hours</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(att, index) in attendance">
                                        <td>{{att.date}}</td>
                                        <td>
                                            <span v-if="att.time_in === 'No time in'" class="text-danger">{{att.time_in}}</span>
                                            <span v-else>{{att.time_in}}</span>
                                        </td>
                                        <td>{{shift.time_in}}</td>
                                        <td><span v-if="att.late" class="text-danger">{{att.late}} hours</span></td>
                                        <td>
                                            <span v-if="att.time_out === 'No time out'" class="text-danger">{{att.time_out}}</span>
                                            <span v-else>{{att.time_out}}</span>
                                        </td>
                                        <td>{{shift.time_out}}</td>
                                        <td><span v-if="att.undertime" class="text-danger">{{att.undertime}} hours</span></td>
                                        <td>
                                            <span v-if="att.total >= total_hours"><strong>{{att.total}} hours</strong></span>
                                            <span v-else-if="att.total < total_hours"><strong class="text-danger">{{att.total}} hours</strong></span>
                                            <span v-else ><strong class="text-info">Rest Day</strong></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    
    export default {
        props: ['emp_sched', 'emp_dtr', 'emp_info', 'holidays', 'emp_shift'],

        data: function () {
            return {

                sched: this.emp_sched,
                shift: this.emp_shift,
                attendance:[],
                attendanceNight:[],

                restDay: ['Sat', 'Sun'],
                
                date_start: '',
                date_end: '',
                total_hours: '',
            }
        },


        created: function () {

            this.rangeDates();
            this.date_start = moment(this.sched.start_date).format('MMM Do YYYY');
            this.date_end = moment(this.sched.end_date).format('MMM Do YYYY');

            this.emp_dtr.map((dtr) => {
                for(let c = 0; c < this.attendance.length; c++){
                    if(this.attendance[c].date === dtr.date){
                        if(dtr.time_in){
                            this.attendance[c].time_in = dtr.time_in;
                        }
                        if(dtr.time_out){
                            this.attendance[c].time_out = dtr.time_out;
                        }
                    }
                }
            });

            this.getShift();
        },

        mounted: function () {
            $('#empSched-list').DataTable({
                iDisplayLength: 5,
                bLengthChange: false,
            });

        },

        computed: {

            checkShift(){
                var ti = moment.duration(this.shift.time_in);
                var to = moment.duration(this.shift.time_out);
                var diff = to.subtract(ti);
                var hr = diff.hours();
                if(hr < 0){
                    return true;
                }else{
                    return false;
                }
            },
        },

        methods: {

            timeformat(t){
                return moment(t, 'HH:mm:ss').format('hh:mma');
            },

            getShift(){
                this.computeIn();
                this.computeOut();
                if(this.checkShift){
                    //night shift
                    this.computeNightTotal();
                    this.totalHoursNight();
                    this.nightSched();
                }else{
                    //day shift
                    this.computeDayTotal();
                    this.totalHoursDay();
                }
            },

            totalHoursNight(){
                var diff = moment('2000-01-02'+ this.shift.time_out, 'YYYY-MM-DD HH:mm:ss').diff(moment('2000-01-01'+ this.shift.time_in, 'YYYYY-MM-DD HH:mm:ss'));
                var total = moment.duration(diff);

                this.total_hours = total.hours() +'.'+ total.minutes();
            },

            totalHoursDay(){
                var diff = moment(this.shift.time_out, 'HH:mm:ss').diff(moment(this.shift.time_in, 'HH:mm:ss'));
                var total = moment.duration(diff);

                this.total_hours = total.hours() +'.'+ total.minutes();
            },

            computeIn(){
                var r_time_in = moment.duration(this.shift.time_in);
                for(let c = 0; c < this.attendance.length; c++){
                    if(this.attendance[c].time_in !== 'No time in'){
                        var time_in = moment.duration(this.attendance[c].time_in);
                        var diff = time_in.subtract(r_time_in);
                        if(diff.hours() > 0 || diff.minutes() > 0) {
                            this.attendance[c].late = (diff.hours() +'.'+ diff.minutes());
                        }

                    }
                }

            },  

            computeOut(){
                var r_time_out = moment.duration(this.shift.time_out);
                for(let c = 0; c < this.attendance.length; c++){
                    if(this.attendance[c].time_out !== 'No time out'){
                        var time_out = moment.duration(this.attendance[c].time_out);
                        var diff = time_out.subtract(r_time_out);

                        if(diff.hours() < 0 ||diff.minutes() < 0) {
                            this.attendance[c].undertime = (Math.abs(diff.hours()) +'.'+ Math.abs(diff.minutes()));
                        }

                    }
                }
            },

            computeDayTotal(){
                for(let c = 0; c < this.attendance.length; c++){
                    for(let d = 0; d < this.restDay.length; d++){
                        if(moment(this.attendance[c].date, 'YYYY-MM-DD').format('ddd')  === this.restDay[d]){
                            this.attendance[c].time_in = '';
                            this.attendance[c].time_out = '';
                            this.attendance[c].total = 'Rest Day';
                            this.attendance[c].total = 'Rest Day';
                            this.attendance[c].total = 'Rest Day';
                        }else{ 
                            if(this.attendance[c].time_out !== 'No time out' && this.attendance[c].time_in !== 'No time in'){
                                var time_in = moment.duration(this.attendance[c].time_in);
                                var time_out = moment.duration(this.attendance[c].time_out);
                                var diff = time_out.subtract(time_in);

                                this.attendance[c].total = (Math.abs(diff.hours()) +'.'+ Math.abs(diff.minutes()));
                            }
                        }
                    }
                }
            },

            computeNightTotal(){
                for(let c = 0; c < this.attendance.length; c++){
                    var p = c + 1;
                    if(p < this.attendance.length){
                        if(this.attendance[p].time_out !== 'No time out' && this.attendance[c].time_in !== 'No time in'){
                            var date_in = this.attendance[c].date +' '+ this.attendance[c].time_in;
                            var date_out = this.attendance[p].date +' '+ this.attendance[p].time_out; 

                            var diff = moment(date_in, 'YYYY-MM-DD HH:mm:ss').diff(moment(date_out, 'YYYY-MM-DD HH:mm:ss'));
                            var total = moment.duration(diff);

                            this.attendance[c].total = (Math.abs(total.hours()) +'.'+ Math.abs(total.minutes()));

                        }
                    }
                }
            },

            nightSched(){
                var y = 1;
                for(let x = 0; x < this.attendance.length; x++){
                    if(y < this.attendance.length){
                       /* if(moment(date, 'YYYY-MM-DD').format('ddd') === 'Mon'){
                            this.attendanceNight.push({
                                                        date: this.attendance[x].date +' to '+ this.attendance[y].date,
                                                        time_in: 'Rest Day',
                                                        time_out: this.attendance[y].time_out,
                                                        late: this.attendance[x].late,
                                                        undertime: this.attendance[y].undertime,
                                                        total: this.attendance[x].total
                                                    });
                        }else{  */ 
                            this.attendanceNight.push({
                                                        date: this.attendance[x].date +' to '+ this.attendance[y].date,
                                                        time_in: this.attendance[x].time_in,
                                                        time_out: this.attendance[y].time_out,
                                                        late: this.attendance[x].late,
                                                        undertime: this.attendance[y].undertime,
                                                        total: this.attendance[x].total
                                                    });
                        /*}*/
                    }
                    console.log(x +' '+ y); 
                    y = x + 2;
                }
                this.attendance = this.attendanceNight;
            },

            rangeDates(){
                var date_start = moment(this.sched.start_date).subtract(1, 'days');
                var date_end = moment(this.sched.end_date);

                var days = date_end.diff(date_start, 'days');

                for(let c = 0; c < days; c++){
                    var date = date_start.add(1, 'days').format('YYYY-MM-DD');
                    this.attendance.push({date: date, time_in: 'No time in', time_out: 'No time out'});
                }

            },


        }
    }
</script>
