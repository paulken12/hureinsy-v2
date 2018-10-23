<template>
    <div class="bd bgc-white">
        <!--<form method="POST" enctype="multipart/form-data">-->
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Import Raw Data</h5>

                        </div>
                    </div>
                </div>

                <div class="container-fluid bdT p-20">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file" @change="onChange" required>
                        <label class="custom-file-label" for="import_file">Choose file...</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="ti-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control bdc-grey-200 start-date" id="start_date" v-model="date_start"
                                           placeholder="Start Date" data-provide="datepicker"
                                           data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="ti-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control bdc-grey-200 end-date" id="end_date" v-model="date_end"
                                           placeholder="End Date" data-provide="datepicker"
                                           data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ta-r bdT w-100 p-20">
                <button  class="btn btn-info">Import</button>
            </div>
        <!--</form>-->
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                raw: [],
                date_start: '2018-04-01',
                date_end: '2018-04-05'
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

                let newArray =[];

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

                //console.log(arr);
                // console.log(this.raw);
                // console.log();

                // let arr = [];
                // this.raw.forEach(function (entry) {
                //     arr[entry['emp_id']][entry['date']][''] = entry['time'];
                // });
                //console.log(this.raw);
                let t1 = performance.now();
                console.log("tCall to doSomething ook " + (t1 - t0) + " milliseconds.");



            }
        }
    }
</script>


