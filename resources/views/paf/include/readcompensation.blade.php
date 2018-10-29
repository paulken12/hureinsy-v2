<h4><i class="ti-money"></i> &nbsp; <strong>Change in Compensation and Benefit Details</strong></h4>		
<hr>

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
			<p>{{empty($get_compensation_details->proposed_key_job_grade) ? '' : $get_compensation_details->proposed_key_job_grade}}</p>
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
			<p>{{empty($get_compensation_details->proposed_base_salary) ? '' : $get_compensation_details->proposed_base_salary}}</p>
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
			<p>{{empty($get_compensation_details->proposed_bonus_allowance) ? '' : $get_compensation_details->proposed_bonus_allowance}}</p>
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
			<p>{{empty($get_compensation_details->proposed_benefits) ? '' : $get_compensation_details->proposed_benefits}}</p>
		</div>
	</div>
</div>

@if(!empty($get_compensation_details->proposed_remarks_hr))
	<div class="row alert alert-primary">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_compensation_hr"><strong>HR Remarks</strong></label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				{{$get_compensation_details->proposed_remarks_hr}}
			</div>
		</div>
	</div>
@endif

@if(!empty($get_compensation_details->proposed_remarks_exec))
	<div class="row alert alert-primary">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_compensation_exec"><strong>Executive Remarks</strong></label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				{{$get_compensation_details->proposed_remarks_exec}}
			</div>
		</div>
	</div>
@endif