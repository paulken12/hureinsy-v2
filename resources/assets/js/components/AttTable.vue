<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="row p-0 m- w-100">
                    <div class="col bdT p-0">
                        <div class="layer w-100 fxg-1 p-30">
                            <label for="empSched-list"><small><strong>Att upload data result</strong></small></label>
                            <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th><small>Date</small></th>
                                        <th><small>Employee</small></th>
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
                                        <td><small>{{tbl.emp_name}}</small></td>
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
        props: ['list', 'employees'],

        data: function () {
            return {
                isActive: true,
                table: [],
            }
        },

        created: function () {
            this.list.map((dtr) => {
                this.employees.map((emp) => {
                    if(dtr.emp_basic_id == emp.id){
                        this.table.push({
                            id: dtr.dtr_id,
                            emp_name: emp.last_name +', '+ emp.first_name,
                            date: this.dateformat(dtr.date),
                            time_table: dtr.time_table,
                            required_time_in: this.timeformat(dtr.required_time_in),
                            time_in: this.timeformat(dtr.time_in),
                            late: this.ifLate(dtr.is_late),
                            required_time_out: this.timeformat(dtr.required_time_out),
                            time_out: this.timeformat(dtr.time_out),
                            undertime: this.ifUndertime(dtr.is_under_time),
                            total_hours: dtr.total_hours,
                        });
                    }
                });
            });
        },

        mounted: function () {
            $('#empSched-list').DataTable({
                iDisplayLength: 5,
                bLengthChange: false,
            });

            let toast = this.$toasted.show("Toasted !!", {
                theme: "bubble",
                position: "top-left",
                type : "success",
            });

            toast.text("Import Success").goAway(5000);

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
