<h4><strong>HR Assessment</strong></h4>
<hr>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="proficiency_test"><strong>Proficiency Test</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="proficiency_test" id="proficiency_test" class="form-control">
				<option style="display:none" value="{{empty($get_hr_assessment_details->key_proficiency_test) ? '' : $get_hr_assessment_details->key_proficiency_test}}" selected>{{empty($get_hr_assessment_details->masterProficiency->proficiency) ? '--select--' : $get_hr_assessment_details->masterProficiency->proficiency}}</option>
				@foreach ($proficiency as $prof)
					<option value="{{$prof->key}}">{{$prof->proficiency}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="behavioural_assessment"><strong>Behavioural Assessment</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="behavioural_assessment" id="behavioural_assessment" class="form-control">
				<option style="display:none" value="{{empty($get_hr_assessment_details->key_behavioural_assessment) ? '' : $get_hr_assessment_details->key_behavioural_assessment}}" selected>{{empty($get_hr_assessment_details->masterBehavioural->behaviour) ? '--select--' : $get_hr_assessment_details->masterBehavioural->behaviour}}</option>
				@foreach ($behaviour as $beha)
					<option value="{{$beha->key}}">{{$beha->behaviour}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="performance_evaluation"><strong>Last Performance Evaluation</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="performance_evaluation" id="performance_evaluation" class="form-control">
				<option style="display:none" value="{{empty($get_hr_assessment_details->key_performance_evaluation) ? '' : $get_hr_assessment_details->key_performance_evaluation}}" selected>{{empty($get_hr_assessment_details->masterEvaluation->evaluation) ? '--select--' : $get_hr_assessment_details->masterEvaluation->evaluation}}</option>
				@foreach ($evaluation as $eval)
					<option value="{{$eval->key}}">{{$eval->evaluation}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="other_remarks"><strong>Other Remarks</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<input type="text" id="other_remarks" name="other_remarks" class="form-control" title="Other_remarks" value="{{empty($get_hr_assessment_details->other_remarks) ? '' : $get_hr_assessment_details->other_remarks}}">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label for="overall_recommendation"><strong>Overall Recommendation</strong></label>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<select name="overall_recommendation" id="overall_recommendation" class="form-control">
				<option style="display:none" value="{{empty($get_hr_assessment_details->key_overall_recommendation) ? '' : $get_hr_assessment_details->key_overall_recommendation}}" selected>{{empty($get_hr_assessment_details->masterOverall->overall) ? '--select--' : $get_hr_assessment_details->masterOverall->overall}}</option>
				@foreach ($overall as $over)
					<option value="{{$over->key}}">{{$over->overall}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>