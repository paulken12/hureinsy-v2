<template>

    <div class="container-fluid">
        <!--      Wizard container        -->

        <div class="wizard-container">
            <div class="card wizard-card" data-col-smor="blue" id="wizard">
                <form action="/store/recruit" METHOD="POST" @submit.prevent="onSubmit"
                      @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
                    <div class="wizard-header">
                        <h3>
                            <b>Please complete your personal information</b> <br>
                            <small>Fill the required fields. This information will let us know more about you.</small>
                        </h3>
                    </div>
                    <div class="wizard-navigation text-center">
                        <ul>
                            <li><a href="#basic" data-toggle="tab">Basic Info</a></li>
                            <li><a href="#contact" data-toggle="tab">Annex A</a></li>
                            <li><a href="#address" data-toggle="tab">Annex B</a></li>
                            <li><a href="#family" data-toggle="tab">Annex C</a></li>
                            <li><a href="#education" data-toggle="tab">Contract</a></li>
                            <li><a href="#experience" data-toggle="tab">Experience</a></li>
                            <li><a href="#training" data-toggle="tab">Training</a></li>
                            <li><a href="#reference" data-toggle="tab">Reference</a></li>
                            <li><a href="#complete" data-toggle="tab">Complete</a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane" id="basic">
                            <div class="container-fluid">
                                <h4 class="info-text"> Let's start with the basic details</h4>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img src="../../../../public/storage/avatars/guest.png" class="picture-src"
                                                     title="" :src="avatar" id="avatar"/>
                                                <input type="file" id="wizard-picture" accept="image/*" @change="image">
                                            </div>
                                            <h6>Choose Picture</h6>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-row">
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_first_name" class="sr-only">First Name</label>
                                                    <input type="text" id="basic_first_name" name="basic_first_name"
                                                           v-model="form.basic_first_name"
                                                           class="form-control"
                                                           v-bind:class="{ 'is-invalid' : form.errors.has('basic_first_name')}"
                                                           title="First Name" placeholder="First Name">
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('basic_first_name')"
                                                           v-text="form.errors.get('basic_first_name')"></small>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_middle_name" class="sr-only">Middle Name</label>
                                                    <input type="text" id="basic_middle_name" name="basic_middle_name"
                                                           v-model="form.basic_middle_name"
                                                           class="form-control"
                                                           v-bind:class="{ 'is-invalid': form.errors.has('basic_middle_name')}"
                                                           title="Middle Name" placeholder="Middle Name">
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('basic_middle_name')"
                                                           v-text="form.errors.get('basic_middle_name')"></small>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_last_name" class="sr-only">Last Name</label>
                                                    <input type="text" id="basic_last_name" name="basic_last_name"
                                                           v-model="form.basic_last_name"
                                                           class="form-control"
                                                           v-bind:class="{ 'is-invalid' : form.errors.has('basic_last_name')}"
                                                           title="Last Name" placeholder="Last Name">
                                                    <small class="text-danger" v-if="form.errors.has('basic_last_name')"
                                                           v-text="form.errors.get('basic_last_name')"></small>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="basic_extension" class="sr-only">Extension</label>
                                                    <select id="basic_extension" v-model="form.basic_extension_key"
                                                            class="form-control">
                                                        <option disabled value="">Extension</option>
                                                        <option v-for="extensionType in extension"
                                                                v-bind:value="extensionType.key">
                                                            {{extensionType.name_extension}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm">

                                                <div class="form-group">
                                                    <label for="basic_birth_date" class="sr-only">Date of birth</label>
                                                    <input type="text" id="basic_birth_date"
                                                           v-model="form.basic_date_of_birth"
                                                           class="form-control"
                                                           v-mask="'####-##-##'"
                                                           data-provide="datepicker" data-date-format="yyyy-mm-dd"
                                                           title="Birth of birth" placeholder="Date of birth" required>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_civil_status_key" class="sr-only">Civil
                                                        Status</label>
                                                    <select id="basic_civil_status_key"
                                                            v-model="form.basic_civil_status_key"
                                                            class="form-control">
                                                        <option disabled value="">Civil Status</option>
                                                        <option v-for="civilType in civil" v-bind:value="civilType.key">
                                                            {{civilType.civil_status}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_citizenship_key"
                                                           class="sr-only">Citizenship</label>
                                                    <select id="basic_citizenship_key" class="form-control"
                                                            v-model="form.basic_citizenship_key">
                                                        <option disabled value="">Citizenship</option>
                                                        <option v-for="citizenshipType in citizenship"
                                                                v-bind:value="citizenshipType.key">
                                                            {{citizenshipType.citizenship}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="gender_key" class="sr-only">Gender</label>
                                                    <select id="gender_key" class="form-control"
                                                            v-model="form.basic_gender_key">
                                                        <option disabled value="">Gender</option>
                                                        <option v-for="genderType in gender"
                                                                v-bind:value="genderType.key">
                                                            {{genderType.gender}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="basic_birth_place" class="sr-only">Birth Place</label>
                                            <input type="text" id="basic_birth_place" v-model="form.basic_birth_place"
                                                   class="form-control"
                                                   title="Birth Place" placeholder="Birth Place">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="complete">
                            <div class="container-fluid text-center">

                                <h3>Complete</h3>
                                <span>Thank you for filling out your information!</span>
                                <br>
                                <br>
                                <button class="btn btn-fill btn-simple">Preview</button>
                                <br>
                                <br>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customControlValidation1"
                                           required>
                                    <label class="custom-control-label" for="customControlValidation1">I agree to the <a
                                            href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Terms and
                                        Conditions</a></label>
                                </div>

                                <span></span>
                            </div>
                        </div>

                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next'
                                   value='Next'/>
                            <input type="submit" class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish'
                                   @click="onSubmit"
                                   value='Submit'/>

                        </div>
                        <div class="pull-left">
                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm'
                                   name='previous' value='Previous'/>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </div>
        </div> <!-- wizard container -->
    </div>

</template>

<script>

    import FamilyTab from './FamilyTab.vue';

    export default {

        props: ['user', 'profile', 'gender', 'citizenship', 'civil', 'extension', 'educations', 'families'],

        components: {FamilyTab},

        ready: function () {
            window.beforeunload = this.leaving;
            window.onblur = this.leaving;
            window.onbeforeunload = this.leaving;
        },

        data: function () {
            return {

                submitted: false,

                avatar: this.user.avatar_path,

                avatar_source: '',

                avatar_file: '',

                tabs: [{
                    name: 'tab1',
                    id: 0,
                    isActive: true,
                    isShow: true
                }],
                activeTab: {},

                form: new Form({
                    basic_first_name: this.isFirstNameEmpty(),
                    basic_middle_name: this.isMiddleNameEmpty(),
                    basic_last_name: this.isLastNameEmpty(),
                    basic_extension_key: '',
                    basic_date_of_birth: '',
                    basic_civil_status_key: '',
                    basic_citizenship_key: '',
                    basic_gender_key: '',
                    basic_birth_place: '',

                    eme_first_name: '',
                    eme_middle_name: '',
                    eme_last_name: '',
                    eme_contact_num: '',
                    eme_relationship : '',

                    telephone_num: '',
                    mobile_num: '',
                    other_mobile: '',
                    email: this.email(),

                    address_type: ['Present Address', 'Permanent Address'],
                    master_address_key: ['ra', 'pa'],
                    add_unit_num: [],
                    add_block: [],
                    add_street_name: [],
                    add_subdivision: [],
                    add_barangay: [],
                    add_city: [],
                    add_province: [],
                    add_zip_code: [],

                    family_type: ['Father', 'Mother'],
                    master_family_key: ['fat', 'mot'],
                    fam_hidden: [false, false],
                    fam_last_name: [],
                    fam_first_name: [],
                    fam_date_of_birth: [],
                    fam_gender_key: ['m', 'f'],
                    fam_employer: [],
                    fam_occupation: [],

                    education_type: ['Elementary', 'Secondary', 'College'],
                    master_education_key: ['ele', 'sec', 'col'],
                    edu_course: [],
                    edu_name_of_school: [],
                    edu_year_graduated: [],
                    edu_award: [],

                    exp_position: [],
                    exp_company_name: [],
                    exp_company_address: [],
                    exp_date_from: [],
                    exp_date_to: [],
                    exp_industry: [],
                    exp_salary: [],
                    responsibilities: [],

                    train_title: [],
                    train_date_from: [],
                    train_date_to: [],
                    train_place_seminar: [],

                    ref_job_title: [],
                    ref_first_name: [],
                    ref_last_name: [],
                    ref_middle_name: [],
                    ref_company_name: [],
                    ref_company_address: [],
                    ref_contact_num: [],
                })
            }
        },

        created() {
            window.addEventListener('beforeunload', this.removeUser)
        },

        mounted: function () {
            $("#train_date_from").datepicker().on(
                "changeDate", () => {
                    this.form.train_date_from = $('#train_date_from').val()
                }
            );
            $("#train_date_to").datepicker().on(
                "changeDate", () => {
                    this.form.train_date_to = $('#train_date_to').val()
                }
            );

        },

        methods: {

            checkboxToggle(index){
                this.form.add_unit_num[1] = this.form.add_unit_num[0];


            },

            removeUser() {
                alert("Leaving...");
            },

            leaving: function () {
                alert("Leaving...");
            },

            onSubmit() {
                this.submitted = true;
                this.form.post('/register/confirmed');
            },

            addFamily() {
                this.form.family_type.push('Sibling');
                this.form.master_family_key.push('sib');
                this.form.fam_hidden.push(true);
                this.form.fam_last_name.push('');
                this.form.fam_first_name.push('');
                this.form.fam_date_of_birth.push('');
                this.form.fam_gender_key.push('');
                this.form.fam_employer.push('');
                this.form.fam_occupation.push('');
            },

            addEducation() {
                this.form.education_type.push('Vocational');
                this.form.master_education_key.push('voc');
                this.form.edu_course.push('');
                this.form.edu_name_of_school.push('');
                this.form.edu_year_graduated.push('');
                this.form.edu_award.push('');
            },

            addExperience() {
                this.form.exp_company_name.push('');
                this.form.exp_company_address.push('');
                this.form.exp_date_from.push('');
                this.form.exp_date_to.push('');
                this.form.exp_industry.push('');
                this.form.exp_salary.push('');
                this.form.responsibilities.push('');
            },

            addReference() {
                this.form.ref_job_title.push('');
                this.form.ref_first_name.push('');
                this.form.ref_last_name.push('');
                this.form.ref_middle_name.push('');
                this.form.ref_company_name.push('');
                this.form.ref_company_address.push('');
                this.form.ref_contact_num.push('');
            },

            addTraining() {
                this.form.train_title.push('');
                this.form.train_date_from.push(moment().format('YYYY-MM-DD'));
                this.form.train_date_to.push(moment().format('YYYY-MM-DD'));
                this.form.train_place_seminar.push('');
            },

            removeSibling: function (index) {

                this.form.family_type.splice(index, 1);
                this.form.master_family_key.splice(index, 1);
                this.form.fam_last_name.splice(index, 1);
                this.form.fam_first_name.splice(index, 1);
                this.form.fam_date_of_birth.splice(index, 1);
                this.form.fam_gender_key.splice(index, 1);
                this.form.fam_employer.splice(index, 1);
                this.form.fam_occupation.splice(index, 1);
            },

            removeEducation: function (index) {

                this.form.education_type.splice(index, 1);
                this.form.master_education_key.splice(index, 1);
                this.form.edu_course.splice(index, 1);
                this.form.edu_name_of_school.splice(index, 1);
                this.form.edu_year_graduated.splice(index, 1);
                this.form.edu_award.splice(index, 1);
            },

            removeExperience: function (index) {

                this.form.exp_position.splice(index, 1);
                this.form.exp_company_name.splice(index, 1);
                this.form.exp_company_address.splice(index, 1);
                this.form.exp_date_from.splice(index, 1);
                this.form.exp_date_to.splice(index, 1);
                this.form.exp_industry.splice(index, 1);
                this.form.exp_salary.splice(index, 1);
                this.form.responsibilities.splice(index, 1);
            },

            removeReference: function (index) {
                this.form.ref_job_title.splice(index, 1);
                this.form.ref_first_name.splice(index, 1);
                this.form.ref_last_name.splice(index, 1);
                this.form.ref_middle_name.splice(index, 1);
                this.form.ref_company_name.splice(index, 1);
                this.form.ref_company_address.splice(index, 1);
                this.form.ref_contact_num.splice(index, 1);
            },

            removeTraining: function (index) {
                this.form.train_title.splice(index, 1);
                this.form.train_date_from.splice(index, 1);
                this.form.train_date_to.splice(index, 1);
                this.form.train_place_seminar.splice(index, 1);
            },

            setActive: function (tab) {
                let self = this;
                tab.isActive = true;
                tab.isShow = true;
                this.activeTab = tab;
                /*this.activeTab.isActive = true;
                console.log("activeTab name=" + this.activeTab.name);*/
                this.tabs.forEach(function (tab) {
                    if (tab.id !== self.activeTab.id) {
                        tab.isActive = false;
                        tab.isShow = false;
                    }
                });
            },
            openNewTab: function () {
                let newTab = {
                    name: "tab" + (this.tabs.length + 1),
                    id: this.tabs.length,
                    isActive: true,
                    isShow: true
                };
                this.tabs.push(newTab);
                this.setActive(newTab);
            },

            closeTab: function () {
                console.log("### CLOSE!");
            },


            isFirstNameEmpty() {
                if (this.profile.first_name.length > 0) {
                    return this.profile.first_name
                }
                return ''
            },

            isMiddleNameEmpty() {
                if (this.profile.middle_name.length > 0) {
                    return this.profile.middle_name
                }
                return ''
            },

            isLastNameEmpty() {
                if (this.profile.last_name.length > 0) {
                    return this.profile.last_name
                }
                return ''
            },

            email() {
                if (this.user.email.length > 0) {
                    return this.user.email
                }
                return ''
            },
            image(e) {
                if (! e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    this.avatar_source = e.target.result;

                    this.persist(this.avatar_file);

                };
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);
            }


        },

    }
</script>
