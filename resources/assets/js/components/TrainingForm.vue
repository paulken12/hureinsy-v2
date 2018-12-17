<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Trainings</h4>
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

            <div class="container-fluid p-0 m-0" v-for="(tra,index) in form.tra_id">
                <div class="form-row">
                    <span v-text="tra" hidden></span>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="tra_title" >Training Title</label>
                            <input type="text" id="tra_title" class="form-control"
                                   v-model="form.tra_title[index]" title="Training Title"
                                   placeholder="Training Title">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="tra_start" >Training Start</label>
                            <!-- <input type="text" id="tra_start" class="form-control"
                                   v-model="form.tra_start[index]"
                                   title="Training Start"
                                   placeholder="Training Start"> -->
                            <datepicker v-model="form.tra_start[index]" 
                                   name="tra_start"
                                   :format="'yyyy-MM-dd'"
                                   :bootstrap-styling="true"
                                   :typeable="true"
                                   :calendar-button="true"
                                   calendar-button-icon="ti-calendar"
                                   v-mask="'####-##-##'"
                                   placeholder="Training Start">
                            </datepicker>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="tra_end">Training End</label>
                            <!-- <input type="text" id="tra_end" class="form-control"
                                   v-model="form.tra_end[index]"
                                   title="Training End" placeholder="Training End"> -->
                            <datepicker v-model="form.tra_end[index]" 
                                   name="tra_end"
                                   :format="'yyyy-MM-dd'"
                                   :bootstrap-styling="true"
                                   :typeable="true"
                                   :calendar-button="true"
                                   calendar-button-icon="ti-calendar"
                                   v-mask="'####-##-##'"
                                   placeholder="Training End">
                            </datepicker>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="tra_location" >Training Location</label>
                            <input type="text" id="tra_location" class="form-control"
                                   v-model="form.tra_location[index]"
                                   title="Training Location" placeholder="Training Location">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container-fluid">
                        <a class="btn btn-danger btn-sm float-right "
                           @click="removeTraining(index,tra)"><i class="ti-eraser" style="color: white"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center">
                <a class="btn btn-light " @click="addTraining">Add Training</a>
            </div>

            <button class="btn btn-success btn-sm" @click="updateTraining">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <div v-if="form.tra_id.length === 0">
                <div class="text-center">No Trainings</div>
            </div>
            <div v-else>
                <table class="table table-sm w-100 mt-3">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date from</th>
                        <th>Date to</th>
                        <th>Location</th>
                    </tr>
                    </thead>
                    <tbody v-for="(tra,index) in form.tra_id">
                        <tr>
                            <td v-text="form.tra_title[index]"></td>
                            <td v-text="form.tra_start[index]"></td>
                            <td v-text="form.tra_end[index]"></td>
                            <td v-text="form.tra_location[index]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


<script>

    import Datepicker from 'vuejs-datepicker';

    export default{ 
        props: ['profile', 'owner', 'training'],
        components: {Datepicker},

        data: function () {
            return {

                edit: false,

                own: this.owner,

                form: new Form({
                    tra_id: [],
                    tra_title: [],
                    tra_start: [],
                    tra_end: [],
                    tra_location: [],
                })

            }
        },

        mounted: function () {
            this.training.map((tra) => {
                this.values(tra)
            });
        },


        methods: {
            updateTraining() {
                this.form.patch('/profile/' + this.profile.slug + '/training')
                    .then(response => {
                        this.clear();
                        response.data.map((tra) => {
                            this.values(tra)
                        })
                    });
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });


                toast.text("Trainings updated.").goAway(5000);
            },

            deleteTraining(tra) {
                this.form.delete('/profile/training/' + tra)
                    .then(response => {
                        this.work_exp = response.data;
                    });
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Training deleted.").goAway(5000);
            },

            addTraining() {
                this.form.tra_id.push('');
                this.form.tra_title.push('');
                this.form.tra_start.push('');
                this.form.tra_end.push('');
                this.form.tra_location.push('');
            },

            removeTraining: function (index, tra) {
                this.form.tra_id.splice(index, 1);
                this.form.tra_title.splice(index, 1);
                this.form.tra_start.splice(index, 1);
                this.form.tra_end.splice(index, 1);
                this.form.tra_location.splice(index, 1);

                if (tra !== '') {
                    this.deleteTraining(tra);
                }
            },

            values(tra) {
                this.form.tra_id.push(tra.id);
                this.form.tra_title.push(tra.title);
                this.form.tra_start.push(tra.date_from);
                this.form.tra_end.push(tra.date_to);
                this.form.tra_location.push(tra.place_seminar);
            },

            clear() {
                this.form.tra_id = [];
                this.form.tra_title = [];
                this.form.tra_start = [];
                this.form.tra_end = [];
                this.form.tra_location = [];
            }
        }
    }
</script>