<h4><i class="ti-time"></i> &nbsp; <strong>Change in Work Schedule Details</strong></h4>
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
			<label for="days_of_work"><strong>Schedule</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_schedule_details->current_key_schedule) ? 'n/a' : $get_current_schedule_details->current_key_schedule}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_schedule_details->proposed_key_schedule) ? 'n/a' : $get_schedule_details->proposed_key_schedule}}
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
			{{empty($get_current_schedule_details->current_key_work_location) ? 'n/a' : $get_current_schedule_details->masterProjectAssignment->company->name}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_schedule_details->masterCompany->name) ? 'n/a' : $get_schedule_details->masterCompany->name}}
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