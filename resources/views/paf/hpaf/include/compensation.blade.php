<div class="card">

	<div class="card-header" id="compensation-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-compensation" aria-controls="collapse-compensation" style="text-decoration:none;color:#000000">
				<h4><i class="ti-money"></i> &nbsp; <strong>Change in Compensation and Benefit Details</strong></h4>			
			</a>
		</div>
	</div>

	@if(!empty($get_compensation_details->proposed_salary) || !empty($get_compensation_details->proposed_bonus_allowance) || !empty($get_compensation_details->proposed_benefits))
		<div class="card-body collapse show" id="collapse-compensation" aria-labledby="compensation-heading-heading">
	@else
		<div class="card-body collapse" id="collapse-compensation" aria-labledby="compensation-heading-heading">
	@endif

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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_job_grade" name="proposed_job_grade" class="form-control" title="Proposed_job_grade">
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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_base_salary" name="proposed_base_salary" class="form-control" title="Proposed_base_salary">
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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_bonus_allowance" name="proposed_bonus_allowance" class="form-control" title="Proposed_bonus_allowance">
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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_benefits" name="proposed_benefits" class="form-control" title="Proposed_benefits">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="proposed_remarks_compensation"><strong>HR Remarks</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_remarks_compensation" name="proposed_remarks_compensation" class="form-control" title="proposed_remarks_compensation" value="{{empty($get_compensation_details->proposed_remarks_hr) ? '' : $get_compensation_details->proposed_remarks_hr}}">
				</div>
			</div>
		</div>

	</div>
</div>