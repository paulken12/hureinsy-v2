<div class="card">

	<div class="card-header" id="schedule-heading">
		<div class="btn-toolbar justify-content-between">
			<a href="" data-toggle="collapse" data-target="#collapse-schedule" aria-controls="collapse-schedule" style="text-decoration:none;color:#000000">
				<h4><i class="ti-time"></i> &nbsp; <strong>Change in Work Schedule Details</strong></h4>
			</a>
		</div>
	</div>

	@if(!empty($get_schedule_details->proposed_key_schedule) || !empty($get_schedule_details->proposed_key_work_location))
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
					{{empty($get_current_schedule_details->current_key_schedule) ? '' : $get_current_schedule_details->current_key_schedule}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_schedule_details->proposed_key_schedule) ? '' : $get_schedule_details->proposed_key_schedule}}
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
					{{empty($get_current_schedule_details->current_key_work_location) ? '' : $get_current_schedule_details->current_key_work_location}}
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					{{empty($get_schedule_details->masterCompany->name) ? '' : $get_schedule_details->masterCompany->name}}
				</div>
			</div>
		</div>

		@if(!empty($get_schedule_details->proposed_remarks_hr))
			<div class="row alert alert-primary">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_schedule_hr"><strong>HR Remarks</strong></label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						{{$get_schedule_details->proposed_remarks_hr}}
					</div>
				</div>
			</div>
		@endif

		@if(!empty($get_schedule_details->proposed_remarks_exec))
			<div class="row alert alert-primary">
				<div class="col-2">
					<div class="form-group">
						<label for="proposed_remarks_schedule_exec"><strong>Executive Remarks</strong></label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						{{$get_schedule_details->proposed_remarks_exec}}
					</div>
				</div>
			</div>
		@endif

	</div>
</div>