
<div class="card">

	<div class="card-header" id="schedule-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-schedule" aria-controls="collapse-schedule" style="text-decoration:none;color:#000000">
				<h4><i class="ti-time"></i> &nbsp; <strong>Change in Work Schedule Details</strong></h4>
			</a>
		</div>
	</div>

		<div class="card-body collapse" id="collapse-schedule" aria-labledby="schedule-heading">
		
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
					<label for="days_of_work"><strong>Schedule</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="current_schedule" name="current_schedule" class="form-control" title="Current_schedule" value="default" readonly="">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_schedule" name="proposed_schedule" class="form-control" title="Proposed_schedule">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="work_location"><strong>Work Location</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="current_schedule" name="current_schedule" class="form-control" title="Current_schedule" value="{{empty($employee_contract->master_company_key) ? 'n/a' : $project_assignment->where('key', $employee_contract->master_company_key)->pluck('name')->first() .' - '. $project_assignment->where('key', $employee_contract->master_company_key)->pluck('address')->first()}}" readonly>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<select name="proposed_work_location" id="proposed_work_location" class="form-control">
						<option value="" selected>--select--</option>
						@foreach ($project_assignment as $assignment)
							<option value="{{$assignment->key}}">{{$assignment->name}} - {{$assignment->address}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

	</div>
</div>