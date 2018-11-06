<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Contact</h4>
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
                        <label for="con_telephone_num" class="sr-only">Telephone no.</label>
                        <input type="text" id="con_telephone_num" v-model="form.telephone_num"
                               class="form-control" title="Telephone no." placeholder="Telephone no.">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="con_mobile_num" class="sr-only">Mobile no.</label>
                        <input type="text" id="con_mobile_num" v-model="form.mobile_num" class="form-control"
                               title="Mobile no." placeholder="Mobile no.">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="con_other_num" class="sr-only">Other no.</label>
                        <input type="text" id="con_other_num" v-model="form.other_mobile" class="form-control"
                               title="Other no." placeholder="Other no.">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="con_email" class="sr-only">Email</label>
                        <input type="text" id="con_email" v-model="form.email" class="form-control"
                               title="Email" placeholder="Email">
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-sm" @click="updateContact">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
        </div>
        <div v-else>
            <small>Telephone No. |</small> <span class="c-grey-900" v-text="form.telephone_num"></span><br>
            <small>Mobile No. |</small> <span class="c-grey-900" v-text="form.mobile_num"></span><br>
            <small>Other No. |</small> <span class="c-grey-900" v-text="form.other_mobile"></span><br>
            <small>Email. |</small> <span class="c-grey-900" v-text="form.email"></span><br>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile','owner','info','employee'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

               form: new Form({
                   telephone_num: '',
                   mobile_num: '',
                   other_mobile: '',
                   email: this.employee.email,
               })

            }
        },

        created: function () {
             this.contact();
        },

        methods: {
            updateContact(){
                this.form.patch('/profile/' + this.profile.slug +'/contact');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Contact information updated.").goAway(5000);
            },
            contact() {
                this.info.map((contact) => {
                    this.form.telephone_num = contact.telephone_num;
                    this.form.mobile_num = contact.mobile_num;
                    this.form.other_mobile = contact.other_mobile;
                });
            },
        }
    }
</script>