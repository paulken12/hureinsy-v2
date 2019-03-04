<template>

    <div class="container-fluid">
        <!--      Wizard container        -->

        <div class="wizard-container">
            <div class="card wizard-card" data-col-smor="blue" id="wizard">
                <form action="/register/confirmed" METHOD="POST" @submit="onSubmit"
                      @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="wizard-header">
                        <h3>
                            <b>Please complete your personal information</b> <br>
                            <small>Fill the required fields. This information will let us know more about you.</small>
                        </h3>
                    </div>
                    <div class="wizard-navigation text-center">
                        <ul>
                            <li><a href="#basic" data-toggle="tab">Basic</a></li>
                            <li><a href="#contact" data-toggle="tab">Contact</a></li>
                            <li><a href="#address" data-toggle="tab">Address</a></li>
                            <li><a href="#family" data-toggle="tab">Family</a></li>
                            <li><a href="#education" data-toggle="tab">Education</a></li>
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
                                                    <!-- <input type="text" id="basic_birth_date"
                                                           v-model="form.basic_date_of_birth"
                                                           class="form-control"
                                                           v-mask="'####-##-##'"
                                                           title="Birth of birth" placeholder="yyyy-mm-dd"> -->
                                                    <datepicker v-model="form.basic_date_of_birth" 
                                                                :format="'yyyy-MM-dd'"
                                                                :bootstrap-styling="true"
                                                                :typeable="true"
                                                                :required="true"
                                                                v-mask="'####-##-##'"
                                                                placeholder="Date of Birth">
                                                    </datepicker>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_civil_status_key" class="sr-only">Civil
                                                        Status</label>
                                                    <select id="basic_civil_status_key" name="basic_civil_status_key"
                                                            v-model="form.basic_civil_status_key"
                                                            class="form-control"
                                                            v-bind:class="{ 'is-invalid': form.errors.has('basic_civil_status_key')}">
                                                        <option disabled value="">Civil Status</option>
                                                        <option v-for="civilType in civil" v-bind:value="civilType.key">
                                                            {{civilType.civil_status}}
                                                        </option>
                                                    </select>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('basic_civil_status_key')"
                                                           v-text="form.errors.get('basic_civil_status_key')"></small>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="basic_citizenship_key"
                                                           class="sr-only">Citizenship</label>
                                                    <select id="basic_citizenship_key" name="basic_citizenship_key" 
                                                            v-model="form.basic_citizenship_key" 
                                                            class="form-control"
                                                            v-bind:class="{ 'is-invalid': form.errors.has('basic_citizenship_key')}">
                                                        <option disabled value="">Citizenship</option>
                                                        <option v-for="citizenshipType in citizenship"
                                                                v-bind:value="citizenshipType.key">
                                                            {{citizenshipType.citizenship}}
                                                        </option>
                                                    </select>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('basic_citizenship_key')"
                                                           v-text="form.errors.get('basic_citizenship_key')"></small>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="basic_gender_key" class="sr-only">Gender</label>
                                                    <select id="basic_gender_key" name="basic_gender_key" 
                                                            v-model="form.basic_gender_key"
                                                            class="form-control"
                                                            v-bind:class="{ 'is-invalid': form.errors.has('basic_gender_key')}">
                                                        <option disabled value="">Gender</option>
                                                        <option v-for="genderType in gender"
                                                                v-bind:value="genderType.key">
                                                            {{genderType.gender}}
                                                        </option>
                                                    </select>
                                                    <small class="text-danger"
                                                           v-if="form.errors.has('basic_gender_key')"
                                                           v-text="form.errors.get('basic_gender_key')"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="basic_birth_place" class="sr-only">Birth Place</label>
                                            <input type="text" id="basic_birth_place"
                                                   v-model="form.basic_birth_place"
                                                   class="form-control"
                                                   title="Birth Place" placeholder="Birth Place">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="contact">
                            <div class="container-fluid">
                                <h4 class="info-text">Provide your contact list </h4>
                                <div class="form-row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="con_telephone_num" class="sr-only">Telephone no.</label>
                                            <input type="text" id="con_telephone_num" v-model="form.telephone_num"
                                                   v-mask="'(###)###-####'"
                                                   class="form-control" title="Telephone no."
                                                   placeholder="Telephone no.">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="con_mobile_num" class="sr-only">Mobile no.</label>
                                            <input type="text" id="con_mobile_num" v-model="form.mobile_num"
                                                   v-mask="'(+##)###-###-####'"
                                                   class="form-control"
                                                   title="Mobile no." placeholder="Mobile no.">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="con_other_num" class="sr-only">Other no.</label>
                                            <input type="text" id="con_other_num" v-model="form.other_mobile"
                                                   class="form-control"
                                                   title="Other no." placeholder="Other no.">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="text" id="email" v-model="form.email" class="form-control"
                                                   title="Email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4 class="info-text">Emergency contact</h4>

                                <div class="form-row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="sr-only" for="eme_first_name">First name</label>
                                            <input type="text" id="eme_first_name" name="eme_first_name" v-model="form.eme_first_name"
                                                   class="form-control" title="First name"
                                                   placeholder="First name">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="sr-only" for="eme_middle_name">Middle name</label>
                                            <input type="text" id="eme_middle_name" name="eme_middle_name" v-model="form.eme_middle_name"
                                                   class="form-control" title="Middle name"
                                                   placeholder="Middle name">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="sr-only" for="eme_last_name">Last name</label>
                                            <input type="text" id="eme_last_name" name="eme_last_name" v-model="form.eme_last_name" class="form-control"
                                                   title="Last name"
                                                   placeholder="Last name">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="sr-only" for="eme_contact_num">Contact no.</label>
                                            <input type="text" id="eme_contact_num" name="eme_contact_num" v-model="form.eme_contact_num"
                                                   class="form-control" title="Contact no."
                                                   placeholder="Contact no.">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label class="sr-only" for="eme_relationship">Relationship</label>
                                            <input type="text" id="eme_relationship" name="eme_relationship" v-model="form.eme_relationship"
                                                   class="form-control" title="Relationship"
                                                   placeholder="Relationship">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                            <div class="container-fluid">
                                <h4 class="info-text">Tell us more about your location. </h4>

                                <div class="card mb-4" v-for="(address, index) in form.address_type">
                                    <div class="card-body">
                                        <div v-if="index >= 1">
                                            <a class="btn btn-link btn-sm float-right" @click="checkboxToggle(index)">Same as present address</a>
                                        </div>
                                        <h5 v-text="address"></h5>
                                        <hr>

                                        <div class="row">

                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_unit_num" class="sr-only">Unit no.</label>
                                                    <input type="text" id="add_unit_num"
                                                           v-model="form.add_unit_num[index]"
                                                           class="form-control" title="Unit no." placeholder="Unit no.">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_block" class="sr-only">Block</label>
                                                    <input type="text" id="add_block" v-model="form.add_block[index]"
                                                           class="form-control" title="Block" placeholder="Block">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_street_name" class="sr-only">Street name</label>
                                                    <input type="text" id="add_street_name"
                                                           v-model="form.add_street_name[index]"
                                                           class="form-control" title="Street name"
                                                           placeholder="Street name">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_subdivision" class="sr-only">Subdivision</label>
                                                    <input type="text" id="add_subdivision"
                                                           v-model="form.add_subdivision[index]"
                                                           class="form-control" title="Subdivision"
                                                           placeholder="Subdivision">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_barangay" class="sr-only">Barangay</label>
                                                    <input type="text" id="add_barangay"
                                                           v-model="form.add_barangay[index]"
                                                           class="form-control" title="Barangay" placeholder="Barangay">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_city" class="sr-only">City</label>
                                                    <input type="text" id="add_city" v-model="form.add_city[index]"
                                                           class="form-control"
                                                           title="City" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_province" class="sr-only">Province</label>
                                                    <input type="text" id="add_province"
                                                           v-model="form.add_province[index]"
                                                           class="form-control" title="Province" placeholder="Province">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="add_zip_code" class="sr-only">Zip code</label>
                                                    <input type="text" id="add_zip_code"
                                                           v-model="form.add_zip_code[index]"
                                                           class="form-control" title="Zip code" placeholder="Zip code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="family">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="container-fluid">
                                        <h4 class="info-text"> Your family members</h4>

                                        <div class="card mb-4" v-for="(family, index) in form.family_type">
                                            <div class="card-body">
                                                <div class="row m-0 p-0">
                                                    <div class="col-sm m-0 p-0">
                                                        <strong v-text="family" hidden></strong>
                                                        <label for="fam-type" class="sr-only">Family type</label>
                                                        <select id="fam-type" class="form-control w-25 border-info"
                                                                v-model="form.master_family_key[index]">
                                                            <option disabled value="">Family type</option>
                                                            <option v-for="familyType in families"
                                                                    v-bind:value="familyType.key">
                                                                {{familyType.family_type}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm m-0 p-0">
                                                        <a v-show="form.fam_hidden[index]"
                                                           class="btn btn-danger btn-sm float-right "
                                                           @click="removeSibling(index)">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_last_name" class="sr-only">Last name</label>
                                                            <input type="text" id="fam_last_name" class="form-control"
                                                                   v-model="form.fam_last_name[index]"
                                                                   title="Last name"
                                                                   placeholder="Last name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_first_name" class="sr-only">First
                                                                name</label>
                                                            <input type="text" id="fam_first_name" class="form-control"
                                                                   v-model="form.fam_first_name[index]"
                                                                   title="First name" placeholder="First name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_date_of_birth" class="sr-only">Date of
                                                                birth</label>
                                                            <!-- <input type="date" id="fam_date_of_birth"
                                                                   class="form-control"
                                                                   v-model="form.fam_date_of_birth[index]"
                                                                   v-mask="'####-##-##'"
                                                                   title="Date of birth" placeholder="Date of birth"> -->
                                                            <datepicker v-model="form.fam_date_of_birth[index]" 
                                                                        :format="'yyyy-MM-dd'"
                                                                        :bootstrap-styling="true"
                                                                        :typeable="true"
                                                                        v-mask="'####-##-##'"
                                                                        placeholder="Date of Birth">
                                                            </datepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_gender_key" class="sr-only">Gender</label>
                                                            <select id="fam_gender_key" class="form-control"
                                                                    v-model="form.fam_gender_key[index]">
                                                                <option disabled value="">Gender</option>
                                                                <option v-for="genderType in gender"
                                                                        v-bind:value="genderType.key">
                                                                    {{genderType.gender}}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_employer" class="sr-only">Employer</label>
                                                            <input type="text" id="fam_employer" class="form-control"
                                                                   v-model="form.fam_employer[index]"
                                                                   title="Employer"
                                                                   placeholder="Employer">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="fam_occupation"
                                                                   class="sr-only">Occupation</label>
                                                            <input type="text" id="fam_occupation" class="form-control"
                                                                   v-model="form.fam_occupation[index]"
                                                                   title="Occupation" placeholder="Occupation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-simple btn-sm" @click="addFamily">Add family
                                                member</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="education">
                            <div class="container-fluid">
                                <div class="col-sm-sm-12">
                                    <h4 class="info-text"> Education</h4>
                                </div>

                                <div class="card mb-4" v-for="(education, index) in form.education_type">
                                    <div class="card-body">
                                        <div class="form-row ">
                                            <div class="col-sm">
                                                <strong v-text="education" hidden></strong>
                                                <label for="edu-type" class="sr-only">Family type</label>
                                                <select id="edu-type" class="form-control border-info"
                                                        v-model="form.master_education_key[index]">
                                                    <option disabled value="">Education type</option>
                                                    <option v-for="eduType in educations" v-bind:value="eduType.key">
                                                        {{eduType.educational_level}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="course" class="sr-only">Course</label>
                                                    <input type="text" id="course" class="form-control"
                                                           v-model="form.edu_course[index]" title="Course"
                                                           placeholder="Course">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="name_of_school" class="sr-only">School name</label>
                                                    <input type="text" id="name_of_school" class="form-control"
                                                           v-model="form.edu_name_of_school[index]"
                                                           title="School name" placeholder="School name">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="year_graduated" class="sr-only">Year graduated</label>
                                                    <input type="text" id="year_graduated" class="form-control"
                                                           v-model="form.edu_year_graduated[index]"
                                                           title="Year graduated" placeholder="Year graduated">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label for="award" class="sr-only">Award</label>
                                                    <input type="text" id="award" class="form-control"
                                                           v-model="form.edu_award[index]" title="Award"
                                                           placeholder="Award">
                                                </div>
                                            </div>
                                            <div class="">
                                                <a class="btn btn-danger btn-sm float-right "
                                                   @click="removeEducation(index)">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid text-center">
                                    <a class="btn btn-simple btn-sm " @click="addEducation">Add education</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="experience">
                            <div class="container-fluid">
                                <h4 class="info-text"> Experience</h4>

                                <div class="container-fluid p-0 m-0" v-for="(exp,index) in form.exp_company_name">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="card mb-2">
                                                <div class="card-body">

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
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <span v-text="exp" hidden></span>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="exp_date_from" class="sr-only">Date from</label>
                                                            <!-- <input type="date" id="exp_date_from" class="form-control"
                                                                   v-model="form.exp_date_from[index]"
                                                                   title="Date from"
                                                                   placeholder="Date from"
                                                                   v-mask="'####-##-##'"> -->
                                                            <datepicker v-model="form.exp_date_from[index]" 
                                                                :format="'yyyy-MM-dd'"
                                                                :bootstrap-styling="true"
                                                                :typeable="true"
                                                                v-mask="'####-##-##'"
                                                                placeholder="Date from">
                                                            </datepicker>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="exp_date_to" class="sr-only">Date to</label>
                                                            <!-- <input type="date" id="exp_date_to" class="form-control"
                                                                   v-model="form.exp_date_to[index]"
                                                                   title="Date to"
                                                                   placeholder="Date to"
                                                                   v-mask="'####-##-##'"> -->
                                                            <datepicker v-model="form.exp_date_to[index]" 
                                                                :format="'yyyy-MM-dd'"
                                                                :bootstrap-styling="true"
                                                                :typeable="true"
                                                                v-mask="'####-##-##'"
                                                                placeholder="Date To">
                                                            </datepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="container-fluid">
                                            <a class="btn btn-danger btn-sm float-right "
                                               @click="removeExperience(index)">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid text-center">
                                    <a class="btn btn-simple btn-sm " @click="addExperience">Add
                                        experience</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="training">
                            <div class="container-fluid">
                                <h4 class="info-text"> Training</h4>

                                <div class="container-fluid p-0 m-0" v-for="(train,index) in form.train_title">
                                    <div class="card mb-4">
                                        <div class="card-body">

                                            <div class="form-row">
                                                <span v-text="train" hidden></span>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_position" class="sr-only">Training Title</label>
                                                        <input type="text" id="train_title" class="form-control"
                                                               v-model="form.train_title[index]" title="First name"
                                                               placeholder="Training title">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="train_date_from">Start Date</label>
                                                        <div class="input-group">
                                                            <!-- <input type="text"
                                                                   class="form-control bdc-grey-200 start-date"
                                                                   id="train_date_from"
                                                                   v-model="form.train_date_from[index]"
                                                                   title="Training start date"
                                                                   data-date-format="yyyy-mm-dd"
                                                                   data-provide="datepicker"> -->
                                                            <datepicker v-model="form.train_date_from[index]" 
                                                                :format="'yyyy-MM-dd'"
                                                                :bootstrap-styling="true"
                                                                :typeable="true"
                                                                v-mask="'####-##-##'"
                                                                placeholder="Date From">
                                                            </datepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="train_date_to">End Date</label>
                                                        <div class="input-group">
                                                            <!-- <input type="text"
                                                                   class="form-control bdc-grey-200 end-date"
                                                                   id="train_date_to"
                                                                   v-model="form.train_date_to[index]"
                                                                   title="Training end date">
                                                                   data-date-format="yyyy-mm-dd"
                                                                   data-provide="datepicker">-->
                                                            <datepicker v-model="form.train_date_to[index]" 
                                                                :format="'yyyy-MM-dd'"
                                                                :bootstrap-styling="true"
                                                                :typeable="true"
                                                                v-mask="'####-##-##'"
                                                                placeholder="Date To">
                                                            </datepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="train_place_seminar" class="sr-only">Location</label>
                                                        <input type="text" id="train_place_seminar" class="form-control"
                                                               v-model="form.train_place_seminar[index]"
                                                               title="Training location"
                                                               placeholder="Training location">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm">
                                                    <a class="btn btn-danger btn-sm float-right "
                                                       @click="removeTraining(index)">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid text-center">
                                    <a class="btn btn-simple btn-sm " @click="addTraining">Add
                                        Trainings</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="reference">
                            <div class="container-fluid">
                                <h4 class="info-text"> Reference</h4>

                                <div class="container-fluid p-0 m-0" v-for="(ref,index) in form.ref_job_title">
                                    <div class="card mb-4">
                                        <div class="card-body">

                                            <div class="form-row">
                                                <span v-text="ref" hidden></span>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_position" class="sr-only">First name</label>
                                                        <input type="text" id="ref_first_name" class="form-control"
                                                               v-model="form.ref_first_name[index]" title="First name"
                                                               placeholder="First name">
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_company_address" class="sr-only">Last
                                                            name</label>
                                                        <input type="text" id="ref_last_name" class="form-control"
                                                               v-model="form.ref_last_name[index]"
                                                               title="Last name" placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_date_from" class="sr-only">Middle name</label>
                                                        <input type="text" id="ref_middle_name" class="form-control"
                                                               v-model="form.ref_middle_name[index]"
                                                               title="Middle name"
                                                               placeholder="Middle name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_company_name" class="sr-only">Job title</label>
                                                        <input type="text" id="ref_job_title" class="form-control"
                                                               v-model="form.ref_job_title[index]"
                                                               title="Job title" placeholder="Job title">
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_date_to" class="sr-only">Company name</label>
                                                        <input type="text" id="ref_company_name" class="form-control"
                                                               v-model="form.ref_company_name[index]"
                                                               title="Company name"
                                                               placeholder="Company name">
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_salary" class="sr-only">Contact no.</label>
                                                        <input type="text" id="ref_contact_num" class="form-control"
                                                               v-model="form.ref_contact_num[index]" title="Contact no."
                                                               placeholder="Contact no.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="exp_industry" class="sr-only">Company
                                                            address</label>
                                                        <input type="text" id="ref_company_address" class="form-control"
                                                               v-model="form.ref_company_address[index]"
                                                               title="Company address"
                                                               placeholder="Company address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm">
                                                    <a class="btn btn-danger btn-sm float-right "
                                                       @click="removeReference(index)">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid text-center">
                                    <a class="btn btn-simple btn-sm " @click="addReference">Add
                                        reference</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="complete">
                            <div class="container">
                                <h3>Terms and Conditions for HUREINSY</h3>
                            </div>
                            <div class="container-fluid text-center">
                                <span>
                                    <textarea id="tac" class="form-control"
                                              style="height: 360px;color:black ;cursor: default" readonly="">
Introduction
These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Hureinsy accessible at hureinsy.com.

These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.

Minors or people below 18 years old are not allowed to use this Website.

Intellectual Property Rights
Other than the content you own, under these Terms, Hureinsy and/or its licensors own all the intellectual property rights and materials contained in this Website.

You are granted limited license only for purposes of viewing the material contained on this Website.

Restrictions
You are specifically restricted from all of the following:

publishing any Website material in any other media;
selling, sublicensing and/or otherwise commercializing any Website material;
publicly performing and/or showing any Website material;
using this Website in any way that is or may be damaging to this Website;
using this Website in any way that impacts user access to this Website;
using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;
engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;
using this Website to engage in any advertising or marketing.
Certain areas of this Website are restricted from being access by you and Hureinsy may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.

Your Content
In these Website Standard Terms and Conditions, "Your Content" shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant Hureinsy a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.

Your Content must be your own and must not be invading any third-party’s rights. Hureinsy reserves the right to remove any of Your Content from this Website at any time without notice.

No warranties
This Website is provided "as is," with all faults, and Hureinsy express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.

Limitation of liability
In no event shall Hureinsy, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract.  Hureinsy, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.

Indemnification
You hereby indemnify to the fullest extent Hureinsy from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.

Severability
If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.

Variation of Terms
Hureinsy is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.

Assignment
The Hureinsy is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.

Entire Agreement
These Terms constitute the entire agreement between Hureinsy and you in relation to your use of this Website, and supersede all prior agreements and understandings.

Governing Law & Jurisdiction
These Terms will be governed by and interpreted in accordance with the laws of the State of ph, and you submit to the non-exclusive jurisdiction of the state and federal courts located in ph for the resolution of any disputes.
                                    </textarea>
                                </span>
                                <br>
                                <div class="custom-control mb-3">
                                    <input type="checkbox" class="custom-control-input" id="confirm" v-model="checked">
                                    <label class="custom-control-label" for="confirm">I agree to the terms and conditions</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next'
                                   value='Next'/>
                            <input type="submit" class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish' value='Submit' :disabled="!checked"/>

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
    import Datepicker from 'vuejs-datepicker';

    export default {

        props: ['user', 'profile', 'gender', 'citizenship', 'civil', 'extension', 'educations', 'families'],

        components: {FamilyTab, Datepicker},

        ready: function () {
            window.beforeunload = this.leaving;
            window.onblur = this.leaving;
            window.onbeforeunload = this.leaving;
        },

        data: function () {
            return {
                csrf: '',

                checked: false,

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
                    add_unit_num: [null, null],
                    add_block: [null, null],
                    add_street_name: [null, null],
                    add_subdivision: [null, null],
                    add_barangay: [null, null],
                    add_city: [null, null],
                    add_province: [null, null],
                    add_zip_code: [null, null],

                    family_type: ['Father', 'Mother'],
                    master_family_key: ['fat', 'mot'],
                    fam_hidden: [false, false],
                    fam_last_name: [null, null],
                    fam_first_name: [null, null],
                    fam_date_of_birth: [null, null],
                    fam_gender_key: ['m', 'f'],
                    fam_employer: [null, null],
                    fam_occupation: [null, null],

                    education_type: ['Elementary', 'Secondary', 'College'],
                    master_education_key: ['ele', 'sec', 'col'],
                    edu_course: [null, null, null],
                    edu_name_of_school: [null, null, null],
                    edu_year_graduated: [null, null, null],
                    edu_award: [null, null, null],

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
/*            $("#train_date_from").datepicker().on(
                "changeDate", () => {
                    this.form.train_date_from = $('#train_date_from').val()
                }
            );
            $("#train_date_to").datepicker().on(
                "changeDate", () => {
                    this.form.train_date_to = $('#train_date_to').val()
                }
            );

            $(document).ready(function($){
                $('.m-date').mask('0000-00-00');
            });*/

            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        },

        methods: {

            checkboxToggle(index){
                Vue.set(this.form.add_unit_num, index, this.form.add_unit_num[0]);
                Vue.set(this.form.add_block, index, this.form.add_block[0]);
                Vue.set(this.form.add_street_name, index, this.form.add_street_name[0]);
                Vue.set(this.form.add_subdivision, index, this.form.add_subdivision[0]);
                Vue.set(this.form.add_barangay, index, this.form.add_barangay[0]);
                Vue.set(this.form.add_city, index, this.form.add_city[0]);
                Vue.set(this.form.add_province, index, this.form.add_province[0]);
                Vue.set(this.form.add_zip_code, index, this.form.add_zip_code[0]);
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
            },

        },

    }
</script>
