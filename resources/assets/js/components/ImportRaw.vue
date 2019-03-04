<template>
    <div class="bd bgc-white">
        <form action="/import/file" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Import Raw Data</h5>

                        </div>
                    </div>
                </div>

                <div class="container-fluid bdT p-20">
                    <small v-text="f_mes" v-bind:class="{'text-danger' : !troo}"></small>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file" @change="onChange" required>
                        <label class="custom-file-label" for="import_file" v-text="f_name"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <datepicker v-model="date_start" 
                                            name="date_start"
                                            :format="'yyyy-MM-dd'"
                                            :bootstrap-styling="true"
                                            :typeable="true"
                                            :calendar-button="true"
                                            calendar-button-icon="ti-calendar"
                                            v-mask="'####-##-##'"
                                            placeholder="Start Date">
                                </datepicker>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <datepicker v-model="date_end" 
                                            name="date_end"
                                            :format="'yyyy-MM-dd'"
                                            :bootstrap-styling="true"
                                            :typeable="true"
                                            :calendar-button="true"
                                            calendar-button-icon="ti-calendar"
                                            v-mask="'####-##-##'"
                                            placeholder="End Date">
                                </datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ta-r bdT w-100 p-20">
                <button class="btn btn-info" :disabled="!troo">Import</button>
            </div>
        </form>
    </div>
</template>

<script>

    import Datepicker from 'vuejs-datepicker';

    export default {

        components: {Datepicker},

        data: function(){
            return{
                troo: true,
                csrf: '',
                raw: [],
                date_start: new Date().toISOString().slice(0, 10),
                date_end: new Date().toISOString().slice(0, 10),
                f_name: 'Choose file...',
                f_mes: 'Upload only the log file (.dat) with less 2MB file size',
                f_mes1: 'Upload only the log file (.dat) with less 2MB file size',
                f_err1: 'Max file size is up to 2MB only',
                f_err2: 'Upload only .dat file extension',
                // date_start: moment().format('YYYY-MM-DD'),
                // date_end: moment().subtract(5, "days").format('YYYY-MM-DD')
            }
        },
        mounted: function(){

            let toast = this.$toasted.show("Toasted !!", {
                theme: "bubble",
                position: "bottom-right",
                type : "success",
            });

            toast.text("Changing the text !!!").goAway(5000);

            $("#start_date").datepicker().on(
                "changeDate", () => {this.date_start = $('#start_date').val()}
            );
            $("#end_date").datepicker().on(
                "changeDate", () => {this.date_end = $('#end_date').val()}
            );
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        },
        methods: {
            isset(variable){
                if(typeof(variable) !== "undefined" && variable !== null)
                {
                    return variable;
                }

                return 'oink';
            },
            onChange(e) {
                let t0 = performance.now();

                if (! e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();
                let arr= [];

                this.f_name = file.name;
                    console.log(file.mozFullPath);

                if(file.size < 2000000 && file.name.split('.').pop() === "dat"){
                    this.f_mes = this.f_mes1;
                    this.troo = true;
                }else if(file.name.split('.').pop() != "dat"){
                    this.f_mes = this.f_err2;
                    this.troo = false;
                }else{
                    this.f_mes = this.f_err1;
                    this.troo = false;
                }


/*                let newArray =[];

                reader.readAsText(file);

                reader.onload = e => {
                    let src = e.target.result;

                    let lines = src.split('\n');
                    for(let line = 0; line < lines.length; line++){
                        let raw_data = lines[line].replace(/\s+/g,".").trim().split('.');

                        let dat = new Date(raw_data[2]);
                        let start = new Date(this.date_start);
                        let end = new Date(this.date_end);

                        this.raw.push({
                            id:raw_data[1],
                            dd:raw_data[2],
                            time:raw_data[3]
                        })

                        // if(dat >= start && dat <= end){
                        //     this.raw.push({
                        //         id:raw_data[1],
                        //         dd:raw_data[2],
                        //         time:raw_data[3]
                        //     })
                        // }
                    }

                    // this.raw.forEach(function (entry) {
                    //     if (arr[entry['id']] === undefined) {
                    //         arr[entry['id']] = {}
                    //     }
                    //     arr[entry['id']][entry['date']] = entry['time'];
                    // });


                    for(let i=0; i<this.raw.length; i++)
                    {
                        let id = this.raw[i].id;
                        let d = this.raw[i].dd;
                        let t = this.raw[i].time;

                        if (arr[id] === undefined) {
                            arr[id] = {}
                        }
                        arr[id][d] = this.raw[i].time;

                        // arr = new function () {
                        //     this[id] = {
                        //         [d]: t
                        //     };
                        // };
                    }

                    console.log(arr);

                };

                console.log(arr);
                console.log(this.raw);
                console.log();

                //let arr = [];
                this.raw.forEach(function (entry) {
                    arr[entry['emp_id']][entry['date']][''] = entry['time'];
                });
                console.log(this.raw);

                let t1 = performance.now();
                console.log("tCall to doSomething ook " + (t1 - t0) + " milliseconds.");*/

            }
        }
    }
    

</script>


