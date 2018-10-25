@extends('layouts.dashboard')
@section('content')
<div class="full-container">
	<div class="card  remain-height pos-r scrollable">
		@if(count($errors))
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				@foreach($errors->all() as $err)
					<li>{!!$err!!}</li>
				@endforeach
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif

		<div class="card">
			<div class="card-header">
				<h4><i class="ti-write"></i> &nbsp; <strong>Personnel Action Form (For Approval)</strong></h4>
			</div>

			<form action="{{route('paf.approval.list.store', $get_paf_details->id)}}" method="post">
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
								<p>{{$get_paf_details->remarks}}</p>
							</div>
						</div>
					</div>	

					<div>
						@include('paf.epaf.include.job')
						@include('paf.epaf.include.schedule')
						@include('paf.epaf.include.compensation')
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

					<action-management 	
						:categories="{{$request_status}}"
						:subcategories="{{$sub_request_status}}">
					</action-management>

					<div class="row">
						<div class="col">
							<div class="form-group text-center">
								<button class="btn btn-success" type="submit">Update</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
@endsection