<template>
    <div class="bd bgc-white">
        <form action="/att/import" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5 class="lh-1">Import Data from Att</h5>

                        </div>
                    </div>
                </div>

                <div class="container-fluid bdT p-20">
                    <small v-text="f_mes" v-bind:class="{'text-danger' : err}"></small>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file" @change="onChange" required>
                        <label class="custom-file-label" for="import_file" v-text="f_name"></label>
                    </div>
                </div>
            </div>
            <div class="ta-r bdT w-100 p-20">
                <button class="btn btn-info" v-show="troo">Import</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        data: function(){
            return{
                err: false,
                troo: false,
                csrf: '',
                f_name: 'Choose file...',
                f_mes: 'Upload only the file (.xls/xlsx) with less 2MB file size',
                f_mes1: 'Upload only the log (.xls/xlsx) with less 2MB file size',
                f_err1: 'Max file size is up to 2MB only',
                f_err2: 'Upload only with .xls/xlsx file extension',
            }
        },
        mounted: function(){
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },
        methods: {
            onChange(e) {
                let t0 = performance.now();

                if (! e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();
                let arr= [];

                this.f_name = file.name;
                    console.log(file.mozFullPath);

                if(file.size < 2000000 && file.name.split('.').pop() === "xls" || file.name.split('.').pop() === "xlsx"){
                    this.f_mes = this.f_mes1;
                    this.troo = true;
                    this.err = false;
                }else if(file.name.split('.').pop() != "xls" || file.name.split('.').pop() != "xlsx"){
                    this.f_mes = this.f_err2;
                    this.troo = false;
                    this.err = true;
                }else{
                    this.f_mes = this.f_err1;
                    this.troo = false;
                    this.err = true;
                }
            }
        }
    }
    

</script>


