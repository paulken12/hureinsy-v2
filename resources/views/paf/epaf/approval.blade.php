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

			<form action="{{route('paf.approval.list.store')}}" method="post">
				<div class="card-body">
					{{csrf_field()}}

					<h4><i class="ti-user"></i> &nbsp; <strong>Employee Information</strong></h4>
					<hr>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="raj_id"><strong>Employee ID:</strong></label>
								<input type="text" id="raj_id" name="raj_id" class="form-control-plaintext" title="raj_id" value="{{$employee_name->company_id}}" readonly>
								<input type="text" id="req_id" name="req_id" class="form-control-plaintext" title="req_id" value="{{$get_paf_details->id}}" readonly hidden>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="name"><strong>Name of Employee:</strong></label>
								<input type="text" id="name" name="name" class="form-control-plaintext" title="Name" value="{{$employee_name->first_name}} {{$employee_name->middle_name}} {{$employee_name->last_name}}" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="date_hired"><strong>Date Hired</strong></label>
								<input type="text" id="date_hired" name="date_hired" class="form-control-plaintext" title="Date_hired" value="{{$employee_contract->contract_start}}" readonly>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="team"><strong>Team</strong></label>
								<input type="text" id="team" name="team" class="form-control-plaintext" title="Team" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="position"><strong>Position</strong></label>
								<input type="text" id="position" name="position" class="form-control-plaintext" title="Position" value="{{empty($employee_contract->master_job_title_id) ? '' : $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('job_titles')->first() .' - '. $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('description')->first()}}" readonly>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="department"><strong>Department</strong></label>
								<input type="text" id="department" name="department" class="form-control-plaintext" title="Department" value="{{empty($employee_contract->master_department_key) ? '' : $department->where('key', $employee_contract->master_department_key)->pluck('department')->first()}}"readonly>
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
								<input type="text" id="employment_status" name="employment_status" class="form-control-plaintext" title="Employment_status" value="{{empty($get_paf_details->employmentStatus->employee_status) ? '' : $get_paf_details->employmentStatus->employee_status}}" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="remarks"><strong>Remarks</strong></label>
								<input type="text" id="remarks" name="remarks" class="form-control-plaintext" title="Remarks" value="{{$get_paf_details->remarks}}" readonly>
							</div>
						</div>
					</div>	

					<div>
						@include('paf.epaf.include.job')
						@include('paf.epaf.include.schedule')
						@include('paf.epaf.include.compensation')
					</div>
					<hr>

					<h4><strong>Action</strong></h4>

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