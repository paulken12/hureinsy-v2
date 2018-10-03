<div class="card">

	<div class="card-header" id="schedule-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-schedule" aria-controls="collapse-schedule" style="text-decoration:none;color:#000000">
				<h4><i class="ti-time"></i> &nbsp; <strong>Change in Work Schedule Details</strong></h4>
			</a>
		</div>
	</div>

	@if(!empty($get_schedule_details->proposed_days_of_work) || !empty($get_schedule_details->proposed_work_hours_per_week) || !empty($get_schedule_details->proposed_type_of_shift) || !empty($get_schedule_details->proposed_work_hours_per_day) || !empty($get_schedule_details->proposed_work_location) || !empty($get_schedule_details->proposed_key_schedule_type))
		<div class="card-body collapse show" id="collapse-schedule" aria-labledby="schedule-heading">
	@else
		<div class="card-body collapse" id="collapse-schedule" aria-labledby="schedule-heading">
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
					<label for="days_of_work"><strong>Days of Work</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_days_of_work" name="proposed_days_of_work" class="form-control-plaintext" title="Proposed_days_of_work" value="{{empty($get_schedule_details->proposed_days_of_work) ? '' : $get_schedule_details->proposed_days_of_work}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="work_hours_per_week"><strong>Work Hours per week</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_work_hours_per_week" name="proposed_work_hours_per_week" class="form-control-plaintext" title="Proposed_work_hours_per_week" value="{{empty($get_schedule_details->proposed_work_hours_per_week) ? '' : $get_schedule_details->proposed_work_hours_per_week}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="type_of_shift"><strong>Type of Shift</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_type_of_shift" name="proposed_type_of_shift" class="form-control-plaintext" title="Proposed_type_of_shift" value="{{empty($get_schedule_details->proposed_type_of_shift) ? '' : $get_schedule_details->proposed_type_of_shift}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="work_hours_per_day"><strong>Work Hours per Day</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_work_hours_per_day" name="proposed_work_hours_per_day" class="form-control-plaintext" title="Proposed_work_hours_per_day" value="{{empty($get_schedule_details->proposed_work_hours_per_day) ? '' : $get_schedule_details->proposed_work_hours_per_day}}" readonly>
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
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_work_location" name="proposed_work_location" class="form-control-plaintext" title="Proposed_work_location" value="{{empty($get_schedule_details->proposed_work_location) ? '' : $get_schedule_details->proposed_work_location}}" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="sched_type"><strong>Sched Type</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="sched_type" name="sched_type" class="form-control-plaintext" title="sched_type" value="{{empty($get_schedule_details->schedType->schedule_type) ? '' : $get_schedule_details->schedType->schedule_type}}" readonly>
				</div>
			</div>
		</div>

		@if(!empty($get_schedule_details->proposed_remarks_hr))
			<div class="row alert alert-primary">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_schedule_hr">HR Remarks</label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input type="text" id="proposed_remarks_schedule_hr" name="proposed_remarks_schedule_hr" class="form-control-plaintext" title="proposed_remarks_schedule_hr" value="{{$get_schedule_details->proposed_remarks_hr}}" readonly>
					</div>
				</div>
			</div>
		@endif

		@if(!empty($get_schedule_details->proposed_remarks_exec))
			<div class="row alert alert-primary">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_schedule_exec">Executive Remarks</label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input type="text" id="proposed_remarks_schedule_exec" name="proposed_remarks_schedule_exec" class="form-control-plaintext" title="proposed_remarks_schedule_exec" value="{{$get_schedule_details->proposed_remarks_exec}}" readonly>
					</div>
				</div>
			</div>
		@endif

	</div>
</div>