<div class="card">

	<div class="card-header" id="job-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-job" aria-controls="collapse-job" style="text-decoration:none;color:#000000">
				<h4><i class="ti-briefcase"></i> &nbsp; <strong>Change in Job Title, Duties, and Responsibilities Details</strong></h4>
			</a>
		</div>
	</div>

	@if(!empty($get_job_details->proposed_key_department) || !empty($get_job_details->proposed_reports_to) || !empty($get_job_details->proposed_key_position_title) || !empty($get_job_details->proposed_key_project_assignment))
		<div class="card-body collapse show" id="collapse-job" aria-labledby="job-heading">
	@else
		<div class="card-body collapse" id="collapse-job" aria-labledby="job-heading">
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
					<label for="department"><strong>Department</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($employee_contract->master_department_key) ? 'n/a' : $department->where('key', $employee_contract->master_department_key)->pluck('department')->first()}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_department" name="proposed_department" class="form-control-plaintext" title="Proposed_department" value="{{empty($get_job_details->masterDepartment->department) ? '' : $get_job_details->masterDepartment->department}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="reportto"><strong>Report To</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{$employee_name->reportingTo()}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_reportto" name="proposed_reportto" class="form-control-plaintext" title="Proposed_reportto" value="{{empty($get_job_details->user->name) ? '' : $get_job_details->user->name}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="position_title"><strong>Position/Title</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($employee_contract->master_job_title_id) ? 'n/a' : $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('job_titles')->first() .' - '. $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('description')->first()}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_position_title" name="proposed_position_title" class="form-control-plaintext" title="Proposed_position_title" value="{{empty($get_job_details->masterJobTitle->job_titles) ? '' : $get_job_details->masterJobTitle->job_titles}} - {{empty($get_job_details->masterJobTitle->description) ? '' : $get_job_details->masterJobTitle->description}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="project_assignment"><strong>Project Assignment</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($employee_contract->master_company_key) ? 'n/a' : $project_assignment->where('key', $employee_contract->master_company_key)->pluck('name')->first() .' - '. $project_assignment->where('key', $employee_contract->master_company_key)->pluck('address')->first()}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_project_assignment" name="proposed_project_assignment" class="form-control-plaintext" title="Proposed_project_assignment" value="{{empty($get_job_details->masterCompany->name) ? '' : $get_job_details->masterCompany->name}}" readonly>
				</div>
			</div>
		</div>

		@if(!empty($get_job_details->proposed_remarks_hr))
			<div class="row alert alert-primary">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_job_hr">HR Remarks</label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input type="text" id="proposed_remarks_job_hr" name="proposed_remarks_job_hr" class="form-control-plaintext" title="proposed_remarks_job_hr" value="{{$get_job_details->proposed_remarks_hr}}" readonly>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_job_exec"><strong>Executive Remarks</strong></label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input type="text" id="proposed_remarks_job_exec" name="proposed_remarks_job_exec" class="form-control" title="proposed_remarks_job_exec">
					</div>
				</div>
			</div>
		@endif

	</div>
</div>