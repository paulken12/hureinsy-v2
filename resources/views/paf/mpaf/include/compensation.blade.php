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
			<input type="hidden" id="current_job_grade" name="current_job_grade" class="form-control" title="Current_job_grade" value="{{$employee_contract->compensation->job_grade}}">
			<p>{{$employee_contract->compensation->job_grade}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_job_grade" name="proposed_job_grade" class="form-control" title="Proposed_job_grade" placeholder="Job Grade">
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
			<input type="hidden" id="current_probi_rate" name="current_probi_rate" class="form-control" title="Current_probi_rate" value="{{$employee_contract->compensation->probationary_rate}}">
			<p>{{$employee_contract->compensation->probationary_rate}}</p>
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_probi_rate" name="proposed_probi_rate" class="form-control m-money" title="Proposed_probi_rate" placeholder="0.00">
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
			<input type="hidden" id="current_gross_salary" name="current_gross_salary" class="form-control" title="Current_gross_salary" value="{{$employee_contract->compensation->gross_salary}}">
			<p>{{$employee_contract->compensation->gross_salary}}</p>
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_gross_salary" name="proposed_gross_salary" class="form-control m-money" title="Proposed_gross_salary" placeholder="0.00">
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
			<input type="hidden" id="current_basic_salary" name="current_basic_salary" class="form-control m-money" title="Current_basic_salary" value="{{$employee_contract->compensation->basic_salary}}">
			<p>{{$employee_contract->compensation->basic_salary}}</p> 
		</div>
	</div>
	<div class="col">
		<div class="input-group">
			<input type="text" id="proposed_basic_salary" name="proposed_basic_salary" class="form-control m-money" title="Proposed_basic_salary" placeholder="0.00">
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
			<label for="benefits"><strong>Bonus/Allowance</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="hidden" id="current_bonus_allowance" name="current_bonus_allowance" class="form-control" title="Current_bonus_allowance" value="{{$employee_contract->compensation->other_bonus_allowance}}">
			<p>{{$employee_contract->compensation->other_bonus_allowance}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_bonus_allowance" name="proposed_bonus_allowance" class="form-control" title="Proposed_bonus_allowance" placeholder="Bonus Allowance">
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
			<input type="hidden" id="current_benefits" name="current_benefits" class="form-control" title="Current_benefits" value="{{$employee_contract->compensation->other_benefits}}">
			<p>{{$employee_contract->compensation->other_benefits}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_benefits" name="proposed_benefits" class="form-control" title="Proposed_benefits" placeholder="Benefits">
		</div>
	</div>
</div>