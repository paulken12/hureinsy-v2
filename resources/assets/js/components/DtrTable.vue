<template>
    <div>
        <div class="full-container">
            <div class="remain-height pos-r scrollable">
                <div class="bgc-white bdrs-3">
                    <!-- <form action="/register/confirmed" METHOD="POST" @submit.prevent="onSubmit" enctype="multipart/form-data"> -->
                        <table id="dtr-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-primary">
                                    <th class="text-center">Company ID</th>
                                    <th>Date</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="text-primary">
                                    <th class="text-center">Company ID</th>
                                    <th>Date</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(attendance, index) in dtr">
                                    <th class="text-center">
                                        <input type="hidden" id="emp_id" v-model="form.emp_id[index]" :readonly="true" class="form-control">
                                        <p v-text="form.emp_id[index]"></p>
                                    </th>
                                    <td>
                                        <input type="hidden" id="date" v-model="form.date[index]" :readonly="true" class="form-control">
                                        <p v-text="form.date[index]"></p>
                                    </td>
                                    <td>
                                        <input type="hidden" id="time_in" v-model="form.time_in[index]" :readonly="true" class="form-control">
                                        <p v-if="form.time_in[index]" v-text="form.time_in[index]"></p>
                                        <p v-else>00:00:00</p>
                                    </td>
                                    <td>
                                        <input type="hidden" id="time_out" v-model="form.time_out[index]" :readonly="true" class="form-control">
                                        <p v-if="form.time_out[index]" v-text="form.time_out[index]"></p>
                                        <p v-else>00:00:00</p>
                                    </td>               
                                </tr>
                            </tbody>
                        </table>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import 'datatables.net-buttons/js/buttons.colVis.min.js';
import 'datatables.net-buttons/js/buttons.html5.min.js';
import 'datatables.net-buttons/js/buttons.print.min.js';

    export default {

        props: ['dtr'],

        data: function () {
            return {

                form: new Form({
                    emp_id:[],
                    date: [],
                    time_in: [],
                    time_out: [],
                })

            }
        },

        mounted: function () {
            $('#dtr-table').DataTable({
                dom: 'BlTfgtip',
                buttons: [
                    {extend:'print', attr: {title: 'Print', id: 'PrintButton'}, className: 'btn btn-primary'},
                    {extend:'copyHtml5', attr: {title: 'Copy', id: 'CopyButton'}, className: 'btn btn-primary'}, 
                    {extend:'csvHtml5', attr: {title: 'Csv', id: 'CsvButton'}, className: 'btn btn-primary'},
                ],
            });

        },

        created: function () {
            this.dtr.map((attendance) => {
                this.form.emp_id.push(attendance.emp_basic_id);
                this.form.date.push(attendance.date);
                this.form.time_in.push(attendance.time_in);
                this.form.time_out.push(attendance.time_out);
            });
        },


        /*methods: {

            onChange() {
                this.submitted = true;
                this.form.post('/register/confirmed');
            },

            deleteFamily(fam) {
                this.form.delete('/profile/family/' + fam);
                    // .then(response => {
                    //     this.work_exp = response.data;
                    // });
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Family Information deleted.").goAway(5000);
            },

            addFamily() {
                this.form.family_id.push('');
                this.form.family_type.push('Sibling');
                this.form.master_family_key.push('sib');
                this.form.fam_last_name.push('');
                this.form.fam_first_name.push('');
                this.form.fam_date_of_birth.push('');
                this.form.fam_occupation.push('');
                this.form.fam_employer.push('');
                this.form.gender_type.push('Male');
                this.form.master_gender_key.push('m');
            },

            removeFamily: function (index, fam) {
                this.form.family_id.splice(index, 1);
                this.form.family_type.splice(index, 1);
                this.form.master_family_key.splice(index, 1);
                this.form.fam_last_name.splice(index, 1);
                this.form.fam_first_name.splice(index, 1);
                this.form.fam_date_of_birth.splice(index, 1);
                this.form.fam_occupation.splice(index, 1);
                this.form.fam_employer.splice(index, 1);
                this.form.gender_type.splice(index, 1);
                this.form.master_gender_key.splice(index, 1);

                if (fam !== '') {
                    this.deleteFamily(fam);
                }
            },
        }*/
    }
</script>
