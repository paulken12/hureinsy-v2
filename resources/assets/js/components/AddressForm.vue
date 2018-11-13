<template>

   <div>

       <div class="peers ai-c jc-sb">
           <div class="peers peer-greed">
               <div class="peer">
                   <h4>Address</h4>
               </div>
           </div>

           <div class="peer">
               <span><a href="#" title="Edit/Close" class="btn btn-link" v-on:click="edit = !edit"><i class="mR-10 ti-pencil-alt" ></i></a></span>
           </div>

       </div>

       <hr>


       <div v-if="edit">
           <div v-for="(address, index) in form.address_type">
               <h5 v-text="address"></h5>
               <hr>

               <div class="form-row">

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

               <div class="form-row">
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
           <button class="btn btn-success btn-sm" @click="updateAddress">Update</button>
           <button class="btn btn-link btn-sm" @click="edit = false">Cancel</button>
           <button class="btn btn-link btn-sm float-right">Present address same as Permanent</button>
       </div>
       <div v-else>
          <div  v-for="(address, index) in form.address_type">
              <h5 v-text="address"> </h5>
              <div class="container-fluid mb-2">
                  <i class="ti-location-pin"></i>
                  <span v-text="form.add_unit_num[index]">&nbsp;</span>
                  <span v-text="form.add_block[index]">&nbsp;</span>
                  <span v-text="form.add_street_name[index]">&nbsp;</span>
                  <span v-text="form.add_subdivision[index]">&nbsp;</span>
                  <span v-text="form.add_barangay[index]">&nbsp;</span>
                  <span v-text="form.add_city[index]">&nbsp;</span>
                  <span v-text="form.add_province[index]">&nbsp;</span>
                  <span v-text="form.add_zip_code[index]">&nbsp;</span>
              </div>
          </div>

       </div>
   </div>
</template>

<script>

    export default {

        props: ['profile','address'],

        data: function () {
            return{
                edit: false,
                form: new Form({
                    address_type: ['Permanent Address','Present Address'],
                    master_address_key: [],
                    add_unit_num: [],
                    add_block: [],
                    add_street_name: [],
                    add_subdivision: [],
                    add_barangay: [],
                    add_city: [],
                    add_province: [],
                    add_zip_code: [],
                })
            }

        },

       created: function () {
           this.address.map((addresses) => {

               this.form.master_address_key.push(addresses.master_address_key);
               this.form.add_unit_num.push(addresses.unit_num);
               this.form.add_block.push(addresses.block);
               this.form.add_street_name.push(addresses.street_name);
               this.form.add_subdivision.push(addresses.subdivision);
               this.form.add_barangay.push(addresses.barangay);
               this.form.add_city.push(addresses.city);
               this.form.add_province.push(addresses.province);
               this.form.add_zip_code.push(addresses.zip_code);
           })
       },

        methods: {

            updateAddress(){
                this.form.patch('/profile/' + this.profile.slug +'/address');
                this.edit = false;
                let toast = this.$toasted.show("Toasted !!", {
                    theme: "bubble",
                    position: "top-right",
                    type : "success",
                });

                toast.text("Address information updated.").goAway(5000);
            },
            // editAddress(event) {
            //     this.$emit('emit-address', this.data)
            // },
            save(){
                this.updateAddress();
                // this.editAddress();
            },

        }
    }
</script>