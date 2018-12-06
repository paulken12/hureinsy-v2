<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
<hr>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="employment_status"><strong>Employment Status</strong></label>
			<input type="hidden" name="emp" value="{{$get_paf_details->master_key_employment_status}}">
			<p>{{empty($get_paf_details->contractChange->change_type) ? '' : $get_paf_details->contractChange->change_type}}</p>
		</div>
	</div>

	<div class="col-4">
		<div class="form-group">
			<label for="proposed_effective_date"><strong>Proposed Date Effective</strong></label>
			<p>{{$get_paf_details->date_effective}}</p>
		</div>
	</div>
</div>

<div class="row">
	@if(!empty($get_paf_details->master_key_change_of_contract))
	<div class="col">
		<div class="form-group">
			<label for="Contract Change"><strong>Contract Change</strong></label>
			<p>{{$get_paf_details->cc->employee_status}}</p>
		</div>
	</div>
	@endif

	@if(!empty($get_paf_details->contract_start))
	<div class="col">
		<div class="form-group">
			<label for="Contract Start"><strong>Contract Start</strong></label>
			<p>{{$get_paf_details->contract_start}}</p>
		</div>
	</div>
	@endif

	@if(!empty($get_paf_details->contract_end))
	<div class="col">
		<div class="form-group">
			<label for="Contract End"><strong>Contract End</strong></label>
			<p>{{$get_paf_details->contract_end}}</p>
		</div>
	</div>
	@endif

	@if(!empty($get_paf_details->resigned_date))
	<div class="col">
		<div class="form-group">
			<label for="Resignation Date"><strong>Resignation Date</strong></label>
			<p>{{$get_paf_details->resigned_date}}</p>
		</div>
	</div>
	@endif
</div>	

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="remarks"><strong>Remarks</strong></label>
			<p>{{$get_paf_details->remarks}}</p>
		</div>
	</div>
</div>