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
			<input type="hidden" id="current_job_title" name="current_job_title" class="form-control" title="current_job_title" value="{{$employee_contract->master_job_title_id}}">
			<p>{{empty($employee_contract->master_job_title_id) ? 'n/a' : $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('job_titles')->first() .' - '. $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('description')->first()}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_job_title" id="proposed_job_title" class="form-control">
				<option value="" selected>--select--</option>
				@foreach ($jobTitles as $titles)
					<option value="{{$titles->id}}">{{$titles->job_titles}}({{$titles->description}})</option>
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
			<input type="hidden" id="current_supervisor" name="current_supervisor" class="form-control" title="current_supervisor" value="{{$employee_contract->master_department_key}}">
			<p>{{empty($employee_contract->master_department_key) ? 'n/a' : $department->where('key', $employee_contract->master_department_key)->pluck('department')->first()}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_department" id="proposed_department" class="form-control">
				<option value="" selected>--select--</option>
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
			<label for="Team"><strong>Team</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="current_team" name="current_team" class="form-control" title="Current_team" value="default" readonly>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_team" name="proposed_team" class="form-control" title="Proposed_team">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="supervisor"><strong>Supervisor</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="current_supervisor" name="current_supervisor" class="form-control" title="current_supervisor" value="default" readonly>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_supervisor" id="proposed_supervisor" class="form-control">
				<option value="" selected>--select--</option>
				@foreach($reportTo as $report)
					@foreach ($report->roles->whereNotIn('id', '7') as $reports)
						<option value="{{$report->id}}">{{$report->name}}</option>
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
			<input type="text" id="current_project_assignment" name="current_project_assignment" class="form-control" title="current_project_assignment" value="default" readonly>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_project_assignment" name="proposed_project_assignment" class="form-control" title="Proposed_project_assignment">
		</div>
	</div>
</div>
