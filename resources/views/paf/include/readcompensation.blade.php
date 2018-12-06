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
			<label for="Job Grade"><strong>Job Grade</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_key_job_grade) ? 'n/a' : $get_current_compensation_details->current_key_job_grade}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_key_job_grade) ? 'n/a' : $get_compensation_details->proposed_key_job_grade}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="Probationary Rate"><strong>Probationary Rate</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_probi_rate) ? 'n/a' : $get_current_compensation_details->current_probi_rate .' php'}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_probi_rate) ? 'n/a' : $get_compensation_details->proposed_probi_rate .' php'}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="Gross Salary"><strong>Gross Salary</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_gross_salary) ? 'n/a' : $get_current_compensation_details->current_gross_salary .' php'}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_gross_salary) ? 'n/a' : $get_compensation_details->proposed_gross_salary .' php'}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="Basic Salary"><strong>Basic Salary</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_basic_salary) ? 'n/a' : $get_current_compensation_details->current_basic_salary .' php'}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_basic_salary) ? 'n/a' : $get_compensation_details->proposed_basic_salary .' php'}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="Bonus/Allowance"><strong>Bonus/Allowance</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_bonus_allowance) ? 'n/a' : $get_current_compensation_details->current_bonus_allowance}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_bonus_allowance) ? 'n/a' : $get_compensation_details->proposed_bonus_allowance}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="Benefits"><strong>Benefits</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_benefits) ? 'n/a' : $get_current_compensation_details->current_benefits}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_compensation_details->proposed_benefits) ? 'n/a' : $get_compensation_details->proposed_benefits}}
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