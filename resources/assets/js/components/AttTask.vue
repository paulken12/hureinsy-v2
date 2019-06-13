<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="row p-0 m- w-100">
                    <div class="col bdT p-0">
                        <div class="layer w-100 fxg-1 p-30">
                            <label for="empSched-list"><small><strong>Att task to be done</strong></small></label>
                            <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th><small>Task</small></th>
                                        <th><small>Last date request</small></th>
                                        <th><small>Current date request</small></th>
                                        <th><small>Action</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(tbl, index) in table">
                                        <td>
                                            <span>There are <strong> {{tbl.length}} </strong> {{tbl[index].type}} request to be authorize/unauthorize</span></td>
                                        <td>{{tbl[0].date}}</td>
                                        <td>{{tbl[tbl.length - 1].date}}</td>
                                        <td><a :href="'/authorize/forms/'+ tbl[index].gt">Go...</a></td>
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
        props: ['cs', 'et', 'ob', 'ot', 'tv', 'employee'],

        data: function () {
            return {
                table: [],
                cstbl: [],
                ettbl: [],
                obtbl: [],
                ottbl: [],
                tvtbl: [],
            }
        },

        created: function () {
            this.cs.map((cst) => {
                this.cstbl.push({
                    gt: 'cs',
                    type: 'Temporary change of shift',
                    date: this.dateformat(cst.created_at),
                });
            });
            this.pushable(this.cstbl);

            this.et.map((ett) => {
                this.ettbl.push({
                    gt: 'et',
                    type: 'Early timeout',
                    date: this.dateformat(ett.created_at),
                });
            });
            this.pushable(this.ettbl);

            this.ob.map((obt, index) => {
                this.obtbl.push({
                    gt: 'ob',
                    type: 'Official business',
                    date: this.dateformat(obt.created_at),
                });
            });
            this.pushable(this.obtbl);

            this.ot.map((ott) => {
                this.ottbl.push({
                    gt: 'ot',
                    type: 'Overtime',
                    date: this.dateformat(ott.created_at),
                });
            });
            this.pushable(this.ottbl);

            this.tv.map((tvt) => {
                this.tvtbl.push({
                    gt: 'tv',
                    type: 'Time validation',
                    date: this.dateformat(tvt.created_at),
                });
            });
            this.pushable(this.tvtbl);
        },


        mounted: function () {
            $('#empSched-list').DataTable({
                iDisplayLength: 5,
                bLengthChange: false,
                bFilter: false,
                bPaginate: false,
                bInfo: false,
                language: {
                  emptyTable: "No task to be done as for now",
                }
            });
        },

        computed: {
        },

        methods: {
            dateformat(t){
                return moment(t, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            pushable(a){
                if(a.length > 0){
                    a.sort();
                    return this.table.push(a);
                }else{
                    return null;
                }
            },
        }
    }
</script>
