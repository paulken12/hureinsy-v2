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
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="remarks"><strong>Remarks</strong></label>
			<p>{{$get_paf_details->remarks}}</p>
		</div>
	</div>
</div>	

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="proposed_effective_date"><strong>Proposed Date Effective</strong></label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-2">
		<div class="form-group">
			{{$get_paf_details->date_effective}}
		</div>
	</div>
</div>