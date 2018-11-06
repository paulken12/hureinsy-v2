<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Educational Background</h4>
                </div>
            </div>

            <div v-if="own">
                <div class="peer">
                <span><a href="#" title="Edit/Close" class="btn btn-link" v-on:click="edit = !edit"><i
                        class="mR-10 ti-pencil-alt"></i></a></span>
                </div>
            </div>
        </div>
        <hr>

        <div v-if="edit">
            <div class="container-fluid p-0 m-0" v-for="(education, index) in form.education_type">
                <div class="row">
                    <div class="col-sm">
                        <strong v-text="education" hidden></strong>
                        <label for="edu-type" class="sr-only">Family type</label>
                        <select id="edu-type" class="form-control border-info"
                                v-model="form.master_education_key[index]">
                            <option disabled value="">Education type</option>
                            <option v-for="eduType in education_type" v-bind:value="eduType.key">
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
                </div>
                <div class="row mb-3">
                    <div class="container-fluid">
                        <a class="btn btn-danger btn-sm float-right "
                           @click="removeEducation(index)"><i class="ti-eraser" style="color: white"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center">
                <a class="btn btn-light " @click="addEducation">Add education</a>
            </div>

            <div v-if="educations.length === 0">
                <button class="btn btn-success btn-sm" @click="insertEducation">Add</button>
                <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
            </div>
            <div v-else>
                <button class="btn btn-success btn-sm" @click="updateEducation">Update</button>
                <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
            </div>

        </div>
        <div v-else>
            <div v-if="educations.length === 0">
                <div class="text-center">No educational background provided</div>
            </div>
            <div v-else>
                <div class="container-fluid p-0 m-0" v-for="(exp,index) in form.education_type">
                    <div class="mb-4">
                        <span v-text="exp" hidden></span>
                        <h5><span v-text="form.education_type[index]"></span>
                            <small>( <span v-text="form.edu_year_graduated[index]"></span> )
                            </small>
                        </h5>
                        <small>Course |</small>
                        <span v-text="form.edu_course[index]"></span>
                        <br>
                        <small>School |</small>
                        <span v-text="form.edu_name_of_school[index]"></span>
                        <br>
                        <small>Award |</small>
                        <span v-text="form.edu_award[index]"></span><br>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile', 'owner', 'educations','edu_type','education_type'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

                form: new Form({
                    education_type: [],
                    master_education_key: [],
                    edu_course: [],
                    edu_name_of_school: [],
                    edu_year_graduated: [],
                    edu_award: [],
                })

            }
        },
        created: function () {
            this.educations.map((edu) => {
                this.form.master_education_key.push(edu.master_education_key);
                this.form.edu_course.push(edu.course);
                this.form.edu_name_of_school.push(edu.name_of_school);
                this.form.edu_year_graduated.push(edu.year_graduated);
                this.form.edu_award.push(edu.award);
            });

            this.edu_type.map((edu) => {
                this.form.education_type.push(edu);
            });
        },


        methods: {
            insertEducation() {

            },
            updateEducation() {
                this.form.patch('/profile/' + this.profile.slug + '/education');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });

                toast.text("Education information updated.").goAway(5000);
            },

            addEducation() {
                this.form.education_type.push('Vocational');
                this.form.master_education_key.push('voc');
                this.form.edu_course.push('');
                this.form.edu_name_of_school.push('');
                this.form.edu_year_graduated.push('');
                this.form.edu_award.push('');
            },

            removeEducation: function (index) {

                this.form.education_type.splice(index, 1);
                this.form.master_education_key.splice(index, 1);
                this.form.edu_course.splice(index, 1);
                this.form.edu_name_of_school.splice(index, 1);
                this.form.edu_year_graduated.splice(index, 1);
                this.form.edu_award.splice(index, 1);
            },
        }
    }
</script>