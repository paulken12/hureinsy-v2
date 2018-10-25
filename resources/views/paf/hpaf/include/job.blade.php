<div class="card">

	<div class="card-header" id="job-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-job" aria-controls="collapse-job" style="text-decoration:none;color:#000000">
				<h4><i class="ti-briefcase"></i> &nbsp; <strong>Change in Job Title, Duties, and Responsibilities Details</strong></h4>
			</a>
		</div>
	</div>

	@if(!empty($get_job_details->proposed_key_department) || !empty($get_job_details->proposed_key_supervisor) || !empty($get_job_details->proposed_key_team) || !empty($get_job_details->proposed_key_job_title) || !empty($get_job_details->proposed_key_project_assignment))
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
					<label for="department"><strong>Job Title</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_current_job_details->masterJobTitle->job_titles) ? 'n/a' : $get_current_job_details->masterJobTitle->job_titles}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_job_title" name="proposed_job_title" class="form-control-plaintext" title="Proposed_job_title" value="{{empty($get_job_details->masterJobTitle->job_titles) ? '' : $get_job_details->masterJobTitle->job_titles}} {{empty($get_job_details->masterJobTitle->description) ? '' : '-'. $get_job_details->masterJobTitle->description}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="position_title"><strong>Department</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_current_job_details->masterDepartment->department) ? '' : $get_current_job_details->masterDepartment->department}}
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
					<label for="team"><strong>Team</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_current_job_details->current_key_team) ? 'n/a' : $get_current_job_details->current_key_team}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_team" name="proposed_team" class="form-control-plaintext" title="Proposed_team" value="{{empty($get_job_details->proposed_key_team) ? '' : $get_job_details->proposed_key_team}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="reportto"><strong>Supervisor</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_current_job_details->current_key_supervisor) ? 'n/a' : $get_current_job_details->current_key_supervisor}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_supervisor" name="proposed_supervisor" class="form-control-plaintext" title="Proposed_supervisor" value="{{empty($get_job_details->proposed_key_supervisor) ? '' : $get_job_details->proposed_key_supervisor}}" readonly>
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
					{{empty($get_current_job_details->current_key_project_assignment) ? 'n/a' : $get_current_job_details->current_key_project_assignment}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_project_assignment" name="proposed_project_assignment" class="form-control-plaintext" title="Proposed_project_assignment" value="{{empty($get_job_details->proposed_key_project_assignment) ? '' : $get_job_details->proposed_key_project_assignment}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="proposed_remarks_job"><strong>HR Remarks</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_remarks_job" name="proposed_remarks_job" class="form-control" title="proposed_remarks_job" value="{{empty($get_job_details->proposed_remarks_hr) ? '' : $get_job_details->proposed_remarks_hr}}">
				</div>
			</div>
		</div>

	</div>
</div>