<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="row p-0 m- w-100">
                    <div class="col bdT p-0">
                        <div class="layer w-100 fxg-1 p-30">
                            <label><strong>Your DTR</strong></label>
                            <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th><small>Date</small></th>
                                        <th><small>Time table</small></th>
                                        <th><small>Shift time in</small></th>
                                        <th><small>Time in</small></th>
                                        <th><small>Shift time out</small></th>
                                        <th><small>Time out</small></th>
                                        <th><small>Total Hours</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(tbl, index) in table">
                                        <td><small>{{tbl.date}}</small></td>
                                        <td><small>{{tbl.time_table}}</small></td>
                                        <td><small>{{tbl.required_time_in}}</small></td>
                                        <td><small :class="{'text-danger': tbl.late}">{{tbl.time_in}}</small></td>
                                        <td><small>{{tbl.required_time_out}}</small></td>
                                        <td><small :class="{'text-danger': tbl.undertime}">{{tbl.time_out}}</small></td>
                                        <td><small>{{tbl.total_hours}}</small></td>
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
        props: ['dtr'],

        data: function () {
            return {
                isActive: true,
                table: [],
            }
        },

        created: function () {
            this.dtr.map((dtrl) => {
                this.table.push({
                    id: dtrl.dtr_id,
                    date: this.dateformat(dtrl.date),
                    time_table: dtrl.time_table,
                    required_time_in: this.timeformat(dtrl.required_time_in),
                    time_in: this.timeformat(dtrl.time_in),
                    late: this.ifLate(dtrl.is_late),
                    required_time_out: this.timeformat(dtrl.required_time_out),
                    time_out: this.timeformat(dtrl.time_out),
                    undertime: this.ifUndertime(dtrl.is_under_time),
                    total_hours: dtrl.total_hours,
                });
            });
        },

        mounted: function () {
            $('#empSched-list').DataTable({
                iDisplayLength: 5,
                bLengthChange: false,
            });
        },

        computed: {
        },

        methods: {
            timeformat(t){
                if(t){
                    return moment(t, 'HH:mm').format('hh:mma');
                }else{
                    return 'No time in/out';
                }
            },
            dateformat(t){
                return moment(t, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            ifLate(t){
                if(t == '1'){
                    return true;
                }else{
                    return false;
                }
            },

            ifUndertime(t){
                if(t == '1'){
                    return true;
                }else{
                    return false;
                }
            },
        }
    }
</script>
