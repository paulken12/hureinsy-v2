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
			<label for="job_grade"><strong>Job Grade</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_compensation_details->current_key_job_grade) ? 'n/a' : $get_current_compensation_details->current_key_job_grade}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_job_grade" name="proposed_job_grade" class="form-control" title="Proposed_job_grade" value="{{empty($get_compensation_details->proposed_key_job_grade) ? '' : $get_compensation_details->proposed_key_job_grade}}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="probationary_rate"><strong>Probationary Rate</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">	
			<p>{{empty($get_current_compensation_details->current_probi_rate) ? 'n/a' : $get_current_compensation_details->current_probi_rate}}</p>
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_probi_rate" name="proposed_probi_rate" class="form-control m-money" title="Proposed_probi_rate" placeholder="0.00" value="{{empty($get_compensation_details->proposed_probi_rate) ? '' : $get_compensation_details->proposed_probi_rate}}">
			 <div class="input-group-append">
                <div class="input-group-text">
                    <small>php</small>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="gross_salary"><strong>Gross Salary</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<p>{{empty($get_current_compensation_details->current_gross_salary) ? 'n/a' : $get_current_compensation_details->current_gross_salary}}</p>
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_gross_salary" name="proposed_gross_salary" class="form-control m-money" title="Proposed_gross_salary" placeholder="0.00" value="{{empty($get_compensation_details->proposed_gross_salary) ? '' : $get_compensation_details->proposed_gross_salary}}">
			 <div class="input-group-append">
                <div class="input-group-text">
                    <small>php</small>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
		<label for="basic_salary"><strong>Basic Salary</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<p>{{empty($get_current_compensation_details->current_basic_salary) ? '' : $get_current_compensation_details->current_basic_salary}}</p> 
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_basic_salary" name="proposed_basic_salary" class="form-control m-money" title="Proposed_basic_salary" placeholder="0.00" value="{{empty($get_compensation_details->proposed_basic_salary) ? '' : $get_compensation_details->proposed_basic_salary}}">
			 <div class="input-group-append">
                <div class="input-group-text">
                    <small>php</small>
                </div>
            </div>
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
			{{empty($get_current_compensation_details->current_bonus_allowance) ? '' : $get_current_compensation_details->current_bonus_allowance}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_bonus_allowance" name="proposed_bonus_allowance" class="form-control" title="Proposed_bonus_allowance" value="{{empty($get_compensation_details->proposed_bonus_allowance) ? '' : $get_compensation_details->proposed_bonus_allowance}}">
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
			{{empty($get_current_compensation_details->current_benefits) ? '' : $get_current_compensation_details->current_benefits}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_benefits" name="proposed_benefits" class="form-control" title="Proposed_benefits" value="{{empty($get_compensation_details->proposed_benefits) ? '' : $get_compensation_details->proposed_benefits}}">
		</div>
	</div>
</div>

@if(!empty($get_job_details->proposed_remarks_hr))
	<div class="row alert alert-warning">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_compensation">HR Remarks</label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				{{$get_compensation_details->proposed_remarks_hr}}
			</div>
		</div>
	</div>
@endif
