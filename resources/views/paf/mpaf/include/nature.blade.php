<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
<hr>

<nature-form
	:contract_change="{{$employment_status}}"
	:emp_stat = "{{$cont_change}}"
></nature-form>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="remarks"><strong>Remarks</strong></label>
			<input type="text" id="remarks" name="remarks" class="form-control" title="Remarks">
		</div>
	</div>
</div>	


{{-- <div class="row">
	<div class="col">
		<div class="form-group">
			<label for="employment_status"><strong>Employment Status</strong></label>
			<select name="employment_status" id="employment_status" class="form-control">
				<option value="" >--select--</option>
				@foreach ($employment_status as $employment)
					<option value="{{$employment->key}}">{{$employment->change_type}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

 --}}