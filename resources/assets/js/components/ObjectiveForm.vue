<template>

    <div>
        <div class="bdT pX-40 pY-30">

            <h5>Objective
                <span v-if="own">
                    <a href="#" class="btn btn-sm btn-link float-right" title="Edit objective"
                   v-on:click="edit = !edit"><i class="ti-pencil-alt"></i></a>
                </span>
            </h5>
            <div v-if="edit">
                <div class="form-group">
                    <label for="edit-objective" class="sr-only">Edit Objective</label>
                    <textarea name="edit-objective" class="form-control" id="edit-objective"
                              v-model="form.user_obj"
                              cols="30" rows="5"></textarea>
                </div>
                <button class="btn btn-success btn-sm" @click="updateObjective">Update</button>
                <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
            </div>
            <div v-else>
                <p v-text="form.user_obj"></p>
            </div>

            <hr>

            <!--<div class="row m-0 p-0">-->
                <!--<div class="col p-0">-->
                    <!--Gender: <span class="c-grey-900">{{$profile->gender}}</span> <br>-->
                    <!--Civil Status: <span class="c-grey-900">{{$profile->civilStatus}}</span> <br>-->
                    <!--Citizenship: <span class="c-grey-900">{{$profile->citizenship}}</span> <br>-->
                <!--</div>-->
                <!--&lt;!&ndash;@can('view', $profile->user)&ndash;&gt;-->
                <!--<div class="col-7 p-0">-->
                    <!--Birth date: <span-->
                        <!--class="c-grey-900">{{$profile->date_of_birth->format('F jS, Y')}}</span>-->
                    <!--<br>-->
                    <!--Birth place: <span-->
                        <!--class="c-grey-900">{{$profile->birth_place? : '-'}}</span> <br>-->
                <!--</div>-->
                <!--&lt;!&ndash;@endcan&ndash;&gt;-->
            <!--</div>-->
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile','owner','objective'],

        data: function () {
            return {

                edit: false,

                prof: this.profile,

                own: this.owner,

               form: new Form({
                   user_obj: '',
               })

            }
        },

        created: function () {
            this.obj();
        },

        methods: {
            updateObjective(){
                this.form.patch('/profile/' + this.profile.slug +'/objective');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Objective updated.").goAway(5000);
            },

            obj() {
                this.objective.map((obj) => {
                    this.form.user_obj = obj.objective;
                });
            },
        }
    }
</script>