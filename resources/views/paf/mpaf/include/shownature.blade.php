<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
<hr>

<nature-form
	:contract_change="{{$employment_status}}"
	:emp_stat = "{{$cont_change}}"
	:cur_paf = "{{$get_paf_details}}"
></nature-form>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="remarks"><strong>Remarks</strong></label>
			<input type="text" id="remarks" name="remarks" class="form-control" title="Remarks" value="{{empty($get_paf_details->remarks) ? '' : $get_paf_details->remarks}}">
		</div>
	</div>
</div>
