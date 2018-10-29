<h4><i class="ti-money"></i> &nbsp; <strong>Change in Compensation and Benefit Details</strong></h4>			

<div class="row">
	<div class="col-2">
		<div class="form-group">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label for="current"><strong>Current</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label for="proposed"><strong>Proposed</strong></label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="salary"><strong>Job Grade</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_key_job_grade) ? '' : $get_current_compensation_details->current_key_job_grade}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_job_grade" name="proposed_job_grade" class="form-control-plaintext" title="Proposed_job_grade" value="{{empty($get_compensation_details->proposed_key_job_grade) ? '' : $get_compensation_details->proposed_key_job_grade}}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="bonus/allowance"><strong>Base Salary</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_base_salary) ? '' : $get_current_compensation_details->current_base_salary}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_base_salary" name="proposed_base_salary" class="form-control-plaintext" title="Proposed_base_salary" value="{{empty($get_compensation_details->proposed_base_salary) ? '' : $get_compensation_details->proposed_base_salary}}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="benefits"><strong>Bonus/Allowance</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_bonus_allowance) ? '' : $get_current_compensation_details->current_bonus_allowance}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_bonus_allowance" name="proposed_bonus_allowance" class="form-control-plaintext" title="Proposed_bonus_allowance" value="{{empty($get_compensation_details->proposed_bonus_allowance) ? '' : $get_compensation_details->proposed_bonus_allowance}}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="benefits"><strong>Benefits</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_benefits) ? '' : $get_current_compensation_details->current_benefits}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_benefits" name="proposed_benefits" class="form-control-plaintext" title="Proposed_benefits" value="{{empty($get_compensation_details->proposed_benefits) ? '' : $get_compensation_details->proposed_benefits}}">
		</div>
	</div>
</div>

@if(!empty($get_compensation_details->proposed_remarks_hr))
	<div class="row alert alert-primary">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_compensation_hr">HR Remarks</label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<input type="text" id="proposed_remarks_compensation_hr" name="proposed_remarks_compensation_hr" class="form-control-plaintext" title="proposed_remarks_compensation_hr" value="{{$get_compensation_details->proposed_remarks_hr}}" readonly>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_compensation_exec"><strong>Executive Remarks</strong></label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<input type="text" id="proposed_remarks_compensation_exec" name="proposed_remarks_compensation_exec" class="form-control" title="proposed_remarks_compensation_exec" value="{{$get_compensation_details->proposed_remarks_exec}}">
			</div>
		</div>
	</div>
@endif
