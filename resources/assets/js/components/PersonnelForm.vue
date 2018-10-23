<template>

    <div class="container-fluid">
        <!--      Wizard container        -->

        <div class="wizard-container">
            <div class="card wizard-card" data-color="blue" id="wizard">
                <form action="/register/confirmed" METHOD="POST" @submit.prevent="onSubmit"
                      @keydown="form.errors.clear($event.target.name)" enctype="multipart/form-data">
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
                            <li><a href="#reference" data-toggle="tab">Reference</a></li>
                            <li><a href="#complete" data-toggle="tab">Complete</a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane" id="basic">
                            <div class="container-fluid">
                                <h4 class="info-text"> Let's start with the basic details</h4>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img src="../../../../public/images/guest.png" class="picture-src"
                                                     id="wizardPicturePreview" title=""/>
                                                <input type="file" id="wizard-picture">
                                            </div>
                                            <h6>Choose Picture</h6>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col">
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
                                            <div class="col">
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
                                            <div class="col">
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
                                            <div class="col-2">
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
                                            <div class="col">

                                                <div class="form-group">
                                                    <label for="basic_birth_date" class="sr-only">Date of birth</label>
                                                    <input type="text" id="basic_birth_date"
                                                           v-model="form.basic_date_of_birth"
                                                           class="form-control"
                                                           title="Birth of birth" placeholder="Date of birth">
                                                </div>
                                            </div>
                                            <div class="col">
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
                                            <div class="col">
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
                                            <div class="col-2">
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
                        <div class="tab-pane" id="contact">
                            <div class="container-fluid">
                                <h4 class="info-text">Provide your contact list </h4>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="con_telephone_num" class="sr-only">Telephone no.</label>
                                            <input type="text" id="con_telephone_num" v-model="form.telephone_num"
                                                   class="form-control" title="Telephone no."
                                                   placeholder="Telephone no.">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="con_mobile_num" class="sr-only">Mobile no.</label>
                                            <input type="text" id="con_mobile_num" v-model="form.mobile_num"
                                                   class="form-control"
                                                   title="Mobile no." placeholder="Mobile no.">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="con_other_num" class="sr-only">Other no.</label>
                                            <input type="text" id="con_other_num" v-model="form.other_mobile"
                                                   class="form-control"
                                                   title="Other no." placeholder="Other no.">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="text" id="email" v-model="form.email" class="form-control"
                                                   title="Email" placeholder="Email">
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
                                        <h5 v-text="address"></h5>
                                        <hr>

                                        <div class="row">

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_unit_num" class="sr-only">Unit no.</label>
                                                    <input type="text" id="add_unit_num"
                                                           v-model="form.add_unit_num[index]"
                                                           class="form-control" title="Unit no." placeholder="Unit no.">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_block" class="sr-only">Block</label>
                                                    <input type="text" id="add_block" v-model="form.add_block[index]"
                                                           class="form-control" title="Block" placeholder="Block">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_street_name" class="sr-only">Street name</label>
                                                    <input type="text" id="add_street_name"
                                                           v-model="form.add_street_name[index]"
                                                           class="form-control" title="Street name"
                                                           placeholder="Street name">
                                                </div>
                                            </div>
                                            <div class="col">
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
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_barangay" class="sr-only">Barangay</label>
                                                    <input type="text" id="add_barangay"
                                                           v-model="form.add_barangay[index]"
                                                           class="form-control" title="Barangay" placeholder="Barangay">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_city" class="sr-only">City</label>
                                                    <input type="text" id="add_city" v-model="form.add_city[index]"
                                                           class="form-control"
                                                           title="City" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="add_province" class="sr-only">Province</label>
                                                    <input type="text" id="add_province"
                                                           v-model="form.add_province[index]"
                                                           class="form-control" title="Province" placeholder="Province">
                                                </div>
                                            </div>
                                            <div class="col">
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
                                                    <div class="col m-0 p-0">
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
                                                    <div class="col m-0 p-0">
                                                        <a v-show="form.fam_hidden[index]"
                                                           class="btn btn-danger btn-sm float-right "
                                                           @click="removeSibling(index)">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="fam_last_name" class="sr-only">Last name</label>
                                                            <input type="text" id="fam_last_name" class="form-control"
                                                                   v-model="form.fam_last_name[index]"
                                                                   title="Last name"
                                                                   placeholder="Last name">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="fam_first_name" class="sr-only">First
                                                                name</label>
                                                            <input type="text" id="fam_first_name" class="form-control"
                                                                   v-model="form.fam_first_name[index]"
                                                                   title="First name" placeholder="First name">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="fam_date_of_birth" class="sr-only">Date of
                                                                birth</label>
                                                            <input type="text" id="fam_date_of_birth"
                                                                   class="form-control"
                                                                   v-model="form.fam_date_of_birth[index]"
                                                                   title="Date of birth" placeholder="Date of birth">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
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
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="fam_employer" class="sr-only">Employer</label>
                                                            <input type="text" id="fam_employer" class="form-control"
                                                                   v-model="form.fam_employer[index]"
                                                                   title="Employer"
                                                                   placeholder="Employer">
                                                        </div>
                                                    </div>
                                                    <div class="col">
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
                                <div class="col-sm-12">
                                    <h4 class="info-text"> Education</h4>
                                </div>

                                <div class="card mb-4" v-for="(education, index) in form.education_type">
                                    <div class="card-body">
                                        <div class="form-row ">
                                            <div class="col">
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
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="course" class="sr-only">Course</label>
                                                    <input type="text" id="course" class="form-control"
                                                           v-model="form.edu_course[index]" title="Course"
                                                           placeholder="Course">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name_of_school" class="sr-only">School name</label>
                                                    <input type="text" id="name_of_school" class="form-control"
                                                           v-model="form.edu_name_of_school[index]"
                                                           title="School name" placeholder="School name">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="year_graduated" class="sr-only">Year graduated</label>
                                                    <input type="text" id="year_graduated" class="form-control"
                                                           v-model="form.edu_year_graduated[index]"
                                                           title="Year graduated" placeholder="Year graduated">
                                                </div>
                                            </div>
                                            <div class="col">
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
                                        <div class="col">
                                            <div class="card mb-2">
                                                <div class="card-body">

                                                    <div class="form-row">
                                                        <span v-text="exp" hidden></span>
                                                        <div class="col">
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
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exp_company_name" class="sr-only">Company
                                                                    name</label>
                                                                <input type="text" id="exp_company_name"
                                                                       class="form-control"
                                                                       v-model="form.exp_company_name[index]"
                                                                       title="Company name" placeholder="Company name">
                                                            </div>
                                                        </div>
                                                        <div class="col">
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
                                                        <div class="col">
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
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exp_salary" class="sr-only">Salary</label>
                                                                <input type="text" id="exp_salary" class="form-control"
                                                                       v-model="form.exp_salary[index]" title="Salary"
                                                                       placeholder="Salary">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exp_reason_for_leaving" class="sr-only">Reason
                                                                    for
                                                                    leaving</label>
                                                                <input type="text" id="exp_reason_for_leaving"
                                                                       class="form-control"
                                                                       v-model="form.exp_reason_for_leaving[index]"
                                                                       title="Reason for leaving"
                                                                       placeholder="Reason for leaving">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <span v-text="exp" hidden></span>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="exp_date_from" class="sr-only">Date from</label>
                                                            <input type="text" id="exp_date_from" class="form-control"
                                                                   v-model="form.exp_date_from[index]"
                                                                   title="Date from"
                                                                   placeholder="Date from">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="exp_date_to" class="sr-only">Date to</label>
                                                            <input type="text" id="exp_date_to" class="form-control"
                                                                   v-model="form.exp_date_to[index]"
                                                                   title="Date to"
                                                                   placeholder="Date to">
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
                        <div class="tab-pane" id="reference">
                            <div class="container-fluid">
                                <h4 class="info-text"> Reference</h4>

                                <div class="container-fluid p-0 m-0" v-for="(ref,index) in form.ref_job_title">
                                    <div class="card mb-4">
                                        <div class="card-body">

                                            <div class="form-row">
                                                <span v-text="ref" hidden></span>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exp_position" class="sr-only">First name</label>
                                                        <input type="text" id="ref_first_name" class="form-control"
                                                               v-model="form.ref_first_name[index]" title="First name"
                                                               placeholder="First name">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exp_company_address" class="sr-only">Last
                                                            name</label>
                                                        <input type="text" id="ref_last_name" class="form-control"
                                                               v-model="form.ref_last_name[index]"
                                                               title="Last name" placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="col">
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
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exp_company_name" class="sr-only">Job title</label>
                                                        <input type="text" id="ref_job_title" class="form-control"
                                                               v-model="form.ref_job_title[index]"
                                                               title="Job title" placeholder="Job title">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exp_date_to" class="sr-only">Company name</label>
                                                        <input type="text" id="ref_company_name" class="form-control"
                                                               v-model="form.ref_company_name[index]"
                                                               title="Company name"
                                                               placeholder="Company name">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exp_salary" class="sr-only">Contact no.</label>
                                                        <input type="text" id="ref_contact_num" class="form-control"
                                                               v-model="form.ref_contact_num[index]" title="Contact no."
                                                               placeholder="Contact no.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
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
                                                <div class="col">
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

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <label for="tac" class="sr-only"></label>
                                    <textarea name="tac" id="tac" class="form-control" readonly
                                              style="height: 480px; color: #000; cursor: default">Terms and Conditions for Hureinsy


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
                            <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish' @click="onSubmit"
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

                    telephone_num: '',
                    mobile_num: '',
                    other_mobile: '',
                    email: this.email(),

                    address_type: ['Residential Address', 'Permanent Address'],
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
                    exp_reason_for_leaving: [],

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


        methods: {

            removeUser() {
                alert("Leaving...");
            },

            leaving: function () {
                alert("Leaving...");
            },

            onSubmit() {
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

                // let wizardElement = document.getElementById('wizard');
                // let wizard = new Wizard(wizardElement);
                // let buttonNext = document.querySelector('.next');
                // let buttonPrevious = document.querySelector('.previous');
                // let buttonFamily = document.querySelector('.add-family');
                //
                // wizard.addControls(buttonPrevious, buttonNext,buttonFamily);

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
                this.form.exp_reason_for_leaving.push('');
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
                this.form.exp_reason_for_leaving.splice(index, 1);
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


        },

    }
</script>
