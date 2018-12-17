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
			<label for="Schedule"><strong>Schedule</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{empty($get_current_schedule_details->current_key_schedule) ? 'n/a' : $get_current_schedule_details->current_key_schedule}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="proposed_schedule" name="proposed_schedule" class="form-control" title="proposed_schedule" value="{{empty($get_schedule_details->proposed_key_schedule) ? '' : $get_schedule_details->proposed_key_schedule}}">
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
			{{empty($get_current_schedule_details->current_key_work_location) ? 'n/a' : $get_current_schedule_details->MasterCompany->name}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proposed_work_location" id="proposed_work_location" class="form-control">
				<option style="display:none" value="{{empty($get_schedule_details->proposed_key_work_location) ? '' : $get_schedule_details->proposed_key_work_location}}" selected>{{empty($get_schedule_details->masterCompany->name) ? '--select--' : $get_schedule_details->masterCompany->name .' - '. $get_schedule_details->masterCompany->address}}</option>
				@foreach ($project_assignment as $assignment)
					<option value="{{$assignment->key}}">{{$assignment->name}} - {{$assignment->address}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

@if(!empty($get_job_details->proposed_remarks_hr))
	<div class="row alert alert-warning">
		<div class="col-2">
			<div class="form-group">
				<label for="proposed_remarks_schedule">HR Remarks</label>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				{{$get_schedule_details->proposed_remarks_hr}}
			</div>
		</div>
	</div>
@endif