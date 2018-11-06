<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>In Case of Emergency</h4>
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

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_first_name" class="sr-only">First name</label>
                        <input type="text" id="eme_first_name" v-model="form.first_name"
                               class="form-control" title="First name" placeholder="First name">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_middle_name" class="sr-only">Middle name</label>
                        <input type="text" id="eme_middle_name" v-model="form.middle_name" class="form-control"
                               title="Middle name" placeholder="Middle name">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_last_name" class="sr-only">Last name</label>
                        <input type="text" id="eme_last_name" v-model="form.last_name" class="form-control"
                               title="Last name" placeholder="Last name">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_contact_num" class="sr-only">Contact No.</label>
                        <input type="text" id="eme_contact_num" v-model="form.contact_num" class="form-control"
                               title="Contact No." placeholder="Contact No.">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="eme_relationship" class="sr-only">Relationship</label>
                        <input type="text" id="eme_relationship" v-model="form.relationship" class="form-control"
                               title="Relationship" placeholder="Relationship">
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-sm" @click="updateContact">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <small>Name |</small> <span class="c-grey-900" v-text="form.first_name">&nbsp;</span>
            <span class="c-grey-900" v-text="form.middle_name">&nbsp;</span>
            <span class="c-grey-900" v-text="form.last_name">&nbsp;</span><br>
            <small>Contact No. |</small> <span class="c-grey-900" v-if="form.contact_num" v-text="form.contact_num">Not specified</span><br>
            <small>Relationship |</small> <span class="c-grey-900" v-if="form.relationship" v-text="form.relationship">Not specified</span><br>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile','owner','emergency'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

               form: new Form({
                    first_name: '',
                    last_name: '',
                    middle_name: '',
                    contact_num: '',
                    relationship: '',
                })

            }
        },
        created: function () {
            this.emergency.map((contact) => {
                this.form.first_name = contact.first_name;
                this.form.last_name = contact.last_name;
                this.form.middle_name = contact.middle_name;
                this.form.contact_num = contact.contact_num;
                this.form.relationship = contact.relationship;
            });
        },


        methods: {
            updateContact(){
                this.form.patch('/profile/' + this.profile.slug +'/emergency');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Emergency contact updated.").goAway(5000);
            },
        }
    }
</script>