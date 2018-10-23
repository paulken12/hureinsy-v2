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
					<label for="department"><strong>Job Title</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_curerent_job_details->masterJobTitle->job_titles) ? 'n/a' : $get_curerent_job_details->masterJobTitle->job_titles}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_job_details->masterJobTitle->job_titles) ? '' : $get_job_details->masterJobTitle->job_titles}} {{empty($get_job_details->masterJobTitle->description) ? '' : '-'. $get_job_details->masterJobTitle->description}}
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
					{{empty($get_curerent_job_details->masterDepartment->department) ? '' : $get_job_details->masterDepartment->department}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_job_details->masterDepartment->department) ? '' : $get_job_details->masterDepartment->department}}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="project_assignment"><strong>Team</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
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
				</div>
			</div>
			<div class="col">
				<div class="form-group">
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