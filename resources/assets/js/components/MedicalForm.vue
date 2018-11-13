<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Bio Stats</h4>
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

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="med_master_blood_key" class="sr-only">Blood Type</label>
                        <select id="med_master_blood_key"
                                v-model="form.master_blood_key"
                                class="form-control">
                            <option disabled value="">Blood type</option>
                            <option v-for="bloodType in blood" v-bind:value="bloodType.key">
                                {{bloodType.blood_type}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_middle_name" class="sr-only">Height</label>
                        <input type="text" id="eme_middle_name" v-model="form.height" class="form-control"
                               title="Height" placeholder="Height">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_last_name" class="sr-only">Weight</label>
                        <input type="text" id="eme_last_name" v-model="form.weight" class="form-control"
                               title="Weight" placeholder="Weight">
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-sm" @click="updateMedical">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <small>Blood type |</small> <span class="c-grey-900" v-text="form.master_blood_key">&nbsp;</span><br>
            <small>Height(CM) |</small> <span class="c-grey-900" v-text="form.height">Not specified</span><br>
            <small>Weight(KG) |</small> <span class="c-grey-900" v-text="form.weight">Not specified</span><br>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile','owner','medical','blood'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

               form: new Form({
                    master_blood_key: '',
                    height: '',
                    weight: '',
                })

            }
        },
        created: function () {
            this.medical.map((contact) => {

                this.form.master_blood_key = contact.master_blood_key;
                this.form.height = contact.height;
                this.form.weight = contact.weight;
            });
        },


        methods: {
            updateMedical(){
                this.form.patch('/profile/' + this.profile.slug +'/medical');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Medical information updated.").goAway(5000);
            },
        }
    }
</script>