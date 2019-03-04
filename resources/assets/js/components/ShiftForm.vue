<template>
    <div>    
        <div class="bd bgc-white">
            <form action="/shift/store" METHOD="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="layers">
                    <div class="layer w-100 p-20">
                        <div class="peers">
                            <div class="peer peer-greed">
                                <h5>Shifts</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row p-0 m- w-100">
                        <div class="col bdT p-0">
                            <div class="layer w-100 fxg-1 p-30">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h6>Add shifts</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <date-picker 
                                                                v-model="form.in_in" 
                                                                lang="en" type="time" 
                                                                format="HH:mm" 
                                                                placeholder="Time in"
                                                                @change="check_in"
                                                                confirm>
                                                    </date-picker>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('in_in')"
                                                           v-text="form.errors.get('in_in')"></small>
                                                </div>
                                                <div class="col-6">
                                                    <date-picker 
                                                                v-model="form.in_out" 
                                                                lang="en" type="time" 
                                                                format="HH:mm" 
                                                                placeholder="Time out"
                                                                @change="check_in" 
                                                                confirm>
                                                    </date-picker>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('in_out')"
                                                           v-text="form.errors.get('in_out')"></small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" v-model="form.in_name" title="Shift Name" class="form-control" @change="check_in" placeholder="Shift Name"/>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('in_name')"
                                                           v-text="form.errors.get('in_name')"></small>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary btn-sm" :disabled="isDisabled">Add shift</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6>List of available shifts</h6>
                                        <table id="att-list" class="table table-responsive" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th>Shift name</th>
                                                    <th>Time in</th>
                                                    <th>Time out</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(shi, index) in form.shift_id">
                                                    <td>{{ form.shift_name[index]}}</td>
                                                    <td>{{ form.shift_in[index]}}</td>
                                                    <td>{{ form.shift_out[index]}}</td>
                                                    <td align="center"><a class="btn btn-sm" @click="removeShift(index,shi)"><i class="ti-trash"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
    import DatePicker from 'vue2-datepicker';

    export default {

        props: ['shift'],
        components: {'date-picker': DatePicker},

        data: function () {
            return {

                csrf: '',

                fail: true,

                mes1: '',

                name_troo: true,
                time_in_troo: true,
                time_out_troo: true,

                form: new Form({
                    shift_id:[],
                    shift_name:[],
                    shift_in:[],
                    shift_out:[],
                    in_name: '',
                    in_in: '',
                    in_out: '',
                }),
            }
        },


        created: function () {
            this.shift.map((shi) => {
                this.form.shift_id.push(shi.id);
                this.form.shift_name.push(shi.display_name);
                this.form.shift_in.push(shi.time_in);
                this.form.shift_out.push(shi.time_out);
            });
        },

        mounted: function () {

            $('#att-list').DataTable({
                bFilter : false,               
                bLengthChange: false,
                paging: false,
                info: false,
                ordering: false,
                language: {
                    emptyTable: " "
                },
            });
            
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        },

        computed: {
            isDuplicate(){
                for (let c = 0; this.form.shift_id.length >= c; c++) {
                    if(this.form.shift_name[c] === this.form.in_name){
                        return this.fail;
                    }
                }
                return !this.fail;
            },

            isDisabled(){
                return this.name_troo || this.time_in_troo || this.time_out_troo;
            }
        },

        methods: {

            clearput(){
                this.form.in_name = '';
                this.form.in_in = '';
                this.form.in_out = '';
            },

            deleteShift(shi) {
                this.form.delete('/shift/delete/' + shi);
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Holiday Removed.").goAway(5000);
            },

            onSubmit() {
                this.form.in_out = moment(this.form.in_out).format('HH:mm');
                this.form.in_in = moment(this.form.in_in).format('HH:mm');
                this.form.post('/shift/store')
                    .then(response => console.log('bump'))
                    .catch(error => this.form.errors.record(error.response.data.errors));    

                if(this.isDuplicate){
                    this.fail = true;
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "danger",
                    });
                    toast.text("Unable to add shifts.").goAway(5000);
                    this.clearput();
                }
                else{
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Shifts added.").goAway(5000);
                    this.form.shift_id.push(this.form.shift_id.length + 1);
                    this.form.shift_name.push(this.form.in_name);
                    this.form.shift_in.push(this.form.in_in);
                    this.form.shift_out.push(this.form.in_out);
                    this.clearput();
                }

                this.name_troo = true;
                this.time_in_troo = true;
                this.time_out_troo = true;

            },

            removeShift(index, shi) {
                this.form.shift_id.splice(index, 1);
                this.form.shift_name.splice(index, 1);
                this.form.shift_in.splice(index, 1);
                this.form.shift_out.splice(index, 1);
                this.deleteShift(shi);
            },

            check_in(){
                if(this.form.in_name){
                    this.name_troo = false;
                }else{
                    this.name_troo = true;
                }
                if(this.form.in_in){
                    this.time_in_troo = false;
                }else{
                    this.time_in_troo = true;
                }               
                if(this.form.in_out){
                    this.time_out_troo = false;
                }else{
                    this.time_out_troo = true;
                }   
            },

        }
    }
</script>
