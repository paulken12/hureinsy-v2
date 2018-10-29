
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
			{{empty($get_hr_assessment_details->masterProficiency->proficiency) ? '' : $get_hr_assessment_details->masterProficiency->proficiency}}
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
			{{empty($get_hr_assessment_details->masterBehavioural->behaviour) ? '' : $get_hr_assessment_details->masterBehavioural->behaviour}}
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
			{{empty($get_hr_assessment_details->masterEvaluation->evaluation) ? '' : $get_hr_assessment_details->masterEvaluation->evaluation}}
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
			{{empty($get_hr_assessment_details->other_remarks) ? '' : $get_hr_assessment_details->other_remarks}}
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
			{{empty($get_hr_assessment_details->masterOverall->overall) ? '' : $get_hr_assessment_details->masterOverall->overall}}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		</div>
	</div>
</div>