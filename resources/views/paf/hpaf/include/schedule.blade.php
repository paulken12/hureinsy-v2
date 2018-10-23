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
					<label for="days_of_work"><strong>Schedule</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{--Placeholder--}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_schedule" name="proposed_schedule" class="form-control-plaintext" title="Proposed_schedule" value="" readonly>
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
					<input type="text" id="proposed_work_location" name="proposed_work_location" class="form-control-plaintext" title="Proposed_work_location" value="" readonly>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<label for="proposed_remarks_schedule"><strong>HR Remarks</strong></label>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<input type="text" id="proposed_remarks_schedule" name="proposed_remarks_schedule" class="form-control" title="proposed_remarks_schedule" value="{{empty($get_schedule_details->proposed_remarks_hr) ? '' : $get_schedule_details->proposed_remarks_hr}}">
				</div>
			</div>
		</div>

	</div>
</div>