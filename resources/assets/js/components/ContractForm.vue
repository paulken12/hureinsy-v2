<template>
    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Contract</h4>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm">
                <small>Employment Status |</small> <span class="c-grey-900" v-text="form.emp_status"></span><br>
                <small>Job Title |</small> <span class="c-grey-900" v-text="form.emp_jobtitle"></span><br>
                <small>Job Description |</small> <span class="c-grey-900" v-text="form.emp_jobdesc"></span><br>
                <small>Department |</small> <span class="c-grey-900" v-text="form.emp_dept"></span><br>
                <small>Team |</small> <span class="c-grey-900" v-text="form.emp_team"></span><br>
                <small>Work Location |</small> <span class="c-grey-900" v-text="form.emp_workloc"></span><br>
            </div>

            <div class="col-sm-5">
                <small>Contract Start |</small> <span class="c-grey-900" v-text="form.emp_constart"></span><br>
                <small>Contract End |</small> <span class="c-grey-900" v-text="form.emp_conend"></span><br>
                <small>Resigned Date |</small> <span class="c-grey-900" v-text="form.emp_resdate"></span><br>
                <small>Annex A Date Effective |</small> <span class="c-grey-900" v-text="form.emp_aeffect"></span><br>
                <small>Annex B Date Effective |</small> <span class="c-grey-900" v-text="form.emp_beffect"></span><br>
                <small>Annex C Date Effective |</small> <span class="c-grey-900" v-text="form.emp_ceffect"></span><br>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm">
                <small>Project Assignment |</small> <span class="c-grey-900" v-text="form.emp_projass"></span><br>
                <small>Project Customer |</small> <span class="c-grey-900" v-text="form.emp_projcust"></span><br>
                <small>Duration |</small> <span class="c-grey-900" v-text="form.emp_projstart"></span><br>
                <small>Company/Client |</small> <span class="c-grey-900" v-text="form.emp_projclient"></span><br>
                <small>Location |</small> <span class="c-grey-900" v-text="form.emp_projloc"></span><br>
            </div>

            <div class="col-sm-5">
                <small>Job Grade |</small> <span class="c-grey-900" v-text="form.emp_jobgrade"></span><br>
                <small>Probationary Rate |</small> <span class="c-grey-900" v-text="form.emp_probirate"></span><br>
                <small>Gross Salary |</small> <span class="c-grey-900" v-text="form.emp_grossrate"></span><br>
                <small>Basic Salary |</small> <span class="c-grey-900" v-text="form.emp_basicrate"></span><br>
                <small>Other Allowance |</small> <span class="c-grey-900" v-text="form.emp_otherall"></span><br>
                <small>Other Benefits |</small> <span class="c-grey-900" v-text="form.emp_otherben"></span><br>
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        props: ['contract', 'annex_a', 'annex_b', 'annex_c', 'job', 'dept', 'proj', 'reportto', 'team', 'workloc', 'projloc'],

        data: function () {
            return {

                edit: false,

                form : new Form({
                    emp_status: this.contract.employment_status,
                    emp_reportto: '',
                    emp_constart: this.contract.contract_start,
                    emp_conend: this.contract.contract_end,
                    emp_resdate: this.contract.resigned_date,
                    
                    emp_jobtitle: this.job.job_title,
                    emp_jobdesc: this.job.job_description,
                    emp_dept: this.dept.department,
                    emp_teamcon: this.team.sub_con,
                    emp_team: '',
                    emp_projass: '',
                    emp_projclient: '',
                    emp_projcust: '',
                    emp_projloc: '',
                    emp_projstart: '',
                    emp_projend: '',
                    emp_aeffect: '',
                    
                    emp_workloc: '',
                    emp_sched: '',
                    emp_beffect: '',
                    
                    emp_jobgrade: '',
                    emp_probirate: '',
                    emp_grossrate: '',
                    emp_basicrate: '',
                    emp_otherall: '',
                    emp_otherben: '',
                    emp_ceffect: '',

                })
            }
        },

        methods: {
            updateContact(){
                this.form.patch('/profile/' + this.profile.slug +'/contact');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Contract updated.").goAway(5000);
            },
        }
    }
</script>
