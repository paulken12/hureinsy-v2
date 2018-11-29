<template>

	<div>
		<div v-if="flag == 'req'">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="employment_status"><strong>Employment Status</strong></label>
						<select v-model="employment_status" name="employment_status" id="employment_status" class="form-control">
							<option value="" selected hidden>--Select Category--</option>
							<option v-for="changes in contract_change" v-bind:value="changes.key" >{{ changes.change_type }}</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="proposed_effective_date"><strong>Proposed Date Effective</strong></label>
							<input type="text" id="date_effective" name="date_effective" class="form-control m-date" title="Date_effective" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div v-else>
			
		</div>

		<div class="row" v-if="employment_status == 'reh' || employment_status == 'sfr' || employment_status == 'ren' ">
			<div class="col">
				<div class="form-group">
					<label for="cont_change"><strong>Change Contract Status</strong></label>
					<select v-model="cont_change" name="cont_change" id="cont_change" class="form-control">
						<option value="" selected hidden>--Select Category--</option>
						<option v-for="stats in emp_stat" v-if="stats.key != 'separated'" v-bind:value="stats.key" >{{ stats.employee_status }}</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="cont_start"><strong>Contract Start</strong></label>
					<input type="text" id="cont_start" name="cont_start" class="form-control" title="Contract_start" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
			<div class="col" v-if="cont_change != 'regular'">
				<div class="form-group">
					<label for="cont_end"><strong>Contract End</strong></label>
					<input type="text" id="cont_end" name="cont_end" class="form-control" title="Contract_end" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
		</div>

		<div class="row" v-else-if="employment_status == 'eop'">
			<div class="col">
				<div class="form-group">
					<label for="cont_change"><strong>Change Contract Status</strong></label>
					<select v-model="cont_change" name="cont_change" id="cont_change" class="form-control">
						<option value="" selected hidden>--Select Category--</option>
						<option v-for="stats in emp_stat" v-bind:value="stats.key" >{{ stats.employee_status }}</option>
					</select>
				</div>
			</div>
			<div v-if="cont_change != 'separated'" class="col">
				<div class="form-group">
					<label for="cont_start"><strong>Contract Start</strong></label>
					<input type="text" id="cont_start" name="cont_start" class="form-control" title="Contract_start" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
			<div v-if="cont_change == 'probationary' || cont_change == 'project-based'" class="col">
				<div class="form-group">
					<label for="cont_end"><strong>Contract End</strong></label>
					<input type="text" id="cont_end" name="cont_end" class="form-control" title="Contract_end" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
			<div v-if="cont_change == 'separated'" class="col">
				<div class="form-group">
					<label for="res_date"><strong>Resignation Date</strong></label>
					<input type="text" id="res_date" name="res_date" class="form-control" title="Resignation_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
		</div>
		
		<div class="row" v-else-if="employment_status == 'eoc' || employment_status == 'snr'">
			<div class="col">
				<div class="form-group">
					<label for="res_date"><strong>Resignation Date</strong></label>
					<input type="text" id="res_date" name="res_date" class="form-control" title="Resignation_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
		</div>

		<div class="row" v-else-if="employment_status == 'reg' || employment_status == 'ptr'">
			<div class="col">
				<div class="form-group">
					<label for="cont_start"><strong>Start date</strong></label>
					<input type="text" id="cont_start" name="cont_start" class="form-control" title="Contract_start" data-provide="datepicker" data-date-format="yyyy-mm-dd" v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
				</div>
			</div>
		</div>
	
	</div>
	
</template>

<script>

export default{ 
	props: ['contract_change', 'emp_stat', 'flag'],

	data: function(){
		return {
			employment_status: '',
			cont_change: '',

		}
	},

	mounted: function(){

        $(document).ready(function($){
            $('.m-date').mask('0000-00-00');
        });
	}
}
	
</script>
