<template>

   <div>

       <div v-for="(address, index) in address_type">
           <h5 v-text="address"></h5>
           <hr>

           <div class="form-row">

               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_unit_num" class="sr-only">Unit no.</label>
                       <input type="text" id="add_unit_num"
                              v-model="add_unit_num[index]"
                              class="form-control" title="Unit no." placeholder="Unit no.">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_block" class="sr-only">Block</label>
                       <input type="text" id="add_block" v-model="add_block[index]"
                              class="form-control" title="Block" placeholder="Block">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_street_name" class="sr-only">Street name</label>
                       <input type="text" id="add_street_name"
                              v-model="add_street_name[index]"
                              class="form-control" title="Street name"
                              placeholder="Street name">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_subdivision" class="sr-only">Subdivision</label>
                       <input type="text" id="add_subdivision"
                              v-model="add_subdivision[index]"
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
                              v-model="add_barangay[index]"
                              class="form-control" title="Barangay" placeholder="Barangay">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_city" class="sr-only">City</label>
                       <input type="text" id="add_city" v-model="add_city"
                              class="form-control"
                              title="City" placeholder="City">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_province" class="sr-only">Province</label>
                       <input type="text" id="add_province"
                              v-model="add_province[index]"
                              class="form-control" title="Province" placeholder="Province">
                   </div>
               </div>
               <div class="col-sm">
                   <div class="form-group">
                       <label for="add_zip_code" class="sr-only">Zip code</label>
                       <input type="text" id="add_zip_code"
                              v-model="add_zip_code[index]"
                              class="form-control" title="Zip code" placeholder="Zip code">
                   </div>
               </div>
           </div>
       </div>
   </div>

</template>

<script>

    export default {

        props: ['address'],

        data: function () {
            return{

                address_type: ['Present Address', 'Permanent Address'],
                master_address_key: [],
                add_unit_num: [],
                add_block: [],
                add_street_name: [],
                add_subdivision: [],
                add_barangay: [],
                add_city: [],
                add_province: [],
                add_zip_code: [],
            }

        },

       created: function () {
           this.address.map((addresses) => {
               this.master_address_key.push(addresses.master_address_key);
               this.add_unit_num.push(addresses.unit_num);
               this.add_block.push(addresses.block);
               this.add_street_name.push(addresses.street_name);
               this.add_subdivision.push(addresses.subdivision);
               this.add_barangay.push(addresses.barangay);
               this.add_city.push(addresses.city);
               this.add_province.push(addresses.province);
               this.add_zip_code.push(addresses.zip_code);
           })
       },

        methods: {


        }
    }
</script>