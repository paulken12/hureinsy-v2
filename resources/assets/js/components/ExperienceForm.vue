<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Work Experience</h4>
                </div>
            </div>

            <!--<div v-if="own">-->
                <div class="peer">
                <span><a href="#" title="Edit/Close" class="btn btn-link" v-on:click="edit = !edit"><i
                        class="mR-10 ti-pencil-alt"></i></a></span>
                </div>
            <!--</div>-->
        </div>
        <hr>

        <div v-if="edit">

            <div class="container-fluid p-0 m-0" v-for="(exp,index) in form.exp_id">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-row">
                            <span v-text="exp" hidden></span>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exp_position" class="sr-only">Job
                                        title</label>
                                    <input type="text" id="exp_position"
                                           class="form-control"
                                           v-model="form.exp_position[index]"
                                           title="Job title"
                                           placeholder="Job title">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exp_company_name" class="sr-only">Company
                                        name</label>
                                    <input type="text" id="exp_company_name"
                                           class="form-control"
                                           v-model="form.exp_company_name[index]"
                                           title="Company name" placeholder="Company name">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exp_company_address" class="sr-only">Company
                                        address</label>
                                    <input type="text" id="exp_company_address"
                                           class="form-control"
                                           v-model="form.exp_company_address[index]"
                                           title="Company address"
                                           placeholder="Company address">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exp_industry"
                                           class="sr-only">Industry</label>
                                    <input type="text" id="exp_industry"
                                           class="form-control"
                                           v-model="form.exp_industry[index]"
                                           title="Industry"
                                           placeholder="Industry">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exp_salary" class="sr-only">Salary</label>
                                    <input type="text" id="exp_salary" class="form-control"
                                           v-model="form.exp_salary[index]" title="Salary"
                                           placeholder="Salary">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="responsibilities" class="sr-only">Responsibilities</label>
                                    <input type="text" id="responsibilities"
                                           class="form-control"
                                           v-model="form.responsibilities[index]"
                                           title="Reason for leaving"
                                           placeholder="Responsibilities">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <span v-text="exp" hidden></span>
                        <div class="form-row">
                            <div id="date" class="form-group">
                                <label for="exp_date_from" class="sr-only">Date from</label>
                                <input id="exp_date_from" class="form-control"
                                       v-model="form.exp_date_from[index]"
                                       type="text" v-mask="'####-##-##'"
                                       title="Date from"
                                       placeholder="YYYY-MM-01">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="exp_date_to" class="sr-only">Date to</label>
                                <input id="exp_date_to" class="form-control"
                                       v-model="form.exp_date_to[index]"
                                       type="text" v-mask="'####-##-##'"
                                       title="Date to"
                                       placeholder="YYYY-MM-01">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container-fluid">
                        <a class="btn btn-danger btn-sm float-right "
                           @click="removeExperience(index,exp)"><i class="ti-eraser" style="color: white"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center">
                <a class="btn btn-light " @click="addExperience">Add experience</a>
            </div>

            <button class="btn btn-success btn-sm" @click="updateExperience">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <div v-if="form.exp_id.length === 0">
                <div class="text-center">No work experience</div>
            </div>
            <div v-else>
                <div class="container-fluid p-0 m-0" v-for="(exp,index) in form.exp_id">
                    <div class="mb-4">
                        <span v-text="exp" hidden></span>


                        <!--<input type="tel" v-mask="'##/##/####'" />-->
                        <!--<the-mask :mask="['###', '###-#', '###-##']" />-->

                        <h5><span v-text="form.exp_position[index]"></span>
                            <small v-show="form.exp_date_from[index] !== '' && form.exp_date_to[index] !=='' || form.exp_date_from[index] !== null && form.exp_date_to[index] !==null">( <span
                                    v-text="form.exp_date_from[index]"></span> to <span
                                    v-text="form.exp_date_to[index]"></span> )
                            </small>
                        </h5>
                        <span v-show="form.exp_company_name[index] !== '' || form.exp_company_name[index] !== null">
                            <small>Company |</small>
                            <span v-text="form.exp_company_name[index]" style="color: #619BB2"></span> -
                        </span>
                        <span v-show="form.exp_company_address[index] !== '' || form.exp_company_address[index] !== null">
                            <span v-text="form.exp_company_address[index]"></span><br>
                        </span>

                        <span v-show="form.exp_industry[index]!=='' || form.exp_industry[index]!==null">
                             <small>Industry |</small>
                            <span v-text="form.exp_industry[index]"></span><br>
                        </span>
                        <span v-show="form.exp_salary[index] !== '0'">
                            <small>Salary |</small>
                            <span v-text="form.exp_salary[index]"></span><br>
                        </span>
                        <span v-show="form.responsibilities[index]!=='' || form.responsibilities[index]!==null">
                            <small>Responsibilities |</small>
                            <span v-text="form.responsibilities[index]"></span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile', 'owner', 'experience'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

                form: new Form({
                    exp_id: [],
                    exp_position: [],
                    exp_company_name: [],
                    exp_company_address: [],
                    exp_date_from: [],
                    exp_date_to: [],
                    exp_industry: [],
                    exp_salary: [],
                    responsibilities: [],
                })

            }
        },

        mounted: function () {
            this.experience.map((exp) => {
                this.values(exp)
            });
        },


        methods: {
            updateExperience() {
                this.form.patch('/profile/' + this.profile.slug + '/experience')
                    .then(response => {
                        this.clear();
                        response.data.map((exp) => {
                            this.values(exp)
                        })
                    });
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });


                toast.text("Work experience updated.").goAway(5000);
            },

            deleteExperience(exp) {
                this.form.delete('/profile/experience/' + exp);
                    // .then(response => {
                    //     this.work_exp = response.data;
                    // });
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Experience deleted.").goAway(5000);
            },

            addExperience() {
                this.form.exp_id.push('');
                this.form.exp_company_name.push('');
                this.form.exp_company_address.push('');
                this.form.exp_date_from.push('');
                this.form.exp_date_to.push('');
                this.form.exp_industry.push('');
                this.form.exp_salary.push('');
                this.form.responsibilities.push('');
            },

            removeExperience: function (index, exp) {
                this.form.exp_id.splice(index, 1);
                this.form.exp_position.splice(index, 1);
                this.form.exp_company_name.splice(index, 1);
                this.form.exp_company_address.splice(index, 1);
                this.form.exp_date_from.splice(index, 1);
                this.form.exp_date_to.splice(index, 1);
                this.form.exp_industry.splice(index, 1);
                this.form.exp_salary.splice(index, 1);
                this.form.responsibilities.splice(index, 1);

                if (exp !== '') {
                    this.deleteExperience(exp);
                }
            },

            values(exp) {
                this.form.exp_id.push(exp.id);
                this.form.exp_position.push(exp.master_job_title_key);
                this.form.exp_company_name.push(exp.company_name);
                this.form.exp_company_address.push(exp.company_address);
                this.form.exp_date_from.push(exp.date_from);
                this.form.exp_date_to.push(exp.date_to);
                this.form.exp_industry.push(exp.industry);
                this.form.exp_salary.push(exp.salary);
                this.form.responsibilities.push(exp.responsibilities);
            },

            clear() {
                this.form.exp_id = [];
                this.form.exp_position = [];
                this.form.exp_company_name = [];
                this.form.exp_company_address = [];
                this.form.exp_date_from = [];
                this.form.exp_date_to = [];
                this.form.exp_industry = [];
                this.form.exp_salary = [];
                this.form.responsibilities = [];
            }
        }
    }
</script>