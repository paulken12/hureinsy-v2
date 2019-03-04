<template>
    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Family Background</h4>
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
            <div class="container-fluid p-0 m-0 " v-for="(fam, index) in form.family_id">
                <div class="row">
                    <div class="col-sm-3">
                        <strong v-text="fam" hidden></strong>
                        <label for="fam-type" class="sr-only">Family type</label>
                        <select id="fam-type" class="form-control border-info"
                                v-model="form.master_family_key[index]">
                            <option disabled value="">Family type</option>
                            <option v-for="famType in family_type" v-bind:value="famType.key">
                                {{famType.family_type}}
                            </option>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="last_name" class="sr-only">Last name</label>
                            <input type="text" id="last_name" class="form-control"
                                   v-model="form.fam_last_name[index]" title="Last Name"
                                   placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="first_name" class="sr-only">First name</label>
                            <input type="text" id="first_name" class="form-control"
                                   v-model="form.fam_first_name[index]" title="First Name"
                                   placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="fam_date_of_birth" class="sr-only">Date of Birth</label>
                            <datepicker v-model="form.fam_date_of_birth[index]" 
                                        :format="'yyyy-MM-dd'"
                                        :bootstrap-styling="true"
                                        :typeable="true"
                                        :calendar-button="true"
                                        calendar-button-icon="ti-calendar"
                                        v-mask="'####-##-##'"
                                        placeholder="Date of Birth">
                            </datepicker>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="occupation" class="sr-only">Occupation</label>
                            <input type="text" id="occupation" class="form-control"
                                   v-model="form.fam_occupation[index]"
                                   title="Occupation" placeholder="Occupation">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="employer" class="sr-only">Employer</label>
                            <input type="text" id="employer" class="form-control"
                                   v-model="form.fam_employer[index]"
                                   title="Employer" placeholder="Employer">
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="gen-type" class="sr-only">Gender</label>
                        <select id="gen-type" class="form-control border-info"
                                v-model="form.master_gender_key[index]">
                            <option disabled value="">Gender type</option>
                            <option v-for="genType in gender_type" v-bind:value="genType.key">
                                {{genType.gender}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container-fluid">
                        <a class="btn btn-danger btn-sm float-right "
                           @click="removeFamily(index,fam)"><i class="ti-eraser" style="color: white"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center">
                <a class="btn btn-light " @click="addFamily">Add family</a>
            </div>

            <button class="btn btn-success btn-sm" @click="updateFamily">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <div v-if="families.length === 0">
                <div class="text-center">No Family</div>
            </div>
            <div v-else>
            <div class="container-fluid p-0 m-0" v-for="(fam,index) in form.family_id">
                    <div class="mb-4">
                        <span v-text="fam" hidden></span>
                        <h5><span v-text="form.family_type[index]"></span>
                        </h5>
                        <div class="row">
                            <div class="col-sm">
                                <span v-show="form.family_type[index] !== ''">
                                    <small>Name |</small>
                                    <span v-text="form.fam_last_name[index]"></span>, <span v-text="form.fam_first_name[index]"></span><br>
                                </span>        
                                <span v-show="form.gender_type[index] !== ''">
                                    <small>Gender |</small>
                                    <span v-text="form.gender_type[index]"></span><br>
                                </span>       
                            </div>
                            <div class="col-sm-5">
                                <span v-show="form.fam_date_of_birth[index] !== ''">
                                    <small>Birthdate |</small>
                                    <span v-text="form.fam_date_of_birth[index]"></span><br>
                                </span>             
                                <span v-show="form.fam_employer[index] !== ''">
                                    <small>Employer |</small>
                                    <span v-text="form.fam_employer[index]"></span><br>
                                </span>
                                <span v-show="form.fam_occupation[index] !== ''">
                                    <small>Occupation |</small>
                                    <span v-text="form.fam_occupation[index]"></span><br>
                                </span>   
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {

        props: ['profile', 'owner', 'families','fam_type','family_type', 'gen_type', 'gender_type'],
        components: {Datepicker},

        data: function () {
            return {

                edit: false,

                own: this.owner,

                form: new Form({
                    family_id:[],
                    family_type: [],
                    master_family_key: [],
                    fam_last_name: [],
                    fam_first_name: [],
                    fam_date_of_birth: [],
                    fam_occupation: [],
                    fam_employer: [],
                    gender_type: [],
                    master_gender_key: [],
                })

            }
        },
        created: function () {
            this.families.map((fam) => {
                this.form.family_id.push(fam.id);
                this.form.master_family_key.push(fam.master_family_key);
                this.form.fam_last_name.push(fam.last_name);
                this.form.fam_first_name.push(fam.first_name);
                this.form.fam_date_of_birth.push(fam.date_of_birth);
                this.form.fam_occupation.push(fam.occupation);
                this.form.fam_employer.push(fam.employer);
                this.form.master_gender_key.push(fam.master_gender_key);
            });

            this.fam_type.map((fam) => {
                this.form.family_type.push(fam);
            });

            this.gen_type.map((fam) => {
                this.form.gender_type.push(fam);
            });
        },


        methods: {

            updateFamily() {
                this.form.patch('/profile/' + this.profile.slug + '/family');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });

                toast.text("Family Information updated.").goAway(5000);
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
        }
    }
</script>
