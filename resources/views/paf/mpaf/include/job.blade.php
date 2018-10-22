<div class="card">

	<div class="card-header" id="job-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-job" aria-controls="collapse-job" style="text-decoration:none;color:#000000">
				<h4><i class="ti-briefcase"></i> &nbsp; <strong>Change in Job Title, Duties, and Responsibilities Details</strong></h4>
			</a>
		</div>
	</div>

	<div class="card-body collapse" id="collapse-job" aria-labledby="job-heading">
	
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
					<label for="reportto"><strong>Report To</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{$employee_info->reportingTo()}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<select name="proposed_reportto" id="proposed_reportto" class="form-control">
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
					<select name="proposed_position_title" id="proposed_position_title" class="form-control">
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
					<select name="proposed_project_assignment" id="proposed_project_assignment" class="form-control">
						<option value="" selected>--select--</option>
						@foreach ($project_assignment as $assignment)
							<option value="{{$assignment->key}}">{{$assignment->name}} - {{$assignment->address}}</option>
						@endforeach
					</select>
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

	</div>
</div>
	