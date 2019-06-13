<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Early Timeout requests</h5>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Name</small></th>
                            <th><small>Date</small></th>
                            <th><small>Shift time out</small></th>
                            <th><small>New time out</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(et, index) in ET">
                            <td>{{ET[index].name}}</td>
                            <td>{{ET[index].date}}</td>
                            <td>{{ET[index].time_out}}</td>
                            <td>{{ET[index].new_time_out}}</td>
                            <td>{{ET[index].status}}</td>
                            <td><button class="btn btn-link" data-toggle="modal" @click="openModal(et, index)" data-target="#Info">more...</button></td>
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
                        <h5 class="modal-title" id="ET">Requested Early Timeout by {{imodal.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <small class="text-primary">Date</small>
                                <p>{{imodal.date}}</p>
                            </div>
                            <div class="col">
                                <small class="text-primary">Shift time out</small>
                                <p>{{imodal.time_out}}</p>
                            </div>
                            <div class="col">
                                <small class="text-primary">New time out</small>
                                <p>{{imodal.new_time_out}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <small class="text-primary">Reason</small>
                                <p>{{imodal.reason}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="remarks" class="form-control"
                                       v-model="form.remarks"
                                       title="Remarks" placeholder="Supervisor remarks">
                                <small v-text="err_msg" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div v-if="imodal.status == 'For authorization'"class="modal-footer">
                        <button type="submit" @click="submit(imodal.id, 0)" class="btn btn-danger">Unauthorize</button>
                        <button type="submit" @click="submit(imodal.id, 1)" class="btn btn-primary">Authorize</button>
                    </div>
                    <div v-else class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-primary">close</button>
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
                csrf: '',

                ET: [],
                imodal: {},
                err_msg: '',
                form: new Form({
                    oth: '',
                    remarks: '',
                })
            }
        },

        created: function () {
            this.list.map((lis) => {
                this.employees.map((emp) => {
                    if(lis.employee_id == emp.id){
                        this.ET.push({
                            id: lis.id,
                            date: this.dateformat(lis.date),
                            name: emp.last_name +', '+ emp.first_name,
                            time_out: this.timeformat(lis.time_out),
                            new_time_out: this.timeformat(lis.new_time_out),
                            reason: lis.reason,
                            status: lis.status,
                            remarks: lis.remarks,
                        });
                    }
                });
            });
        },

        mounted: function () {
            this.DTB = $('#empSched-list').DataTable({
                iDisplayLength: 4,
                aLengthMenu: [],
            });
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },

        methods: {
            openModal(et, index){
                this.imodal = this.ET[index];
            },

            timeformat(t){
                return moment(t, 'HH:mm:ss').format('hh:mma');
            },

            dateformat(d){
                return moment(d, 'YYYY-MM-DD').format('MMMM Do, YYYY');
            },

            submit(index, flag){
                if(this.form.remarks){
                    $("#Info").modal('hide');
                    this.err_msg = "";
                    for(let x = 0; x < this.ET.length; x++){
                        if(this.ET[x].id == index){
                            if(flag == 1){
                                this.form.oth = flag;
                                this.ET[x].status = "Authorized";
                                break;
                            }else{
                                this.form.oth = flag;
                                this.ET[x].status = "Unauthorized";
                                break;
                            }
                        }
                    }
                    this.form.patch('/authorize/forms/et/' + index);
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Status updated.").goAway(5000);
                    this.form.remarks = "";
                }else{
                    this.err_msg = "Remarks is required.";
                }

            },
        }
    }
</script>
