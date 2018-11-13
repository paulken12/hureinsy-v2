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
			<input type="hidden" name="proposed_schedule" value="{{empty($get_schedule_details->proposed_key_schedule) ? '' : $get_schedule_details->proposed_key_schedule}}" readonly>
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
			<input type="hidden" name="proposed_work_location" value="{{empty($get_schedule_details->proposed_key_work_location) ? '' : $get_schedule_details->proposed_key_work_location}}" readonly>
			{{empty($get_schedule_details->proposed_key_work_location) ? 'n/a' : $get_schedule_details->masterCompany->name}}
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
			<input type="text" id="proposed_remarks_schedule" name="proposed_remarks_schedule" class="form-control" title="proposed_remarks_schedule" placeholder="required" value="{{empty($get_schedule_details->proposed_remarks_hr) ? '' : $get_schedule_details->proposed_remarks_hr}}">
		</div>
	</div>
</div>