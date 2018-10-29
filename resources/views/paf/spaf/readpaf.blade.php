@extends('layouts.dashboard')
@section('content')

<div class="full-container">
	<div class="card  remain-height pos-r scrollable">
		<div class="card">
			<div class="card-header">
				<h4><i class="ti-write"></i> &nbsp; <strong>Personnel Action Form</strong></h4>
			</div>

			<div class="card-body">
				{{csrf_field()}}

				<h4><i class="ti-user"></i> &nbsp; <strong>Employee Information</strong></h4>
				<hr>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="raj_id"><strong>Employee ID:</strong></label>
							<p>{{$employee_name->company_id}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="name"><strong>Name of Employee:</strong></label>
							<p>{{$employee_name->first_name}} {{$employee_name->middle_name}} {{$employee_name->last_name}}</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="date_hired"><strong>Date Hired</strong></label>
							<p>{{$employee_contract->contract_start}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="team"><strong>Team</strong></label>
							<p></p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="position"><strong>Position</strong></label>
							<p>{{empty($employee_contract->master_job_title_id) ? '' : $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('job_titles')->first() .' - '. $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('description')->first()}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="department"><strong>Department</strong></label>
							<p>{{empty($employee_contract->master_department_key) ? '' : $department->where('key', $employee_contract->master_department_key)->pluck('department')->first()}}</p>
						</div>
					</div>
				</div>

				<hr>
				<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
				<hr>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="employment_status"><strong>Employment Status</strong></label>
							<p>{{empty($get_paf_details->contractChange->change_type) ? '' : $get_paf_details->contractChange->change_type}}</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="remarks"><strong>Remarks</strong></label>
							<p>{{empty($get_paf_details->remarks) ? '' : $get_paf_details->remarks}}</p>
						</div>
					</div>
				</div>	

				<div id="accordion">
					@include('paf.include.readjob')
					@include('paf.include.readschedule')
				</div>

				<hr>
				<h4><strong>HR Assessment</strong></h4>

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
							<label for="assessed_by"><strong>Assessed By:</strong></label>
							&nbsp;
							{{empty($get_paf_details->humBasicInfo->id) ? 'Waiting for assessment' : '('. $get_paf_details->humBasicInfo->company_id .') '. $get_paf_details->humBasicInfo->last_name .', '. $get_paf_details->humBasicInfo->first_name .' '. $get_paf_details->humBasicInfo->middle_name}}
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
							<label for="approved_by"><strong>Approved By:</strong></label>
							&nbsp;
							{{empty($get_paf_details->exeBasicInfo->id) ? 'Waiting for approval' : '('. $get_paf_details->exeBasicInfo->company_id .') '. $get_paf_details->exeBasicInfo->last_name .', '. $get_paf_details->exeBasicInfo->first_name .' '. $get_paf_details->exeBasicInfo->middle_name}}
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
							<label for="date_effective"><strong>Date Effective:</strong></label>
							&nbsp;
							{{empty($get_paf_details->date_effective) ? '' : $get_paf_details->date_effective}}
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
			</div>
		</div>
	</div>
</div>
@endsection