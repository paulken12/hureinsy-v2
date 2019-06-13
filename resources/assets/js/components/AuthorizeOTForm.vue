<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Over Time requests</h5>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table table-striped table-gray" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Name</small></th>
                            <th><small>Date</small></th>
                            <th><small>OT type</small></th>
                            <th><small>Regular Shift time</small></th>
                            <th><small>Status</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ot, index) in OT">
                            <td>{{OT[index].name}}</td>
                            <td>{{OT[index].date}}</td>
                            <td>{{OT[index].type}}</td>
                            <td>{{OT[index].regular_time}}</td>
                            <td>{{OT[index].status}}</td>
                            <td><button class="btn btn-link" data-toggle="modal" @click="openModal(ot, index)" data-target="#Info">more...</button></td>
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
                        <h5 class="modal-title" id="OT">Requested OT by {{imodal.name}}</h5>
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
                                <small class="text-primary">OT start</small>
                                <p>{{imodal.ot_start}}</p>
                            </div>
                            <div class="col">
                                <small class="text-primary">OT end</small>
                                <p>{{imodal.ot_end}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <small class="text-primary">OT type</small>
                                <p>{{imodal.type}}</p>
                            </div>
                            <div class="col">
                                <small class="text-primary">Regular shift time</small>
                                <p>{{imodal.regular_time}}</p>
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

                OT: [],
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
                        this.OT.push({
                            id: lis.id,
                            date: this.dateformat(lis.date),
                            name: emp.last_name +', '+ emp.first_name,
                            ot_start: this.timeformat(lis.ot_start),
                            ot_end: this.timeformat(lis.ot_end),
                            type: lis.type,
                            regular_time: lis.regular_time,
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
            openModal(ot, index){
                this.imodal = this.OT[index];
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
                    for(let x = 0; x < this.OT.length; x++){
                        if(this.OT[x].id == index){
                            if(flag == 1){
                                this.form.oth = flag;
                                this.OT[x].status = "Authorized";
                                break;
                            }else{
                                this.form.oth = flag;
                                this.OT[x].status = "Unauthorized";
                                break;
                            }
                        }
                    }
                    this.form.patch('/authorize/forms/ot/' + index);
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
