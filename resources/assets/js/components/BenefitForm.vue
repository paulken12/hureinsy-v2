<template>
    <!--<div>-->
        <!--<div class="form-row">-->
            <!--<div class="col-sm">-->
                <!--<div class="form-group">-->
                    <!--<label class="sr-only" for="ben_sss">SSS NO.</label>-->
                    <!--<input type="text"-->
                           <!--v-model="ben_sss"-->
                           <!--v-mask="'####-###-####'"-->
                           <!--id="ben_sss"-->
                           <!--class="form-control"-->
                           <!--title="SSS NO."-->
                           <!--placeholder="SSS NO.">-->
                <!--</div>-->


            <!--</div>-->
            <!--<div class="col-sm">-->
                <!--<div class="form-group">-->
                    <!--<label class="sr-only" for="ben_pag_ibig">PAGIBIG</label>-->
                    <!--<input type="text"-->
                           <!--v-model="ben_pag_ibig"-->
                           <!--v-mask="'####-####-####'"-->
                           <!--id="ben_pag_ibig"-->
                           <!--class="form-control"-->
                           <!--title="PAGIBIG"-->
                           <!--placeholder="PAGIBIG">-->
                <!--</div>-->


            <!--</div>-->
            <!--<div class="col-sm">-->
                <!--<div class="form-group">-->
                    <!--<label class="sr-only" for="ben_philhealth">PHILHEALTH</label>-->
                    <!--<input type="text"-->
                           <!--v-model="ben_philhealth"-->
                           <!--id="ben_philhealth"-->
                           <!--class="form-control"-->
                           <!--title="PHILHEALTH" placeholder="PHILHEALTH">-->
                <!--</div>-->




            <!--</div>-->
            <!--<div class="col-sm">-->
                <!--<div class="form-group">-->
                    <!--<label class="sr-only" for="ben_tin">TIN</label>-->
                    <!--<input type="text"-->
                           <!--v-model="ben_tin"-->
                           <!--id="ben_tin"-->
                           <!--class="form-control"-->
                           <!--title="TIN"-->
                           <!--placeholder="TIN">-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <!--<hr>-->

        <!--<div class="form-row">-->
            <!--<div class="col-sm-12">-->
                <!--<div class="form-group">-->
                    <!--<label class="sr-only" for="payroll_account">Payroll Account</label>-->
                    <!--<input type="text"-->
                           <!--id="payroll_account"-->
                           <!--name="payroll_account"-->
                           <!--class="form-control"-->
                           <!--v-model="payroll_account"-->

                           <!--title="Payroll Account"-->
                           <!--placeholder="Payroll Account">-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->

    <div>
        <div class="form-group">
            <label for="test" class="sr-only">Test</label>
            <input type="text" id="test" class="form-control" v-model="test" title="" placeholder="">
        </div>


    </div>
</template>


<script>

    import Form from "../utilities/Form";

    export default {

        data: function() {
            return {
                test:'',
                ben_sss: '',
                ben_pag_ibig: '',
                ben_philhealth: '',
                ben_tin: '',
                payroll_account: '',
            }
        },
    }
</script>