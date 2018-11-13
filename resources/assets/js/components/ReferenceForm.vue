<template>

    <div>
        <div class="peers ai-c jc-sb">
            <div class="peers peer-greed">
                <div class="peer">
                    <h4>Character Reference</h4>
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

            <div class="container-fluid p-0 m-0" v-for="(ref,index) in form.ref_id">
                <div class="form-row">
                    <span v-text="ref" hidden></span>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_first_name" >First name</label>
                            <input type="text" id="ref_first_name" class="form-control"
                                   v-model="form.ref_first_name[index]" title="First name"
                                   placeholder="First name">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_middle_name" >Middle name</label>
                            <input type="text" id="ref_middle_name" class="form-control"
                                   v-model="form.ref_middle_name[index]"
                                   title="Middle name"
                                   placeholder="Middle name">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_last_name" >Last
                                name</label>
                            <input type="text" id="ref_last_name" class="form-control"
                                   v-model="form.ref_last_name[index]"
                                   title="Last name" placeholder="Last name">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_job_title" >Job title</label>
                            <input type="text" id="ref_job_title" class="form-control"
                                   v-model="form.ref_job_title[index]"
                                   title="Job title" placeholder="Job title">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_company_name" >Company name</label>
                            <input type="text" id="ref_company_name" class="form-control"
                                   v-model="form.ref_company_name[index]"
                                   title="Company name"
                                   placeholder="Company name">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_contact_num" >Contact no.</label>
                            <input type="text" id="ref_contact_num" class="form-control"
                                   v-model="form.ref_contact_num[index]" title="Contact no."
                                   placeholder="Contact no.">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="ref_company_address" >Company
                                address</label>
                            <input type="text" id="ref_company_address" class="form-control"
                                   v-model="form.ref_company_address[index]"
                                   title="Company address"
                                   placeholder="Company address">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="container-fluid">
                        <a class="btn btn-danger btn-sm float-right "
                           @click="removeReference(index,ref)"><i class="ti-eraser" style="color: white"></i></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center">
                <a class="btn btn-light " @click="addReference">Add Reference</a>
            </div>

            <button class="btn btn-success btn-sm" @click="updateReference">Update</button>
            <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>

        </div>
        <div v-else>
            <div v-if="form.ref_id.length === 0">
                <div class="text-center">No character reference.</div>
            </div>
            <div v-else>
                <div class="container-fluid p-0 m-0" v-for="(ref,index) in form.ref_id">
                    <div class="mb-4">
                        <span v-text="ref" hidden></span>
                        <h5><span v-text="form.ref_job_title[index]"></span></h5>

                        <span v-show="form.ref_first_name[index] !== ''">
                            <small>Name |</small>
                            <span v-text="form.ref_first_name[index]"></span>&nbsp;
                        </span>
                        <span v-show="form.ref_last_name[index] !== ''">
                            <span v-text="form.ref_last_name[index]"></span>&nbsp;
                        </span>
                        <span v-show="form.ref_middle_name[index] !== ''">
                            <span v-text="form.ref_middle_name[index]"></span><br>
                        </span>
                        <span v-show="form.ref_company_name[index] !== ''">
                             <small>Company |</small>
                            <span v-text="form.ref_company_name[index]"></span> -
                        </span>
                        <span v-show="form.ref_company_address[index] !== ''">
                            <span v-text="form.ref_company_address[index]"></span><br>
                        </span>
                        <span v-show="form.ref_contact_num[index] !== ''">
                            <small>Contact no. |</small>
                            <span v-text="form.ref_contact_num[index]"></span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script>

    export default {

        props: ['profile', 'owner', 'reference'],

        data: function () {
            return {

                edit: false,

                own: this.owner,

                form: new Form({
                    ref_id: [],
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

        mounted: function () {
            this.reference.map((ref) => {
                this.values(ref)
            });
        },


        methods: {
            updateReference() {
                this.form.patch('/profile/' + this.profile.slug + '/reference')
                    .then(response => {
                        this.clear();
                        response.data.map((ref) => {
                            this.values(ref)
                        })
                    });
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "success",
                });


                toast.text("Character reference updated.").goAway(5000);
            },

            deleteReference(ref) {
                this.form.delete('/profile/reference/' + ref)
                    .then(response => {
                        this.work_exp = response.data;
                    });
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type: "danger",
                });
                toast.text("Reference deleted.").goAway(5000);
            },

            addReference() {
                this.form.ref_id.push('');
                this.form.ref_job_title.push('');
                this.form.ref_first_name.push('');
                this.form.ref_last_name.push('');
                this.form.ref_middle_name.push('');
                this.form.ref_company_name.push('');
                this.form.ref_company_address.push('');
                this.form.ref_contact_num.push('');
            },

            removeReference: function (index, ref) {
                this.form.ref_id.splice(index, 1);
                this.form.ref_job_title.splice(index, 1);
                this.form.ref_first_name.splice(index, 1);
                this.form.ref_last_name.splice(index, 1);
                this.form.ref_middle_name.splice(index, 1);
                this.form.ref_company_name.splice(index, 1);
                this.form.ref_company_address.splice(index, 1);
                this.form.ref_contact_num.splice(index, 1);

                if (ref !== '') {
                    this.deleteReference(ref);
                }
            },

            values(ref) {
                this.form.ref_id.push(ref.id);
                this.form.ref_job_title.push(ref.job_title);
                this.form.ref_first_name.push(ref.first_name);
                this.form.ref_last_name.push(ref.last_name);
                this.form.ref_middle_name.push(ref.middle_name);
                this.form.ref_company_name.push(ref.company_name);
                this.form.ref_company_address.push(ref.company_address);
                this.form.ref_contact_num.push(ref.contact_num);
            },

            clear() {
                this.form.ref_id = [];
                this.form.ref_job_title = [];
                this.form.ref_first_name = [];
                this.form.ref_last_name = [];
                this.form.ref_middle_name = [];
                this.form.ref_company_name = [];
                this.form.ref_company_address = [];
                this.form.ref_contact_num = [];
            }
        }
    }
</script>