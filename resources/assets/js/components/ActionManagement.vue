<template>

	<div>
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
			<select v-model="Categories" name="request_status" id="request_status" class="form-control" required>
				<option value="" selected>--Select Category--</option>
				<option v-for="category in categories" v-bind:value="category.id">{{ category.request_status }}</option>
			</select>
		  </div>
			<select v-model="SubCategories" name="sub_request_status" id="sub_request_status" class="form-control" required>
				<option value="" selected>--Select SubCategory--</option>
				<option v-for="subcategory in subcategories" v-bind:value="subcategory.id" v-if="subcategory.master_id_status == Categories">{{ subcategory.sub_request_status }} - {{ subcategory.description }}</option>
			</select>
		</div>
		<div class="row" v-if="SubCategories == 5 && Categories == 2 ">
			<div class="col-4">
				<div class="form-group">
					<label for="proposed_effective_date"><strong>Date Effective</strong></label>
					<!-- <input type="text" v-model="Date_effective" id="date_effective" name="date_effective" class="form-control" title="Date_effective"  data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd"> -->
					<datepicker v-model="Date_effective" 
								name="date_effective"
                                :format="'yyyy-MM-dd'"
                                :bootstrap-styling="true"
                                :typeable="true"
                                :calendar-button="true"
                                calendar-button-icon="ti-calendar"
                                v-mask="'####-##-##'"
                                placeholder="Date Effective">
                    </datepicker>
				</div>
			</div>
		</div>
	</div>
	
</template>

<script>

    import Datepicker from 'vuejs-datepicker';

	export default{ 
		props: ['categories', 'subcategories', 'date_effective'],
		components: {Datepicker},

		data: function(){
			return {
				Categories: '',
				SubCategories: '',

				Date_effective: this.d_e(),
			}
		},

		methods: {
			d_e(){
				if(this.date_effective){
					return this.date_effective.date_effective;
				}else{
					return new Date().toISOString().slice(0, 10);
				}
			}
		}
	}
	
</script>
