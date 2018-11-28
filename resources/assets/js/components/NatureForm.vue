<template>

	<div>
		<div v-if="flag == 'req'">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="employment_status"><strong>Employment Status</strong></label>
						<select v-model="employment_status" name="employment_status" id="employment_status" class="form-control">
							<option value="" >--select--</option>
								<option value=""></option>
							
						</select>
					</div>
				</div>
			</div>
		</div>
		<div v-else>
			vue js is an ***
		</div>
	
	</div>
	
</template>

<script>

export default{ 
	props: ['contract_change', 'flag'],

	data: function(){
		return {
			employment_status: '',
		}
	}
}
	
</script>
