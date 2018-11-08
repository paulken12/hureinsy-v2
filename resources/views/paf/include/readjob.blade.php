<h4><i class="ti-briefcase"></i> &nbsp; <strong>Change in Job Title, Duties, and Responsibilities Details</strong></h4>
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
			<label for="department"><strong>Job Title</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_job_details->current_key_job_title) ? 'n/a' : $get_current_job_details->masterJobTitle->job_title .' '. $get_current_job_details->masterJobTitle->job_description}}		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{$get_job_details->masterJobTitle->job_title .' '. $get_job_details->masterJobTitle->job_description}}
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
			{{$get_job_details->masterDepartment->department}}
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
			{{empty($get_job_details->proposed_key_team) ? '' : $get_job_details->proposed_key_team}}
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
			{{empty($get_job_details->proposed_key_supervisor) ? '' : $get_job_details->proposed_key_supervisor}}
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
			{{empty($get_current_job_details->current_key_project_assignment) ? 'n/a' : $get_current_job_details->masterProjectAssignment->project_title .' '. $get_current_job_details->masterProjectAssignment->project_desc .' '. $get_current_job_details->masterProjectAssignment->company->name}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{$get_job_details->masterProjectAssignment->project_title .' '. $get_job_details->masterProjectAssignment->project_desc .' '. $get_job_details->masterProjectAssignment->company->name}}
		</div>
	</div>
</div>

@if(!empty($get_job_details->proposed_remarks_hr))
	<div class="row alert alert-primary">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_hr"><strong>HR Remarks</strong></label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<p>{{$get_job_details->proposed_remarks_hr}}</p>
			</div>
		</div>
	</div>
@endif

@if(!empty($get_job_details->proposed_remarks_exec))
	<div class="row alert alert-primary">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_job_exec"><strong>Executive Remarks</strong></label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<p>{{$get_job_details->proposed_remarks_exec}}</p>
			</div>
		</div>
	</div>
@endif