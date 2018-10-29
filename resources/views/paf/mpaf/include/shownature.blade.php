<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
<hr>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="employment_status"><strong>Employment Status</strong></label>
			<select name="employment_status" id="employment_status" class="form-control" required>
				<option style="display:none" value="{{empty($get_paf_details->master_key_employment_status) ? '' : $get_paf_details->master_key_employment_status}}" selected>{{empty($get_paf_details->contractChange->change_type) ? '--select--' : $get_paf_details->contractChange->change_type}}</option>
				@foreach ($employment_status as $employment)
					<option value="{{$employment->key}}">{{$employment->change_type}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="remarks"><strong>Remarks</strong></label>
			<input type="text" id="remarks" name="remarks" class="form-control" title="Remarks" value="{{empty($get_paf_details->remarks) ? '' : $get_paf_details->remarks}}">
		</div>
	</div>
</div>