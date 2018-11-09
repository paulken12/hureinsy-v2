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
			<label for="position_title"><strong>Job Title</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_job_details->current_key_job_title) ? 'n/a' : $get_current_job_details->masterJobTitle->job_title .' '. $get_current_job_details->masterJobTitle->job_description}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_position_title" id="proposed_position_title" class="form-control">
				<option style="display:none" value="{{empty($get_job_details->proposed_key_job_title) ? '' : $get_job_details->proposed_key_job_title}}" selected>
						{{empty($get_job_details->masterJobTitle->job_title) ? '--select--' : $get_job_details->masterJobTitle->job_title .' '. $get_job_details->masterJobTitle->job_description}}
				</option>
				@foreach ($jobTitles as $titles)
					<option value="{{$titles->id}}">{{$titles->job_title .' '. $titles->job_description}}</option>
				@endforeach
			</select>
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
			{{empty($get_current_job_details->masterDepartment->department) ? 'n/a' : $get_current_job_details->masterDepartment->department}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_department" id="proposed_department" class="form-control">
				<option style="display:none" value="{{empty($get_job_details->masterDepartment->key) ? '' : $get_job_details->masterDepartment->key}}" selected>{{empty($get_job_details->masterDepartment->department) ? '--select--' : $get_job_details->masterDepartment->department}}</option>
				<option value="">--select--</option>
				@foreach ($department as $departments)
					<option value="{{$departments->key}}">{{$departments->department}}</option>
				@endforeach
			</select>
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
			<input type="text" id="proposed_team" name="proposed_team" class="form-control" title="Proposed_team" value="{{empty($get_job_details->proposed_key_team) ? '' : $get_job_details->proposed_key_team}}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="reportto"><strong>Reporting to</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_job_details->current_key_supervisor) ? 'n/a' : $get_current_job_details->current_key_supervisor}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_supervisor" id="proposed_supervisor" class="form-control">
				<option style="display:none" value="{{empty($get_job_details->proposed_key_supervisor) ? '--select--' : $get_job_details->proposed_key_supervisor}}" selected>
				<option value="">--select--</option>
				@foreach($reportTo as $report)
					@foreach ($report->roles->whereNotIn('name', 'employee') as $reports)
						<option value="{{$report->name}}">{{$report->name}} - {{$reports->display_name}}</option>
					@endforeach
				@endforeach
			</select>
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
			<select name="proposed_project_assignment" id="proposed_project_assignment" class="form-control">
				<option style="display:none" value="{{empty($get_job_details->proposed_key_project_assignment) ? '' : $get_job_details->proposed_key_project_assignment}}" selected>
						{{empty($get_job_details->proposed_key_project_assignment) ? '--select--' : $get_job_details->masterProjectAssignment->project_title .' '. $get_job_details->masterProjectAssignment->project_desc .' '. $get_job_details->masterProjectAssignment->company->name}}
				@foreach($proj_assignment as $project)
					<option value="{{$project->id}}">{{$project->project_title}} {{$project->project_desc}} {{$project->company->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

@if(!empty($get_job_details->proposed_remarks_hr))
	<div class="row alert alert-warning">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_job">HR Remarks</label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				{{$get_job_details->proposed_remarks_hr}}
			</div>
		</div>
	</div>
@endif
