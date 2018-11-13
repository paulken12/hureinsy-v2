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
			<input type="hidden" name="current_job_title" value="{{$employee_contract->job_id}}">
			<p>{{$employee_contract->jobs->job_title}} {{$employee_contract->jobs->job_description}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_job_title" id="proposed_job_title" class="form-control">
				<option value="" selected>--select--</option>
				@foreach ($jobTitles as $titles)
					<option value="{{$titles->id}}">{{$titles->job_title}} {{$titles->job_description}}</option>
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
			<input type="hidden" name="current_department" value="{{$employee_contract->jobs->master_department_key}}">
			<p>{{$employee_contract->jobs->department->department}}</p>
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
			<input type="hidden" name="current_team" value="{{empty($employee_team->id) ? '' : $employee_team->id}}" readonly>
			<p>{{empty($employee_team->id) ? '' : $employee_team->display_name}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_team" id="proposed_team" class="form-control">
				<option value="" selected>--select--</option>
				@foreach($teams as $team)
					<option value="{{$team->id}}">{{$team->display_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="supervisor"><strong>Reporting to</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="hidden" name="current_supervisor" value="{{empty($employee_name->reporting_to) ? '' : $employee_name->reporting_to}}" readonly>
			{{$employee_name->reportingTo()}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_supervisor" id="proposed_supervisor" class="form-control">
				<option value="" selected>--select--</option>
				@foreach($reportingTo->sortBy('last_name') as $report)
					@foreach ($report->user->roles->whereNotIn('name', 'employee') as $reports)
						<option value="{{$report->id}}">{{$report->last_name}}, {{$report->first_name}} - {{$reports->display_name}}</option>
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
			<input type="hidden" name="current_project_assignment" value="{{$employee_contract->job_id}}" readonly>
			<p>{{$employee_contract->project()->project_title}} {{$employee_contract->project()->project_desc}}</p>

		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_project_assignment" id="proposed_project_assignment" class="form-control">
				<option value="" selected>--select--</option>
				@foreach($proj_assignment as $project)
					<option value="{{$project->id}}">{{$project->project_title}} {{$project->project_desc}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
