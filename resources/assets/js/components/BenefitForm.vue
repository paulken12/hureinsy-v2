<template>
  <div>
    <div class="peers ai-c jc-sb">
      <div class="peers peer-greed">
        <div class="peer">
          <h4>Benefit </h4>
        </div>
      </div>

      <!--<div v-if="own">-->
      <div class="peer">
        <span><a href="#" title="Edit/Close" class="btn btn-link" v-on:click="edit = !edit"><i class="mR-10 ti-pencil-alt"></i></a></span>
      </div>
      <!--</div>-->
    </div>
    
    <hr>

    <div v-if="edit">
      <div class="form-row">
        <div class="col-sm">
          <div class="form-group">
            <label for="ben_sss" class="sr-only">SSS no.</label>
            <input type="text"
                   id="ben_sss"
                   v-model="form.ben_sss"
                   class="form-control"
                   v-mask="'##-#######-#'"
                   title="SSS no."
                   placeholder="SSS no.">
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label for="ben_pagibig" class="sr-only">Pagibig no.</label>
            <input type="text"
                   id="ben_pagibig"
                   v-model="form.ben_pagibig" 
                   class="form-control"
                   v-mask="'##-#########-#'"
                   title="Pagibig no."
                   placeholder="Pagibig no.">
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label for="ben_philhealth" class="sr-only">Philhealth no.</label>
            <input type="text"
                   id="ben_philhealth"
                   v-model="form.ben_philhealth"
                   class="form-control"
                   v-mask="'####-####-####'"
                   title="Philhealth no."
                   placeholder="Philhealth no.">
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label for="ben_tin" class="sr-only">Tin no.</label>
            <input type="text"
                   id="ben_tin"
                   v-model="form.ben_tin"
                   class="form-control"
                   v-mask="'###-###-###'"
                   title="Tin no."
                   placeholder="Tin no.">
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-sm">
          <div class="form-group">
            <label for="ben_payroll" class="sr-only">Payroll no.</label>
            <input type="text"
                   id="ben_payroll"
                   v-model="form.ben_payroll"
                   class="form-control"
                   v-mask="'############'"
                   title="Payroll no."
                   placeholder="Payroll no.">
          </div>
        </div>
      </div>
      <button class="btn btn-success btn-sm" @click="updateBenefit">Update</button>
      <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
    </div>
      <div v-else>
        <small>SSS No. |</small> <span class="c-grey-900" v-text="form.ben_sss"></span><br>
        <small>Pagibig No. |</small> <span class="c-grey-900" v-text="form.ben_pagibig"></span><br>
        <small>Philhealth No. |</small> <span class="c-grey-900" v-text="form.ben_philhealth"></span><br>
        <small>Tin No. |</small> <span class="c-grey-900" v-text="form.ben_tin"></span><br>
        <small>Payroll No. |</small> <span class="c-grey-900" v-text="form.ben_payroll"></span><br>
    </div>
  </div>
</template>


<script>

    export default {

        props: ['profile','owner','benefit'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

               form: new Form({
                   ben_sss: '',
                   ben_pagibig: '',
                   ben_philhealth: '',
                   ben_tin: '',
                   ben_payroll: '',
               })

            }
        },

        created: function () {
             this.ben();
        },

        methods: {
            updateBenefit(){
                this.form.patch('/profile/' + this.profile.slug +'/benefit');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Contact information updated.").goAway(5000);
            },
            ben() {
                this.benefit.map((ben) => {
                    this.form.ben_sss = ben.sss_num;
                    this.form.ben_pagibig = ben.pagibig_num;
                    this.form.ben_philhealth = ben.philhealth_num;
                    this.form.ben_tin = ben.tin_num;
                    this.form.ben_payroll = ben.payroll_account;
                });
            },
        }
    }
</script>