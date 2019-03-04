<template>
    <div>    
        <div class="bd bgc-white">
            <form action="/holiday/store" METHOD="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="layers">
                    <div class="layer w-100 p-20">
                        <div class="peers">
                            <div class="peer peer-greed">
                                <h5>Holidays</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row p-0 m- w-100">
                        <div class="col bdT p-0">
                            <div class="layer w-100 fxg-1 p-30">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h6>List of Holidays</h6>
                                            <div class="row">
                                                <div class="col">
                                                    <datepicker v-model="form.in_date"
                                                                :format="customFormatter"
                                                                :bootstrap-styling="true"
                                                                :calendar-button="true"
                                                                calendar-button-icon="ti-calendar"
                                                                value-type="format"
                                                                placeholder="Date"
                                                                style="color:black;"
                                                                @selected="date_check">
                                                    </datepicker>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('in_date')"
                                                           v-text="form.errors.get('in_date')"></small>
                                                </div>
                                            </div>
                                            <br>
                                            <input type="text" v-model="form.in_holiday_name" title="Holiday Name" class="form-control" @change="holi_check" placeholder="Holiday Name"/>
                                            <br>
                                            <button class="btn btn-primary btn-sm" :disabled="isDisabled">Add holiday</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6>List of Holidays</h6>
                                        <table id="att-list" class="table table-responsive" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th>Date</th>
                                                    <th>Holiday name</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(hol, index) in form.holiday_id">
                                                    <td>{{ form.date[index]}}</td>
                                                    <td>{{ form.holiday_name[index]}}</td>
                                                    <td align="center"><a class="btn btn-sm" @click="removeHoliday(index,hol)"><i class="ti-trash"></i></a></td>
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
    import Datepicker from 'vuejs-datepicker';

    export default {

        props: ['holiday'],
        components: {Datepicker},

        data: function () {
            return {

                csrf: '',

                fail: true,

                holi_troo: true,
                date_troo: true,

                form: new Form({
                    holiday_id:[],
                    holiday_name:[],
                    date: [],   
                    in_holiday_name: '',
                    in_date: '',
                    com_date: '',
                })

            }
        },


        created: function () {
            this.holiday.map((hol) => {
                this.form.holiday_id.push(hol.id);
                this.form.holiday_name.push(hol.name);
                this.form.date.push(moment(hol.date).format('MMMM Do'));
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
                for (let c = 0; this.form.holiday_id.length >= c; c++) {
                    if(this.form.date[c] === this.form.com_date){
                        return this.fail;
                    }
                }
                return !this.fail;
            },

            isDisabled(){
                return this.holi_troo || this.date_troo;
            }
        },

        methods: {

            clearput(){
                this.form.in_date = '';
                this.form.in_holiday_name = '';
            },

            deleteHoliday(hol) {
                this.form.delete('/holiday/delete/' + hol);
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Holiday Removed.").goAway(5000);
            },

            onSubmit() {
                this.form.in_date = moment(this.form.in_date).format('[0000]-MM-DD');
                this.form.com_date = moment(this.form.in_date).format('MMMM Do');
                this.form.post('/holiday/store')
                    .then(response => console.log('bump'))
                    .catch(error => this.form.errors.record(error.response.data.errors));        

                if(this.isDuplicate){
                    this.fail = true;
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "danger",
                    });
                    toast.text("Unable to add holiday.").goAway(5000);
                    this.clearput();
                }
                else{
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("Holiday added.").goAway(5000);
                    this.form.holiday_name.push(this.form.in_holiday_name);
                    this.form.date.push(moment(this.form.in_date).format('MMMM Do'));
                    this.form.holiday_id.push(this.form.holiday_id.length + 1);
                    this.clearput();
                }

                this.holi_troo = true;
                this.date_troo = true;

            },

            removeHoliday: function (index, hol) {  
                this.$delete(this.holiday, index);
                this.form.holiday_id.splice(index, 1);
                this.form.holiday_name.splice(index, 1);
                this.form.date.splice(index, 1);
                this.deleteHoliday(hol);
            },


            date_check(){
                this.date_troo = false;
            },

            holi_check(){
                if(this.form.in_holiday_name){
                    this.holi_troo = false;
                }else{
                    this.holi_troo = true;
                }
            },

            customFormatter(date){
                return moment(date).format('MMMM Do');
            }
        }
    }
</script>
